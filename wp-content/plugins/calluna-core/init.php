<?php
/**
 * Turn on the image resizer.
 */
require_once( CALLUNA_CORE_PATH . 'inc/image-resize.php' );

/**
 * Register post meta boxes
 */
require_once( CALLUNA_CORE_PATH . 'meta-box/meta-box.php' );
require_once( CALLUNA_CORE_PATH . 'meta-box/meta-box-tabs/meta-box-tabs.php' );
require_once( CALLUNA_CORE_PATH . 'meta-box/meta-box-group/meta-box-group.php' );
require_once( CALLUNA_CORE_PATH . 'meta-box/meta-box-conditional-logic/meta-box-conditional-logic.php' );

/**
 * Register appropriate shortcodes
 */
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/calluna-shortcodes.php' );

/**
 * Register appropriate widgets
 */
require_once( CALLUNA_CORE_PATH . 'widgets/calluna-widgets.php' );

/**
 * Register Event Post Type
 */
require_once( CALLUNA_CORE_PATH . 'calluna-post-types/event/event_init.php' );

/**
 * Register Offer Post Type
 */
require_once( CALLUNA_CORE_PATH . 'calluna-post-types/offer/offer_init.php' );

/**
 * Include Demo Importer
 */
require_once( CALLUNA_CORE_PATH . 'calluna-demo-importer/one-click-demo-import.php' );

/**
 * Include Sanitize
 */
require_once( CALLUNA_CORE_PATH . 'inc/sanitize-data.php' );

/**
 * Include TTBase Admin Section
 */
require_once( CALLUNA_CORE_PATH . 'admin/admin.php' );