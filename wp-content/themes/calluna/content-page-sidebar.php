<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package calluna
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    $top_padding = get_post_meta(get_the_ID(), '_calluna_page_top_padding_select', true);
    $bottom_padding = get_post_meta(get_the_ID(), '_calluna_page_bottom_padding_select', true);
    ?>
	<div class="page-sidebar-content <?php echo esc_attr($top_padding) . ' ' . esc_attr($bottom_padding) ?> container-fluid content-wrapper">
		<?php the_content(); ?>
        <div class="vc_row wpb_row vc_row-fluid" style="height:0">
            <div class="wpb_column vc_column_container vc_col-sm-12"></div>
        </div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
