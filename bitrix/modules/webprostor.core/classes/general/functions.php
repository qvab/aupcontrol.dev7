<?
Class CWebprostorCoreFunctions
{
	public function GetCorrectWord($num, $str1, $str2, $str3)
	{
		$val = $num % 100;

		if ($val > 10 && $val < 20) return $num .' '. $str3;
		else {
			$val = $num % 10;
			if ($val == 1) return $num .' '. $str1;
			elseif ($val > 1 && $val < 5) return $num .' '. $str2;
			else return $num .' '. $str3;
		}
	}
	
	function ReturnBytes($val) {
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		switch($last) {
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}

		return $val;
	}
	
	public function ShowFormFields($arFields = Array())
	{
		if(count($arFields))
		{
			foreach($arFields as $arSection)
			{
			if($arSection["LABEL"])
			{
			?>
			<tr class="heading">
				<td colspan="2"><?=$arSection["LABEL"]?></td>
			</tr>
			<?
			}
			if(count($arSection["ITEMS"]))
			{
			foreach($arSection["ITEMS"] as $field)
			{
			?>
			<tr>
				<td width="50%"><?=$field["LABEL"]?></td>
				<td>
					<?
					switch($field["TYPE"])
					{
						case("USER_GROUP"):
						$arUserGroupList = array();

						$rsUserGroups = CGroup::GetList(($by="sort"), ($order="asc"));
						while ($arGroup = $rsUserGroups->Fetch())
						{
							$arUserGroupList[] = array(
								'ID' => intval($arGroup['ID']),
								'NAME' => $arGroup['NAME'],
							);
						}
						?>
					<select name="<?=$field["CODE"]?>" id="<?=strtolower($field["CODE"])?>" multiple size="8">
					<?
					foreach ($arUserGroupList as &$arOneGroup)
					{
						?><option value="<? echo $arOneGroup["ID"]; ?>" <?if (in_array($arOneGroup["ID"], $field["VALUE"])) echo " selected"?>><? echo "[".$arOneGroup["ID"]."] ".htmlspecialcharsbx($arOneGroup["NAME"]); ?></option><?
					}
					if (isset($arOneGroup))
						unset($arOneGroup);
					?>
					</select>
						<?
						break;
						case("IBLOCK"):
							echo GetIBlockDropDownListEx(
								intVal($field["VALUE"]),
								'IBLOCK_TYPE_ID',
								'IBLOCK_ID',
								array(
									"MIN_PERMISSION" => $field["PARAMS"]["MIN_PERMISSION"],
								),
								'',
								'',
								'class="adm-detail-iblock-types select-search"',
								'class="adm-detail-iblock-list select-search"'
							);
							if($field['REFRESH'] == 'Y')
								echo '<input type="submit" name="apply" value="'.GetMessage("APPLY").'" />';
							break;
						break;
						case("LIST"):
						case("SELECT"):
						//var_dump($field["VALUE"]);
						?>
					<select name="<?=$field["CODE"]?>" id="<?=strtolower($field["CODE"])?>"<?if($field["REFRESH"] == "Y") {?> onchange="this.form.submit()"<? } ?> class="select-search"<?if($field["PARAMS"]["MULTIPLE"] == "Y") {?> multiple<? } ?>>
						<?foreach($field["ITEMS"] as $id => $value):?>
						<option value="<?=$id?>" <?if($field["VALUE"]==$id || (is_array($field["VALUE"]) && in_array($id, $field["VALUE"]))) echo 'selected';?>><?=$value?></option>
						<?endforeach;?>
					</select>
						<?
						if($field['REFRESH'] == 'Y')
							echo '<input type="submit" name="apply" value="'.GetMessage("APPLY").'" />';
						break;
						case("RANGE"):
						?>
					<?=GetMessage("FROM")?>: <input type="text" name="<?=$field["CODE"]?>[MIN]" size="3"  maxlength="<?=$field["PARAMS"]["MAXLENGTH"]?>" value="<?=$field["VALUE"]["MIN"]?>">
					<?=GetMessage("TO")?>: <input type="text" name="<?=$field["CODE"]?>[MAX]" size="3"  maxlength="<?=$field["PARAMS"]["MAXLENGTH"]?>" value="<?=$field["VALUE"]["MAX"]?>">
						<?
						break;
						case("TEXT"):
						?>
					<input type="text" name="<?=$field["CODE"]?>" size="<?=$field["PARAMS"]["SIZE"]?>"  maxlength="<?=$field["PARAMS"]["MAXLENGTH"]?>" value="<?=$field["VALUE"]?>">
						<?
						break;
						case("NUMBER"):
						?>
					<input type="number" class="adm-input" name="<?=$field["CODE"]?>" size="<?=$field["PARAMS"]["SIZE"]?>" min="<?=$field["PARAMS"]["MIN"]?>" max="<?=$field["PARAMS"]["MAX"]?>"  maxlength="<?=$field["PARAMS"]["MAXLENGTH"]?>" value="<?=$field["VALUE"]?>">
						<?
						break;
						case("CHECKBOX"):?>
					<input type="hidden" name="<?=$field["CODE"]?>" value="N">
					<input type="checkbox" name="<?=$field["CODE"]?>" id="<?=strtolower($field["CODE"])?>" value="<?=($field["VALUE"]?$field["VALUE"]:'N')?>" onClick="javascript:WebprostorCoreCheckActive('<?=strtolower($field["CODE"])?>')"<?if($field["VALUE"]=="Y") echo ' checked';?>>
						<?
						break;
						case("FILE"):?>
						<input type="file" name="<?=$field["CODE"]?>"<?if($field["PARAMS"]["MULTIPLE"] == "Y") {?> multiple<? } ?> accept="<?=$field["PARAMS"]["ACCEPT"]?>" >
						<?
						break;
						default:?>
						<?=$field["VALUE"]?>
						<?
						break;
					} 
					?>
					<?
					if($field["DESCRIPTION"])
					{
					?>
					<a href="javascript:;" title="<?=$field["DESCRIPTION"]?>">(?)</a>
					<?
					} 
					?>
				</td>
			</tr>
			<?
			}
			}
			} 
		} 
	}
}
?>