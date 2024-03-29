<?php
namespace Bitrix\Timeman\Service\Worktime;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ObjectException;
use Bitrix\Main\ORM\Objectify\Values;
use Bitrix\Main\Result;
use Bitrix\Timeman\Form\Worktime\WorktimeRecordForm;
use Bitrix\Timeman\Model\Schedule\Schedule;
use Bitrix\Timeman\Model\Worktime\Contract\WorktimeRecordIdStorable;
use Bitrix\Timeman\Model\Worktime\EventLog\WorktimeEvent;
use Bitrix\Timeman\Model\Worktime\EventLog\WorktimeEventTable;
use Bitrix\Timeman\Model\Worktime\Record\WorktimeRecord;
use Bitrix\Timeman\Repository\Schedule\ViolationRulesRepository;
use Bitrix\Timeman\Repository\Worktime\WorktimeRepository;
use Bitrix\Timeman\Service\BaseService;
use Bitrix\Timeman\Service\BaseServiceResult;
use Bitrix\Timeman\Service\Worktime\Notification\WorktimeNotificationService;
use Bitrix\Timeman\Service\Worktime\Record;
use Bitrix\Timeman\Service\Worktime\Record\WorktimeRecordManagerFactory;
use Bitrix\Timeman\Service\Worktime\Result\WorktimeServiceResult;

Loc::loadMessages(__FILE__);

class WorktimeService extends BaseService
{
	/** @var Record\WorktimeManager */
	protected $recordManager;
	/** @var WorktimeActionList */
	private $actionList;
	/** @var WorktimeRepository */
	private $worktimeRepository;
	/** @var WorktimeNotificationService */
	private $notificationService;
	/** @var WorktimeRecordManagerFactory */
	private $recordManagerFactory;
	/** @var WorktimeRecordForm */
	private $recordForm;
	private $violationRulesRepository;

	public function __construct(
		WorktimeRecordManagerFactory $recordFactory,
		WorktimeActionList $actionList,
		WorktimeRepository $worktimeRepository,
		ViolationRulesRepository $violationRulesRepository,
		WorktimeNotificationService $notificationService,
		array $options = []
	)
	{
		$this->recordManagerFactory = $recordFactory;
		$this->actionList = $actionList;
		$this->worktimeRepository = $worktimeRepository;
		$this->violationRulesRepository = $violationRulesRepository;
		$this->notificationService = $notificationService;
	}

	/**
	 * @param WorktimeRecordForm $recordForm
	 * @return Result|WorktimeServiceResult
	 */
	public function startWorktime($recordForm)
	{
		$this->recordForm = clone $recordForm;
		if ($this->recordForm->getFirstEventName() === null)
		{
			$this->recordForm->getFirstEventForm()->eventName = WorktimeEventTable::EVENT_TYPE_START;
			if ($this->recordForm->recordedStartSeconds !== null ||
				$this->recordForm->recordedStartTimestamp !== null ||
				$this->recordForm->recordedStartTime !== null
			)
			{
				$this->recordForm->getFirstEventForm()->eventName = WorktimeEventTable::EVENT_TYPE_START_WITH_ANOTHER_TIME;
			}
		}
		return $this->processWorktimeAction($this->recordForm,
			function () {
				return $this->checkActionEligibility(
					$this->buildActionList($this->recordForm->userId)->getStartActions()
				);
			}
		);
	}

	public function continueWork($recordForm)
	{
		$this->recordForm = clone $recordForm;
		if ($this->recordForm->getFirstEventName() === null)
		{
			$this->recordForm->getFirstEventForm()->eventName = WorktimeEventTable::EVENT_TYPE_CONTINUE;
		}
		return $this->processWorktimeAction($this->recordForm,
			function () use ($recordForm) {
				$actionList = $this->buildActionList($recordForm->userId);
				return $this->checkActionEligibility(
					array_merge(
						$actionList->getContinueActions(),
						$actionList->getRelaunchActions()
					)
				);
			}
		);
	}

	public function pauseWork($recordForm)
	{
		$this->recordForm = clone $recordForm;
		if ($this->recordForm->getFirstEventName() === null)
		{
			$this->recordForm->getFirstEventForm()->eventName = WorktimeEventTable::EVENT_TYPE_PAUSE;
		}
		return $this->processWorktimeAction($this->recordForm,
			function () use ($recordForm) {
				return $this->checkActionEligibility(
					$this->buildActionList($recordForm->userId)->getPauseActions()
				);
			}
		);
	}

	public function stopWorktime($recordForm)
	{
		$this->recordForm = clone $recordForm;
		if ($this->recordForm->getFirstEventName() === null)
		{
			$this->recordForm->getFirstEventForm()->eventName = WorktimeEventTable::EVENT_TYPE_STOP;
			if ($this->recordForm->recordedStopSeconds !== null ||
				$this->recordForm->recordedStopTimestamp !== null ||
				$this->recordForm->recordedStopTime !== null
			)
			{
				$this->recordForm->getFirstEventForm()->eventName = WorktimeEventTable::EVENT_TYPE_STOP_WITH_ANOTHER_TIME;
			}
		}
		return $this->processWorktimeAction($this->recordForm,
			function () use ($recordForm) {
				return $this->checkActionEligibility(
					$this->buildActionList($recordForm->userId)->getStopActions()
				);
			}
		);
	}

	/**
	 * @param WorktimeRecordForm $recordForm
	 * @return WorktimeServiceResult
	 */
	public function editWorktime($recordForm)
	{
		$this->recordForm = clone $recordForm;
		if ($this->recordForm->getFirstEventName() === null)
		{
			$this->recordForm->getFirstEventForm()->eventName = WorktimeEventTable::EVENT_TYPE_EDIT_WORKTIME;
		}
		return $this->processWorktimeAction($this->recordForm,
			function () use ($recordForm) {
				return $this->checkActionEligibility(
					$this->buildActionList($recordForm->editedBy)->getEditActions()
				);
			}
		);
	}

	/**
	 * @param WorktimeRecordForm $recordForm
	 * @return BaseServiceResult|WorktimeServiceResult
	 */
	public function approveWorktimeRecord($recordForm)
	{
		$this->recordForm = $recordForm;
		$record = $this->worktimeRepository->findByIdWith($recordForm->id, ['SCHEDULE', 'SCHEDULE.SCHEDULE_VIOLATION_RULES', 'SHIFT']);
		if (!$record)
		{
			return WorktimeServiceResult::createWithErrorText(
				Loc::getMessage('TM_BASE_SERVICE_RESULT_ERROR_WORKTIME_RECORD_NOT_FOUND')
			);
		}

		return $this->processWorktimeAction($this->recordForm,
			function () use ($recordForm, $record) {
				return (new WorktimeServiceResult())
					->setShift($record->obtainShift())
					->setSchedule($record->obtainSchedule())
					->setWorktimeRecord($record);
			}
		);
	}

	/**
	 * @param WorktimeRecordForm $recordForm
	 * @param $checkActionCallback
	 * @return WorktimeServiceResult|BaseServiceResult
	 */
	private function processWorktimeAction($recordForm, $checkActionCallback)
	{
		return $this->wrapAction(function () use ($recordForm, $checkActionCallback) {
			/** @var WorktimeServiceResult $result */
			$this->safeRun($result = $checkActionCallback());

			$this->safeRun(
				$buildingRecordResult = $this->getRecordManager()
					->buildActualRecord(
						$result->getSchedule(),
						$result->getShift(),
						$result->getWorktimeRecord(),
						$this->getPersonalViolationRules(
							$result->getSchedule() ? $result->getSchedule()->getId() : null,
							$result->getWorktimeRecord() ? $result->getWorktimeRecord()->getUserId() : $recordForm->userId
						)
					)
			);

			$actualRecord = $buildingRecordResult->getWorktimeRecord();
			if (empty($actualRecord->collectValues(Values::CURRENT)))
			{
				return (new WorktimeServiceResult())->setWorktimeRecord($actualRecord);
			}
			$worktimeEvents = $this->getRecordManager()->buildEvents($actualRecord);

			$this->safeRun($this->save($actualRecord, $worktimeEvents));
			if ($result->getSchedule())
			{
				$this->sendNotifications($actualRecord, $result->getSchedule());
			}

			return (new WorktimeServiceResult())
				->setSchedule($result->getSchedule())
				->setWorktimeRecord($actualRecord)
				->setWorktimeEvents($worktimeEvents);
		});
	}

	/**
	 * @param int $userId
	 * @return WorktimeActionList
	 */
	private function buildActionList($userId)
	{
		return $this->actionList->buildPossibleActionsListForUser($userId);
	}

	protected function wrapResultOnException($result)
	{
		return WorktimeServiceResult::createByResult($result);
	}

	/**
	 * @param WorktimeRecord $record
	 * @param WorktimeEvent[] $worktimeEvents
	 * @return Result
	 */
	protected function save($record, $worktimeEvents)
	{
		$res = $this->worktimeRepository->save($record);
		if (!$res->isSuccess())
		{
			foreach ($res->getErrors() as $error)
			{
				if ($error->getCode() === WorktimeEventsManager::ERROR_CODE_CANCEL)
				{
					return WorktimeServiceResult::createWithErrorText('cannot perform this action because it has been canceled by event handler');
				}
			}
			return WorktimeServiceResult::createByResult($res);
		}
		foreach ($worktimeEvents as $worktimeEvent)
		{
			/** @var WorktimeRecordIdStorable $worktimeEvent */
			$worktimeEvent->setRecordId($record->getId());
			$res = $this->worktimeRepository->save($worktimeEvent);
			if (!$res->isSuccess())
			{
				return WorktimeServiceResult::createByResult($res);
			}
		}

		return new WorktimeServiceResult();
	}

	private function sendNotifications(WorktimeRecord $worktimeRecord, Schedule $schedule)
	{
		$this->getRecordManager()->notifyOfAction($worktimeRecord, $schedule);
		$rules = [$schedule->obtainScheduleViolationRules()];
		$personalViolationRules = $this->getPersonalViolationRules($worktimeRecord->getScheduleId(), $worktimeRecord->getUserId());
		if ($personalViolationRules)
		{
			$rules[] = $personalViolationRules;
		}
		$violations = $this->getRecordManager()->buildRecordViolations($worktimeRecord, $schedule, $rules);
		$this->notificationService->sendViolationsNotifications(
			$schedule,
			$violations,
			$worktimeRecord
		);
	}

	/**
	 * @param $recordForm
	 * @param $actions
	 * @return WorktimeServiceResult
	 */
	private function checkActionEligibility($actions)
	{
		$result = new WorktimeServiceResult();
		if (empty($actions))
		{
			return $result->addProhibitedActionError(WorktimeServiceResult::ERROR_FOR_USER);
		}
		if (count($actions) > 1)
		{
			// todo-annabo interface should send schedule/shift id, so we can choose the right action
			return $result->addProhibitedActionError(WorktimeServiceResult::ERROR_FOR_USER);
		}
		/** @var WorktimeAction $action */
		$action = reset($actions);
		$result->setShift($action->getShift());
		$result->setSchedule($action->getSchedule());
		$result->setWorktimeRecord($action->getRecord());
		return $result;
	}

	/**
	 * @return Record\WorktimeManager
	 */
	private function getRecordManager()
	{
		if ($this->recordManager === null)
		{
			if (!$this->recordForm)
			{
				throw new ObjectException(WorktimeRecordForm::class . ' is required');
			}
			$this->recordManager = $this->recordManagerFactory->buildRecordManager($this->recordForm);
		}
		return $this->recordManager;
	}

	private function getPersonalViolationRules($scheduleId, $userId)
	{
		if ($scheduleId > 0 && $userId > 0)
		{
			return $this->violationRulesRepository->findFirstByScheduleIdAndEntityCode($scheduleId, 'U' . $userId);
		}
		return null;
	}
}