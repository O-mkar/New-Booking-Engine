<?php
add_filter( 'rwmb_meta_boxes', function( $meta_boxes )
{
	
	/* ----------------------------------------------------- */
	// Page Settings
	/* ----------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id'			=> '_calluna_header_pagesettings',
		'title' 		=> esc_html__('Page Settings','calluna-td'),
		'post_types'	=> array( 'page', 'post', 'offer', 'event', 'room', 'apb_room_type' ),
		'context'		=> 'normal',
		'priority'		=> 'high',

		'tabs'      	=> array(
            'header'	=> array(
                'label' => esc_html__( 'Header', 'calluna-td' ),
            ),
            'footer'	=> array(
                'label' => esc_html__( 'Footer', 'calluna-td' ),
            ),
        	'content'	=> array(
                'label' => esc_html__( 'Content', 'calluna-td' ),
            )
        ),

        // Tab style: 'default', 'box' or 'left'. Optional
        'tab_style' => 'default',
		
		// List of meta fields
		'fields' => array(
		    array(
    			'name'		=> esc_html__( 'Header Options', 'calluna-td' ),
    			'id'		=> "_calluna_header_select",
    			'type'		=> 'select',
    			'options'	=> array(
    				'color'     => esc_html__( 'Color', 'calluna-td' ),
                    'image'     => esc_html__( 'Image', 'calluna-td' ),
                    'slider'	=> esc_html__( 'Slider', 'calluna-td' ),
                    'none'	    => esc_html__( 'No Header', 'calluna-td' ),
    			),
    			'multiple'	=> false,
    			'std'		=> array( 'color' ),
    			'desc'		=> esc_html__( 'Set the background for the header to slider, image or color.', 'calluna-td' ),
    			'tab'		=> 'header'
			),
			array(
				'name'		=> esc_html__( 'Slider Shortcode', 'calluna-td' ),
				'id'		=> "_calluna_header_slider",
				'type'		=> 'text',
				'desc'		=> esc_html__('[masterslider id="sliderId"]', 'calluna-td'),
				'tab'		=> 'header',
				'visible'	=> array( '_calluna_header_select', 'slider' ),
			),
			array(
					'name'		=> esc_html__( 'Header Background Image', 'calluna-td' ),
					'id'		=> "_calluna_header_image",
					'type'		=> 'image_advanced',
					'desc'		=> esc_html__( 'Upload header background image.', 'calluna-td' ),
					'tab'		=> 'header',
					'visible'	=> array( '_calluna_header_select', 'image' ),
			),
			array(
					'name'		=> esc_html__( 'Header Background Color', 'calluna-td' ),
					'id'		=> "_calluna_header_color",
					'type'		=> 'color',
					'desc'		=> esc_html__( 'Overwrite default color', 'calluna-td' ),
					'std'		=> '',
					'tab'		=> 'header',
					'visible'	=> array( '_calluna_header_select', 'color' )
			),
			array(
					'id'		=> "_calluna_header_divider1",
					'type'		=> 'divider',
					'tab'		=> 'header',
					'hidden'	=> array(
						array( '_calluna_header_select', 'none')
					)
			),
			array(
					'name'		=> esc_html__( 'Header Text', 'calluna-td' ),
					'id'		=> "_calluna_header_text",
					'type'		=> 'text',
					'desc'		=> esc_html__( 'Overwrite the page title', 'calluna-td' ),
					'tab'		=> 'header',
					'hidden'	=> array(
						array( '_calluna_header_select', 'in', array('slider', 'none'))
					)
			),
			array(
					'id'		=> "_calluna_header_divider1",
					'type'		=> 'divider',
					'tab'		=> 'header',
					'hidden'	=> array(
						array( '_calluna_header_select', 'in', array('slider', 'none'))
					)
			),
			array(
					'name'		=> esc_html__( 'Navigation Style', 'calluna-td' ),
					'id'		=> "_calluna_header_nav_radio",
					'type'		=> 'select',
					'options'	=> array(
						''		        => esc_html__( 'Default (set in Customizer)', 'calluna-td' ),
						'left-nav'      => esc_html__( 'Top transparent navigation', 'calluna-td' ),
			            'top-nav'       => esc_html__( 'Top navigation', 'calluna-td' ),
			            'top-full-nav'  => esc_html__( 'Top full width navigation', 'calluna-td' ),
					),
					'multiple'	=> false,
					'std'		=> array( '' ),
					'desc'		=> esc_html__( 'Choose your Navigation Style for this Page', 'calluna-td' ),
					'tab'		=> 'header',
					'hidden'	=> array(
						array( '_calluna_header_select', 'none')
					)
			),
			array(
					'id'		=> "_calluna_header_divider2",
					'type'		=> 'divider',
					'tab'		=> 'header',
					'hidden'	=> array(
						array( '_calluna_header_select', 'none')
					)
			),
			array(
				'name'		=> esc_html__( 'Individual Page Menu', 'calluna-td' ),
				'id'		=> "_calluna_header_custom_menu",
				'desc'		=> esc_html__( 'Set a different navigation menu only for this page.', 'calluna-td' ),
				'type'    	=> 'taxonomy_advanced',
				'tab'		=> 'header',
				'taxonomy' 	=> 'nav_menu',
				'field_type'=> 'select',
				'hidden'	=> array(
						array( '_calluna_header_select', 'none')
					)
			),
			array(
					'name'		=> esc_html__( 'Footer Widgets', 'calluna-td' ),
					'id'		=> "calluna_post_footer_widgets",
					'type'		=> 'select',
					'options'	=> array(
						'show'		=> esc_html__('Enable', 'calluna-td'),
						'hide'		=> esc_html__('Disable', 'calluna-td')
					),
					'multiple'	=> false,
					'std'		=> array( 'show' ),
					'desc'		=> esc_html__( 'Enable or disable the Footer Widgets on this Page.', 'calluna-td' ),
					'tab'		=> 'footer',
			),
			array(
					'name'		=> esc_html__( 'Footer Copyright', 'calluna-td' ),
					'id'		=> "calluna_post_footer_copyright",
					'type'		=> 'select',
					'options'	=> array(
						'show'		=> esc_html__('Enable', 'calluna-td'),
						'hide'		=> esc_html__('Disable', 'calluna-td')
					),
					'multiple'	=> false,
					'std'		=> array( 'show' ),
					'desc'		=> esc_html__( 'Enable or disable the Footer Copyright Section on this Page.', 'calluna-td' ),
					'tab'		=> 'footer',
			),
			array(
					'name'		=> esc_html__( 'Content Top Padding', 'calluna-td' ),
					'id'		=>  "_calluna_page_top_padding_select",
					'type'		=> 'select',
					'options'	=> array(
						'top-35' => '35px',
            			'top-25' => '25px',
            			'top-15' => '15px',
            			'top-5' => '5px',
            			'top-0' => '0'
					),
					'multiple'	=> false,
					'std'		=> array( 'top-35' ),
					'desc'		=> esc_html__( 'Set the top padding for the content.', 'calluna-td' ),
					'tab'		=> 'content',
			),
			array(
					'name'		=> esc_html__( 'Content Bottom Padding', 'calluna-td' ),
					'id'		=> "_calluna_page_bottom_padding_select",
					'type'		=> 'select',
					'options'	=> array(
						'bottom-35' => '35px',
            			'bottom-25' => '25px',
            			'bottom-15' => '15px',
            			'bottom-5' => '5px',
            			'bottom-0' => '0'
            		),
					'multiple'	=> false,
					'std'		=> array( 'bottom-35' ),
					'desc'		=> esc_html__( 'Set the bottom padding for the content.', 'calluna-td' ),
					'tab'		=> 'content',
			),
		)
	);
	
	// Gallery Metabox
	$meta_boxes[] = array(
		'id' => '_calluna_gallery_metabox',
		'title' => esc_html__( 'Gallery Settings', 'outsign' ),
		'pages' => array( 'post', 'event', 'offer', 'apb_room_type' ),
		'context' => 'normal',
		'priority' => 'high',
		// List of meta fields
		'fields' => array(
			array(
    				'name'	=> esc_html__( 'Gallery', 'outsign' ),
    				'desc'	=> esc_html__( 'You can upload up to 50 gallery images.', 'outsign' ),
    				'id'	=> '_calluna_gallery_select',
    				'type'	=> 'image_advanced',
    				'max_file_uploads' => 50,
			),
			array(
					'name'		=> esc_html__( 'Gallery Description', 'calluna-td' ),
					'id'		=> "_calluna_gallery_description",
					'type'		=> 'textarea',
					'desc'		=> esc_html__( 'Only for room, event and offer.', 'calluna-td' ),
					'tab'		=> 'header'
			),
		)
	);
	
	// Gallery Metabox for rooms
	$meta_boxes[] = array(
		'id' => '_calluna_gallery_metabox_rooms',
		'title' => esc_html__( 'Gallery Settings', 'outsign' ),
		'pages' => array( 'room' ),
		'context' => 'normal',
		'priority' => 'high',
		// List of meta fields
		'fields' => array(
			array(
					'name'		=> esc_html__( 'Gallery Description', 'calluna-td' ),
					'id'		=> "_calluna_gallery_description",
					'type'		=> 'textarea',
					'desc'		=> esc_html__( 'Only for hotelier rooms', 'calluna-td' ),
					'tab'		=> 'header'
			),
		)
	);
	
	// Video Post Format
	$meta_boxes[] = array(
		'id' => '_calluna_video_metabox',
		'title' => esc_html__( 'Video Settings', 'outsign' ),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'visible'	=> array( 'post_format', 'video' ),
		// List of meta fields
		'fields' => array(
			array(
				'name'		=> esc_html__( 'Video URL', 'gymx' ),
				'id'		=> '_calluna_video_embed',
				'desc'		=> sprintf( wp_kses(__( 'You can just insert the URL of the %s. If you fill out this field, it will be shown instead of the Slider. Notice: The Preview Image will be the Image set as Featured Image.', 'gymx' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">Supported Video Site</a>' ),
				'type'		=> 'textarea',
				'std'		=> ''
			),
		)
	);
	
	return $meta_boxes;
} );

//Show content tab only for pages
add_filter( 'rwmb_outside_conditions', function( $conditions )
{
    $conditions['.rwmb-tab-content'] = array(
        'visible' => array('post_type', 'in', array('page'))
    );
    return $conditions;
} );