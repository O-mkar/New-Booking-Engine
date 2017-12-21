<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package calluna
 */
?>

<section class="no-results not-found">
	<div class="container-fluid">
    	<div class="content_wrapper">
        	<div class="row">
            	<div class="col-sm-12">
                	<h2 class="title"><?php esc_html_e( 'Nothing Found', 'calluna-td' ); ?></h2>
            <div class="page-content">
                <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
        
                    <p><?php printf( wp_kses(__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'calluna-td' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
        
                <?php elseif ( is_search() ) : ?>
        
                    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'calluna-td' ); ?></p>
        
                <?php else : ?>
        
                    <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'calluna-td' ); ?></p>
        
                <?php endif; ?>
            </div><!-- .page-content -->
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12 col-md-8 col-lg-6">
                	<?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
</section><!-- .no-results -->
