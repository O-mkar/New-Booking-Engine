<?php
/**
 * gymx theme support
 */

if(! function_exists('calluna_add_editor_styles') ){
    function calluna_add_editor_styles() {

        add_editor_style( 'framework/editor-style.css' );

        /**
         * Set the content width based on the theme's design and stylesheet.
         */
        if ( ! isset( $content_width ) ) $content_width = 1140;

    }
    add_action( 'init', 'calluna_add_editor_styles', 10 );

}

if(! function_exists('calluna_add_theme_support')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function calluna_add_theme_support() {

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );
        
        update_option('thumbnail_size_w', 815);
		update_option('thumbnail_size_h', 458);
		
		add_image_size('calluna_normal', 320, 218, TRUE);

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'calluna_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', 'gallery', 'caption' ) );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on gymx, use a find and replace
         * to change 'gymx' to the name of your theme in all the template files
         */
        load_theme_textdomain('calluna-td', trailingslashit(get_template_directory()) . 'languages');

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'quote', 'link' ) );

    }
    add_action('after_setup_theme', 'calluna_add_theme_support', 10 );

}

