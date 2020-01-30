<?
IncludeModuleLangFile(__FILE__);
?>
<?=CAdminMessage::ShowMessage(array("MESSAGE"=>GetMessage("WEBPROSTOR_CORE_NOT_INSTALL"), "HTML"=>true, "TYPE"=>"ERROR"));?>
<a href="/bitrix/admin/update_system_partner.php?addmodule=webprostor.core"><?=GetMessage("WEBPROSTOR_CORE_INSTALL")?></a>