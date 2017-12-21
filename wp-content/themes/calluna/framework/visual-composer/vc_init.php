<?php

function calluna_vc_set_as_theme() {
	//vc_set_as_theme();
}
add_action( 'vc_before_init', 'calluna_vc_set_as_theme' );

add_action('admin_init', function()
{
    if(is_admin()) {
        setcookie('vchideactivationmsg', '1', strtotime('+3 years'), '/');
        setcookie('vchideactivationmsg_vc11', (defined('WPB_VC_VERSION') ? WPB_VC_VERSION : '1'), strtotime('+3 years'), '/');
    }
});

// REMOVE UPDATE NOTICE FOR VISUAL COMPOSER
function calluna_filter_plugin_updates( $value ) {
    if ( isset( $value ) && is_object( $value ) ) {
        unset($value->response[ 'js_composer_theme/js_composer.php' ]);
    }
}
add_filter( 'site_transient_update_plugins', 'calluna_filter_plugin_updates' );

/**
 * Removes "About" page in the Visual Composer
 */
function calluna_remove_welcome() {
    remove_submenu_page( 'vc-general', 'vc-welcome' );
}

//Use Visual Composer for pages and service post type
if (function_exists("vc_set_default_editor_post_types")) {
	vc_set_default_editor_post_types(array(
			"page",
			"offer",
			"event",
			"room"
		));
}

// Remove VC Teaser Metabox
if ( ! function_exists('calluna_vc_remove_teaserbox') ) {
	function calluna_vc_remove_teaserbox(){
		$post_types = get_post_types( '', 'names' ); 
		foreach ( $post_types as $post_type ) {
			remove_meta_box('vc_teaser',  $post_type, 'side');
		}
	}
}
add_action('do_meta_boxes', 'calluna_vc_remove_teaserbox');


// Remove Unnecessary Elements

vc_remove_element('vc_gmaps');
vc_remove_element("vc_button");
vc_remove_element("vc_cta");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
		
/* ------------------------------------------------------------------------------- */
/* Visual Composer Add Params
/* ------------------------------------------------------------------------------- */
/*-----------------------------------------------------------------------------------*/
/*	- Columns
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_column', array(
	'type'			=> 'dropdown',
	'heading'		=> esc_html__( 'Add extra style', 'calluna-td' ),
	'param_name'	=> 'style',
	'value'			=> array(
		esc_html__( 'Default', 'calluna-td' )		=> '',
		esc_html__( 'Style 1', 'calluna-td' )		=> 'column-style-1',
		esc_html__( 'Style 2', 'calluna-td' )	=> 'column-style-2'
	),
) );