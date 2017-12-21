(function() {
	tinymce.PluginManager.add( 'calluna_core_shortcodes_mce_button', function( editor, url ) {
		editor.addButton( 'calluna_core_shortcodes_mce_button', {
			text: 'Calluna Shortcodes',
			type: 'menubutton',
			icon: false,
			menu: [
					
				/** Elements **/
				{
					text: 'Elements',
					menu: [
						/* Booking calendar */
						{
							text: 'Booking Calendar',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Booking Calendar',
									body: [

									],
									onsubmit: function( ) {
										editor.insertContent('[cl_booking_calendar]');
									}
								});
							}
						}, // End booking calendar
						
						/* Time */
						{
							text: 'Time',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Time',
									body: [
										// Time Icon
									{
										type: 'listbox',
										name: 'timeIcon',
										label: 'Time: Icon',
										values: [
											{text: 'Yes', value: 'yes'},
											{text: 'No', value: 'no'}
										]
									},
									// Time Icon Color
									{
										type: 'textbox',
										name: 'timeIconColor',
										label: 'Time: Icon Hex Color',
										value: ''
									},
									// Time Text Color
									{
										type: 'textbox',
										name: 'timeTextColor',
										label: 'Time: Text Hex Color',
										value: ''
									},
									// Time Format
									{
										type: 'textbox',
										name: 'timeFormat',
										label: 'Time: Format',
										value: ''
									},
									],
									onsubmit: function( e ) {
										editor.insertContent('[cl_time icon="' + e.data.timeIcon + '" icon_color="' + e.data.timeIconColor + '" text_color="' + e.data.timeTextColor + '" time_format="' + e.data.timeFormat + '"]');
									}
								});
							}
						}, // End time
						/* Weather */
						{
							text: 'Weather',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Weather',
									body: [
									// Weather Location
									{
										type: 'textbox',
										name: 'weatherLocation',
										label: 'Weather: Location',
										value: 'Hanover, GER'
									},
									// Weather Latitude
									{
										type: 'textbox',
										name: 'weatherLat',
										label: 'Weater: Latitude',
										value: ''
									},
									// Weather Longitude
									{
										type: 'textbox',
										name: 'weatherLong',
										label: 'Weater: Longitude',
										value: ''
									},
									// Weater Units
									{
										type: 'listbox',
										name: 'weatherUnits',
										label: 'Weather: Units',
										values: [
											{text: 'Internal', value: 'internal'},
											{text: 'Metric', value: 'metric'},
											{text: 'Imperial', value: 'imperial'}
										]
									},
									// Weather Date Format
									{
										type: 'textbox',
										name: 'weatherDate',
										label: 'Weater: Date',
										value: ''
									},
									],
									onsubmit: function( e ) {
										editor.insertContent('[simple-weather location="' + e.data.weatherLocation + '" latitude="' + e.data.weatherLat + '" longitude="' + e.data.weatherLong + '" units="' + e.data.weatherUnit + '" date="' + e.data.weatherDate + '"]');
									}
								});
							}
						}, // End time

						/* Buttons */
						{
							text: 'Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Button',
									body: [

									// Button Text
									{
										type: 'textbox',
										name: 'buttonText',
										label: 'Button: Text',
										value: 'Button'
									},

									// Button URL
									{
										type: 'textbox',
										name: 'buttonUrl',
										label: 'Button: URL',
										value: '#'
									},

									// Button Style
									{
										type: 'listbox',
										name: 'buttonStyle',
										label: 'Button: Style',
										values: [
											{text: 'Style 1', value: 'style-1'},
											{text: 'Style 2', value: 'style-2'}
										]
									},

									// Button Size
									{
										type: 'listbox',
										name: 'buttonSize',
										label: 'Button: Size',
										values: [
											{text: 'Default', value: ''},
											{text: 'Small', value: 'small'},
											{text: 'Medium', value: 'medium'},
											{text: 'Large', value: 'large'}
										]
									},

									// Button Link Target
									{
										type: 'listbox',
										name: 'buttonLinkTarget',
										label: 'Button: Link Target',
										values: [
											{text: 'Self', value: 'self'},
											{text: 'Blank', value: 'blank'}
										]
									},

									// Button Rel
									{
										type: 'listbox',
										name: 'buttonRel',
										label: 'Button: Rel',
										values: [
											{text: 'None', value: ''},
											{text: 'Nofollow', value: 'nofollow'}
										]
									},

									// Button Left Icon
									{
										type: 'textbox',
										name: 'buttonLeftIcon',
										label: 'Button: Left Icon (FontAwesome Class Name)',
										value: ''
									},

									// Button Right Icon
									{
										type: 'textbox',
										name: 'buttonRightIcon',
										label: 'Button: Right Icon (FontAwesome Class Name)',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent('[cl_button url="' + e.data.buttonUrl + '" style="' + e.data.buttonStyle + '" size="' + e.data.buttonSize + '" target="' + e.data.buttonLinkTarget + '" rel="' + e.data.buttonRel + '" icon_left="' + e.data.buttonLeftIcon + '" icon_right="' + e.data.buttonRightIcon + '" title="' + e.data.buttonText + '"]');
									}
								});
							}
						}, // End button

						
						/* Heading */
						{
							text: 'Heading',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Heading',
									body: [

									// Heading Title
									{
										type: 'textbox',
										name: 'headingTitle',
										label: 'Title',
										value: 'Sample heading'
									},

									// Heading Font Size
									{
										type: 'textbox',
										name: 'headingFontSize',
										label: 'Font Size',
										value: ''
									},

									// Heading Color
									{
										type: 'textbox',
										name: 'headingColor',
										label: 'Heading Hex Color',
										value: ''
									},

									// Heading Top Margin
									{
										type: 'textbox',
										name: 'headingMarginTop',
										label: 'Top Margin',
										value: '30'
									},

									// Heading Bottom Margin
									{
										type: 'textbox',
										name: 'headingMarginBottom',
										label: 'Bottom Margin',
										value: '30'
									},

									// Heading Type
									{
										type: 'listbox',
										name: 'headingType',
										label: 'Type',
										values: [
											{text: 'h1', value: 'h1'},
											{text: 'h2', value: 'h2'},
											{text: 'h3', value: 'h3'},
											{text: 'h4', value: 'h4'},
											{text: 'h5', value: 'h5'},
											{text: 'span', value: 'span'},
											{text: 'div', value: 'div'}
										]
									},

									// Heading Style
									{
										type: 'listbox',
										name: 'headingStyle',
										label: 'Style',
										values: [
											{text: 'None', value: ''},
											{text: 'Underline', value: 'single-line'}
										]
									},

									// Heading Text Align
									{
										type: 'listbox',
										name: 'headingTextAlign',
										label: 'Text Align',
										values: [
											{text: 'Left', value: 'left'},
											{text: 'Center', value: 'center'},
											{text: 'Right', value: 'right'}
										]
									},

									// Heading Left Icon
									{
										type: 'textbox',
										name: 'headingLeftIcon',
										label: 'Left Icon (FontAwesome Class Name)',
										value: ''
									},

									// Heading Right Icon
									{
										type: 'textbox',
										name: 'headingRightIcon',
										label: 'Right Icon (FontAwesome Class Name)',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent('[cl_heading style="' + e.data.headingStyle + '" title="' + e.data.headingTitle + '" type="' + e.data.headingType + '" font_size="' + e.data.headingFontSize + '" text_align="' + e.data.headingTextAlign + '" margin_top="' + e.data.headingMarginTop + '" margin_bottom="' + e.data.headingMarginBottom + '" color="' + e.data.buttonText + '" icon_left="' + e.data.headingLeftIcon + '" icon_right="' + e.data.headingRightIcon + '"]' );
									}
								});
							}
						}, // End heading

						/* Highlights */
						{
							text: 'Highlights',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Highlight',
									body: [

									// Highlight Color
									{
										type: 'listbox',
										name: 'highlightColor',
										label: 'Size',
										values: [
											{text: 'Blue', value: 'blue'},
											{text: 'Green', value: 'green'},
											{text: 'Yellow', value: 'yellow'},
											{text: 'Red', value: 'red'},
											{text: 'Gray', value: 'gray'}
										]
									},

									// Highlight Content
									{
										type: 'textbox', 
										name: 'highlightContent', 
										label: 'Highlighted Text',
										value: 'hey check me out'
									}],
									onsubmit: function( e ) {
										editor.insertContent('[cl_highlight color="' + e.data.highlightColor + '"]' + e.data.highlightContent + '[/cl_highlight]');
									}
								});
							}
						}, // End highlights
						/* Teaser */
						{
							text: 'Teaser',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Teaser',
									
									body: [

									// Teaser Color
									{
										type: 'textbox',
										name: 'teaserColor',
										label: 'Text Color',
										value: '#444444'
									},
									// Text Align
									{
										type: 'listbox',
										name: 'teaserTextAlign',
										label: 'Text Align',
										values: [
											{text: 'Left', value: 'left'},
											{text: 'Center', value: 'center'},
											{text: 'Right', value: 'right'}
										]
									},

									// Teaser Content
									{
										type: 'textbox',
										multiline: true,
										minWidth: 300,
										minHeight: 100,
										name: 'teaserContent', 
										label: 'Text',
										value: 'This is a teaser text.'
									}],
									onsubmit: function( e ) {
										editor.insertContent('[cl_teaser color="' + e.data.teaserColor + '" text_align="' + e.data.teaserTextAlign + '"]' + e.data.teaserContent + '[/cl_teaser]');
									}
								});
							}
						}, // End Teaser

						/* Font Awesome Icon Start */
						{
							text: 'Font Awesome Icon',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Font Awesome Icon',
									body: [

									// Icon Style
									{
										type: 'textbox',
										name: 'iconName',
										label: 'Icon (FontAwesome Class Name)',
										value: 'bolt'
									},

									// Icon Size
									{
										type: 'listbox',
										name: 'iconSize',
										label: 'Size',
										values: [
											{text: 'Extra Large', value: 'xlarge'},
											{text: 'Large', value: 'large'},
											{text: 'Normal', value: 'normal'},
											{text: 'Small', value: 'small'},
											{text: 'Tiny', value: 'tiny'}
										]
									},

									// Icon FadeIn
									{
										type: 'listbox',
										name: 'iconFadeIn',
										label: 'FadeIn',
										values: [
											{text: 'No', value: 'false'},
											{text: 'Yes', value: 'true'}
										]
									},

									// Icon Float
									{
										type: 'listbox',
										name: 'iconFloat',
										label: 'Float',
										values: [
											{text: 'Left', value: 'left'},
											{text: 'Right', value: 'right'},
											{text: 'None', value: 'none'}
										]
									},

									// Icon Background
									{
										type: 'textbox',
										name: 'iconBackground',
										label: 'Background Color',
										value: '#000'
									},

									// Icon Color
									{
										type: 'textbox',
										name: 'iconColor',
										label: 'Font Color',
										value: '#fff'
									},

									// Icon Border Radius
									{
										type: 'textbox',
										name: 'iconBorderRadius',
										label: 'Border Radius',
										value: '99px'
									},

									// Icon URL
									{
										type: 'textbox',
										name: 'iconUrl',
										label: 'URL',
										value: '#'
									},

									// Icon Title
									{
										type: 'textbox',
										name: 'iconUrlTitle',
										label: 'URL Title',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent('[cl_fa_icon icon="' + e.data.iconName + '" size="' + e.data.iconSize + '" fade_in="' + e.data.iconFadeIn + '" float="' + e.data.iconFloat + '" color="' + e.data.iconColor + '" background="' + e.data.iconBackground + '" border_radius="' + e.data.iconBorderRadius + '" url="' + e.data.iconUrl + '" url_title="' + e.data.iconUrlTitle + '"]');
									}
								});
							}
						}, // Icon section


						/* Google Map */
						{
							text: 'Google Map',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Google Map',
									body: [
									// Google Map Height
									{
										type: 'textbox',
										name: 'gmapHeight',
										label: 'Height',
										value: '300'
									},
									
									// Google Map Type
									{
										type: 'listbox',
										name: 'gmapType',
										label: 'Type',
										values: [
											{text: 'Road Map', value: 'ROADMAP'},
											{text: 'Satellite', value: 'SATELLITE'},
											{text: 'Hybrid', value: 'HYBRID'},
											{text: 'Terrain', value: 'TERRAIN'},
										]
									},
									
									// Google Map Style
									{
										type: 'listbox',
										name: 'gmapStyle',
										label: 'Style',
										values: [
											{text: 'Shades of Grey', value: '1'},
											{text: 'Greyscale', value: '2'},
											{text: 'Light Gray', value: '3'},
											{text: 'Midnight Commander', value: '4'},
											{text: 'Blue water', value: '5'},
											{text: 'Icy Blue', value: '6'},
											{text: 'Bright and Bubbly', value: '7'},
											{text: 'Pale Dawn', value: '8'},
											{text: 'Paper', value: '9'},
											{text: 'Blue Essence', value: '10'},
											{text: 'Apple Maps-esque', value: '11'},
											{text: 'Subtle Grayscale', value: '12'},
											{text: 'Retro', value: '13'},
											{text: 'Hopper', value: '14'},
											{text: 'Red Hues', value: '15'},
											{text: 'Ultra Light with labels', value: '16'},
											{text: 'Unsaturated Browns', value: '17'},
											{text: 'Light Dream', value: '18'},
											{text: 'Neutral Blue', value: '19'},
											{text: 'MapBox', value: '20'}
										]
									},
									// Google Map Latitude
									{
										type: 'textbox',
										name: 'gmapLat',
										label: 'Latitude',
										value: '51.4946416'
									},
									
									// Google Map Longitude
									{
										type: 'textbox',
										name: 'gmapLng',
										label: 'Longitude',
										value: '-0.172699'
									},
									
									// Google Map Zoom
									{
										type: 'textbox',
										name: 'gmapZoom',
										label: 'Zoom',
										value: '12'
									},
									
									// Google Map Markers
									{
										type: 'listbox',
										name: 'gmapMarker',
										label: 'Markers',
										values: [
											{text: 'Yes', value: 'yes'},
											{text: 'No', value: 'no'}
										]
									}

									],
									onsubmit: function( e ) {
										editor.insertContent('[cl_google_map map_type="' + e.data.gmapType + '" style="' + e.data.gmapStyle + '" lat="' + e.data.gmapLat + '" lng="' + e.data.gmapLng + '" height="' + e.data.gmapHeight + '" marker="' + e.data.gmapMarker + '" zoom="' + e.data.gmapZoom + '"]');
									}
								});
							}
						}, // End GoogleMaps


						/* Testimonial */
						{
							text: 'Testimonial',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Testimonial',
									body: [

									// Testimonial FadeIn
									{
										type: 'listbox',
										name: 'testimonialFadeIn',
										label: 'FadeIn',
										values: [
											{text: 'No', value: 'false'},
											{text: 'Yes', value: 'true'}
										]
									},

									// Testimonial Author
									{
										type: 'textbox',
										name: 'testimonialAuthor',
										label: 'Author',
										value: 'Unknown Person'
									},
									// Testimonial Author Position
									{
										type: 'textbox',
										name: 'testimonialAuthorPos',
										label: 'Author Position',
										value: 'Unknown Position'
									},
									// Testimonial Author Image
									{
										type: 'textbox',
										name: 'testimonialAuthorImg',
										label: 'Author Image',
										value: 'IMAGE_URL'
									},	
									
									// Testimonial Content
									{
										type: 'textbox',
										name: 'testimonialContent',
										label: 'Content',
										value: 'Calluna is the best WordPress theme I have ever used!',
										multiline: true,
										minWidth: 300,
										minHeight: 100
									}

									],
									onsubmit: function( e ) {
										editor.insertContent('[cl_testimonial by="' + e.data.testimonialAuthor + '" position="' + e.data.testimonialAuthorPos + '" fade_in="' + e.data.testimonialFadeIn + '"]' + e.data.testimonialContent + '[/cl_testimonial]');
									}
								});
							}
						}, // End Testimonial

						/* Callout */
						{
							text: 'Callout',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Callout',
									body: [

									// Callout FadeIn
									{
										type: 'listbox',
										name: 'calloutFadeIn',
										label: 'FadeIn',
										values: [
											{text: 'No', value: 'false'},
											{text: 'Yes', value: 'true'}
										]
									},

									// Callout Button Text
									{
										type: 'textbox',
										name: 'calloutButtonText',
										label: 'Button: Text',
										value: 'Button'
									},

									// Callout Button URL
									{
										type: 'textbox',
										name: 'calloutButtonUrl',
										label: 'Button: URL',
										value: '#'
									},

									// Callout Button Style
									{
										type: 'listbox',
										name: 'calloutButtonStyle',
										label: 'Button: Style',
										values: [
											{text: 'Style 1', value: 'style-1'},
											{text: 'Style 2', value: 'style-2'}
										]
									},

									// Callout Button Size
									{
										type: 'listbox',
										name: 'calloutButtonSize',
										label: 'Button: Size',
										values: [
											{text: 'Default', value: 'default'},
											{text: 'Small', value: 'small'},
											{text: 'Medium', value: 'medium'},
											{text: 'Large', value: 'large'}
										]
									},

									// Callout Button Link Target
									{
										type: 'listbox',
										name: 'calloutButtonLinkTarget',
										label: 'Button: Link Target',
										values: [
											{text: 'Self', value: 'self'},
											{text: 'Blank', value: 'blank'}
										]
									},

									// Callout Button Rel
									{
										type: 'listbox',
										name: 'calloutButtonRel',
										label: 'Button: Rel',
										values: [
											{text: 'None', value: ''},
											{text: 'Nofollow', value: 'nofollow'}
										]
									},

									// Callout Button Left Icon
									{
										type: 'textbox',
										name: 'calloutButtonLeftIcon',
										label: 'Button: Left Icon (FontAwesome Class Name)',
										value: ''
									},

									// Callout Button Right Icon
									{
										type: 'textbox',
										name: 'calloutButtonRightIcon',
										label: 'Button: Right Icon (FontAwesome Class Name)',
										value: ''
									},

									// Callout Content
									{
										type: 'textbox',
										name: 'calloutContent',
										label: 'Content',
										value: 'Callout Content',
										multiline: true,
										minWidth: 300,
										minHeight: 100
									}

									],
									onsubmit: function( e ) {
										editor.insertContent('[cl_callout fade_in="' + e.data.calloutFadeIn + '" button_text="' + e.data.calloutButtonText + '" button_url="' + e.data.calloutButtonUrl + '" button_style="' + e.data.calloutButtonStyle + '" button_size="' + e.data.calloutButtonSize + '" button_target="' + e.data.calloutButtonLinkTarget + '" button_rel="' + e.data.calloutButtonRel + '" button_icon_left="' + e.data.calloutButtonLeftIcon + '" button_icon_right="' + e.data.calloutButtonRightIcon + '"]' + e.data.calloutContent + '[/cl_callout]');
									}
								});
							}
						}, // End callout
						
						/* Skillbars */
						{
							text: 'Skillbars',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Skillbar',
									body: [

									// Skillbar Title
									{
										type: 'textbox',
										name: 'skillbarTitle',
										label: 'Skill',
										value: ''
									},

									// Skillbar Percentage
									{
										type: 'textbox',
										name: 'skillbarPercentage',
										label: 'Percentage',
										value: '85'
									},

									// Skillbar Color
									{
										type: 'textbox',
										name: 'skillbarColor',
										label: 'Color Hex',
										value: '#967a50'
									},

									// Skillbar Show Percent
									{
										type: 'listbox',
										name: 'skillbarShowPercent',
										label: 'Show Percent',
										values: [
											{text: 'Yes', value: 'true'},
											{text: 'No', value: 'false'}
										]
									}

									],
									onsubmit: function( e ) {
										editor.insertContent('[cl_skillbar title="' + e.data.skillbarTitle + '" percentage="' + e.data.skillbarPercentage + '" color="' + e.data.skillbarColor + '" show_percent="' + e.data.skillbarShowPercent + '"]');
									}
								});
							}
						}, // End Skillbar
						
						/* Pricing */
						{
							text: 'Pricing',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Pricing',
									autoScroll: true,
									height: 450,
									width: 780,
									body: [

									// New Table?
									{
										type: 'listbox',
										name: 'newPricingTable',
										label: 'New Table?',
										values: [
											{text: 'Yes', value: 'yes'},
											{text: 'No', value: 'no'}
										]
									},

									// Pricing Featured
									{
										type: 'listbox',
										name: 'pricingFeatured',
										label: 'Featured?',
										values: [
											{text: 'No', value: 'no'},
											{text: 'Yes', value: 'yes'}
										]
									},

									// Pricing Plan
									{
										type: 'textbox',
										name: 'pricingPlan',
										label: 'Plan',
										value: 'Basic'
									},

									// Pricing Cost
									{
										type: 'textbox',
										name: 'pricingCost',
										label: 'Cost',
										value: '$20'
									},

									// Pricing Per
									{
										type: 'textbox',
										name: 'pricingPer',
										label: 'Per (optional)',
										value: 'per month'
									},

									// Pricing Button Text
									{
										type: 'textbox',
										name: 'pricingButtonText',
										label: 'Button: Text',
										value: 'Purchase'
									},

									// Pricing Button URL
									{
										type: 'textbox',
										name: 'pricingButtonUrl',
										label: 'Button: URL',
										value: '#'
									},

									// Pricing Button Color
									{
										type: 'listbox',
										name: 'pricingButtonStyle',
										label: 'Button: Style',
										values: [
											{text: 'Style 1', value: 'style-1'},
											{text: 'Style 2', value: 'style-2'}
										]
									},

									// Pricing Button Size
									{
										type: 'listbox',
										name: 'pricingButtonSize',
										label: 'Button: Size',
										values: [
											{text: 'Default', value: ''},
											{text: 'Small', value: 'small'},
											{text: 'Medium', value: 'medium'},
											{text: 'Large', value: 'large'}
										]
									},

									// Pricing Button Link Target
									{
										type: 'listbox',
										name: 'pricingButtonLinkTarget',
										label: 'Button: Link Target',
										values: [
											{text: 'Self', value: 'self'},
											{text: 'Blank', value: 'blank'}
										]
									},

									// Pricing Button Rel
									{
										type: 'listbox',
										name: 'pricingButtonRel',
										label: 'Button: Rel',
										values: [
											{text: 'None', value: ''},
											{text: 'Nofollow', value: 'nofollow'}
										]
									},

									// Pricing Button Left Icon
									{
										type: 'textbox',
										name: 'pricingButtonLeftIcon',
										label: 'Button: Left Icon (FontAwesome Class Name)',
										value: ''
									},

									// Pricing Button Right Icon
									{
										type: 'textbox',
										name: 'pricingButtonRightIcon',
										label: 'Button: Right Icon (FontAwesome Class Name)',
										value: ''
									},

									// Pricing Features
									{
										type: 'textbox',
										name: 'pricingFeatures',
										label: 'Features (ul list is best)',
										value: '<ul><li>30GB Storage</li><li>512MB Ram</li><li>10 databases</li><li>1,000 Emails</li><li>25GB Bandwidth</li></ul>',
										multiline: true,
										minWidth: 400,
										minHeight: 200
									}

									],
									onsubmit: function( e ) {
										if ( e.data.newPricingTable === 'yes' ){
											var $openPricingTable = '[cl_pricing_table]';
											var $closePricingTable = '[/cl_pricing_table]';
										} else {
											var $openPricingTable = '';
											var $closePricingTable = '';
										}
										editor.insertContent( '' + $openPricingTable + '[cl_pricing featured="' + e.data.pricingFeatured + '" plan="' + e.data.pricingPlan + '" cost="' + e.data.pricingCost + '" per="' + e.data.pricingPer + '" button_text="' + e.data.pricingButtonText + '" button_url="' + e.data.pricingButtonUrl + '" button_style="' + e.data.pricingButtonStyle + '" button_size="' + e.data.pricingButtonSize + '" button_target="' + e.data.pricingButtonLinkTarget + '" button_rel="' + e.data.pricingButtonRel + '" button_icon_left="' + e.data.pricingButtonLeftIcon + '" button_icon_right="' + e.data.pricingButtonRightIcon + '"]' + e.data.pricingFeatures + '[/cl_pricing]' + $closePricingTable + '');
									}
								});
							}
						}, // End pricing

					]
				}, // End Elements Section


				/** jQuery Start **/
				{
				text: 'jQuery',
				menu: [

						/* Accordion */
						{
							text: 'Accordion',
							onclick: function() {
								editor.insertContent('[cl_accordion][cl_accordion_section title="Accordion 1"] Your Content [/cl_accordion_section][cl_accordion_section title="Accordion 2"] Your Content [/cl_accordion_section][/cl_accordion]');
							}
						}, // End accordion

						/* Toggle */
						{
							text: 'Toggle',
							onclick: function() {
								editor.insertContent('[cl_toggle title="Your Toggle Title" state="closed"] Your Content [/cl_toggle]');
							}
						}, // End toggle

						/* Tabs */
						{
							text: 'Tabs',
							onclick: function() {
								editor.insertContent('[cl_tabgroup][cl_tab title="Tab 1"] Your Tab 1 Content [/cl_tab][cl_tab title="Tab 2"] Your Tab 2 Content [/cl_tab][cl_tab title="Tab 3"] Your Tab 3 Content [/cl_tab][/cl_tabgroup]');
							}
						} // End tabs

					]
				}, // End jQuery section
				
				/** Posts Start **/
				{
				text: 'Posts',
				menu: [
					
					/* Room Carousel */
						{
							text: 'Room Carousel',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Room Carusel',
									body: [

									// Room Max Items
									{
										type: 'textbox',
										name: 'roomMaxItems',
										label: 'Room Carousel: Max Items',
										value: '8'
									},
                                    // Room Image Width
                                    {
                                        type: 'textbox',
                                        name: 'roomImgWidth',
                                        label: 'Room Carousel: Image Width',
                                        value: '420'
                                    },
                                    // Room Image Height
                                    {
                                        type: 'textbox',
                                        name: 'roomImgHeight',
                                        label: 'Room Carousel: Image Height',
                                        value: '510'
                                    }

									],
									onsubmit: function( e ) {
										editor.insertContent('[cl_room_carousel max_items="' + e.data.roomMaxItems + '" img_height="' + e.data.roomImgHeight + '" img_width="' + e.data.roomImgWidth + '"]');
									}
								});
							}
						}, // End Room Carousel
						
					/* Offer Carousel */
						{
							text: 'Offer Carousel',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Offer Carusel',
									body: [
										// Parent Category
									{
										type: 'textbox',
										name: 'offerParentCat',
										label: 'Offer Carousel: Parent Category',
										values: ''
									},
									// Offer Max Items
									{
										type: 'textbox',
										name: 'offerMaxItems',
										label: 'Offer Carousel: Max Items',
										value: ''
									},
									// Offer Carousel Rotation
									{
										type: 'listbox',
										name: 'offerRotation',
										label: 'Offer Carousel: Rotation',
										values: [
											{text: 'Continuous', value: 'circular'},
											{text: 'Stop at end', value: 'none'}
										]
									},
									// Offer Carousel Featured Image
									{
										type: 'listbox',
										name: 'offerImage',
										label: 'Offer Carousel: Show Featured Image',
										values: [
											{text: 'Yes', value: 'yes'},
											{text: 'No', value: 'no'}
										]
									}
									],
									onsubmit: function( e ) {
										editor.insertContent('[cl_offer_carousel parent_cat="' + e.data.offerParentCat + '" wrap="' + e.data.offerRotation + '" max_items="' + e.data.offerMaxItems + '" featured_images="' + e.data.offerImage + '"]');
									}
								});
							}
						}, // End Offer Carousel
					
					/* Event Carousel */
						{
							text: 'Event Carousel',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Event Carusel',
									body: [
										// Parent Category
									{
										type: 'textbox',
										name: 'eventParentCat',
										label: 'Event Carousel: Parent Category',
										values: ''
									},
									// Event Max Items
									{
										type: 'textbox',
										name: 'eventMaxItems',
										label: 'Event Carousel: Max Items',
										value: ''
									},
									// Event Carousel Rotation
									{
										type: 'listbox',
										name: 'eventRotation',
										label: 'Event Carousel: Rotation',
										values: [
											{text: 'Continuous', value: 'circular'},
											{text: 'Stop at end', value: 'none'}
										]
									},
									// Event Carousel Featured Image
									{
										type: 'listbox',
										name: 'eventImage',
										label: 'Event Carousel: Show Featured Image',
										values: [
											{text: 'Yes', value: 'yes'},
											{text: 'No', value: 'no'}
										]
									}
									],
									onsubmit: function( e ) {
										editor.insertContent('[cl_event_carousel parent_cat="' + e.data.eventParentCat + '" wrap="' + e.data.eventRotation + '" max_items="' + e.data.eventMaxItems + '" featured_images="' + e.data.eventImage + '"]');
									}
								});
							}
						}, // End Event Carousel
						
					/* Room Price */
						{
							text: 'Room Price',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Room Price',
									body: [
									],
									onsubmit: function() {
										editor.insertContent('[cl_room_price]');
									}
								});
							}
						}, // End Room Price
					
					/* Offer Price */
						{
							text: 'Offer Price',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Calluna Shortcodes - Insert Offer Price',
									body: [
									],
									onsubmit: function() {
										editor.insertContent('[cl_offer_price]');
									}
								});
							}
						}, // End Offer Price

					/* Posts Grid */
					{
						text: 'Posts Grid',
						onclick: function() {
							editor.windowManager.open( {
								title: 'Calluna Shortcodes - Posts Grid',
								autoScroll: true,
								height: 450,
								width: 450,
								body: [

								// Posts Grid ID
								{
									type: 'textbox',
									name: 'postsGridUniqueId',
									label: 'Unique ID (Optional)',
									value: ''
								},

								// Posts Grid Post Type
								{
									type: 'textbox',
									name: 'postsGridPostType',
									label: 'Post Type',
									value: 'post'
								},

								// Posts Grid Taxonomy
								{
									type: 'textbox',
									name: 'postsGridTaxonomy',
									label: 'Filter by: Taxonomy Name',
									value: ''
								},

								// Posts Grid Taxonomy
								{
									type: 'textbox',
									name: 'postsGridTermSlug',
									label: 'Filter by: Term Slug',
									value: ''
								},

								// Posts Grid Count
								{
									type: 'textbox',
									name: 'postsGridCount',
									label: 'Posts Per Page',
									value: '8'
								},

								// Posts Grid Pagination
								{
									type: 'listbox',
									name: 'postsGridPagination',
									label: 'Paginate?',
									values: [
										{text: 'No', value: 'false'},
										{text: 'Yes', value: 'true'}
									]
								},

								// Posts Grid Order
								{
									type: 'listbox',
									name: 'postsGridOrder',
									label: 'Order',
									values: [
										{text: 'Descending', value: 'DESC'},
										{text: 'Ascending', value: 'ASC'}
									]
								},

								// Posts Grid Order by
								{
									type: 'listbox',
									name: 'postsGridOrderBy',
									label: 'Order By',
									values: [
										{text: 'Date', value: 'date'},
										{text: 'Name', value: 'name'},
										{text: 'Modified', value: 'modified'},
										{text: 'Author', value: 'author'},
										{text: 'Random', value: 'random'},
										{text: 'Comment Count', value: 'comment_count'}
									]
								},

								// Posts Grid Columns
								{
									type: 'listbox',
									name: 'postsGridColumns',
									label: 'Columns',
									values: [
										{text: '1', value: '1'},
										{text: '2', value: '2'},
										{text: '3', value: '3'},
										{text: '4', value: '4'},
										{text: '5', value: '5'},
										{text: '6', value: '6'}
									]
								},

								// Posts Grid Thumbnail Link
								{
									type: 'listbox',
									name: 'postsGridThumbnailLink',
									label: 'Thumbnail Link',
									values: [
										{text: 'Post', value: 'post'},
										{text: 'Lightbox', value: 'lightbox'},
										{text: 'None', value: 'none'}
									]
								},

								// Posts Grid Thumbnail Crop
								{
									type: 'listbox',
									name: 'postsGridThumbnailCrop',
									label: 'Thumbnail Crop',
									values: [
										{text: 'Yes', value: 'true'},
										{text: 'No', value: 'false'}
									]
								},

								// Posts Grid Thumbnail Height
								{
									type: 'textbox',
									name: 'postsGridThumbnailHeight',
									label: 'Thumbnail Height',
									value: '450'
								},

								// Posts Grid Thumbnail Width
								{
									type: 'textbox',
									name: 'postsGridThumbnailWidth',
									label: 'Thumbnail Width',
									value: '350'
								},

								// Posts Grid Title
								{
									type: 'listbox',
									name: 'postsGridTitle',
									label: 'Display Title?',
									values: [
										{text: 'Yes', value: 'true'},
										{text: 'No', value: 'false'}
									]
								},

								// Posts Grid Excerpt
								{
									type: 'listbox',
									name: 'postsGridExcerpt',
									label: 'Display Excerpt?',
									values: [
										{text: 'Yes', value: 'true'},
										{text: 'No', value: 'false'}
									]
								},

								// Posts Grid Excerpt
								{
									type: 'textbox',
									name: 'postsGridExcerptLength',
									label: 'Excerpt Length',
									value: '30'
								},

								// Posts Grid Read More Link
								{
									type: 'listbox',
									name: 'postsGridReadMore',
									label: 'Read More Link',
									values: [
										{text: 'Yes', value: 'true'},
										{text: 'No', value: 'false'}
									]
								}

								],
								onsubmit: function( e ) {
									editor.insertContent('[cl_posts_grid unique_id="' + e.data.postsGridUniqueId + '" post_type="' + e.data.postsGridPostType + '" taxonomy="' + e.data.postsGridTaxonomy + '" term_slug="' + e.data.postsGridTermSlug + '" count="' + e.data.postsGridCount + '" columns="' + e.data.postsGridColumns + '" pagination="' + e.data.postsGridPagination + '" order="' + e.data.postsGridOrder + '" orderby="' + e.data.postsGridOrderBy + '" thumbnail_link="' + e.data.postsGridThumbnailLink + '" img_crop="' + e.data.postsGridThumbnailCrop + '" img_height="' + e.data.postsGridThumbnailHeight + '" img_width="' + e.data.postsGridThumbnailWidth + '" title="true" excerpt="' + e.data.postsGridExcerpt + '" excerpt_length="' + e.data.postsGridExcerptLength + '" read_more="' + e.data.postsGridReadMore + '"]');
								}
							});
						}
					}

					]
				}, // End Posts section

			]
		});
	});
})();