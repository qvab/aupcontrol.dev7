<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult["ITEMS"][0]["PROPERTIES"]["PRICE_DESCR"])) {
	$property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC", "ID"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "CODE"=>"PRICE_DESCR"));
	while($enum_fields = $property_enums->GetNext()) {
		$arResult["PROPERTIES"]["PRICE_DESCR"][$enum_fields["ID"]] = $enum_fields;
	}
}
?>