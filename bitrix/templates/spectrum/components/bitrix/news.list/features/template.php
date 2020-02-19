<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$count = count($arResult["ITEMS"]);
?>
			<div class="row">
<?foreach($arResult["ITEMS"] as $key => $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	?>		
				
                <div class="col-md-6 col-sm-12" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="story-block story-<? if($key % 2 == 0) echo 'left'; else echo 'right'; ?> <? if($key + 1 == $count || $key + 1 == $count - 1) echo 'last'; ?>">
                        <div class="story-text">                            
                            <h4><?=$arItem["NAME"]?></h4>                                                    
                            <p><?=$arItem["PREVIEW_TEXT"]?></p>                            
                        </div>
                        <div class="story-image">                        
                            <img title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">                             
                        </div>
                        <span class="story-arrow"></span>                        
                        <span class="h-line"></span>                        
                    </div>
                </div>

<?endforeach;?>
				</div> 