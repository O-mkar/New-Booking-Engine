<?php

// VC Callout ------------------------------------------------------------------------ >
function calluna_core_vc_callout_shortcode() {
	vc_map( array(
		'name'        => esc_html__( 'Calluna Callout', 'calluna-shortcodes' ),
		'base'        => 'cl_callout',
		'description' => esc_html__( 'Call to action area', 'calluna-shortcodes' ),
		'category'    => esc_html__( 'Calluna', 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'      => array(
			array(
				'type'			=> 'textarea_html',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Callout Content', 'calluna-shortcodes' ),
				'param_name'	=> 'content',
				'value'			=> esc_html__( 'Enter your content here.', 'calluna-shortcodes' ),
				'description'	=> esc_html__( 'Callout Content', 'calluna-shortcodes' ),
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
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Button: URL', 'calluna-shortcodes' ),
				'param_name'	=> 'button_url',
				'value'			=> '#',
				'description'	=> esc_html__( 'Button: URL', 'calluna-shortcodes' )
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Button: Text', 'calluna-shortcodes' ),
				'param_name'	=> 'button_text',
				'value'			=> 'Button Text',
				'description'	=> esc_html__( 'Button: Text', 'calluna-shortcodes' )
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
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Button: Size', 'calluna-shortcodes' ),
				'param_name'  => 'button_size',
				'description' => esc_html__( 'Select a button size.', 'calluna-shortcodes' ),
				'value'       => calluna_core_shortcodes_button_sizes_array(),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Button: Link Target', 'calluna-shortcodes' ),
				'param_name'	=> 'button_target',
				'value'			=> array(
					 esc_html__( 'Self', 'calluna-shortcodes' )		=> 'self',
					 esc_html__( 'Blank', 'calluna-shortcodes' )	=> 'blank',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Button: Rel', 'calluna-shortcodes' ),
				'param_name'	=> 'button_rel',
				'value'			=> array(
					 esc_html__( 'None', 'calluna-shortcodes' )			=> 'none',
					 esc_html__( 'Nofollow', 'calluna-shortcodes' )	=> 'nofollow',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Button: Icon Left', 'calluna-shortcodes' ),
				'param_name'	=> 'button_icon_left',
				'description'	=> sprintf( wp_kses(__( 'Icon to the left of your button text. See all the icons at %s', 'calluna-shortcodes' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a>' ),
				'value'			=> calluna_core_shortcodes_font_icons_array(),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Button: Icon Right', 'calluna-shortcodes' ),
				'param_name'	=> 'button_icon_right',
				'description'	=> sprintf( wp_kses(__( 'Icon to the right of your button text. See all the icons at %s', 'calluna-shortcodes' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a>' ),
				'value'			=> calluna_core_shortcodes_font_icons_array(),
			),
		)
	) );
}
add_action( 'vc_before_init', 'calluna_core_vc_callout_shortcode' );

?>