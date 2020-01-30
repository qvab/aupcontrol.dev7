<?php
namespace Whatasoft;

use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Disk\Document\CMSOfficeViewerHandler;

class DocumentHandler {
	public function onDocumentHandlerBuildList(Event $event) {
		return new EventResult(
			EventResult::SUCCESS,
			[
				'CODE_NAME' => CMSOfficeViewerHandler::getCode(),
				'CLASS' => CMSOfficeViewerHandler::className(),
			]
		);
	}
}
