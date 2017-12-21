<?php

// Highlights -------------------------------------------------------------------------- >	
function calluna_highlight_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'color'	=> 'blue',
		'class'	=> '',
	  ),
	  $atts ) );

	// Return output
	return '<div class="calluna-highlight calluna-highlight-'. $color .' '. $class .'">' . do_shortcode( $content ) . '</div>';

}
add_shortcode( 'cl_highlight', 'calluna_highlight_shortcode' );