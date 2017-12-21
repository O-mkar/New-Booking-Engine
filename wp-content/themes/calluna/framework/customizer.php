<?php
/**
 * Extend the Customizer with the Calluna Theme options
 *
 * @package calluna
 * @link http://codex.wordpress.org/Theme_Customization_API
 */

/**
 * This funtion is only called when the user is actually on the customizer page
 * @param  WP_Customize_Manager $wp_customize
 */
if ( ! function_exists( 'calluna_customizer' ) ) {
	function calluna_customizer( $wp_customize ) {
		// add required files
		require_once( get_template_directory() . '/framework/customizer/alpha-color-picker/alpha-color-picker.php' );
		require_once( get_template_directory() . '/framework/customizer/textarea-custom-control.php' );
		require_once( get_template_directory() . '/framework/customizer/calluna-customize-common.php' );
		require_once( get_template_directory() . '/framework/customizer/calluna-customize-css.php' );
		new Calluna_Customizer_Common( $wp_customize );
		
	}
	add_action( 'customize_register', 'calluna_customizer' );
}

/*
* Sanitize Callback for select boxes
*/
if( ! function_exists('calluna_sanitize_choices')) {
	function calluna_sanitize_choices( $input, $setting ) {
		global $wp_customize;
	 
		$control = $wp_customize->get_control( $setting->id );
	 
		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}

/**
 * Frontend output from the customizer
 */
if ( ! function_exists( 'calluna_customizer_frontend' ) && ! class_exists( 'Calluna_Customize_Frontend' ) ) {
	function calluna_customizer_frontend() {
		require_once( get_template_directory() . '/framework/customizer/calluna-customize-frontend.php' );
		new Calluna_Customize_Frontend();
	}
	add_action( 'init', 'calluna_customizer_frontend' );
}

/**
 * Include typography section for the customizer
 */
require_once get_template_directory() . '/framework/customizer/fonts.php';
require_once get_template_directory() . '/framework/customizer/typography.php';