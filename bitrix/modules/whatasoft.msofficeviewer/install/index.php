<?php
use Bitrix\Main\EventManager;
use Bitrix\Main\Config\Option;
use Bitrix\Disk\Driver;
use Bitrix\Disk\Document\GoogleViewerHandler;
use Bitrix\Disk\Document\CMSOfficeViewerHandler;

IncludeModuleLangFile(__FILE__);

class whatasoft_msofficeviewer extends CModule {
	var $MODULE_ID = 'whatasoft.msofficeviewer';
	public $MODULE_VERSION;
	public $MODULE_VERSION_DATE;
	public $MODULE_NAME;
	public $MODULE_DESCRIPTION;
	public $PARTNER_NAME;
	public $PARTNER_URI;

	function __construct() {
		include __DIR__ . '/version.php';

		if (!empty($arModuleVersion) && is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
			$this->MODULE_VERSION = $arModuleVersion['VERSION'];
			$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		}

		$this->MODULE_NAME = GetMessage('MSOFFICEVIEWER_MODULE_NAME');
		$this->MODULE_DESCRIPTION = GetMessage('MSOFFICEVIEWER_MODULE_DESCRIPTION');
		$this->PARTNER_NAME = 'whatAsoft';
		$this->PARTNER_URI = 'https://whatasoft.net';
	}

	function InstallEvents($arParams = array()) {
		$eventManager = \Bitrix\Main\EventManager::getInstance();

		$eventManager->registerEventHandler(
			'disk',
			'onDocumentHandlerBuildList',
			$this->MODULE_ID,
			'Whatasoft\\DocumentHandler',
			'onDocumentHandlerBuildList'
		);

		return true;
	}

	function UnInstallEvents() {
		$eventManager = \Bitrix\Main\EventManager::getInstance();

		$eventManager->unRegisterEventHandler(
			'disk',
			'onDocumentHandlerBuildList',
			$this->MODULE_ID,
			'Whatasoft\\DocumentHandler',
			'onDocumentHandlerBuildList'
		);

		return true;
	}

	function DoInstall() {
		$this->InstallEvents();
		RegisterModule($this->MODULE_ID);
	}

	function DoUninstall() {
		\Bitrix\Main\Loader::includeModule($this->MODULE_ID);

		$this->UnInstallEvents();
		UnRegisterModule($this->MODULE_ID);

		$defaultViewer = Option::get(
			Driver::INTERNAL_MODULE_ID,
			'default_viewer_service',
			''
		);

		if ($defaultViewer == CMSOfficeViewerHandler::GetCode()) {
			Option::set(
				Driver::INTERNAL_MODULE_ID,
				'default_viewer_service',
				GoogleViewerHandler::getCode()
			);
		}

		Option::delete($this->MODULE_ID, array('name' => 'msov_use_accessibility_mode'));
	}
}
