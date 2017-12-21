<?php

// Toggle -------------------------------------------------------------------------- >
function calluna_toggle_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'title'	=> 'Toggle Title',
		'class'	=> '',
		'state'	=> 'closed',
	), $atts ) );
	 
	$title = esc_attr($title);
	// Enque scripts
	wp_enqueue_script( 'calluna-toggle' );
	
	// Active Class
	$active_class = ( $state == 'open' ) ? 'active' : null;
	
	// Return output
	return '<div class="calluna-toggle state-'. $state .' '. $class .'"><h4 class="calluna-toggle-trigger '. $active_class .'"><i class="calluna-toggle-icon"></i>'. $title .'</h4><div class="calluna-toggle-container calluna-clearfix"><p>' . do_shortcode($content) . '</p></div></div>';

}
add_shortcode( 'cl_toggle', 'calluna_toggle_shortcode' );