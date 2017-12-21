<?php

// WPML -------------------------------------------------------------------------- >
function calluna_wpml_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'lang'	=> '',
	), $atts));

	// Translate
	if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
		return esc_html__( 'WPML ICL_LANGUAGE_CODE constant does not exist. If you want to translate something please first install the WPML plugin.', 'calluna-shortcodes' );
	}

	// Return string
	if ( $lang == ICL_LANGUAGE_CODE ) {
		return do_shortcode($content);
	}

}
add_shortcode( 'cl_wpml', 'calluna_wpml_shortcode' );