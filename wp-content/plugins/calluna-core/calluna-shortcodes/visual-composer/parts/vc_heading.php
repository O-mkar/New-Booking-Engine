<?php

// VC Heading ------------------------------------------------------------------------ >
function calluna_core_vc_heading_shortcode() {
	vc_map( array(
		'name'        => esc_html__( 'Calluna Heading', 'calluna-shortcodes' ),
		'base'        => 'cl_heading',
		'description' => esc_html__( 'Styled heading', 'calluna-shortcodes' ),
		'category'    => esc_html__( 'Calluna', 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'      => array(
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Title', 'calluna-shortcodes' ),
				'param_name'	=> 'title',
				'value'			=> 'This is a Heading',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Type', 'calluna-shortcodes' ),
				'param_name' => 'type',
				'std'        => 'h2',
				'default'    => 'h2',
				'value'      => array(
					'h1'   => 'h1',
					'h2'   => 'h2',
					'h3'   => 'h3',
					'h4'   => 'h4',
					'h5'   => 'h5',
					'h6'   => 'h6',
					'div'  => 'div',
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Margin Top', 'calluna-shortcodes' ),
				'param_name' => 'margin_top',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Margin Bottom', 'calluna-shortcodes' ),
				'param_name' => 'margin_bottom',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Font Size', 'calluna-shortcodes' ),
				'param_name' => 'font_size',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Heading Color', 'calluna-shortcodes' ),
				'param_name' => 'color',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Span Background', 'calluna-shortcodes' ),
				'param_name' => 'span_bg',
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Heading Style', 'calluna-shortcodes' ),
				'param_name'	=> 'style',
				'value'			=> array(
					 esc_html__( 'None', 'calluna-shortcodes' )	=> '',
					 esc_html__( 'Underline', 'calluna-shortcodes' )	=> 'single-line'
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Text Alignment', 'calluna-shortcodes' ),
				'param_name'	=> 'text_align',
				'value'			=> array(
					 esc_html__( 'Left', 'calluna-shortcodes' )		=> 'left',
					 esc_html__( 'Center', 'calluna-shortcodes' )	=> 'center',
					 esc_html__( 'Right', 'calluna-shortcodes' )	=> 'right',
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
add_action( 'vc_before_init', 'calluna_core_vc_heading_shortcode' );

?>