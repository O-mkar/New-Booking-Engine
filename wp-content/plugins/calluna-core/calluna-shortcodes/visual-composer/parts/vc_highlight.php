<?php

// VC Highlight ------------------------------------------------------------------------ >
function calluna_core_vc_highlight_shortcode() {
	vc_map( array(
		'name'        => esc_html__( 'Calluna Highlight', 'calluna-shortcodes' ),
		'base'        => 'cl_highlight',
		'description' => esc_html__( 'Text highlighter', 'calluna-shortcodes' ),
		'category'    => esc_html__( 'Calluna' , 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'      => array(
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Color', 'calluna-shortcodes' ),
				'param_name'	=> 'color',
				'value'			=> array(
					esc_html__( 'Blue', 'calluna-shortcodes' )   => 'blue',
					esc_html__( 'Green', 'calluna-shortcodes' )  => 'green',
					esc_html__( 'Gray', 'calluna-shortcodes' )   => 'gray',
					esc_html__( 'Red', 'calluna-shortcodes' )    => 'red',
					esc_html__( 'Yellow', 'calluna-shortcodes' ) => 'yellow',
				),
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Highlighted Text', 'calluna-shortcodes' ),
				'param_name'	=> 'content',
				'value'			=> 'highlight me please',
				'description'	=> esc_html__( 'Add the text to be highlighted.', 'calluna-shortcodes' )
			),
		)
	) );
}
add_action( 'vc_before_init', 'calluna_core_vc_highlight_shortcode' );

?>