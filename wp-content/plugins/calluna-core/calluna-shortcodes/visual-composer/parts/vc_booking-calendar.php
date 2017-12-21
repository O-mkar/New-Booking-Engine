<?php

// VC Booking Calendar --------------------------------------------------------------- >
function calluna_core_vc_booking_calendar_shortcode() {
	vc_map(array(
			"name"                    => esc_html__("Calluna Booking Calendar", 'calluna-shortcodes'),
			"description"             => esc_html__("Choose dates", 'calluna-shortcodes'),
			"base"                    => "cl_booking_calendar",
			"icon"                    => "calluna_vc_icon",
			"category"                => esc_html__("Calluna", 'calluna-shortcodes'),
			"params"                  => array(
				array(
					"type"        => "label",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Info", 'calluna-shortcodes'),
					"param_name"  => "calendar_label",
					"value"       => ""
				))
		));
}
add_action( 'vc_before_init', 'calluna_core_vc_booking_calendar_shortcode' );

?>