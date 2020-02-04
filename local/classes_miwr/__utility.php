<?php


namespace MIWR;
define("PATH_ROOT", $_SERVER["DOCUMENT_ROOT"]);

class __Utility
{

  private $mainDir = PATH_ROOT."/miwr/storage";

  public function responseJSON($arData)
  {
    header('Content-Type: application/json');
    if (gettype($arData) == "array") {
      return json_encode($arData, JSON_UNESCAPED_UNICODE);
    } else {
      return $arData;
    }
  }

  public function JSON($mixData)
  {
    if (gettype($mixData) != "array") {
      return json_decode($mixData, true);
    } else {
      return json_encode($mixData, JSON_UNESCAPED_UNICODE);
    }
  }

  public function log($arData)
  {
    $sDate = date("Y-m-d H:i:s");
    $sJSON = $this->JSON($arData);
    $sFileName = date("d_m_Y", time()).".log";
    $json = $this->open($sFileName);
    $arJson = json_decode($json, true);


    $arAllJSon[date("Y-m-d H:i:s")] = $arData;
    $arAllJSon = !empty($arJson) ? array_merge($arJson, $arAllJSon) : $arAllJSon;
    return $this->writeFile($sFileName, json_encode($arAllJSon, JSON_UNESCAPED_UNICODE));
  }

  public function open($file)
  {
    return file_get_contents($this->mainDir."/".$file);
  }


  public function writeFile($sFile, $sContent, $bAbsolute = false)
  {
    if (empty($bAbsolute)) {
      $sFile = $this->mainDir."/".$sFile;
    }
    if (!is_file($sFile)) {
      $fn = fopen($sFile, "w+");
    } else {
      $fn = fopen($sFile, "r+");
    }
    $bResult = false;
    if (!empty($fn)) {
      $bResult = fwrite($fn, $sContent);
    }
    fclose($fn);
    return json_encode(["response" => $bResult], JSON_UNESCAPED_UNICODE);
  }

  public function createdDir($sPath)
  {
    mkdir($sPath, 0777);
  }


  public function isDir($sPath)
  {
    return is_dir($sPath);
  }

  public function isFile($sPath)
  {
    return is_file($sPath);
  }


  public function workTime($iStartTime = false)
  {
    if (empty($iStartTime)) {
      return microtime(true);
    } else {
      return microtime(true) - $iStartTime;
    }
  }

  public function renderTpl($sPath, $data)
  {
    include $_SERVER["DOCUMENT_ROOT"]."/miwr/tpl/".$sPath;
  }

}