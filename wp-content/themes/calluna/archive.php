<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package calluna
 */

get_header(); ?>

<?php
	/* get revolution slider from shortcode in custom field*/
	$headerText;
	
	if ( is_category() ) :
		$headerText = single_cat_title( '', false );

	elseif ( is_tag() ) :
		$headerText = single_tag_title( '', false );

	elseif ( is_author() ) :
		$headerText = get_the_author();

	elseif ( is_day() ) :
		$headerText = sprintf( esc_html__( 'Day: %s', 'calluna-td' ), get_the_date() );

	elseif ( is_month() ) :
		$headerText = sprintf( esc_html__( 'Month: %s', 'calluna-td' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'calluna-td' ) ) );

	elseif ( is_year() ) :
		$headerText = sprintf( esc_html__( 'Year: %s', 'calluna-td' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'calluna-td' ) ));

	elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
		$headerText = esc_html__( 'Asides', 'calluna-td' );

	elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
		$headerText = esc_html__( 'Galleries', 'calluna-td');

	elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
		$headerText = esc_html__( 'Images', 'calluna-td');

	elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
		$headerText = esc_html__( 'Videos', 'calluna-td' );

	elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
		$headerText = esc_html__( 'Quotes', 'calluna-td' );

	elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
		$headerText = esc_html__( 'Links', 'calluna-td' );

	elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
		$headerText = esc_html__( 'Statuses', 'calluna-td' );

	elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
		$headerText = esc_html__( 'Audios', 'calluna-td' );

	elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
		$headerText = esc_html__( 'Chats', 'calluna-td' );

	else :
		$headerText = esc_html__( 'Archives', 'calluna-td' );

	endif;
	
	$color = get_theme_mod('header_bg_color', '#0C2149');
	$header_title_pos = get_theme_mod('header_title_pos', 'text-left');
                  $shortcodeColor = '<div class="color-background" style="background-color:';
				  	$shortcodeColor .= $color;
					$shortcodeColor.= ';">';
					$shortcodeColor .= '<h1 class="header_text_wrapper ' . esc_attr($header_title_pos) . '"><span>' . esc_attr($headerText) . '</span><span class="separator"></span></h1>';
					$shortcodeColor .= '</div>';
				  	echo do_shortcode($shortcodeColor); ?>
    <div class="no-padding container-fluid">
    	<div class="row row-eq-height">
    	<?php $sidebar_pos = get_theme_mod( 'blog_position_sidebar', 'right' );
        if($sidebar_pos == 'right')
		{ ?>
		<div class="col-sm-12 col-md-8 col-lg-8 content_row">
        	<div id="primary" class="content-area archive">
                <main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php calluna_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
			</div><!-- #primary -->
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 sidebar_wrapper">
        	<div class="sidebar">
            	<?php if ( is_active_sidebar( 'blog' ) ) { ?>
					<?php dynamic_sidebar( 'blog' ); ?>
                <?php } ?>   
            </div>
        </div>	
					
		<?php }elseif ($sidebar_pos == 'left') { ?>
			<div class="col-sm-12 col-md-4 col-lg-4 sidebar_wrapper">
        	<div class="sidebar">
            	<?php if ( is_active_sidebar( 'blog' ) ) { ?>
					<?php dynamic_sidebar( 'blog' ); ?>
                <?php } ?>   
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
        	<div id="primary" class="content-area archive">
                <main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php calluna_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
			</div><!-- #primary -->
        </div>
		<?php }
		else 
		{ ?>
        <div class="col-sm-12 col-md-12 col-lg-12">
        	<div id="primary" class="content-area archive">
                <main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php calluna_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
			</div><!-- #primary -->
        </div>
		<?php } ?>
    </div>
    </div>
<?php get_footer(); ?>