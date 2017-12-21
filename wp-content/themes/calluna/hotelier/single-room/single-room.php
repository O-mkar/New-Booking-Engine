<?php
/**
 * The Template for displaying all single rooms
 *
 * This template can be overridden by copying it to yourtheme/hotelier/single-room/single-room.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'inc/pagetitle/pagetitle-single' ); 
global $room;
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content content-width room">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="room-content no-padding container-fluid">
						<!-- Content + booking -->
						<div class="row row-eq-height">
							<div class="col-sm-12 col-lg-6 col-md-12 col-xs-12 container-left">
								<?php the_content(); ?>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-12 col-xs-12 container-right accent-background">
								<div class="booking-column">
									<?php echo do_shortcode('[cl_booking_calendar]'); ?>
								</div>
							</div>
						</div>
						<!-- Amenities -->
						<?php $amenities = get_post_meta($post->ID,'_calluna_room_amenities',true);?>
						<?php if ( ! empty( $amenities ) ) { ?>
							<div class="row row-eq-height">
								<div class="col-sm-12 col-lg-6 col-md-12 col-xs-12 vertical-align column-style-2" <?php if ( get_theme_mod( 'column_style2_background_img' ) ) { ?>
									style="background-image: url(<?php echo esc_url( get_theme_mod( 'column_style2_background_img')); ?>);"
								<?php } ?>>

									<div class="amenities_wrapper">
										<?php
										$amenities_title = get_theme_mod( 'room_amenities_title', 'Amenities');
										// WPML translations
										$amenities_title = calluna_translate_theme_mod( 'room_amenities_title', $amenities_title ); ?>
										<h2><?php esc_html_e( $amenities_title ); ?></h2>
										<p class="teaser">
											<?php echo get_post_meta($post->ID,'_calluna_room_amenities_description',true);?>
										</p>
									</div>
								</div>
								<div class="col-sm-12 col-lg-6 col-md-12 col-xs-12">
									<div class="amenities_items_wrapper">
										<?php foreach (array_chunk($amenities, 2, true) as $array)
										{?>
											<div class="row">
												<?php foreach($array as $item)
												{ ?>
													<div class="col-sm-6">
														<label>
															<?php echo esc_attr($item['title']);?>
														</label>
														<p class="item-text">
															<?php echo do_shortcode($item['description']);?>
														</p>
													</div>
												<?php }?>
											</div>
										<?php }?>
									</div>

								</div>
							</div>
						<?php }?>
						<!-- Gallery -->
						<?php 
						
						$gallery_images = array();
						
						$attachment_ids = $room->get_gallery_attachment_ids();

						foreach ( $attachment_ids as $attachment_id ) {
							$attachment  = wp_get_attachment_image_src( $attachment_id, 'full' );
						
							if ( ! $attachment ) {
								continue;
							}
						
							$attachment_link    = $attachment[ 0 ];
							$attachment_width   = $attachment[ 1 ];
							$attachment_height  = $attachment[ 2 ];
							$attachment_title   = get_post_field( 'post_title', $attachment_id );
							$attachment_caption = get_post_field( 'post_excerpt', $attachment_id );
						
							$gallery_images[] = array(
								'id'	 => $attachment_id,
								'name'   => $attachment_title,
								'url'    => $attachment_link,
								'title'  => $attachment_caption,
								'width'  => $attachment_width,
								'height' => $attachment_height,
							);
						}
						
						?>
						
						<?php if ( $gallery_images ) :
							$i = 0; ?>
						<div class="row row-eq-height">
								<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 vertical-align column-style-1" <?php if ( get_theme_mod( 'column_style1_background_img' ) ) { ?>
									style="background-image: url(<?php echo esc_url( get_theme_mod( 'column_style1_background_img')); ?>);"
								<?php } ?>>

									<div class="desc_wrapper_left">
										<?php
										$gallery_title = get_theme_mod( 'room_gallery_title', 'Gallery');
										// WPML translations
										$gallery_title = calluna_translate_theme_mod( 'room_gallery_title', $gallery_title ); ?>
										<h2><?php esc_html_e( $gallery_title ); ?></h2>
										<p class="teaser">
											<?php echo esc_attr(get_post_meta($post->ID,'_calluna_gallery_description',true));?>
										</p>
									</div>
								</div>
								<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 content_row">
									<div class="wpb_wrapper">
										<div id="bootstrap-carousel" class="carousel slide" data-ride="carousel">
											<div class="carousel-inner">
												<?php foreach ( $gallery_images as $gallery_image ) : ?>
													<div class="item <?php echo esc_attr($i) == 0 ? 'active' : ''; ?>">
                                                        <?php $image_big_src = wp_get_attachment_image_src($gallery_image['id'], 'full'); ?>
														<a href="<?php echo esc_url( $image_big_src[0] ); ?>" class="link_image lightbox" data-lightbox-gallery="gallery-<?php esc_attr_e($post->ID); ?>"><?php echo wp_get_attachment_image($gallery_image['id'], 'full'); ?></a>
													</div>
												<?php $i ++;
												endforeach; ?>
											</div>

											<div class="gallery_button_wrapper">
												<a class="left carousel-control" href="#bootstrap-carousel" data-slide="prev">
													<span class="icon-left"></span>
												</a>
											</div>
											<div class="gallery_button_wrapper">
												<a class="right carousel-control" href="#bootstrap-carousel" data-slide="next">
													<span class="icon-right"></span>
												</a>
											</div>
										</div>
									</div>

								</div>
							</div>
							
						<?php endif; ?>
					
						<!-- Related Rooms -->

						<?php
						$post_ID = get_the_ID();
						$custom_loop = new WP_Query(array(
							'post_type'      => 'room',
							'post__not_in' => array( $post_ID ),
						));
						?>
						<?php if ($custom_loop->have_posts() && get_theme_mod('related_rooms', 'yes') != 'no') { ?>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 content_row">
									<div>
										<?php echo do_shortcode('[cl_room_carousel img_height="510" img_width="420"]'); ?>
									</div>
								</div>
							</div>
						<?php } ?>
                        <?php
                            $map_lat = get_post_meta($post->ID, '_calluna_room_map_lat', true);
                            $map_lng = get_post_meta($post->ID, '_calluna_room_map_lng', true);
                        ?>
                        <?php if (get_theme_mod('show_room_map', 'yes') != 'no' && $map_lat != '' && $map_lng != ''){ ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 content_row">
                                    <div>
 
                                        <?php
                                            $map_type = get_post_meta($post->ID, '_calluna_room_map_type', true);
                                            $map_style = get_post_meta($post->ID, '_calluna_room_map_style', true);
                                            $map_height = get_post_meta($post->ID, '_calluna_room_map_height', true);
                                            $map_zoom = get_post_meta($post->ID, '_calluna_room_map_zoom', true);
                                            $map_marker = get_post_meta($post->ID, '_calluna_room_map_marker', true);
                                            $api_key = get_post_meta($post->ID, '_calluna_room_map_api_key', true);

                                            $shortcode = '[cl_google_map';
                                            $shortcode .= ' map_type="' . $map_type . '"';
                                            $shortcode .= ' style="' . $map_style . '"';
                                            $shortcode .= ' height="' . $map_height . '"';
                                            $shortcode .= ' lat="' . $map_lat . '"';
                                            $shortcode .= ' lng="' . $map_lng . '"';
                                            $shortcode .= ' zoom="' . $map_zoom . '"';
                                            $shortcode .= ' marker="' . $map_marker . '"';
                                            $shortcode .= ' api_key="' . $api_key . '"';
                                            $shortcode .= ']';
                                            echo do_shortcode($shortcode);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

					</div><!-- .entry-content -->

				</div><!-- #post-## -->

			<?php endwhile; endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
