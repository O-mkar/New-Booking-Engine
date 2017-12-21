<?php
/**
 * Adds typography options to the Customizer and outputs the custom CSS for them
 * 
 */

if ( ! class_exists( 'Calluna_Theme_Customizer_Typography' ) ) {
	class Calluna_Theme_Customizer_Typography {

		/*-----------------------------------------------------------------------------------*/
		/*	- Constructor
		/*-----------------------------------------------------------------------------------*/
		public function __construct() {
			// Loads customizer js file for postmessage transport method
			add_action( 'customize_preview_init', array( $this, 'preview_init' ) );
			add_action( 'customize_register', array( $this , 'register' ) );
			add_action( 'customize_save_after', array( $this, 'reset_cache' ) );
			add_action( 'wp_head', array( $this, 'load_fonts' ) );
			add_action( 'wp_head', array( $this, 'output_css' ) );
		}
		
		public function calluna_typo_sanitize_choices( $input, $setting ) {
			global $wp_customize;
		 
			$control = $wp_customize->get_control( $setting->id );
		 
			if ( array_key_exists( $input, $control->choices ) ) {
				return $input;
			} else {
				return $setting->default;
			}
		}

		/*-----------------------------------------------------------------------------------*/
		/*	- Array of elements for typography options
		/*-----------------------------------------------------------------------------------*/
		public function elements() {
			$array = array(
				'body'	=> array(
					'label'		=>	esc_html__( 'Body', 'calluna-td' ),
					'target'	=>	'body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul, .apb-datepicker .ui-datepicker-header .ui-datepicker-title, .apb-datepicker .ui-datepicker-calendar thead th, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info, .woocommerce .woocommerce-message',
				),
				'paragraph'	=> array(
					'label'		=>	esc_html__( 'Paragraph <p>', 'calluna-td' ),
					'target'	=>	'.wpb_wrapper p.teaser, p.teaser, .text-column p, p, .apb-list-price h6, .apb-package_item .apb-package_text .apb-package_book-price .apb-package_price, .apb-package_item .apb-package_text p, .apb-room_text .readmore-price, .apb-room_item .apb-room_text .apb-room_desc, .apb-room_item .apb-room_text .apb-room_desc ul li',
				),
				'headings_title'	=> array(
					'label'		=> esc_html__( 'Page Title', 'calluna-td' ),
					'target'	=> 'h1'
				),
				'headings2'	=> array(
					'label'		=> esc_html__( 'Heading H2', 'calluna-td' ),
					'target'	=> 'h2'
				),
				'headings3'	=> array(
					'label'		=> esc_html__( 'Heading H3', 'calluna-td' ),
					'target'	=> 'h3'
				),
				'headings4'	=> array(
					'label'		=> esc_html__( 'Heading H4', 'calluna-td' ),
					'target'	=> 'h4'
				),
				'headings5'	=> array(
					'label'		=> esc_html__( 'Heading H5', 'calluna-td' ),
					'target'	=> 'h5'
				),
				'nav_menu'	=> array(
					'label'		=> esc_html__( 'Main Menu', 'calluna-td' ),
					'target'	=> '.nav-menu li a',
				),
				'menu_dropdown'	=> array(
					'label'		=> esc_html__( 'Main Menu: Dropdowns', 'calluna-td' ),
					'target'	=> '.nav-menu ul ul li a',
				),
				'mobile_menu'	=> array(
					'label'		=> esc_html__( 'Mobile Menu', 'calluna-td' ),
					'target'	=> '.mobile-nav .mobile-menu ul li a',
				),
				'sidebar_widget_title'	=> array(
					'label'		=> esc_html__( 'Sidebar Widget Heading', 'calluna-td' ),
					'target'	=> '.sidebar .widget h2',
				),
				'footer_widget_title'	=> array(
					'label'		=> esc_html__( 'Footer Widget Heading', 'calluna-td' ),
					'target'	=> '.site-footer .widget h3',
				),
				'footer_paragraph'	=> array(
					'label'		=>	esc_html__( 'Footer Paragraph <p>', 'calluna-td' ),
					'target'	=>	'.site-footer p',
				),
				'footer_list'	=> array(
					'label'		=>	esc_html__( 'Footer Lists <ul>', 'calluna-td' ),
					'target'	=>	'.site-footer ul, .site-footer .menu li a'
				),
				'blog_post_title'	=> array(
					'label'			=> esc_html__( 'Blog Post Title', 'calluna-td' ),
					'target'		=> '.post header h3',
				),
				'entry_h3'		=> array(
					'label'		=> esc_html__( 'Post H3', 'calluna-td' ),
					'target'	=> '.post .author h3, .comments-title, .comment-reply-title'
				),
				'copyright'	=> array(
					'label'		=> esc_html__( 'Copyright', 'calluna-td' ),
					'target'	=> '.site-info'
				),
				'button'	=> array(
					'label'		=> esc_html__( 'Primary Button', 'calluna-td' ),
					'target'	=> '.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price'
				),
				'weather_time'	=> array(
					'label'		=> esc_html__( 'Weather &amp; Time', 'calluna-td' ),
					'target'	=> '.simple-weather em, .calluna-time .time'
				),
				'calendar'	=> array(
					'label'		=> esc_html__( 'Booking Calendar', 'calluna-td' ),
					'target'	=> '#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li'
				),
				'dates'	=> array(
					'label'		=> esc_html__( 'Post &amp; Event Dates', 'calluna-td' ),
					'target'	=> '.event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month, .apb-calendar_custom .fc-toolbar h2, .apb-month .fc-toolbar h2, .fc-day-grid-container, .apb-datepicker .ui-datepicker-calendar td a, .apb-datepicker .ui-datepicker-calendar td span, #apb_calendar .ui-widget-header'
				),
				'prices'	=> array(
					'label'		=> esc_html__( 'Room &amp; Offer Prices', 'calluna-td' ),
					'target'	=> '.offer_price, .amout, .room-detail .room-detail_book .room-detail_total .price .amout, .woocommerce-checkout .apb-room-selected_content .apb-room-seleted_item .apb-room-seleted_name .apb-amout, .apb-room-selected .apb-room-selected_content .apb-room-seleted_item .apb-room-seleted_name .apb-amout, .woocommerce-checkout .apb-room-selected_content .apb-room-seleted_item .apb-room-seleted_package ul li .apb-amout, .apb-room-selected .apb-room-selected_content .apb-room-seleted_item .apb-room-seleted_package ul li .apb-amout, .woocommerce-checkout .apb-room-selected_content .apb-room-seleted_item .apb-room-seleted_total-room .apb-amout, .apb-room-selected .apb-room-selected_content .apb-room-seleted_item .apb-room-seleted_total-room .apb-amout, .apb-room_item .apb-room_text .apb-room_price .apb-room_amout, .apb-package_item .apb-package_text .apb-package_book-price .apb-package_price .amout, .apb-room-select-item .apb-room-select-price .price, .apb-sale, .apb-room-select-item .apb-room-select-package ul li span, .woocommerce .product-total .amount, .woocommerce .cart-subtotal .amount, .woocommerce .order-total .amount, .modal-price, .apb-list-price .apb-col-6 > span'
				),
				'load_custom_font_1'	=> array(
					'label'				=> esc_html__( 'Load Custom Font', 'calluna-td' ),
					'settings'			=> array( 'font-family' ),
				),
			);
			return $array;
		}

		/*-----------------------------------------------------------------------------------*/
		/*	- Register Typography Panel and Sections
		/*-----------------------------------------------------------------------------------*/
		public function register ( $wp_customize ) {
		    require_once( get_template_directory() . '/framework/customizer/controls.php' );

			// Add General Panel
			$wp_customize->add_panel( 'calluna_typography', array(
				'priority'		=> 124,
				'capability'	=> 'edit_theme_options',
				'title'			=> esc_html__( 'Typography', 'calluna-td' ),
			) );

			// Get elements
			$elements = $this->elements();

			// Lopp through elements
			$count = '0';
			foreach( $elements as $element => $array ) {
				$count++;

				// Set vars
				$label = isset ( $array['label'] ) ? $array['label'] : '';
				if ( ! isset ( $array['settings'] ) ) {
					$settings = array(
						'font-family',
						'font-weight',
						'font-style',
						'text-transform',
						'font-size',
						'line-height',
						'letter-spacing',
					);
				} else {
					$settings = $array['settings'];
				}

				if ( $label ) {

					// Define Section
					$wp_customize->add_section( 'calluna_typography_'. $element , array(
						'title'		=> $label,
						'priority'	=> $count,
						'panel'		=> 'calluna_typography',
					) );

					// Font Family
					if ( in_array( 'font-family', $settings ) ) {
						$wp_customize->add_setting( $element .'_typography[font-family]', array(
							'type'		=> 'theme_mod',
							'transport'	=> 'refresh',
							'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control(
							new Calluna_Fonts_Dropdown_Custom_Control(
								$wp_customize,
								$element .'_typography[font-family]',
								array(
									'label'			=> esc_html__( 'Font Family', 'calluna-td' ),
									'section'		=> 'calluna_typography_'. $element,
									'settings'		=> $element .'_typography[font-family]',
									'priority'		=> 1,
									'description'	=> esc_html__( 'To prevent bugs with the customizer make sure to change the family first.', 'calluna-td' ),
								)
							)
						);
					}

					// Font Weight
					if ( in_array( 'font-weight', $settings ) ) {
						$wp_customize->add_setting( $element .'_typography[font-weight]', array(
							'type'			=> 'theme_mod',
							'transport'		=> 'postMessage',
							'sanitize_callback' => 'sanitize_text_field',
							'description'	=> esc_html__( 'Note: Not all Fonts support every font weight style.', 'calluna-td' ),
						) );
						$wp_customize->add_control( $element .'_typography[font-weight]', array(
							'label'			=> esc_html__( 'Font Weight', 'calluna-td' ),
							'section'		=> 'calluna_typography_'. $element,
							'settings'		=> $element .'_typography[font-weight]',
							'priority'		=> 2,
							'type'			=> 'select',
							'choices'	=> array (
								''		=> esc_html__( 'Default', 'calluna-td' ),
								'300'	=> esc_html__( 'Book: 300', 'calluna-td' ),
								'400'	=> esc_html__( 'Normal: 400', 'calluna-td' ),
								'500'	=> esc_html__( 'Medium: 500', 'calluna-td' ),
								'600'	=> esc_html__( 'Semibold: 600', 'calluna-td' ),
								'700'	=> esc_html__( 'Bold: 700', 'calluna-td' ),
								'800'	=> esc_html__( 'Extra Bold: 800', 'calluna-td' ),
							),
							'description'	=> esc_html__( 'Important: Not all fonts support every font-weight.', 'calluna-td' ),
						) );
					}

					// Font Style
					if ( in_array( 'font-style', $settings ) ) {
						$wp_customize->add_setting( $element .'_typography[font-style]', array(
							'type'		=> 'theme_mod',
							'transport'	=> 'postMessage',
							'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( $element .'_typography[font-style]', array(
							'label'		=> esc_html__( 'Font Style', 'calluna-td' ),
							'section'	=> 'calluna_typography_'. $element,
							'settings'	=> $element .'_typography[font-style]',
							'priority'	=> 3,
							'type'		=> 'select',
							'choices'	=> array (
								''			=> esc_html__( 'Default', 'calluna-td' ),
								'normal'	=> esc_html__( 'Normal', 'calluna-td' ),
								'italic'	=> esc_html__( 'Italic', 'calluna-td' ),
							),
						) );
					}

					// Text-Transform
					if ( in_array( 'text-transform', $settings ) ) {
						$wp_customize->add_setting( $element .'_typography[text-transform]', array(
							'type'		=> 'theme_mod',
							'transport'	=> 'postMessage',
							'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( $element .'_typography[text-transform]', array(
							'label'		=> esc_html__( 'Text Transform', 'calluna-td' ),
							'section'	=> 'calluna_typography_'. $element,
							'settings'	=> $element .'_typography[text-transform]',
							'priority'	=> 4,
							'type'		=> 'select',
							'choices'	=> array (
								''				=> esc_html__( 'Default', 'calluna-td' ),
								'capitalize'	=> esc_html__( 'Capitalize', 'calluna-td' ),
								'lowercase'		=> esc_html__( 'Lowercase', 'calluna-td' ),
								'uppercase'		=> esc_html__( 'Uppercase', 'calluna-td' ),
							),
						) );
					}

					// Font Size
					if ( in_array( 'font-size', $settings ) ) {
						$wp_customize->add_setting( $element .'_typography[font-size]', array(
							'type'		=> 'theme_mod',
							'transport'	=> 'postMessage',
							'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( $element .'_typography[font-size]', array(
							'label'			=> esc_html__( 'Font Size', 'calluna-td' ),
							'section'		=> 'calluna_typography_'. $element,
							'settings'		=> $element .'_typography[font-size]',
							'priority'		=> 5,
							'type'			=> 'text',
							'description'	=> esc_html__( 'Value in pixels.', 'calluna-td' ),
						) );
					}

					// Font Color
					$wp_customize->add_setting( $element .'_typography[color]', array(
						'type'		=> 'theme_mod',
						'default'	=> '',
						'sanitize_callback' => 'sanitize_hex_color',
					) );
					$wp_customize->add_control(
						new WP_Customize_Color_Control(
							$wp_customize,
							$element .'_typography_color',
							array(
								'label'		=> esc_html__( 'Font Color', 'calluna-td' ),
								'section'	=> 'calluna_typography_'. $element,
								'settings'	=> $element .'_typography[color]',
								'priority'	=> 6,
							)
						)
					);

					// Line Height
					
					if ( in_array( 'line-height', $settings ) ) {
						$wp_customize->add_setting( $element .'_typography[line-height]', array(
							'type'		=> 'theme_mod',
							'transport'	=> 'postMessage',
							'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control( $element .'_typography[line-height]',
							array(
								'label'		=> esc_html__( 'Line Height', 'calluna-td' ),
								'section'	=> 'calluna_typography_'. $element,
								'settings'	=> $element .'_typography[line-height]',
								'priority'	=> 7,
								'type'		=> 'text',
						) );
					}
					

					// Letter Spacing
					
					if ( in_array( 'letter-spacing', $settings ) ) {
						$wp_customize->add_setting( $element .'_typography[letter-spacing]', array(
							'type'		=> 'theme_mod',
							'transport'	=> 'postMessage',
							'sanitize_callback' => 'sanitize_text_field',
						) );
						$wp_customize->add_control(
							new Calluna_Customize_Sliderui_Control(
								$wp_customize,
								$element .'_typography_letter_spacing',
								array(
									'label'		=> esc_html__( 'Letter Spacing', 'calluna-td' ),
									'section'	=> 'calluna_typography_'. $element,
									'settings'	=> $element .'_typography[letter-spacing]',
									'priority'	=> 8,
									'type'		=> 'calluna_slider_ui',
									'choices'	=> array(
										'min'	=> 0,
										'max'	=> 20,
										'step'	=> 1,
									),
								)
							)
						);
					}

				}
			}
		}

		/*-----------------------------------------------------------------------------------*/
		/*	- Reset Cache after customizer save
		/*-----------------------------------------------------------------------------------*/
		public function reset_cache() {
			remove_theme_mod( 'calluna_customizer_typography_cache' );
		}

		/*-----------------------------------------------------------------------------------*/
		/*	- Output Custom CSS
		/*-----------------------------------------------------------------------------------*/
		public function loop( $return = 'css' ) {
			// Get typography data cache
			$data = get_theme_mod( 'calluna_customizer_typography_cache', false );
			// If theme mod cache empty or is live customizer loop through elements and set output
			if ( empty( $data ) || is_customize_preview() ) {
				// Define Vars
				$css			= '';
				$load_scripts	= '';
				$fonts			= array();
				$scripts		= array();
				$scripts_output = '';
				$elements		= $this->elements();
				// Loop through each elements that need typography styling applied to them
				foreach( $elements as $element => $array ) {
					// Attributes to loop through
					if ( ! empty( $array['settings'] ) ) {
						$attributes = $array['settings'];
					} else {
						$attributes = array( 'font-family', 'font-weight', 'font-style', 'font-size', 'color', 'line-height', 'letter-spacing', 'text-transform' );
					}
					$add_css	= '';
					$target		= isset( $array['target'] ) ? $array['target'] : '';
					$get_mod	= get_theme_mod( $element .'_typography' );
					foreach ( $attributes as $attribute ) {
						$val = isset ( $get_mod[$attribute] ) ? $get_mod[$attribute] : '';
						if ( $val ) {
							// Convert font-size to px
							if ( 'font-size' == $attribute || 'letter-spacing' == $attribute ) {
								$val = intval( $get_mod[$attribute] ) .'px';
							}
							// Add quotes around font-family && font family to scripts array
							if ( 'font-family' == $attribute ) {
								$fonts[]	= $val;
								$val		= $val;
							}
							// Add custom CSS
							$add_css .= $attribute .':'. $val .';';
						}
					}
					if ( $add_css ) {
						$css .= $target .'{'. $add_css .'}';
					} 
				}
				if ( $css || $fonts ) {
					// Only load 1 of each font
					if ( ! empty( $fonts ) ) {
						array_unique( $fonts );
					}
					// Get Google Scripts to load on the front end
					if ( ! empty ( $fonts ) ) {
						$google_fonts	= calluna_google_fonts_array();
						// Loop through fonts and create Google Font Link
						foreach ( $fonts as $font ) {
							if ( in_array( $font, $google_fonts ) ) {
								$scripts[] = 'https://fonts.googleapis.com/css?family='.str_replace(' ', '%20', $font ) .'';
							}
						}
						// If scripts need to be loaded create the link tags
						if ( ! empty( $scripts ) ) {
							$scripts_output = '<!-- Load Google Fonts -->';
							foreach ( $scripts as $script ) {
								$scripts_output .= '<link href="'. $script .':300italic,400italic,500italic,600italic,700italic,800italic,400,300,500,600,700,800&amp;subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic" rel="stylesheet" type="text/css">';
							}
						}
					}
				}
			}
			// Set cache or get cache if not in customizer
			if ( ! is_customize_preview() ) {
				// Get Cache vars
				if ( $data ) {
					$css			= isset( $data['css'] ) ? $data['css'] : '';
					$fonts			= isset( $data['fonts'] ) ? $data['fonts'] : '';
					$scripts		= isset( $data['scripts'] ) ? $data['scripts'] : '';
					$scripts_output	= isset( $data['scripts_output'] ) ? $data['scripts_output'] : '';
				}
				// Set Cache
				else {
					set_theme_mod( 'calluna_customizer_typography_cache', array (
						'css'				=> $css,
						'fonts'				=> $fonts,
						'scripts'			=> $scripts,
						'scripts_output'	=> $scripts_output,
					) );
				}
			}
			// Return CSS
			if ( 'css' == $return && $css ) {
				$css = '<!-- Typography CSS --><style type="text/css">'. $css .'</style>';
				return $css;
			}
			// Return Fonts Array
			if ( 'fonts' == $return && ! empty( $fonts ) ) {
				return $fonts;
			}
			// Return Scripts Array
			if ( 'scripts' == $return && ! empty( $scripts ) ) {
				return $scripts;
			}
			// Return Scripts Output
			if ( 'scripts_output' == $return && $scripts_output ) {
				return $scripts_output;
			}
		}

		/*-----------------------------------------------------------------------------------*/
		/*	- Output Custom CSS
		/*-----------------------------------------------------------------------------------*/
		public function output_css() {
			echo $this->loop( 'css' );
		}

		/*-----------------------------------------------------------------------------------*/
		/*	- Load Google Fonts
		/*-----------------------------------------------------------------------------------*/
		public function load_fonts() {
			echo $this->loop( 'scripts_output' );
		}
		
		/**
		 * Loads customizer js file for postmessage transport method
		 *
		 * @link http://codex.wordpress.org/Theme_Customization_API
		 */
		public function preview_init() {
			wp_enqueue_script(
				'calluna-customizer-postmessage',
				CALLUNA_THEME_URI . 'framework/customizer/assets/customizer-postmessage.js',
				array( 'jquery','customize-preview' ),
				false,
				true
			);
		}

	}
}
new Calluna_Theme_Customizer_Typography();