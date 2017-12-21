<?php

// VC Booking Calendar --------------------------------------------------------------- >
function calluna_core_vc_datepicker_shortcode() {
	vc_map(array(
			"name"                    => esc_html__("Calluna Booking Calendar", 'calluna-shortcodes'),
			"description"             => esc_html__("Choose dates", 'calluna-shortcodes'),
			"base"                    => "cl_datepicker",
			"class"                   => "",
			"controls"                => "full",
			"icon"                    => "calluna_vc_icon",
			"category"                => esc_html__("Calluna", 'calluna-shortcodes'),
			"show_settings_on_create" => TRUE,
			"params"                  => array(
				array(
					"type"        => "label",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Info", 'calluna-shortcodes'),
					"param_name"  => "calendar_label",
				))
		));
}
add_action( 'vc_before_init', 'calluna_core_vc_datepicker_shortcode' );

?>