<?php
/**
 * Calluna Twitter widget
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start widget class
if( !class_exists('Calluna_Core_Twitter_Widget') ){
	class Calluna_Core_Twitter_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 *
		 */
		function __construct() {
			parent::__construct(FALSE, $name = esc_html__('Calluna Twitter Feed', 'calluna-td'), array(
				'description' => esc_html__('Show your twitter tweets.', 'calluna-td')
			));
		}

		/**
		 * Front-end display of widget.
		 *
		 */
		function widget( $args, $instance ) {
			echo $args['before_widget'];
			
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			
			if ( isset( $instance['username'] ) )
				echo '<div class="twitter-feed"><div class="tweets-feed" data-widget-id="'. $instance['username'] .'"></div></div>';
			
			echo $args['after_widget'];
		}

		// Widget Form
		function form( $instance ) {
			$defaults = array(
				'title' => 'Twitter Tweets', 
				'username' => ''
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			extract($instance);
		?>
		
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'calluna-td' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'username' )); ?>"><?php echo sprintf( wp_kses( __( 'Twitter Username', 'calluna-td' ), array(  'code' => array( ) ) ) ) ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'username' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'username' )); ?>" type="text" value="<?php echo esc_attr( $username ); ?>">
			</p>
			<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			return $new_instance;
		}	
	}
}

// Register the Calluna Twitter Widget
if ( ! function_exists( 'calluna_core_register_twitter_widget' ) ) {
	function calluna_core_register_twitter_widget() {
		register_widget( 'Calluna_Core_Twitter_Widget' );
	}
}
add_action( 'widgets_init', 'calluna_core_register_twitter_widget' );