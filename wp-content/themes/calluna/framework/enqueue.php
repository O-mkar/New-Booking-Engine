<?php
/*
Register Fonts
*/
function calluna_fonts_url() {
   $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lato = esc_html_x( 'on', 'Lato font: on or off', 'calluna-td' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $raleway = esc_html_x( 'on', 'Raleway font: on or off', 'calluna-td' );
 
    if ( 'off' !== $lato || 'off' !== $raleway ) {
        $font_families = array();
 
        if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:400,300,700,900,300italic,400italic,700italic';
        }
 
        if ( 'off' !== $raleway ) {
            $font_families[] = 'Raleway:400,300,500,600,700,800,200';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

/**
 * gymx enqueue scripts
 *
 */
function calluna_scripts() {
    wp_enqueue_style( 'calluna-fonts', calluna_fonts_url(), array(), '3.0.0' );
    
    /* Visual Composer CSS - Load now to avoid delay during page load and to avoid !important in gymx css */
    wp_enqueue_style('js_composer_front');
    
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
	
	wp_enqueue_script('jquery-ui-core', '', true);
	wp_enqueue_script('jquery-ui-position', '', true);
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.min.js', 'jquery','1.3', true);
	wp_enqueue_style( 'calluna-main', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), '3.0.0' );
	wp_enqueue_script( 'calluna-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '3.0.0', true );
	wp_enqueue_script( 'calluna-classie', get_template_directory_uri() . '/js/classie.min.js', array(), '', true );
	wp_enqueue_script( 'calluna-animated-header', get_template_directory_uri() . '/js/cbpAnimatedHeader.min.js', array('calluna-classie'), '', true );
	wp_enqueue_script( 'calluna-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20160115', true );
	wp_enqueue_script( 'calluna-main-js', get_template_directory_uri() . '/js/calluna-main.min.js', array('jquery'), '3.0.0', true );
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array('jquery'), '', true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_deregister_style( 'font-awesome' );
	wp_deregister_style( 'wpe-common' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-awesome' );
}

add_action( 'wp_enqueue_scripts', 'calluna_scripts' );