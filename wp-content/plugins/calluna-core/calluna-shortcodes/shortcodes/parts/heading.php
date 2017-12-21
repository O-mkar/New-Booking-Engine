<?php

// Heading -------------------------------------------------------------------------- >
function calluna_heading_shortcode( $atts ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'title'			=> esc_html__( 'Sample Heading', 'calluna-shortcodes' ),
		'type'			=> 'h2',
		'style'			=> 'none',
		'margin_top'	=> '',
		'margin_bottom'	=> '',
		'text_align'	=> '',
		'font_size'		=> '',
		'color'			=> '',
		'class'			=> '',
		'span_bg'       => '',
		'icon_left'		=> '',
		'icon_right'	=> ''
	  ),
	  $atts ) );

	// Sanitize icons
	$icon_right  = calluna_core_shortcodes_font_icon_class( $icon_right );
	$icon_left = calluna_core_shortcodes_font_icon_class( $icon_left );
  	$title = esc_attr($title);
	  
	// Load required scripts
	if ( $icon_left || $icon_right) {
		wp_enqueue_style( 'font-awesome' );
	}
	
	// Inline styles
	$style_attr = '';
	if ( $font_size ) {
		$style_attr .= 'font-size: '. $font_size .';';
	}
	if ( $color ) {
		$style_attr .= 'color: '. $color .';';
	}
	if ( $margin_bottom ) {
		$style_attr .= 'margin-bottom: '. intval( $margin_bottom ) .'px;';
	}
	if ( $margin_top ) {
		$style_attr .= 'margin-top: '. intval( $margin_top ) .'px;';
	}
	if ( $style_attr ) {
		$style_attr = 'style="'. $style_attr .'"';
	}
	if ( $span_bg ) {
		$span_bg = ' style="background-color:'. $span_bg .';"';
	}

	// Text aligns
	if ( $text_align ) {
		$text_align = 'text-align-'. $text_align;
	} else {
		$text_align = 'text-align-left';
	}
	
	// Output
	$output = '<'.$type.' class="calluna-heading calluna-heading-'. $style .' '. $text_align .' '. $class .'" '. $style_attr .'>';
		$output .= '<span'. $span_bg .'>';
			if ( $icon_left ) {
				$output .= '<i class="calluna-heading-icon-left '. $icon_left .'"></i>';
			}
				$output .= $title;
			if ( $icon_right ) {
				$output .= '<i class="calluna-heading-icon-right '. $icon_right .'"></i>';
			}
		$output .= '</span>';
	$output .= '</'.$type.'>';
	
	// Return output
	return $output;

}
add_shortcode( 'cl_heading', 'calluna_heading_shortcode' );