<?php

// VC Time ------------------------------------------------------------------------ >
function calluna_core_vc_time_shortcode() {
	vc_map(array(
			"name"                    => esc_html__("Calluna Local Time", 'calluna-shortcodes'),
			"description"             => esc_html__("show the local time", 'calluna-shortcodes'),
			"base"                    => "cl_time",
			"class"                   => "",
			"controls"                => "full",
			"icon"                    => "calluna_vc_icon",
			"category"                => esc_html__("Calluna", 'calluna-shortcodes'),
			"show_settings_on_create" => TRUE,
			"params"                  => array(
			
				array(
					"type"        => "dropdown",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Time icon", 'calluna-shortcodes'),
					"description" => esc_html__("show time icon", 'calluna-shortcodes'),
					"param_name"  => "icon",
					"value"       => array(
						esc_html__("yes", 'calluna-shortcodes')  => 'yes',
						esc_html__("no", 'calluna-shortcodes')  => 'no'
					),
				),
				array(
					"type"        => "colorpicker",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Icon Color", 'calluna-shortcodes'),
					"param_name"  => "icon_color",
					"value"       => ""
				),
				array(
					"type"        => "colorpicker",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Text Color", 'calluna-shortcodes'),
					"param_name"  => "text_color",
					"value"       => ""
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Time Format", 'calluna-shortcodes'),
					"param_name"  => "time_format",
					"value"       => "h:i A"
				),
			),
		));
}
add_action( 'vc_before_init', 'calluna_core_vc_time_shortcode' );

?>