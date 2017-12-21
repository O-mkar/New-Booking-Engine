<?php

// Tabs -------------------------------------------------------------------------- >
function calluna_tabgroup_shortcode( $atts, $content = null ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(), $atts ) );

	//Enque scripts
	wp_enqueue_script( 'jquery-ui-tabs' );
	//wp_enqueue_script( 'calluna-tabs' );

	preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
	$tab_titles = array();
	if ( isset($matches[1]) ){ $tab_titles = $matches[1]; }
	$output = '';
	if ( count($tab_titles) ){
		$output .= '<div id="calluna-tab-'. rand( 1, 10000 ) .'" class="callu calluna-tabs">';
		$output .= '<ul class="ui-tabs-nav">';
		foreach( $tab_titles as $tab ){
			$output .= '<li><a href="#calluna-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
		}
		$output .= '</ul>';
		$output .= do_shortcode( $content );
		$output .= '</div>';
	} else {
		$output .= do_shortcode( $content );
	}
	// Return output
	return $output;

}
add_shortcode( 'cl_tabgroup', 'calluna_tabgroup_shortcode' );

function calluna_tab_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'title'	=> 'Tab',
		'class'	=> ''
	), $atts ) );
	
	// Return output
	return '<div id="calluna-tab-'. sanitize_title( $title ) .'" class="tab-content calluna-clearfix '. $class .'"><p>'. do_shortcode( $content ) .'</p></div>';

}
add_shortcode( 'cl_tab', 'calluna_tab_shortcode' );