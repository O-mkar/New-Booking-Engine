<?php

// VC Pricing ------------------------------------------------------------------------ >
function calluna_core_vc_pricing_shortcode() {
	vc_map( array(
		'name'        => esc_html__( 'Calluna Pricing Table', 'calluna-shortcodes' ),
		'base'        => 'cl_pricing',
		'description' => esc_html__( 'Insert a pricing column', 'calluna-shortcodes' ),
		'category'    => esc_html__( 'Calluna', 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Featured Pricing', 'calluna-shortcodes' ),
				'param_name' => 'featured',
				'value'      => array(
					esc_html__( 'No', 'calluna-shortcodes' )	=> 'no',
					esc_html__( 'Yes', 'calluna-shortcodes' )	=> 'yes'
				),
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Plan', 'calluna-shortcodes' ),
				'param_name'	=> 'plan',
				'value'			=> 'Basic',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Cost', 'calluna-shortcodes' ),
				'param_name'	=> 'cost',
				'value'			=> '$20',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Per (optional)', 'calluna-shortcodes' ),
				'param_name'	=> 'per',
				'value'			=> 'month',
			),
			array(
				'type'			=> 'textarea_html',
				'heading'		=> esc_html__( 'Features', 'calluna-shortcodes' ),
				'param_name'	=> 'content',
				'value'			=> '<ul>
										<li>30GB Storage</li>
										<li>512MB Ram</li>
										<li>10 databases</li>
										<li>1,000 Emails</li>
										<li>25GB Bandwidth</li>
									</ul>',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Button: Text', 'calluna-shortcodes' ),
				'param_name'	=> 'button_text',
				'value'			=> 'Button Text',
				'description'	=> esc_html__( 'Button: Text', 'calluna-shortcodes' )
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Button: URL', 'calluna-shortcodes' ),
				'param_name'	=> 'button_url',
				'value'			=> '#',
				'description'	=> esc_html__( 'Button: URL', 'calluna-shortcodes' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Button: Style', 'calluna-shortcodes' ),
				'param_name'  => 'button_style',
				'description' => esc_html__( 'Select a button style.', 'calluna-shortcodes' ),
				'value'       => array(
					 esc_html__( 'Style 1', 'calluna-shortcodes' )  => 'style-1',
					 esc_html__( 'Style 2', 'calluna-shortcodes' )   => 'style-2'
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
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Button: Link Target', 'calluna-shortcodes' ),
				'param_name' => 'button_target',
				'value'      => array(
					 esc_html__( 'Self', 'calluna-shortcodes' )  => 'self',
					 esc_html__( 'Blank', 'calluna-shortcodes' ) => 'blank',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Button: Rel', 'calluna-shortcodes' ),
				'param_name' => 'button_rel',
				'value'      => array(
					 esc_html__( 'None', 'calluna-shortcodes' )     => 'none',
					 esc_html__( 'Nofollow', 'calluna-shortcodes' ) => 'nofollow',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Button: Icon Left', 'calluna-shortcodes' ),
				'param_name' => 'button_icon_left',
				'value'      => calluna_core_shortcodes_font_icons_array(),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Button: Icon Right', 'calluna-shortcodes' ),
				'param_name' => 'button_icon_right',
				'value'      => calluna_core_shortcodes_font_icons_array(),
			),
		)
	) );
}
add_action( 'vc_before_init', 'calluna_core_vc_pricing_shortcode' );

?>