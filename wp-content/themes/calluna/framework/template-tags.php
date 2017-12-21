<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package calluna
 */

if ( ! function_exists( 'calluna_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function calluna_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	
	// Previous/next page navigation.
	the_posts_pagination( array(
		'mid_size' => 2,
		'prev_text' => '<i class="icon-left"></i>',
		'next_text' => '<i class="icon-right"></i>',
	) );
}
endif;

if ( ! function_exists( 'calluna_pagination' ) ) {
    function calluna_pagination($numpages = '', $pagerange = '', $paged='') {

        if (empty($pagerange)) {
            $pagerange = 2;
        }

        /**
         * This first part of our function is a fallback
         * for custom pagination inside a regular loop that
         * uses the global $paged and global $wp_query variables.
         *
         * It's good because we can now override default pagination
         * in our theme, and use this function in default quries
         * and custom queries.
         */
        global $paged;
        if (empty($paged)) {
            $paged = 1;
        }
        if ($numpages == '') {
            global $wp_query;
            $numpages = $wp_query->max_num_pages;
            if(!$numpages) {
                $numpages = 1;
            }
        }

        /**
         * We construct the pagination arguments to enter into our paginate_links
         * function.
         */
        $pagination_args = array(
            'base'            => get_pagenum_link(1) . '%_%',
            'format'          => 'page/%#%',
            'total'           => $numpages,
            'current'         => $paged,
            'show_all'        => False,
            'end_size'        => 1,
            'mid_size'        => $pagerange,
            'prev_next'       => True,
            'prev_text'       => __('&laquo;'),
            'next_text'       => __('&raquo;'),
            'type'            => 'plain',
            'add_args'        => false,
            'add_fragment'    => ''
        );

        $paginate_links = paginate_links($pagination_args);

        if ($paginate_links) {
            echo "<nav class='custom-pagination'>";
            echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
            echo $paginate_links;
            echo "</nav>";
        }

    }
}

if ( ! function_exists( 'calluna_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function calluna_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( wp_kses(__( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'calluna-td' ), array(  'span' => array( 'class' => array() ) ) ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function calluna_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'calluna_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'calluna_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so calluna_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so calluna_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in calluna_categorized_blog.
 */
function calluna_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'calluna_categories' );
}
add_action( 'edit_category', 'calluna_category_transient_flusher' );
add_action( 'save_post',     'calluna_category_transient_flusher' );

/**
 * Custom output for the Comments template
 */

function calluna_custom_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' : ?>
            <li <?php comment_class(); ?> id="comment<?php comment_ID(); ?>">
            <div class="back-link"><?php comment_author_link(); ?></div>
        <?php break;
        default : ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <div class="comment-article">
 			<div class="row">
            	<div class="col-sm-2">
                	<?php echo get_avatar( $comment, 100 ); ?>
                </div>
                <div class="col-sm-10">
                	<div class="comment-body">
                    	<div class="comment-author">
                        	<span class="author-name"><?php comment_author(); ?></span>
                            <time datetime="<?php comment_time( 'c' ); ?>" class="comment-time">
                                <span class="date">
                                <?php comment_date(); ?>
                                </span>
                                <span class="time">
                                <?php comment_time(); ?>
                                </span>
                            </time>
                            <span class="reply pull-right">
								<?php 
                                    comment_reply_link( array_merge( $args, array( 
                                    'reply_text' => 'Reply',
									'before' => '<i class="icon-reply"></i>',
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'] 
                                    ) ) ); 
                                ?>
							</span><!-- .reply -->
                        </div>
                        <div class="comment-text">
                        	<?php comment_text(); ?>
                        </div>
                    </div>
                </div>
            </div>
            </div><!-- #comment-<?php comment_ID(); ?> -->
        <?php // End the default styling of comment
        break;
    endswitch;
}

if ( ! function_exists( 'calluna_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see get_url_in_content()
 *
 * @return string The Link format URL.
 */
function calluna_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;
