<?php

// VC Post Grid ----------------------------------------------------------------- >
function calluna_core_vc_room_grid_shortcode() {
	vc_map( array(
		'name'        => esc_html__( 'Calluna Room Grid', 'calluna-shortcodes' ),
		'base'        => 'cl_room_grid',
		'description' => esc_html__( 'Show your rooms in a grid', 'calluna-shortcodes' ),
		'category'    => esc_html__( 'Calluna', 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'      => array(
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Unique Id', 'calluna-shortcodes' ),
				'param_name'	=> 'unique_id',
				'description'	=> esc_html__( 'You can enter a unique ID here for styling purposes.', 'calluna-shortcodes' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Style', 'calluna-shortcodes' ),
				'param_name'	=> 'style',
				'description'	=> sprintf( wp_kses(__( 'Designates the ascending or descending order. More at %s.', 'calluna-shortcodes' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> array(
					 esc_html__( 'Image Overlay', 'calluna-shortcodes' )	=> 'overlay',
					 esc_html__( 'Classic', 'calluna-shortcodes' )	=> 'classic'
				),
			),
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
				'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'overlay' )
                    ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Columns', 'calluna-shortcodes' ),
				'param_name'	=> 'columns',
				'std'           => '4',
				'value'			=> array(
					 esc_html__( '1', 'calluna-shortcodes' )	=> '1',
					 esc_html__( '2', 'calluna-shortcodes' )	=> '2',
					 esc_html__( '3', 'calluna-shortcodes' )	=> '3',
					 esc_html__( '4', 'calluna-shortcodes' )	=> '4',
					 esc_html__( '5', 'calluna-shortcodes' )	=> '5',
					 esc_html__( '6', 'calluna-shortcodes' )	=> '6',
				),
				'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'classic' )
                    ),
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
                    esc_html__( 'ASC', 'calluna-shortcodes' )	=> 'ASC',
                    esc_html__( 'DESC', 'calluna-shortcodes' )	=> 'DESC',
                ),
            ),
            array(
                'type'			=> 'dropdown',
                'heading'		=> esc_html__( 'Order By', 'calluna-shortcodes' ),
                'param_name'	=> 'orderby',
                'description'	=> sprintf( wp_kses(__( 'Select how to sort retrieved posts. More at %s.', 'calluna-shortcodes' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
                'value'			=> calluna_core_shortcodes_rooms_order_by_array(),
            ),
            array(
                    'type'			=> 'textfield',
                    'heading'		=> esc_html__( 'Excerpt Length', 'calluna-shortcodes' ),
                    'param_name'	=> 'excerpt_length',
                    'value'			=> '30',
                    'description'	=> esc_html__( 'How many words do you want to display for your excerpt?', 'calluna-shortcodes' ),
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
                'heading'		=> esc_html__( 'Button Text', 'calluna-shortcodes' ),
                'param_name'	=> 'button_text',
                'description'	=> esc_html__( 'Enter a button text.', 'calluna-shortcodes' ),
                'value'	        => esc_html__( 'starting at', 'calluna-shortcodes' ),

            ),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Button: Style', 'calluna-shortcodes' ),
				'param_name'	=> 'button_style',
				'description'	=> esc_html__( 'Select a button style.', 'calluna-shortcodes' ),
				'value'			=> array(
					 esc_html__( 'Style 1', 'calluna-shortcodes' )  => 'style-1',
					 esc_html__( 'Style 2', 'calluna-shortcodes' )	  => 'style-2'
				),
			),
            array(
                'type'			=> 'dropdown',
                'heading'		=> esc_html__( 'Show Price', 'calluna-shortcodes' ),
                'param_name'	=> 'button_price',
                'description'	=> esc_html__( 'Show price', 'calluna-shortcodes' ),
                'value'			=> array(
                    esc_html__( 'Yes', 'calluna-shortcodes' )  => 'yes',
                    esc_html__( 'No', 'calluna-shortcodes' )	  => 'no'
                )
            )
		)
	) );
}
add_action( 'vc_before_init', 'calluna_core_vc_room_grid_shortcode' );

?>