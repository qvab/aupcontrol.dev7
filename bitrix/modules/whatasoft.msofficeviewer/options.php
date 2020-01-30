<?php
if (!$USER->IsAdmin()) {
	return;
}

IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/options.php');
IncludeModuleLangFile(__FILE__);

include_once __DIR__ . '/default_option.php';

$tabControl = new CAdminTabControl(
	'tabControl',
	array(
		array(
			'DIV' => 'edit1',
			'TAB' => GetMessage('MAIN_TAB_SET'),
			'ICON' => 'ib_settings',
			'TITLE' => GetMessage('MAIN_TAB_TITLE_SET')
		),
	)
);
$allOptions = array(
	array('msov_use_accessibility_mode', 'Y', GetMessage('MSOV_USE_ACCESSIBILITY_MODE'), array('checkbox', 'Y'))
);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($_POST['Update'] || $_POST['Apply'] || $_POST['RestoreDefaults']) > 0 && check_bitrix_sessid()) {
	if (strlen($_POST['RestoreDefaults']) > 0) {
		foreach (array_keys($msOfficeViewerDefaultOption) as $option) {
			COption::RemoveOption($mid, $option);
		}

	} else {
		foreach ($allOptions as $option) {
			$value = $_REQUEST[$option[0]];

			if ($option[3][0] == 'checkbox' && $value != 'Y') {
				$value = 'N';
			}

			COption::SetOptionString($mid, $option[0], $value, $option[1]);
		}

		if (strlen($_POST['Update']) > 0 && strlen($_REQUEST['back_url_settings']) > 0) {
			LocalRedirect($_REQUEST['back_url_settings']);

		} else {
			LocalRedirect($APPLICATION->GetCurPage() . '?mid=' . urlencode($mid) . '&lang=' . urlencode(LANGUAGE_ID) . '&back_url_settings=' . urlencode($_REQUEST['back_url_settings']) . '&' . $tabControl->ActiveTabParam());
		}
	}
}
?>
<form method="post" action="<?php echo $APPLICATION->GetCurPage(); ?>?mid=<?php echo urlencode($mid); ?>&amp;lang=<?php echo LANGUAGE_ID; ?>">
<?php $tabControl->Begin(); ?>
<?php $tabControl->BeginNextTab(); ?>
	<?php foreach ($allOptions as $option) {
		$value = COption::GetOptionString($mid, $option[0], $option[1]);
		$type = $option[3];
	?>
		<tr>
			<td width="40%" nowrap <?php echo $type[0] == 'textarea' ? 'class="adm-detail-valign-top"' : ''; ?>>
				<label for="<?php echo htmlspecialcharsbx($option[0]); ?>"><?php echo $option[2]; ?>:</label>
			</td>
			<td width="60%">
				<?php
				switch ($type[0]) {
					case 'checkbox':
						?><input type="checkbox" id="<?php echo htmlspecialcharsbx($option[0]); ?>" name="<?php echo htmlspecialcharsbx($option[0]); ?>" value="Y"<?php echo $value == 'Y' ? ' checked' : ''; ?>><?
						break;

					case 'text':
						?><input type="text" size="<?php echo $type[1]; ?>" maxlength="255" value="<?php echo htmlspecialcharsbx($value); ?>" name="<?php echo htmlspecialcharsbx($option[0]); ?>"><?php
						break;

					case 'textarea':
						?><textarea rows="<?php echo $type[1]; ?>" cols="<?php echo $type[2]; ?>" name="<?php echo htmlspecialcharsbx($option[0]); ?>"><?php echo htmlspecialcharsbx($value); ?></textarea><?php
						break;

					case 'selectbox':
						?><select name="<?echo htmlspecialcharsbx($arOption[0])?>"><?php
							foreach ($type[1] as $key => $value) {
								?><option value="<?php echo $key; ?>"<?php echo ($key == $val) ? ' selected' : ''; ?>><?php echo $value; ?></option><?
							}
						?></select><?php
						break;
				}
				?>
				&nbsp;<?php echo empty($notices[$option[0]]) ? '' : $notices[$option[0]]; ?>
			</td>
		</tr>
	<?php } ?>
<?php $tabControl->Buttons(); ?>
	<input type="submit" name="Update" value="<?php echo GetMessage('MAIN_SAVE'); ?>" title="<?php echo GetMessage('MAIN_OPT_SAVE_TITLE'); ?>" class="adm-btn-save">
	<input type="submit" name="Apply" value="<?php echo GetMessage('MAIN_OPT_APPLY'); ?>" title="<?php echo GetMessage('MAIN_OPT_APPLY_TITLE'); ?>">
	<?php if (strlen($_REQUEST["back_url_settings"]) > 0) { ?>
		<input type="button" name="Cancel" value="<?php echo GetMessage('MAIN_OPT_CANCEL'); ?>" title="<?php echo GetMessage('MAIN_OPT_CANCEL_TITLE'); ?>" onclick="window.location='<?php echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST['back_url_settings'])); ?>'">
		<input type="hidden" name="back_url_settings" value="<?php echo htmlspecialcharsbx($_REQUEST['back_url_settings']); ?>">
	<?php } ?>
	<input type="submit" name="RestoreDefaults" title="<?php echo GetMessage('MAIN_HINT_RESTORE_DEFAULTS'); ?>" onclick="return confirm('<?php echo addslashes(GetMessage('MAIN_HINT_RESTORE_DEFAULTS_WARNING')); ?>')" value="<?php echo GetMessage('MAIN_RESTORE_DEFAULTS'); ?>">
	<?php echo bitrix_sessid_post(); ?>
<?php $tabControl->End(); ?>
</form>
