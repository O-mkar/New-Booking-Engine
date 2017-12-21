<?php
/* ------------------------------------------------------------------------------- */
/* Calluna Rooms Widget
/* ------------------------------------------------------------------------------- */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Widget Class ------------------------------------------------------------------ */
if( !class_exists('calluna_rooms_widget') ){
	class calluna_rooms_widget extends WP_Widget {


		/* Constructor ---------------------------------------------------------------- */
		function __construct() {
			parent::__construct(FALSE, $name = esc_html__('Calluna Rooms', 'calluna-td'), array(
				'description' => esc_html__('List with rooms', 'calluna-td')
			));
		}

		/* Widget Output -------------------------------------------------------------- */

		function widget($args, $instance) {
			global $calluna_options;
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
			$custom_posts->query('post_type=room');
			while ($custom_posts->have_posts()) : $custom_posts->the_post();
			
			global $room;
		?>
		    <div class="room-widget">
        	<div class="row image-row">
        		<div class="col-sm-12">
                <?php echo get_the_post_thumbnail( get_the_id(), 'large', array( 'class' => 'img-responsive oscitas-res-image' ) ); ?>
              </div>
        	</div>
        	<div class="sidebar-post-wrapper">
              <div class="row title-row">
              		<div class="col-sm-12">
                    <h3><a href="<?php esc_url( the_permalink() ); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'calluna-td' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                  </div>
              </div>
              <div class="row price-row">
              		<div class="col-sm-12">
                        <div class="offer_price">
                        <?php
							$price = $room->calluna_get_min_price_html();
							echo sprintf( wp_kses(__('<span>starting at</span> %s' , 'calluna-td'), array( 'span' => array() ) ) , $price );
						?>
                        </div>
                  </div>
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
			global $calluna_options;

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

// Register the Calluna Rooms Widget
if ( ! function_exists( 'calluna_core_register_room_widget' ) ) {
	function calluna_core_register_room_widget() {
		register_widget( 'calluna_rooms_widget' );
	}
}
add_action( 'widgets_init', 'calluna_core_register_room_widget' );
?>