<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php global $boxshop_theme_options, $boxshop_page_datas; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php if( isset($boxshop_theme_options['ts_responsive']) && $boxshop_theme_options['ts_responsive'] == 1 ): ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
	<?php endif; ?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php 
	boxshop_theme_favicon();
	wp_head(); 
	?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<?php if( !is_page_template('page-templates/blank-page-template.php') ): ?>

		<!-- Page Slider -->
		<?php if( is_page() && isset($boxshop_page_datas) ): ?>
			<?php if( $boxshop_page_datas['ts_page_slider'] && $boxshop_page_datas['ts_page_slider_position'] == 'before_header' ): ?>
			<div class="top-slideshow">
				<div class="top-slideshow-wrapper">
					<?php boxshop_show_page_slider(); ?>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="mobile-menu-wrapper">
			<span class="ic-mobile-menu-close-button"><i class="fa fa-remove"></i></span>
			<?php 
			if ( has_nav_menu( 'mobile' ) ) {
				wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'mobile' ) );
			}else{
				wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'primary') );
			}
			?>
		</div>
		
		<?php boxshop_get_header_template(); ?>
		
	<?php endif; ?>
	
	<?php do_action('boxshop_before_main_content'); ?>

	<div id="main" class="wrapper">
