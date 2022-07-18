<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite0d4d2a689cdab58e083e97ea06bb2b0
{
    public static $classMap = array (
        'PLLWC_Admin' => __DIR__ . '/../..' . '/admin/admin.php',
        'PLLWC_Admin_Coupons' => __DIR__ . '/../..' . '/admin/admin-coupons.php',
        'PLLWC_Admin_Menus' => __DIR__ . '/../..' . '/admin/admin-menus.php',
        'PLLWC_Admin_Orders' => __DIR__ . '/../..' . '/admin/admin-orders.php',
        'PLLWC_Admin_Product_Duplicate' => __DIR__ . '/../..' . '/admin/admin-product-duplicate.php',
        'PLLWC_Admin_Products' => __DIR__ . '/../..' . '/admin/admin-products.php',
        'PLLWC_Admin_Reports' => __DIR__ . '/../..' . '/admin/admin-reports.php',
        'PLLWC_Admin_Site_Health' => __DIR__ . '/../..' . '/admin/admin-site-health.php',
        'PLLWC_Admin_Status_Reports' => __DIR__ . '/../..' . '/admin/admin-status-reports.php',
        'PLLWC_Admin_Taxonomies' => __DIR__ . '/../..' . '/admin/admin-taxonomies.php',
        'PLLWC_Admin_WC_Install' => __DIR__ . '/../..' . '/admin/admin-wc-install.php',
        'PLLWC_Bookings' => __DIR__ . '/../..' . '/plugins/bookings.php',
        'PLLWC_Brands' => __DIR__ . '/../..' . '/plugins/wc-brands.php',
        'PLLWC_Composite_Products' => __DIR__ . '/../..' . '/plugins/composite-products.php',
        'PLLWC_Coupons' => __DIR__ . '/../..' . '/include/coupons.php',
        'PLLWC_Data_Store' => __DIR__ . '/../..' . '/include/data-store.php',
        'PLLWC_Dynamic_Pricing' => __DIR__ . '/../..' . '/plugins/dynamic-pricing.php',
        'PLLWC_Emails' => __DIR__ . '/../..' . '/include/emails.php',
        'PLLWC_Export' => __DIR__ . '/../..' . '/include/export.php',
        'PLLWC_Follow_Up_Emails' => __DIR__ . '/../..' . '/plugins/follow-up-emails.php',
        'PLLWC_Free_Gift_Coupons' => __DIR__ . '/../..' . '/plugins/free-gift-coupons.php',
        'PLLWC_Frontend' => __DIR__ . '/../..' . '/frontend/frontend.php',
        'PLLWC_Frontend_Account' => __DIR__ . '/../..' . '/frontend/frontend-account.php',
        'PLLWC_Frontend_Cart' => __DIR__ . '/../..' . '/frontend/frontend-cart.php',
        'PLLWC_Frontend_WC_Pages' => __DIR__ . '/../..' . '/frontend/frontend-wc-pages.php',
        'PLLWC_Import' => __DIR__ . '/../..' . '/include/import.php',
        'PLLWC_Install' => __DIR__ . '/../..' . '/include/install.php',
        'PLLWC_Links' => __DIR__ . '/../..' . '/include/links.php',
        'PLLWC_Links_Pro' => __DIR__ . '/../..' . '/include/links-pro.php',
        'PLLWC_Min_Max_Quantities' => __DIR__ . '/../..' . '/plugins/min-max-quantities.php',
        'PLLWC_Mix_Match' => __DIR__ . '/../..' . '/plugins/mix-match.php',
        'PLLWC_Object_Language_CPT' => __DIR__ . '/../..' . '/include/object-language-cpt.php',
        'PLLWC_Order_Language_CPT' => __DIR__ . '/../..' . '/include/order-language-cpt.php',
        'PLLWC_Plugins_Compat' => __DIR__ . '/../..' . '/plugins/plugins-compat.php',
        'PLLWC_Post_Types' => __DIR__ . '/../..' . '/include/post-types.php',
        'PLLWC_Product_Bundles' => __DIR__ . '/../..' . '/plugins/product-bundles.php',
        'PLLWC_Product_Data_Store_CPT' => __DIR__ . '/../..' . '/include/product-data-store-cpt.php',
        'PLLWC_Product_Language_CPT' => __DIR__ . '/../..' . '/include/product-language-cpt.php',
        'PLLWC_Products' => __DIR__ . '/../..' . '/include/products.php',
        'PLLWC_REST_API' => __DIR__ . '/../..' . '/include/rest-api.php',
        'PLLWC_REST_Order' => __DIR__ . '/../..' . '/include/rest-order.php',
        'PLLWC_REST_Product' => __DIR__ . '/../..' . '/include/rest-product.php',
        'PLLWC_Shipment_Tracking' => __DIR__ . '/../..' . '/plugins/shipment-tracking.php',
        'PLLWC_Stock' => __DIR__ . '/../..' . '/include/stock.php',
        'PLLWC_Stock_Manager' => __DIR__ . '/../..' . '/plugins/stock-manager.php',
        'PLLWC_Strings' => __DIR__ . '/../..' . '/include/strings.php',
        'PLLWC_Stripe' => __DIR__ . '/../..' . '/plugins/stripe.php',
        'PLLWC_Subscriptions' => __DIR__ . '/../..' . '/plugins/subscriptions.php',
        'PLLWC_Swatches' => __DIR__ . '/../..' . '/plugins/swatches.php',
        'PLLWC_Sync_Content' => __DIR__ . '/../..' . '/include/sync-content.php',
        'PLLWC_Table_Rate_Shipping' => __DIR__ . '/../..' . '/plugins/table-rate-shipping.php',
        'PLLWC_Translated_Object_Language_CPT' => __DIR__ . '/../..' . '/include/translated-object-language-cpt.php',
        'PLLWC_Variation_Data_Store_CPT' => __DIR__ . '/../..' . '/include/variation-data-store-cpt.php',
        'PLLWC_WCFD' => __DIR__ . '/../..' . '/plugins/wcfd.php',
        'PLLWC_Wizard' => __DIR__ . '/../..' . '/admin/wizard.php',
        'PLLWC_Xdata' => __DIR__ . '/../..' . '/include/xdata.php',
        'PLLWC_Xdata_Session_Manager' => __DIR__ . '/../..' . '/include/xdata-session-manager.php',
        'PLLWC_Yith_WCAS' => __DIR__ . '/../..' . '/plugins/yith-wcas.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInite0d4d2a689cdab58e083e97ea06bb2b0::$classMap;

        }, null, ClassLoader::class);
    }
}
