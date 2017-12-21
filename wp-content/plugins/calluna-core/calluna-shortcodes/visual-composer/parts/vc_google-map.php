<?php

// VC Wpml ------------------------------------------------------------------------ >
function calluna_core_vc_gmap_shortcode() {
	vc_map(array(
			"name"                    => esc_html__("Calluna Google Map", 'calluna-shortcodes'),
			"base"                    => "cl_google_map",
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
					"heading"     => esc_html__("API Key", 'calluna-shortcodes'),
					"description" => sprintf( wp_kses( __( '<a href="%s" target="_blank">How to create API Key</a> for the google maps.', 'calluna-shortcodes' ), array(  'a' => array( 'href' => array(), 'target' =>array() ) ) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/' ) ),
					"param_name"  => "api_key",
					"value"       => "",
				),
				array(
					"type"        => "dropdown",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Map Type", 'calluna-shortcodes'),
					"param_name"  => "map_type",
					"value"       => array(
						esc_html__("Road Map", 'calluna-shortcodes')   => 'ROADMAP',
						esc_html__("Satellite", 'calluna-shortcodes') => 'SATELLITE',
						esc_html__("Hybrid", 'calluna-shortcodes')    => 'HYBRID',
						esc_html__("Terrain", 'calluna-shortcodes')   => 'TERRAIN'
					),
				),
				array(
					"type"        => "dropdown",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Map Style", 'calluna-shortcodes'),
					"param_name"  => "style",
					"value"       => array(
						esc_html__( 'Shades of Grey', 'calluna-shortcodes' ) 	=> "1",
					    esc_html__( 'Greyscale', 'calluna-shortcodes' ) 		=> "2",
						esc_html__( 'Light Gray', 'calluna-shortcodes' ) 		=> "3",
					    esc_html__( 'Midnight Commander', 'calluna-shortcodes' ) => "4",
						esc_html__( 'Blue water', 'calluna-shortcodes' ) 		=> "5",
						esc_html__( 'Icy Blue', 'calluna-shortcodes' ) 			=> "6",
						esc_html__( 'Bright and Bubbly', 'calluna-shortcodes' ) => "7",
						esc_html__( 'Pale Dawn', 'calluna-shortcodes' ) 		=> "8",
						esc_html__( 'Paper', 'calluna-shortcodes' ) 			=> "9",
						esc_html__( 'Blue Essence', 'calluna-shortcodes' ) 		=> "10",
						esc_html__( 'Apple Maps-esque', 'calluna-shortcodes' ) 	=> "11",
						esc_html__( 'Subtle Grayscale', 'calluna-shortcodes' ) 	=> "12",
						esc_html__( 'Retro', 'calluna-shortcodes' ) 		    => "13",
						esc_html__( 'Hopper', 'calluna-shortcodes' ) 			=> "14",
						esc_html__( 'Red Hues', 'calluna-shortcodes' ) 			=> "15",
						esc_html__( 'Ultra Light with labels', 'calluna-shortcodes' ) 	=> "16",
						esc_html__( 'Unsaturated Browns', 'calluna-shortcodes' ) => "17",
						esc_html__( 'Light Dream', 'calluna-shortcodes' ) 		=> "18",
						esc_html__( 'Neutral Blue', 'calluna-shortcodes' ) 		=> "19",
						esc_html__( 'MapBox', 'calluna-shortcodes' ) 			=> "20",
					)
				),
				array(
					"type"        => "number",
					"holder"      => "div",
					"suffix"      => "px",
					"class"       => "",
					"heading"     => esc_html__("Height", 'calluna-shortcodes'),
					"param_name"  => "height",
					"value"       => "300"
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Latitude", 'calluna-shortcodes'),
					"param_name"  => "lat",
					"value"       => "51.4946416",
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Longitude", 'calluna-shortcodes'),
					"param_name"  => "lng",
					"value"       => "-0.172699",
				),
				array(
					"type"        => "number",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Zoom", 'calluna-shortcodes'),
					"param_name"  => "zoom",
					"value"       => "12"
				),
				array(
					"type"        => "dropdown",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Show Marker?", 'calluna-shortcodes'),
					"param_name"  => "marker",
					"value"       => array(
						esc_html__("Yes", 'calluna-shortcodes') => 'yes',
						esc_html__("No", 'calluna-shortcodes')  => 'no',
					),
				),
			),
		));
}
add_action( 'vc_before_init', 'calluna_core_vc_gmap_shortcode' );

?>