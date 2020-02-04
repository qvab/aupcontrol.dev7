<?php

namespace MIWR;
require_once $_SERVER["DOCUMENT_ROOT"] . "/local/classes_miwr/MWTokens.php";

class Bitrix24
{
  const PARAMS_AUTH = [
    "domain" => "aupcontrol.ru",
    "client_id" => "local.5e1c5dd6922fc3.14827136",
    "client_secret" => "wDp4XAleeBd18zTfIPCJHXUrs6bimLYA546tRPePsHNvfi3EG9",
    "redirect_uri" => "https://aupcontrol.ru/local/auth_bitrix.php?step=2",
  ];

  private $req;

  function __construct()
  {
    $this->req = $_REQUEST;
  }

  /**
   * первый этап авторизации
   */
  public function oneStep()
  {
    // TODO передавать параметры для открыия файла через параметр state в JSON
    $sLink = "https://" . self::PARAMS_AUTH["domain"] . "/oauth/authorize/?client_id=" . self::PARAMS_AUTH["client_id"] . "&redirect_uri=" . self::PARAMS_AUTH["redirect_uri"]."&state=".json_encode($this->req, JSON_UNESCAPED_UNICODE);
    header("Location: " . $sLink);
  }

  /**
   * Второй этап авторизации
   */
  public function twoStep()
  {
    // TODO принимать state
    $r = $this->req;
    $sLink = "https://" . $r["server_domain"] . "/oauth/token/?grant_type=authorization_code&client_id=" . self::PARAMS_AUTH["client_id"] . "&client_secret=" . self::PARAMS_AUTH["client_secret"] . "&code=" . $r["code"];
    $arJSON = json_decode($this->__getCurl($sLink), true);
    $obToken = new MWTokens();
    $res = $obToken->insert([
      "bx_user_id" => $arJSON["user_id"],
      "access_token" => $arJSON["access_token"],
      "refresh_token" => $arJSON["refresh_token"],
      "created_at" => time(),
      "update_at" => strtotime("now + 55 minutes"),
      "clear_at" => strtotime("now + 25 days"),
      "client_id" => self::PARAMS_AUTH["client_id"],
      "client_secret" => self::PARAMS_AUTH["client_secret"]
    ]);
  }


  public function getCall($sMethod, $arParams = false)
  {
    $arToken = $this->__getToken($this->req["user"]["id"]);
    $arParams["auth"] = $arToken["access_token"];
    $arParams["access_token"] = $arToken["access_token"];
    $url = "https://" . self::PARAMS_AUTH["domain"] . "/rest/" . $sMethod . ".json";
    return $this->__getCurl($url, $arParams);
  }

  public function openFile()
  {

    $response = $this->getCall("disk.file.get", [
      "id" => $this->req["file"]["id"]
    ]);
    vd($response);
    $arResponse = json_decode($response, true);
    $sDownloadLink = $arResponse["result"]["DOWNLOAD_URL"];
    vd($sDownloadLink);
    $arDownload = $this->__getCurl($sDownloadLink);
    vd($arDownload);
  }

  /*************************************** [PRIVATE METHODS] **********************************************/

  /**
   * Получение токена
   */
  private function __getToken($iBxUserId)
  {
    $obToken = new MWTokens();
    $obToken->clear();                                                          // Чистим просроченные refresh токены, которым больше 25 дней
    $arToken = $obToken->get($iBxUserId);
    if (empty($arToken)) {
      $this->oneStep();                                                         // Нету токена, проводим повторную авторизацию
      return false;
    } else {
      if (($arToken["update_at"] - (30 * 60)) < time()) {
        $arResponse = $this->refreshToken($arToken["refresh_token"]);           // Прошло минимум 30 минут с момента получения токена, обновляем токент
        return $arResponse["token"];
      } else {
        return $arToken;
      }
    }
  }

  /**
   * Обновляем токен если прошло больше 55 минут
   */
  private function refreshToken($sRefresh)
  {
    $sLink = "https://oauth.bitrix.info/oauth/token/?grant_type=refresh_token&client_id=" . self::PARAMS_AUTH["client_id"] . "&client_secret=" . self::PARAMS_AUTH["client_secret"] . "&refresh_token=" . $sRefresh;
    $sResponse = $this->__getCurl($sLink);
    $arJSON = json_decode($sResponse, true);
    $obToken = new MWTokens();
    $arToken = [
      "bx_user_id" => $this->req["user"]["id"],
      "access_token" => $arJSON["access_token"],
      "refresh_token" => $arJSON["refresh_token"],
      "created_at" => time(),
      "update_at" => strtotime("now + 55 minutes"),
      "clear_at" => strtotime("now + 25 days"),
      "client_id" => self::PARAMS_AUTH["client_id"],
      "client_secret" => self::PARAMS_AUTH["client_secret"]
    ];
    $response = $obToken->insert($arToken);
    return [
      "token" => $arToken,
      "response" => $response
    ];
  }

  /**
   * Внутряняя функуция для cURL
   */
  private function __getCurl($sLink, $arParams = false)
  {
    $sPostFields = !empty($arParams) ? http_build_query($arParams) : false;
    $obCurl = curl_init();
    curl_setopt($obCurl, CURLOPT_URL, $sLink);
    curl_setopt($obCurl, CURLOPT_RETURNTRANSFER, true);
    if ($sPostFields) {
      curl_setopt($obCurl, CURLOPT_POST, true);
      curl_setopt($obCurl, CURLOPT_POSTFIELDS, $sPostFields);
    }
    curl_setopt($obCurl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($obCurl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($obCurl, CURLOPT_SSL_VERIFYHOST, false);
    $out = curl_exec($obCurl);
    vd($out);
    $info = curl_getinfo($obCurl);
    vd($info);
    if (curl_errno($obCurl)) {
      return ["error" => curl_error($obCurl), "info" => $info];
    }
    return $out;
  }
}
vd($_REQUEST["action"]);
if (!empty($_REQUEST["action"])) {
  $obBX = new Bitrix24();
  switch ($_REQUEST["action"]) {
    case "open_file":
      $obBX->openFile();
      break;
  }
}
