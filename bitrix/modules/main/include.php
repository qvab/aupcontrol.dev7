<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2013 Bitrix
 */

require_once(substr(__FILE__, 0, strlen(__FILE__) - strlen("/include.php"))."/bx_root.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/start.php");

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/virtual_io.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/virtual_file.php");

$application = \Bitrix\Main\Application::getInstance();
$application->initializeExtendedKernel(array(
	"get" => $_GET,
	"post" => $_POST,
	"files" => $_FILES,
	"cookie" => $_COOKIE,
	"server" => $_SERVER,
	"env" => $_ENV
));

//define global application object
$GLOBALS["APPLICATION"] = new CMain;

if(defined("SITE_ID"))
	define("LANG", SITE_ID);

if(defined("LANG"))
{
	if(defined("ADMIN_SECTION") && ADMIN_SECTION===true)
		$db_lang = CLangAdmin::GetByID(LANG);
	else
		$db_lang = CLang::GetByID(LANG);

	$arLang = $db_lang->Fetch();

	if(!$arLang)
	{
		throw new \Bitrix\Main\SystemException("Incorrect site: ".LANG.".");
	}
}
else
{
	$arLang = $GLOBALS["APPLICATION"]->GetLang();
	define("LANG", $arLang["LID"]);
}

if($arLang["CULTURE_ID"] == '')
{
	throw new \Bitrix\Main\SystemException("Culture not found, or there are no active sites or languages.");
}

$lang = $arLang["LID"];
if (!defined("SITE_ID"))
	define("SITE_ID", $arLang["LID"]);
define("SITE_DIR", $arLang["DIR"]);
define("SITE_SERVER_NAME", $arLang["SERVER_NAME"]);
define("SITE_CHARSET", $arLang["CHARSET"]);
define("FORMAT_DATE", $arLang["FORMAT_DATE"]);
define("FORMAT_DATETIME", $arLang["FORMAT_DATETIME"]);
define("LANG_DIR", $arLang["DIR"]);
define("LANG_CHARSET", $arLang["CHARSET"]);
define("LANG_ADMIN_LID", $arLang["LANGUAGE_ID"]);
define("LANGUAGE_ID", $arLang["LANGUAGE_ID"]);

$culture = \Bitrix\Main\Localization\CultureTable::getByPrimary($arLang["CULTURE_ID"], ["cache" => ["ttl" => CACHED_b_lang]])->fetchObject();

$context = $application->getContext();
$context->setLanguage(LANGUAGE_ID);
$context->setCulture($culture);

$request = $context->getRequest();
if (!$request->isAdminSection())
{
	$context->setSite(SITE_ID);
}

$application->start();

$GLOBALS["APPLICATION"]->reinitPath();

if (!defined("POST_FORM_ACTION_URI"))
{
	define("POST_FORM_ACTION_URI", htmlspecialcharsbx(GetRequestUri()));
}

$GLOBALS["MESS"] = array();
$GLOBALS["ALL_LANG_FILES"] = array();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/tools.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/database.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/main.php");
IncludeModuleLangFile(__FILE__);

error_reporting(COption::GetOptionInt("main", "error_reporting", E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR|E_PARSE) & ~E_STRICT & ~E_DEPRECATED);

if(!defined("BX_COMP_MANAGED_CACHE") && COption::GetOptionString("main", "component_managed_cache_on", "Y") <> "N")
{
	define("BX_COMP_MANAGED_CACHE", true);
}

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/filter_tools.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/ajax_tools.php");

/*ZDUyZmZZjdhMzBjZDZmODkwZTgzNGYwYmU3YmVhMzdiNDQ1NTU=*/$GLOBALS['_____1966106271']= array(base64_decode(''.'R2V0TW9kdWxlRXZl'.'bn'.'Rz'),base64_decode('RX'.'hl'.'Y3'.'V0ZU'.'1vZHVsZU'.'V'.'2'.'ZW5'.'0RXg='));$GLOBALS['____1935541083']= array(base64_decode('Z'.'GVm'.'aW5l'),base64_decode('c3Ryb'.'GVu'),base64_decode('Y'.'mFzZTY0'.'X2RlY2'.'9kZQ=='),base64_decode('d'.'W'.'5zZXJ'.'pYWxpe'.'mU'.'='),base64_decode('aX'.'NfYX'.'J'.'y'.'YXk='),base64_decode('Y291bnQ='),base64_decode('aW5fYXJyYXk'.'='),base64_decode('c2VyaWF'.'saXpl'),base64_decode(''.'YmFzZTY'.'0X2Vu'.'Y29k'.'ZQ=='),base64_decode('c3RybGVu'),base64_decode('YXJ'.'yYXlf'.'a'.'2V5X'.'2'.'V4aXN0'.'cw='.'='),base64_decode('YXJy'.'YXlf'.'a2V5X'.'2V'.'4aXN0c'.'w=='),base64_decode('bWt'.'0a'.'W1l'),base64_decode('ZGF0ZQ'.'=='),base64_decode(''.'ZGF0ZQ=='),base64_decode('Y'.'XJyYXlfa2V5X2V'.'4'.'aXN0cw=='),base64_decode('c3RybG'.'Vu'),base64_decode('YXJyYXlfa2V5X2'.'V4aX'.'N0c'.'w=='),base64_decode('c3Ryb'.'G'.'Vu'),base64_decode('YXJyYXlf'.'a2'.'V5X2V4aX'.'N'.'0'.'cw'.'=='),base64_decode('YXJyYXlfa'.'2V5X2V4aXN0c'.'w=='),base64_decode('bWt0'.'aW1l'),base64_decode('ZGF0Z'.'Q=='),base64_decode('ZGF0ZQ=='),base64_decode('b'.'W'.'V0aG'.'9kX'.'2V'.'4aXN0'.'cw'.'=='),base64_decode('Y2Fs'.'b'.'F91c2VyX2'.'Z1bmNf'.'YXJyYXk='),base64_decode('c3R'.'ybGV'.'u'),base64_decode('YX'.'J'.'y'.'YXlfa2V5X'.'2V4a'.'XN'.'0c'.'w='.'='),base64_decode('YXJyYXl'.'fa2'.'V5'.'X'.'2V'.'4aXN0cw=='),base64_decode('c2VyaWFsaXpl'),base64_decode('Ym'.'FzZT'.'Y0X'.'2VuY29kZQ=='),base64_decode('c3RybGV'.'u'),base64_decode(''.'YXJyYXlfa2V5X2V4aXN'.'0cw='.'='),base64_decode('YXJ'.'yY'.'Xl'.'fa2V5'.'X'.'2V4aX'.'N0cw=='),base64_decode('YXJyYXlfa2V5X2V4'.'aXN0cw=='),base64_decode('aXNfYXJy'.'YXk='),base64_decode('YXJyYXlf'.'a2V5'.'X2V4a'.'XN'.'0cw=='),base64_decode('c2'.'VyaWFsaXpl'),base64_decode(''.'YmFzZ'.'TY0X'.'2'.'VuY'.'29kZQ'.'=='),base64_decode('YXJy'.'YXlf'.'a2'.'V5X2V4aX'.'N0cw=='),base64_decode(''.'YXJyY'.'Xl'.'fa'.'2V5X2'.'V4aXN0cw=='),base64_decode('c2V'.'y'.'aWFsa'.'Xpl'),base64_decode('YmFz'.'ZT'.'Y0X2'.'VuY29kZ'.'Q=='),base64_decode('aXNfYX'.'JyYXk='),base64_decode('aXNfYXJyYX'.'k='),base64_decode('a'.'W5fY'.'X'.'JyYXk'.'='),base64_decode('YXJyYXl'.'fa2V5X'.'2'.'V4aXN0c'.'w'.'=='),base64_decode('aW5fYX'.'JyYXk='),base64_decode('bWt0aW1l'),base64_decode('ZGF0ZQ='.'='),base64_decode('Z'.'GF0'.'ZQ'.'=='),base64_decode('ZGF0ZQ=='),base64_decode(''.'bWt0aW1l'),base64_decode('ZGF0Z'.'Q='.'='),base64_decode('ZGF'.'0ZQ=='),base64_decode(''.'aW5fYX'.'J'.'yYXk='),base64_decode('YXJy'.'YXlfa'.'2V5'.'X'.'2V4a'.'X'.'N0cw'.'=='),base64_decode('YXJy'.'YXl'.'fa2V'.'5X'.'2V4aXN0cw=='),base64_decode('c'.'2'.'Vy'.'aWFsaXpl'),base64_decode('YmFz'.'ZTY'.'0'.'X2'.'VuY29kZ'.'Q=='),base64_decode('YX'.'JyYX'.'lfa2V5'.'X2V4a'.'X'.'N0c'.'w=='),base64_decode(''.'aW'.'50dmFs'),base64_decode(''.'dG'.'ltZQ=='),base64_decode('YXJyYXl'.'f'.'a2V5X2V4a'.'XN0'.'cw=='),base64_decode(''.'ZmlsZV9le'.'Glzd'.'H'.'M='),base64_decode(''.'c3RyX3J'.'lc'.'GxhY'.'2U'.'='),base64_decode('Y2xhc3'.'NfZXhpc3Rz'),base64_decode('Z'.'GVmaW5'.'l'));if(!function_exists(__NAMESPACE__.'\\___1484842984')){function ___1484842984($_2041802620){static $_1205419613= false; if($_1205419613 == false) $_1205419613=array('SU5UUkFORVRfRURJ'.'VElPTg==','W'.'Q==','bWFpbg==','fmNwZl9t'.'YXB'.'fdmF'.'sd'.'WU'.'=','','ZQ==','Zg'.'==','ZQ==','Rg==','WA==',''.'Z'.'g'.'==','bWF'.'pbg==','fmNw'.'Z'.'l9t'.'Y'.'X'.'Bfdm'.'FsdW'.'U=','UG9ydG'.'Fs','Rg='.'=','Z'.'Q==',''.'ZQ==','W'.'A='.'=','Rg==','R'.'A'.'==','RA'.'==','bQ'.'==','ZA'.'==','WQ==','Zg==','Zg==','Zg='.'=','Zg==','UG9'.'y'.'dGFs','Rg==',''.'ZQ==','ZQ==','WA==',''.'Rg==',''.'RA==','RA==','b'.'Q==',''.'ZA='.'=',''.'WQ'.'==','b'.'WFpbg==','T'.'24=','U'.'2V'.'0'.'dGl'.'uZ3NDaGFuZ'.'2U=',''.'Zg==','Zg'.'='.'=','Zg==','Zg==','b'.'W'.'Fp'.'bg==','fmNwZ'.'l9tYXBfd'.'mF'.'sdWU=','ZQ='.'=',''.'ZQ==','Z'.'Q==',''.'RA==','ZQ==',''.'ZQ==','Zg'.'='.'=','Zg='.'=',''.'Zg'.'==','Z'.'Q==','b'.'WFpb'.'g==','fmNwZ'.'l'.'9tYXBfdmFsdWU=','ZQ==','Zg==',''.'Zg==','Zg'.'='.'=','Zg==','b'.'WF'.'pbg==','f'.'mNwZl9tYX'.'BfdmFsdWU=','ZQ==','Zg==','UG9'.'ydGFs',''.'UG9ydGFs','ZQ==','Z'.'Q==',''.'U'.'G9ydG'.'Fs','Rg==','WA==','Rg='.'=','R'.'A='.'=','ZQ==','ZQ==','R'.'A==',''.'bQ==',''.'ZA==','WQ='.'=','Z'.'Q==','WA='.'=',''.'ZQ==','Rg'.'==',''.'ZQ='.'=','RA==',''.'Zg==','ZQ==','RA==','ZQ==','bQ==','ZA==','W'.'Q==','Zg='.'=','Zg==','Zg'.'='.'=','Zg='.'=','Zg==',''.'Zg==','Zg==',''.'Z'.'g==','bWFpbg==','fmNw'.'Zl9tYXBf'.'dm'.'Fs'.'dWU=','ZQ==','ZQ==','U'.'G9ydG'.'Fs','Rg==','WA==','V'.'Fl'.'QRQ'.'==','R'.'EFURQ'.'==',''.'RkVBVFVSRVM=','R'.'VhQSV'.'JFR'.'A==','VF'.'lQRQ'.'==','RA==','V'.'FJZX'.'0RB'.'WVN'.'fQ0'.'9VTlQ=','REF'.'URQ==','VFJ'.'ZX0RBW'.'VNfQ09VT'.'lQ=','RV'.'hQSVJFR'.'A==','Rk'.'VBVF'.'VSR'.'VM=','Z'.'g'.'='.'=',''.'Zg==','R'.'E9'.'DVU1FTlR'.'fUk9PV'.'A==','L2'.'JpdHJpe'.'C9'.'tb'.'2R1bG'.'VzLw='.'=','L'.'2luc'.'3RhbGwvaW5kZXgucGhw','Lg==','Xw==','c2Vh'.'c'.'mNo','T'.'g==','','','Q'.'UNUSVZF','WQ'.'==','c29jaWFs'.'bmV'.'0d29y'.'aw==','YWx'.'sb3dfZnJp'.'ZWxkcw'.'='.'=',''.'WQ'.'==',''.'SUQ=','c29jaWFsbmV'.'0d29yaw==',''.'YWx'.'sb3dfZnJpZWxkc'.'w==',''.'S'.'UQ=','c2'.'9'.'jaWFsbmV'.'0d'.'29ya'.'w'.'==',''.'YWxsb'.'3d'.'fZnJp'.'ZWxkc'.'w='.'=','Tg'.'==','','','QUNUSV'.'Z'.'F',''.'WQ'.'='.'=',''.'c29j'.'aWFsbm'.'V0d29yaw==',''.'Y'.'W'.'xsb3dfb'.'Wljcm9i'.'bG'.'9'.'nX'.'3Vz'.'ZX'.'I=',''.'WQ==',''.'S'.'UQ=','c29'.'jaWFs'.'bm'.'V0d29ya'.'w==',''.'Y'.'Wxs'.'b3dfbW'.'l'.'jc'.'m9ibG9nX3'.'V'.'zZXI=','SUQ=',''.'c29jaWFsbmV0d'.'29yaw==','YW'.'xsb3d'.'f'.'b'.'Wljc'.'m9'.'ib'.'G9'.'nX'.'3'.'VzZXI=',''.'c29j'.'aWF'.'sbmV0d29yaw='.'=','YWxsb3'.'d'.'fbWljcm9i'.'bG9'.'nX2dyb3Vw','WQ==','SUQ=','c29j'.'aWFsbmV0d29y'.'aw'.'==','YWxsb'.'3d'.'fb'.'Wljcm'.'9i'.'bG9nX2dyb3Vw','SUQ=','c29'.'jaWFsbmV'.'0'.'d'.'29'.'yaw'.'='.'=','YWx'.'sb'.'3d'.'f'.'bWlj'.'cm'.'9ibG9nX2dyb'.'3'.'Vw','T'.'g'.'='.'=','','',''.'QUN'.'USVZF','W'.'Q==','c2'.'9jaWFsbmV'.'0d'.'29yaw==','YW'.'xsb3dfZ'.'mlsZXNfd'.'X'.'Nlcg==','WQ==','SUQ'.'=',''.'c29jaWFsbmV0d29'.'yaw==','YWxsb3d'.'f'.'Zmls'.'ZXN'.'fdXN'.'l'.'cg==','SUQ=','c'.'29j'.'aWFsbmV'.'0'.'d29yaw='.'=','YWxsb3dfZmlsZXNfdXNlcg==','T'.'g==','','','Q'.'U'.'NUSVZF',''.'WQ==','c'.'29jaWFs'.'bm'.'V0d29'.'yaw==','YWxsb3'.'dfYm'.'xv'.'Z'.'191'.'c2Vy',''.'WQ==','SUQ'.'=',''.'c29'.'jaWFsbmV'.'0'.'d29yaw==','Y'.'W'.'x'.'sb3d'.'fYmx'.'vZ191c2Vy','SUQ'.'=','c29jaW'.'FsbmV0d'.'29'.'y'.'aw='.'=','YWx'.'s'.'b3'.'dfY'.'m'.'x'.'vZ191c2'.'Vy','Tg'.'==','','','Q'.'UNUS'.'VZF',''.'WQ==',''.'c29ja'.'WFs'.'bmV0'.'d29yaw==',''.'YWx'.'sb'.'3dfcG'.'hvdG9fdXNl'.'cg==','W'.'Q'.'==',''.'SUQ=','c2'.'9jaWFsbmV0d29yaw==','YWxsb3df'.'cG'.'hvdG9fd'.'X'.'Nlc'.'g='.'=','SUQ=',''.'c29'.'jaW'.'F'.'sbm'.'V0'.'d29'.'yaw='.'=','YW'.'xsb3d'.'fc'.'G'.'hvdG9'.'f'.'dX'.'Nlcg='.'=','Tg==','','','QUNUSVZF','WQ==','c29jaWFsbmV0d29y'.'aw==',''.'Y'.'Wx'.'sb3d'.'fZm9ydW1f'.'dXNlcg='.'=',''.'W'.'Q'.'==','SUQ=','c29j'.'aWFs'.'bmV0d29yaw==','Y'.'Wxsb3dfZm9y'.'dW1f'.'dXNl'.'cg==',''.'SU'.'Q=','c29jaWFsbmV'.'0d'.'29y'.'aw==','YW'.'x'.'sb3dfZm9ydW1f'.'dXN'.'lcg==','T'.'g==','','','QUNUSVZF','W'.'Q='.'=','c2'.'9j'.'aWF'.'sbmV'.'0'.'d'.'29yaw==','YWxs'.'b3'.'df'.'d'.'GFza3NfdXNlcg==','WQ==','SUQ'.'=','c'.'29jaW'.'Fsb'.'mV0d'.'29ya'.'w==','YW'.'xsb3dfdGFz'.'a3NfdXN'.'lcg==','SUQ=','c29jaWF'.'sbm'.'V'.'0d29yaw==','YW'.'xsb3dfdG'.'F'.'z'.'a'.'3NfdXN'.'lcg'.'==','c29ja'.'WFsb'.'mV0d29yaw==',''.'Y'.'Wxs'.'b3'.'df'.'dGFz'.'a3Nf'.'Z3JvdXA=','WQ'.'==','S'.'UQ=',''.'c'.'29j'.'a'.'WFsbmV0d2'.'9'.'yaw==','YWxsb3'.'d'.'fdGFza3NfZ3JvdXA=',''.'S'.'UQ=',''.'c29'.'jaWFsbm'.'V0d29'.'y'.'aw='.'=','Y'.'Wxsb'.'3d'.'fdGFza3NfZ3'.'JvdXA=','dGFza3'.'M=','Tg==','','','Q'.'U'.'NUSVZF','WQ==',''.'c2'.'9j'.'aWFs'.'bmV0d29yaw='.'=',''.'Y'.'Wxsb'.'3d'.'fY'.'2'.'FsZ'.'W5k'.'YXJfdXN'.'lcg==',''.'WQ='.'=','SUQ=','c'.'2'.'9jaWFsbmV0'.'d29yaw==','YWxs'.'b3'.'dfY'.'2FsZW5k'.'YXJfdXN'.'lcg'.'==','SU'.'Q=','c29ja'.'WFsb'.'mV'.'0d29yaw==','YWxsb3d'.'fY2FsZ'.'W5'.'kYXJfd'.'XNlcg==','c29jaW'.'FsbmV'.'0d'.'29yaw='.'=','YWxsb3d'.'fY2FsZ'.'W5kYXJfZ3JvdXA=','W'.'Q='.'=',''.'SUQ=','c2'.'9j'.'a'.'WFsbmV0d29yaw==',''.'YWxsb'.'3'.'dfY'.'2FsZ'.'W5k'.'YXJf'.'Z3JvdXA=','SUQ'.'=','c29ja'.'WF'.'sbmV'.'0'.'d29yaw==','YWxs'.'b3df'.'Y2'.'FsZW5k'.'YXJfZ3Jvd'.'XA'.'=','Q'.'UN'.'USV'.'ZF','WQ==','Tg==','Z'.'Xh0c'.'mFuZX'.'Q=','aW'.'J'.'s'.'b2Nr','T25BZnRlcklCbG9ja0VsZW'.'1lbnRVcG'.'Rh'.'dGU=','aW'.'50cmFuZ'.'XQ'.'=','Q'.'0'.'lud'.'H'.'Jhbm'.'V'.'0RXZl'.'bnRIYW5kbGVycw==','U1BSZWd'.'pc3Rlc'.'lVwZG'.'F0ZW'.'R'.'JdGV'.'t','Q0l'.'udHJhbmV0U2'.'hhcm'.'Vwb2l'.'u'.'dD'.'o6'.'QWdl'.'bnR'.'MaXN0'.'cyg'.'pOw==','a'.'W5'.'0cmFuZX'.'Q=','Tg==',''.'Q0lud'.'HJh'.'bmV0U2'.'hhcm'.'Vwb2'.'ludDo6QWdlbnRRdWV1Z'.'Sgp'.'Ow==','aW50c'.'mFu'.'ZXQ=','T'.'g==',''.'Q0lu'.'d'.'HJ'.'hbmV0U2'.'hh'.'cm'.'V'.'wb2ludDo6'.'QWdlbnRVcGRhdGUo'.'KT'.'s=','a'.'W50cmF'.'uZXQ=','T'.'g='.'=','aWJ'.'sb2Nr',''.'T'.'25B'.'ZnRlcklCbG9ja0VsZW1lbnRBZ'.'GQ=','aW5'.'0cmFuZXQ=',''.'Q'.'0lu'.'d'.'HJhb'.'m'.'V0'.'R'.'XZ'.'l'.'bnRIYW5'.'k'.'bGVycw==','U'.'1B'.'S'.'ZWdpc3'.'R'.'lclVwZGF0ZWRJdGVt','aWJsb2Nr','T2'.'5BZ'.'nRl'.'cklCbG'.'9ja0VsZ'.'W1lb'.'nRV'.'cG'.'RhdGU'.'=','aW50cmFuZ'.'X'.'Q=','Q0ludHJhb'.'mV0R'.'XZ'.'lbnRIY'.'W'.'5kb'.'GV'.'ycw==','U'.'1B'.'SZ'.'Wdpc3Rlc'.'lVwZGF0ZWRJdGVt',''.'Q0lu'.'dHJhbmV0U2hhcmVwb2ludDo'.'6QWdlbnRMa'.'XN0cy'.'gpOw==','aW50cmFu'.'ZXQ=','Q0lud'.'H'.'Jh'.'b'.'mV0'.'U2hh'.'cmVwb2lu'.'dDo6QWd'.'lb'.'n'.'RR'.'dWV1Z'.'SgpO'.'w==','a'.'W'.'50cmF'.'uZX'.'Q=','Q0'.'lud'.'HJhbmV0'.'U2h'.'hcmV'.'wb2'.'lu'.'dDo6'.'QWdlbnRVcGRhdGUoKT'.'s=','aW50cmFuZXQ=',''.'Y3J'.'t',''.'bWFpbg'.'==',''.'T25CZW'.'Zvcm'.'VQcm9sb2c=','bWF'.'pbg='.'=','Q1dp'.'emFyZFNv'.'b'.'FBhb'.'mVsSW5'.'0cmFuZX'.'Q=','U2h'.'v'.'d'.'1BhbmV'.'s','L'.'2'.'1'.'v'.'ZHVsZXMvaW5'.'0cmFuZX'.'QvcGFuZWxfYn'.'V'.'0d'.'G9uL'.'n'.'B'.'ocA='.'=','R'.'U'.'5'.'DT0R'.'F','WQ='.'=');return base64_decode($_1205419613[$_2041802620]);}};$GLOBALS['____1935541083'][0](___1484842984(0), ___1484842984(1));class CBXFeatures{ private static $_429063019= 30; private static $_287011106= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller",), "Holding" => array( "Cluster", "MultiSites",),); private static $_1749650403= false; private static $_261620069= false; private static function __487821370(){ if(self::$_1749650403 == false){ self::$_1749650403= array(); foreach(self::$_287011106 as $_1370846145 => $_1442302369){ foreach($_1442302369 as $_1683912120) self::$_1749650403[$_1683912120]= $_1370846145;}} if(self::$_261620069 == false){ self::$_261620069= array(); $_1658626588= COption::GetOptionString(___1484842984(2), ___1484842984(3), ___1484842984(4)); if($GLOBALS['____1935541083'][1]($_1658626588)> min(30,0,10)){ $_1658626588= $GLOBALS['____1935541083'][2]($_1658626588); self::$_261620069= $GLOBALS['____1935541083'][3]($_1658626588); if(!$GLOBALS['____1935541083'][4](self::$_261620069)) self::$_261620069= array();} if($GLOBALS['____1935541083'][5](self::$_261620069) <=(198*2-396)) self::$_261620069= array(___1484842984(5) => array(), ___1484842984(6) => array());}} public static function InitiateEditionsSettings($_440534744){ self::__487821370(); $_255104703= array(); foreach(self::$_287011106 as $_1370846145 => $_1442302369){ $_1646117837= $GLOBALS['____1935541083'][6]($_1370846145, $_440534744); self::$_261620069[___1484842984(7)][$_1370846145]=($_1646117837? array(___1484842984(8)): array(___1484842984(9))); foreach($_1442302369 as $_1683912120){ self::$_261620069[___1484842984(10)][$_1683912120]= $_1646117837; if(!$_1646117837) $_255104703[]= array($_1683912120, false);}} $_129396862= $GLOBALS['____1935541083'][7](self::$_261620069); $_129396862= $GLOBALS['____1935541083'][8]($_129396862); COption::SetOptionString(___1484842984(11), ___1484842984(12), $_129396862); foreach($_255104703 as $_809616018) self::__1818541799($_809616018[(1456/2-728)], $_809616018[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function IsFeatureEnabled($_1683912120){ if($GLOBALS['____1935541083'][9]($_1683912120) <= 0) return true; self::__487821370(); if(!$GLOBALS['____1935541083'][10]($_1683912120, self::$_1749650403)) return true; if(self::$_1749650403[$_1683912120] == ___1484842984(13)) $_1730445769= array(___1484842984(14)); elseif($GLOBALS['____1935541083'][11](self::$_1749650403[$_1683912120], self::$_261620069[___1484842984(15)])) $_1730445769= self::$_261620069[___1484842984(16)][self::$_1749650403[$_1683912120]]; else $_1730445769= array(___1484842984(17)); if($_1730445769[(968-2*484)] != ___1484842984(18) && $_1730445769[min(176,0,58.666666666667)] != ___1484842984(19)){ return false;} elseif($_1730445769[(241*2-482)] == ___1484842984(20)){ if($_1730445769[round(0+1)]< $GLOBALS['____1935541083'][12](min(68,0,22.666666666667),(954-2*477), min(94,0,31.333333333333), Date(___1484842984(21)), $GLOBALS['____1935541083'][13](___1484842984(22))- self::$_429063019, $GLOBALS['____1935541083'][14](___1484842984(23)))){ if(!isset($_1730445769[round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) ||!$_1730445769[round(0+0.4+0.4+0.4+0.4+0.4)]) self::__734646101(self::$_1749650403[$_1683912120]); return false;}} return!$GLOBALS['____1935541083'][15]($_1683912120, self::$_261620069[___1484842984(24)]) || self::$_261620069[___1484842984(25)][$_1683912120];} public static function IsFeatureInstalled($_1683912120){ if($GLOBALS['____1935541083'][16]($_1683912120) <= 0) return true; self::__487821370(); return($GLOBALS['____1935541083'][17]($_1683912120, self::$_261620069[___1484842984(26)]) && self::$_261620069[___1484842984(27)][$_1683912120]);} public static function IsFeatureEditable($_1683912120){ if($GLOBALS['____1935541083'][18]($_1683912120) <= 0) return true; self::__487821370(); if(!$GLOBALS['____1935541083'][19]($_1683912120, self::$_1749650403)) return true; if(self::$_1749650403[$_1683912120] == ___1484842984(28)) $_1730445769= array(___1484842984(29)); elseif($GLOBALS['____1935541083'][20](self::$_1749650403[$_1683912120], self::$_261620069[___1484842984(30)])) $_1730445769= self::$_261620069[___1484842984(31)][self::$_1749650403[$_1683912120]]; else $_1730445769= array(___1484842984(32)); if($_1730445769[min(132,0,44)] != ___1484842984(33) && $_1730445769[min(8,0,2.6666666666667)] != ___1484842984(34)){ return false;} elseif($_1730445769[(1400/2-700)] == ___1484842984(35)){ if($_1730445769[round(0+0.5+0.5)]< $GLOBALS['____1935541083'][21](min(224,0,74.666666666667),(1128/2-564), min(154,0,51.333333333333), Date(___1484842984(36)), $GLOBALS['____1935541083'][22](___1484842984(37))- self::$_429063019, $GLOBALS['____1935541083'][23](___1484842984(38)))){ if(!isset($_1730445769[round(0+0.4+0.4+0.4+0.4+0.4)]) ||!$_1730445769[round(0+0.4+0.4+0.4+0.4+0.4)]) self::__734646101(self::$_1749650403[$_1683912120]); return false;}} return true;} private static function __1818541799($_1683912120, $_1087941387){ if($GLOBALS['____1935541083'][24]("CBXFeatures", "On".$_1683912120."SettingsChange")) $GLOBALS['____1935541083'][25](array("CBXFeatures", "On".$_1683912120."SettingsChange"), array($_1683912120, $_1087941387)); $_954563251= $GLOBALS['_____1966106271'][0](___1484842984(39), ___1484842984(40).$_1683912120.___1484842984(41)); while($_2142037097= $_954563251->Fetch()) $GLOBALS['_____1966106271'][1]($_2142037097, array($_1683912120, $_1087941387));} public static function SetFeatureEnabled($_1683912120, $_1087941387= true, $_1497657214= true){ if($GLOBALS['____1935541083'][26]($_1683912120) <= 0) return; if(!self::IsFeatureEditable($_1683912120)) $_1087941387= false; $_1087941387=($_1087941387? true: false); self::__487821370(); $_286988812=(!$GLOBALS['____1935541083'][27]($_1683912120, self::$_261620069[___1484842984(42)]) && $_1087941387 || $GLOBALS['____1935541083'][28]($_1683912120, self::$_261620069[___1484842984(43)]) && $_1087941387 != self::$_261620069[___1484842984(44)][$_1683912120]); self::$_261620069[___1484842984(45)][$_1683912120]= $_1087941387; $_129396862= $GLOBALS['____1935541083'][29](self::$_261620069); $_129396862= $GLOBALS['____1935541083'][30]($_129396862); COption::SetOptionString(___1484842984(46), ___1484842984(47), $_129396862); if($_286988812 && $_1497657214) self::__1818541799($_1683912120, $_1087941387);} private static function __734646101($_1370846145){ if($GLOBALS['____1935541083'][31]($_1370846145) <= 0 || $_1370846145 == "Portal") return; self::__487821370(); if(!$GLOBALS['____1935541083'][32]($_1370846145, self::$_261620069[___1484842984(48)]) || $GLOBALS['____1935541083'][33]($_1370846145, self::$_261620069[___1484842984(49)]) && self::$_261620069[___1484842984(50)][$_1370846145][(172*2-344)] != ___1484842984(51)) return; if(isset(self::$_261620069[___1484842984(52)][$_1370846145][round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) && self::$_261620069[___1484842984(53)][$_1370846145][round(0+1+1)]) return; $_255104703= array(); if($GLOBALS['____1935541083'][34]($_1370846145, self::$_287011106) && $GLOBALS['____1935541083'][35](self::$_287011106[$_1370846145])){ foreach(self::$_287011106[$_1370846145] as $_1683912120){ if($GLOBALS['____1935541083'][36]($_1683912120, self::$_261620069[___1484842984(54)]) && self::$_261620069[___1484842984(55)][$_1683912120]){ self::$_261620069[___1484842984(56)][$_1683912120]= false; $_255104703[]= array($_1683912120, false);}} self::$_261620069[___1484842984(57)][$_1370846145][round(0+1+1)]= true;} $_129396862= $GLOBALS['____1935541083'][37](self::$_261620069); $_129396862= $GLOBALS['____1935541083'][38]($_129396862); COption::SetOptionString(___1484842984(58), ___1484842984(59), $_129396862); foreach($_255104703 as $_809616018) self::__1818541799($_809616018[(764-2*382)], $_809616018[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function ModifyFeaturesSettings($_440534744, $_1442302369){ self::__487821370(); foreach($_440534744 as $_1370846145 => $_784018774) self::$_261620069[___1484842984(60)][$_1370846145]= $_784018774; $_255104703= array(); foreach($_1442302369 as $_1683912120 => $_1087941387){ if(!$GLOBALS['____1935541083'][39]($_1683912120, self::$_261620069[___1484842984(61)]) && $_1087941387 || $GLOBALS['____1935541083'][40]($_1683912120, self::$_261620069[___1484842984(62)]) && $_1087941387 != self::$_261620069[___1484842984(63)][$_1683912120]) $_255104703[]= array($_1683912120, $_1087941387); self::$_261620069[___1484842984(64)][$_1683912120]= $_1087941387;} $_129396862= $GLOBALS['____1935541083'][41](self::$_261620069); $_129396862= $GLOBALS['____1935541083'][42]($_129396862); COption::SetOptionString(___1484842984(65), ___1484842984(66), $_129396862); self::$_261620069= false; foreach($_255104703 as $_809616018) self::__1818541799($_809616018[(930-2*465)], $_809616018[round(0+0.5+0.5)]);} public static function SaveFeaturesSettings($_1220267249, $_2104323558){ self::__487821370(); $_474995730= array(___1484842984(67) => array(), ___1484842984(68) => array()); if(!$GLOBALS['____1935541083'][43]($_1220267249)) $_1220267249= array(); if(!$GLOBALS['____1935541083'][44]($_2104323558)) $_2104323558= array(); if(!$GLOBALS['____1935541083'][45](___1484842984(69), $_1220267249)) $_1220267249[]= ___1484842984(70); foreach(self::$_287011106 as $_1370846145 => $_1442302369){ if($GLOBALS['____1935541083'][46]($_1370846145, self::$_261620069[___1484842984(71)])) $_1800482692= self::$_261620069[___1484842984(72)][$_1370846145]; else $_1800482692=($_1370846145 == ___1484842984(73))? array(___1484842984(74)): array(___1484842984(75)); if($_1800482692[min(6,0,2)] == ___1484842984(76) || $_1800482692[(1388/2-694)] == ___1484842984(77)){ $_474995730[___1484842984(78)][$_1370846145]= $_1800482692;} else{ if($GLOBALS['____1935541083'][47]($_1370846145, $_1220267249)) $_474995730[___1484842984(79)][$_1370846145]= array(___1484842984(80), $GLOBALS['____1935541083'][48](min(110,0,36.666666666667), min(74,0,24.666666666667),(182*2-364), $GLOBALS['____1935541083'][49](___1484842984(81)), $GLOBALS['____1935541083'][50](___1484842984(82)), $GLOBALS['____1935541083'][51](___1484842984(83)))); else $_474995730[___1484842984(84)][$_1370846145]= array(___1484842984(85));}} $_255104703= array(); foreach(self::$_1749650403 as $_1683912120 => $_1370846145){ if($_474995730[___1484842984(86)][$_1370846145][(874-2*437)] != ___1484842984(87) && $_474995730[___1484842984(88)][$_1370846145][min(94,0,31.333333333333)] != ___1484842984(89)){ $_474995730[___1484842984(90)][$_1683912120]= false;} else{ if($_474995730[___1484842984(91)][$_1370846145][(924-2*462)] == ___1484842984(92) && $_474995730[___1484842984(93)][$_1370846145][round(0+0.2+0.2+0.2+0.2+0.2)]< $GLOBALS['____1935541083'][52]((826-2*413),(908-2*454),(844-2*422), Date(___1484842984(94)), $GLOBALS['____1935541083'][53](___1484842984(95))- self::$_429063019, $GLOBALS['____1935541083'][54](___1484842984(96)))) $_474995730[___1484842984(97)][$_1683912120]= false; else $_474995730[___1484842984(98)][$_1683912120]= $GLOBALS['____1935541083'][55]($_1683912120, $_2104323558); if(!$GLOBALS['____1935541083'][56]($_1683912120, self::$_261620069[___1484842984(99)]) && $_474995730[___1484842984(100)][$_1683912120] || $GLOBALS['____1935541083'][57]($_1683912120, self::$_261620069[___1484842984(101)]) && $_474995730[___1484842984(102)][$_1683912120] != self::$_261620069[___1484842984(103)][$_1683912120]) $_255104703[]= array($_1683912120, $_474995730[___1484842984(104)][$_1683912120]);}} $_129396862= $GLOBALS['____1935541083'][58]($_474995730); $_129396862= $GLOBALS['____1935541083'][59]($_129396862); COption::SetOptionString(___1484842984(105), ___1484842984(106), $_129396862); self::$_261620069= false; foreach($_255104703 as $_809616018) self::__1818541799($_809616018[(754-2*377)], $_809616018[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function GetFeaturesList(){ self::__487821370(); $_405123567= array(); foreach(self::$_287011106 as $_1370846145 => $_1442302369){ if($GLOBALS['____1935541083'][60]($_1370846145, self::$_261620069[___1484842984(107)])) $_1800482692= self::$_261620069[___1484842984(108)][$_1370846145]; else $_1800482692=($_1370846145 == ___1484842984(109))? array(___1484842984(110)): array(___1484842984(111)); $_405123567[$_1370846145]= array( ___1484842984(112) => $_1800482692[(934-2*467)], ___1484842984(113) => $_1800482692[round(0+0.25+0.25+0.25+0.25)], ___1484842984(114) => array(),); $_405123567[$_1370846145][___1484842984(115)]= false; if($_405123567[$_1370846145][___1484842984(116)] == ___1484842984(117)){ $_405123567[$_1370846145][___1484842984(118)]= $GLOBALS['____1935541083'][61](($GLOBALS['____1935541083'][62]()- $_405123567[$_1370846145][___1484842984(119)])/ round(0+43200+43200)); if($_405123567[$_1370846145][___1484842984(120)]> self::$_429063019) $_405123567[$_1370846145][___1484842984(121)]= true;} foreach($_1442302369 as $_1683912120) $_405123567[$_1370846145][___1484842984(122)][$_1683912120]=(!$GLOBALS['____1935541083'][63]($_1683912120, self::$_261620069[___1484842984(123)]) || self::$_261620069[___1484842984(124)][$_1683912120]);} return $_405123567;} private static function __1169138601($_1105614328, $_1052373193){ if(IsModuleInstalled($_1105614328) == $_1052373193) return true; $_936489965= $_SERVER[___1484842984(125)].___1484842984(126).$_1105614328.___1484842984(127); if(!$GLOBALS['____1935541083'][64]($_936489965)) return false; include_once($_936489965); $_1534481160= $GLOBALS['____1935541083'][65](___1484842984(128), ___1484842984(129), $_1105614328); if(!$GLOBALS['____1935541083'][66]($_1534481160)) return false; $_189620655= new $_1534481160; if($_1052373193){ if(!$_189620655->InstallDB()) return false; $_189620655->InstallEvents(); if(!$_189620655->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___1484842984(130))) CSearch::DeleteIndex($_1105614328); UnRegisterModule($_1105614328);} return true;} protected static function OnRequestsSettingsChange($_1683912120, $_1087941387){ self::__1169138601("form", $_1087941387);} protected static function OnLearningSettingsChange($_1683912120, $_1087941387){ self::__1169138601("learning", $_1087941387);} protected static function OnJabberSettingsChange($_1683912120, $_1087941387){ self::__1169138601("xmpp", $_1087941387);} protected static function OnVideoConferenceSettingsChange($_1683912120, $_1087941387){ self::__1169138601("video", $_1087941387);} protected static function OnBizProcSettingsChange($_1683912120, $_1087941387){ self::__1169138601("bizprocdesigner", $_1087941387);} protected static function OnListsSettingsChange($_1683912120, $_1087941387){ self::__1169138601("lists", $_1087941387);} protected static function OnWikiSettingsChange($_1683912120, $_1087941387){ self::__1169138601("wiki", $_1087941387);} protected static function OnSupportSettingsChange($_1683912120, $_1087941387){ self::__1169138601("support", $_1087941387);} protected static function OnControllerSettingsChange($_1683912120, $_1087941387){ self::__1169138601("controller", $_1087941387);} protected static function OnAnalyticsSettingsChange($_1683912120, $_1087941387){ self::__1169138601("statistic", $_1087941387);} protected static function OnVoteSettingsChange($_1683912120, $_1087941387){ self::__1169138601("vote", $_1087941387);} protected static function OnFriendsSettingsChange($_1683912120, $_1087941387){ if($_1087941387) $_1048292= "Y"; else $_1048292= ___1484842984(131); $_190877959= CSite::GetList(($_1646117837= ___1484842984(132)),($_358368244= ___1484842984(133)), array(___1484842984(134) => ___1484842984(135))); while($_226175465= $_190877959->Fetch()){ if(COption::GetOptionString(___1484842984(136), ___1484842984(137), ___1484842984(138), $_226175465[___1484842984(139)]) != $_1048292){ COption::SetOptionString(___1484842984(140), ___1484842984(141), $_1048292, false, $_226175465[___1484842984(142)]); COption::SetOptionString(___1484842984(143), ___1484842984(144), $_1048292);}}} protected static function OnMicroBlogSettingsChange($_1683912120, $_1087941387){ if($_1087941387) $_1048292= "Y"; else $_1048292= ___1484842984(145); $_190877959= CSite::GetList(($_1646117837= ___1484842984(146)),($_358368244= ___1484842984(147)), array(___1484842984(148) => ___1484842984(149))); while($_226175465= $_190877959->Fetch()){ if(COption::GetOptionString(___1484842984(150), ___1484842984(151), ___1484842984(152), $_226175465[___1484842984(153)]) != $_1048292){ COption::SetOptionString(___1484842984(154), ___1484842984(155), $_1048292, false, $_226175465[___1484842984(156)]); COption::SetOptionString(___1484842984(157), ___1484842984(158), $_1048292);} if(COption::GetOptionString(___1484842984(159), ___1484842984(160), ___1484842984(161), $_226175465[___1484842984(162)]) != $_1048292){ COption::SetOptionString(___1484842984(163), ___1484842984(164), $_1048292, false, $_226175465[___1484842984(165)]); COption::SetOptionString(___1484842984(166), ___1484842984(167), $_1048292);}}} protected static function OnPersonalFilesSettingsChange($_1683912120, $_1087941387){ if($_1087941387) $_1048292= "Y"; else $_1048292= ___1484842984(168); $_190877959= CSite::GetList(($_1646117837= ___1484842984(169)),($_358368244= ___1484842984(170)), array(___1484842984(171) => ___1484842984(172))); while($_226175465= $_190877959->Fetch()){ if(COption::GetOptionString(___1484842984(173), ___1484842984(174), ___1484842984(175), $_226175465[___1484842984(176)]) != $_1048292){ COption::SetOptionString(___1484842984(177), ___1484842984(178), $_1048292, false, $_226175465[___1484842984(179)]); COption::SetOptionString(___1484842984(180), ___1484842984(181), $_1048292);}}} protected static function OnPersonalBlogSettingsChange($_1683912120, $_1087941387){ if($_1087941387) $_1048292= "Y"; else $_1048292= ___1484842984(182); $_190877959= CSite::GetList(($_1646117837= ___1484842984(183)),($_358368244= ___1484842984(184)), array(___1484842984(185) => ___1484842984(186))); while($_226175465= $_190877959->Fetch()){ if(COption::GetOptionString(___1484842984(187), ___1484842984(188), ___1484842984(189), $_226175465[___1484842984(190)]) != $_1048292){ COption::SetOptionString(___1484842984(191), ___1484842984(192), $_1048292, false, $_226175465[___1484842984(193)]); COption::SetOptionString(___1484842984(194), ___1484842984(195), $_1048292);}}} protected static function OnPersonalPhotoSettingsChange($_1683912120, $_1087941387){ if($_1087941387) $_1048292= "Y"; else $_1048292= ___1484842984(196); $_190877959= CSite::GetList(($_1646117837= ___1484842984(197)),($_358368244= ___1484842984(198)), array(___1484842984(199) => ___1484842984(200))); while($_226175465= $_190877959->Fetch()){ if(COption::GetOptionString(___1484842984(201), ___1484842984(202), ___1484842984(203), $_226175465[___1484842984(204)]) != $_1048292){ COption::SetOptionString(___1484842984(205), ___1484842984(206), $_1048292, false, $_226175465[___1484842984(207)]); COption::SetOptionString(___1484842984(208), ___1484842984(209), $_1048292);}}} protected static function OnPersonalForumSettingsChange($_1683912120, $_1087941387){ if($_1087941387) $_1048292= "Y"; else $_1048292= ___1484842984(210); $_190877959= CSite::GetList(($_1646117837= ___1484842984(211)),($_358368244= ___1484842984(212)), array(___1484842984(213) => ___1484842984(214))); while($_226175465= $_190877959->Fetch()){ if(COption::GetOptionString(___1484842984(215), ___1484842984(216), ___1484842984(217), $_226175465[___1484842984(218)]) != $_1048292){ COption::SetOptionString(___1484842984(219), ___1484842984(220), $_1048292, false, $_226175465[___1484842984(221)]); COption::SetOptionString(___1484842984(222), ___1484842984(223), $_1048292);}}} protected static function OnTasksSettingsChange($_1683912120, $_1087941387){ if($_1087941387) $_1048292= "Y"; else $_1048292= ___1484842984(224); $_190877959= CSite::GetList(($_1646117837= ___1484842984(225)),($_358368244= ___1484842984(226)), array(___1484842984(227) => ___1484842984(228))); while($_226175465= $_190877959->Fetch()){ if(COption::GetOptionString(___1484842984(229), ___1484842984(230), ___1484842984(231), $_226175465[___1484842984(232)]) != $_1048292){ COption::SetOptionString(___1484842984(233), ___1484842984(234), $_1048292, false, $_226175465[___1484842984(235)]); COption::SetOptionString(___1484842984(236), ___1484842984(237), $_1048292);} if(COption::GetOptionString(___1484842984(238), ___1484842984(239), ___1484842984(240), $_226175465[___1484842984(241)]) != $_1048292){ COption::SetOptionString(___1484842984(242), ___1484842984(243), $_1048292, false, $_226175465[___1484842984(244)]); COption::SetOptionString(___1484842984(245), ___1484842984(246), $_1048292);}} self::__1169138601(___1484842984(247), $_1087941387);} protected static function OnCalendarSettingsChange($_1683912120, $_1087941387){ if($_1087941387) $_1048292= "Y"; else $_1048292= ___1484842984(248); $_190877959= CSite::GetList(($_1646117837= ___1484842984(249)),($_358368244= ___1484842984(250)), array(___1484842984(251) => ___1484842984(252))); while($_226175465= $_190877959->Fetch()){ if(COption::GetOptionString(___1484842984(253), ___1484842984(254), ___1484842984(255), $_226175465[___1484842984(256)]) != $_1048292){ COption::SetOptionString(___1484842984(257), ___1484842984(258), $_1048292, false, $_226175465[___1484842984(259)]); COption::SetOptionString(___1484842984(260), ___1484842984(261), $_1048292);} if(COption::GetOptionString(___1484842984(262), ___1484842984(263), ___1484842984(264), $_226175465[___1484842984(265)]) != $_1048292){ COption::SetOptionString(___1484842984(266), ___1484842984(267), $_1048292, false, $_226175465[___1484842984(268)]); COption::SetOptionString(___1484842984(269), ___1484842984(270), $_1048292);}}} protected static function OnSMTPSettingsChange($_1683912120, $_1087941387){ self::__1169138601("mail", $_1087941387);} protected static function OnExtranetSettingsChange($_1683912120, $_1087941387){ $_574111881= COption::GetOptionString("extranet", "extranet_site", ""); if($_574111881){ $_10473171= new CSite; $_10473171->Update($_574111881, array(___1484842984(271) =>($_1087941387? ___1484842984(272): ___1484842984(273))));} self::__1169138601(___1484842984(274), $_1087941387);} protected static function OnDAVSettingsChange($_1683912120, $_1087941387){ self::__1169138601("dav", $_1087941387);} protected static function OntimemanSettingsChange($_1683912120, $_1087941387){ self::__1169138601("timeman", $_1087941387);} protected static function Onintranet_sharepointSettingsChange($_1683912120, $_1087941387){ if($_1087941387){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___1484842984(275), ___1484842984(276), ___1484842984(277), ___1484842984(278), ___1484842984(279)); CAgent::AddAgent(___1484842984(280), ___1484842984(281), ___1484842984(282), round(0+250+250)); CAgent::AddAgent(___1484842984(283), ___1484842984(284), ___1484842984(285), round(0+60+60+60+60+60)); CAgent::AddAgent(___1484842984(286), ___1484842984(287), ___1484842984(288), round(0+1200+1200+1200));} else{ UnRegisterModuleDependences(___1484842984(289), ___1484842984(290), ___1484842984(291), ___1484842984(292), ___1484842984(293)); UnRegisterModuleDependences(___1484842984(294), ___1484842984(295), ___1484842984(296), ___1484842984(297), ___1484842984(298)); CAgent::RemoveAgent(___1484842984(299), ___1484842984(300)); CAgent::RemoveAgent(___1484842984(301), ___1484842984(302)); CAgent::RemoveAgent(___1484842984(303), ___1484842984(304));}} protected static function OncrmSettingsChange($_1683912120, $_1087941387){ if($_1087941387) COption::SetOptionString("crm", "form_features", "Y"); self::__1169138601(___1484842984(305), $_1087941387);} protected static function OnClusterSettingsChange($_1683912120, $_1087941387){ self::__1169138601("cluster", $_1087941387);} protected static function OnMultiSitesSettingsChange($_1683912120, $_1087941387){ if($_1087941387) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___1484842984(306), ___1484842984(307), ___1484842984(308), ___1484842984(309), ___1484842984(310), ___1484842984(311));} protected static function OnIdeaSettingsChange($_1683912120, $_1087941387){ self::__1169138601("idea", $_1087941387);} protected static function OnMeetingSettingsChange($_1683912120, $_1087941387){ self::__1169138601("meeting", $_1087941387);} protected static function OnXDImportSettingsChange($_1683912120, $_1087941387){ self::__1169138601("xdimport", $_1087941387);}} $GLOBALS['____1935541083'][67](___1484842984(312), ___1484842984(313));/**/			//Do not remove this

//component 2.0 template engines
$GLOBALS["arCustomTemplateEngines"] = array();

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/urlrewriter.php");

/**
 * Defined in dbconn.php
 * @param string $DBType
 */

\Bitrix\Main\Loader::registerAutoLoadClasses(
	"main",
	array(
		"CSiteTemplate" => "classes/general/site_template.php",
		"CBitrixComponent" => "classes/general/component.php",
		"CComponentEngine" => "classes/general/component_engine.php",
		"CComponentAjax" => "classes/general/component_ajax.php",
		"CBitrixComponentTemplate" => "classes/general/component_template.php",
		"CComponentUtil" => "classes/general/component_util.php",
		"CControllerClient" => "classes/general/controller_member.php",
		"PHPParser" => "classes/general/php_parser.php",
		"CDiskQuota" => "classes/".$DBType."/quota.php",
		"CEventLog" => "classes/general/event_log.php",
		"CEventMain" => "classes/general/event_log.php",
		"CAdminFileDialog" => "classes/general/file_dialog.php",
		"WLL_User" => "classes/general/liveid.php",
		"WLL_ConsentToken" => "classes/general/liveid.php",
		"WindowsLiveLogin" => "classes/general/liveid.php",
		"CAllFile" => "classes/general/file.php",
		"CFile" => "classes/".$DBType."/file.php",
		"CTempFile" => "classes/general/file_temp.php",
		"CFavorites" => "classes/".$DBType."/favorites.php",
		"CUserOptions" => "classes/general/user_options.php",
		"CGridOptions" => "classes/general/grids.php",
		"CUndo" => "/classes/general/undo.php",
		"CAutoSave" => "/classes/general/undo.php",
		"CRatings" => "classes/".$DBType."/ratings.php",
		"CRatingsComponentsMain" => "classes/".$DBType."/ratings_components.php",
		"CRatingRule" => "classes/general/rating_rule.php",
		"CRatingRulesMain" => "classes/".$DBType."/rating_rules.php",
		"CTopPanel" => "public/top_panel.php",
		"CEditArea" => "public/edit_area.php",
		"CComponentPanel" => "public/edit_area.php",
		"CTextParser" => "classes/general/textparser.php",
		"CPHPCacheFiles" => "classes/general/cache_files.php",
		"CDataXML" => "classes/general/xml.php",
		"CXMLFileStream" => "classes/general/xml.php",
		"CRsaProvider" => "classes/general/rsasecurity.php",
		"CRsaSecurity" => "classes/general/rsasecurity.php",
		"CRsaBcmathProvider" => "classes/general/rsabcmath.php",
		"CRsaOpensslProvider" => "classes/general/rsaopenssl.php",
		"CASNReader" => "classes/general/asn.php",
		"CBXShortUri" => "classes/".$DBType."/short_uri.php",
		"CFinder" => "classes/general/finder.php",
		"CAccess" => "classes/general/access.php",
		"CAuthProvider" => "classes/general/authproviders.php",
		"IProviderInterface" => "classes/general/authproviders.php",
		"CGroupAuthProvider" => "classes/general/authproviders.php",
		"CUserAuthProvider" => "classes/general/authproviders.php",
		"CTableSchema" => "classes/general/table_schema.php",
		"CCSVData" => "classes/general/csv_data.php",
		"CSmile" => "classes/general/smile.php",
		"CSmileGallery" => "classes/general/smile.php",
		"CSmileSet" => "classes/general/smile.php",
		"CGlobalCounter" => "classes/general/global_counter.php",
		"CUserCounter" => "classes/".$DBType."/user_counter.php",
		"CUserCounterPage" => "classes/".$DBType."/user_counter.php",
		"CHotKeys" => "classes/general/hot_keys.php",
		"CHotKeysCode" => "classes/general/hot_keys.php",
		"CBXSanitizer" => "classes/general/sanitizer.php",
		"CBXArchive" => "classes/general/archive.php",
		"CAdminNotify" => "classes/general/admin_notify.php",
		"CBXFavAdmMenu" => "classes/general/favorites.php",
		"CAdminInformer" => "classes/general/admin_informer.php",
		"CSiteCheckerTest" => "classes/general/site_checker.php",
		"CSqlUtil" => "classes/general/sql_util.php",
		"CFileUploader" => "classes/general/uploader.php",
		"LPA" => "classes/general/lpa.php",
		"CAdminFilter" => "interface/admin_filter.php",
		"CAdminList" => "interface/admin_list.php",
		"CAdminUiList" => "interface/admin_ui_list.php",
		"CAdminUiResult" => "interface/admin_ui_list.php",
		"CAdminUiContextMenu" => "interface/admin_ui_list.php",
		"CAdminUiSorting" => "interface/admin_ui_list.php",
		"CAdminListRow" => "interface/admin_list.php",
		"CAdminTabControl" => "interface/admin_tabcontrol.php",
		"CAdminForm" => "interface/admin_form.php",
		"CAdminFormSettings" => "interface/admin_form.php",
		"CAdminTabControlDrag" => "interface/admin_tabcontrol_drag.php",
		"CAdminDraggableBlockEngine" => "interface/admin_tabcontrol_drag.php",
		"CJSPopup" => "interface/jspopup.php",
		"CJSPopupOnPage" => "interface/jspopup.php",
		"CAdminCalendar" => "interface/admin_calendar.php",
		"CAdminViewTabControl" => "interface/admin_viewtabcontrol.php",
		"CAdminTabEngine" => "interface/admin_tabengine.php",
		"CCaptcha" => "classes/general/captcha.php",
		"CMpNotifications" => "classes/general/mp_notifications.php",

		//deprecated
		"CHTMLPagesCache" => "lib/composite/helper.php",
		"StaticHtmlMemcachedResponse" => "lib/composite/responder.php",
		"StaticHtmlFileResponse" => "lib/composite/responder.php",
		"Bitrix\\Main\\Page\\Frame" => "lib/composite/engine.php",
		"Bitrix\\Main\\Page\\FrameStatic" => "lib/composite/staticarea.php",
		"Bitrix\\Main\\Page\\FrameBuffered" => "lib/composite/bufferarea.php",
		"Bitrix\\Main\\Page\\FrameHelper" => "lib/composite/bufferarea.php",
		"Bitrix\\Main\\Data\\StaticHtmlCache" => "lib/composite/page.php",
		"Bitrix\\Main\\Data\\StaticHtmlStorage" => "lib/composite/data/abstractstorage.php",
		"Bitrix\\Main\\Data\\StaticHtmlFileStorage" => "lib/composite/data/filestorage.php",
		"Bitrix\\Main\\Data\\StaticHtmlMemcachedStorage" => "lib/composite/data/memcachedstorage.php",
		"Bitrix\\Main\\Data\\StaticCacheProvider" => "lib/composite/data/cacheprovider.php",
		"Bitrix\\Main\\Data\\AppCacheManifest" => "lib/composite/appcache.php",
	)
);

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/agent.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/user.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/event.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/menu.php");
AddEventHandler("main", "OnAfterEpilog", array("\\Bitrix\\Main\\Data\\ManagedCache", "finalize"));
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/usertype.php");

if(file_exists(($_fname = $_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/update_db_updater.php")))
{
	$US_HOST_PROCESS_MAIN = False;
	include($_fname);
}

if(file_exists(($_fname = $_SERVER["DOCUMENT_ROOT"]."/bitrix/init.php")))
	include_once($_fname);

if(($_fname = getLocalPath("php_interface/init.php", BX_PERSONAL_ROOT)) !== false)
	include_once($_SERVER["DOCUMENT_ROOT"].$_fname);

if(($_fname = getLocalPath("php_interface/".SITE_ID."/init.php", BX_PERSONAL_ROOT)) !== false)
	include_once($_SERVER["DOCUMENT_ROOT"].$_fname);

if(!defined("BX_FILE_PERMISSIONS"))
	define("BX_FILE_PERMISSIONS", 0644);
if(!defined("BX_DIR_PERMISSIONS"))
	define("BX_DIR_PERMISSIONS", 0755);

//global var, is used somewhere
$GLOBALS["sDocPath"] = $GLOBALS["APPLICATION"]->GetCurPage();

if((!(defined("STATISTIC_ONLY") && STATISTIC_ONLY && substr($GLOBALS["APPLICATION"]->GetCurPage(), 0, strlen(BX_ROOT."/admin/"))!=BX_ROOT."/admin/")) && COption::GetOptionString("main", "include_charset", "Y")=="Y" && strlen(LANG_CHARSET)>0)
	header("Content-Type: text/html; charset=".LANG_CHARSET);

if(COption::GetOptionString("main", "set_p3p_header", "Y")=="Y")
	header("P3P: policyref=\"/bitrix/p3p.xml\", CP=\"NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA\"");

header("X-Powered-CMS: Bitrix Site Manager (".(LICENSE_KEY == "DEMO"? "DEMO" : md5("BITRIX".LICENSE_KEY."LICENCE")).")");
if (COption::GetOptionString("main", "update_devsrv", "") == "Y")
	header("X-DevSrv-CMS: Bitrix");

define("BX_CRONTAB_SUPPORT", defined("BX_CRONTAB"));

if(COption::GetOptionString("main", "check_agents", "Y")=="Y")
{
	define("START_EXEC_AGENTS_1", microtime());
	$GLOBALS["BX_STATE"] = "AG";
	$GLOBALS["DB"]->StartUsingMasterOnly();
	CAgent::CheckAgents();
	$GLOBALS["DB"]->StopUsingMasterOnly();
	define("START_EXEC_AGENTS_2", microtime());
	$GLOBALS["BX_STATE"] = "PB";
}

//session initialization
ini_set("session.cookie_httponly", "1");

if(($domain = \Bitrix\Main\Web\Cookie::getCookieDomain()) <> '')
{
	ini_set("session.cookie_domain", $domain);
}

if(COption::GetOptionString("security", "session", "N") === "Y"	&& CModule::IncludeModule("security"))
	CSecuritySession::Init();

session_start();

foreach (GetModuleEvents("main", "OnPageStart", true) as $arEvent)
	ExecuteModuleEventEx($arEvent);

//define global user object
$GLOBALS["USER"] = new CUser;

//session control from group policy
$arPolicy = $GLOBALS["USER"]->GetSecurityPolicy();
$currTime = time();
if(
	(
		//IP address changed
		$_SESSION['SESS_IP']
		&& strlen($arPolicy["SESSION_IP_MASK"])>0
		&& (
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($_SESSION['SESS_IP']))
			!=
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($_SERVER['REMOTE_ADDR']))
		)
	)
	||
	(
		//session timeout
		$arPolicy["SESSION_TIMEOUT"]>0
		&& $_SESSION['SESS_TIME']>0
		&& $currTime-$arPolicy["SESSION_TIMEOUT"]*60 > $_SESSION['SESS_TIME']
	)
	||
	(
		//session expander control
		isset($_SESSION["BX_SESSION_TERMINATE_TIME"])
		&& $_SESSION["BX_SESSION_TERMINATE_TIME"] > 0
		&& $currTime > $_SESSION["BX_SESSION_TERMINATE_TIME"]
	)
	||
	(
		//signed session
		isset($_SESSION["BX_SESSION_SIGN"])
		&& $_SESSION["BX_SESSION_SIGN"] <> bitrix_sess_sign()
	)
	||
	(
		//session manually expired, e.g. in $User->LoginHitByHash
		isSessionExpired()
	)
)
{
	$_SESSION = array();
	@session_destroy();

	//session_destroy cleans user sesssion handles in some PHP versions
	//see http://bugs.php.net/bug.php?id=32330 discussion
	if(COption::GetOptionString("security", "session", "N") === "Y"	&& CModule::IncludeModule("security"))
		CSecuritySession::Init();

	session_id(md5(uniqid(rand(), true)));
	session_start();
	$GLOBALS["USER"] = new CUser;
}
$_SESSION['SESS_IP'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['SESS_TIME'] = time();
if(!isset($_SESSION["BX_SESSION_SIGN"]))
	$_SESSION["BX_SESSION_SIGN"] = bitrix_sess_sign();

//session control from security module
if(
	(COption::GetOptionString("main", "use_session_id_ttl", "N") == "Y")
	&& (COption::GetOptionInt("main", "session_id_ttl", 0) > 0)
	&& !defined("BX_SESSION_ID_CHANGE")
)
{
	if(!array_key_exists('SESS_ID_TIME', $_SESSION))
	{
		$_SESSION['SESS_ID_TIME'] = $_SESSION['SESS_TIME'];
	}
	elseif(($_SESSION['SESS_ID_TIME'] + COption::GetOptionInt("main", "session_id_ttl")) < $_SESSION['SESS_TIME'])
	{
		if(COption::GetOptionString("security", "session", "N") === "Y" && CModule::IncludeModule("security"))
		{
			CSecuritySession::UpdateSessID();
		}
		else
		{
			session_regenerate_id();
		}
		$_SESSION['SESS_ID_TIME'] = $_SESSION['SESS_TIME'];
	}
}

define("BX_STARTED", true);

if (isset($_SESSION['BX_ADMIN_LOAD_AUTH']))
{
	define('ADMIN_SECTION_LOAD_AUTH', 1);
	unset($_SESSION['BX_ADMIN_LOAD_AUTH']);
}

if(!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true)
{
	$bLogout = isset($_REQUEST["logout"]) && (strtolower($_REQUEST["logout"]) == "yes");

	if($bLogout && $GLOBALS["USER"]->IsAuthorized())
	{
		$GLOBALS["USER"]->Logout();
		LocalRedirect($GLOBALS["APPLICATION"]->GetCurPageParam('', array('logout')));
	}

	// authorize by cookies
	if(!$GLOBALS["USER"]->IsAuthorized())
	{
		$GLOBALS["USER"]->LoginByCookies();
	}

	$arAuthResult = false;

	//http basic and digest authorization
	if(($httpAuth = $GLOBALS["USER"]->LoginByHttpAuth()) !== null)
	{
		$arAuthResult = $httpAuth;
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}

	//Authorize user from authorization html form
	if(isset($_REQUEST["AUTH_FORM"]) && $_REQUEST["AUTH_FORM"] <> '')
	{
		$bRsaError = false;
		if(COption::GetOptionString('main', 'use_encrypted_auth', 'N') == 'Y')
		{
			//possible encrypted user password
			$sec = new CRsaSecurity();
			if(($arKeys = $sec->LoadKeys()))
			{
				$sec->SetKeys($arKeys);
				$errno = $sec->AcceptFromForm(array('USER_PASSWORD', 'USER_CONFIRM_PASSWORD'));
				if($errno == CRsaSecurity::ERROR_SESS_CHECK)
					$arAuthResult = array("MESSAGE"=>GetMessage("main_include_decode_pass_sess"), "TYPE"=>"ERROR");
				elseif($errno < 0)
					$arAuthResult = array("MESSAGE"=>GetMessage("main_include_decode_pass_err", array("#ERRCODE#"=>$errno)), "TYPE"=>"ERROR");

				if($errno < 0)
					$bRsaError = true;
			}
		}

		if($bRsaError == false)
		{
			if(!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
				$USER_LID = SITE_ID;
			else
				$USER_LID = false;

			if($_REQUEST["TYPE"] == "AUTH")
			{
				$arAuthResult = $GLOBALS["USER"]->Login($_REQUEST["USER_LOGIN"], $_REQUEST["USER_PASSWORD"], $_REQUEST["USER_REMEMBER"]);
			}
			elseif($_REQUEST["TYPE"] == "OTP")
			{
				$arAuthResult = $GLOBALS["USER"]->LoginByOtp($_REQUEST["USER_OTP"], $_REQUEST["OTP_REMEMBER"], $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"]);
			}
			elseif($_REQUEST["TYPE"] == "SEND_PWD")
			{
				$arAuthResult = CUser::SendPassword($_REQUEST["USER_LOGIN"], $_REQUEST["USER_EMAIL"], $USER_LID, $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"], $_REQUEST["USER_PHONE_NUMBER"]);
			}
			elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["TYPE"] == "CHANGE_PWD")
			{
				$arAuthResult = $GLOBALS["USER"]->ChangePassword($_REQUEST["USER_LOGIN"], $_REQUEST["USER_CHECKWORD"], $_REQUEST["USER_PASSWORD"], $_REQUEST["USER_CONFIRM_PASSWORD"], $USER_LID, $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"], true, $_REQUEST["USER_PHONE_NUMBER"]);
			}
			elseif(COption::GetOptionString("main", "new_user_registration", "N") == "Y" && $_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["TYPE"] == "REGISTRATION" && (!defined("ADMIN_SECTION") || ADMIN_SECTION!==true))
			{
				$arAuthResult = $GLOBALS["USER"]->Register($_REQUEST["USER_LOGIN"], $_REQUEST["USER_NAME"], $_REQUEST["USER_LAST_NAME"], $_REQUEST["USER_PASSWORD"], $_REQUEST["USER_CONFIRM_PASSWORD"], $_REQUEST["USER_EMAIL"], $USER_LID, $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"], false, $_REQUEST["USER_PHONE_NUMBER"]);
			}

			if($_REQUEST["TYPE"] == "AUTH" || $_REQUEST["TYPE"] == "OTP")
			{
				//special login form in the control panel
				if($arAuthResult === true && defined('ADMIN_SECTION') && ADMIN_SECTION === true)
				{
					//store cookies for next hit (see CMain::GetSpreadCookieHTML())
					$GLOBALS["APPLICATION"]->StoreCookies();
					$_SESSION['BX_ADMIN_LOAD_AUTH'] = true;

					CMain::FinalActions('<script type="text/javascript">window.onload=function(){top.BX.AUTHAGENT.setAuthResult(false);};</script>');
					die();
				}
			}
		}
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}
	elseif(!$GLOBALS["USER"]->IsAuthorized())
	{
		//Authorize by unique URL
		$GLOBALS["USER"]->LoginHitByHash();
	}
}

//logout or re-authorize the user if something importand has changed
$GLOBALS["USER"]->CheckAuthActions();

//magic short URI
if(defined("BX_CHECK_SHORT_URI") && BX_CHECK_SHORT_URI && CBXShortUri::CheckUri())
{
	//local redirect inside
	die();
}

//application password scope control
if(($applicationID = $GLOBALS["USER"]->GetParam("APPLICATION_ID")) !== null)
{
	$appManager = \Bitrix\Main\Authentication\ApplicationManager::getInstance();
	if($appManager->checkScope($applicationID) !== true)
	{
		$event = new \Bitrix\Main\Event("main", "onApplicationScopeError", Array('APPLICATION_ID' => $applicationID));
		$event->send();

		CHTTP::SetStatus("403 Forbidden");
		die();
	}
}

//define the site template
if(!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
{
	$siteTemplate = "";
	if(is_string($_REQUEST["bitrix_preview_site_template"]) && $_REQUEST["bitrix_preview_site_template"] <> "" && $GLOBALS["USER"]->CanDoOperation('view_other_settings'))
	{
		//preview of site template
		$signer = new Bitrix\Main\Security\Sign\Signer();
		try
		{
			//protected by a sign
			$requestTemplate = $signer->unsign($_REQUEST["bitrix_preview_site_template"], "template_preview".bitrix_sessid());

			$aTemplates = CSiteTemplate::GetByID($requestTemplate);
			if($template = $aTemplates->Fetch())
			{
				$siteTemplate = $template["ID"];

				//preview of unsaved template
				if(isset($_GET['bx_template_preview_mode']) && $_GET['bx_template_preview_mode'] == 'Y' && $GLOBALS["USER"]->CanDoOperation('edit_other_settings'))
				{
					define("SITE_TEMPLATE_PREVIEW_MODE", true);
				}
			}
		}
		catch(\Bitrix\Main\Security\Sign\BadSignatureException $e)
		{
		}
	}
	if($siteTemplate == "")
	{
		$siteTemplate = CSite::GetCurTemplate();
	}
	define("SITE_TEMPLATE_ID", $siteTemplate);
	define("SITE_TEMPLATE_PATH", getLocalPath('templates/'.SITE_TEMPLATE_ID, BX_PERSONAL_ROOT));
}

//magic parameters: show page creation time
if(isset($_GET["show_page_exec_time"]))
{
	if($_GET["show_page_exec_time"]=="Y" || $_GET["show_page_exec_time"]=="N")
		$_SESSION["SESS_SHOW_TIME_EXEC"] = $_GET["show_page_exec_time"];
}

//magic parameters: show included file processing time
if(isset($_GET["show_include_exec_time"]))
{
	if($_GET["show_include_exec_time"]=="Y" || $_GET["show_include_exec_time"]=="N")
		$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = $_GET["show_include_exec_time"];
}

//magic parameters: show include areas
if(isset($_GET["bitrix_include_areas"]) && $_GET["bitrix_include_areas"] <> "")
	$GLOBALS["APPLICATION"]->SetShowIncludeAreas($_GET["bitrix_include_areas"]=="Y");

//magic sound
if($GLOBALS["USER"]->IsAuthorized())
{
	$cookie_prefix = COption::GetOptionString('main', 'cookie_name', 'BITRIX_SM');
	if(!isset($_COOKIE[$cookie_prefix.'_SOUND_LOGIN_PLAYED']))
		$GLOBALS["APPLICATION"]->set_cookie('SOUND_LOGIN_PLAYED', 'Y', 0);
}

//magic cache
\Bitrix\Main\Composite\Engine::shouldBeEnabled();

foreach(GetModuleEvents("main", "OnBeforeProlog", true) as $arEvent)
	ExecuteModuleEventEx($arEvent);

if((!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true) && (!defined("NOT_CHECK_FILE_PERMISSIONS") || NOT_CHECK_FILE_PERMISSIONS!==true))
{
	$real_path = $request->getScriptFile();

	if(!$GLOBALS["USER"]->CanDoFileOperation('fm_view_file', array(SITE_ID, $real_path)) || (defined("NEED_AUTH") && NEED_AUTH && !$GLOBALS["USER"]->IsAuthorized()))
	{
		/** @noinspection PhpUndefinedVariableInspection */
		if($GLOBALS["USER"]->IsAuthorized() && $arAuthResult["MESSAGE"] == '')
			$arAuthResult = array("MESSAGE"=>GetMessage("ACCESS_DENIED").' '.GetMessage("ACCESS_DENIED_FILE", array("#FILE#"=>$real_path)), "TYPE"=>"ERROR");

		if(defined("ADMIN_SECTION") && ADMIN_SECTION==true)
		{
			if ($_REQUEST["mode"]=="list" || $_REQUEST["mode"]=="settings")
			{
				echo "<script>top.location='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(array("mode"))."';</script>";
				die();
			}
			elseif ($_REQUEST["mode"]=="frame")
			{
				echo "<script type=\"text/javascript\">
					var w = (opener? opener.window:parent.window);
					w.location.href='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(array("mode"))."';
				</script>";
				die();
			}
			elseif(defined("MOBILE_APP_ADMIN") && MOBILE_APP_ADMIN==true)
			{
				echo json_encode(Array("status"=>"failed"));
				die();
			}
		}

		/** @noinspection PhpUndefinedVariableInspection */
		$GLOBALS["APPLICATION"]->AuthForm($arAuthResult);
	}
}

/*ZDUyZmZZmJjZGI2MzgxNDg5NGUzYmMxZWE0MTIzNzZlY2U4MjM=*/$GLOBALS['____1467406134']= array(base64_decode(''.'bXRf'.'cmFuZA=='),base64_decode('ZXhw'.'bG9k'.'ZQ=='),base64_decode('cG'.'Fj'.'aw=='),base64_decode('bWQ'.'1'),base64_decode('Y29'.'uc3'.'RhbnQ='),base64_decode('aGFzaF9ob'.'WF'.'j'),base64_decode('c3RyY'.'21w'),base64_decode('aX'.'Nf'.'b2'.'JqZ'.'WN0'),base64_decode(''.'Y2FsbF91c2VyX2Z1bmM='),base64_decode('Y2Fs'.'bF91c2V'.'yX2Z1'.'bmM'.'='),base64_decode('Y2FsbF'.'91c2VyX2Z'.'1bm'.'M='),base64_decode('Y2FsbF91c2VyX'.'2Z1bmM='),base64_decode(''.'Y2'.'FsbF91c2'.'VyX2Z1bmM='));if(!function_exists(__NAMESPACE__.'\\___110116947')){function ___110116947($_1604053517){static $_1648413650= false; if($_1648413650 == false) $_1648413650=array(''.'REI=',''.'U'.'0VMRUN'.'UIF'.'ZBTFVFIEZS'.'T00gY'.'l'.'9vcHRpb'.'24g'.'V0hF'.'UkU'.'gTkF'.'NRT0nflBBUkFNX01B'.'W'.'F9'.'VU'.'0V'.'SUycgQU5EIE'.'1PRFV'.'MRV9J'.'RD0nbWFpbi'.'c'.'gQU5EIFN'.'JVEVfSUQ'.'gS'.'VM'.'g'.'TlVMTA==','VkFMV'.'UU=','Lg==',''.'SCo=','Yml'.'0c'.'ml'.'4','T'.'E'.'lDRU5T'.'RV9L'.'R'.'V'.'k=','c2h'.'hMjU2',''.'VV'.'NFUg==','V'.'VNFUg='.'=','V'.'VNFUg'.'='.'=','SX'.'NBdXRob'.'3Jp'.'emVk','VV'.'NFU'.'g==','SXN'.'B'.'ZG'.'1pbg==','QV'.'BQTElDQ'.'V'.'RJT0'.'4=','UmVzdGFydEJ1'.'ZmZlcg==','TG9jYWxSZ'.'WRpcmV'.'jdA==','L2xpY'.'2Vuc'.'2VfcmVzdHJpY'.'3Rpb24u'.'cGhw','XE'.'Jp'.'dHJpeFx'.'NYW'.'luXENvbmZpZ1xPc'.'HRpb246OnNldA==','bWFpbg==','UEF'.'SQ'.'U'.'1fTU'.'FY'.'X1'.'VTRVJ'.'T');return base64_decode($_1648413650[$_1604053517]);}};if($GLOBALS['____1467406134'][0](round(0+0.5+0.5), round(0+20)) == round(0+2.3333333333333+2.3333333333333+2.3333333333333)){ $_1729270854= $GLOBALS[___110116947(0)]->Query(___110116947(1), true); if($_1144457068= $_1729270854->Fetch()){ $_1983822191= $_1144457068[___110116947(2)]; list($_1763664166, $_1553592769)= $GLOBALS['____1467406134'][1](___110116947(3), $_1983822191); $_2063166985= $GLOBALS['____1467406134'][2](___110116947(4), $_1763664166); $_578327978= ___110116947(5).$GLOBALS['____1467406134'][3]($GLOBALS['____1467406134'][4](___110116947(6))); $_990052569= $GLOBALS['____1467406134'][5](___110116947(7), $_1553592769, $_578327978, true); if($GLOBALS['____1467406134'][6]($_990052569, $_2063166985) !== min(250,0,83.333333333333)){ if(isset($GLOBALS[___110116947(8)]) && $GLOBALS['____1467406134'][7]($GLOBALS[___110116947(9)]) && $GLOBALS['____1467406134'][8](array($GLOBALS[___110116947(10)], ___110116947(11))) &&!$GLOBALS['____1467406134'][9](array($GLOBALS[___110116947(12)], ___110116947(13)))){ $GLOBALS['____1467406134'][10](array($GLOBALS[___110116947(14)], ___110116947(15))); $GLOBALS['____1467406134'][11](___110116947(16), ___110116947(17), true);}}} else{ $GLOBALS['____1467406134'][12](___110116947(18), ___110116947(19), ___110116947(20), round(0+2.4+2.4+2.4+2.4+2.4));}}/**/       //Do not remove this

