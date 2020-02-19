<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div id="myCarousel" class="carousel carousel1 slide margin-bottom-40" data-interval="false">
<div class="carousel-inner">

<? 
$count_items = count($arResult["ITEMS"]);
$i = 0;
?>

<?foreach($arResult["ITEMS"] as $key => $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	if($key % 3 == 0) {
		echo '<div class="item' . ($key == 0 ? ' active' : '') . '">';
		$pagin .= '<li data-target="#myCarousel" data-slide-to="' . $i . '" class="' . ($i == 0 ? ' active' : '') . '"></li>';
		$i++;
	}
	?>	
	
                            <div class="col-md-4 team-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                
                                <div class="team-popup">
                                
                                    <img title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="width-100">
                                    
                                    <div class="team-popup-overlay">
                                    
                                        <div class="team-icon">
                                        
										<? if(!empty($arItem["PROPERTIES"]["TEAM_TV"]["VALUE"])) : ?>
                                            <a href="<?=$arItem["PROPERTIES"]["TEAM_TV"]["VALUE"]?>">
                                                <i class="icon icon-twitter"></i>
                                            </a>
										<? endif; ?>
										
										<? if(!empty($arItem["PROPERTIES"]["TEAM_FB"]["VALUE"])) : ?>
                                            <a href="<?=$arItem["PROPERTIES"]["TEAM_FB"]["VALUE"]?>">
                                                <i class="icon icon-facebook"></i>
                                            </a>
										<? endif; ?>
										
										<? if(!empty($arItem["PROPERTIES"]["TEAM_VK"]["VALUE"])) : ?>
                                            <a href="<?=$arItem["PROPERTIES"]["TEAM_VK"]["VALUE"]?>">
                                                <i class="icon icon-vk"></i>
                                            </a>
										<? endif; ?>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <div class="team-box">
                                    
                                    <h3><?=$arItem["NAME"]?></h3>
                                    
                                    <p class="team-info"><?=$arItem["PROPERTIES"]["TEAM_POSITION"]["VALUE"]?></p>
                                                                            
                                </div>                                
                            </div>
				
	<?
	
	
	if(($key + 1) % 3 == 0) {
		echo '</div>';
	} else if(($key - 1) == $count_items) {
		echo '</div>';
	}
		
	?>
<?endforeach;?>
</div>
</div>
	<ol class="carousel-indicators">
        <?=$pagin?>
    </ol>