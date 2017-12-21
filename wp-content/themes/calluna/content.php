<?php
/**
 * @package calluna
 */
?>

<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
	<?php if (has_post_thumbnail()) { ?>
	    <div class="image_wrapper">
        	<?php printf( '<a href="%s" class="link">%s</a>', esc_url( get_permalink() ), get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'img-responsive' ) ) ); ?>
        	<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
                <span class="sticky-post pull-right">
                    <i class="icon-pin"></i>
                </span>
            <?php } ?> 
        </div>	
    <?php } ?>
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
            <?php if(! has_post_thumbnail() && is_sticky() && is_home() && ! is_paged()) : ?>
            	<?php the_title( sprintf( '<header class="entry-header"><i class="icon-pin"></i><h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3></header>' ); ?>
            <?php else : ?>
                <?php the_title( sprintf( '<header class="entry-header"><h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3></header>' ); ?>
            <?php endif; ?>
            <!-- .entry-header -->
            <?php if ( !is_single()) : // Only display Excerpts for Search ?>
            <div class="entry-summary">
                <?php echo wp_kses_post(calluna_custom_excerpt(50)); ?>
            </div><!-- .entry-summary -->
            <?php else : ?>
            <div class="entry-content clearfix">
                <?php the_content( wp_kses(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'calluna-td' ), array( 'span' => array( 'class' => array() ) ) ) ); ?>
                <?php
                    wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'calluna-td' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'calluna-td' ) . ' </span>%',
			) );
                ?>
            </div><!-- .entry-content -->
		  	<div class="tagcloud">
            	<?php the_tags('','',''); ?>
            </div>
            <?php endif; ?>
        	
        </div>
    </div>
    </div>
</article><!-- #post-## -->
