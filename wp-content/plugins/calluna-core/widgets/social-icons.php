<?php
/* ------------------------------------------------------------------------------- */
/* Calluna Social Widget
/* ------------------------------------------------------------------------------- */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Widget Class ------------------------------------------------------------------ */
if( !class_exists('Calluna_Core_Twitter_Widget') ){
	class calluna_social_widget extends WP_Widget {
		/**
		 * Register widget with WordPress.
		 *
		 */
		function __construct() {
			parent::__construct(FALSE, $name = esc_html__('Calluna Social Links', 'calluna-shortcodes'), array(
				'description' => esc_html__('Social profile links with icons.', 'calluna-shortcodes')
			));
		}
	
		/* Widget Output -------------------------------------------------------------- */
	
		function widget($args, $instance) {
			extract($args);
	
			/* Get the options into variables */
			$widget_title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : "";
			$twitter      = isset($instance['twitter']) ? TRUE : FALSE;
			$facebook     = isset($instance['facebook']) ? TRUE : FALSE;
			$google       = isset($instance['google']) ? TRUE : FALSE;
			$instagram       = isset($instance['instagram']) ? TRUE : FALSE;
			$pinterest       = isset($instance['pinterest']) ? TRUE : FALSE;
			$tumblr       = isset($instance['tumblr']) ? TRUE : FALSE;
			$linkedin       = isset($instance['linkedin']) ? TRUE : FALSE;
			$youtube       = isset($instance['youtube']) ? TRUE : FALSE;
			$yelp       = isset($instance['yelp']) ? TRUE : FALSE;
			$tripadvisor       = isset($instance['tripadvisor']) ? TRUE : FALSE;
			$target             = isset( $instance['target'] ) ? $instance['target'] : 'blank';
            $target             = ( 'blank' == $target ) ? ' target="_blank"' : '';
	
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
			<ul class="footer-social">
				<?php if (get_theme_mod('twitter_account') != '' && $twitter == TRUE) { ?>
					<li>
						<a href="<?php echo esc_url( get_theme_mod('twitter_account') ); ?>"<?php echo $target ?>>
							<i class="icon-twitter"></i>
						</a>
					</li>
				<?php } ?>
				<?php if (get_theme_mod('facebook_account') != '' && $facebook == TRUE) { ?>
					<li>
						<a href="<?php echo esc_url( get_theme_mod('facebook_account') ); ?>"<?php echo $target ?>>
							<i class="icon-facebook"></i>
						</a>
					</li>
				<?php } ?>
				<?php if (get_theme_mod('google_account')!= '' && $google == TRUE) { ?>
					<li>
						<a href="<?php echo esc_url( get_theme_mod('google_account') ); ?>"<?php echo $target ?>>
							<i class="icon-google_plus"></i>
						</a>
					</li>
				<?php } ?>
				<?php if (get_theme_mod('instagram_account')!= '' && $instagram == TRUE) { ?>
					<li>
						<a href="<?php echo esc_url( get_theme_mod('instagram_account') ); ?>" <?php echo $target ?>>
							<i class="icon-instagram"></i>
						</a>
					</li>
				<?php } ?>
	            <?php if (get_theme_mod('pinterest_account')!= '' && $pinterest == TRUE) { ?>
					<li>
						<a href="<?php echo esc_url( get_theme_mod('pinterest_account') ); ?>" <?php echo $target ?>>
							<i class="icon-pinterest"></i>
						</a>
					</li>
				<?php } ?>
	            <?php if (get_theme_mod('tumblr_account')!= '' && $tumblr == TRUE) { ?>
					<li>
						<a href="<?php echo esc_url( get_theme_mod('tumblr_account') ); ?>" <?php echo $target ?>>
							<i class="icon-tumblr"></i>
						</a>
					</li>
				<?php } ?>
	            <?php if (get_theme_mod('linkedin_account')!= '' && $linkedin == TRUE) { ?>
					<li>
						<a href="<?php echo esc_url( get_theme_mod('linkedin_account') ); ?>" <?php echo $target ?>>
							<i class="icon-linkedin"></i>
						</a>
					</li>
				<?php } ?>
				<?php if (get_theme_mod('youtube_account')!= '' && $youtube == TRUE) { ?>
					<li>
						<a href="<?php echo esc_url( get_theme_mod('youtube_account') ); ?>" <?php echo $target ?>>
							<i class="fa fa-youtube"></i>
						</a>
					</li>
				<?php } ?>
				<?php if (get_theme_mod('yelp_account')!= '' && $yelp == TRUE) { ?>
					<li>
						<a href="<?php echo esc_url( get_theme_mod('yelp_account') ); ?>" <?php echo $target ?>>
							<i class="fa fa-yelp"></i>
						</a>
					</li>
				<?php } ?>
				<?php if (get_theme_mod('tripadvisor_account')!= '' && $tripadvisor == TRUE) { ?>
					<li>
						<a href="<?php echo esc_url( get_theme_mod('tripadvisor_account') ); ?>" <?php echo $target ?>>
							<i class="fa fa-tripadvisor"></i>
						</a>
					</li>
				<?php } ?>
			</ul>
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
			$widget_title	= isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : "";
			$twitter    	= isset($instance['twitter']) ? TRUE : FALSE;
			$facebook   	= isset($instance['facebook']) ? TRUE : FALSE;
			$google     	= isset($instance['google']) ? TRUE : FALSE;
			$pinterest  	= isset($instance['pinterest']) ? TRUE : FALSE;
			$tumblr     	= isset($instance['tumblr']) ? TRUE : FALSE;
			$linkedin   	= isset($instance['linkedin']) ? TRUE : FALSE;
			$instagram  	= isset($instance['instagram']) ? TRUE : FALSE;
			$youtube		= isset($instance['youtube']) ? TRUE : FALSE;
			$yelp   		= isset($instance['yelp']) ? TRUE : FALSE;
			$tripadvisor    = isset($instance['tripadvisor']) ? TRUE : FALSE;
			$target         = isset( $instance['target'] ) ? $instance['target'] : 'blank';
			?>
			<!-- Widget Title -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__("Widget Title:", 'calluna-shortcodes'); ?></label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($widget_title); ?>"/>
			</p>
			<p><?php esc_html_e("Select the social profiles you would like to display in this widget:", 'calluna-shortcodes'); ?></p>
			<!-- Facebook -->
			<p>
				<input class="checkbox" type="checkbox" <?php checked($facebook, TRUE); ?> id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>"/>
				<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php echo esc_html__('Facebook', 'calluna-shortcodes') ?></label>
			</p>
	        <!-- Twitter -->
			<p>
				<input class="checkbox" type="checkbox" <?php checked($twitter, TRUE); ?> id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>"/>
				<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php echo esc_html__('Twitter', 'calluna-shortcodes') ?></label>
			</p>
			<!-- Google+ -->
			<p>
				<input class="checkbox" type="checkbox" <?php checked($google, TRUE); ?> id="<?php echo esc_attr($this->get_field_id('google')); ?>" name="<?php echo esc_attr($this->get_field_name('google')); ?>"/>
				<label for="<?php echo esc_attr($this->get_field_id('google')); ?>"><?php echo esc_html__('Google+', 'calluna-shortcodes') ?></label>
			</p>
			<!-- Instagram -->
			<p>
				<input class="checkbox" type="checkbox" <?php checked($instagram, TRUE); ?> id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>"/>
				<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php echo esc_html__('Instagram', 'calluna-shortcodes') ?></label>
			</p>
	        <!-- Pinterest -->
			<p>
				<input class="checkbox" type="checkbox" <?php checked($pinterest, TRUE); ?> id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>"/>
				<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php echo esc_html__('Pinterest', 'calluna-shortcodes') ?></label>
			</p>
			<!-- Tumblr -->
			<p>
				<input class="checkbox" type="checkbox" <?php checked($tumblr, TRUE); ?> id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>"/>
				<label for="<?php echo esc_attr($this->get_field_id('tumblr')); ?>"><?php echo esc_html__('Tumblr', 'calluna-shortcodes') ?></label>
			</p>
	        <!-- LinkedIn -->
			<p>
				<input class="checkbox" type="checkbox" <?php checked($linkedin, TRUE); ?> id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>"/>
				<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php echo esc_html__('LinkedIn', 'calluna-shortcodes') ?></label>
			</p>
			<!-- Youtube -->
			<p>
				<input class="checkbox" type="checkbox" <?php checked($youtube, TRUE); ?> id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>"/>
				<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php echo esc_html__('Youtube', 'calluna-shortcodes') ?></label>
			</p>
			<!-- Yelp -->
			<p>
				<input class="checkbox" type="checkbox" <?php checked($yelp, TRUE); ?> id="<?php echo esc_attr($this->get_field_id('yelp')); ?>" name="<?php echo esc_attr($this->get_field_name('yelp')); ?>"/>
				<label for="<?php echo esc_attr($this->get_field_id('yelp')); ?>"><?php echo esc_html__('Yelp', 'calluna-shortcodes') ?></label>
			</p>
			<!-- Tripadvisor -->
			<p>
				<input class="checkbox" type="checkbox" <?php checked($tripadvisor, TRUE); ?> id="<?php echo esc_attr($this->get_field_id('tripadvisor')); ?>" name="<?php echo esc_attr($this->get_field_name('tripadvisor')); ?>"/>
				<label for="<?php echo esc_attr($this->get_field_id('tripadvisor')); ?>"><?php echo esc_html__('Tripadvisor', 'calluna-shortcodes') ?></label>
			</p>
			<p>
                <label for="<?php echo esc_attr($this->get_field_id('target')); ?>"><?php esc_html_e( 'Link Target:', 'calluna-shortcodes' ); ?></label>
                <br />
                <select class='calluna-widget-select' name="<?php echo esc_attr($this->get_field_name('target')); ?>" id="<?php echo esc_attr($this->get_field_id('target')); ?>">
                    <option value="blank" <?php if ($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php esc_html_e( 'Blank', 'calluna-shortcodes' ); ?></option>
                    <option value="self" <?php if ($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php esc_html_e( 'Self', 'calluna-shortcodes' ); ?></option>
                </select>
            </p>
		<?php
		}
	}
}

// Register the Calluna Social Widget
if ( ! function_exists( 'calluna_core_register_social_widget' ) ) {
	function calluna_core_register_social_widget() {
		register_widget( 'calluna_social_widget' );
	}
}
add_action( 'widgets_init', 'calluna_core_register_social_widget' );
?>