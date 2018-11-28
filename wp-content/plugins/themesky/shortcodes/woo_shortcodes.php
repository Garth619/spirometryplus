<?php
/*** Products Shortcode ***/

if( !function_exists('ts_products_shortcode') ){

	function ts_products_shortcode($atts, $content){

		extract(shortcode_atts(array(
				'title' 					=> ''
				,'product_type'				=> 'recent'
				,'columns' 					=> 4
				,'per_page' 				=> 4
				,'product_cats'				=> ''
				,'ids'						=> ''
				,'item_layout'				=> 'grid'
				,'thumbnail_border'			=> 1
				,'big_thumbnail'			=> 0
				,'item_margin'				=> 1
				,'thumbnail_slider'					=> 0
				,'thumbnail_slider_number'			=> 3
				,'thumbnail_slider_variation'		=> 0
				,'thumbnail_slider_variation_color'	=> 0
				,'show_image' 				=> 1
				,'show_title' 				=> 1
				,'show_sku' 				=> 0
				,'show_price' 				=> 1
				,'show_short_desc'  		=> 0
				,'show_rating' 				=> 1
				,'show_label' 				=> 1	
				,'show_categories'			=> 0	
				,'show_add_to_cart' 		=> 1
				,'is_slider'				=> 0
				,'rows' 					=> 1
				,'show_nav'					=> 1
				,'position_nav'				=> 'nav-top'
				,'show_dots'				=> 0
				,'auto_play'				=> 0
				,'margin'					=> 20
				,'disable_slider_responsive'=> 0
			), $atts));
			if ( !class_exists('WooCommerce') ){
				return;
			}
			
			if( $big_thumbnail ){
				add_filter('boxshop_loop_product_thumbnail', 'ts_products_big_thumbnail_size', 10);
			}
			
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
			
			if( !$item_margin ){
				$margin = 0;
			}
			
			$options = array(
					'show_image'		=> $show_image
					,'show_label'		=> $show_label
					,'show_title'		=> $show_title
					,'show_sku'			=> $show_sku
					,'show_price'		=> $show_price
					,'show_short_desc'	=> $show_short_desc
					,'show_categories'	=> $show_categories
					,'show_rating'		=> $show_rating
					,'show_add_to_cart'	=> $show_add_to_cart
				);
			ts_remove_product_hooks_shortcode( $options );
			
			$args = array(
				'post_type'				=> 'product'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'posts_per_page' 		=> $per_page
				,'orderby' 				=> 'date'
				,'order' 				=> 'desc'
				,'meta_query' 			=> WC()->query->get_meta_query()
				,'tax_query'           	=> WC()->query->get_tax_query()
			);
			
			ts_filter_product_by_product_type($args, $product_type);

			$product_cats = str_replace(' ', '', $product_cats);
			if( strlen($product_cats) > 0 ){
				$product_cats = explode(',', $product_cats);
			}
			if( is_array($product_cats) && count($product_cats) > 0 ){
				$field_name = is_numeric($product_cats[0])?'term_id':'slug';
				$args['tax_query'][] = array(
											'taxonomy' => 'product_cat'
											,'terms' => $product_cats
											,'field' => $field_name
											,'include_children' => false
										);
			}
			
			$ids = str_replace(' ', '', $ids);
			if( strlen($ids) > 0 ){
				$ids = explode(',', $ids);
				if( is_array($ids) && count($ids) > 0 ){
					$args['post__in'] = $ids;
					if( count($ids) == 1 ){
						$columns = 1;
					}
				}
			}
			
			ob_start();
			global $woocommerce_loop;
			if( (int)$columns <= 0 ){
				$columns = 5;
			}
			$old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$woocommerce_loop['columns'] = $columns;

			$products = new WP_Query( $args );
			
			$classes = array();
			$classes[] = 'ts-product-wrapper ts-shortcode ts-product';
			$classes[] = $product_type;
			$classes[] = 'item-'.$item_layout;
			$classes[] = $thumbnail_border?'':'thumbnail-no-border';
			$classes[] = $margin?'':'no-margin';
			$classes[] = $title?'':'no-title';
			
			if($big_thumbnail == 1){
				$classes[] = 'big-thumbnail';
			}
			
			if( $is_slider ){
				$classes[] = 'ts-slider';
				$classes[] = 'rows-'.$rows;
				if( $show_dots ){
					$classes[] = $show_nav?'show-dot':'';
				}
				elseif( $show_nav ){
					$classes[] = $show_nav?'show-nav':'';
					$classes[] = $show_nav?$position_nav:'';
				}
			}
			
			$classes = array_filter($classes);
			
			$data_attr = array();
			if( $is_slider ){
				$data_attr[] = 'data-nav="'.$show_nav.'"';
				$data_attr[] = 'data-dots="'.$show_dots.'"';
				$data_attr[] = 'data-autoplay="'.$auto_play.'"';
				$data_attr[] = 'data-margin="'.absint($margin).'"';
				$data_attr[] = 'data-columns="'.$columns.'"';
				$data_attr[] = 'data-disable_responsive="'.$disable_slider_responsive.'"';
			}

			if( $products->have_posts() ): 
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo implode(' ', $data_attr) ?>>
				<?php if( strlen($title) > 0 ): ?>
					<header class="shortcode-heading-wrapper">
						<h3 class="heading-title"><?php echo esc_html($title); ?></h3>
					</header>
				<?php endif; ?>
				<div class="content-wrapper <?php echo ($is_slider)?'loading':'' ?>">
					<?php
					$count = 0;
					woocommerce_product_loop_start();			

					while( $products->have_posts() ){ 
						$products->the_post();	
						if( $is_slider && $rows > 1 && $count % $rows == 0 ){
							echo '<div class="product-group">';
						}
						wc_get_template_part( 'content', 'product' );
						if( $is_slider && $rows > 1 && ($count % $rows == $rows - 1 || $count == $products->post_count - 1) ){
							echo '</div>';
						}
						$count++;
					}

					woocommerce_product_loop_end();
					?>
				</div>
			</div>
			<?php
			endif;
			
			wp_reset_postdata();

			/* restore hooks */
			ts_restore_product_hooks_shortcode();
			
			remove_filter('boxshop_loop_product_thumbnail', 'ts_products_big_thumbnail_size', 10);
			
			remove_all_filters('boxshop_loop_product_thumbnail_slider');
			remove_all_filters('boxshop_loop_product_thumbnail_slider_number');
			remove_all_filters('boxshop_loop_product_thumbnail_slider_variation');
			remove_all_filters('boxshop_loop_product_thumbnail_slider_variation_color');

			$woocommerce_loop['columns'] = $old_woocommerce_loop_columns;
			return '<div class="woocommerce columns-'.$columns.'">' . ob_get_clean() . '</div>';
	}	
}
add_shortcode('ts_products', 'ts_products_shortcode');

if( !function_exists('ts_products_big_thumbnail_size') ){
	function ts_products_big_thumbnail_size(){
		return 'woocommerce_single';
	}
}

/*** Products Widget ***/
if( !function_exists('ts_products_widget_shortcode') ){
	function ts_products_widget_shortcode($atts, $content){
	
		if( !class_exists('TS_Products_Widget') ){
			return;
		}
	
		extract(shortcode_atts(array(
				'title' 				=> ''
				,'title_style' 			=> 'title-background-color'
				,'content_border' 		=> 1
				,'product_type'			=> 'recent'
				,'rows' 				=> 3
				,'per_page' 			=> 6
				,'product_cats'			=> ''
				,'show_image' 			=> 1
				,'show_title' 			=> 1
				,'show_price' 			=> 1
				,'show_rating' 			=> 1	
				,'show_categories'		=> 0	
				,'show_add_to_cart'		=> 0	
				,'image_style'			=> 'default'	
				,'thumbnail_border'		=> 1	
				,'is_slider'			=> 0
				,'show_nav'				=> 1
				,'auto_play'			=> 1
			), $atts));	
		if( trim($product_cats) != '' ){
			$product_cats = array_map('trim', explode(',', $product_cats));
		}
		
		$instance = array(
			'title'					=> $title
			,'product_type'			=> $product_type
			,'product_cats'			=> $product_cats
			,'row'					=> $rows
			,'limit'				=> $per_page
			,'show_thumbnail' 		=> $show_image
			,'show_categories' 		=> $show_categories
			,'show_product_title' 	=> $show_title
			,'show_price' 			=> $show_price
			,'show_rating' 			=> $show_rating
			,'show_add_to_cart' 	=> $show_add_to_cart
			,'thumbnail_style' 		=> $image_style
			,'thumbnail_border' 	=> $thumbnail_border
			,'is_slider'			=> $is_slider
			,'show_nav' 			=> $show_nav
			,'auto_play' 			=> $auto_play
		);
		
		ob_start();
		$classes = array();
		$classes[] = $title_style;
		$classes[] = $content_border?'content-border':'content-no-border';
		$classes[] = $is_slider?'has-slider':'';
		?>
		<div class="ts-products-widget-shortcode <?php echo esc_attr( implode(' ', $classes) ) ?>">
		<?php
			the_widget('TS_Products_Widget', $instance);
		?>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ts_products_widget', 'ts_products_widget_shortcode');

/* Product Category Slider */

if( !function_exists('ts_product_categories_slider_shortcode') ){
	function ts_product_categories_slider_shortcode($atts, $content){
		extract(shortcode_atts(array(
			'title'					=> ''
			,'title_position'		=> ''
			,'per_page' 			=> 5
			,'columns' 				=> 4
			,'parent' 				=> ''
			,'child_of' 			=> 0
			,'ids'	 				=> ''
			,'hide_empty'			=> 1
			,'show_title'			=> 1
			,'show_product_count'	=> 0
			,'show_nav' 			=> 1
			,'auto_play' 			=> 1
			,'margin'				=> 0
		),$atts));

		if ( !class_exists('WooCommerce') ){
			return;
		}

		$args = array(
			'orderby'     => 'name'
			,'order'      => 'ASC'
			,'hide_empty' => $hide_empty
			,'include'    => array_map('trim', explode(',', $ids))
			,'pad_counts' => true
			,'parent'     => $parent
			,'child_of'   => $child_of
			,'number'     => $per_page
		);
		$product_categories = get_terms('product_cat', $args);	
		global $woocommerce_loop;
		$old_woocommerce_loop_columns = $woocommerce_loop['columns'];
		$woocommerce_loop['columns'] = $columns;	
		
		ob_start();
		
		if( count($product_categories) > 0 ):
			$classes = array();
			$classes[] = 'ts-product-category-slider-wrapper ts-product ts-slider ts-shortcode';
			if( $show_nav ){
				$classes[] = 'show-nav';
			}
			if( $title_position ){
				$classes[] = $title_position;
			}
		
			$data_attr = array();
			$data_attr[] = 'data-nav="'.$show_nav.'"';
			$data_attr[] = 'data-autoplay="'.$auto_play.'"';
			$data_attr[] = 'data-margin="'.$margin.'"';
			$data_attr[] = 'data-columns="'.$columns.'"';
		?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo implode(' ', $data_attr); ?>>
				<?php if( strlen($title) > 0 ): ?>
					<header class="shortcode-heading-wrapper">
						<h3 class="heading-title"><?php echo esc_html($title); ?></h3>
					</header>
				<?php endif; ?>
				<div class="content-wrapper loading">
					<?php 
					woocommerce_product_loop_start();
					foreach ( $product_categories as $category ) {
						wc_get_template( 'content-product_cat.php', array(
							'category' 					=> $category
							,'show_title' 				=> $show_title
							,'show_product_count' 		=> $show_product_count
						) );
					}
					woocommerce_product_loop_end();
					?>
				</div>
			</div>
		<?php
		endif;
		
		$woocommerce_loop['columns'] = $old_woocommerce_loop_columns;
		
		return '<div class="woocommerce">' . ob_get_clean() . '</div>';			
	}
}
add_shortcode('ts_product_categories_slider', 'ts_product_categories_slider_shortcode');

/* TS Product Deals Slider */
if( !function_exists('ts_product_deals_slider_shortcode') ){
	function ts_product_deals_slider_shortcode($atts, $content = null){

		extract(shortcode_atts(array(
				'title' 				=> ''
				,'title_style'			=> ''
				,'title_bg_color'		=> '#e72304'
				,'columns' 				=> 4
				,'per_page' 			=> 5
				,'product_cats'			=> ''
				,'ids'					=> ''
				,'product_type'			=> 'recent'
				,'item_border' 			=> 1
				,'thumbnail_border' 	=> 0
				,'show_counter'			=> 1
				,'counter_position'		=> 'bottom' /* bottom - on-thumbnail */
				,'big_counter'			=> 0
				,'show_image' 			=> 1
				,'show_title' 			=> 1
				,'show_sku' 			=> 0
				,'show_price' 			=> 1
				,'show_short_desc'  	=> 0
				,'show_rating' 			=> 1
				,'show_label' 			=> 1	
				,'show_categories'		=> 0	
				,'show_add_to_cart' 	=> 1
				,'show_nav'				=> 1
				,'position_nav'			=> 'nav-top'
				,'auto_play'			=> 1
				,'margin'				=> 20
			), $atts));			

			if ( !class_exists('WooCommerce') ){
				return;
			}
			
			$per_page = absint($per_page);
			
			if( $thumbnail_border ){
				$item_border = 0;
			}
			
			if( $show_counter ){
				if( $counter_position == 'bottom' ){
					add_action('woocommerce_after_shop_loop_item', 'ts_template_loop_time_deals', 65);
				}
				else{
					add_action('woocommerce_after_shop_loop_item_title', 'ts_template_loop_time_deals', 99);
				}
			}
			
			/* Remove hook */
			$options = array(
					'show_image'		=> $show_image
					,'show_label'		=> $show_label
					,'show_title'		=> $show_title
					,'show_sku'			=> $show_sku
					,'show_price'		=> $show_price
					,'show_short_desc'	=> $show_short_desc
					,'show_categories'	=> $show_categories
					,'show_rating'		=> $show_rating
					,'show_add_to_cart'	=> $show_add_to_cart
				);
			ts_remove_product_hooks_shortcode( $options );

			$args = array(
				'post_type'				=> array('product', 'product_variation')
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'posts_per_page' 		=> -1
				,'orderby' 				=> 'date'
				,'order' 				=> 'desc'
				,'meta_query' => array(
					array(
						'key'		=> '_sale_price_dates_to'
						,'value'	=> current_time( 'timestamp', true )
						,'compare'	=> '>'
						,'type'		=> 'numeric'
					)
					,array(
						'key'		=> '_sale_price_dates_from'
						,'value'	=> current_time( 'timestamp', true )
						,'compare'	=> '<'
						,'type'		=> 'numeric'
					)
				)
				,'tax_query'			=> array()
			);

			ts_filter_product_by_product_type($args, $product_type);
			
			$array_product_cats = array();

			$product_cats = str_replace(' ', '', $product_cats);
			if( strlen($product_cats) > 0 ){
				$array_product_cats = explode(',', $product_cats);
			}			

			if( $ids ){
				$ids = array_map('trim', explode(',', $ids));
			}
			else{
				$ids = array();
			}
			$filter_ids = count( $ids ) > 0;
			
			ob_start();
			global $woocommerce_loop, $post, $product;
			if( (int)$columns <= 0 ){
				$columns = 5;
			}
			$old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$woocommerce_loop['columns'] = $columns;
			
			$product_ids_on_sale = array();
			
			$products = new WP_Query( $args );
			
			if( $products->have_posts() ){
				while( $products->have_posts() ){
					$products->the_post();
					if( $post->post_type == 'product' ){
						if( $filter_ids && !in_array($post->ID, $ids) ){
							continue;
						}
						$_product = wc_get_product( $post->ID );
						if( is_object( $_product ) && $_product->is_visible() ){
							if( !empty($array_product_cats) ){
								$field_name = is_numeric($array_product_cats[0])?'ids':'slug';
								$post_terms = wp_get_post_terms($post->ID, 'product_cat', array('fields' => $field_name));
								if( is_array($post_terms) ){
									$array_intersect = array_intersect($post_terms, $array_product_cats);
									if( !empty($array_intersect) ){
										$product_ids_on_sale[] = $post->ID;
									}
								}
							}
							else{
								$product_ids_on_sale[] = $post->ID;
							}
						}
					}
					else{ /* Variation product */
						$post_parent_id = $post->post_parent;
						if( $filter_ids && !in_array($post_parent_id, $ids) ){
							continue;
						}
						$parent_product = wc_get_product( $post_parent_id );
						if( is_object( $parent_product ) && $parent_product->is_visible() ){
							if( !empty($array_product_cats) ){
								$field_name = is_numeric($array_product_cats[0])?'ids':'slug';
								$post_terms = wp_get_post_terms($post_parent_id, 'product_cat', array('fields' => $field_name));
								if( is_array($post_terms) ){
									$array_intersect = array_intersect($post_terms, $array_product_cats);
									if( !empty($array_intersect) ){
										$product_ids_on_sale[] = $post_parent_id;
									}
								}
							}
							else{
								$product_ids_on_sale[] = $post_parent_id;
							}
						}
					}
					
					$product_ids_on_sale = array_unique($product_ids_on_sale);
					if( count($product_ids_on_sale) == $per_page ){
						break;
					}
				}
			}
			
			if( count($product_ids_on_sale) == 0 ){
				$product_ids_on_sale = array(0);
			}
			
			$args = array(
				'post_type'				=> 'product'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'posts_per_page' 		=> $per_page
				,'orderby' 				=> 'date'
				,'order' 				=> 'desc'
				,'post__in'				=> $product_ids_on_sale
				,'meta_query' 			=> WC()->query->get_meta_query()
				,'tax_query'           	=> WC()->query->get_tax_query()
			);
			
			ts_filter_product_by_product_type($args, $product_type);
			
			$products = new WP_Query($args);
			
			$is_slider = ( isset($products->post_count) && $products->post_count > 1 )?true:false;
			
			if( $products->have_posts() ): 
				$classes = array();
				$classes[] = 'ts-product-deals-slider-wrapper ts-slider ts-shortcode ts-product';
				$classes[] = $item_border?'item-border':'item-no-border';
				$classes[] = $thumbnail_border?'thumbnail-border':'thumbnail-no-border';
				$classes[] = $title_style;
				$classes[] = 'counter-' . $counter_position;
				$classes[] = $big_counter?'big-counter':'';
				if( $show_nav ){
					$classes[] = 'show-nav';
					$classes[] = $position_nav;
				}
				
				$data_attr = array();
				$data_attr[] = 'data-nav="'.esc_attr($show_nav).'"';
				$data_attr[] = 'data-autoplay="'.esc_attr($auto_play).'"';
				$data_attr[] = 'data-margin="'.esc_attr($margin).'"';
				$data_attr[] = 'data-columns="'.esc_attr($columns).'"';
				$data_attr[] = 'data-is_slider="'.esc_attr($is_slider).'"';
				
				$rand_id = 'ts-product-deals-slider-' . mt_rand(1, 1000);
				
				if( $title_style == 'title-background-color' ){
					$inline_style = '<div class="ts-shortcode-custom-style hidden">';
					$inline_style .= '#' . $rand_id . ' .shortcode-heading-wrapper h3{background-color:'.$title_bg_color.'}';
					$inline_style .= '</div>';
					echo $inline_style;
				}
				?>
				<div id="<?php echo esc_attr($rand_id) ?>" class="<?php echo esc_attr( implode(' ', $classes) ); ?>" <?php echo implode(' ', $data_attr); ?>>
					<?php if( strlen($title) > 0 ): ?>
						<header class="shortcode-heading-wrapper">
							<h3 class="heading-title"><?php echo esc_html($title); ?></h3>
						</header>
					<?php endif; ?>
					<div class="content-wrapper <?php echo ($is_slider)?'loading':''; ?>">
						<?php woocommerce_product_loop_start(); ?>				

						<?php while( $products->have_posts() ): $products->the_post(); ?>
							<?php wc_get_template_part( 'content', 'product' ); ?>							
						<?php endwhile; ?>			

						<?php woocommerce_product_loop_end(); ?>
					</div>
				</div>
				<?php
			endif;
			
			wp_reset_postdata();			

			/* restore hooks */
			if( $show_counter ){
				if( $counter_position == 'bottom' ){
					remove_action('woocommerce_after_shop_loop_item', 'ts_template_loop_time_deals', 65);
				}
				else{
					remove_action('woocommerce_after_shop_loop_item_title', 'ts_template_loop_time_deals', 99);
				}
			}

			ts_restore_product_hooks_shortcode();

			$woocommerce_loop['columns'] = $old_woocommerce_loop_columns;
			
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';
	}
}
add_shortcode('ts_product_deals_slider', 'ts_product_deals_slider_shortcode');

if( !function_exists('ts_template_loop_time_deals') ){
	function ts_template_loop_time_deals(){
		global $product;
		$date_to = '';
		$date_from = '';
		if( $product->get_type() == 'variable' ){
			$children = $product->get_children();
			if( is_array($children) && count($children) > 0 ){
				foreach( $children as $children_id ){
					$date_to = get_post_meta($children_id, '_sale_price_dates_to', true);
					$date_from = get_post_meta($children_id, '_sale_price_dates_from', true);
					if( $date_to != '' ){
						break;
					}
				}
			}
		}
		else{
			$date_to = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
			$date_from = get_post_meta($product->get_id(), '_sale_price_dates_from', true);
		}
		
		$current_time = current_time('timestamp', true);
		
		if( $date_to == '' || $date_from == '' || $date_from > $current_time || $date_to < $current_time ){
			return;
		}
		
		$delta = $date_to - $current_time;
		
		$time_day = 60 * 60 * 24;
		$time_hour = 60 * 60;
		$time_minute = 60;
		
		$day = floor( $delta / $time_day );
		$delta -= $day * $time_day;
		
		$hour = floor( $delta / $time_hour );
		$delta -= $hour * $time_hour;
		
		$minute = floor( $delta / $time_minute );
		$delta -= $minute * $time_minute;
		
		if( $delta > 0 ){
			$second = $delta;
		}
		else{
			$second = 0;
		}
		
		$day = zeroise($day, 2);
		$hour = zeroise($hour, 2);
		$minute = zeroise($minute, 2);
		$second = zeroise($second, 2);

		?>
		<div class="counter-wrapper days-<?php echo strlen($day); ?>">
			<div class="days">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($day); ?></span>
				</div>
				<div class="ref-wrapper">
					<?php esc_html_e('Days', 'themesky'); ?>
				</div>
			</div>
			<div class="hours">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($hour); ?></span>
				</div>
				<div class="ref-wrapper">
					<?php esc_html_e('Hours', 'themesky'); ?>
				</div>
			</div>
			<div class="minutes">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($minute); ?></span>
				</div>
				<div class="ref-wrapper">
					<?php esc_html_e('Mins', 'themesky'); ?>
				</div>
			</div>
			<div class="seconds">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($second); ?></span>
				</div>
				<div class="ref-wrapper">
					<?php esc_html_e('Secs', 'themesky'); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

/* Product in category tabs */
if( !function_exists('ts_products_in_category_tabs_shortcode') ){
	function ts_products_in_category_tabs_shortcode($atts, $content){

		extract(shortcode_atts(array(
			'title' 						=> ''
			,'tab_style' 					=> 'vertical-tab'
			,'horizontal_style' 			=> 'horizontal-style-1'
			,'color'						=> '#40bea7'
			,'icon_fontawesome' 			=> ''
			,'icon_image' 					=> ''
			,'icon_bg_color'				=> '#0a84cd'
			,'banners'						=> ''
			,'links'						=> ''
			,'banner_position'				=> 'right'
			,'product_type'					=> 'recent'
			,'columns' 						=> 3
			,'per_page' 					=> 6
			,'product_cats'					=> ''
			,'parent_cat' 					=> ''
			,'include_children' 			=> 0
			,'show_general_tab' 			=> 0
			,'general_tab_heading' 			=> ''
			,'product_type_general_tab' 	=> 'recent'
			,'thumbnail_border' 			=> 1
			,'show_image' 					=> 1
			,'show_title' 					=> 1
			,'show_sku' 					=> 0
			,'show_price' 					=> 1
			,'show_short_desc'  			=> 0
			,'show_rating' 					=> 1
			,'show_label' 					=> 1
			,'show_categories'				=> 0	
			,'show_add_to_cart' 			=> 1
			,'show_see_more_button' 		=> 0
			,'show_see_more_general_tab' 	=> 0
			,'see_more_button_text' 		=> 'See more'
			,'is_slider' 					=> 0
			,'rows' 						=> 1
			,'show_nav' 					=> 0
			,'auto_play' 					=> 1
		), $atts));
		if ( !class_exists('WooCommerce') ){
			return;
		}
		
		if( empty($product_cats) && empty($parent_cat) ){
			return;
		}
		
		if( empty($product_cats) ){
			$sub_cats = get_terms('product_cat', array('parent' => $parent_cat, 'fields' => 'ids', 'orderby' => 'none'));
			if( is_array($sub_cats) && !empty($sub_cats) ){
				$product_cats = implode(',', $sub_cats);
			}
			else{
				return;
			}
			$see_more_link = get_term_link((int)$parent_cat, 'product_cat');
			if( is_wp_error($see_more_link) ){
				$see_more_link = '#';
			}
		}
		else{
			$see_more_link = get_permalink( wc_get_page_id('shop') );
		}
		
		$atts = compact('title', 'icon_fontawesome', 'icon_image', 'color', 'banners', 'product_type', 'columns', 'rows', 'per_page', 'tab_style'
						,'product_cats', 'include_children', 'show_image', 'show_title', 'show_sku', 'show_price', 'show_short_desc', 'show_rating', 'show_label'
						,'show_categories', 'show_add_to_cart', 'show_see_more_button', 'show_see_more_general_tab', 'show_general_tab', 'product_type_general_tab', 'is_slider', 'show_nav', 'auto_play');
		
		$banners_arr = array();
		$banners = str_replace(' ', '', $banners);
		if( $banners != '' ){
			$banners_arr = explode(',', $banners);
		}
		
		$links_arr = array();
		$links = str_replace(' ', '', $links);
		if( $links != '' ){
			$links_arr = explode(',', $links);
		}
		
		if( $horizontal_style == 'horizontal-style-2' ){
			$banner_position = 'left';
		}
		
		$classes = array();
		$classes[] = 'ts-product-in-category-tab-wrapper ts-shortcode ts-product';
		$classes[] = $product_type;
		$classes[] = $tab_style;
		$classes[] = 'column-' . $columns;
		$classes[] = $thumbnail_border?'':'thumbnail-no-border';
		if( $tab_style == 'horizontal-tab' ){
			$classes[] = $horizontal_style;
		}
		if( count($banners_arr) == 0 ){
			$classes[] = 'no-banner';
		}
		else{
			$classes[] = 'has-banner';
			if( $tab_style == 'horizontal-tab' ){
				$classes[] = 'banner-'.$banner_position;
			}
		}
		
		if( $show_see_more_button ){
			$classes[] = 'has-see-more-button';
		}
		else{
			$classes[] = 'no-see-more-button';
		}
		
		if( $is_slider ){
			$classes[] = 'has-slider';
			$classes[] = 'rows-'.$rows;
			$classes[] = $show_nav?'':'no-nav';
		}
		
		$rand_id = 'ts-product-in-category-tab-'.rand();
		$selector = '#'.$rand_id;
		
		$inline_style = '<div class="ts-shortcode-custom-style hidden">';
		$inline_style .= $selector.' .column-tabs .heading-tab:after{background-color:'.$color.'}';
		$inline_style .= $selector.' .column-tabs:after{border-color:'.$color.'}';
		// Hover
		if( $horizontal_style != 'horizontal-style-2' ){
			$inline_style .= $selector.' .column-tabs .tabs li:hover,'.$selector.' .column-tabs .tabs li.current,'.$selector.' .column-tabs ul li.current:after{color:'.$color.'}';
		}
		
		if( $horizontal_style == 'horizontal-style-2' ){
			$inline_style .= $selector.' .heading-title.has-icon i,'.$selector.' .heading-title.has-icon span.ic-image{background-color:'.$icon_bg_color.'}';
			$inline_style .= $selector.' .heading-title.has-icon i:after,'.$selector.' .column-tabs .heading-tab span.ic-image:after{border-left-color:'.$icon_bg_color.';border-right-color:'.$icon_bg_color.'}';
			$inline_style .= $selector.' .column-tabs .tabs li:hover,'.$selector.' .column-tabs .tabs li.current{color:'.$icon_bg_color.'}';
			$inline_style .= $selector.' .column-tabs ul li.current:after{color:'.$color.'}';
		}
		
		$inline_style .= '</div>';
		ob_start();
		
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" id="<?php echo esc_attr($rand_id) ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
			<?php echo trim($inline_style); ?>
			<div class="column-tabs">
				<header class="heading-tab">
					<?php if( strlen($title) > 0 ): ?>
						<h3 class="heading-title <?php echo (empty($icon_image) && $icon_fontawesome == '')?'no-icon':'has-icon' ?> ">
							<?php if( !empty($icon_image) ){ ?>
							
							<span class="ic-image">
							<?php echo wp_get_attachment_image($icon_image); ?>
							</span>
							
							<?php }
							
							elseif( $icon_fontawesome != ''){
							?>
								<i class="<?php echo esc_attr($icon_fontawesome) ?>"></i>
							<?php 
							}
							?>
							<span class="title-category"><?php echo esc_html($title); ?></span>
						</h3>
					<?php endif; ?>
				</header>
				<ul class="tabs">
				<?php 
				if( $show_general_tab ){
				?>
					<li class="tab-item general-tab" data-product_cat="<?php echo esc_attr($product_cats) ?>" data-link="<?php echo esc_url($see_more_link) ?>"><?php echo esc_html($general_tab_heading) ?></li>
				<?php
				}
				
				$product_cats = array_map('trim', explode(',', $product_cats));
				foreach( $product_cats as $k => $product_cat ):
					$term = get_term_by( is_numeric($product_cat)?'term_id':'slug', $product_cat, 'product_cat');
					if( !isset($term->name) ){
						continue;
					}
				?>
					<li class="tab-item" data-product_cat="<?php echo esc_attr($product_cat) ?>" data-link="<?php echo esc_url(get_term_link($term, 'product_cat')) ?>"><?php echo esc_html($term->name) ?></li>
				<?php
				endforeach;
				?>
				</ul>
			</div>
			
			<div class="column-content">
				<?php if( count($banners_arr) > 0 ): ?>
				<div class="column-banners loading">
					<figure>
					<?php 
					foreach( $banners_arr as $index => $banner ){
						if( isset($links_arr[$index]) ){
							$link = $links_arr[$index];
						}
						else{
							$link = '#';
						}
						
						echo '<a href="'.( $link != '#'? esc_url($link): 'javascript: void(0)' ).'">';
						echo wp_get_attachment_image($banner, 'full');
						echo '</a>';
					}
					?>
					</figure>
				</div>
				<?php endif; ?>
				
				<div class="column-products woocommerce columns-<?php echo esc_attr($columns) ?>">
			
				</div>
				
				<?php if( $show_see_more_button ): ?>
				<div class="see-more-wrapper">
					<a class="see-more-button" href="<?php echo esc_url($see_more_link) ?>"><?php echo esc_html($see_more_button_text) ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
		
		return ob_get_clean();
	}	
}
add_shortcode('ts_products_in_category_tabs', 'ts_products_in_category_tabs_shortcode');

add_action('wp_ajax_ts_get_product_content_in_category_tab', 'ts_get_product_content_in_category_tab');
add_action('wp_ajax_nopriv_ts_get_product_content_in_category_tab', 'ts_get_product_content_in_category_tab');
if( !function_exists('ts_get_product_content_in_category_tab') ){
	function ts_get_product_content_in_category_tab( $atts ){
		if( empty($_POST['atts']) || empty($_POST['product_cat']) ){
			die('0');
		}
		$atts = $_POST['atts'];
		$product_cat = $_POST['product_cat'];
		$is_general_tab = (isset($_POST['is_general_tab']) && $_POST['is_general_tab'])?true:false;
		
		if( $is_general_tab ){
			$atts['product_type'] = $atts['product_type_general_tab'];
		}
		
		ob_start();
		extract($atts);
		
		$options = array(
				'show_image'		=> $show_image
				,'show_label'		=> $show_label
				,'show_title'		=> $show_title
				,'show_sku'			=> $show_sku
				,'show_price'		=> $show_price
				,'show_short_desc'	=> $show_short_desc
				,'show_categories'	=> $show_categories
				,'show_rating'		=> $show_rating
				,'show_add_to_cart'	=> $show_add_to_cart
			);
		ts_remove_product_hooks_shortcode( $options );
		
		$args = array(
			'post_type'				=> 'product'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page' 		=> $per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
			,'meta_query' 			=> WC()->query->get_meta_query()
			,'tax_query'           	=> WC()->query->get_tax_query()
		);

		ts_filter_product_by_product_type($args, $product_type);
		
		$args['tax_query'][] = array(
									'taxonomy' => 'product_cat'
									,'terms' => explode(',', $product_cat)
									,'field' => 'term_id'
									,'include_children' => $include_children
								);
		
		global $woocommerce_loop;
		if( (int)$columns <= 0 ){
			$columns = 3;
		}
		$old_woocommerce_loop_columns = $woocommerce_loop['columns'];
		$woocommerce_loop['columns'] = $columns;

		$products = new WP_Query( $args );
		
		$count = 0;
		
		woocommerce_product_loop_start();
		if( $products->have_posts() ){	

			if( isset($products->found_posts, $products->post_count) && $products->found_posts == $products->post_count ){
				echo '<div class="hidden hide-see-more"></div>';
			}

			while( $products->have_posts() ){ 
				$products->the_post();
				
				if( $is_slider && $rows > 1 && $count % $rows == 0 ){
					echo '<div class="product-group">';
				}
				
				wc_get_template_part( 'content', 'product' );
				
				if( $is_slider && $rows > 1 && ($count % $rows == $rows - 1 || $count == $products->post_count - 1) ){
					echo '</div>';
				}
				$count++;
			}

		}
		woocommerce_product_loop_end();
		
		wp_reset_postdata();

		/* restore hooks */
		ts_restore_product_hooks_shortcode();

		$woocommerce_loop['columns'] = $old_woocommerce_loop_columns;
		
		die(ob_get_clean());
	}
}

/* Product in category tabs 2 */
if( !function_exists('ts_products_in_category_tabs_2_shortcode') ){
	function ts_products_in_category_tabs_2_shortcode($atts, $content){

		extract(shortcode_atts(array(
			'title' 						=> ''
			,'tab_style' 					=> 'vertical-tab'
			,'color'						=> '#40bea7'
			,'product_type'					=> 'recent'
			,'columns' 						=> 4
			,'per_page' 					=> 8
			,'product_cats'					=> ''
			,'parent_cat' 					=> ''
			,'include_children' 			=> 0
			,'tab_icons'					=> ''
			,'tab_icons_hover'				=> ''
			,'show_general_tab' 			=> 0
			,'general_tab_heading' 			=> ''
			,'product_type_general_tab' 	=> 'recent'
			,'thumbnail_border' 			=> 1
			,'show_image' 					=> 1
			,'show_title' 					=> 1
			,'show_sku' 					=> 0
			,'show_price' 					=> 1
			,'show_short_desc'  			=> 0
			,'show_rating' 					=> 1
			,'show_label' 					=> 1
			,'show_categories'				=> 0	
			,'show_add_to_cart' 			=> 1
			,'show_see_more_button' 		=> 0
			,'show_see_more_general_tab' 	=> 0
			,'see_more_button_text' 		=> 'See All'
			,'is_slider' 					=> 0
			,'rows' 						=> 1
			,'show_nav' 					=> 0
			,'auto_play' 					=> 1
		), $atts));
		if ( !class_exists('WooCommerce') ){
			return;
		}
		
		if( empty($product_cats) && empty($parent_cat) ){
			return;
		}
		
		if( empty($product_cats) ){
			$sub_cats = get_terms('product_cat', array('parent' => $parent_cat, 'fields' => 'ids', 'orderby' => 'none'));
			if( is_array($sub_cats) && !empty($sub_cats) ){
				$product_cats = implode(',', $sub_cats);
			}
			else{
				return;
			}
			$see_more_link = get_term_link((int)$parent_cat, 'product_cat');
			if( is_wp_error($see_more_link) ){
				$see_more_link = '#';
			}
		}
		else{
			$see_more_link = get_permalink( wc_get_page_id('shop') );
		}
		
		$tab_icons_arr = array();
		$tab_icons = str_replace(' ', '', $tab_icons);
		if( $tab_icons != '' ){
			$tab_icons_arr = explode(',', $tab_icons);
		}
		
		$tab_icons_hover_arr = array();
		$tab_icons_hover = str_replace(' ', '', $tab_icons_hover);
		if( $tab_icons_hover != '' ){
			$tab_icons_hover_arr = explode(',', $tab_icons_hover);
		}
		
		$atts = compact('title', 'color', 'product_type', 'columns', 'rows', 'per_page', 'tab_style'
						,'product_cats', 'include_children', 'show_image', 'show_title', 'show_sku', 'show_price', 'show_short_desc', 'show_rating', 'show_label'
						,'show_categories', 'show_add_to_cart', 'show_see_more_button', 'show_see_more_general_tab', 'show_general_tab', 'product_type_general_tab', 'is_slider', 'show_nav', 'auto_play');
		
		$classes = array();
		$classes[] = 'ts-product-in-category-tab-2-wrapper ts-shortcode ts-product';
		$classes[] = $product_type;
		$classes[] = $tab_style;
		$classes[] = 'column-' . $columns;
		$classes[] = $thumbnail_border?'':'thumbnail-no-border';
		
		if( $show_see_more_button ){
			$classes[] = 'has-see-more-button';
		}
		else{
			$classes[] = 'no-see-more-button';
		}
		
		if( $is_slider ){
			$classes[] = 'has-slider';
			$classes[] = 'rows-'.$rows;
			$classes[] = $show_nav?'':'no-nav';
		}
		
		$rand_id = 'ts-product-in-category-tab-2-' . mt_rand(10, 1000);
		$selector = '#'.$rand_id;
		
		$inline_style = '<div class="ts-shortcode-custom-style hidden">';
		if($tab_style == 'vertical-tab'){
			$inline_style .= $selector.' .column-tabs li:hover,'.$selector.' .column-tabs li.current{background-color:'.$color.'}';
		}
		if($tab_style == 'horizontal-tab'){
			$inline_style .= $selector.' .column-tabs li:hover,'.$selector.' .column-tabs li.current{color:'.$color.'}';
		}
		$inline_style .= '</div>';
		ob_start();
		
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" id="<?php echo esc_attr($rand_id) ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
			<?php echo trim($inline_style); ?>
			<div class="column-tabs">
				<header class="heading-tab">
					<?php if( $title ): ?>
						<h3 class="heading-title">
							<span class="title-category"><?php echo esc_html($title); ?></span>
						</h3>
					<?php endif; ?>
					<?php if( $show_see_more_button ): ?>
					<div class="see-more-wrapper">
						<a class="see-more-button" href="<?php echo esc_url($see_more_link) ?>"><?php echo esc_html($see_more_button_text) ?></a>
					</div>
					<?php endif; ?>
				</header>
				<ul class="tabs">
				<?php 
				$tab_icon_index = 0;
				if( $show_general_tab ){
					$icon = $icon_hover = '';
					if( isset($tab_icons_arr[$tab_icon_index]) ){
						$icon = wp_get_attachment_image($tab_icons_arr[$tab_icon_index], 'thumbnail');
						if( isset($tab_icons_hover_arr[$tab_icon_index]) ){
							$icon_hover = wp_get_attachment_image($tab_icons_hover_arr[$tab_icon_index], 'thumbnail', false, array('class' => 'hover-icon'));
						}
					}
					$tab_icon_index++;
				?>
					<li class="tab-item general-tab" data-product_cat="<?php echo esc_attr($product_cats) ?>" data-link="<?php echo esc_url($see_more_link) ?>">
						<span>
							<?php if( $icon ): ?>
							<span class="<?php echo $icon_hover?'has-icon-hover':''; ?>">
								<?php echo $icon; ?>
								<?php echo $icon_hover; ?>
							</span>
							<?php endif; ?>
							<span>
								<?php echo esc_html($general_tab_heading) ?>
							</span>
						</span>
					</li>
				<?php
				}
				
				$product_cats = array_map('trim', explode(',', $product_cats));
				foreach( $product_cats as $k => $product_cat ):
					$term = get_term_by( is_numeric($product_cat)?'term_id':'slug', $product_cat, 'product_cat');
					if( !isset($term->name) ){
						continue;
					}
					$icon = $icon_hover = '';
					if( isset($tab_icons_arr[$tab_icon_index]) ){
						$icon = wp_get_attachment_image($tab_icons_arr[$tab_icon_index], 'thumbnail');
						if( isset($tab_icons_hover_arr[$tab_icon_index]) ){
							$icon_hover = wp_get_attachment_image($tab_icons_hover_arr[$tab_icon_index], 'thumbnail', false, array('class' => 'hover-icon'));
						}
					}
					$tab_icon_index++;
				?>
					<li class="tab-item" data-product_cat="<?php echo esc_attr($product_cat) ?>" data-link="<?php echo esc_url(get_term_link($term, 'product_cat')) ?>">
						<span>
							<?php if( $icon ): ?>
							<span class="<?php echo $icon_hover?'has-icon-hover':''; ?>">
								<?php echo $icon; ?>
								<?php echo $icon_hover; ?>
							</span>
							<?php endif; ?>
							<span>
								<?php echo esc_html($term->name) ?>
							</span>
						</span>
					</li>
				<?php
				endforeach;
				?>
				</ul>
			</div>
			
			<div class="column-content">
				<div class="column-products woocommerce columns-<?php echo esc_attr($columns) ?>">
			
				</div>
			</div>
		</div>
		<?php
		
		return ob_get_clean();
	}	
}
add_shortcode('ts_products_in_category_tabs_2', 'ts_products_in_category_tabs_2_shortcode');

/* Recently viewed products */
if( !function_exists('ts_recently_viewed_products_slider_shortcode') ){
	function ts_recently_viewed_products_slider_shortcode($atts, $content){
		extract(shortcode_atts(array(
				'title' 					=> ''
				,'columns' 					=> 4
				,'rows' 					=> 2
				,'per_page' 				=> 12
				,'from_all_users'			=> 1
				,'show_image' 				=> 1
				,'show_title' 				=> 1
				,'show_price' 				=> 1
				,'show_rating' 				=> 1
				,'show_nav'					=> 1
				,'auto_play'				=> 1
			), $atts));
			
			if ( !class_exists('WooCommerce') ){
				return;
			}
			
			if( $from_all_users ){
				$viewed_products = get_option('ts_recently_viewed_products', '');
				if( !$viewed_products ){
					$viewed_products = array();
				}
				else{
					$viewed_products = (array) explode( '|', $viewed_products );
				}
			}
			else{
				if( empty( $_COOKIE['ts_recently_viewed_products'] ) ){
					$viewed_products = array();
				}
				else{
					$viewed_products = (array) explode( '|', $_COOKIE['ts_recently_viewed_products'] );
				}
			}
			$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
			
			if( empty( $viewed_products ) ){
				return;
			}
			
			ob_start();
			
			$args = array(
				'post_type'				=> 'product'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'posts_per_page' 		=> $per_page
				,'post__in'				=> $viewed_products
				,'orderby' 				=> 'post__in'
				,'meta_query' 			=> WC()->query->get_meta_query()
				,'tax_query'           	=> WC()->query->get_tax_query()
			);
			
			$products = new WP_Query( $args );
			
			$classes = array();
			$classes[] = 'ts-recently-viewed-products-wrapper ts-shortcode ts-product ts-slider';
			$classes[] = $show_nav?'show-nav':'';
			$classes[] = 'rows-'.$rows;
			$classes[] = !$show_image?'no-thumbnail':'';
			$classes[] = !$title?'no-title':'';
			$classes = array_filter($classes);
			
			$data_attr = array();
			$data_attr[] = 'data-nav="'.$show_nav.'"';
			$data_attr[] = 'data-autoplay="'.$auto_play.'"';
			$data_attr[] = 'data-columns="'.absint($columns).'"';

			if( $products->have_posts() ): 
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo implode(' ', $data_attr) ?>>
				<?php if( $title ): ?>
					<header class="shortcode-heading-wrapper">
						<h3 class="heading-title"><?php echo esc_html($title); ?></h3>
					</header>
				<?php endif; ?>
				<div class="content-wrapper loading">
					<?php
					$count = 0;
					$options = array(
						'show_image'		=> $show_image
						,'show_title'		=> $show_title
						,'show_price'		=> $show_price
						,'show_rating'		=> $show_rating
					);		

					while( $products->have_posts() ){ 
						$products->the_post();	
						if( $count % $rows == 0 ){
							echo '<div class="per-slide">';
								echo '<ul class="product_list_widget">';
						}
						wc_get_template( 'content-widget-product.php', $options );
						if( $count % $rows == $rows - 1 || $count == $products->post_count - 1 ){
								echo '</ul>';
							echo '</div>';
						}
						$count++;
					}

					?>
				</div>
			</div>
			<?php
			endif;
			
			wp_reset_postdata();
			return '<div class="woocommerce columns-'.$columns.'">' . ob_get_clean() . '</div>';
	}	
}
add_shortcode('ts_recently_viewed_products_slider', 'ts_recently_viewed_products_slider_shortcode');
?>
