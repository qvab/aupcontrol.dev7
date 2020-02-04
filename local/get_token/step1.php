<?php
namespace MIWR;
require_once $_SERVER["DOCUMENT_ROOT"]."/local/auth_bitrix.php";
$obBitrix24 = new Bitrix24();
$obBitrix24->onestep();