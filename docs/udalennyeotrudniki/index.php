<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/docs/shared/index.php");
$APPLICATION->SetTitle("Удаленныеотрудники");
$APPLICATION->AddChainItem($APPLICATION->GetTitle(), "/docs/udalennyeotrudniki/");
?><?$APPLICATION->IncludeComponent(
	"bitrix:disk.common",
	".default",
	Array(
		"SEF_FOLDER" => "/docs/udalennyeotrudniki/",
		"SEF_MODE" => "Y",
		"STORAGE_ID" => "189"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>