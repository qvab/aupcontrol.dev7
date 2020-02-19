<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>	
		<div class="row" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	
			<div class="col-md-5">
				<div class="testimonials-info">
 <img title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="author-pic">
					<p class="author-name">
						 <?=$arItem["PROPERTIES"]["OTZ_NAME"]["VALUE"]?><br>
						 <?=$arItem["PROPERTIES"]["OTZ_POSITION"]["VALUE"]?>
					</p>
				</div>
			</div>
			<div class="col-md-7">
				<p class="testimonials-text">
					 <?=$arItem['PREVIEW_TEXT']?>
				</p>
			</div>
			
			
			</div>
<?endforeach;?>