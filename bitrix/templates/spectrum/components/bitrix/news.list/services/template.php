<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="row">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		$arImg = $arItem["PREVIEW_PICTURE"];
		//var_dump($arItem);
		?>
		
		<div class="col-md-4 service-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="popup-wrapper">
				<div class="popup-gallery">
					<a class="popup1" href="<?=$arImg["SRC"]?>">
						<img alt="pic" src="<?=$arImg["SRC"]?>" class="width-100">
						<span class="eye-wrapper2"><i class="icon icon-cursor-move eye-icon" style="font-size: 38px;"></i></span>
					</a>
				</div>
			</div>
			<div class="service-inner blue">
				<h3><?echo $arItem["NAME"]?></h3>
				<p>
					<?=$arItem['PREVIEW_TEXT']?>
				</p>
				<? if($arItem['PROPERTIES']['BTN_TEXT']['VALUE'] != '') : ?>
				<a href="#contact" class="btn btn-lg btn-services-<?=$arItem['PROPERTIES']['BTN_COLOR']['VALUE']?> scrool"><?=$arItem['PROPERTIES']['BTN_TEXT']['VALUE']?></a>
				<? endif; ?>
			</div>
		</div>
		
	<?endforeach;?>
	</div>