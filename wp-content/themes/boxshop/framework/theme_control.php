<?php 
/*** Template Redirect ***/
add_action('template_redirect', 'boxshop_template_redirect');
function boxshop_template_redirect(){
	global $wp_query, $post, $boxshop_page_datas, $boxshop_theme_options;
	
	/* Get Page Options */
	if( is_page() || is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( is_page() ){
			$page_id = $post->ID;
		}
		if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
			$page_id = get_option('woocommerce_shop_page_id', 0);
		}
		$post_custom = get_post_custom( $page_id );
		if( !is_array($post_custom) ){
			$post_custom = array();
		}
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$boxshop_page_datas[$key] = $value[0];
			}
		}
		$page_option_default = array(
							'ts_layout_style'						=> 'default'
							,'ts_page_layout'						=> '0-1-0'
							,'ts_left_sidebar'						=> ''
							,'ts_right_sidebar'						=> ''
							,'ts_header_layout'						=> 'default'
							,'ts_top_header_transparent'			=> 0
							,'ts_top_header_text_color'				=> 'default'
							,'ts_menu_id'							=> 0
							,'ts_display_vertical_menu_by_default'	=> 0
							,'ts_breadcrumb_layout'					=> 'default'
							,'ts_breadcrumb_bg_parallax'			=> 'default'
							,'ts_bg_breadcrumbs'					=> ''
							,'ts_logo'								=> ''
							,'ts_logo_mobile'						=> ''
							,'ts_logo_sticky'						=> ''
							,'ts_show_breadcrumb'					=> 1
							,'ts_show_page_title'					=> 1
							,'ts_page_slider'						=> 0
							,'ts_page_slider_position'				=> 'before_main_content'
							,'ts_rev_slider'						=> 0
							);
							
		$boxshop_page_datas = boxshop_array_atts($page_option_default, $boxshop_page_datas);
		
		if( $boxshop_page_datas['ts_layout_style'] != 'default' ){
			$boxshop_theme_options['ts_layout_style'] = $boxshop_page_datas['ts_layout_style'];
		}
		
		if( $boxshop_page_datas['ts_header_layout'] != 'default' ){
			$boxshop_theme_options['ts_header_layout'] = $boxshop_page_datas['ts_header_layout'];
		}
		
		if( $boxshop_page_datas['ts_breadcrumb_layout'] != 'default' ){
			$boxshop_theme_options['ts_breadcrumb_layout'] = $boxshop_page_datas['ts_breadcrumb_layout'];
		}
		
		if( $boxshop_page_datas['ts_breadcrumb_bg_parallax'] != 'default' ){
			$boxshop_theme_options['ts_breadcrumb_bg_parallax'] = $boxshop_page_datas['ts_breadcrumb_bg_parallax'];
		}
		
		if( trim($boxshop_page_datas['ts_bg_breadcrumbs']) != '' ){
			$boxshop_theme_options['ts_bg_breadcrumbs'] = $boxshop_page_datas['ts_bg_breadcrumbs'];
		}
		
		if( trim($boxshop_page_datas['ts_logo']) != '' ){
			$boxshop_theme_options['ts_logo'] = $boxshop_page_datas['ts_logo'];
		}
		
		if( trim($boxshop_page_datas['ts_logo_mobile']) != '' ){
			$boxshop_theme_options['ts_logo_mobile'] = $boxshop_page_datas['ts_logo_mobile'];
		}
		
		if( trim($boxshop_page_datas['ts_logo_sticky']) != '' ){
			$boxshop_theme_options['ts_logo_sticky'] = $boxshop_page_datas['ts_logo_sticky'];
		}
		
		if( $boxshop_page_datas['ts_menu_id'] ){
			add_filter('wp_nav_menu_args', 'boxshop_filter_wp_nav_menu_args');
		}
	}
	
	/* Archive - Category product */
	if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') || (function_exists('dokan_is_store_page') && dokan_is_store_page()) ){
		boxshop_set_header_breadcrumb_layout_woocommerce_page( 'shop' );
	
		add_action( 'wp_enqueue_scripts', 'boxshop_grid_list_desc_style', 1000 );
		
		boxshop_remove_hooks_from_shop_loop();
		
		if( function_exists('dokan_is_store_page') && dokan_is_store_page() && !$boxshop_theme_options['ts_prod_cat_grid_desc'] ){
			remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_short_description', 40);
		}
		
		/* Update product category layout */
		if( is_tax('product_cat') ){
			$term = $wp_query->queried_object;
			if( !empty($term->term_id) ){
				$bg_breadcrumbs_id = get_term_meta($term->term_id, 'bg_breadcrumbs_id', true);
				$layout = get_term_meta($term->term_id, 'layout', true);
				$left_sidebar = get_term_meta($term->term_id, 'left_sidebar', true);
				$right_sidebar = get_term_meta($term->term_id, 'right_sidebar', true);
				
				if( $bg_breadcrumbs_id != '' ){
					$bg_breadcrumbs_src = wp_get_attachment_url( $bg_breadcrumbs_id );
					if( $bg_breadcrumbs_src !== false ){
						$boxshop_theme_options['ts_bg_breadcrumbs'] = $bg_breadcrumbs_src;
					}
				}
				if( $layout != '' ){
					$boxshop_theme_options['ts_prod_cat_layout'] = $layout;
				}
				if( $left_sidebar != '' ){
					$boxshop_theme_options['ts_prod_cat_left_sidebar'] = $left_sidebar;
				}
				if( $right_sidebar != '' ){
					$boxshop_theme_options['ts_prod_cat_right_sidebar'] = $right_sidebar;
				}
			}
		}
	}
	
	/* single post */
	if( is_singular('post') ){
		$post_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$post_data[$key] = $value[0];
			}
		}
		
		$boxshop_theme_options['ts_blog_details_layout'] = (isset($post_data['ts_post_layout']) && $post_data['ts_post_layout']!='0')?$post_data['ts_post_layout']:$boxshop_theme_options['ts_blog_details_layout'];
		$boxshop_theme_options['ts_blog_details_left_sidebar'] = (isset($post_data['ts_post_left_sidebar']) && $post_data['ts_post_left_sidebar']!='0')?$post_data['ts_post_left_sidebar']:$boxshop_theme_options['ts_blog_details_left_sidebar'];
		$boxshop_theme_options['ts_blog_details_right_sidebar'] = (isset($post_data['ts_post_right_sidebar']) && $post_data['ts_post_right_sidebar']!='0')?$post_data['ts_post_right_sidebar']:$boxshop_theme_options['ts_blog_details_right_sidebar'];
		
		/* Update Post Views Count */
		$is_crawler = false;
		if( function_exists('ts_crawler_detect') && ts_crawler_detect() ){
			$is_crawler = true;
		}
		if( !isset( $_COOKIE['ts_post_view_'.$post->ID] ) && !$is_crawler ){
			setcookie('ts_post_view_'.$post->ID, '1', time()+86400, '/'); /* set cookie 1 day */
			$views_count = get_post_meta($post->ID, '_ts_post_views_count', true);
			if( $views_count ){
				$views_count++;
				update_post_meta($post->ID, '_ts_post_views_count', $views_count);
			}
			else{
				update_post_meta($post->ID, '_ts_post_views_count', 1);
			}
		}
		
		/* Breadcrumb */
		$bg_breadcrumbs = get_post_meta($post->ID, 'ts_bg_breadcrumbs', true);
		if( !empty($bg_breadcrumbs) ){
			$boxshop_theme_options['ts_bg_breadcrumbs'] = $bg_breadcrumbs;
		}
	}
	
	/* Single product */
	if( is_singular('product') ){
		
		/* Add vertical thumbnail class */
		if( $boxshop_theme_options['ts_prod_thumbnails_style'] == 'vertical' ){
			add_filter('post_class', function($classes){
				$classes[] = 'vertical-thumbnail';
				return $classes;
			});
		}
		
		/* Remove hooks on Related and Up-Sell products */
		boxshop_remove_hooks_from_shop_loop();
		if( ! $boxshop_theme_options['ts_prod_cat_grid_desc'] ){
			remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_short_description', 40);
		}
	
		$prod_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$prod_data[$key] = $value[0];
			}
		}
		
		$boxshop_theme_options['ts_prod_layout'] = (isset($prod_data['ts_prod_layout']) && $prod_data['ts_prod_layout']!='0')?$prod_data['ts_prod_layout']:$boxshop_theme_options['ts_prod_layout'];
		$boxshop_theme_options['ts_prod_left_sidebar'] = (isset($prod_data['ts_prod_left_sidebar']) && $prod_data['ts_prod_left_sidebar']!='0')?$prod_data['ts_prod_left_sidebar']:$boxshop_theme_options['ts_prod_left_sidebar'];
		$boxshop_theme_options['ts_prod_right_sidebar'] = (isset($prod_data['ts_prod_right_sidebar']) && $prod_data['ts_prod_right_sidebar']!='0')?$prod_data['ts_prod_right_sidebar']:$boxshop_theme_options['ts_prod_right_sidebar'];
		
		if( !$boxshop_theme_options['ts_prod_thumbnail'] ){
			remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
		}
		
		if( $boxshop_theme_options['ts_prod_title'] && isset($boxshop_theme_options['ts_prod_title_in_content']) && $boxshop_theme_options['ts_prod_title_in_content'] ){
			$boxshop_theme_options['ts_prod_title'] = 0; /* remove title above breadcrumb */
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 1);
		}
		
		if( !$boxshop_theme_options['ts_prod_label'] ){
			remove_action('boxshop_before_product_image', 'boxshop_template_loop_product_label', 10);
		}
		
		if( !$boxshop_theme_options['ts_prod_rating'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 2);
		}
		
		if( !$boxshop_theme_options['ts_prod_sku'] ){
			remove_action('woocommerce_single_product_summary', 'boxshop_template_single_sku', 5);
		}
		
		if( !$boxshop_theme_options['ts_prod_availability'] ){
			remove_action('woocommerce_single_product_summary', 'boxshop_template_single_availability', 4);
		}
		
		if( !$boxshop_theme_options['ts_prod_excerpt'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 3);
		}
		
		if( !$boxshop_theme_options['ts_prod_count_down'] ){
			remove_action('woocommerce_single_product_summary', 'ts_template_loop_time_deals', 20);
		}
		
		if( !$boxshop_theme_options['ts_prod_price'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
			remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
		}
		
		if( !$boxshop_theme_options['ts_prod_add_to_cart'] || $boxshop_theme_options['ts_enable_catalog_mode'] ){
			$terms        = get_the_terms( $post->ID, 'product_type' );
			$product_type = ! empty( $terms ) ? sanitize_title( current( $terms )->name ) : 'simple';
			if( $product_type != 'variable' ){
				remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			}
			else{
				remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
			}
		}
		
		if( !$boxshop_theme_options['ts_prod_sharing'] ){
			remove_action('woocommerce_single_product_summary', 'boxshop_template_single_print_email_buttons', 50);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 70);
		}
		
		if( !$boxshop_theme_options['ts_prod_upsells'] ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
		}
		
		if( !$boxshop_theme_options['ts_prod_related'] ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
		}
		
		if( isset($boxshop_theme_options['ts_prod_tabs_position']) && $boxshop_theme_options['ts_prod_tabs_position'] == 'inside_summary' ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
			add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 50);
		}
		
		/* Breadcrumb */
		$bg_breadcrumbs = get_post_meta($post->ID, 'ts_bg_breadcrumbs', true);
		if( !empty($bg_breadcrumbs) ){
			$boxshop_theme_options['ts_bg_breadcrumbs'] = $bg_breadcrumbs;
		}
		
		/* Disable srcset on cloudzoom */
		boxshop_disable_srcset_on_cloudzoom();
		
		/* Set recently viewed products */
		boxshop_set_recently_viewed_products();
	}
	
	/* Single Portfolio */
	if( is_singular('ts_portfolio') ){
		$portfolio_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$portfolio_data[$key] = $value[0];
			}
		}
		
		if( isset($portfolio_data['ts_portfolio_custom_field']) && $portfolio_data['ts_portfolio_custom_field'] == 1 ){
			$boxshop_theme_options['ts_portfolio_custom_field_title'] = isset($portfolio_data['ts_portfolio_custom_field_title'])?$portfolio_data['ts_portfolio_custom_field_title']:$boxshop_theme_options['ts_portfolio_custom_field_title'];
			$boxshop_theme_options['ts_portfolio_custom_field_content'] = isset($portfolio_data['ts_portfolio_custom_field_content'])?$portfolio_data['ts_portfolio_custom_field_content']:$boxshop_theme_options['ts_portfolio_custom_field_content'];
		}
	}
	
	/* WooCommerce - Other pages */
	if( class_exists('WooCommerce') ){
		if( is_cart() ){
			boxshop_set_header_breadcrumb_layout_woocommerce_page( 'cart' );
			
			boxshop_remove_hooks_from_shop_loop();
			
			if( ! $boxshop_theme_options['ts_prod_cat_grid_desc'] ){
				remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_short_description', 40);
			}
		}
		
		if( is_checkout() ){
			boxshop_set_header_breadcrumb_layout_woocommerce_page( 'checkout' );
		}
		
		if( is_account_page() ){
			boxshop_set_header_breadcrumb_layout_woocommerce_page( 'myaccount' );
		}
	}

	/* Right to left */
	if( is_rtl() ){
		$boxshop_theme_options['ts_enable_rtl'] = 1;
	}
	
	/* Remove bbpress style if not in any bbpress page */
	if( function_exists('is_bbpress') && !is_bbpress() ){
		add_filter('bbp_default_styles', '__return_empty_array');
		add_filter('bbp_default_scripts', '__return_empty_array');
	}
	
	/* Remove background image if not necessary */
	$load_bg = true;
	if( is_page_template('page-templates/fullwidth-template.php') ){
		$load_bg = false;
	}
	if( is_page() && isset($boxshop_page_datas['ts_layout_style']) && $load_bg ){
		if( $boxshop_page_datas['ts_layout_style'] == 'wide' || ( $boxshop_page_datas['ts_layout_style'] == 'default' && $boxshop_theme_options['ts_layout_style'] == 'wide' ) ){
			$load_bg = false;
		}
	}
	
	if( !$load_bg ){
		add_filter('theme_mod_background_image', '__return_empty_string');
	}
}

function boxshop_filter_wp_nav_menu_args( $args ){
	global $post;
	if( is_page() && !is_admin() && !empty($args['theme_location']) && $args['theme_location'] == 'primary' ){
		$menu = get_post_meta($post->ID, 'ts_menu_id', true);
		if( $menu ){
			$args['menu'] = $menu;
		}
	}
	return $args;
}

add_filter('single_template', 'boxshop_change_single_portfolio_template');
function boxshop_change_single_portfolio_template( $single_template ){
	
	if( is_singular('ts_portfolio') && locate_template('single-portfolio.php') ){
		$single_template = locate_template('single-portfolio.php');
	}
	
	return $single_template;
}

function boxshop_remove_hooks_from_shop_loop(){
	global $boxshop_theme_options;
	
	if( ! $boxshop_theme_options['ts_prod_cat_thumbnail'] ){
		remove_action('woocommerce_before_shop_loop_item_title', 'boxshop_template_loop_product_thumbnail', 10);
	}
	if( ! $boxshop_theme_options['ts_prod_cat_label'] ){
		remove_action('woocommerce_after_shop_loop_item_title', 'boxshop_template_loop_product_label', 1);
	}
	if( ! $boxshop_theme_options['ts_prod_cat_cat'] ){
		remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_categories', 10);
	}
	if( ! $boxshop_theme_options['ts_prod_cat_title'] ){
		remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_product_title', 20);
	}
	if( ! $boxshop_theme_options['ts_prod_cat_sku'] ){
		remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_product_sku', 30);
	}
	if( ! $boxshop_theme_options['ts_prod_cat_rating'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 50);
	}
	if( ! $boxshop_theme_options['ts_prod_cat_price'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 60);
	}
	if( ! $boxshop_theme_options['ts_prod_cat_add_to_cart'] ){
		remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_add_to_cart', 70); 
		remove_action('woocommerce_after_shop_loop_item_title', 'boxshop_template_loop_add_to_cart', 10001 );
	}
	
	add_filter('body_class', 'boxshop_add_thumbnail_border_class_to_body');
	
	boxshop_set_thumbnail_slider_shop_loop();	
}

function boxshop_add_thumbnail_border_class_to_body( $classes ){
	global $boxshop_theme_options;
	if( !$boxshop_theme_options['ts_prod_thumbnail_border'] ){
		$classes[] = 'thumbnail-no-border';
	}
	return $classes;
}

function boxshop_set_thumbnail_slider_shop_loop(){
	global $boxshop_theme_options;
	
	$thumbnail_slider = $boxshop_theme_options['ts_prod_cat_thumbnail_slider'];
	$thumbnail_slider_number = absint( $boxshop_theme_options['ts_prod_cat_thumbnail_slider_number'] );
	$thumbnail_slider_variation = $boxshop_theme_options['ts_prod_cat_thumbnail_slider_variation'];
	$thumbnail_slider_variation_color = $boxshop_theme_options['ts_prod_cat_thumbnail_slider_variation_color'];
	
	if( $thumbnail_slider ){
		add_filter('boxshop_loop_product_thumbnail_slider', '__return_true');
	}
	if( $thumbnail_slider_number != 3 ){
		add_filter('boxshop_loop_product_thumbnail_slider_number', function() use ($thumbnail_slider_number){
			return $thumbnail_slider_number;
		});
	}
	if( $thumbnail_slider_variation ){
		add_filter('boxshop_loop_product_thumbnail_slider_variation', '__return_true');
	}
	if( $thumbnail_slider_variation_color ){
		add_filter('boxshop_loop_product_thumbnail_slider_variation_color', '__return_true');
	}
}

function boxshop_grid_list_desc_style(){
	$custom_css = ".products.list .short-description.list{display: inline-block !important;}";
	$custom_css .= ".products.grid .short-description.grid{display: inline-block !important;}";
    wp_add_inline_style('boxshop-reset', $custom_css);
}

function boxshop_set_header_breadcrumb_layout_woocommerce_page( $page = 'shop' ){
	global $boxshop_theme_options;
	/* Header Layout */
	$header_layout = get_post_meta(wc_get_page_id( $page ), 'ts_header_layout', true);
	if( $header_layout != 'default' && $header_layout != '' ){
		$boxshop_theme_options['ts_header_layout'] = $header_layout;
	}
	
	/* Breadcrumb Layout */
	$breadcrumb_layout = get_post_meta(wc_get_page_id( $page ), 'ts_breadcrumb_layout', true);
	if( $breadcrumb_layout != 'default' && $breadcrumb_layout != '' ){
		$boxshop_theme_options['ts_breadcrumb_layout'] = $breadcrumb_layout;
	}
}

function boxshop_disable_srcset_on_cloudzoom(){
	add_filter('wp_get_attachment_image_attributes', 'boxshop_unset_srcset_on_cloudzoom', 9999);
	add_filter('wp_calculate_image_sizes', '__return_false', 9999);
	add_filter('wp_calculate_image_srcset', '__return_false', 9999);
	remove_filter('the_content', 'wp_make_content_images_responsive');
}

function boxshop_unset_srcset_on_cloudzoom( $attr ){
	if( isset($attr['sizes']) ){
		unset($attr['sizes']);
	}
	if( isset($attr['srcset']) ){
		unset($attr['srcset']);
	}
	return $attr;
}

function boxshop_set_recently_viewed_products(){
	global $post;
	
	if( function_exists('ts_crawler_detect') && ts_crawler_detect() ){
		return;
	}
	
	/* set cookie */
	if( empty( $_COOKIE['ts_recently_viewed_products'] ) ){
		$viewed_products = array();
	}
	else{
		$viewed_products = (array) explode( '|', $_COOKIE['ts_recently_viewed_products'] );
	}
	
	if( !in_array( $post->ID, $viewed_products ) ){
		$viewed_products[] = $post->ID;
		
		if( count( $viewed_products ) > 15 ){
			array_shift( $viewed_products );
		}
		
		setcookie('ts_recently_viewed_products', implode( '|', $viewed_products ), time() + (60 * 60 * 24 * 30), '/'); /* set cookie 30 days */
	}
	
	/* set option */
	$viewed_products = get_option('ts_recently_viewed_products', '');
	if( !$viewed_products ){
		$viewed_products = array();
	}
	else{
		$viewed_products = (array) explode( '|', $viewed_products );
	}
	if( !in_array( $post->ID, $viewed_products ) ){
		$viewed_products[] = $post->ID;
		
		if( count( $viewed_products ) > 15 ){
			array_shift( $viewed_products );
		}
		update_option('ts_recently_viewed_products', implode( '|', $viewed_products ));
	}
}
?>
