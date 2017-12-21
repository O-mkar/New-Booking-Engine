<?php
global $pagenow;

function calluna_core_welcome_page(){
	require_once CALLUNA_CORE_PATH . 'admin/admin-pages/welcome.php';
}

function calluna_core_admin_menu(){
	if ( current_user_can( 'edit_theme_options' ) ) {
		add_theme_page( 'Calluna Theme', 'Calluna Theme', 'manage_options', 'calluna_core_welcome_page','calluna_core_welcome_page');
	}
}

add_action( 'admin_menu', 'calluna_core_admin_menu' );

/**
 * Remove top margin for admin bar
 */
function calluna_core_remove_adminbar_margin()
{
	remove_action('wp_head', '_admin_bar_bump_cb');
}

add_action('get_header', 'calluna_core_remove_adminbar_margin');

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
    header( 'Location: '.admin_url().'plugins.php');
}

function calluna_core_load_admin_script()
{
    wp_enqueue_script( 'jquery-tiptip', CALLUNA_CORE_URL . 'admin/assets/js/jquery.tipTip.min.js', array( 'jquery' ), '1.0', true );
}
add_action('admin_enqueue_scripts', 'calluna_core_load_admin_script');

function calluna_core_init_admin_css()
{
	wp_enqueue_style('calluna-admin', CALLUNA_CORE_URL . 'admin/assets/css/calluna-admin.css', false, '1.0');
}

add_action('admin_init', 'calluna_core_init_admin_css');