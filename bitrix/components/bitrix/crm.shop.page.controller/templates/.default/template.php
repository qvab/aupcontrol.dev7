<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

Bitrix\Main\Page\Asset::getInstance()->addJs("/bitrix/js/main/hot_keys.js");

$selfFolderUrl = "/shop/settings/";

$orderMenuUrl = "/shop/orders/";
if (\Bitrix\Crm\Settings\OrderSettings::getCurrent()->getCurrentListViewID() == \Bitrix\Crm\Settings\OrderSettings::VIEW_KANBAN)
{
	$orderMenuUrl = "/shop/orders/kanban/";
}

$additionalList = array(
	array(
		"parent_menu" => "global_menu_store",
		"sort" => 100,
		"text" => GetMessage("SHOP_MENU_ORDER_TITLE"),
		"title" => GetMessage("SHOP_MENU_ORDER_TITLE"),
		"url" => $orderMenuUrl,
		"url_constant" => true,
		"items_id" => "orders",
	),
	array(
		"parent_menu" => "menu_sale_buyers",
		"sort" => 401,
		"text" => GetMessage("SHOP_MENU_BUYER_GROUP_TITLE"),
		"title" => GetMessage("SHOP_MENU_BUYER_GROUP_TITLE"),
		"url" => "/shop/buyer_group/",
		"url_constant" => true,
		"items_id" => "buyer_group_settings",
	),
	array(
		"parent_menu" => "menu_sale_settings",
		"sort" => 710.05,
		"text" => GetMessage("SHOP_MENU_SETTINGS_SALE_SETTINGS"),
		"title" => GetMessage("SHOP_MENU_SETTINGS_SALE_SETTINGS"),
		"url" => "/crm/configs/sale/?type=common",
		"url_constant" => true,
		"items_id" => "csc_sale_settings",
	),
	array(
		"parent_menu" => "menu_sale_settings",
		"sort" => 710.1,
		"text" => GetMessage("SHOP_MENU_ORDER_FORM_SETTINGS_TITLE"),
		"title" => GetMessage("SHOP_MENU_ORDER_FORM_SETTINGS_TITLE"),
		"url" => "/shop/orderform/",
		"url_constant" => true,
		"items_id" => "form_order_settings",
	),
	array(
		"parent_menu" => "global_menu_store",
		"sort" => 699,
		"text" => GetMessage("SHOP_MENU_PRODUCT_MARKETING_TITLE"),
		"title" => GetMessage("SHOP_MENU_PRODUCT_MARKETING_TITLE"),
		"url" => "sale_discount.php",
		"items_id" => "menu_sale_discounts",
		"items" => array(
			array(
				"parent_menu" => "menu_sale_discounts",
				"sort" => 699.1,
				"text" => GetMessage("SHOP_MENU_PRODUCT_MARKETING_PRESET"),
				"title" => GetMessage("SHOP_MENU_PRODUCT_MARKETING_PRESET"),
				"url" => "sale_discount_preset_list.php",
				"items_id" => "sale_discount_preset_list",
			),
			array(
				"parent_menu" => "menu_sale_discounts",
				"sort" => 699.2,
				"text" => GetMessage("SHOP_MENU_PRODUCT_MARKETING_DISCOUNT"),
				"title" => GetMessage("SHOP_MENU_PRODUCT_MARKETING_DISCOUNT"),
				"url" => "sale_discount.php",
				"items_id" => "sale_discount",
			),
			array(
				"parent_menu" => "menu_sale_discounts",
				"sort" => 699.3,
				"text" => GetMessage("SHOP_MENU_PRODUCT_MARKETING_COUPONS"),
				"title" => GetMessage("SHOP_MENU_PRODUCT_MARKETING_COUPONS"),
				"url" => "sale_discount_coupons.php",
				"items_id" => "sale_discount_coupons",
			)
		)
	),
	array(
		"parent_menu" => "menu_sale_settings",
		"sort" => 709.1,
		"text" => GetMessage("SHOP_MENU_SETTINGS_STATUS"),
		"title" => GetMessage("SHOP_MENU_SETTINGS_STATUS"),
		"url_constant" => true,
		"items_id" => "crm_sale_status",
		"items" => array(
			array(
				"parent_menu" => "crm_sale_status",
				"sort" => 709.2,
				"text" => GetMessage("SHOP_MENU_SETTINGS_STATUS_ORDER"),
				"title" => GetMessage("SHOP_MENU_SETTINGS_STATUS_ORDER"),
				"url" => "/crm/configs/sale/?type=order",
				"url_constant" => true,
				"items_id" => "crm_sale_status_orders",
			),
			array(
				"parent_menu" => "crm_sale_status",
				"sort" => 709.3,
				"text" => GetMessage("SHOP_MENU_SETTINGS_STATUS_ORDER_SHIPMENT"),
				"title" => GetMessage("SHOP_MENU_SETTINGS_STATUS_ORDER_SHIPMENT"),
				"url" => "/crm/configs/sale/?type=shipment",
				"url_constant" => true,
				"items_id" => "crm_sale_status_shipment",
			),
		)
	),
	array(
		"parent_menu" => "menu_sale_settings",
		"sort" => 711,
		"text" => GetMessage("SHOP_MENU_SETTINGS_USER_FIELDS"),
		"title" => GetMessage("SHOP_MENU_SETTINGS_USER_FIELDS"),
		"url" => "/crm/configs/sale/?type=fields",
		"url_constant" => true,
		"items_id" => "userfield_edit",
	)
);

if (CCrmSaleHelper::isShopAccess("admin"))
{
	if (
		false && // @tmp disabled
		\Bitrix\Main\Loader::includeModule("landing") &&
		(
			is_callable(["\Bitrix\Landing\Rights", "isAdmin"]) &&
			\Bitrix\Landing\Rights::isAdmin()
		)
	)
	{
		$additionalList[] = array(
			"parent_menu" => "global_menu_store",
			"sort" => 150,
			"text" => GetMessage("SHOP_MENU_SHOP_TITLE"),
			"title" => GetMessage("SHOP_MENU_SHOP_TITLE"),
			"url" => "/shop/stores/",
			"url_constant" => true,
			"items_id" => "stores",
			"items" => array(
				array(
					"parent_menu" => "global_menu_store",
					"sort" => 150.2,
					"text" => GetMessage("SHOP_MENU_SHOP_LIST_TITLE"),
					"title" => GetMessage("SHOP_MENU_SHOP_LIST_TITLE"),
					"url" => "/shop/stores/",
					"url_constant" => true,
					"items_id" => "menu_store_list",
				),
				array(
					"parent_menu" => "global_menu_store",
					"sort" => 150.3,
					"text" => GetMessage("SHOP_MENU_SHOP_ROLES_TITLE"),
					"title" => GetMessage("SHOP_MENU_SHOP_ROLES_TITLE"),
					"url" => "/shop/stores/roles/",
					"url_constant" => true,
					"items_id" => "menu_store_role",
				),
			)
		);
	}
	else
	{
		$additionalList[] = array(
			"parent_menu" => "global_menu_store",
			"sort" => 150,
			"text" => GetMessage("SHOP_MENU_SHOP_TITLE"),
			"title" => GetMessage("SHOP_MENU_SHOP_TITLE"),
			"url" => "/shop/stores/",
			"url_constant" => true,
			"items_id" => "stores",
		);
	}
}

$ignorePageList = ["menu_order", "sale_cashbox_zreport", "1c_admin", "sale_crm", "update_system_market",
	"menu_sale_stat", "menu_sale_affiliates", "sale_company", "menu_sale_properties", "sale_archive",
	"sale_report_edit", "menu_sale_trading_platforms", "sale_location_zone_list", "sale_location_default_list",
	"sale_location_external_service_list", "sale_recurring_admin", "mnu_catalog_exp", "mnu_catalog_imp",
	"menu_sale_bizval", "sale_status", "sale_ps_handler_refund"
];

if (!CCrmSaleHelper::isShopAccess('admin'))
{
	$ignorePageList = array_merge($ignorePageList, ["menu_sale_discounts", "menu_sale_settings"]);
}

$APPLICATION->IncludeComponent(
	"bitrix:crm.admin.page.controller",
	"",
	array(
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => $selfFolderUrl,
		"MENU_ID" => "store",
		"PATH_TO_BASE_PAGE" => "",
		"ADDITIONAL_PARAMS" => $arResult["ADDITIONAL_PARAMS"],
		"CONNECT_PAGE" => $arResult["CONNECT_PAGE"],
		"ADDITIONAL_LIST" => $additionalList,
		"INTERNAL_PAGE_LIST" => array(
			"iblock_element_edit" => $selfFolderUrl."iblock_element_edit.php",
			"cat_product_edit" => $selfFolderUrl."cat_product_edit.php",
			"cat_section_edit" => $selfFolderUrl."cat_section_edit.php",
			"userfield_edit" => $selfFolderUrl."userfield_edit.php",
			"iblock_edit_property" => $selfFolderUrl."iblock_edit_property.php",
			"cat_catalog_edit" => $selfFolderUrl."cat_catalog_edit.php",
			"sale_cashbox_edit" => $selfFolderUrl."sale_cashbox_edit.php",
			"sale_buyers_profile" => $selfFolderUrl."sale_buyers_profile.php",
			"sale_buyers_profile_edit" => $selfFolderUrl."sale_buyers_profile_edit.php",
			"sale_account_edit" => $selfFolderUrl."sale_account_edit.php",
			"sale_transact_edit" => $selfFolderUrl."sale_transact_edit.php",
			"cat_store_document_edit" => $selfFolderUrl."cat_store_document_edit.php",
			"cat_contractor_edit" => $selfFolderUrl."cat_contractor_edit.php",
			"cat_store_edit" => $selfFolderUrl."cat_store_edit.php",
			"sale_discount_edit" => $selfFolderUrl."sale_discount_edit.php",
			"sale_discount_preset_detail" => $selfFolderUrl."sale_discount_preset_detail.php",
			"sale_discount_coupon_edit" => $selfFolderUrl."sale_discount_coupon_edit.php",
			"sale_discount_preset_list" => $selfFolderUrl."sale_discount_preset_list.php",
			"sale_delivery_service_edit" => $selfFolderUrl."sale_delivery_service_edit.php",
			"sale_delivery_eservice_edit" => $selfFolderUrl."sale_delivery_eservice_edit.php",
			"sale_pay_system_edit" => $selfFolderUrl."sale_pay_system_edit.php",
			"sale_yandexinvoice_settings" => $selfFolderUrl."sale_yandexinvoice_settings.php",
			"sale_person_type_edit" => $selfFolderUrl."sale_person_type_edit.php",
			"sale_tax_edit" => $selfFolderUrl."sale_tax_edit.php",
			"sale_tax_rate_edit" => $selfFolderUrl."sale_tax_rate_edit.php",
			"cat_vat_edit" => $selfFolderUrl."cat_vat_edit.php",
			"sale_tax_exempt_edit" => $selfFolderUrl."sale_tax_exempt_edit.php",
			"cat_measure_edit" => $selfFolderUrl."cat_measure_edit.php",
			"cat_group_edit" => $selfFolderUrl."cat_group_edit.php",
			"cat_round_edit" => $selfFolderUrl."cat_round_edit.php",
			"cat_extra_edit" => $selfFolderUrl."cat_extra_edit.php",
			"sale_location_node_edit" => $selfFolderUrl."sale_location_node_edit.php",
			"sale_location_reindex" => $selfFolderUrl."sale_location_reindex.php",
			"sale_location_group_edit" => $selfFolderUrl."sale_location_group_edit.php",
			"sale_location_type_edit" => $selfFolderUrl."sale_location_type_edit.php",
			"sale_location_import" => $selfFolderUrl."sale_location_import.php",
			"iblock_subelement_edit" => $selfFolderUrl."iblock_subelement_edit.php",
			"report_view" => $selfFolderUrl."sale_report_view.php",
		),
		"IGNORE_PAGE_LIST" => $ignorePageList,
		"SIDE_PANEL_PAGE_LIST" => array(
			"sale_location_import",
			"sale_location_reindex",
			"menu_sale_bizval",
			"sale_business_value_ptypes",
			"menu_catalog_edit",
			"form_order_settings",
			"sale_discount_preset_list",
		),
	)
);
?>

<script>
	BX.ready(function() {
		new BX.Sale.ShopPublic();
	});
</script>
