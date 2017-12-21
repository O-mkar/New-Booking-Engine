<?php
/**
 * Set up standard theme functionality
 */
require_once get_template_directory() . '/framework/nav-menu/custom-menu.php';
require_once get_template_directory() . '/framework/menu_widgets.php';
require_once get_template_directory() . '/framework/theme-functions.php';
require_once get_template_directory() . '/framework/enqueue.php';
require_once get_template_directory() . '/framework/template-tags.php';
require_once get_template_directory() . '/framework/extras.php';
require_once get_template_directory() . '/framework/theme-support.php';

//Custom Metaboxes
require_once get_template_directory() . '/metabox-functions.php';

/**
 * Set up customizer settings
 */
require_once get_template_directory() . '/framework/customizer.php';

/**
 * Load TGM Plugin Activation Class only in admin mode
 */
if( is_admin() ){
    if (! class_exists( 'TGM_Plugin_Activation' ) ) {
        require_once get_template_directory() . '/framework/classes/class-tgm-plugin-activation.php';
    }
    //Install plugins
    require_once get_template_directory() . '/framework/config/plugin-setup.php';
    
    //Define custom meta boxes
    require_once get_template_directory() . '/framework/classes/meta-boxes.php';
    
    //Add demo import
    require_once get_template_directory() . '/framework/config/demo-import.php';
}

/**
 * If WPML exists, let's load in our custom functions.
 */
if ( class_exists( 'SitePress' ) ) {
    require_once get_template_directory() . '/framework/config/wpml.php';
}

/**
 * If Contact Form 7 exists, let's load in our custom functions.
 */
if(defined('WPCF7_VERSION')) {
	require_once get_template_directory() . '/framework/config/contact-form-7.php';
}

//Custom Ajax Callbacks
require_once get_template_directory() . '/framework/config/calluna-ajax.php';

/**
 * If WooCommerce exists, let's load in our custom functions.
 */
if( class_exists('Woocommerce') ){
    require_once get_template_directory() . '/framework/config/woocommerce.php';
}

/**
 * If Masterslider exists, let's load in our custom functions.
 */
if ( defined('MSWP_AVERTA_VERSION') ) { 
    require_once get_template_directory() . '/framework/config/masterslider.php';
}

/**
 * If Hotelier exists, let's load in our custom functions.
 */
if ( class_exists('Hotelier') ) {
	require get_template_directory() . '/framework/config/hotelier.php';
}

/**
 *  Load Jetpack compatibility file.
 */
if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
    require_once get_template_directory() . '/framework/classes/jetpack.php';
    
}

require_once get_template_directory() . '/framework/classes/sanitize-data.php';
