<?php

// VC Button ------------------------------------------------------------------------ >
function calluna_core_vc_button_shortcode() {
	
	vc_map( array(
		'name'        => esc_html__( 'Calluna Button', 'calluna-shortcodes' ),
		'base'        => 'cl_button',
		'description' => esc_html__( 'Calluna Shortcode Button', 'calluna-shortcodes' ),
		'category'    => esc_html__( 'Calluna', 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'      => array(
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'URL', 'calluna-shortcodes' ),
				'param_name'	=> 'url',
			  	'value'			=> '#',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Button Title', 'calluna-shortcodes' ),
				'param_name'	=> 'title',
				'value'			=> esc_html__( 'Button', 'calluna-shortcodes' ) ,
			),
			array(
				'type'			=> 'dropdown',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Button Style', 'calluna-shortcodes' ),
				'param_name'	=> 'style',
				'value'			=> array(
					esc_html__( 'Style 1', 'calluna-shortcodes' )  => 'style-1',
					esc_html__( 'Style 2', 'calluna-shortcodes' )   => 'style-2'
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Button Size', 'calluna-shortcodes' ),
				'param_name' => 'size',
				'value'      => calluna_core_shortcodes_button_sizes_array(),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Align', 'calluna-shortcodes' ),
				'param_name' => 'align',
				'value'      => array(
					esc_html__( 'Default', 'calluna-shortcodes' ) => '',
					esc_html__( 'Inline', 'calluna-shortcodes' )  => 'aligninline',
					esc_html__( 'Left', 'calluna-shortcodes' )    => 'alignleft',
					esc_html__( 'Right', 'calluna-shortcodes' )   => 'alignright',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Link Target', 'calluna-shortcodes' ),
				'param_name' => 'target',
				'value'      => array(
					 esc_html__( 'Self', 'calluna-shortcodes' )   => 'self',
					 esc_html__( 'Blank', 'calluna-shortcodes' ) => 'blank',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Link Rel', 'calluna-shortcodes' ),
				'param_name' => 'rel',
				'value'      => array(
					 esc_html__( 'None', 'calluna-shortcodes' )      => 'none',
					 esc_html__( 'Nofollow', 'calluna-shortcodes' ) => 'nofollow',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon Left', 'calluna-shortcodes' ),
				'param_name' => 'icon_left',
				'value'      => calluna_core_shortcodes_font_icons_array(),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon Right', 'calluna-shortcodes' ),
				'param_name' => 'icon_right',
				'value'      => calluna_core_shortcodes_font_icons_array(),
			),
		)
	) );
}
add_action( 'vc_before_init', 'calluna_core_vc_button_shortcode' );

?>