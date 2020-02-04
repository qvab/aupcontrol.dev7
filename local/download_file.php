<?php
namespace MIWR;
require_once $_SERVER["DOCUMENT_ROOT"]."/local/auth_bitrix.php";
vd("get file");
$obBitrix24 = new Bitrix24();
$response = $obBitrix24->getCall("disk.file.get", [
  "id" => 12167
]);

vd($response);