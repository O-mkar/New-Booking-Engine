<?php
/*
Plugin Name: Simple Weather
Plugin URI: http://www.curlythemes.com
Description: This plugin gives you a simple shortcode & widget to display the weather.
Version: 2.2
Author: Curly Themes
Author URI: http://www.curlythemes.com
*/

if( ! class_exists( 'CurlySimpleWeather' ) ){
	
	/**
	* Simple Weather
	*/
	class CurlySimpleWeather {
	
		/** Constructor */
		function __construct(){
			
			/** Load Scripts */
			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts') );
			
			/** Textdomain */
			add_action( 'plugins_loaded', array( $this, 'set_textdomain' ) );
			
			/** Load Widget */
			require_once('simple-weather-widget.php');
			
			/** Weather Shortcode */
			add_shortcode( 'simple-weather', array( $this, 'weather_shortcode' ) );
			
		}
		
		/** Load Scripts */
		function load_scripts() {
			if ( ! is_admin() ) {
				wp_enqueue_style('simple-weather', plugins_url( '/css/simple-weather.css' , __FILE__ ), true);
				wp_enqueue_style('meteocons', plugins_url( '/css/meteocons.css' , __FILE__ ), true);
			} 
		}
		
		/** Textdomain */
		function set_textdomain() {
			load_plugin_textdomain( 'SIMPLEWEATHER', false, dirname( plugin_basename( __FILE__ ) ). '/languages/' ); 
		}
		
		/** Weather Shortcode */
		function weather_shortcode( $atts ) {
			extract( shortcode_atts( array(
				'latitude' => null,
				'longitude' => null,
				'location' => 'London, uk',
				'days' => 1,
				'units' => 'imperial',
				'show_units' => 'yes',
				'show_date'	=> 'yes',
				'night' => 'no',
				'date'	=> 'l',
				'api'	=> '3b0095a1f393a1078abe2b5e1e05bcee',
				'interval' => 0,
				'timeout' => 30
			), $atts ) );
			
			//get api key from theme mods.
			$api = get_theme_mod('openweather_api_key', '5f27a481372e38ca2b7c215ba8e10007');
			
			$data_file = $this->get_weather_file( $location, $latitude, $longitude, $days, $units, 0, 'en', $api, $interval, $timeout );
			
			if ( $data_file ){
				$json_data = json_decode($data_file, true);
			} else {
				$json_data = null;
			}
			
			$units = ( $units == 'imperial' ) ? 'F' : 'C';
			
			if ( $json_data['cod'] && $json_data['cod'] == '200' ) {
				$html = '<div class="simple-weather inline-weather">';
					if ( $json_data['list'] != null ) {
						foreach ( $json_data['list'] as $key => $value) {
							$html .= '<span>';
							$html .= ( $show_date != 'no' ) ? date_i18n($date, $value['dt']) : null;
							$html .= ' <i data-sw-icon="'.$this->get_weather_icon($value['weather'][0]['id']).'"></i> <em>'.ceil($value['temp']['day']).'&deg;';
							$html .= ( $night != 'no' ) ? ' / '.ceil( $value['temp']['night'] ).' &deg; ' : null;
							$html .= ( $show_units != 'no' ) ? $units : null;
							$html .= '</em></span>';
						}
					}
				$html .= '</div>';
			} else {
				$html = null;	
			}
			
			return $html;
			
		}
		
		/** Get Weather */
		public static function get_weather_file( 
				$location, 
				$latitude, 
				$longitude, 
				$days = 1, 
				$units = 'imperial', 
				$type = 0, 
				$lang = 'en', 
				$api = null,
				$freq = 0,
				$timeout = 30,
				$url = 'http://api.openweathermap.org/data/2.5/',
				$query_args = array()
			){
				
			/** Location Unique ID */
			$request_id = ( $latitude && $longitude ) ? 'sw'.md5( $latitude.$longitude.$type ) : 'sw'.md5( $location.$type );
			
			/** Set interval for last check */
			$date1 = new DateTime( "now" );
			$date2 = new DateTime( get_option( $request_id, '2012-09-11') );
			$interval = $date1->diff($date2);
			
			$minutes = $interval->days * 24 * 60;
			$minutes += $interval->h * 60;
			$minutes += $interval->i;
			
			/** Forecast or Current Weather */
			if( $type == 0 ) $url .= 'forecast/daily'; else $url .= 'weather';
			
			if( $location == 'auto' ){
				$ip_file = wp_remote_get('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
				$ip_data = json_decode($ip_file['body'], true);
				$location = $ip_data['city'].', '.$ip_data['country_code'];
				$latitude = null;
				$longitude = null;
			}
			
			/** Set Location Query Args **/
			if( isset( $latitude ) && isset( $longitude ) ){
				 $query_args['lat'] = $latitude;
				 $query_args['lon'] = $longitude;
			} else {
				 $query_args['q'] 	= $location;
			}
			
			/** Set Query Args */
			 $query_args['cnt'] 	= $days;
			 $query_args['units'] 	= $units;
			 $query_args['mode']	= 'json';
			 $query_args['lang']	= $lang;
			
			/** Check for API Key */
			if ( $api ) {
				 $query_args['APPID'] = $api;
			}
			
			$freq = abs( $freq );
			
			if( $freq >= 10 ){
				if( ! get_option( $request_id ) || $minutes >= $freq ){
					
					$url = add_query_arg( $query_args, $url );
					$url = esc_url_raw( $url ); 
					$result =  wp_remote_get( $url, array( 'timeout' => $timeout ) );
					
					if ( ! is_wp_error( $result ) ) {
						update_option( $request_id , $date1->format('Y-m-d H:i:s') );
						update_option( $request_id.'_weather' , $result['body'] );
					}
				}
				return get_option( $request_id.'_weather' );
			} else {
				
				$url = add_query_arg( $query_args, $url );
				$url = esc_url_raw( $url ); 
				$result =  wp_remote_get( $url, array( 'timeout' => $timeout ) );
				
				if ( ! is_wp_error( $result ) ) {
					update_option( $request_id , $date1->format('Y-m-d H:i:s') );
					update_option( $request_id.'_weather' , $result['body'] );
					return $result['body'];
				} else {
					return get_option( $request_id.'_weather' );
				}
			}
		}
		
		/** Get Weather Icon */
		public static function get_weather_icon($code) {
			switch ($code) {
				case 200 : return '0'; break;
				case 201 : return '0'; break;
				case 202 : return '0'; break;
				case 210 : return '0'; break;
				case 211 : return '0'; break;
				case 212 : return '0'; break;
				case 221 : return '0'; break;
				case 230 : return '0'; break;
				case 231 : return '0'; break;
				case 232 : return '0'; break;
				case 300 : return 'R'; break;
				case 301 : return 'R'; break;
				case 302 : return 'R'; break;
				case 310 : return 'R'; break;
				case 311 : return 'R'; break;
				case 312 : return 'R'; break;
				case 321 : return 'R'; break;
				case 500 : return 'Q'; break;
				case 501 : return 'Q'; break;
				case 502 : return 'Q'; break;
				case 503 : return 'Q'; break;
				case 504 : return 'Q'; break;
				case 511 : return 'X'; break;
				case 520 : return 'R'; break;
				case 521 : return 'R'; break;
				case 522 : return 'R'; break;
				case 600 : return 'U'; break;
				case 601 : return 'W'; break;
				case 602 : return 'W'; break;
				case 611 : return 'W'; break;
				case 621 : return 'W'; break;
				case 701 : return 'M'; break;
				case 711 : return 'M'; break;
				case 721 : return 'M'; break;
				case 731 : return 'M'; break;
				case 741 : return 'M'; break;
				case 800 : return 'B'; break;
				case 801 : return 'H'; break;
				case 802 : return 'N'; break;
				case 803 : return 'Y'; break;
				case 804 : return 'Y'; break;
				case 900 : return 'F'; break;
				case 901 : return 'F'; break;
				case 902 : return 'F'; break;
				case 905 : return 'F'; break;
				case 906 : return 'G'; break;
			}
		}
		
		/** Get Wind Direction */
		public static function get_wind_direction($deg){
			if ($deg >= 0 && $deg < 22.5) return 'N';
			elseif ($deg >= 22.5 && $deg < 45) return 'NNE';
			elseif ($deg >= 45 && $deg < 67.5) return 'NE';
			elseif ($deg >= 67.5 && $deg < 90) return 'ENE';
			elseif ($deg >= 90 && $deg < 122.5) return 'E';
			elseif ($deg >= 112.5 && $deg < 135) return 'ESE';
			elseif ($deg >= 135 && $deg < 157.5) return 'SE';
			elseif ($deg >= 157.5 && $deg < 180) return 'SSE';
			elseif ($deg >= 180 && $deg < 202.5) return 'S';
			elseif ($deg >= 202.5 && $deg < 225) return 'SSW';
			elseif ($deg >= 225 && $deg < 247.5) return 'SW';
			elseif ($deg >= 247.5 && $deg < 270) return 'WSW';
			elseif ($deg >= 270 && $deg < 292.5) return 'W';
			elseif ($deg >= 292.5 && $deg < 315) return 'WNW';
			elseif ($deg >= 315 && $deg < 337.5) return 'NW';
			elseif ($deg >= 337.5 && $deg < 360) return 'NNW';
		}
	}
	
	new CurlySimpleWeather();
}
?>