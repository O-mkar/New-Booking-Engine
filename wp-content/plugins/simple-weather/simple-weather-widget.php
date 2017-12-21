<?php

function simple_weather_widget_cb() {
    register_widget( 'Simple_Weather_Widget' );
}
add_action( 'widgets_init', 'simple_weather_widget_cb' );

class Simple_Weather_Widget extends WP_Widget {

	function __construct() {
		
		/** Admin Scripts */
		add_action( 'load-widgets.php', array( $this, 'admin_scripts' ) ); 
		
		parent::__construct(
			'simple-weather',
			__('Simple Weather Widget', 'SIMPLEWEATHER'), 
			array( 
				'classname' => 'simple-weather', 
				'description' => __('This widget displays the weather', 
				'SIMPLEWEATHER'
			), 'idbase' => 'simple-weather' ), 
			array( 
				'width' => 252, 
				'idbase' => 'simple-weather'
			)
		);
	}
	
	/** Admin Scripts */
	function admin_scripts() {
		wp_enqueue_style( 'wp-color-picker' );          
		wp_enqueue_script( 'wp-color-picker' ); 
		wp_enqueue_script( 
			'main-simple-weather', 
			plugins_url( '/js/main.js' , __FILE__ ), 
			null, 
			null, 
			true
		);
	}
	
	/** hex2rgb */
	function hex2rgb( $hex ) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return implode(",", $rgb);
	}
	
	/** Widget */
	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$location_type = $instance['location-type'];
		$api = isset( $instance['api'] ) && ! empty( $instance['api'] ) ? $instance['api'] : '3b0095a1f393a1078abe2b5e1e05bcee';
		if($location_type == 'location'){
			$latitude = null;
			$longitude = null;
		}else {
			$latitude = $instance['latitude'];
			$longitude = $instance['longitude'];
		}
		if ($location_type == 'auto') $location = 'auto'; else $location = esc_attr($instance['location']);
		$units = $instance['units'];
		$lang = $instance['lang'];
		$bg = $instance['bg_color'];
		$text = $instance['text_color'];
		$days = $instance['days'];
		$date = 'l';
		$interval = isset( $instance['interval'] ) ? $instance['interval'] : 0;
		$timeout = isset( $instance['timeout'] ) ? $instance['timeout'] : 30;
		
		$data_file_days = CurlySimpleWeather::get_weather_file( $location, $latitude, $longitude, $days, $units, 0, $lang, $api, $interval, $timeout );
		if ( ! is_wp_error($data_file_days) ){
			$json_data_days = json_decode($data_file_days, true);
		} else {
			$json_data_days = null;
		}
		
		$data_file_current = CurlySimpleWeather::get_weather_file( $location, $latitude, $longitude, 0, $units, 1, $lang, $api, $interval, $timeout );
		if ( ! is_wp_error($data_file_current) ){
			$json_data_current = json_decode($data_file_current, true);
		} else {
			$json_data_current = null;
		}
		
		echo $before_widget; ?>
		
		<?php if($location || $latitude || $longitude) : ?>
		
		<div class="simple-weather-widget" style="background-color: <?php echo ($bg != null) ? $bg : 'none'; ?>; color: <?php echo isset($text) ? $text : 'inherit'; ?>; <?php if(isset($bg)) echo 'padding: 10px;' ?>;">
			<h4><?php if ( $title ) echo $title; else echo $json_data_current['name'] ?></h4>
			<?php if($json_data_current != null) : ?>
			<div class="temp">
				<span class="degrees"><?php echo ceil($json_data_current['main']['temp']) ?>&deg;</span>
				<span class="details">
					<?php _e('Humidity:' , 'SIMPLEWEATHER') ?> <em class="float-right"><?php echo ceil($json_data_current['main']['humidity']) ?>%</em><br>
					<?php _e('Clouds:' , 'SIMPLEWEATHER') ?> <em class="float-right"><?php echo ceil($json_data_current['clouds']['all']) ?>%</em><br>
					<?php _e('Wind' , 'SIMPLEWEATHER') ?> <small>(<?php echo CurlySimpleWeather::get_wind_direction($json_data_current['wind']['deg']) ?>)</small>: <em class="float-right"><?php echo ($units == 'metric') ?  ceil($json_data_current['wind']['speed'] * 3.6).'<small>kph</small>' : ceil($json_data_current['wind']['speed'] * 3.6 / 1.609344).'<small>mph</small>' ?></em><br>
				</span>
			</div>
			<small style="text-transform: capitalize;"><?php echo $json_data_current['weather'][0]['description']?></small>
			<?php endif; ?>
			
			<?php if($days != 0 && $json_data_days != null) : ?>
			<div class="simple-weather-table" style="border-color: rgba(<?php echo $text ? $this->hex2rgb( $text ) : 'inherit'; ?>, .3);">
				<?php  foreach ($json_data_days['list'] as $key => $value) { ?>
				<div>
					<div><?php echo date_i18n('l', $value['dt']); ?></div>
					<div><i data-sw-icon="<?php echo CurlySimpleWeather::get_weather_icon($value['weather'][0]['id']) ?>"></i></div>
					<div class="text-right"><?php echo ceil($value['temp']['day']) ?>&deg;</div>
					<div class="text-right" style="opacity: 0.65;"><?php echo ceil($value['temp']['night']) ?>&deg;</div>
				</div>
				<?php } ?>
			</div>
			
			<?php endif; ?>
			
		</div>
		
		<?php endif; ?>
		
		<?php 	
		
		echo $after_widget;
	}
	
	//Update the widget 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['location-type'] = $new_instance['location-type'];
		$instance['location'] = $new_instance['location'];
		$instance['latitude'] = $new_instance['latitude'];
		$instance['longitude'] = $new_instance['longitude'];
		$instance['units'] = $new_instance['units'];
		$instance['lang'] = $new_instance['lang'];
		$instance['bg_color'] = $new_instance['bg_color'];
		$instance['text_color'] = $new_instance['text_color'];
		$instance['days'] = $new_instance['days'];
		$instance['api'] = $new_instance['api'];
		$instance['interval'] = $new_instance['interval'];
		$instance['timeout'] = $new_instance['timeout'];

		return $instance;
	}
	
	function form( $instance ) {
		
		$defaults = array(  
		           'title' => null,
		           'location' => null,
		           'location-type' => 'location',
		           'latitude' => null,
		           'longitude' => null,
		           'bg_color' => null,
		           'text_color' => null,
		           'units' => 'imperial',
		           'lang' => 'en',
		           'days' => 5,
		           'api' => '3b0095a1f393a1078abe2b5e1e05bcee',
		           'interval' => 10,
		           'timeout' => 30
		       );
	
		//Set up some default widget settings.
		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		<div class="widget-content">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title:', 'SIMPLEWEATHER'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'location-type' ); ?>"><?php _e('Location Type:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'location-type' ); ?>" name="<?php echo $this->get_field_name( 'location-type' ); ?>">
                	<option <?php selected( $instance['location-type'], 'location' ); ?> value="location">Location</option>
                    <option <?php selected( $instance['location-type'], 'coordinates' ); ?> value="coordinates">Coordinates</option>
                    <option <?php selected( $instance['location-type'], 'auto' ); ?> value="auto">Auto</option>
                </select>
            </p>
            <p class="loc-cont" style="display: <?php echo ($instance['location-type'] == 'location') ? 'block' : 'none'; ?>;">
                <label for="<?php echo $this->get_field_id( 'location' ); ?>"><?php _e('Location:', 'SIMPLEWEATHER'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'location' ); ?>" name="<?php echo $this->get_field_name( 'location' ); ?>" value="<?php echo $instance['location']; ?>" class="widefat" />
                <small style="color: gray;">Example: London, Uk</small>
            </p> 
            <p class="lat-cont"  style="display: <?php echo ($instance['location-type'] == 'coordinates') ? 'block' : 'none'; ?>;">
                <label for="<?php echo $this->get_field_id( 'latitude' ); ?>"><?php _e('Location Latitude:', 'SIMPLEWEATHER'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'latitude' ); ?>" name="<?php echo $this->get_field_name( 'latitude' ); ?>" value="<?php echo $instance['latitude']; ?>" class="widefat" />
            </p> 
            <p class="lon-cont"  style="display: <?php echo ($instance['location-type'] == 'coordinates') ? 'block' : 'none'; ?>;">
                <label for="<?php echo $this->get_field_id( 'longitude' ); ?>"><?php _e('Location Longitude:', 'SIMPLEWEATHER'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'longitude' ); ?>" name="<?php echo $this->get_field_name( 'longitude' ); ?>" value="<?php echo $instance['longitude']; ?>" class="widefat" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'units' ); ?>"><?php _e('Units:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'units' ); ?>" name="<?php echo $this->get_field_name( 'units' ); ?>">
                	<option <?php selected( $instance['units'], 'imperial' ); ?> value="imperial">Imperial (Farenheit)</option>
                    <option <?php selected( $instance['units'], 'metric' ); ?> value="metric">Metric (Celsius)</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'days' ); ?>"><?php _e('Days of forecast:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>">
                	<option <?php selected( $instance['days'], 0 ); ?> value="0">None</option>
                    <option <?php selected( $instance['days'], 1 ); ?> value="1">1</option>
                    <option <?php selected( $instance['days'], 2 ); ?> value="2">2</option>
                    <option <?php selected( $instance['days'], 3 ); ?> value="3">3</option>
                    <option <?php selected( $instance['days'], 4 ); ?> value="4">4</option>
                    <option <?php selected( $instance['days'], 5 ); ?> value="5">5</option>
                    <option <?php selected( $instance['days'], 6 ); ?> value="6">6</option>
                    <option <?php selected( $instance['days'], 7 ); ?> value="7">7</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'interval' ); ?>"><?php _e('Weather Check Interval:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'interval' ); ?>" name="<?php echo $this->get_field_name( 'interval' ); ?>">
                	<option <?php selected( $instance['interval'], 0 ); ?> value="0">Each Page Refresh</option>
                	<option <?php selected( $instance['interval'], 10 ); ?> value="10">Every 10 minutes</option>
                	<option <?php selected( $instance['interval'], 30 ); ?> value="30">Every 30 minutes</option>
                	<option <?php selected( $instance['interval'], 60 ); ?> value="60">Every 1 hour</option>
                	<option <?php selected( $instance['interval'], 120 ); ?> value="120">Every 2 hours</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'timeout' ); ?>"><?php _e('Response Timeout:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'timeout' ); ?>" name="<?php echo $this->get_field_name( 'timeout' ); ?>">
                	<option <?php selected( $instance['timeout'], 5 ); ?> value="0">5 Seconds</option>
                	<option <?php selected( $instance['timeout'], 10 ); ?> value="10">10 Seconds</option>
                	<option <?php selected( $instance['timeout'], 30 ); ?> value="30">30 Seconds</option>
                	<option <?php selected( $instance['timeout'], 40 ); ?> value="40">40 Seconds</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'lang' ); ?>"><?php _e('Language:', 'SIMPLEWEATHER'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'lang' ); ?>" name="<?php echo $this->get_field_name( 'lang' ); ?>">
                	<option <?php selected( $instance['lang'], 'en' ); ?> value="en">English</option>
                    <option <?php selected( $instance['lang'], 'ru' ); ?> value="ru">Russian</option>
                    <option <?php selected( $instance['lang'], 'it' ); ?> value="it">Italian</option>
                    <option <?php selected( $instance['lang'], 'sp' ); ?> value="sp">Spanish</option>
                    <option <?php selected( $instance['lang'], 'ua' ); ?> value="ua">Ukranian</option>
                    <option <?php selected( $instance['lang'], 'de' ); ?> value="de">German</option>
                    <option <?php selected( $instance['lang'], 'pt' ); ?> value="pt">Portuguese</option>
                    <option <?php selected( $instance['lang'], 'ro' ); ?> value="ro">Romanian</option>
                    <option <?php selected( $instance['lang'], 'pl' ); ?> value="pl">Polish</option>
                    <option <?php selected( $instance['lang'], 'fi' ); ?> value="fi">Finnish</option>
                    <option <?php selected( $instance['lang'], 'nl' ); ?> value="nl">Dutch</option>
                    <option <?php selected( $instance['lang'], 'fr' ); ?> value="fr">French</option>
                    <option <?php selected( $instance['lang'], 'bg' ); ?> value="bg">Bulgarian</option>
                    <option <?php selected( $instance['lang'], 'se' ); ?> value="se">Swedish</option>
                    <option <?php selected( $instance['lang'], 'zh_tw' ); ?> value="zh_tw">Chinese Traditional</option>
                    <option <?php selected( $instance['lang'], 'zh_cn' ); ?> value="zh_cn">Chinese Simplified</option>
                    <option <?php selected( $instance['lang'], 'tr' ); ?> value="tr">Turkish</option>
                </select>
            </p>
            <h4><?php _e('Widget Styling' , 'SIMPLEWEATHER') ?></h4> 
            
            <script type="text/javascript">
            	jQuery(document).ready(function($){
            	    function updateColorPickers(){
            	        $('.widget-content .wp-color-picker').each(function(){
            	            $(this).wpColorPicker({
            	                // you can declare a default color here,
            	                // or in the data-default-color attribute on the input
            	                defaultColor: false,
            	                // a callback to fire whenever the color changes to a valid color
            	                change: function(event, ui){},
            	                // a callback to fire when the input is emptied or an invalid color
            	                clear: function() {},
            	                // hide the color picker controls on load
            	                hide: true
            	            });
            	        }); 
            	    }
            	    updateColorPickers();   
            	    $(document).ajaxSuccess(function(e, xhr, settings) {
            	
            	        if(settings.data.search('action=save-widget') != -1 ) { 
            	            $('.color-field .wp-picker-container').remove();    
            	            updateColorPickers();       
            	        }
            	    });
            	 });
            </script>
            
            <p>
            	<label><?php _e('Background Color' , 'SIMPLEWEATHER') ?></label><br>
            	<input type="text" id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" value="<?php echo esc_attr($instance['bg_color']); ?>" class="wp-color-picker" />
            </p>
            <p>
            	<label><?php _e('Text Color' , 'SIMPLEWEATHER') ?></label><br>
            	<input class="wp-color-picker" type="text" id="<?php echo $this->get_field_id( 'text_color' ); ?>" name="<?php echo $this->get_field_name( 'text_color' ); ?>" value="<?php echo esc_attr($instance['text_color']); ?>" />
            </p> 
            <p>
                <label for="<?php echo $this->get_field_id( 'api' ); ?>"><?php _e('API Key: (optional)', 'SIMPLEWEATHER'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'api' ); ?>" name="<?php echo $this->get_field_name( 'api' ); ?>" value="<?php echo $instance['api']; ?>" class="widefat" />
                <small><?php _e('For better performance it is recommended that you use an API key. To get access to weather API you need an API key whatever account you chose from Free to Enterprise. <a href="http://openweathermap.org/appid" target="_blank">Generate API Key</a>', 'SIMPLEWEATHER'); ?></small>
            </p> 
		</div>
	<?php
	}
}
?>