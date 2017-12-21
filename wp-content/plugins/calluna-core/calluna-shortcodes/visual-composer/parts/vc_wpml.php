<?php

// VC Wpml ------------------------------------------------------------------------ >
function calluna_core_vc_wpml_shortcode() {
	vc_map( array(
		'name'				=> esc_html__( 'WPML', 'calluna-shortcodes' ),
		'base'				=> 'cl_wpml',
		'description'		=> esc_html__( 'WPML translatable text.', 'calluna-shortcodes' ),
		'category'			=> esc_html__( 'Calluna', 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'			=> array(
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Language', 'calluna-shortcodes' ),
				'param_name'	=> 'lang',
				'value'			=> 'es',
				'description'	=> esc_html__( 'Select a WPML language.', 'calluna-shortcodes' ),
			),
			array(
				'type'			=> 'textarea_html',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Content', 'calluna-shortcodes' ),
				'param_name'	=> 'content',
				'value'			=> 'Hola',
			),
		)
	) );
}
add_action( 'vc_before_init', 'calluna_core_vc_wpml_shortcode' );

?>