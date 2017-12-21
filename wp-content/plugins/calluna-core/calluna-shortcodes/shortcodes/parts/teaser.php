<?php

// Teaser -------------------------------------------------------------------------- >
function calluna_teaser_shortcode( $atts, $content = null ) {
	
	// Parse and extract shortcode attributes
	extract( shortcode_atts( array(
		'color'        => '',
		'text_align'		   => 'left',
	), $atts ) );
	// Return output
	if (!empty($color)) {
		return '<p class="teaser" style="color:' . esc_attr($color) . '; text-align:' . esc_attr($text_align) . ';">' . do_shortcode( $content ) .'</p>';
	} else {
		return '<p class="teaser">' . do_shortcode( $content ) .'</p>';	
	}

}
add_shortcode( 'cl_teaser', 'calluna_teaser_shortcode' );