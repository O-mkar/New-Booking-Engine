<?php
/* ------------------------------------------------------------------------------- */
/* Calluna Events Widget
/* ------------------------------------------------------------------------------- */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/* Widget Class ------------------------------------------------------------------ */
if( !class_exists('calluna_events_widget') ){
	class calluna_events_widget extends WP_Widget {


		/* Constructor ---------------------------------------------------------------- */
		function __construct() {
			parent::__construct(FALSE, $name = esc_html__('Calluna Events', 'calluna-td'), array(
				'description' => esc_html__('List with events', 'calluna-td')
			));
		}

		/* Widget Output -------------------------------------------------------------- */

		function widget($args, $instance) {
			extract($args);

			/* Get the options into variables */
			$widget_title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : "";
			
			/* Unique ID */
			$unique_id = $args['widget_id'];

			echo $before_widget;
			if ($widget_title) {
				echo $before_title;
				echo $widget_title;
				echo $after_title;
			}

			/* Front End Output */
			?>
            
           <?php // Create and run custom loop
			$custom_posts = new WP_Query();
			$custom_posts->query('post_type=event');
			while ($custom_posts->have_posts()) : $custom_posts->the_post();
		?>
        	<div class="sidebar-post-wrapper">
           	<?php $event_month = date_i18n('F', strtotime(get_post_meta(get_the_ID(), "_calluna_event_date", true)));
        		  $event_day = date('d', strtotime(get_post_meta(get_the_ID(), "_calluna_event_date", true)));
        	?>
              <div class="row event-title-row">
              	<div class="col-xs-12">
                	<div class="inline_date_wrapper">
                	    <div class="day">
                            <?php echo esc_attr($event_day); ?>
                        </div>
                    	<div class="month">
                            <?php echo esc_attr($event_month); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                	<h3 class="event_title"><a href="<?php esc_url( the_permalink() );  ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'calluna-td' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                </div>
              </div>
           </div>
		<?php endwhile; ?>
			<?php
			echo $after_widget;
		}

		/* Update & Save -------------------------------------------------------------- */

		function update($new_instance, $old_instance) {
			return $new_instance;
		}

		/* Widget Form ---------------------------------------------------------------- */

		function form($instance) {

			/* Get the options into variables */
			$widget_title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : "";
			?>
			<!-- Widget Title -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__("Widget Title:", 'calluna-td'); ?></label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($widget_title); ?>"/>
			</p>
		<?php
		}
	}
}

// Register the Calluna Events Widget
if ( ! function_exists( 'calluna_core_register_event_widget' ) ) {
	function calluna_core_register_event_widget() {
		register_widget( 'calluna_events_widget' );
	}
}
add_action( 'widgets_init', 'calluna_core_register_event_widget' );
?>