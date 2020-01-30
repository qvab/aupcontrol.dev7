<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (!\Bitrix\Main\Loader::includeModule('disk')) {
	return false;
}

CModule::AddAutoloadClasses(
	'whatasoft.msofficeviewer',
	array(
		'Whatasoft\\DocumentHandler' => 'classes/general/documenthandler.php',
		'Bitrix\\Disk\\Document\\CMSOfficeViewerHandler' => 'classes/general/msofficeviewerhandler.php',
	)
);
