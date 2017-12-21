<?php

// VC Font Awesome Icon --------------------------------------------------------------- >
function calluna_core_vc_fontawesome_icon_shortcode() {
	vc_map( array(
		'name'        => esc_html__( 'Calluna Font Awesome Icon', 'calluna-shortcodes' ),
		'base'        => 'cl_fa_icon',
		'description' => esc_html__( 'Font Awesome Icon', 'calluna-shortcodes' ),
		'category'    => esc_html__( 'Calluna', 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'      => array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon', 'calluna-shortcodes' ),
				'param_name'  => 'icon',
				'admin_label' => true,
				'value'       => calluna_core_shortcodes_font_icons_array(),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Icon Size', 'calluna-shortcodes' ),
				'param_name' => 'size',
				'std'        => 'normal',
				'value'      => array(
					 esc_html__( 'Extra Large', 'calluna-shortcodes' ) => 'xlarge',
					 esc_html__( 'Large', 'calluna-shortcodes' )       => 'large',
					 esc_html__( 'Normal', 'calluna-shortcodes' )      => 'normal',
					 esc_html__( 'Small', 'calluna-shortcodes' )       => 'small',
					 esc_html__( 'Tiny', 'calluna-shortcodes' )        => 'tiny',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Fade In', 'calluna-shortcodes' ),
				'param_name'  => 'fade_in',
				'value'       => array(
					 esc_html__( 'No', 'calluna-shortcodes' ) => 'false',
					 esc_html__( 'Yes', 'calluna-shortcodes' )  => 'true',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Float', 'calluna-shortcodes' ),
				'param_name' => 'float',
				'value'      => array(
					 esc_html__( 'Center', 'calluna-shortcodes' ) => 'center',
					 esc_html__( 'Left', 'calluna-shortcodes' )   => 'left',
					 esc_html__( 'Right', 'calluna-shortcodes' )  => 'right',
				),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => __( 'Icon Color', 'calluna-shortcodes' ),
				'param_name' => 'color',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Background Color', 'calluna-shortcodes' ),
				'param_name' => 'background',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Border Radius', 'calluna-shortcodes' ),
				'param_name' => 'border_radius',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'URL', 'calluna-shortcodes' ),
				'param_name' => 'url',
			  	'value'			=> '#',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'URL Title', 'calluna-shortcodes' ),
				'param_name' => 'url_title',
			),
		)
	) );
}
add_action( 'vc_before_init', 'calluna_core_vc_fontawesome_icon_shortcode' );

?>