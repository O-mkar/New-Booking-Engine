<?php

// Accordion -------------------------------------------------------------------------- >

// Main
function calluna_accordion_main_shortcode( $atts, $content = null  ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
		'class'	=> ''
	), $atts ) );
	
	// Enque scripts
	wp_enqueue_script( 'jquery-ui-accordion' );
	wp_enqueue_script( 'calluna-accordion' );
	
	// Return output
	return '<div class="calluna-accordion '. $class .'">' . do_shortcode($content) . '</div>';

}
add_shortcode( 'cl_accordion', 'calluna_accordion_main_shortcode' );


// Section
function calluna_accordion_section_shortcode( $atts, $content = null  ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'title'	=> 'Title',
		'class'	=> '',
	), $atts ) );
	
	$title = esc_attr($title);
	
	// Return output
	return '<h4 class="calluna-accordion-trigger '. $class .'"><a href="#"><span class="title">'. $title .'</span></a></h4><div class="calluna-clearfix"><p>' . do_shortcode($content) . '</p></div>';

}

add_shortcode( 'cl_accordion_section', 'calluna_accordion_section_shortcode' );