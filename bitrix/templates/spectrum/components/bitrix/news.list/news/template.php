<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
?>
<div class="row">
<div id="myCarousel3" class="carousel carousel3 slide" data-interval="false">
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
		$pagin .= '<li data-target="#myCarousel3" data-slide-to="' . $i . '" class="' . ($i == 0 ? ' active' : '') . '"></li>';
		$i++;
	}
	?>	
	
                            <div class="col-md-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                
                                <div class="blog-item">
                                
                                    <div class="popup-wrapper">
                                        <div class="popup-gallery">
                                            <a class="popup3" href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"><img title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="width-100">
											<span class="eye-wrapper"><i class="icon icon-cursor-move eye-icon" style="font-size: 38px;"></i></span>
											</a>
                                        </div>
                                    </div>
                                    
                                    <div class="blog-item-inner">
                                    
							<h3 class="blog-title"><?echo $arItem["NAME"]?></h3>
                                        
                                        <p><?=$arItem["PREVIEW_TEXT"]?></p>
                
                                    </div>
                                    
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
</div>