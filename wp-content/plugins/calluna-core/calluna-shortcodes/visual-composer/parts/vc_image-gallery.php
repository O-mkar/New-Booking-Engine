<?php

// VC Image Gallery ------------------------------------------------------------------------ >
function calluna_core_vc_image_gallery_shortcode() {
	vc_map(array(
			"name"                    => esc_html__("Calluna Gallery", 'calluna-shortcodes'),
			"base"                    => "cl_gallery",
			"class"                   => "",
			"controls"                => "full",
			"icon"                    => "calluna_vc_icon",
			"category"                => esc_html__("Calluna", 'calluna-shortcodes'),
			"show_settings_on_create" => TRUE,
			"params"                  => array(
				array(
					"type"        => "attach_images",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Select images", 'calluna-shortcodes'),
					"param_name"  => "images",
					"value"       => "",
				),
				array(
					"type"        => "dropdown",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Image Links", 'calluna-shortcodes'),
					"param_name"  => "link_images",
					"value"       => array(
						esc_html__("No Link", 'calluna-shortcodes')                    => 'none',
						esc_html__("Open Image in PrettyPhoto", 'calluna-shortcodes') => 'prettyphoto',
						esc_html__("Link Image in new tab", 'calluna-shortcodes')     => 'newtab'
					),
				),
			)
		));
}
add_action( 'vc_before_init', 'calluna_core_vc_image_gallery_shortcode' );

?>