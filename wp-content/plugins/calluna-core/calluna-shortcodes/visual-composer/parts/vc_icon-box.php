<?php

// VC Icon Box ------------------------------------------------------------------- >
function calluna_core_vc_icon_box_shortcode() {
	vc_map( array(
            'name'                  => esc_html__( 'Calluna Icon Box', 'calluna-shortcodes' ),
            'base'                  => 'cl_icon_box',
            'category'                => esc_html__('Calluna', 'calluna-shortcodes'),
            'icon'                  => 'calluna_vc_icon',
            'description'           => esc_html__( 'Content box with icon', 'calluna-shortcodes' ),
            'params'                => array(
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Extra class name', 'calluna-shortcodes' ),
                    'param_name'    => 'el_class',
                    'description'   => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'calluna-shortcodes' ),
                ),

                // Icon
                array(
                    'type'          => 'attach_image',
                    'heading'       => esc_html__( 'Icon Image Alternative', 'calluna-shortcodes' ),
                    'param_name'    => 'image',
                    'group'         => esc_html__( 'Icon', 'calluna-shortcodes' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Icon Image Alternative Width', 'calluna-shortcodes' ),
                    'param_name'    => 'image_width',
                    'group'         => esc_html__( 'Icon', 'calluna-shortcodes' ),
					'dependency'    => Array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Icon', 'calluna-shortcodes' ),
                    'param_name'    => 'icon',
                    'value'         => calluna_core_shortcodes_font_icons_array(),
                    'group'         => esc_html__( 'Icon', 'calluna-shortcodes' ),
                    
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Icon Font Alternative Classes', 'calluna-shortcodes' ),
                    'param_name'    => 'icon_alternative_classes',
                    'group'         => esc_html__( 'Icon', 'calluna-shortcodes' ),
                    
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => esc_html__( 'Icon Color', 'calluna-shortcodes' ),
                    'param_name'    => 'icon_color',
                    'value'         => '',
                    'group'         => esc_html__( 'Icon', 'calluna-shortcodes' ),
                    
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => esc_html__( 'Icon Background', 'calluna-shortcodes' ),
                    'param_name'    => 'icon_background',
                    'group'         => esc_html__( 'Icon', 'calluna-shortcodes' ),
                    
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Icon Border Radius', 'calluna-shortcodes' ),
                    'param_name'    => 'icon_border_radius',
                    'group'         => esc_html__( 'Icon', 'calluna-shortcodes' ),
                    
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Icon Size In Pixels', 'calluna-shortcodes' ),
                    'param_name'    => 'icon_size',
                    'value'         => '',
                    'group'         => esc_html__( 'Icon', 'calluna-shortcodes' ),
                    
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Fixed Icon Width', 'calluna-shortcodes' ),
                    'param_name'    => 'icon_width',
                    'value'         => '',
                    'group'         => esc_html__( 'Icon', 'calluna-shortcodes' ),
                    
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Fixed Icon Height', 'calluna-shortcodes' ),
                    'param_name'    => 'icon_height',
                    'value'         => '',
                    'group'         => esc_html__( 'Icon', 'calluna-shortcodes' ),
                    
                ),

                // Design
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__('CSS Animation', 'calluna-shortcodes'),
                    'param_name'    => 'css_animation',
                    'value'         => array(
                        esc_html__( 'No', 'calluna-shortcodes' )                  => '',
                        esc_html__( 'Top to bottom', 'calluna-shortcodes' )       => 'top-to-bottom',
                        esc_html__( 'Bottom to top', 'calluna-shortcodes' )       => 'bottom-to-top',
                        esc_html__( 'Left to right', 'calluna-shortcodes' )       => 'left-to-right',
                        esc_html__( 'Right to left', 'calluna-shortcodes' )       => 'right-to-left',
                        esc_html__( 'Appear from center', 'calluna-shortcodes' )  => 'appear'
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Icon Box Style', 'calluna-shortcodes' ),
                    'param_name'    => 'style',
                    'value'         => array(
                        esc_html__( 'Left Icon', 'calluna-shortcodes')                    => 'one',
                        esc_html__( 'Right Icon', 'calluna-shortcodes')                   => 'seven',
                        esc_html__( 'Top Icon', 'calluna-shortcodes' )                    => 'two',
                        esc_html__( 'Top Icon Style 2 (legacy)', 'calluna-shortcodes' )   => 'three',
                        esc_html__( 'Outlined & Top Icon', 'calluna-shortcodes' )         => 'four',
                        esc_html__( 'Boxed & Top Icon', 'calluna-shortcodes' )            => 'five',
                        esc_html__( 'Boxed & Top Icon Style 2', 'calluna-shortcodes' )    => 'six',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Alignment', 'calluna-shortcodes' ),
                    'param_name'    => 'alignment',
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'two' ),
                    ),
                    'value'         => array(
                        esc_html__( 'Default', 'calluna-shortcodes')  => '',
                        esc_html__( 'Center', 'calluna-shortcodes')   => 'center',
                        esc_html__( 'Left', 'calluna-shortcodes' )    => 'left',
                        esc_html__( 'Right', 'calluna-shortcodes' )   => 'right',
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Icon Bottom Margin', 'calluna-shortcodes' ),
                    'param_name'    => 'icon_bottom_margin',
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'two', 'three', 'four', 'five', 'six' ),
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Container Left Padding', 'calluna-shortcodes' ),
                    'param_name'    => 'container_left_padding',
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'one' )
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Container Right Padding', 'calluna-shortcodes' ),
                    'param_name'    => 'container_right_padding',
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'seven' )
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => esc_html__( 'Background Color', 'calluna-shortcodes' ),
                    'param_name'    => 'background',
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'four', 'five', 'six' ),
                    ),
                ),
                array(
                    'type'          => 'attach_image',
                    'heading'       => esc_html__( 'Background Image', 'calluna-shortcodes' ),
                    'param_name'    => 'background_image',
                    'value'         => '',
                    'description'   => esc_html__( 'Select image from media library.', 'calluna-shortcodes' ),
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'four', 'five', 'six' ),
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Background Image Style', 'calluna-shortcodes' ),
                    'param_name'    => 'background_image_style',
                    'value'         => array(
                        esc_html__( 'Default', 'calluna-shortcodes' )     => '',
                        esc_html__( 'Stretched', 'calluna-shortcodes' )   => 'stretch',
                        esc_html__( 'Fixed', 'calluna-shortcodes' )       => 'fixed',
                        esc_html__( 'Repeat', 'calluna-shortcodes' )      => 'repeat',
                    ),
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'four', 'five', 'six' ),
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => esc_html__( 'Border Color', 'calluna-shortcodes' ),
                    'param_name'    => 'border_color',
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'four' ),
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Padding', 'calluna-shortcodes' ),
                    'param_name'    => 'padding',
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'four', 'five', 'six' )
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Border Radius', 'calluna-shortcodes' ),
                    'param_name'    => 'border_radius',
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'four', 'five', 'six' )
                    ),
                ),

                // Heading
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Heading', 'calluna-shortcodes' ),
                    'param_name'    => 'heading',
                    'value'         => 'Sample Heading',
                    'group'         => esc_html__( 'Heading', 'calluna-shortcodes' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Heading Type', 'calluna-shortcodes' ),
                    'param_name'    => 'heading_type',
                    'value'     => array(
                        'h2'    => 'h2',
                        'h3'    => 'h3',
                        'h4'    => 'h4',
                        'h5'    => 'h5',
                        'div'   => 'div',
                        'span'  => 'span',
                    ),
                    'group'         => esc_html__( 'Heading', 'calluna-shortcodes' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => esc_html__( 'Heading Font Color', 'calluna-shortcodes' ),
                    'param_name'    => 'heading_color',
                    'group'         => esc_html__( 'Heading', 'calluna-shortcodes' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Heading Font Size', 'calluna-shortcodes' ),
                    'param_name'    => 'heading_size',
                    'group'         => esc_html__( 'Heading', 'calluna-shortcodes' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Heading Font Weight', 'calluna-shortcodes' ),
                    'param_name'    => 'heading_weight',
                    'group'         => esc_html__( 'Heading', 'calluna-shortcodes' ),
                    'value'         => '',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Heading Letter Spacing', 'calluna-shortcodes' ),
                    'param_name'    => 'heading_letter_spacing',
                    'group'         => esc_html__( 'Heading', 'calluna-shortcodes' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Heading Text Transform', 'calluna-shortcodes' ),
                    'param_name'    => 'heading_transform',
                    'group'         => esc_html__( 'Heading', 'calluna-shortcodes' ),
                    'value'         => array(
                        esc_html__( 'Default', 'calluna-shortcodes' )     => '',
                        esc_html__( 'None', 'calluna-shortcodes' )        => 'none',
                        esc_html__( 'Capitalize', 'calluna-shortcodes' )  => 'capitalize',
                        esc_html__( 'Uppercase', 'calluna-shortcodes' )   => 'uppercase',
                        esc_html__( 'Lowercase', 'calluna-shortcodes' )   => 'lowercase',
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Heading Bottom Margin', 'calluna-shortcodes' ),
                    'param_name'    => 'heading_bottom_margin',
                    'group'         => esc_html__( 'Heading', 'calluna-shortcodes' ),
                ),


                // Content
                array(
                    'type'          => 'textarea_html',
                    'holder'        => 'div',
                    'heading'       => esc_html__( 'Content', 'calluna-shortcodes' ),
                    'param_name'    => 'content',
                    'value'         => esc_html__( 'Don\'t forget to change this dummy text in your page editor for this lovely icon box.', 'calluna-shortcodes' ),
                    'group'         => esc_html__( 'Content', 'calluna-shortcodes' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Content Font Size', 'calluna-shortcodes' ),
                    'param_name'    => 'font_size',
                    'group'         => esc_html__( 'Content', 'calluna-shortcodes' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => esc_html__( 'Content Font Color', 'calluna-shortcodes' ),
                    'param_name'    => 'font_color',
                    'group'         => esc_html__( 'Content', 'calluna-shortcodes' ),
                ),

                // URL
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'URL', 'calluna-shortcodes' ),
                    'param_name'    => 'url',
                    'group'         => esc_html__( 'URL', 'calluna-shortcodes' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'URL Target', 'calluna-shortcodes' ),
                    'param_name'    => 'url_target',
                     'value'        => array(
                        esc_html__( 'Self', 'calluna-shortcodes' )    => '',
                        esc_html__( 'Blank', 'calluna-shortcodes' )   => '_blank',
                        esc_html__( 'Local', 'calluna-shortcodes' )   => 'local',
                    ),
                    'group'         => esc_html__( 'URL', 'calluna-shortcodes' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'URL Rel', 'calluna-shortcodes' ),
                    'param_name'    => 'url_rel',
                    'value'         => array(
                        esc_html__( 'None', 'calluna-shortcodes' )        => '',
                        esc_html__( 'Nofollow', 'calluna-shortcodes' )    => 'nofollow',
                    ),
                    'group'         => esc_html__( 'URL', 'calluna-shortcodes' ),
                ),

                // Margin
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Bottom Margin', 'calluna-shortcodes' ),
                    'param_name'    => 'margin_bottom',
                    'group'         => esc_html__( 'Margin', 'calluna-shortcodes' ),
                ),
            )
        ) );
}
add_action( 'vc_before_init', 'calluna_core_vc_icon_box_shortcode' );

?>