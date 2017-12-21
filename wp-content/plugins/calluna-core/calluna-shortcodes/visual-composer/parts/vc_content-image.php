<?php

// VC Image with text ------------------------------------------------------------- >
function calluna_core_vc_content_image_shortcode() {
	vc_map(
		array(
    		"icon" => 'calluna_vc_icon',
    		'name'                    => esc_html__( 'Calluna Image with content' , 'calluna-shortcodes' ),
    		'base'                    => 'cl_content_image',
    		'description'             => esc_html__( 'Create images with content', 'calluna-shortcodes' ),
    		"category" => esc_html__('Calluna', 'calluna-shortcodes'),
    		'params' => array(
    				array(
    						"type" => "attach_image",
    						"heading" => esc_html__("Choose Image", 'calluna-shortcodes'),
    						"param_name" => "image"
    				),
    				array(
    						"type" => "dropdown",
    						"heading" => esc_html__("Image & Content Layout", 'calluna-shortcodes'),
    						"param_name" => "layout",
    						"value" => array(
    								'Image with inner Content Left' => 'offscreen-left',
    								'Image with inner Content Right' => 'offscreen-right',
    								'Image with shadow Left' => 'shadow-left',
    								'Image with shadow Right' => 'shadow-right',
    								'Boxed Image Left' => 'box-left',
    								'Boxed Image Right' => 'box-right'
    						)
    				),
                // Content
                array(
                    'type'          => 'textarea_html',
                    'holder'        => 'div',
                    'heading'       => esc_html__( 'Content', 'calluna-shortcodes' ),
                    'param_name'    => 'content',
                    'value'         => esc_html__( 'Don\'t forget to change this dummy text in your page editor.', 'calluna-shortcodes' ),
                    'group'         => esc_html__( 'Content', 'calluna-shortcodes' ),
                ),
    		)
		)
	);
}
add_action( 'vc_before_init', 'calluna_core_vc_content_image_shortcode' );

?>