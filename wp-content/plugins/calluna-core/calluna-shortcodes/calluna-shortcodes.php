<?php

if ( ! class_exists( 'Calluna_Core_Shortcodes' ) ) {

	class Calluna_Core_Shortcodes {

		/**
		 * Main Constructor
		 */
		function __construct() {

			// Define path
			$this->dir_path = plugin_dir_path( __FILE__ );

			// Actions
			add_action( 'admin_head', array( $this, 'calluna_core_shortcodes_add_mce_button' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'calluna_core_shortcodes_load_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'calluna_core_shortcodes_mce_css' ) );

			// Includes (useful functions and classes)
			require_once( $this->dir_path .'/inc/commons.php' );
			require_once( $this->dir_path .'/inc/image-resizer.php' );
			
			// The actual shortcodes
			require_once( $this->dir_path .'/shortcodes/shortcodes.php' );
			
			// Init Visual Composer
			require_once( $this->dir_path .'/visual-composer/vc_init.php' );


			// Add responsive tag to body
			add_filter( 'body_class', array( $this, 'calluna_core_shortcodes_body_class' ) );

		}

		/**
		 * Add filters for the TinyMCE buttton
		 *
		 */
		function calluna_core_shortcodes_add_mce_button() {

			// Check user permissions
			if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
				return;
			}

			// Check if WYSIWYG is enabled
			if ( 'true' == get_user_option( 'rich_editing' ) ) {
				add_filter( 'mce_external_plugins', array( $this, 'calluna_core_shortcodes_add_tinymce_plugin' ) );
				add_filter( 'mce_buttons', array( $this, 'calluna_core_shortcodes_register_mce_button' ) );
			}

		}

		/**
		 * Loads the TinyMCE button js file
		 */
		function calluna_core_shortcodes_add_tinymce_plugin( $plugin_array ) {
			$plugin_array['calluna_core_shortcodes_mce_button'] = CALLUNA_CORE_URL . 'calluna-shortcodes/tinymce/calluna-shortcodes-tinymce.js';
			return $plugin_array;
		}

		/**
		 * Adds the TinyMCE button to the post editor buttons
		 */
		function calluna_core_shortcodes_register_mce_button( $buttons ) {
			array_push( $buttons, 'calluna_core_shortcodes_mce_button' );
			return $buttons;
		}

		/**
		 * Loads custom CSS for the TinyMCE editor button
		 */
		function calluna_core_shortcodes_mce_css() {
			wp_enqueue_style('calluna-shortcodes-tc', CALLUNA_CORE_URL . 'calluna-shortcodes/tinymce/calluna-shortcodes-tinymce-style.css' );
		}

		/**
		 * Registers/Enqueues all scripts and styles
		 */
		function calluna_core_shortcodes_load_scripts() {

			// Define js directory
			$js_dir = plugin_dir_url( __FILE__ ) . 'shortcodes/js/';

			// Define CSS directory
			$css_dir = plugin_dir_url( __FILE__ ) . 'shortcodes/css/';

			// JS
			wp_enqueue_script( 'jquery' );
			wp_register_script( 'calluna-skillbar', $js_dir . 'calluna-skillbar.min.js', array ( 'jquery' ));
			wp_register_script( 'magnific-popup', $js_dir . 'magnific-popup.min.js', array ( 'jquery' ));
			wp_register_script( 'calluna-lightbox', $js_dir . 'calluna-lightbox.min.js', array ( 'jquery', 'magnific-popup' ));
			wp_register_script( 'calluna-booking', $js_dir . 'calluna-booking.min.js', array ( 'jquery') );
			wp_register_script( 'calluna-datepicker', $js_dir . 'calluna-datepicker.js', array ( 'jquery') );
			wp_register_script( 'calluna-tabs', $js_dir . 'calluna-tabs.min.js', array ( 'jquery', 'jquery-ui-tabs' ) );
			wp_register_script( 'calluna-toggle', $js_dir . 'calluna-toggle.min.js', 'jquery' );
			wp_register_script( 'calluna-accordion', $js_dir . 'calluna-accordion.min.js', array ( 'jquery', 'jquery-ui-accordion' ) );
			wp_register_script( 'calluna-scroll-fade', $js_dir . 'calluna-scroll-fade.min.js', array ( 'jquery' ) );
			wp_register_script( 'calluna-icon', $js_dir . 'calluna-icon-type.min.js', array ( 'jquery' ) );
			wp_register_script( 'calluna-carousel', $js_dir . 'calluna-carousel.min.js', array ( 'jquery' ),null,true );
			
			
		}
		
		/**
		 * Adds classes to the body tag
		 */
		public function calluna_core_shortcodes_body_class( $classes ) {
			$classes[] = 'calluna-shortcodes ';
			$responsive = apply_filters( 'calluna_core_shortcodes_responsive', true );
			if ( $responsive ) {
				$classes[] = 'calluna-shortcodes-responsive';
			}
			return $classes;
		}
		
	}

	// Start things up
	$calluna_core_shortcodes = new Calluna_Core_Shortcodes();

}