<?php
/**
 * Plugin Name: Calluna Core Plugin
 * Plugin URI: http://www.themetwins.com
 * Description: Calluna Core - Main functions for the Calluna Hotel Theme
 * Version: 1.0.2
 * Author: Themetwins
 * Author URI: http://www.themetwins.com
 * Text Domain: calluna-shortcodes
*/


/**
 * Plugin definitions
 */
define( 'CALLUNA_CORE_PATH', trailingslashit(plugin_dir_path(__FILE__)) );
define( 'CALLUNA_CORE_URL', trailingslashit(plugin_dir_url(__FILE__)) );
define( 'CALLUNA_CORE_VERSION', '1.0.2');


// Register de-activation hook
register_deactivation_hook( __FILE__, 'calluna_core_on_deactivation' );
/*
 * Deactivate Plugins "Calluna Shortcodes", "Calluna Custom Posts"
 * and "Calluna Importer". Functionality is now in "Calluna Core"
*/
add_action( 'admin_init', 'calluna_core_plugin_activation' );

function calluna_core_plugin_activation() {
	deactivate_plugins('calluna-shortcodes/calluna-shortcodes.php');
	deactivate_plugins('calluna-custom-posts/calluna-custom-posts.php');
	deactivate_plugins('calluna-importer/calluna-importer.php');	
	
		// If dismiss meta is saved bail
	if ( get_user_meta( get_current_user_id(), 'calluna_core_plugin_admin_notice_dismiss', true ) ) {
		return;
	}
	
	// If the dimiss notice icon is clicked update user meta
	if ( isset( $_GET['calluna-core-dismiss'] ) ) {
		calluna_core_plugin_admin_notice_dismiss();
		return;
	}
	
	// Apply filters so you can disable the notice via the theme
	$show_calluna_core_admin_notice = apply_filters( 'calluna_core_plugin_admin_notice', true );
	
	// Show notice
	if ( $show_calluna_core_admin_notice ) {
		add_action( 'admin_notices', 'calluna_core_plugin_admin_notice' );
	}
}

function calluna_core_plugin_admin_notice() {
			echo '<div class="updated notice is-dismissable calluna-vc-notice">
					<a href="' . esc_url( add_query_arg( 'calluna-core-dismiss', '1' ) ). '" class="dismiss-notice" target="_parent"><span class="dashicons dashicons-no-alt" style="display:block;float:right;margin:10px 0 10px 10px;"></span></a>
					<p><strong>Plug-ins Calluna Shortcodes, Calluna Custom Posts and Calluna Importer</strong> were folded into Calluna Core. The plug-ins has been <strong>deactivated</strong>.</p></div>';
}

/**
 * Update user meta for dismissing the notice
 */
function calluna_core_plugin_admin_notice_dismiss() {
	update_user_meta( get_current_user_id(), 'calluna_core_plugin_admin_notice_dismiss', 1 );
}

/**
 * Delete notice dismiss
 */
function calluna_core_plugin_admin_notice_dismiss_delete() {
	delete_user_meta( get_current_user_id(), 'calluna_core_plugin_admin_notice_dismiss' );
}

/**
 * Run on plugin de-activation
 */
function calluna_core_on_deactivation() {

	// Remove user meta for the plugin notice
	calluna_core_plugin_admin_notice_dismiss_delete();

}


/**
 * Enqueue styles & scripts
 */
if(!( function_exists('calluna_core_scripts') )){
	function calluna_core_scripts(){
		wp_enqueue_style('font-awesome', plugins_url( '/css/font-awesome.min.css' , __FILE__ ) );
		wp_enqueue_style('calluna-core-plugins', plugins_url( '/css/plugins.min.css' , __FILE__ ) );
		wp_enqueue_style('calluna-core-shortcodes', plugins_url( '/css/shortcodes.min.css' , __FILE__ ) );
	}
	add_action('wp_enqueue_scripts', 'calluna_core_scripts', 10);
}

/**
 * Load text domain
 */
if(!( function_exists('calluna_core_load_plugin_textdomain') )){
    function calluna_core_load_plugin_textdomain(){
        load_plugin_textdomain('calluna-shortcodes', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
    }
    add_action('init', 'calluna_core_load_plugin_textdomain');
}

/**
 * Init framework functions based on theme options
 */
require_once( CALLUNA_CORE_PATH . 'init.php' );