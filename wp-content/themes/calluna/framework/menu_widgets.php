<?php
/**
 * Declaring menus & widgets
 *
 */

/**
 * Register menus
 */
if(!( function_exists('calluna_register_nav_menus') )){
    function calluna_register_nav_menus() {
        register_nav_menus(
            array(
                'main_menu'         => esc_html__( 'Main Menu', 'calluna-td' ),
                'responsive_menu'   => esc_html__( 'Mobile Menu', 'calluna-td' )
            )
        );
    }
    add_action( 'init', 'calluna_register_nav_menus' );
}

/**
 * Register sidebars and footer widgets
 */
if(! function_exists('calluna_widgets_init')) {
    function calluna_widgets_init()
    {
        //Sidebars
        register_sidebar( array(
			'name'          => esc_html__( 'Blog sidebar', 'calluna-td' ),
			'id'            => 'blog',
			'description'   => esc_html__( 'Add widgets here to appear in the blog sidebar.', 'calluna-td' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Page sidebar', 'calluna-td' ),
			'id'            => 'page-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in the page sidebar.', 'calluna-td' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Logo', 'calluna-td' ),
			'id'            => 'footer-logo',
			'description'   => esc_html__( 'Add the footer logo here.', 'calluna-td' ),
			'before_widget' => '<div class="widget footer-logo">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			  'name'          => esc_html__( 'Footer Content One', 'calluna-td' ),
			  'id'            => 'footer-1',
			  'description'   => esc_html__( 'Add content for the footer.', 'calluna-td' ),
			  'before_widget' => '<div class="widget footer-1">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h3>',
			  'after_title'   => '</h3>',
		  ) );
		register_sidebar( array(
			  'name'          => esc_html__( 'Footer Content Two', 'calluna-td' ),
			  'id'            => 'footer-2',
			  'description'   => esc_html__( 'Add content for the footer.', 'calluna-td' ),
			  'before_widget' => '<div class="widget footer-2">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h3>',
			  'after_title'   => '</h3>',
		  ) );
		register_sidebar( array(
			  'name'          => esc_html__( 'Footer Content Three', 'calluna-td' ),
			  'id'            => 'footer-3',
			  'description'   => esc_html__( 'Add content for the footer', 'calluna-td' ),
			  'before_widget' => '<div class="widget footer-3">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h3>',
			  'after_title'   => '</h3>',
		  ) );
    }

}
add_action( 'widgets_init', 'calluna_widgets_init' );