<?php
/*************************************************
* WooCommerce Custom Hook                        *
**************************************************/

/*** Shop - Category ***/

/* Remove hook */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);

/* Add new hook */

add_action('woocommerce_before_shop_loop_item_title', 'boxshop_template_loop_product_thumbnail', 10);
add_action('woocommerce_after_shop_loop_item_title', 'boxshop_template_loop_product_label', 1);

add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_categories', 10);
add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_product_title', 20);
add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_product_sku', 30);
add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_short_description', 40); 
add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_short_description_listview', 65); 
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 60);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 50);
add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_add_to_cart', 70); 

add_action('woocommerce_before_shop_loop', 'boxshop_shop_top_content_widget_area_button', 15);

add_filter('loop_shop_per_page', 'boxshop_change_products_per_page_shop' ); 
add_filter('woocommerce_product_get_rating_html', 'boxshop_get_empty_rating_html', 10, 2);

add_filter('woocommerce_before_output_product_categories', 'boxshop_before_output_product_categories');
add_filter('woocommerce_after_output_product_categories', 'boxshop_after_output_product_categories');

function boxshop_product_get_availability(){
	global $product;
	$availability = $class = '';
	if ( ! $product->is_in_stock() ) {
		$availability = esc_html__( 'Out of stock', 'boxshop' );
	} elseif ( $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
		$availability = esc_html__( 'Available on backorder', 'boxshop' );
	} elseif ( $product->managing_stock() ) {
		$availability = wc_format_stock_for_display( $product );
	} else {
		$availability = '';
	}
	
	if ( ! $product->is_in_stock() ) {
		$class = 'out-of-stock';
	} elseif ( $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
		$class = 'available-on-backorder';
	} else {
		$class = 'in-stock';
	}

	return array( 'availability' => $availability, 'class' => $class );
}

function boxshop_template_loop_product_label(){
	global $product, $post, $boxshop_theme_options;
	$out_of_stock = false;
	$product_stock = boxshop_product_get_availability();
	if( isset($product_stock['class']) && $product_stock['class'] == 'out-of-stock' ){
		$out_of_stock = true;
	}
	?>
	<div class="product-label">
	<?php 
	/* New label */
	if( $boxshop_theme_options['ts_product_show_new_label'] && !$out_of_stock ){
		$now = current_time( 'timestamp', true );
		$post_date = get_post_time('U', true);
		$num_day = (int)( ( $now - $post_date ) / ( 3600*24 ) );
		$num_day_setting = absint( $boxshop_theme_options['ts_product_show_new_label_time'] );
		if( $num_day <= $num_day_setting ){
			echo '<span class="new">'.esc_html(stripslashes($boxshop_theme_options['ts_product_new_label_text'])).'</span>';
		}
	}
	
	/* Sale label */
	if( $product->is_on_sale() && !$out_of_stock ){ 
		if( $product->get_regular_price() > 0 && $boxshop_theme_options['ts_show_sale_label_as'] != 'text' ){
			$_off_percent = (1 - round($product->get_price() / $product->get_regular_price(), 2))*100;
			$_off_price = round($product->get_regular_price() - $product->get_price(), 0);
			$_price_symbol = get_woocommerce_currency_symbol();
			if( $boxshop_theme_options['ts_show_sale_label_as'] == 'number' ){
			
				$symbol_pos = get_option('woocommerce_currency_pos', 'left');
				$price_display = '';
				switch( $symbol_pos ){
					case 'left':
						$price_display = '-'.$_price_symbol.$_off_price;
					break;
					case 'right':
						$price_display = '-'.$_off_price.$_price_symbol;
					break;
					case 'left_space':
						$price_display = '-'.$_price_symbol.' '.$_off_price;
					break;
					default: /* right_space */
						$price_display = '-'.$_off_price.' '.$_price_symbol;
					break;
				}
				 
				echo '<span class="onsale amount" data-original="'.$price_display.'">'.$price_display.'</span>';
			}
			if( $boxshop_theme_options['ts_show_sale_label_as'] == 'percent' ){
				echo '<span class="onsale percent">-'.$_off_percent.'%</span>';
			}
		}
		else{
			echo '<span class="onsale">'.esc_html(stripslashes($boxshop_theme_options['ts_product_sale_label_text'])).'</span>';
		}
		
	}
	
	/* Hot label */
	if( $product->is_featured() && !$out_of_stock ){
		echo '<span class="featured">'.esc_html(stripslashes($boxshop_theme_options['ts_product_feature_label_text'])).'</span>';
	}
	
	/* Out of stock */
	if( $out_of_stock ){
		echo '<span class="out-of-stock">'.esc_html(stripslashes($boxshop_theme_options['ts_product_out_of_stock_label_text'])).'</span>';
	}
	?>
	</div>
	<?php
}

function boxshop_template_loop_product_thumbnail(){
	global $product, $boxshop_theme_options;
	$lazy_load = isset($boxshop_theme_options['ts_prod_lazy_load']) && $boxshop_theme_options['ts_prod_lazy_load'] && !( defined( 'DOING_AJAX' ) && DOING_AJAX );
	$placeholder_img_src = isset($boxshop_theme_options['ts_prod_placeholder_img'])?$boxshop_theme_options['ts_prod_placeholder_img']:wc_placeholder_img_src();
	
	if( defined( 'YITH_INFS' ) && (is_shop() || is_product_taxonomy()) ){ /* Compatible with YITH Infinite Scrolling */
		$lazy_load = false;
	}
	
	$prod_galleries = $product->get_gallery_image_ids();
	
	$image_size = apply_filters('boxshop_loop_product_thumbnail', 'woocommerce_thumbnail');
	
	$dimensions = wc_get_image_size( $image_size );
	
	$has_back_image = (isset($boxshop_theme_options['ts_effect_product']) && (int)$boxshop_theme_options['ts_effect_product'] == 0)?false:true;
	
	if( !is_array($prod_galleries) || ( is_array($prod_galleries) && count($prod_galleries) == 0 ) ){
		$has_back_image = false;
	}
	 
	if( wp_is_mobile() ){
		$has_back_image = false;
	}
	
	// define thumbnail slider variables
	$thumbnail_slider = apply_filters('boxshop_loop_product_thumbnail_slider', false);
	$thumbnail_slider_number = apply_filters('boxshop_loop_product_thumbnail_slider_number', 3);
	$thumbnail_slider_variation = apply_filters('boxshop_loop_product_thumbnail_slider_variation', false);
	$thumbnail_slider_variation_color = apply_filters('boxshop_loop_product_thumbnail_slider_variation_color', false);
	
	$show_main_thumbnail = true;
	$variable_prices = '';
	$dots_html = array();
	
	if( $thumbnail_slider ){
		$has_back_image = false;
		// load variation
		if( $thumbnail_slider_variation && $product->get_type() == 'variable' ){
			$children = $product->get_children();
			if( is_array($children) && count($children) > 0 ){
				$show_main_thumbnail = false;
				$prod_galleries = array();
				$added_colors = array(); // prevent duplicate color in variations
				$count = 0;
				foreach( $children as $children_id ){
					$accept_child = true;
					
					if( $thumbnail_slider_variation_color ){
						$variation_attributes = wc_get_product_variation_attributes( $children_id );
						$attribute_color = wc_attribute_taxonomy_name( 'color' ); // pa_color
						$attribute_color_name = wc_variation_attribute_name( $attribute_color ); // attribute_pa_color
						if( taxonomy_exists( $attribute_color ) ){
							if( empty($color_terms) ){ // Prevent load list of colors many times
								$color_terms = wc_get_product_terms( $product->get_id(), $attribute_color, array( 'fields' => 'slugs' ) );
							}
							foreach( $variation_attributes as $attribute_name => $attribute_value ){
								if( $attribute_name == $attribute_color_name ){
								
									if( in_array($attribute_value, $added_colors) ){
										$accept_child = false;
										break;
									}
									
									$term_id = array_search($attribute_value, $color_terms);
									
									if( $term_id !== false && absint( $term_id ) > 0 ){
										$color_datas = get_term_meta( $term_id, 'ts_product_color_config', true );
										if( strlen( $color_datas ) > 0 ){
											$color_datas = unserialize( $color_datas );	
										}else{
											$color_datas = array(
														'ts_color_color' 	=> "#ffffff"
														,'ts_color_image' 	=> 0
													);
										}
										$color_datas['ts_color_image'] = absint($color_datas['ts_color_image']);
										if( $color_datas['ts_color_image'] > 0 ){
											$dots_html[] = '<div class="owl-dot color-image"><span>'.wp_get_attachment_image( $color_datas['ts_color_image'], 'boxshop_prod_color_thumb', true, array('alt' => $attribute_value) ).'</span></div>';
										}
										else{
											$dots_html[] = '<div class="owl-dot color"><span style="background-color: '.$color_datas['ts_color_color'].'"></span></div>';
										}
									}
									else{
										$dots_html[] = '<div class="owl-dot"><span></span></div>';
									}
									
									$added_colors[] = $attribute_value;
									break;
								}
							}
						}
					}
					
					if( $accept_child ){
						$prod_galleries[] = get_post_meta( $children_id, '_thumbnail_id', true );
						$variation = wc_get_product( $children_id );
						$variable_prices .= '<span class="price">' . $variation->get_price_html() . '</span>';
						
						$count++;
						if( $count == $thumbnail_slider_number ){
							break;
						}
					}
				}
			}
		}
		
		if( count($prod_galleries) == 0 ){
			$thumbnail_slider = false;
		}
	}
	
	if( $show_main_thumbnail ){
		$thumbnail_slider_number--;
	}
	
	$classes = array();
	$classes[] = $has_back_image?'has-back-image':'no-back-image';
	$classes[] = $thumbnail_slider?'slider loading':'';
	
	if( $variable_prices ){
		echo '<span class="variable-prices hidden">' . $variable_prices . '</span>';
	}
	
	echo '<figure class="' . implode(' ', $classes) . '">';
		if( !$lazy_load ){
			if( $show_main_thumbnail ){
				echo woocommerce_get_product_thumbnail( $image_size );
			}
			
			if( $has_back_image ){
				echo wp_get_attachment_image( $prod_galleries[0], $image_size, 0, array('class' => 'product-image-back') );
			}
			
			if( $thumbnail_slider ){
				for( $i = 0; $i < $thumbnail_slider_number; $i++ ){
					if( isset($prod_galleries[$i]) ){
						$image_attr = array();
						if( isset($dots_html[$i]) ){
							$image_attr = array('data-dot' => str_replace('"', '\'', $dots_html[$i]));
						}
						echo wp_get_attachment_image( $prod_galleries[$i], $image_size, false, $image_attr );
					}
				}
			}
		}
		else{
			if( $show_main_thumbnail ){
				$front_img_src = '';
				$alt = '';
				if( has_post_thumbnail( $product->get_id() ) ){
					$post_thumbnail_id = get_post_thumbnail_id($product->get_id());
					$image_obj = wp_get_attachment_image_src($post_thumbnail_id, $image_size, 0);
					if( isset($image_obj[0]) ){
						$front_img_src = $image_obj[0];
					}
					$alt = trim(strip_tags( get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) ));
				}
				else if( wc_placeholder_img_src() ){
					$front_img_src = wc_placeholder_img_src();
				}
				
				echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($front_img_src).'" class="attachment-shop_catalog wp-post-image ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
			}
			
			if( $has_back_image ){
				$back_img_src = '';
				$alt = '';
				$image_obj = wp_get_attachment_image_src($prod_galleries[0], $image_size, 0);
				if( isset($image_obj[0]) ){
					$back_img_src = $image_obj[0];
					$alt = trim(strip_tags( get_post_meta($prod_galleries[0], '_wp_attachment_image_alt', true) ));
				}
				else if( wc_placeholder_img_src() ){
					$back_img_src = wc_placeholder_img_src();
				}
				
				echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($back_img_src).'" class="product-image-back ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
			}
			
			if( $thumbnail_slider ){
				for( $i = 0; $i < $thumbnail_slider_number; $i++ ){
					if( isset($prod_galleries[$i]) ){
						$img_src = '';
						$alt = '';
						$image_obj = wp_get_attachment_image_src($prod_galleries[$i], $image_size, 0);
						if( isset($image_obj[0]) ){
							$img_src = $image_obj[0];
							$alt = trim(strip_tags( get_post_meta($prod_galleries[$i], '_wp_attachment_image_alt', true) ));
						}
						else if( wc_placeholder_img_src() ){
							$img_src = wc_placeholder_img_src();
						}
						
						$data_dot = '';
						if( isset($dots_html[$i]) ){
							$data_dot = 'data-dot="'.str_replace('"', '\'', $dots_html[$i]).'"';
						}
						
						echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($img_src).'" '.$data_dot.' class="product-image-back ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
					}
				}
			}
		}
	echo '</figure>';
}

function boxshop_template_loop_product_title(){
	global $post, $product;
	$uri = esc_url(get_permalink($post->ID));
	echo "<h3 class=\"heading-title product-name\">";
	echo "<a href='{$uri}'>". esc_attr(get_the_title()) ."</a>";
	echo "</h3>";
}

function boxshop_template_loop_add_to_cart(){
	global $boxshop_theme_options;
	
	if( $boxshop_theme_options['ts_enable_catalog_mode'] ){
		return;
	}
	
	echo "<div class='loop-add-to-cart'>";
	woocommerce_template_loop_add_to_cart();
	echo "</div>";
}

function boxshop_template_loop_product_sku(){
	global $product, $post;
	echo "<span class=\"product-sku\">" . esc_attr($product->get_sku()) . "</span>";
}

function boxshop_template_loop_short_description(){
	global $product, $post, $boxshop_theme_options;
	$has_grid_list = get_option('ts_enable_glt', 'yes') == 'yes';
	$grid_limit_words = absint($boxshop_theme_options['ts_prod_cat_grid_desc_words']);
	$show_grid_desc = $boxshop_theme_options['ts_prod_cat_grid_desc'];
	
	if( empty($post->post_excerpt) )
		return;
	
	if( !(is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product')) ):
	?>
	<div class="short-description">
		<?php boxshop_the_excerpt_max_words($grid_limit_words, '', true, '', true); ?>
	</div>
	<?php
	else:
		if( $show_grid_desc ):
		?>
			<div class="short-description grid" style="<?php echo ($has_grid_list)?'display: none':''; ?>" >
				<?php boxshop_the_excerpt_max_words($grid_limit_words, '', true, '', true); ?>
			</div>
		<?php
		endif;
	endif;
}

function boxshop_template_loop_short_description_listview(){
	global $product, $post, $boxshop_theme_options;
	$list_limit_words = absint($boxshop_theme_options['ts_prod_cat_list_desc_words']);
	$show_list_desc = $boxshop_theme_options['ts_prod_cat_list_desc'];
	$is_archive = is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product');
	if( $show_list_desc && $is_archive ):
	?>
		<div class="short-description list" style="display: none" >
			<?php boxshop_the_excerpt_max_words($list_limit_words, '', true, '', true); ?>
		</div>
	<?php
	endif;
}

function boxshop_template_loop_categories(){
	global $product;
	$categories_label = esc_html__('Categories: ', 'boxshop');
	echo wc_get_product_category_list($product->get_id(), ', ', '<div class="product-categories"><span>'.$categories_label.'</span>', '</div>');
}

function boxshop_change_products_per_page_shop(){
	global $boxshop_theme_options;
    if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
        if( isset($boxshop_theme_options["ts_prod_cat_per_page"]) && absint($boxshop_theme_options["ts_prod_cat_per_page"]) > 0){
            return absint($boxshop_theme_options["ts_prod_cat_per_page"]);
        }
    }
}

function boxshop_get_empty_rating_html( $rating_html, $rating ){
	if( $rating == 0 ){
		$rating_html  = '<div class="star-rating no-rating" title="">';
		$rating_html .= '<span style="width:0%"></span>';
		$rating_html .= '</div>';
	}
	return $rating_html;
}

function boxshop_before_output_product_categories(){
	return '<div class="list-categories">';
}

function boxshop_after_output_product_categories(){
	return '</div>';
}

function boxshop_shop_top_content_widget_area_button(){
	global $boxshop_theme_options;
	if( is_active_sidebar('product-category-top-content') && $boxshop_theme_options['ts_prod_cat_top_content'] ){
	?>
		<div class="prod-cat-show-top-content-button"><a href="#"><?php esc_html_e('Filter', 'boxshop') ?></a></div>
	<?php
	}
}

/*** End Shop - Category ***/



/*** Single Product ***/

/* Remove hook */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);


/* Add hook */
add_action('boxshop_before_product_image', 'boxshop_template_loop_product_label', 10);
add_action('boxshop_before_product_image', 'boxshop_template_single_product_video_button', 20);

add_action('woocommerce_single_product_summary', 'boxshop_template_single_navigation', 1);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 2);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 3);
add_action('woocommerce_single_product_summary', 'boxshop_template_single_availability', 4);
add_action('woocommerce_single_product_summary', 'boxshop_template_single_sku', 5);
add_action('woocommerce_single_product_summary', 'boxshop_template_single_print_email_buttons', 50);
add_action('woocommerce_single_product_summary', 'boxshop_template_single_meta', 60);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 70);

add_action('woocommerce_after_single_product_summary', 'boxshop_product_ads_banner', 12);

add_action('woocommerce_share', 'boxshop_template_single_product_social_sharing', 10);

if( function_exists('ts_template_loop_time_deals') ){
	add_action('woocommerce_single_product_summary', 'ts_template_loop_time_deals', 20);
}

add_filter('woocommerce_available_variation', 'boxshop_variable_product_price_filter', 10, 3);

add_filter('woocommerce_product_description_heading', '__return_empty_string');
add_filter('woocommerce_product_additional_information_heading', '__return_empty_string');

add_filter('woocommerce_output_related_products_args', 'boxshop_output_related_products_args_filter');

if( !is_admin() ){ /* Fix for WooCommerce Tab Manager plugin */
	add_filter( 'woocommerce_product_tabs', 'boxshop_product_remove_tabs', 999 );
	add_filter( 'woocommerce_product_tabs', 'boxshop_add_product_custom_tab', 90 );
}

add_action('wp_ajax_boxshop_load_product_video', 'boxshop_load_product_video_callback' );
add_action('wp_ajax_nopriv_boxshop_load_product_video', 'boxshop_load_product_video_callback' );
/*** End Product ***/

function boxshop_template_single_product_video_button(){
	if( wp_is_mobile() ){
		return;
	}
	global $product;
	$video_url = get_post_meta($product->get_id(), 'ts_prod_video_url', true);
	if( !empty($video_url) ){
		$ajax_url = admin_url('admin-ajax.php', is_ssl()?'https':'http').'?ajax=true&action=boxshop_load_product_video&product_id='.$product->get_id();
		echo '<a class="ts-product-video-button" href="'.esc_url($ajax_url).'"></a>';
	}
}

/* Single Product Video - Register ajax */
function boxshop_load_product_video_callback(){
	if( empty($_GET['product_id']) ){
		die( esc_html__('Invalid Product', 'boxshop') );
	}
	
	$prod_id = absint($_GET['product_id']);

	if( $prod_id <= 0 ){
		die( esc_html__('Invalid Product', 'boxshop') );
	}
	
	$video_url = get_post_meta($prod_id, 'ts_prod_video_url', true);
	ob_start();
	if( !empty($video_url) ){
		echo do_shortcode('[ts_video src='.esc_url($video_url).']');
	}
	die( ob_get_clean() );
}

function boxshop_template_single_navigation(){
	global $boxshop_theme_options;
	if( isset($boxshop_theme_options['ts_prod_next_prev_navigation']) && !$boxshop_theme_options['ts_prod_next_prev_navigation'] ){
		return;
	}
	$prev_post = get_adjacent_post(false, '', true, 'product_cat');
	$next_post = get_adjacent_post(false, '', false, 'product_cat');
	?>
	<div class="single-navigation">
	<?php 
		if( $prev_post ){
			$post_id = $prev_post->ID;
			$product = wc_get_product($post_id);
			?>
			<div>
				<a href="<?php echo esc_url(get_permalink($post_id)); ?>" rel="prev"></a>
				<div class="product-info prev-product-info">
					<?php echo  $product->get_image(); ?>
					<div>
						<span><?php echo esc_html($product->get_title()); ?></span>
						<span class="price"><?php echo  $product->get_price_html(); ?></span>
					</div>
				</div>
			</div>
			<?php
		}
		
		if( $next_post ){
			$post_id = $next_post->ID;
			$product = wc_get_product($post_id);
			?>
			<div>
				<a href="<?php echo esc_url(get_permalink($post_id)); ?>" rel="next"></a>
				<div class="product-info next-product-info">
					<?php echo  $product->get_image(); ?>
					<div>
						<span><?php echo esc_html($product->get_title()); ?></span>
						<span class="price"><?php echo  $product->get_price_html(); ?></span>
					</div>
				</div>
			</div>
			<?php
		}
	?>
	</div>
	<?php
}

function boxshop_template_single_print_email_buttons(){
	?>
	<div class="email">
		<a href="mailto:?subject=<?php echo esc_attr(sanitize_title(get_the_title())); ?>&amp;body=<?php echo esc_url(get_permalink()); ?>">
			<i class="pe-7s-mail"></i>
		</a>
	</div>
	<?php
}

function boxshop_template_single_meta(){
	global $product, $post, $boxshop_theme_options;
	$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
	$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
	
	echo '<div class="meta-content">';
		do_action( 'woocommerce_product_meta_start' );
		if( $boxshop_theme_options['ts_prod_cat'] ){
			echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="cats-link"><span>' . esc_html__( 'Categories:', 'boxshop' ) . '</span><span class="cat-links">', '</span></div>' );
		}
		if( $boxshop_theme_options['ts_prod_tag'] ){
			echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tags-link"><span>' . esc_html__( 'Tags:', 'boxshop' ) . '</span><span class="tag-links">', '</span></div>' );	
		}
		do_action( 'woocommerce_product_meta_end' );
	echo '</div>';
}

function boxshop_template_single_product_social_sharing(){
	get_template_part('templates/product-social-sharing');
}

function boxshop_template_single_sku(){
	global $product;
	if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ){
		echo '<div class="sku-wrapper product_meta">' . esc_html__( 'Sku:', 'boxshop' ) . '<span class="sku">' . (( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'boxshop' )) . '</span></div>';
	}
}
function boxshop_template_single_availability(){
	global $product;

	$product_stock = boxshop_product_get_availability();
	$availability_text = empty($product_stock['availability'])?esc_html__('In Stock', 'boxshop'):esc_attr($product_stock['availability']);
	?>	
		<p class="availability stock <?php echo esc_attr($product_stock['class']); ?>" data-original="<?php echo esc_attr($availability_text) ?>" data-class="<?php echo esc_attr($product_stock['class']) ?>">
			<label><?php esc_html_e('Availability:', 'boxshop') ?></label>
			<span><?php echo esc_html($availability_text); ?></span>
		</p>	
	<?php
}


/*** Product tab ***/
function boxshop_product_remove_tabs( $tabs = array() ){
	global $boxshop_theme_options;
	if( !$boxshop_theme_options['ts_prod_tabs'] ){
		return array();
	}
	return $tabs;
}

function boxshop_add_product_custom_tab( $tabs = array() ){
	global $boxshop_theme_options, $post;
	
	$custom_tab_title = $boxshop_theme_options['ts_prod_custom_tab_title'];
	
	$product_custom_tab = get_post_meta( $post->ID, 'ts_prod_custom_tab', true );
	if( $product_custom_tab ){
		$custom_tab_title = get_post_meta( $post->ID, 'ts_prod_custom_tab_title', true );
	}
	
	if( $boxshop_theme_options['ts_prod_custom_tab'] ){
		$tabs['ts_custom'] = array(
			'title'    	=> esc_html( $custom_tab_title )
			,'priority' => 90
			,'callback' => 'boxshop_product_custom_tab_content'
		);
	} 
	return $tabs;
}

function boxshop_product_custom_tab_content(){
	global $boxshop_theme_options, $post;
	
	$custom_tab_content = $boxshop_theme_options['ts_prod_custom_tab_content'];
	
	$product_custom_tab = get_post_meta( $post->ID, 'ts_prod_custom_tab', true );
	if( $product_custom_tab ){
		$custom_tab_content = get_post_meta( $post->ID, 'ts_prod_custom_tab_content', true );
	}
	
	echo do_shortcode( stripslashes( htmlspecialchars_decode( $custom_tab_content ) ) );
}

/* Ads Banner */
function boxshop_product_ads_banner(){
	global $boxshop_theme_options;
	
	if( $boxshop_theme_options['ts_prod_ads_banner'] ){
		$ads_banner_content = $boxshop_theme_options['ts_prod_ads_banner_content'];
		echo '<div class="ads-banner">';
		echo do_shortcode( stripslashes( htmlspecialchars_decode( $ads_banner_content ) ) );
		echo '</div>';
	}
}

/* Related Products */
function boxshop_output_related_products_args_filter( $args ){
	$args['posts_per_page'] = 6;
	$args['columns'] = 5;
	return $args;
}

/* Always show variable product price if they are same */
function boxshop_variable_product_price_filter( $value, $object = null, $variation = null ){
	if( $value['price_html'] == '' ){
		$value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
	}
	return $value;
}

/*** General hook ***/

/*************************************************************
* Custom group button on product (quickshop, wishlist, compare) 
* Begin tag: 	10000
* Add To Cart: 	10001
* Quickshop: 	10002
* Compare:   	10003
* Wishlist:  	10004
* End tag:   	10005
**************************************************************/
add_action('woocommerce_after_shop_loop_item_title', 'boxshop_template_loop_add_to_cart', 10001 );
function boxshop_product_group_button_start(){
	global $boxshop_theme_options;
	$num_icon = 0;
	
	if( has_action('woocommerce_after_shop_loop_item_title', 'boxshop_template_loop_add_to_cart') && !$boxshop_theme_options['ts_enable_catalog_mode'] ){
		$num_icon++;
	}
	if( $boxshop_theme_options['ts_enable_quickshop'] ){
		$num_icon++;
	}
	if( class_exists('YITH_WCWL') ){
		$num_icon++;
	}
	if( class_exists('YITH_Woocompare') && get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ){
		$num_icon++;
	}
	
	$classes = array(0 => '', 1 => 'one-button', 2 => 'two-button', 3 => 'three-button', 4 => 'four-button');
	
	echo "<div class=\"product-group-button {$classes[$num_icon]}\" >";
}

function boxshop_product_group_button_end(){
	echo '</div>';
}

add_action('woocommerce_after_shop_loop_item_title', 'boxshop_product_group_button_start', 10000 );
add_action('woocommerce_after_shop_loop_item_title', 'boxshop_product_group_button_end', 10005 );

/* Wishlist */
if( class_exists('YITH_WCWL') ){
	function boxshop_add_wishlist_button_to_product_list(){
		global $product, $yith_wcwl;
		
		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;
		if( ! empty( $default_wishlists ) ){
			$default_wishlist = $default_wishlists[0]['ID'];
		}
		else{
			$default_wishlist = false;
		}
		
		$exists = YITH_WCWL()->is_product_in_wishlist( $product->get_id(), $default_wishlist );
		
		$wishlist_url = YITH_WCWL()->get_wishlist_url();
		
		$added_class = $exists?'added':'';
		
		echo '<div class="button-in wishlist add-to-wishlist-'.$product->get_id().' '.$added_class.'">';
			echo '<a href="' . esc_url( add_query_arg( 'add_to_wishlist', $product->get_id() ) )
				. '" data-product-id="' . $product->get_id() . '" data-product-type="' . $product->get_type() 
				. '" class="add_to_wishlist wishlist" ><i class="pe-7s-like"></i><span class="ts-tooltip button-tooltip">'.esc_html__('Wishlist', 'boxshop').'</span></a>';
			echo '<img src="'. get_template_directory_uri() . '/images/ajax-loader.gif' .'" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />';
			
			echo '<span class="yith-wcwl-wishlistaddedbrowse hide" style="display: none">';
				echo '<a href="'.esc_url($wishlist_url).'"><i class="fa fa-heart"></i><span class="ts-tooltip button-tooltip">'.esc_html__('Wishlist', 'boxshop').'</span></a>';
			echo '</span>';
			
			echo '<span class="yith-wcwl-wishlistexistsbrowse '.($exists?'show':'hide').'" style="'.($exists?'':'display: none').'">';
				echo '<a href="'.esc_url($wishlist_url).'"><i class="fa fa-heart"></i><span class="ts-tooltip button-tooltip">'.esc_html__('Wishlist', 'boxshop').'</span></a>';
			echo '</span>';
		
		echo '</div>';
	}
	add_action( 'woocommerce_after_shop_loop_item_title', 'boxshop_add_wishlist_button_to_product_list', 10004 );
	add_action( 'woocommerce_after_shop_loop_item', 'boxshop_add_wishlist_button_to_product_list', 80 );
}

/* Compare */
if( class_exists('YITH_Woocompare') && get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ){
	global $yith_woocompare;
	$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
	if( $yith_woocompare->is_frontend() || $is_ajax ) {
		if( $is_ajax ){
			if( defined('YITH_WOOCOMPARE_DIR') && !class_exists('YITH_Woocompare_Frontend') ){
				$compare_frontend_class = YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php';
				if( file_exists($compare_frontend_class) ){
					require_once $compare_frontend_class;
				}
			}
			$yith_woocompare->obj = new YITH_Woocompare_Frontend();
		}
		remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
		function boxshop_add_compare_button_to_product_list(){
			global $yith_woocompare, $product;
			echo '<div class="button-in compare">';
			echo '<a class="compare" href="'.$yith_woocompare->obj->add_product_url( $product->get_id() ).'" data-product_id="'.$product->get_id().'">'.get_option('yith_woocompare_button_text').'</a>';
			echo '</div>';
		}
		add_action( 'woocommerce_after_shop_loop_item_title', 'boxshop_add_compare_button_to_product_list', 10003 );
		add_action( 'woocommerce_after_shop_loop_item', 'boxshop_add_compare_button_to_product_list', 70 );
		
		add_filter( 'option_yith_woocompare_button_text', 'boxshop_compare_button_text_filter', 99 );
		function boxshop_compare_button_text_filter( $button_text ){
			return '<i class="pe-7s-refresh-2"></i><span class="ts-tooltip button-tooltip">'.esc_html($button_text).'</span>';
		}
	}
}
/*** End General hook ***/

/*** Cart - Checkout hooks ***/
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 10 );

add_action('woocommerce_proceed_to_checkout', 'boxshop_cart_continue_shopping_button', 20);

/* Continue Shopping button */
function boxshop_cart_continue_shopping_button(){
	echo '<a href="'.esc_url(wc_get_page_permalink('shop')).'" class="button continue-shopping">'.esc_html__('Continue Shopping', 'boxshop').'</a>';
}

/* WC Marketplace */
add_action('init', 'boxshop_move_wc_marketplace_sold_by');
function boxshop_move_wc_marketplace_sold_by(){
	global $WCMp;
	if( class_exists('WCMp') ){
		if( !empty($WCMp->vendor_caps) && method_exists($WCMp->vendor_caps, 'wcmp_after_add_to_cart_form') ){
			remove_action('woocommerce_after_shop_loop_item_title', array($WCMp->vendor_caps, 'wcmp_after_add_to_cart_form'), 30);
			add_action('woocommerce_after_shop_loop_item', array($WCMp->vendor_caps, 'wcmp_after_add_to_cart_form'), 1);
		}
	}
}
?>
