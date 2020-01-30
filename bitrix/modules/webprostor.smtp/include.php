<?
global $DB;
CModule::AddAutoloadClasses(
	"webprostor.smtp",
	array(
		"CWebprostorSmtp" => "classes/general/smtp.php",
		"CWebprostorSmtpSite" => "classes/general/site.php",
		"CWebprostorSmtpLogs" => "classes/".strtolower($DB->type)."/logs.php",
	)
);
?>