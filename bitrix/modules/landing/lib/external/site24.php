<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage intranet
 * @copyright 2001-2018 Bitrix
 */

namespace Bitrix\Landing\External;

use \Bitrix\Main\SystemException;

class Site24
{
    public static function updateDomain($domain, $newName, $url)
    {
        return self::Execute("update", array("domain" => $domain, "newname" => $newName, "url" => $url));
    }

    public static function activateDomain($domain, $active = 'Y', $lang = false)
    {
        return self::Execute("activate", array("domain" => $domain, "active" => $active, "lang" => $lang));
    }

    public static function addDomain($domain, $url, $active = 'Y', $type = "site", $lang = "")
    {
        return self::Execute("add", array("domain" => $domain, "url" => $url, "active" => $active, "type" => $type, "lang" => $lang));
    }

    // 0 - domain name is available
    // 1 - domain name is not available, but you are owner
    // 2 - domain name is not available
    public static function isDomainExists($domain)
    {
        return self::Execute("check", array("domain" => $domain));
    }

    public static function deleteDomain($domain)
    {
        return self::Execute("delete", array("domain" => $domain));
    }

    public static function addRandomDomain($url, $type = "site", $lang = "")
    {
        return self::Execute("addrandom", array('url' => $url, 'type' => $type, "lang" => $lang));
    }

    protected static function Execute($operation, $params = array())
    {
        $params["operation"] = $operation;

        require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client.php");
        $params['key'] = md5("BITRIX".\CUpdateClient::GetLicenseKey()."LICENCE");
        $params['keysign'] = md5(\CUpdateClient::GetLicenseKey());
        $params['host']= \Bitrix\Main\Config\Option::get('intranet', 'portal_url', null);

        if (!$params['host'])
		{
			$params['host']= \Bitrix\Main\Config\Option::get(
				'landing',
				'portal_url',
				$_SERVER['HTTP_HOST']
			);
		}

		if (!$params['host'])
		{
			$params['host'] = $_SERVER['HTTP_HOST'];
		}

		$params['host'] = trim($params['host']);

		if (
			strpos($params['host'], 'http://') === 0 ||
			strpos($params['host'], 'https://') === 0
		)
		{
			$params['host'] = parse_url($params['host'])['host'];
		}

		if (!isset($params['lang']) || !$params['lang'])
		{
			unset($params['lang']);
		}

        $httpClient = new \Bitrix\Main\Web\HttpClient(array(
            "socketTimeout" => 5,
            "streamTimeout" => 30,
        ));

        $httpClient->setHeader('User-Agent', 'Bitrix24 Sites');
        $answer = $httpClient->post("https://pub.bitrix24.site/pub.php", $params);


        $result = '';
        if ($answer && $httpClient->getStatus() == "200")
        {
            $result = $httpClient->getResult();
        }

        if(strlen($result) > 0)
        {
            try
            {
                $result = \Bitrix\Main\Web\Json::decode($result);
            }
            catch(\Bitrix\Main\ArgumentException $e)
            {
                throw new SystemException('Bad response');
            }

            return $result['result'];
        }
        throw new SystemException('Bad response');
    }
}