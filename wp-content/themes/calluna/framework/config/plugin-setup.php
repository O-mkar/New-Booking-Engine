<?php
	/**
	 * Include the TGM_Plugin_Activation class.
	 */
	add_action('tgmpa_register', 'calluna_register_plugins');
	/**
	 * Register the required plugins for this theme.
	 * The variable passed to tgmpa_register_plugins() should be an array of plugin
	 * arrays.
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 */
	function calluna_register_plugins() {
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		// Visual Composer
		$plugins = array(
			array(
	            'name' 		            => 'Calluna Core',
	            'slug' 		            => 'calluna-core',
	            'source'                => 'http://helpdesk.themetwins.com/download/calluna-core-latest/', // The plugin source.
	            'required'              => true, // If false, the plugin is only 'recommended' instead of required.
	            'version'               => '1.0.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
	            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
	            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
	            'external_url'          => 'http://helpdesk.themetwins.com/download/calluna-core-latest/', // If set, overrides default API URL and points to an external URL.
	        ),
            array(
                'name' 		            => 'Easy WP Hotelier',
                'slug' 		            => 'wp-hotelier',
                'source'                => 'http://helpdesk.themetwins.com/download/wp-hotelier-latest/', // The plugin source.
                'required'              => true, // If false, the plugin is only 'recommended' instead of required.
                'version'               => '1.1.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url'          => 'http://helpdesk.themetwins.com/download/wp-hotelier-latest/', // If set, overrides default API URL and points to an external URL.
            ),
			array(
				'name'               => esc_attr__('WPBakery Visual Composer', 'leadx'), // The plugin name
				'slug'               => 'js_composer', // The plugin slug (typically the folder name)
				'source'             => 'http://helpdesk.themetwins.com/download/visual-composer-latest/', // The plugin source
				'required'           => TRUE, // If false, the plugin is only 'recommended' instead of required
				'version'            => '5.4.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => FALSE, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => TRUE, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => 'http://helpdesk.themetwins.com/download/visual-composer-latest/', // If set, overrides default API URL and points to an external URL
			),
			// Master Slider
			array(
				'name'               => 'masterslider', // The plugin name
				'slug'               => 'masterslider', // The plugin slug (typically the folder name)
				'source'             => 'http://helpdesk.themetwins.com/download/masterslider-latest/', // The plugin source
				'required'           => true, // If false, the plugin is only 'recommended' instead of required
				'version'            => '3.2.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => FALSE, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => TRUE, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => 'http://helpdesk.themetwins.com/download/masterslider-latest/', // If set, overrides default API URL and points to an external URL
			),
			array(
	            'name' 		            => 'Contact Form 7',
	            'slug' 		            => 'contact-form-7'
	        ),
			array(
	            'name' 		            => 'Bootstrap Contact Form 7',
	            'slug' 		            => 'bootstrap-for-contact-form-7'
	        ),
			array(
	            'name' 		            => 'Simple Weather',
	            'slug' 		            => 'simple-weather',
	            'source'                => get_template_directory() . '/framework/plugins/simple-weather.zip', // The plugin source.
	            'required'              => false, // If false, the plugin is only 'recommended' instead of required.
	            'version'               => '2.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
	            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
	            'force_deactivation'    => TRUE, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
	            'external_url'          => '', // If set, overrides default API URL and points to an external URL.
	        )
		);

		$config = array(
			'domain'       		=> 'calluna-td',
			'default_path' 		=> '',			
			'menu'         		=> 'install-required-plugins', 
			'has_notices'      	=> TRUE,                       
			'is_automatic'    	=> FALSE,					   
			'message' 			=> ''
		);
		
		tgmpa($plugins, $config);
	}
