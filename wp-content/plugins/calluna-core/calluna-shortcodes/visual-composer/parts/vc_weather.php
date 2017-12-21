<?php

// VC Weather ------------------------------------------------------------------------ >
function calluna_core_vc_weather_shortcode() {
	vc_map(array(
		"name"                    => esc_html__("Calluna Weather", 'calluna-shortcodes'),
		"description"             => esc_html__("Show the weather", 'calluna-shortcodes'),
		"base"                    => "simple-weather",
		"class"                   => "",
		"controls"                => "full",
		"icon"                    => "calluna_vc_icon",
		"category"                => esc_html__("Calluna", 'calluna-shortcodes'),
		"show_settings_on_create" => TRUE,
		"params"                  => array(
			array(
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Location", 'calluna-shortcodes'),
				"description" => esc_html__("Add city", 'calluna-shortcodes'),
				"param_name"  => "location",
				"value"       => "Hanover, GER"
			),
			array(
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Latitude", 'calluna-shortcodes'),
				"description" => esc_html__("Add latitude", 'calluna-shortcodes'),
				"param_name"  => "latitude",
				"value"       => ""
			),
			array(
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Longitude", 'calluna-shortcodes'),
				"description" => esc_html__("Add longitude", 'calluna-shortcodes'),
				"param_name"  => "longitude",
				"value"       => ""
			),
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Units", 'calluna-shortcodes'),
				"description" => esc_html__("Internal, metric or imperial", 'calluna-shortcodes'),
				"param_name"  => "units",
				"value"       => array(
					esc_html__("Internal", 'calluna-shortcodes')  => 'internal',
					esc_html__("Metric", 'calluna-shortcodes')  => 'metric',
					esc_html__("Imperial", 'calluna-shortcodes')  => 'imperial'
				),
			),
			array(
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Date", 'calluna-shortcodes'),
				"description" => esc_html__("Date format according to: http://php.net/manual/ro/function.date.php", 'calluna-shortcodes'),
				"param_name"  => "date",
				"value"       => ""
			),
		),
	));
}
add_action( 'vc_before_init', 'calluna_core_vc_weather_shortcode' );

?>