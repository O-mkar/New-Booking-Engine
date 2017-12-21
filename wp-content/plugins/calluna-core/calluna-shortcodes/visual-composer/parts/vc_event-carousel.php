<?php

// VC Event Carousel --------------------------------------------------------------- >
function calluna_core_vc_event_carousel_shortcode() {
	vc_map(array(
		"name"                    => esc_html__("Calluna Event Carousel", 'calluna-shortcodes'),
		"base"                    => "cl_event_carousel",
		"class"                   => "",
		"controls"                => "full",
		"icon"                    => "calluna_vc_icon",
		"category"                => esc_html__("Calluna", 'calluna-shortcodes'),
		"show_settings_on_create" => TRUE,
		"params"                  => array(

			array(
				"type"        => "number",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Visible Items", 'calluna-shortcodes'),
				"param_name"  => "items",
				"value"       => "3",
			),
			array(
				"type"        => "number",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Maximum Items", 'calluna-shortcodes'),
				"param_name"  => "max_items",
				"value"       => "8",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Categories", 'calluna-shortcodes' ),
				"param_name"	=> "categories",
				"value"			=> "all",
				"description"	=> esc_html__( "Category Slugs - For example: sports, business, all", 'calluna-shortcodes' )
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Order', 'calluna-shortcodes' ),
				'param_name'	=> 'order',
				'description'	=> sprintf( wp_kses(__( 'Designates the ascending or descending order. More at %s.', 'calluna-shortcodes' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> array(
					esc_html__( 'DESC', 'calluna-shortcodes' )	=> 'DESC',
                    esc_html__( 'ASC', 'calluna-shortcodes' )	=> 'ASC',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Order By', 'calluna-shortcodes' ),
				'param_name'	=> 'orderby',
				'description'	=> sprintf( wp_kses(__( 'Select how to sort retrieved posts. More at %s.', 'calluna-shortcodes' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> calluna_core_shortcodes_order_by_array(),
			),
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => esc_html__("Show Featured Images?", 'calluna-shortcodes'),
				"param_name"  => "featured_images",
				"value"       => array(
					esc_html__("Yes", 'calluna-shortcodes') => 'yes',
					esc_html__("No", 'calluna-shortcodes')  => 'no',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Thumbnail Crop', 'calluna-shortcodes' ),
				'param_name'	=> 'img_crop',
				'value'			=> array(
					esc_html__( 'Yes', 'calluna-shortcodes' )  => 'true',
					esc_html__( 'No', 'calluna-shortcodes' ) => 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Thumbnail Width', 'calluna-shortcodes' ),
				'param_name'	=> 'img_width',
				'description'	=> esc_html__( 'Enter a width in pixels.', 'calluna-shortcodes' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Thumbnail Height', 'calluna-shortcodes' ),
				'param_name'	=> 'img_height',
				'description'	=> esc_html__( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'calluna-shortcodes' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Excerpt Length', 'calluna-shortcodes' ),
				'param_name'	=> 'excerpt_length',
				'value'			=> '30',
				'description'	=> esc_html__( 'Excerpt Length, only used when event has no excerpt.', 'calluna-shortcodes' ),
			),
		)
	));
}
add_action( 'vc_before_init', 'calluna_core_vc_event_carousel_shortcode' );

?>