<?php

// VC Skillbar ------------------------------------------------------------------------ >
function calluna_core_vc_skillbar_shortcode() {
	
	// Skillbars -------------------------------------------------------------------------- >
	vc_map( array(
		'name'				=> esc_html__( 'Calluna Skillbar', 'calluna-shortcodes' ),
		'base'				=> 'cl_skillbar',
		'description'		=> esc_html__( 'Animated percentage bar', 'calluna-shortcodes' ),
		'category'			=> esc_html__( 'Calluna' , 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'			=> array(
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Title', 'calluna-shortcodes' ),
				'param_name'	=> 'title',
				'value'			=> '',
				'description'	=> esc_html__( 'Add your skillbar title.', 'calluna-shortcodes' )
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Percentage', 'calluna-shortcodes' ),
				'param_name'	=> 'percentage',
				'value'			=> '70',
				'description'	=> esc_html__( 'Add a percentage value.', 'calluna-shortcodes' )
			),
			array(
				'type'			=> 'colorpicker',
				'heading'		=> esc_html__( 'Background', 'calluna-shortcodes' ),
				'param_name'	=> 'color',
				'value'			=> '#967a50',
				'description'	=> esc_html__( 'Choose your custom background color (Hex value).', 'calluna-shortcodes' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Display % Number', 'calluna-shortcodes' ),
				'param_name'	=> 'show_percent',
				'value'			=> array(
					 esc_html__( 'Yes', 'calluna-shortcodes' )	=> 'true',
					 esc_html__( 'No', 'calluna-shortcodes' )	=> 'false',
				),
			),
		)
	) );
}
add_action( 'vc_before_init', 'calluna_core_vc_skillbar_shortcode' );

?>