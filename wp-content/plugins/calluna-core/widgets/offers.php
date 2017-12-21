<?php
/* ------------------------------------------------------------------------------- */
/* Calluna Offers Widget
/* ------------------------------------------------------------------------------- */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Widget Class ------------------------------------------------------------------ */
if( !class_exists('calluna_offers_widget') ){
	class calluna_offers_widget extends WP_Widget {
		
		/* Constructor ---------------------------------------------------------------- */
		function __construct() {
			parent::__construct(FALSE, $name = esc_html__('Calluna Offers', 'calluna-td'), array(
				'description' => esc_html__('List with offers', 'calluna-td')
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
			$custom_posts->query('post_type=offer');
			while ($custom_posts->have_posts()) : $custom_posts->the_post();
		?>
        	<div class="sidebar-post-wrapper">
           	<div class="row image-row">
            		<div class="col-sm-12">
                    <?php echo get_the_post_thumbnail( get_the_id(), 'medium', array( 'class' => 'img-responsive oscitas-res-image' ) ); ?>
                  </div>
            	</div>
              <div class="row title-row">
              		<div class="col-sm-12">
                    <h3><a href="<?php esc_url( the_permalink() ); ?>" title="<?php printf( esc_html__( 'Permalink to %s', 'calluna-td' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                  </div>
              </div>
                <?php $price = get_post_meta(get_the_id(), '_calluna_offer_price', true); ?>
                <?php if($price != '') { ?>

              <div class="row price-row">
              		<div class="col-sm-12">
                    <div class="offer_price">
                    <?php 
							$currency_symbol = get_theme_mod('currency', '$');

							$price_text = get_theme_mod( 'offer_price_text', 'Price per person');
							$price_text = calluna_translate_theme_mod( 'offer_price_text', $price_text );

							if (get_theme_mod('currency_pos', 'before') == 'before') {
								echo sprintf( wp_kses(__('<span>%s</span> %1s%2s' , 'calluna-td'), array( 'span' => array() ) ) , $price_text, $currency_symbol, $price );
							} else {
								echo sprintf( wp_kses(__('<span>%s</span> %1s%2s' , 'calluna-td'), array( 'span' => array() ) ) , $price_text, $price, $currency_symbol );
							}					 
							?>
                    </div>
                  </div>
              </div>
                <?php } ?>
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
	
// Register the Calluna Offers Widget
if ( ! function_exists( 'calluna_core_register_offer_widget' ) ) {
	function calluna_core_register_offer_widget() {
		register_widget( 'calluna_offers_widget' );
	}
}
add_action( 'widgets_init', 'calluna_core_register_offer_widget' );
?>