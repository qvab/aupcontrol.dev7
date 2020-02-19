<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
            <ul class="nav navbar-nav navbar-right">
				<?
				$count = count($arResult);
				foreach($arResult as $key => $arItem):
					if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
						continue;
				?>
					<?if($arItem["SELECTED"]):?>
						<li><a href="<?=$arItem["LINK"]?>" <?if($count == $key + 1) echo ' class=" scrool"'; ?>><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li><a href="<?=$arItem["LINK"]?>" <?if($count == $key + 1) echo ' class=" scrool"'; ?>><?=$arItem["TEXT"]?></a></li>
					<?endif?>
					
				<?endforeach?>
            </ul>
<?endif?>