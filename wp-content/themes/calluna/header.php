<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package calluna
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  	
    <?php if( get_theme_mod( 'loader', 'no' ) == 'yes' ) { ?>
  	<div id="loader" class="loader-style">
        <div class="loader-container">
            <div class="spinner">
                <div class="spinner-container"></div>
            </div>
        </div>
    </div>
    <?php } ?>
  	<div id="page" class="hfeed site">
      <!-- Header -->
      <header id="masthead" class="site-header">
      <?php 
	  		//check if we're on the blog page.
			 if( is_home() )
			 {
				 //On the blog page get the id with get_queried_object_id
				$overwrite_pos = get_post_meta( get_queried_object_id(), '_calluna_header_nav_radio', true );
			 }
			 else {
				$overwrite_pos = get_post_meta( get_the_ID(), '_calluna_header_nav_radio', true );
			 }
			 
      		 $nav_pos = get_theme_mod( 'navigation_style', 'left-nav' );
			 
			 $pos;
			 if($overwrite_pos == '')
			 {
				 $pos = $nav_pos;
				 $nav_col = $nav_pos;
				 $nav_logo_col = $nav_pos;
			 }
			 else
			 {
				 $pos = $overwrite_pos;
				 $nav_col = $overwrite_pos;
				 $nav_logo_col = $overwrite_pos;
			 }

			 $nav_col .= '-col';
			 $nav_logo_col .= '-logo-col';
	  ?>
      <?php $nav_style = get_theme_mod( 'main_navigation_sticky', 'sticky' ) ?>
        <nav class="navigation <?php echo esc_attr($pos) ?> <?php echo esc_attr($nav_style) ?>">
          <div class="container-fluid">
            <div class="row">
              <!-- Logo -->
              <div class="<?php echo esc_attr($nav_logo_col) ?> col-xs-3 col-sm-2">
                <!-- normal size logo -->
                <div class="logo logo-wrapper">
				  <?php if ( get_theme_mod( 'logo_img', get_stylesheet_directory_uri() . '/img/logo.png' ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="site-logo" title="<?php echo esc_attr( get_bloginfo( 'name','display' ) ); ?>" rel="home">             
                  <img class="img-responsive" src="<?php echo esc_url( get_theme_mod( 'logo_img', get_stylesheet_directory_uri() . '/img/logo.png' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
				<?php endif; ?>
                </div>
                <!-- small size logo, only used in shrink mode -->
                <div class="small-logo-wrapper">
				  <?php if ( get_theme_mod( 'small_img', get_stylesheet_directory_uri() . '/img/small_logo.png' ) ) : ?>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="site-logo-small" title="<?php echo esc_attr( get_bloginfo( 'name','display' ) ); ?>" rel="home">             
                    <img class="img-responsive" src="<?php echo esc_url( get_theme_mod( 'small_img', get_stylesheet_directory_uri() . '/img/small_logo.png' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a><?php endif; ?>
                </div>
              </div>
              <!-- Menu -->
              <div class="nav-col <?php echo esc_attr($nav_col) ?> col-xs-9 col-sm-10">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="show-menu"><span><i></i></span></div>
                    <?php if( function_exists('icl_get_languages') && 'yes' == get_theme_mod('header_show_wpml','yes') ){ ?>
                      <div class="topbar-wpml pull-right">
                        <?php get_template_part('inc/headers/content-header', 'wpml'); ?>
                      </div>
                    <?php } ?>
					<?php
                    $page_menu = get_post_meta( get_the_ID(), '_calluna_header_custom_menu', true );
                    
                    if ($page_menu != '') {
                        wp_nav_menu( array(
                            'theme_location' => 'main_menu',
                            'menu'              => $page_menu,
                            'container'  => 'div',
                            'container_class' => 'nav-menu',
                            'menu_class' => 'menu',
                            'menu_id' => '',
                            'walker' => new calluna_header_walker_nav_menu()
                        ));

                    }
                    else {
                        wp_nav_menu( array(
                            'theme_location' => 'main_menu',
                            'container'  => 'div',
                            'container_class' => 'nav-menu',
                            'menu_class' => 'menu',
                            'menu_id' => '',
                            'walker' => new calluna_header_walker_nav_menu()
                        ));
                    }
                ?>
              </div>
            </div>
          </div>
        </nav>
      </header>
      <div class="mobile-nav">
        <span class="close-mobile-nav">&times;</span>
        <div class="mobile-menu">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'responsive_menu',
                    'container'  => '',
                    'container_class' => 'nav-menu',
                    'menu_class' => '',
                    'menu_id' => '',
                ));
            ?>
            <?php if( function_exists('icl_get_languages') && 'yes' == get_theme_mod('header_show_wpml','yes') ){ ?>
                <?php $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=custom' ); ?>
                <span class="mobile-language-title"><?php esc_html_e('Languages', 'calluna-td'); ?></span>
                <ul class="language-menu">
                    <?php
                    if(!( empty($languages) )){
                        foreach($languages as $l){
                            echo '<li><a href="'.$l['url'].'">'.$l['native_name'].'</a></li>';
                        }
                    }
                    ?>
                </ul>
            <?php } ?>
        </div>
	</div>
      
      <!-- Begin of content -->
      <div id="content" class="site-content">