<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="row">
<?foreach($arResult["ITEMS"] as $key => $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	?>	
                            <div class="col-md-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="pricing-box-<?=$arItem["PROPERTIES"]["PRICE_COLOR"]["VALUE"]?>">
							
                        <div class="pricing-top">
                        
                            <h3><?=$arItem["NAME"]?></h3>
                            
                            <p class="price">
								<span class="currency white"><?=$arItem["PROPERTIES"]["PRICE_VALUTA"]["VALUE"]?></span> 
								<span class="number white"><?=$arItem["PROPERTIES"]["PRICE_PRICE"]["VALUE"]?></span> 
								<span class="month white"><?=$arItem["PROPERTIES"]["PRICE_PERIOD"]["VALUE"]?></span>
							</p>
                        
                        </div>
						
						<div class="pricing-bottom">
                            
                            <ul>
							<?foreach($arItem["PROPERTIES"]["PRICE_DESCR"]["VALUE"] as $kk => $arItemDescr):?>
								<li><?=$arItemDescr;?></li>
							<?endforeach;?>
                            </ul>
                            
                            <a href="#contact" class="scrool btn btn-md btn-block btn-pricing-<?=$arItem["PROPERTIES"]["PRICE_COLOR"]["VALUE"]?>"><?=$arItem["PROPERTIES"]["PRICE_BTN"]["VALUE"]?></a>
                        
                        </div>
						
                            </div>                           
                            </div>

<?endforeach;?>
</div>
