<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @package Calluna
 * @link http://codex.wordpress.org/Theme_Customization_API
 */

class Calluna_Customizer_Common {
	/**
	 * The singleton manager instance
	 *
	 * @see wp-includes/class-wp-customize-manager.php
	 * @var WP_Customize_Manager
	 */
	protected $wp_customize;

	public function __construct( WP_Customize_Manager $wp_manager ) {
		// set the private propery to instance of wp_manager
		$this->wp_customize = $wp_manager;
		
		// register the settings/panels/sections/controls, main method
		$this->register();

		/**
		 * Action and filters
		 */

		// render the CSS and cache it to the theme_mod when the setting is saved
		add_action( 'customize_save_after' , array( $this, 'cache_rendered_css' ) );

		// save logo width/height dimensions
		add_action( 'customize_save_logo_img' , array( $this, 'save_logo_dimensions' ), 10, 1 );

		// flush the rewrite rules after the customizer settings are saved
		add_action( 'customize_save_after', 'flush_rewrite_rules' );

		// handle the postMessage transfer method with some dynamically generated JS in the footer of the theme
		add_action( 'wp_footer', array( $this, 'customize_footer_js' ), 30 );
	}

	/**
	* This hooks into 'customize_register' (available as of WP 3.4) and allows
	* you to add new sections and controls to the Theme Customize screen.
	*
	* Note: To enable instant preview, we have to actually write a bit of custom
	* javascript. See live_preview() for more.
	*
	* @see add_action('customize_register',$func)
	*/
	public function register () {
		/**
		 * Settings
		 */
		// Logos
		$this->wp_customize->add_setting( 'logo_img', array( 'default' =>  get_stylesheet_directory_uri() . '/img/logo.png', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'logo_img',
			array(
			    'priority'    => 10,
				'label'       => esc_html_x( 'Logo Image', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Recommended height for the Logo is 165px.', 'backend', 'calluna-td' ),
				'section'     => 'calluna_section_logos',
			)
		) );
		
		$this->wp_customize->add_setting( 'small_img', array( 'default' => get_stylesheet_directory_uri() . '/img/small_logo.png', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'small_img',
			array(
			    'priority'    => 20,
				'label'       => esc_html_x( 'Small logo Image', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Recommended height for the logo is 50px.', 'backend', 'calluna-td' ),
				'section'     => 'calluna_section_logos',
			)
		) );
		
		$this->wp_customize->add_setting( 'favicon', array( 'default' => get_stylesheet_directory_uri() . '/img/favicon.png' , 'sanitize_callback' => 'esc_url_raw' ));
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'favicon',
			array(
			    'priority'    => 30,
				'label'       => esc_html_x( 'Fav icon Image', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Recommended dimensions are 32 x 32px.', 'backend', 'calluna-td' ),
				'section'     => 'calluna_section_logos',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'logo_padding_top', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'padding-top' => array(
					'.navigation'
				),
			)
		) ) );
		$this->wp_customize->add_control( 'logo_padding_top', array(
			'type'        => 'text',
			'priority'    => 40,
			'label'       => esc_html_x( 'Logo top padding', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'With the top padding you can create space between the logo and the top navigation area.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_logos',
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'logo_padding_bottom', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'padding-bottom' => array(
					'.navigation'
				),
			)
		) ) );
		$this->wp_customize->add_control( 'logo_padding_bottom', array(
			'type'        => 'text',
			'priority'    => 50,
			'label'       => esc_html_x( 'Logo bottom padding', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'With the bottom padding you can create space between the logo and the bottom navigation area.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_logos',
		) );
		
		//navigation
		$this->wp_customize->add_setting( 'navigation_style', array( 'default' => 'left-nav', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'navigation_style', array(
			'type'        => 'select',
			'priority'    => 15,
			'label'       => esc_html_x( 'Navigation style', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Transparent boxed, Color boxed or Full Width', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_navigation',
			'choices'     => array(
				'left-nav' => esc_html_x( 'Transparent', 'backend', 'calluna-td' ),
				'top-nav'  => esc_html_x( 'Color', 'backend', 'calluna-td' ),
				'top-full-nav'  => esc_html_x( 'Full Width', 'backend', 'calluna-td' ),
			),
		) );
		
		$this->wp_customize->add_setting( 'main_navigation_sticky', array( 'default' => 'sticky', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'main_navigation_sticky', array(
			'type'        => 'select',
			'priority'    => 20,
			'label'       => esc_html_x( 'Static or sticky', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_navigation',
			'choices'     => array(
				'static' => esc_html_x( 'Static', 'backend', 'calluna-td' ),
				'sticky' => esc_html_x( 'Sticky', 'backend', 'calluna-td' ),
			),
		) );
		
		if (function_exists('icl_get_languages')) {
			$this->wp_customize->add_setting( 'header_show_wpml', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
			$this->wp_customize->add_control( 'header_show_wpml', array(
                'type'        => 'select',
                'priority'    => 22,
                'label'       => esc_html_x( 'Show wpml language switcher in top bar', 'backend', 'calluna-td' ),
                'section'     => 'calluna_section_navigation',
                'choices'     => array(
                    'yes' => esc_html_x( 'Yes', 'backend', 'ttbase' ),
                    'no' => esc_html_x( 'No', 'backend', 'ttbase' ),
                ),
            ) );
		}
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'main_navigation_bg', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.top-full-nav',
					'.top-nav .container-fluid .row',
					'.navbar-shrink',
					'.left-nav|@media only screen and (max-width : 992px)',
					'.left-nav|@media only screen and (min-width : 768px)
		       and (max-device-width: 1024px)',
			   		'.top-nav|@media only screen and (max-width : 992px)',
					'.top-nav|@media only screen and (min-width : 768px)
		       and (max-device-width: 1024px)'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_bg',
			array(
				'priority' => 25,
				'label'    => esc_html_x( 'Navigation background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'navigation_sticky_bg', array(
			'default' => 'rgba(15,36,83,0.85)',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'background-color' => array(
					'.navbar-shrink',
				),
			)
		) ) );
		$this->wp_customize->add_control( new Customize_Alpha_Color_Control(
			$this->wp_customize,
			'navigation_sticky_bg',
			array(
				'priority' => 27,
				'label'    => esc_html_x( 'Sticky navigation background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
				'show_opacity'  => true, // Optional.
                'palette'   => array(
                    'rgba(15,36,83,0.85)', // RGB, RGBa, and hex values supported
                    '#0f2453',
                    'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
                    '#967a50' // Mix of color types = no problem
                )
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'main_navigation_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.nav-menu ul li a',
                    '.header-language .menu .has-dropdown i',
                    '.header-language .menu .has-dropdown a.language-toggle'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_color',
			array(
				'priority' => 30,
				'label'    => esc_html_x( 'Navigation link color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'main_navigation_color_hover', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.nav-menu ul li a:hover',
					'.nav-menu ul li a:focus',
					'.nav-menu ul li a:active',
                    '.header-language .menu .has-dropdown:hover i',
                    '.header-language .menu .has-dropdown:hover a.language-toggle'
				),
				'background-color' => array(
					'.nav-menu ul li a:hover:after',
                    '.header-language .menu .has-dropdown:hover a.language-toggle:after'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_color_hover',
			array(
				'priority' => 35,
				'label'    => esc_html_x( 'Navigation link hover color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'main_navigation_current_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.nav-menu ul li.current-menu-item > a'
				),
				'background-color' => array(
					'.nav-menu ul li.current-menu-item > a:after',
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_current_color',
			array(
				'priority' => 38,
				'label'    => esc_html_x( 'Navigation active link color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'navigation_dropdown_bg', array(
			'default' => '#0b1f45',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.nav-menu ul ul li a',
					'.nav-menu li.mega-menu .second-lvl',
                    '.header-language .menu > li > ul li a'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'navigation_dropdown_bg',
			array(
				'priority' => 40,
				'label'    => esc_html_x( 'Navigation dropdown background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'navigation_dropdown_separator', array(
			'default' => '#193470',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'border-bottom-color' => array(
					'.nav-menu ul ul li a',
                    '.header-language .menu > li > ul li a'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'navigation_dropdown_separator',
			array(
				'priority' => 42,
				'label'    => esc_html_x( 'Navigation dropdown separator color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'main_navigation_menu_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.nav-menu li.mega-menu .second-lvl ul li a',
					'.nav-menu ul ul li a',
                    '.header-language .menu > li > ul li a'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_menu_color',
			array(
				'priority' => 44,
				'label'    => esc_html_x( 'Navigation dropdown link color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'main_navigation_menu_color_hover', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.nav-menu ul ul li a:hover',
					'.nav-menu li.mega-menu .second-lvl ul li a:hover',
					'.nav-menu ul ul li a:focus',
					'.nav-menu li.mega-menu .second-lvl ul li a:focus',
                    '.header-language .menu > li > ul li a:hover'
					
				),
				'background-color' => array(
					'.nav-menu li.mega-menu .second-lvl ul li a:before',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_menu_color_hover',
			array(
				'priority' => 46,
				'label'    => esc_html_x( 'Navigation dropdown link hover color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'main_navigation_menu_current_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.nav-menu li.mega-menu .second-lvl ul li.menu-title > a',
					'.nav-menu li.mega-menu .second-lvl ul li.current-menu-item > a',
					'.nav-menu ul ul li.current-menu-item > a'
					
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_menu_current_color',
			array(
				'priority' => 48,
				'label'    => esc_html_x( 'Navigation dropdown active link color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'mobile_navigation_toggle_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.show-menu i',
					'.mobile-nav .close-mobile-nav:hover',
					'.mobile-nav .close-mobile-nav:focus'
				),
				'color' => array(
					'.mobile-nav .close-mobile-nav',
				),
				'border-color' => array(
					'.mobile-nav .close-mobile-nav',
					'.mobile-nav .close-mobile-nav:hover',
					'.mobile-nav .close-mobile-nav:focus'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'mobile_navigation_toggle_color',
			array(
				'priority' => 50,
				'label'    => esc_html_x( 'Mobile navigation menu toggle color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'mobile_navigation_bg_color', array(
			'default' => '#0b1f45',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.mobile-nav'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'mobile_navigation_bg_color',
			array(
				'priority' => 52,
				'label'    => esc_html_x( 'Mobile navigation background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'mobile_navigation_text_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.mobile-nav .mobile-menu ul li a'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'mobile_navigation_text_color',
			array(
				'priority' => 54,
				'label'    => esc_html_x( 'Mobile navigation text color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'mobile_navigation_text_hover_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.mobile-nav .mobile-menu ul li a:hover',
					'.mobile-nav .mobile-menu ul li a:focus'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'mobile_navigation_text_hover_color',
			array(
				'priority' => 56,
				'label'    => esc_html_x( 'Mobile navigation text hover color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'mobile_navigation_text_current_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.mobile-menu ul li.current_page_item > a',
					'.mobile-menu ul li.current-menu-item > a'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'mobile_navigation_text_current_color',
			array(
				'priority' => 58,
				'label'    => esc_html_x( 'Mobile navigation active link color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_navigation',
			)
		) );
		
		//Theme layout and colors
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'primary_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'border-color' => array(
					'.line-left-primary',
					'.line-right-primary',
					'.line-center-primary',
					'.calluna-pricing .calluna-pricing-cost',
					'.calluna-pricing .calluna-pricing-per'
				),
				'border-color|important' => array(
					'.vc_tta-panel-heading .vc_tta-controls-icon:after',
					'.vc_tta-panel-heading .vc_tta-controls-icon:before'
				),
				'color' => array(
					'a:hover',
					'a:focus',
					'.primary',
					'.headline',
					'.page-header',
					'.sidebar .widget:not(.widget--hotelier) ul li a:hover',
					'.sidebar .widget:not(.widget--hotelier) ul li a:focus',
					'.prev-post a:hover',
					'.prev-post a:focus',
					'.next-post a:hover',
					'.next-post a:focus',
					'.more-link:focus',
					'.more-link:hover',
					'blockquote p',
					'ul.post-sharing label',
					'.image-row span',
					'.simple-weather em',
					'.comment-form',
					'.time',
					'.calluna-toggle .calluna-toggle-trigger',
					'.calluna-testimonial-author span',
					'.calluna-callout-caption h1',
					'.calluna-callout-caption h4',
					'.calluna-callout-caption h5',
					'.calluna-shortcodes h1.calluna-heading',
					'.calluna-shortcodes h4.calluna-heading',
					'.calluna-shortcodes h5.calluna-heading',
                    '.event2-carousel .event-title-wrapper .event-title h3',
                    '.event2-carousel .event-title-wrapper .event-title h3 a',
                    '.woocommerce .woocommerce-info:before',
                    '.room_name a',
					'.price-text',
                    '.hotelier-pagination ul .page-numbers',
                    '.room__deposit',
                    '.rate__deposit',
                    '.room-loop__list li.room .room__price .amount',
                    'table.hotelier-table .reservation-table__room-link',
                    'table.hotelier-table .view-price-breakdown',
                    'table.hotelier-table .price-breakdown-wrapper table .price-breakdown__day--heading',
					'table.hotelier-table .price-breakdown-wrapper table .price-breakdown__cost--heading',
					'.single-room .room__gallery-link',
					'.single-room .room-meta-wrapper',
					'.single-room .room-available-rates a',
					'form.form--listing .room__more-link',
					'form.form--listing .room__gallery-link',
					'.widget-rooms-filter a',
					'.widget-booking .widget-booking__rooms-list a',
					'.widget-booking .amount',
					'.widget-rooms .widget-rooms__name',
					'.widget-rooms .widget-rooms__price .amount'
				),
				'color|important' => array(
					'.vc_tta-panel .vc_tta-panel-heading h4 a',
					'.vc_general .vc_tta-tab > a'
				),
				'border-bottom-color' => array(
					'.underline-primary:after',
					'.sidebar .widget:not(.widget--hotelier) .title:after',
					'.sidebar .widget:not(.widget--hotelier) .h3:after',
                    '.woocommerce-checkout #payment div.payment_box:before'
				),
				'border-top-color' => array(
					'.calluna-tooltip:after',
				),
				'background-color' => array(
					'.primary-background',
					'.calluna-tooltip',
					'#loader',
					'#preloader',
					'.calluna-pricing .calluna-pricing-header h4',
					'.classic.primary .room_grid_price',
                    '.fc-highlight',
                    '.woocommerce-checkout #payment div.payment_box',
                    '.single-room .room-available-rates a:hover',
                    '.single-room.no-sidebar .room-meta-wrapper:after'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'primary_color',
			array(
				'priority' => 30,
				'label'    => esc_html_x( 'Primary color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'secondary_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'border-color' => array(
					'.line-left-secondary',
					'.line-right-secondary',
					'.line-center-secondary',
					'.calluna-toggle .calluna-toggle-trigger.active',
					'.calluna-pricing.featured .calluna-pricing-cost',
					'.calluna-pricing.featured .calluna-pricing-per',
					'.calluna-testimonial-author-image img',
                    '.room-loop__list li.room .button--view-room-details',
                    'form.form--listing ul.listing__list li.listing__room.room--selected',
                    'form.form--listing .room__only-x-left',
                    '.widget-booking .widget-booking__date-block'
					
				),
				'border-right-color' => array(
					'#loader.loader-style .spinner-container ',
					'#page-loading div',
					'blockquote'
				),
				'border-top-color' => array(
					'#loader.loader-style .spinner-container ',
                    '.woocommerce .woocommerce-error',
                    '.woocommerce .woocommerce-info',
                    '.woocommerce .woocommerce-message'
				),
				'border-bottom-color' => array(
					'#loader.loader-style .spinner-container ',
					'.room-loop__list li.room .room__price .amount',
					'.single-room .room-meta-wrapper h3',
					'.single-room .room__details .room__price-wrapper .amount',
					'.single-room .room__rates .rate__price-wrapper .amount',
					'form.form--listing .room__price .amount',
					'form.form--listing .rate__price .amount',
					'ul.reservation-details__list .reservation-details__item--special-requests strong',
					'.widget-booking .amount',
					'.widget-rooms .widget-rooms__price .amount'
				),
				'border-color|important' => array(
					'.vc_tta.vc_general .vc_active .vc_tta-panel-heading',
					'.vc_active .vc_tta-panel-heading .vc_tta-controls-icon:after',
					'.vc_active .vc_tta-panel-heading .vc_tta-controls-icon:before',
					'.vc_general .vc_tta-tab.vc_active a'
				),
				'background-color' => array(
					'.secondary-background',
					'.sticky-post i',
					'.entry-header .icon-pin',
					'.calluna-pricing.featured .calluna-pricing-header h4',
					'.classic.secondary .room_grid_price',
                    '.event2-carousel .event-image-button',
                    '.hotelier-notice--info',
                    '.hotelier-pagination ul .page-numbers.current',
                    '.hotelier-pagination ul .page-numbers:hover',
                    '.room-loop__list li.room .button--view-room-details:hover',
                    '.widget-rooms-filter .widget-rooms-filter__group-label'
				),
				'color' => array(
					'.secondary',
					'.offer_price',
					'.offer_price span',
					'.offer_price span:not(.amount)',
					'.event_date_wrapper',
					'.event2-carousel .event-date-wrapper',
					'.event_date_zone',
					'.post_date_wrapper',
					'.author-meta .name',
					'.comment-body .author-name',
					'.comment-body .reply i',
					'.calluna-toggle .calluna-toggle-trigger.active',
					'.calluna-pricing .calluna-pricing-cost',
					'.calluna-pricing .calluna-pricing-per',
					'.calluna-testimonial-author',
					'.icon-clock',
					'.simple-weather i',
                    '.pre',
                    '.modal-price',
                    '.single-room .booking-price_wrapper .amount',
                    '.room-loop__list li.room .button--view-room-details',
                    'table.hotelier-table .reservation-table__room-link:hover',
                    'table.hotelier-table .view-price-breakdown:hover',
                    '.single-room .room-meta-wrapper a:hover',
                    '.single-room .room__rates .rate__conditions ul',
                    '.hotelier-listing .selected-nights:before',
                    'form.form--listing .room__only-x-left',
                    'form.form--listing .room__more-link:hover',
                    'form.form--listing .room__gallery-link:hover',
                    'form.form--listing .room__conditions ul',
					'form.form--listing .rate__conditions ul',
					'form.form--listing .room__max-guests .max:after',
					'ul.reservation-details__list strong',
					'.widget-rooms-filter li:hover a',
					'.widget-rooms-filter li:hover a:before',
					'.widget-rooms-filter li.widget-rooms-filter__group-item--chosen a:before',
					'.widget-rooms-filter li.widget-rooms-filter__group-item--chosen a:hover:before',
					'.widget-booking .widget-booking__day',
					'.widget-booking .widget-booking__rooms-list a:hover',
					'.widget-rooms .widget-rooms__name:hover',
					'#hotelier-datepicker .datepicker-input-select-wrapper:before'
				),
				'color|important' => array(
					'.vc_tta-panel.vc_active .vc_tta-panel-heading h4 a',
					'.vc_general .vc_tta-tab.vc_active a'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'secondary_color',
			array(
				'priority' => 32,
				'label'    => esc_html_x( 'Secondary color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'accent_color', array(
			'default' => '#f1f2f2',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.accent-background',
					'blockquote',
					'.calluna-callout',
					'.calluna-testimonial',
                    '.woocommerce .woocommerce-error',
                    '.woocommerce .woocommerce-info',
                    '.woocommerce .woocommerce-message',
                    '.woocommerce-checkout #payment'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'accent_color',
			array(
				'priority' => 33,
				'label'    => esc_html_x( 'Accent color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'sidebar_color', array(
			'default' => '#f1f2f2',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.reservation_sidebar',
					'.sidebar_wrapper'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'sidebar_color',
			array(
				'priority' => 34,
				'label'    => esc_html_x( 'Sidebar background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'heading2_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
				    'h2',
					'.text-column h2',
					'.sidebar h2',
					'.sidebar h2 a',
					'.calluna-callout-caption h2',
					'.calluna-shortcodes h2.calluna-heading',
					'.selected-room .title',
					'.includes_items_wrapper h2'
				),
				'border-bottom-color' => array(
					'.sidebar .widget:not(.widget--hotelier) .title:after',
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'heading2_color',
			array(
				'priority' => 35,
				'label'    => esc_html_x( 'H2 color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'heading3_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
				    'h3',
					'h3 + hr',
					'.text-column h3',
					'.sidebar h3',
					'.sidebar h3 a',
					'.title-row h3',
					'.entry-header h3',
					'.entry-header h3 a',
					'.wpcf7 h3',
					'.event_title h3',
					'.event_title h3 a',
					'.offer_title h3',
					'.offer_title h3 a',
					'.calluna-callout-caption h3',
					'.calluna-shortcodes h3.calluna-heading',
					'.comments-title',
					'.comment-reply-title',
				),
				'border-bottom-color' => array(
					'.sidebar .widget:not(.widget--hotelier) .h3:after',
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'heading3_color',
			array(
				'priority' => 36,
				'label'    => esc_html_x( 'H3 color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'text_color', array(
			'default' => '#444444',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'html',
					'body',
					'.wpb_wrapper p',
					'label',
					'.sidebar .form-control',
					'.error-404 .form-control',
					'.sidebar .widget:not(.widget--hotelier) ul li a:before',
					'.sidebar .comment-author-link:before',
					'.sidebar .comment-author-link .url',
					'.sidebar .textwidget',
					'.prev-post a i',
					'.next-post a i',
					'.meta .categories',
					'.meta i',
					'.meta a',
					'.entry-content',
					'.entry-summary',
					'.more-link:before',
					'.author-meta .info',
					'.comment-body .comment-time',
					'.comment-body .comment-text',
					'.booking-button .header',
					'.text-column p',
					'.item-text',
					'.includes_items_wrapper .item-text:before',
					'.wpcf7 .form-control',
					'.comment-form textarea',
					'.selected-room h5',
					'.left-icon .content',
					'.newsletter_container .textbox',
					'.calluna-shortcodes .calluna-recent-posts-entry-posted-on',
                    '.label-group',
                    '.woocommerce .woocommerce-error',
                    '.woocommerce .woocommerce-info',
                    '.woocommerce .woocommerce-message'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'text_color',
			array(
				'priority' => 37,
				'label'    => esc_html_x( 'Text color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'link_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'a',
					'.more-link',
					'.sidebar .widget:not(.widget--hotelier) ul li a',
					'.tagcloud a',
					'.tagcloud a:hover',
					'.tagcloud a:focus',
					'.comment-body .reply a',
					'.comment-respond .logged-in-as a',
					'.prev-post a',
					'.next-post a',
					'.link .content a',
					'.widget-booking .widget-booking__change-cart-link'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'link_color',
			array(
				'priority' => 38,
				'label'    => esc_html_x( 'Link color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( 'button_style', array( 'default' => 'style-1', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'button_style', array(
			'type'        => 'select',
			'priority'    => 39,
			'label'       => esc_html_x( 'Button style', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_theme_colors',
			'choices'     => array(
				'style-1' => esc_html_x( 'Style 1', 'backend', 'calluna-td' ),
				'style-2' => esc_html_x( 'Style 2', 'backend', 'calluna-td' ),
			),
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'primary_btn_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'border-color' => array(
					'.btn-primary',
					'.btn-primary.style-2',
					'.wpcf7 .btn-primary',
					'.room_grid_price',
                    '.room2-carousel .room-price.style-1',
                    '.room2-carousel .room-price.style-2',
					'.vc_gitem_row .style-1 .vc_btn3',
					'.vc_gitem_row .style-2 .vc_btn3',
					'.calluna-button.btn-primary',
					'.woocommerce input.button.alt',
					'.datepicker__close-button'
				),
				'border-bottom-color' => array(
					'.vc_grid-item .vc_gitem_row .wpb_content_element a.style-1',
					'.vc_grid-item .vc_gitem_row .wpb_content_element a.style-2'
				),
				'color' => array(
					'.btn-primary',
					'.wpcf7 .btn-primary',
					'.room_grid_price',
                    '.room2-carousel .room-price',
					'.vc_gitem_row .style-1 .vc_btn3',
					'.calluna-button.btn-primary',
					'.woocommerce input.button.alt',
					'.datepicker__close-button'
				),
				'background-color' => array(
					'.btn-primary.style-2',
					'.room_grid_price.style-2',
                    '.room2-carousel .room-price.style-2',
					'.vc_gitem_row .style-2 .vc_btn3'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'primary_btn_color',
			array(
				'priority' => 40,
				'label'    => esc_html_x( 'Primary button color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'primary_btn_text_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.btn-primary.style-2',
					'.room_grid_price.style-2',
                    '.room2-carousel .room-price.style-2',
					'.vc_gitem_row .style-2 .vc_btn3'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'primary_btn_text_color',
			array(
				'priority' => 42,
				'label'    => esc_html_x( 'Primary button text color', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Only for style two', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'primary_btn_hover_color', array(
			'default' => '#907650',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.btn-primary:hover',
					'.btn-primary.active',
					'.btn-primary.focus',
					'.btn-primary:active',
					'.btn-primary:focus',
					'.vc_gitem_row .style-1 .vc_btn3:hover',
					'.vc_gitem_row .style-1 .vc_btn3:focus',
					'.vc_gitem_row .style-1 .vc_btn3:active',
					'.vc_gitem_row .style-2 .vc_btn3:hover',
					'.vc_gitem_row .style-2 .vc_btn3:focus',
					'.vc_gitem_row .style-2 .vc_btn3:active',
					'.room_grid_item_hover .room_grid_price_hover',
                    '.room2-carousel .room-content-wrapper:hover .room-price',
					'.woocommerce input.button.alt:hover',
					'.woocommerce input.button.alt:focus',
					'.datepicker__close-button:hover'
					
				),
				'border-color' => array(
					'.btn-primary:hover',
					'.btn-primary.active',
					'.btn-primary.focus',
					'.btn-primary:active',
					'.btn-primary:focus',
					'.room_grid_item_hover .room_grid_price_hover',
                    '.room2-carousel .room-content-wrapper:hover .room-price.style-1',
                    '.room2-carousel .room-content-wrapper:hover .room-price.style-2',
					'.vc_gitem_row .style-1 .vc_btn3:hover',
					'.vc_gitem_row .style-1 .vc_btn3:focus',
					'.vc_gitem_row .style-1 .vc_btn3:active',
					'.vc_gitem_row .style-2 .vc_btn3:hover',
					'.vc_gitem_row .style-2 .vc_btn3:focus',
					'.vc_gitem_row .style-2 .vc_btn3:active',
					'.woocommerce input.button.alt:hover',
					'.woocommerce input.button.alt:active',
					'.woocommerce input.button.alt:focus',
					'.datepicker__close-button:hover'
				),
				'border-bottom-color' => array(
					'.vc_grid-item .vc_gitem_row .wpb_content_element a.style-1:hover',
					'.vc_grid-item .vc_gitem_row .wpb_content_element a.style-2:hover'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'primary_btn_hover_color',
			array(
				'priority' => 44,
				'label'    => esc_html_x( 'Primary button hover color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'primary_btn_text_hover_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.btn-primary:hover',
					'.btn-primary.active',
					'.btn-primary.focus',
					'.btn-primary:active',
					'.btn-primary:focus',
					'.room_grid_item_hover .room_grid_price_hover',
                    '.room2-carousel .room-content-wrapper:hover .room-price',
					'.vc_gitem_row .style-1 .vc_btn3:hover',
					'.vc_gitem_row .style-1 .vc_btn3:focus',
					'.vc_gitem_row .style-1 .vc_btn3:active',
					'.woocommerce input.button.alt:hover',
					'.woocommerce input.button.alt:focus',
					'.woocommerce input.button.alt:active',
					'.datepicker__close-button:hover'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'primary_btn_text_hover_color',
			array(
				'priority' => 46,
				'label'    => esc_html_x( 'Primary button text hover color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( 'booking_teaser_show', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'booking_teaser_show', array(
			'type'        => 'select',
			'priority'    => 50,
			'label'       => esc_html_x( 'Show booking teaser on front page', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_theme_colors',
			'choices'     => array(
				'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
				'no' => esc_html_x( 'No', 'backend', 'calluna-td' ),
			),
		) );
		$this->wp_customize->add_setting( 'booking_teaser_text', array( 'default' => 'Book your trip!', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'booking_teaser_text', array(
			'type'        => 'text',
			'priority'    => 51,
			'label'       => esc_html_x( 'Booking teaser text', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_theme_colors',
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'booking_teaser_bg_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.booking:not(.form--booking) span'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'booking_teaser_bg_color',
			array(
				'priority' => 52,
				'label'    => esc_html_x( 'Booking teaser background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'booking_teaser_text_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.booking:not(.form--booking) span'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'booking_teaser_text_color',
			array(
				'priority' => 54,
				'label'    => esc_html_x( 'Booking teaser text color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'go_top_bg_color', array(
			'default' => 'rgba(15,36,83,0.6)',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'background-color' => array(
					'#go-top',
				),
			)
		) ) );
		$this->wp_customize->add_control( new Customize_Alpha_Color_Control(
			$this->wp_customize,
			'go_top_bg_color',
			array(
				'priority' => 56,
				'label'    => esc_html_x( 'Go to top background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
				'show_opacity'  => true, // Optional.
                'palette'   => array(
                    'rgba(15,36,83,0.6)', // RGB, RGBa, and hex values supported
                    '#0f2453',
                    'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
                    '#967a50' // Mix of color types = no problem
                )
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'go_top_hover_color', array(
			'default' => 'rgba(150, 122, 80, 0.6)',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'background-color' => array(
					'#go-top:hover',
				),
			)
		) ) );
		$this->wp_customize->add_control( new Customize_Alpha_Color_Control(
			$this->wp_customize,
			'go_top_hover_color',
			array(
				'priority' => 58,
				'label'    => esc_html_x( 'Go to top hover color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_theme_colors',
				'show_opacity'  => true, // Optional.
                'palette'   => array(
                    'rgba(150, 122, 80, 0.6)', // RGB, RGBa, and hex values supported
                    '#0f2453',
                    'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
                    '#967a50' // Mix of color types = no problem
                )
			)
		) );
		
		//Column Styles
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'column_style1_background_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.column-style-1',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'column_style1_background_color',
			array(
				'priority' => 10,
				'label'    => esc_html_x( 'Style One background color', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Column background', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_columns',
			)
		) );
		$this->wp_customize->add_setting( 'column_style1_background_img', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'column_style1_background_img',
			array(
			    'priority'    => 15,
				'label'       => esc_html_x( 'Style One background image', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Column background image', 'backend', 'calluna-td' ),
				'section'     => 'calluna_section_columns',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'column_style1_title_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.column-style-1 h2',
					'.column-style-1 h3',
					'.column-style-1 .calluna-shortcodes h2.calluna-heading',
					'.column-style-1 .calluna-shortcodes h2.calluna-heading',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'column_style1_title_color',
			array(
				'priority' => 20,
				'label'    => esc_html_x( 'Style One Heading color', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Column Heading', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_columns',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'column_style1_title_underline_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.column-style-1 h2:after',
					'.column-style-1 h3:after',
					'.column-style-1 .calluna-shortcodes h2.calluna-heading:after',
					'.column-style-1 .calluna-shortcodes h2.calluna-heading:after',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'column_style1_title_underline_color',
			array(
				'priority' => 30,
				'label'    => esc_html_x( 'Style One Heading underline color', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Column Heading Underline', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_columns',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'column_style1_text_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.column-style-1',
					'.column-style-1 p',
					'.column-style-1 .teaser',
					'.column-style-1 p.teaser',
					'.column-style-1 .wpb_wrapper p.teaser'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'column_style1_text_color',
			array(
				'priority' => 40,
				'label'    => esc_html_x( 'Style One text color', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Column text', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_columns',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'column_style2_background_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.column-style-2'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'column_style2_background_color',
			array(
				'priority' => 50,
				'label'    => esc_html_x( 'Style Two background color', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Column background', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_columns',
			)
		) );
		$this->wp_customize->add_setting( 'column_style2_background_img', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'column_style2_background_img',
			array(
			    'priority'    => 55,
				'label'       => esc_html_x( 'Style Two background image', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Column background image', 'backend', 'calluna-td' ),
				'section'     => 'calluna_section_columns',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'column_style2_title_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.column-style-2 h2',
					'.column-style-2 h3',
					'.column-style-2 .calluna-shortcodes h2.calluna-heading',
					'.column-style-2 .calluna-shortcodes h3.calluna-heading'
					
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'column_style2_title_color',
			array(
				'priority' => 60,
				'label'    => esc_html_x( 'Style Two Heading color', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Column Heading', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_columns',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'column_style2_title_underline_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.column-style-2 h2:after',
					'.column-style-2 h3:after',
					'.column-style-2 .calluna-shortcodes h2.calluna-heading:after',
					'.column-style-2 .calluna-shortcodes h2.calluna-heading:after'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'column_style2_title_underline_color',
			array(
				'priority' => 70,
				'label'    => esc_html_x( 'Style Two Heading underline color', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Column Heading Underline', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_columns',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'column_style2_text_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.column-style-2',
					'.column-style-2 p',
					'.column-style-2 .teaser',
					'.column-style-2 p.teaser',
					'.column-style-2 .wpb_wrapper p.teaser'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'column_style2_text_color',
			array(
				'priority' => 80,
				'label'    => esc_html_x( 'Style Two text color', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Column text', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_columns',
			)
		) );
		// header
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'header_bg_color', array(
			'default' => '#0C2149',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.color-background',
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'header_bg_color',
			array(
				'priority' => 10,
				'label'    => esc_html_x( 'Header background color', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'for the colored header option', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_header',
			)
		) );
		$this->wp_customize->add_setting( 'header_title_pos', array( 'default' => 'text-left', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'header_title_pos', array(
			'type'        => 'select',
			'priority'    => 12,
			'label'       => esc_html_x( 'Header Title Alignment', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Left, center or right', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_header',
			'choices'     => array(
				'text-left' => esc_html_x( 'Left', 'backend', 'calluna-td' ),
				'text-center'  => esc_html_x( 'Center', 'backend', 'calluna-td' ),
				'text-right'  => esc_html_x( 'Right', 'backend', 'calluna-td' )
			),
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'header_title_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.color-background span',
					'.image-background span'
				),
				'border-color' => array(
					'.color-background hr',
					'.image-background hr'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'header_title_color',
			array(
				'priority' => 15,
				'label'    => esc_html_x( 'Header title color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_header',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'header_title_underline_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'border-color' => array(
					'.color-background .separator',
					'.image-background .separator'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'header_title_underline_color',
			array(
				'priority' => 20,
				'label'    => esc_html_x( 'Header title separator color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_header',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'header_title_padding_top', array(
			'default' => '19%%',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'padding-top' => array(
					'.header_text_wrapper'
				),
			)
		) ) );
		$this->wp_customize->add_control( 'header_title_padding_top', array(
			'type'        => 'text',
			'priority'    => 30,
			'label'       => esc_html_x( 'Header title top padding', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'With the top padding you can change the height for the image and color header option.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_header',
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'header_title_padding_bottom', array(
			'default' => '16%%',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'padding-bottom' => array(
					'.header_text_wrapper'
				),
			)
		) ) );
		$this->wp_customize->add_control( 'header_title_padding_bottom', array(
			'type'        => 'text',
			'priority'    => 35,
			'label'       => esc_html_x( 'Header title bottom padding', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'With the bottom padding you can change the height for the image and color header option', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_header',
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'header_title_padding_left', array(
			'default' => '8%%',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'padding-left' => array(
					'.header_text_wrapper'
				),
			)
		) ) );
		$this->wp_customize->add_control( 'header_title_padding_left', array(
			'type'        => 'text',
			'priority'    => 40,
			'label'       => esc_html_x( 'Header title left padding', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Change the left padding for the header title.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_header',
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'header_title_padding_right', array(
			'default' => '8%%',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'padding-right' => array(
					'.header_text_wrapper'
				),
			)
		) ) );
		$this->wp_customize->add_control( 'header_title_padding_right', array(
			'type'        => 'text',
			'priority'    => 45,
			'label'       => esc_html_x( 'Header title right padding', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Change the right padding for the header title.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_header',
		) );
		
		//Footer
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'footer_bg_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'.site-footer',
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_bg_color',
			array(
				'priority' => 10,
				'label'    => esc_html_x( 'Background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_footer',
			)
		) );
		$this->wp_customize->add_setting( 'footer_bg_img', array( 'default' =>  get_stylesheet_directory_uri() . '/img/small_logo.png', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'footer_bg_img',
			array(
			    'priority'    => 12,
				'label'       => esc_html_x( 'Footer background image', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Optional background image for the footer.', 'backend', 'calluna-td' ),
				'section'     => 'calluna_section_footer',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'footer_top_border_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'border-top-color' => array(
					'.top-footer-container',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_top_border_color',
			array(
				'priority' => 15,
				'label'    => esc_html_x( 'Top border color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_footer',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'footer_title_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.site-footer .widget h3',
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_title_color',
			array(
				'priority' => 25,
				'label'    => esc_html_x( 'Widget title color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_footer',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'footer_title_separator_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'border-color' => array(
					'.site-footer .widget h3:after',
				),
				
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_title_separator_color',
			array(
				'priority' => 30,
				'label'    => esc_html_x( 'Widget title separator color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_footer',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'footer_text_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.site-footer',	
					'.site-footer p',
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_text_color',
			array(
				'priority' => 31,
				'label'    => esc_html_x( 'Text color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_footer',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'footer_link_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.site-footer a',
					'.site-footer .menu li a'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_link_color',
			array(
				'priority' => 32,
				'label'    => esc_html_x( 'Link color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_footer',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'footer_link_hover_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.site-footer a:hover',
					'.site-footer .menu li a:hover'
				),
				'background-color' => array(
					'.site-footer a:after',
					'.site-footer a:hover:after',
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_link_hover_color',
			array(
				'priority' => 35,
				'label'    => esc_html_x( 'Link hover color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_footer',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'footer_link_current_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.site-footer .current_page_item a',
				),
				'background-color' => array(
				    '.site-footer .current_page_item a:after',
					'.site-footer .current_page_item a:hover:after'
				),
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_link_current_color',
			array(
				'priority' => 37,
				'label'    => esc_html_x( 'Link active color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_footer',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'footer_separator_color', array(
			'default' => '#193470',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'border-bottom-color' => array(
					'.top-footer-container',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_separator_color',
			array(
				'priority' => 40,
				'label'    => esc_html_x( 'Area separator color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_footer',
			)
		) );
		$this->wp_customize->add_setting( 'calluna_footer_widgets_show', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'calluna_footer_widgets_show', array(
			'type'        => 'select',
			'priority'    => 60,
			'label'       => esc_html_x( 'Show footer widgets', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Show the widget area for the footer.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_footer',
			'choices'     => array(
					'yes'	=> esc_html_x( 'Show', 'backend', 'calluna-td' ),
					'no'	=> esc_html_x( 'Hide', 'backend', 'calluna-td' ),
			),
		) );
		$this->wp_customize->add_setting( 'calluna_footer_bottom_show', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'calluna_footer_bottom_show', array(
			'type'        => 'select',
			'priority'    => 70,
			'label'       => esc_html_x( 'Show bottom footer bar', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Show the bottom footer with copyright text.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_footer',
			'choices'     => array(
					'yes'	=> esc_html_x( 'Show', 'backend', 'calluna-td' ),
					'no'	=> esc_html_x( 'Hide', 'backend', 'calluna-td' ),
			),
		) );
		$this->wp_customize->add_setting( 'footer_txt', array( 'default' => 'Copyright 2017 by <a href="http://themetwins.com/best-hotel-wordpress-themes/" title="themetwins" target="_blank">themetwins</a>. Calluna Hotel Theme crafted with love.', 'sanitize_callback' => false ) );
		$this->wp_customize->add_control( 'footer_txt', array(
			'type'        => 'text',
			'priority'    => 110,
			'label'       => esc_html_x( 'Copyright Text', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Bottom line text. You can use HTML.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_footer',
		) );
		
		//General Theme options
		$this->wp_customize->add_setting( 'loader', array( 'default' => 'no', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'loader', array(
            'type'        => 'select',
            'priority'    => 10,
            'label'       => esc_html_x( 'Show loading animation', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_general',
            'choices'     => array(
                'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
                'no'  => esc_html_x( 'No', 'backend', 'calluna-td' )
            ),
        ) );
		$this->wp_customize->add_setting( 'currency', array( 'default' => '$', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'currency', array(
			'type'        => 'text',
			'priority'    => 15,
			'label'       => esc_html_x( 'Currency', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add your currency for the prices', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_general',
		) );
		$this->wp_customize->add_setting( 'currency_pos', array( 'default' => 'before', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'currency_pos', array(
            'type'        => 'select',
            'priority'    => 20,
            'label'       => esc_html_x( 'Currency Position', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Before or after price', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_general',
            'choices'     => array(
                'before' => esc_html_x( 'Before', 'backend', 'calluna-td' ),
                'after'  => esc_html_x( 'After', 'backend', 'calluna-td' )
            ),
        ) );
		$this->wp_customize->add_setting( 'google_maps_api_key', array( 'default' => 'AIzaSyAczvbMZbgbPjgBbwEB-yxX4_TkREfUuxM', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'google_maps_api_key', array(
            'type'        => 'text',
            'priority'    => 25,
            'label'       => esc_html_x( 'Google Maps API Key', 'backend', 'calluna-td' ),
            'description' => sprintf( _x( '%s How to create API Key %s for the google maps.', 'backend', 'calluna-td' ), '<a href="https://developers.google.com/maps/documentation/javascript/" target="_blank">', '</a>' ),
            'section'     => 'calluna_section_general',
        ) );
        $this->wp_customize->add_setting( 'openweather_api_key', array( 'default' => '5f27a481372e38ca2b7c215ba8e10007', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'openweather_api_key', array(
            'type'        => 'text',
            'priority'    => 30,
            'label'       => esc_html_x( 'OpenweatherMap API Key', 'backend', 'calluna-td' ),
            'description' => sprintf( _x( '%s How to create API Key %s for openweathermaps.', 'backend', 'calluna-td' ), '<a href="http://openweathermap.org/appid" target="_blank">', '</a>' ),
            'section'     => 'calluna_section_general',
        ) );
        
		//Booking

        $this->wp_customize->add_setting( 'hotelier', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
        $this->wp_customize->add_control( 'hotelier', array(
            'type'        => 'select',
            'priority'    => 10,
            'label'       => esc_html_x( 'Use WP Hotelier Booking process', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_booking',
            'choices'     => array(
                'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
                'no'  => esc_html_x( 'No', 'backend', 'calluna-td' )
            ),
        ) );
        $this->wp_customize->add_setting( 'room_type_slug', array( 'default' => 'room', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'room_type_slug', array(
			'type'        => 'text',
			'priority'    => 11,
			'label'       => esc_html_x( 'Room Type Slug', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'After changing the slug, make sure to save your permalinks again.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_booking',
		) );
        $this->wp_customize->add_setting( 'guest_count', array( 'default' => 4, 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'guest_count', array(
			'type'        => 'text',
			'priority'    => 13,
			'label'       => esc_html_x( 'Guest number for Calendar', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add number for the guest select', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_booking',
		) );
		$this->wp_customize->add_setting( 'button_text', array( 'default' => 'Make a reservation', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'button_text', array(
			'type'        => 'text',
			'priority'    => 15,
			'label'       => esc_html_x( 'Reservation button text', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add the text shown on the button.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_booking',
		) );
		$this->wp_customize->add_setting( 'reservation_header', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'reservation_header', array(
			'type'        => 'text',
			'priority'    => 35,
			'label'       => esc_html_x( 'Reservation header', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Header for the additional reservation text', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_booking',
		) );
		$this->wp_customize->add_setting( 'reservation_text', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'reservation_text', array(
			'type'        => 'text',
			'priority'    => 40,
			'label'       => esc_html_x( 'reservation text', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Additonial reservation text', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_booking',
		) );
		$this->wp_customize->add_setting( 'reservation_hint', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'reservation_hint', array(
			'type'        => 'text',
			'priority'    => 41,
			'label'       => esc_html_x( 'reservation text', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Additonial reservation hint', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_booking',
		) );
		$this->wp_customize->add_setting( 'button_link', array('default' => '0', 'sanitize_callback' => 'absint' ) );
		$this->wp_customize->add_control( 'button_link', array(
			'type'        => 'dropdown-pages',
			'priority'    => 20,
			'label'       => esc_html_x( 'Button link', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Chose the page with the booking reservation form', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_booking',
		) );
		$this->wp_customize->add_setting( 'external_link', array('default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $this->wp_customize->add_control( 'external_link', array(
            'type'        => 'text',
            'priority'    => 25,
            'label'       => esc_html_x( 'External Link', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Link to an external page', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_booking',
        ) );
        $this->wp_customize->add_setting( 'booking_form_method', array( 'default' => 'GET', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
        $this->wp_customize->add_control( 'booking_form_method', array(
            'type'        => 'select',
            'priority'    => 26,
            'label'       => esc_html_x( 'Set Form Method', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'HTTP Get or Post', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_booking',
            'choices'     => array(
                'GET' => esc_html_x( 'Get', 'backend', 'calluna-td' ),
                'POST'  => esc_html_x( 'Post', 'backend', 'calluna-td' )
            ),
        ) );
        $this->wp_customize->add_setting( 'external_param_from', array('default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'external_param_from', array(
            'type'        => 'text',
            'priority'    => 28,
            'label'       => esc_html_x( 'External Parameter: Check-In', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Add parameter for the external check-in date field', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_booking',
        ) );
        $this->wp_customize->add_setting( 'external_param_to', array('default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'external_param_to', array(
            'type'        => 'text',
            'priority'    => 30,
            'label'       => esc_html_x( 'External Parameter: Check-Out', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Add parameter for the external check-out date field', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_booking',
        ) );
        $this->wp_customize->add_setting( 'external_param_guests', array('default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'external_param_guests', array(
            'type'        => 'text',
            'priority'    => 32,
            'label'       => esc_html_x( 'External Parameter: Guests', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Add parameter for the external guests field', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_booking',
        ) );
		$this->wp_customize->add_setting( 'external_param_add1_name', array('default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'external_param_add1_name', array(
            'type'        => 'text',
            'priority'    => 33,
            'label'       => esc_html_x( 'External Parameter Name: Custom 1', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Add name additional parameter', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_booking',
        ) );
		$this->wp_customize->add_setting( 'external_param_add1_value', array('default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'external_param_add1_value', array(
            'type'        => 'text',
            'priority'    => 34,
            'label'       => esc_html_x( 'External Parameter Value: Custom 1', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Add value for additional parameter', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_booking',
        ) );
		$this->wp_customize->add_setting( 'external_param_add2_name', array('default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'external_param_add2_name', array(
            'type'        => 'text',
            'priority'    => 36,
            'label'       => esc_html_x( 'External Parameter Name: Custom 2', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Add name for additional parameter', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_booking',
        ) );
        
        $this->wp_customize->add_setting( 'external_param_add2_value', array('default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'external_param_add2_value', array(
            'type'        => 'text',
            'priority'    => 38,
            'label'       => esc_html_x( 'External Parameter Value: Custom 2', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Add value for additional parameter', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_booking',
        ) );
        $this->wp_customize->add_setting( 'picker_arrows', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'picker_arrows', array(
			'type'        => 'select',
			'priority'    => 42,
			'label'       => esc_html_x( 'Show picker top arrows', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_booking',
			'choices'     => array(
				'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
				'no'  => esc_html_x( 'No', 'backend', 'calluna-td' )
			),
	    ) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_title_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'#datePicker p.title',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_title_color',
			array(
				'priority' => 45,
				'label'    => esc_html_x( 'Picker title color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_bg_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'#datePicker .dateField',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_bg_color',
			array(
				'priority' => 48,
				'label'    => esc_html_x( 'Picker background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_label_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'#datePicker .ui-widget-header',
					'#ui-datepicker-div .ui-widget-header',
					'.guests .title',
					'#datePicker .dateField p.month'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_label_color',
			array(
				'priority' => 60,
				'label'    => esc_html_x( 'Picker label color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_number_color', array(
			'default' => '#2f373b',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'#datePicker .dateField p',
					'#datePicker .ui-state-default',
					'#ui-datepicker-div .ui-state-default',
					'#datePicker .ui-widget-content',
					'#ui-datepicker-div .ui-widget-content',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_number_color',
			array(
				'priority' => 55,
				'label'    => esc_html_x( 'Picker number color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_number_bg_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'#datePicker .ui-state-default',
					'#ui-datepicker-div .ui-state-default',
					'#gasteSelect li'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_number_bg_color',
			array(
				'priority' => 61,
				'label'    => esc_html_x( 'Calendar number background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_border_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'border-color' => array(
					'#datePicker .dateField',
				),
				'border-bottom-color' => array(
					'#datePicker .arrow-up',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_border_color',
			array(
				'priority' => 50,
				'label'    => esc_html_x( 'Picker border color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_actual_date_background_color', array(
			'default' => '#d2d2d2',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'#datePicker .ui-state-highlight',
					'#ui-datepicker-div .ui-state-highlight',
                    '.datepicker__month-day--today'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_actual_date_background_color',
			array(
				'priority' => 62,
				'label'    => esc_html_x( 'Calendar actual date background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_actual_date_text_color', array(
			'default' => '#363636',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'#datePicker .ui-state-highlight',
					'#ui-datepicker-div .ui-state-highlight',
                    '.datepicker__month-day--today'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_actual_date_text_color',
			array(
				'priority' => 64,
				'label'    => esc_html_x( 'Calendar actual date text color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_selected_date_background_color', array(
			'default' => '#0f2453',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'#datePicker .ui-state-active',
					'#ui-datepicker-div .ui-state-hover',
					'#datePicker .ui-state-active.ui-state-hover',
					'#ui-datepicker-div ui-state-active.ui-state-hover',
					'#gasteSelect li.active',
                    '.datepicker__month-day--first-day-selected',
                    '.datepicker__month-day--last-day-selected'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_selected_date_background_color',
			array(
				'priority' => 66,
				'label'    => esc_html_x( 'Calendar selected date background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_selected_date_text_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'#datePicker .ui-state-active',
					'#ui-datepicker-div .ui-state-active',
					'#gasteSelect li.active',
                    '.datepicker__month-day--first-day-selected', 
                    '.datepicker__month-day--last-day-selected'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_selected_date_text_color',
			array(
				'priority' => 68,
				'label'    => esc_html_x( 'Calendar selected date text color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_hover_background_color', array(
			'default' => '#967a50',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'background-color' => array(
					'#datePicker .ui-state-hover',
					'#ui-datepicker-div .ui-state-hover',
					'#gasteSelect li:hover',
                    '.datepicker__month-day--hovering',
                    '.datepicker__month-day--selected'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_hover_background_color',
			array(
				'priority' => 70,
				'label'    => esc_html_x( 'Calendar number hover background color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'picker_hover_text_color', array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'#datePicker .ui-state-hover',
					'#ui-datepicker-div .ui-state-hover',
					'#gasteSelect li:hover',
                    '.datepicker__month-day--hovering',
                    '.datepicker__month-day--selected'
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'picker_hover_text_color',
			array(
				'priority' => 72,
				'label'    => esc_html_x( 'Calendar number hover text color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'reservation_header_color', array(
			'default' => '#031337',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.reservation_header',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'reservation_header_color',
			array(
				'priority' => 75,
				'label'    => esc_html_x( 'Reservation header color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'reservation_text_hint_color', array(
			'default' => '#5b5b5b',
			'sanitize_callback' => 'sanitize_hex_color',
			'css_map' => array(
				'color' => array(
					'.reservation_text',
					'.reservation_hint',
				)
			)
		) ) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'reservation_text_hint_color',
			array(
				'priority' => 80,
				'label'    => esc_html_x( 'Reservation text and hint color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_booking',
			)
		) );
		//Rooms
		$this->wp_customize->add_setting( 'related_rooms', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
        $this->wp_customize->add_control( 'related_rooms', array(
			'type'        => 'select',
			'priority'    => 5,
			'label'       => esc_html_x( 'Show related rooms', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Show other rooms on single room', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_rooms',
			'choices'     => array(
				'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
				'no'  => esc_html_x( 'No', 'backend', 'calluna-td' )
			),
		) );
        $this->wp_customize->add_setting( 'show_room_map', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'show_room_map', array(
            'type'        => 'select',
            'priority'    => 5,
            'label'       => esc_html_x( 'Show google map', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Show google map on single room', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_rooms',
            'choices'     => array(
                'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
                'no'  => esc_html_x( 'No', 'backend', 'calluna-td' )
            ),
        ) );
		$this->wp_customize->add_setting( 'show_date_picker', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'show_date_picker', array(
			'type'        => 'select',
			'priority'    => 6,
			'label'       => esc_html_x( 'Show Date Picker', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Show the date picker on a single room', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_rooms',
			'choices'     => array(
				'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
				'no'  => esc_html_x( 'No', 'backend', 'calluna-td' )
			),
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'room_overlay_color', array(
			'default' => 'rgba(15,36,83,0.4)',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'color' => array(
					'.room_grid_item'
				),
				'background-color' => array(
						'.room2-carousel .room-content-wrapper .overlay'
				),
			)
		) ) );
		$this->wp_customize->add_control( new Customize_Alpha_Color_Control(
			$this->wp_customize,
			'room_overlay_color',
			array(
				'priority' => 10,
				'label'    => esc_html_x( 'Room Carousel Overlay Color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_rooms',
				'show_opacity'  => true, // Optional.
                'palette'   => array(
                    'rgba(15,36,83,0.4)', // RGB, RGBa, and hex values supported
                    'rgba(15,36,83,0.6)',
                    'rgba(15,36,83,0.7)',
                    'rgba(15,36,83,0.8)', // RGB, RGBa, and hex values supported
                )
			)
		) );
		$this->wp_customize->add_setting( new Calluna_Customize_CSS( $this->wp_customize, 'room_hover_color', array(
			'default' => 'rgba(150,122,80,0.7)',
			'sanitize_callback' => 'sanitize_text_field',
			'css_map' => array(
				'background-color' => array(
					'.jcarousel-item .room_grid_item_hover',
					'.room2-carousel .room-content-wrapper:hover .overlay'
				),
			)
		) ) );
		$this->wp_customize->add_control( new Customize_Alpha_Color_Control(
			$this->wp_customize,
			'room_hover_color',
			array(
				'priority' => 15,
				'label'    => esc_html_x( 'Room Carousel Hover Color', 'backend', 'calluna-td' ),
				'section'  => 'calluna_section_rooms',
				'show_opacity'  => true, // Optional.
                'palette'   => array(
                    'rgba(144, 118, 80, 0.7)', // RGB, RGBa, and hex values supported
                    'rgba(144, 118, 80, 0.4)', // RGB, RGBa, and hex values supported
                    'rgba(144, 118, 80, 0.5)', // RGB, RGBa, and hex values supported
                    'rgba(144, 118, 80, 0.6)', // RGB, RGBa, and hex values supported
                )
			)
		) );
        
		$this->wp_customize->add_setting( 'room_amenities_title', array( 'default' => 'Amenities', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'room_amenities_title', array(
            'type'        => 'text',
            'priority'    => 35,
            'label'       => esc_html_x( 'Title for the amenities section', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_rooms',
        ) );
		$this->wp_customize->add_setting( 'room_gallery_title', array( 'default' => 'Gallery', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'room_gallery_title', array(
            'type'        => 'text',
            'priority'    => 40,
            'label'       => esc_html_x( 'Title for the gallery section', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_rooms',
        ) );
		$this->wp_customize->add_setting( 'room_button_text', array( 'default' => 'starting at', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'room_button_text', array(
            'type'        => 'text',
            'priority'    => 50,
            'label'       => esc_html_x( 'Button Text for the Room Carousel', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_rooms',
        ) );
        $this->wp_customize->add_setting( 'room_button_price', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'room_button_price', array(
            'type'        => 'select',
            'priority'    => 60,
            'label'       => esc_html_x( 'Room Carousel Button: Show price?', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Show price on the button of the room carousel', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_rooms',
            'choices'     => array(
                'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
                'no'  => esc_html_x( 'No', 'backend', 'calluna-td' )
            ),
        ) );
		//Events
        $this->wp_customize->add_setting( 'event_type_slug', array( 'default' => 'event', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'event_type_slug', array(
            'type'        => 'text',
            'priority'    => 10,
            'label'       => esc_html_x( 'Event Type Slug', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'After changing the slug, make sure to save your permalinks again.', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_events',
        ) );
		$this->wp_customize->add_setting( 'related_events', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'related_events', array(
			'type'        => 'select',
			'priority'    => 15,
			'label'       => esc_html_x( 'Show related events', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Show other events on single event', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_events',
			'choices'     => array(
				'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
				'no'  => esc_html_x( 'No', 'backend', 'calluna-td' )
			),
		) );
		$this->wp_customize->add_setting( 'related_events_title', array( 'default' => 'More Events', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'related_events_title', array(
			'type'        => 'text',
			'priority'    => 18,
			'label'       => esc_html_x( 'Related Events Title', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Title for the related events carousel', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_events',
		) );
		$this->wp_customize->add_setting( 'related_events_text', array( 'default' => 'More Events Details', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( new Calluna_Customize_Textarea_Control(
	        $this->wp_customize,
	        'related_events_text',
	        array(
	            'priority'    => 20,
				'label'       => esc_html_x( 'Related Events Text', 'backend', 'calluna-td' ),
				'description' => esc_html_x( 'Text for the related events carousel', 'backend', 'calluna-td' ),
				'section'     => 'calluna_section_events',
	        )
		));
		$this->wp_customize->add_setting( 'event_gallery_title', array( 'default' => 'Gallery', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'event_gallery_title', array(
            'type'        => 'text',
            'priority'    => 25,
            'label'       => esc_html_x( 'Title for the gallery section', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_events',
        ) );
        $this->wp_customize->add_setting( 'event_details_title', array( 'default' => 'Details', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'event_details_title', array(
            'type'        => 'text',
            'priority'    => 35,
            'label'       => esc_html_x( 'Title for the details section', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_events',
        ) );
        $this->wp_customize->add_setting( 'event_details_subtitle', array( 'default' => 'What\'s included', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'event_details_subtitle', array(
            'type'        => 'text',
            'priority'    => 45,
            'label'       => esc_html_x( 'Subtitle for the details section', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_events',
        ) );
		//Offers
        $this->wp_customize->add_setting( 'offer_type_slug', array( 'default' => 'offer', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'offer_type_slug', array(
            'type'        => 'text',
            'priority'    => 10,
            'label'       => esc_html_x( 'Offer Type Slug', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'After changing the slug, make sure to save your permalinks again.', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_offers',
        ) );
		$this->wp_customize->add_setting( 'offer_button_text', array( 'default' => 'Offer reservation', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'offer_button_text', array(
			'type'        => 'text',
			'priority'    => 15,
			'label'       => esc_html_x( 'Reservation button text', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Text shown on the button.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_offers',
		) );
		$this->wp_customize->add_setting( 'offer_button_link', array('default' => '0', 'sanitize_callback' => 'absint' ) );
		$this->wp_customize->add_control( 'offer_button_link', array(
			'type'        => 'dropdown-pages',
			'priority'    => 17,
			'label'       => esc_html_x( 'Offer reservation link', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Chose the page with the offer reservation form', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_offers',
		) );
		$this->wp_customize->add_setting( 'related_offers', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'related_offers', array(
			'type'        => 'select',
			'priority'    => 18,
			'label'       => esc_html_x( 'Show related offers', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Show other offers on single offer', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_offers',
			'choices'     => array(
				'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
				'no'  => esc_html_x( 'No', 'backend', 'calluna-td' )
			),
		) );
		$this->wp_customize->add_setting( 'related_offers_cat', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'related_offers_cat', array(
			'type'        => 'text',
			'priority'    => 20,
			'label'       => esc_html_x( 'Related Offers Category', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Show only related offers from this category. Leave empty for all categories.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_offers',
		) );
		$this->wp_customize->add_setting( 'related_offers_title', array( 'default' => 'Other Offers', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'related_offers_title', array(
			'type'        => 'text',
			'priority'    => 25,
			'label'       => esc_html_x( 'Related Offers Title', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Title for the related offers carousel', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_offers',
		) );
		$this->wp_customize->add_setting( 'related_offers_text', array( 'default' => 'Other Offers Details', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'related_offers_text', array(
			'type'        => 'text',
			'priority'    => 30,
			'label'       => esc_html_x( 'Related Offers Text', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Text for the related offers carousel', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_offers',
		) );
		$this->wp_customize->add_setting( 'offer_price_text', array( 'default' => 'Price per person', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'offer_price_text', array(
			'type'        => 'text',
			'priority'    => 35,
			'label'       => esc_html_x( 'Prefix text for offer price', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Text shown in front of the offer price.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_offers',
		) );
        $this->wp_customize->add_setting( 'offer_gallery_title', array( 'default' => 'Gallery', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'offer_gallery_title', array(
            'type'        => 'text',
            'priority'    => 40,
            'label'       => esc_html_x( 'Title for the gallery section', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_offers',
        ) );
        $this->wp_customize->add_setting( 'offer_details_title', array( 'default' => 'Details', 'sanitize_callback' => 'sanitize_text_field' ) );
        $this->wp_customize->add_control( 'offer_details_title', array(
            'type'        => 'text',
            'priority'    => 45,
            'label'       => esc_html_x( 'Title for the details section', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_offers',
        ) );
        $this->wp_customize->add_setting( 'offer_details_subtitle', array( 'default' => 'What\'s included', 'sanitize_callback' => 'sanitize_text_field' ) );
		$this->wp_customize->add_control( 'offer_details_subtitle', array(
            'type'        => 'text',
            'priority'    => 50,
            'label'       => esc_html_x( 'Subtitle for the details section', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_offers',
        ) );
        
		//Social Media
		$this->wp_customize->add_setting( 'facebook_account', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( 'facebook_account', array(
			'type'        => 'text',
			'priority'    => 10,
			'label'       => esc_html_x( 'Facebook', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add your facebook profil URL','backend', 'calluna-td' ),
			'section'     => 'calluna_section_social_media',
		) );
		$this->wp_customize->add_setting( 'twitter_account', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( 'twitter_account', array(
			'type'        => 'text',
			'priority'    => 20,
			'label'       => esc_html_x( 'Twitter', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add your twitter profil URL', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_social_media',
		) );
		$this->wp_customize->add_setting( 'google_account', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( 'google_account', array(
			'type'        => 'text',
			'priority'    => 30,
			'label'       => esc_html_x( 'Google+', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add your google+ profil URL', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_social_media',
		) );
		$this->wp_customize->add_setting( 'instagram_account', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( 'instagram_account', array(
			'type'        => 'text',
			'priority'    => 35,
			'label'       => esc_html_x( 'Instagram', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add your instagram profil URL', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_social_media',
		) );
		$this->wp_customize->add_setting( 'pinterest_account', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( 'pinterest_account', array(
			'type'        => 'text',
			'priority'    => 40,
			'label'       => esc_html_x( 'Pinterest', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add your pinterest profil URL', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_social_media',
		) );
		$this->wp_customize->add_setting( 'tumblr_account', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$this->wp_customize->add_control( 'tumblr_account', array(
			'type'        => 'text',
			'priority'    => 50,
			'label'       => esc_html_x( 'Tumblr', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add your tumblr profil URL', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_social_media',
		) );
		$this->wp_customize->add_setting( 'linkedin_account', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $this->wp_customize->add_control( 'linkedin_account', array(
			'type'        => 'text',
			'priority'    => 60,
			'label'       => esc_html_x( 'LinkedIn', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add your LinkedIn profil URL', 'backend', 'calluna-td' ),
			'section'     => 'calluna_section_social_media',
		) );
        $this->wp_customize->add_setting( 'youtube_account', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $this->wp_customize->add_control( 'youtube_account', array(
            'type'        => 'text',
            'priority'    => 62,
            'label'       => esc_html_x( 'Youtube', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Add your Youtube profil URL', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_social_media',
        ) );
        $this->wp_customize->add_setting( 'yelp_account', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $this->wp_customize->add_control( 'yelp_account', array(
            'type'        => 'text',
            'priority'    => 64,
            'label'       => esc_html_x( 'Yelp', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Add your yelp profil URL', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_social_media',
        ) );
        $this->wp_customize->add_setting( 'tripadvisor_account', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $this->wp_customize->add_control( 'tripadvisor_account', array(
            'type'        => 'text',
            'priority'    => 66,
            'label'       => esc_html_x( 'Tripadvisor', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Add your tripadvisor profil URL', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_social_media',
        ) );
        
        // Section Blog
        
        $this->wp_customize->add_setting( 'share_on_post', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
		$this->wp_customize->add_control( 'share_on_post', array(
            'type'        => 'select',
            'priority'    => 20,
            'label'       => esc_html_x( 'Single Post: Show Social Share?', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Show share options for a single post.', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_blog',
            'choices'     => array(
                'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
                'no' => esc_html_x( 'No', 'backend', 'calluna-td' ),
            ),
        ) );
        $this->wp_customize->add_setting( 'blog_position_sidebar', array( 'default' => 'right', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
        $this->wp_customize->add_control( 'blog_position_sidebar', array(
            'type'        => 'select',
            'priority'    => 10,
            'label'       => esc_html_x( 'Blog: Sidebar Position', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_blog',
            'choices'     => array(
                'right' => esc_html_x( 'Right', 'backend', 'calluna-td' ),
                'left' => esc_html_x( 'Left', 'backend', 'calluna-td' ),
                'none' => esc_html_x( 'No Sidebar', 'backend', 'calluna-td' ),
            ),
        ) );
        $this->wp_customize->add_setting( 'post_position_sidebar', array( 'default' => 'right', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
        $this->wp_customize->add_control( 'post_position_sidebar', array(
            'type'        => 'select',
            'priority'    => 15,
            'label'       => esc_html_x( 'Single Post: Sidebar Position', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_blog',
            'choices'     => array(
                'right' => esc_html_x( 'Right', 'backend', 'calluna-td' ),
                'left' => esc_html_x( 'Left', 'backend', 'calluna-td' ),
                'none' => esc_html_x( 'No Sidebar', 'backend', 'calluna-td' ),
            ),
        ) );
        
        $this->wp_customize->add_setting( 'post_tags', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
        $this->wp_customize->add_control( 'post_tags', array(
            'type'        => 'select',
            'priority'    => 25,
            'label'       => esc_html_x( 'Single Post: Show Tags?', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Show Tags for a single post.', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_blog',
            'choices'     => array(
                'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
                'no' => esc_html_x( 'No', 'backend', 'calluna-td' ),
            ),
        ) );
        $this->wp_customize->add_setting( 'post_author', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
        $this->wp_customize->add_control( 'post_author', array(
            'type'        => 'select',
            'priority'    => 30,
            'label'       => esc_html_x( 'Single Post: Show Author Details?', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Show author details for a single post.', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_blog',
            'choices'     => array(
                'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
                'no' => esc_html_x( 'No', 'backend', 'calluna-td' ),
            ),
        ) );
        $this->wp_customize->add_setting( 'post_nav', array( 'default' => 'yes', 'sanitize_callback' => 'calluna_sanitize_choices' ) );
        $this->wp_customize->add_control( 'post_nav', array(
            'type'        => 'select',
            'priority'    => 40,
            'label'       => esc_html_x( 'Single Post: Show Post Navigation?', 'backend', 'calluna-td' ),
            'description' => esc_html_x( 'Show prev and next navigation for a single post.', 'backend', 'calluna-td' ),
            'section'     => 'calluna_section_blog',
            'choices'     => array(
                'yes' => esc_html_x( 'Yes', 'backend', 'calluna-td' ),
                'no' => esc_html_x( 'No', 'backend', 'calluna-td' ),
            ),
        ) );
		// custom code (css/js)
		$this->wp_customize->add_setting( 'custom_css', array( 'default' => '/* enter your css here */', 'sanitize_callback' => false ) );
		$this->wp_customize->add_control( 'custom_css', array(
			'type'        => 'textarea',
			'label'       => esc_html_x( 'Custom CSS', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Add your custom css code', 'backend', 'calluna-td' ),
			'section'     => 'calluna_custom_code',
		) );
		$this->wp_customize->add_setting( 'custom_js_head', array( 'sanitize_callback' => false ) );
		$this->wp_customize->add_control( 'custom_js_head', array(
			'type'        => 'textarea',
			'label'       => esc_html_x( 'Custom JavaScript (head)', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'You have to include the &lt;script&gt;&lt;/script&gt; tags as well.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_custom_code',
		) );
		$this->wp_customize->add_setting( 'custom_js_footer', array( 'sanitize_callback' => false ) );
		$this->wp_customize->add_control( 'custom_js_footer', array(
			'type'        => 'textarea',
			'label'       => esc_html_x( 'Custom JavaScript (footer)', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'You have to include the &lt;script&gt;&lt;/script&gt; tags as well.', 'backend', 'calluna-td' ),
			'section'     => 'calluna_custom_code',
		) );

		/**
		 * Panel and Sections
		 */


		// individual sections
		$this->wp_customize->add_section( 'calluna_section_logos', array(
			'title'       => esc_html_x( 'Logo, Small logo &amp; favicon', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Logo, small logo &amp; favicon for the Calluna theme.', 'backend', 'calluna-td' ),
			'priority'    => 30
		) );
		$this->wp_customize->add_section( 'calluna_section_navigation', array(
			'title'       => esc_html_x( 'Navigation', 'backend', 'calluna-td' ),
			'priority'    => 121,
		) );
		$this->wp_customize->add_section( 'calluna_section_theme_colors', array(
			'title'       => esc_html_x( 'Theme Layout &amp; Colors', 'backend', 'calluna-td' ),
			'priority'    => 122,
		) ); 
		$this->wp_customize->add_section( 'calluna_section_columns', array(
			'title'       => esc_html_x( 'Column Styles', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'Define two different column styles','backend', 'calluna-td' ),
			'priority'    => 130,
		) ); 
		$this->wp_customize->add_section( 'calluna_section_header', array(
			'title'       => esc_html_x( 'Header', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'All layout and appearance settings for the header.', 'backend', 'calluna-td' ),
			'priority'    => 135,
		) );
		
		$this->wp_customize->add_section( 'calluna_section_footer', array(
			'title'       => esc_html_x( 'Footer', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'All layout and appearance settings for the footer.', 'backend', 'calluna-td' ),
			'priority'    => 140,
		) );
		
		$this->wp_customize->add_section( 'calluna_section_general', array(
			'title'       => esc_html_x( 'General', 'backend', 'calluna-td' ),
			'description' => esc_html_x( 'General Theme Options', 'backend', 'calluna-td' ),
			'priority'    => 145
		) );
		
		$this->wp_customize->add_section( 'calluna_section_booking', array(
			'title'       => esc_html_x( 'Booking', 'backend', 'calluna-td' ),
			'priority'    => 150
		) );
		
		$this->wp_customize->add_section( 'calluna_section_rooms', array(
			'title'       => esc_html_x( 'Rooms', 'backend', 'calluna-td' ),
			'priority'    => 155
		) );
		
		$this->wp_customize->add_section( 'calluna_section_events', array(
			'title'       => esc_html_x( 'Events', 'backend', 'calluna-td' ),
			'priority'    => 160
		) );
		
		$this->wp_customize->add_section( 'calluna_section_offers', array(
			'title'       => esc_html_x( 'Offers', 'backend', 'calluna-td' ),
			'priority'    => 165
		) );
        $this->wp_customize->add_section( 'calluna_section_blog', array(
            'title'       => esc_html_x( 'Blog & Single Post', 'backend', 'calluna-td' ),
            'priority'    => 168
        ) );
		$this->wp_customize->add_section( 'calluna_section_social_media', array(
			'title'       => esc_html_x( 'Social Media', 'backend', 'calluna-td' ),
			'priority'    => 170
		) );
		$this->wp_customize->add_section( 'calluna_custom_code', array(
			'title'       => esc_html_x( 'Custom Code', 'backend', 'calluna-td' ),
			'priority'    => 175
		) );

	}
	
	

	/**
	 * Cache the rendered CSS after the settings are saved in the DB.
	 * This is purely a performance improvement.
	 *
	 * Used by hook: add_action( 'customize_save_after' , array( $this, 'cache_rendered_css' ) );
	 *
	 * @return void
	 */
	public function cache_rendered_css() {
		set_theme_mod( 'cached_css', $this->render_css() );
	}

	/**
	 * Get the dimensions of the logo image when the setting is saved
	 * This is purely a performance improvement.
	 *
	 * Used by hook: add_action( 'customize_save_logo_img' , array( $this, 'save_logo_dimensions' ), 10, 1 );
	 *
	 * @return void
	 */
	public function save_logo_dimensions( $setting ) {
		$logo_width_height = '';
		$img_data          = getimagesize( esc_url( $setting->post_value() ) );

		if ( is_array( $img_data ) ) {
			$logo_width_height = $img_data[3];
		}

		set_theme_mod( 'logo_width_height', $logo_width_height );
	}

	/**
	 * Render the CSS from all the settings which are of type `Calluna_Customize_Setting_Dynamic_CSS`
	 *
	 * @return string text/css
	 */
	public function render_css() {
		$out = '';

		foreach ( $this->get_dynamic_css_settings() as $setting ) {
			$out .= $setting->render_css();
		}

		return $out;
	}

	/**
	 * Get only the CSS settings of type `Calluna_Customize_Setting_Dynamic_CSS`.
	 *
	 * @see is_dynamic_css_setting
	 * @return array
	 */
	public function get_dynamic_css_settings() {
		return array_filter( $this->wp_customize->settings(), array( $this, 'is_dynamic_css_setting' ) );
	}

	/**
	 * Helper conditional function for filtering the settings.
	 *
	 * @see
	 * @param  mixed  $setting
	 * @return boolean
	 */
	protected static function is_dynamic_css_setting( $setting ) {
		return is_a( $setting, 'Calluna_Customize_CSS' );
	}

	/**
	 * Dynamically generate the JS for previewing the settings of type `Calluna_Customize_CSS`.
	 */
	public function customize_footer_js() {
		$settings = $this->get_dynamic_css_settings();

		ob_start();
		?>

			<script type="text/javascript">
				( function( $ ) {

				<?php
					foreach ( $settings as $key_id => $setting ) :
				?>

					wp.customize( '<?php echo esc_js($key_id); ?>', function( value ) {
						value.bind( function( newval ) {

						<?php
							foreach ( $setting->get_css_map() as $css_prop_raw => $css_selectors ) {
								extract( $setting->filter_css_property( $css_prop_raw ) );

								// background image needs a little bit different treatment
								if ( 'background-image' === $css_prop ) {
									echo 'newval = "url(" + newval + ")";' . PHP_EOL;
								}

								printf( '$( "%1$s" ).css( "%2$s", newval );%3$s', $setting->plain_selectors_for_all_groups( $css_prop_raw ), $css_prop, PHP_EOL );
							}
						?>

						} );
					} );

				<?php
					endforeach;
				?>

				} )( jQuery );
			</script>

		<?php

		echo ob_get_clean();
	}

}