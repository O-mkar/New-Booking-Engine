<?php
/**
 * @package calluna
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container-fluid no-left-padding content_wrapper">
  	<div class="row">
	  	<div class="col-xs-12 col-md-2 date_wrapper">
        	<a href="<?php esc_url(the_permalink()) ?>">
        	<div class="post_date_wrapper">
                <div class="month">
                        <?php the_time('F') ?>
                </div>
                <div class="day">
                    <?php the_time('j') ?>
                </div>
            </div>
            </a>
        </div>
        <div class="col-xs-12 col-md-10 post_wrapper">
            <?php if(is_single()) { ?>
        	<div class="meta">
            	<div class="author">
                	<i class="icon-user_male"></i>
                	<?php the_author_posts_link(); ?>
                </div>
                <?php
                $categories_list = get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'calluna-td' ) );
		if ( $categories_list && calluna_categorized_blog() ) {
			printf( '<div class="categories"><i class="icon-folder"></i>%1$s</div>',
				$categories_list
			);
		} ?>
        		<?php if ( ! post_password_required() ) : ?>
                <div class="comments">
                	<i class="icon-comments"></i>
            		<span class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'calluna-td' ), esc_html__( '1 Comment', 'calluna-td' ), esc_html__( '% Comments', 'calluna-td' ) ); ?></span>
                </div>
                <?php endif; ?>
                <?php edit_post_link( esc_html__( 'Edit', 'calluna-td' ), '<div class="edit"><i class="fa fa-pencil"></i><span class="edit-link">', '</span></div>' ); ?>
            </div>
            <?php } ?>
        	<div class="content clearfix">
        	    <?php if (is_sticky() && is_home() && ! is_paged()) { ?>
                    <i class="icon-pin"></i>
        	    <?php } ?>

            	<?php the_content(wp_kses(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'calluna-td' ), array( 'span' => array( 'class' => array() ) ) ) ); ?>
            </div>
            <?php
                    wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'calluna-td' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'calluna-td' ) . ' </span>%',
			) );
                ?>
			<?php if(is_single() && get_theme_mod('post_tags', 'yes') != 'no') { ?>
				<div class="tagcloud">
					<?php the_tags('','',''); ?>
				</div>
			<?php } ?>
        </div>
    </div>
  </div>
  <?php if(get_theme_mod('share_on_post', 'yes') == 'yes' && is_single() ) { ?>
    <div class="container-fluid no-left-padding">
    	<div class="row">
        	<div class="col-xs-12 sharing-wrapper">
        	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
						<!-- Social Sharing -->
						<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
						<ul class="post-sharing">
                        	<li>
                            	<label><?php echo  esc_html__( 'Share Post', 'calluna-td' ); ?></label>
                            </li>
							<li>
								<a href="http://www.facebook.com/share.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank">
									<i class="icon-facebook"></i>
									<div class="calluna-tooltip"><?php esc_html_e( 'Share on Facebook', 'calluna-td' ); ?></div>
								</a></li>
							<li>
								<a href="https://twitter.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank">
									<i class="icon-twitter"></i>
									<div class="calluna-tooltip"><?php esc_html_e( 'Share on Twitter', 'calluna-td' ); ?></div>
								</a></li>
							<li>
								<a href="http://pinterest.com/pin/create/link/?url=<?php echo esc_url(get_permalink()); ?>" target="_blank">
									<i class="icon-pinterest"></i>
									<div class="calluna-tooltip"><?php esc_html_e( 'Share on Pinterest', 'calluna-td' ); ?></div>
								</a></li>
							<li>
								<a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank">
									<i class="icon-google_plus"></i>
									<div class="calluna-tooltip"><?php esc_html_e( 'Share on Google+', 'calluna-td' ); ?></div>
								</a></li>
						</ul>
        </div>
        </div>
    	
    </div>
    <?php } ?>
    
    <!-- Author meta data -->
	<?php if (is_single() && get_theme_mod('post_author', 'yes') != 'no') { ?>
    <div class="container-fluid no-left-padding">
    	<div class="row">
        	<div class="col-xs-12">
        	<div class="author-wrapper">
            	<div class="entry-header author">
                <h3>
                    <?php esc_html_e( 'Author', 'calluna-td' ); ?>
                </h3>
            </div>
            <div class="row author-meta">
            	<div class="col-xs-2">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					    <?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
                    </a>
                </div>
                <div class="col-xs-10">
                    <div class="name">
                    	<?php echo the_author_meta( 'display_name', get_the_author_meta( 'ID' ) ); ?>
                    </div>
                    <div class="info">
                    	<?php echo the_author_meta( 'description', get_the_author_meta( 'ID' ) ); ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    	
    </div>
	<?php } ?>
	<!-- prev and next post links -->
	<?php if (is_single() && get_theme_mod('post_nav', 'yes') != 'no') { ?>
    <div class="container-fluid no-left-padding">
    	<div class="row">
        	<div class="col-xs-6">
        	<div class="post_nav_wrapper">
            	<div class="prev-post">
                	<?php previous_post_link('%link'); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
        	<div class="post_nav_wrapper">
            	<div class="next-post">
                	<?php next_post_link('%link'); ?>
                </div>
            </div>
        </div>
        </div>
    </div>
	<?php } ?>
    <div class="container-fluid no-left-padding">
    	<div class="row">
        	<div class="col-xs-12">
            	<?php
					/* Post Comments */
					comments_template('', TRUE);
				?>
            </div>
        </div>
    </div>

</article><!-- #post-## -->

