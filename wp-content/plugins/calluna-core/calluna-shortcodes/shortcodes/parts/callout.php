<?php

// Callout -------------------------------------------------------------------------- >	
function calluna_callout_shortcode( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'caption'				=> '',
		'button_text'			=> '',
		'fade_in'				=> '',
		'button_style'			=> 'style-1',
		'button_size'			=> '',
		'button_url'			=> '#',
		'button_rel'			=> 'nofollow',
		'button_target'			=> 'blank',
		'button_title'			=> esc_html__( 'Callout button', 'calluna-shortcodes' ),
		'class'					=> '',
		'button_icon_left'		=> '',
		'button_icon_right'		=> '',
	), $atts ) );

	// Sanitize
	$button_icon_left  = calluna_core_shortcodes_font_icon_class( $button_icon_left );
	$button_icon_right = calluna_core_shortcodes_font_icon_class( $button_icon_right );
	$button_url        = esc_url( $button_url );
	$button_title      = esc_attr( $button_title );
	
	// Load required scripts
	if ( $button_icon_left || $button_icon_right ) {
		wp_enqueue_style( 'font-awesome' );
	}
	
	// Fade in
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'calluna-scroll-fade' );
		$fade_in_class = 'calluna-fadein';
	}
	
	// Display Callout
	$output = '<div class="calluna-callout calluna-clearfix '. $class .' '. $fade_in_class .'">';
	$output .= '<div class="calluna-callout-caption">';
		$output .= do_shortcode ( $content );
	$output .= '</div>';	
	if ( $button_text && $button_url ) {
		$button_rel    = 'nofollow' == $button_rel ? ' rel="nofollow"' : null;
		$button_target = ( strpos( $button_target, 'blank' ) !== false ) ? ' target="_blank"' : null;
		$output .= '<div class="calluna-callout-button">';
			$output .= '<a href="' . $button_url .'" class="calluna-button btn btn-primary '. $button_size .' ' . $button_style . '" title="'. $button_title .'" ' . $button_rel . $button_target .'>';
				$output .= '<span class="calluna-button-inner">';
					if ( $button_icon_left ) {
						$output .= '<span class="calluna-button-icon-left '. $button_icon_left .'"></span>';
					}
					$output .= $button_text;
					if ( $button_icon_right ) {
						$output .= '<span class="calluna-button-icon-right '. $button_icon_right .'"></span>';
					}
				$output .= '</span>';
			$output .= '</a>';
		$output .= '</div>';
	}
	$output .= '</div>';
	
	return $output;
}
add_shortcode( 'cl_callout', 'calluna_callout_shortcode' );