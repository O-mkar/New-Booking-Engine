<?php

// VC Teaser ------------------------------------------------------------------------ >
function calluna_core_vc_teaser_shortcode() {
	vc_map(array(
		'name'                    => esc_html__('Calluna Teaser', 'calluna-shortcodes'),
		'base'                    => 'cl_teaser',
		'class'                   => '',
		'controls'                => 'full',
		'icon'                    => 'calluna_vc_icon',
		'category'                => esc_html__('Calluna', 'calluna-shortcodes'),
		'show_settings_on_create' => TRUE,
		'params'				  => array(
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Text Color', 'calluna-shortcodes' ),
			'param_name' => 'color',
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
			'type'			=> 'textarea_html',
			'admin_label'	=> true,
			'heading'		=> esc_html__( 'Content', 'calluna-shortcodes' ),
			'param_name'	=> 'content',
			'value'			=> esc_html__( 'Enter your content here.', 'calluna-shortcodes' ),
			'description'	=> esc_html__( 'Teaser Content', 'calluna-shortcodes' ),
		),
	)
	));
}
add_action( 'vc_before_init', 'calluna_core_vc_teaser_shortcode' );

?>