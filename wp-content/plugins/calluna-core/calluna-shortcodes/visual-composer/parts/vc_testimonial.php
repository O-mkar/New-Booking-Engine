<?php

// VC Testimonial ------------------------------------------------------------------------ >
function calluna_core_vc_testimonial_shortcode() {
	vc_map( array(
		'name'				=> esc_html__( 'Calluna Testimonial', 'calluna-shortcodes' ),
		'base'				=> 'cl_testimonial',
		'description'		=> esc_html__( 'Single testimonial', 'calluna-shortcodes' ),
		'category'			=> esc_html__( 'Calluna', 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'			=> array(
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Author', 'calluna-shortcodes' ),
				'param_name'	=> 'by',
				'value'			=> 'Unknown Person',
				'description'	=> esc_html__( 'Testimonial Author', 'calluna-shortcodes' )
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Author Position', 'calluna-shortcodes' ),
				'param_name'	=> 'position',
				'value'			=> 'Unknown Position',
				'description'	=> esc_html__( 'Testimonial Author Position', 'calluna-shortcodes' )
			),
			array(
					"type"        => "attach_image",
					"holder"      => "div",
					"class"       => "author_image",
					"heading"     => esc_html__("Author image", 'calluna-shortcodes'),
					"description" => "",
					"param_name"  => "image",
					"value"       => "",
				),
			array(
				'type'			=> 'textarea_html',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Testimonial Content', 'calluna-shortcodes' ),
				'param_name'	=> 'content',
				'value'			=> esc_html__( 'This product is amazing!', 'calluna-shortcodes' ),
				'description'	=> esc_html__( 'This is where your testimonial goes.', 'calluna-shortcodes' )
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Fade In', 'calluna-shortcodes' ),
				'param_name'	=> 'fade_in',
				'description'	=> esc_html__( 'Fade In Animation', 'calluna-shortcodes' ),
				'value'			=> array(
				 	esc_html__( 'No', 'calluna-shortcodes' )	=> 'false',
					esc_html__( 'Yes', 'calluna-shortcodes' )	=> 'true',
				),
			),
		)
	) );
}
add_action( 'vc_before_init', 'calluna_core_vc_testimonial_shortcode' );

?>