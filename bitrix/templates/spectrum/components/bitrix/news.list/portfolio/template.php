<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
	$delay = 0.15;
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	
	?>	
	
	
		<div class="col-md-4 wow fadeIn" data-wow-delay="<?=$delay?>s" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="popup-gallery first-gallery portfolio-pic">
				<a class="popup2" href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
					<img title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"  class="width-100">
					<span class="eye-wrapper"><i class="icon icon-cursor-move eye-icon" style="font-size: 38px;"></i></span>
				</a>
			</div>
		</div>
	<?
	$delay += 0.15;
	?>
<?endforeach;?>