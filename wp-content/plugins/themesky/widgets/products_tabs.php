<?php
add_action('widgets_init', 'ts_products_tabs_load_widgets');

function ts_products_tabs_load_widgets()
{
	register_widget('TS_Products_Tabs_Widget');
}

if( !class_exists('TS_Products_Tabs_Widget') ){
	class TS_Products_Tabs_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'ts-products-tabs-widget', 'description' => esc_html__('Display your products in vertical tabs. Each tab contains one product', 'themesky'));
			parent::__construct('ts_products_tabs', esc_html__('TS - Products Tabs', 'themesky'), $widgetOps);
		}

		function widget( $args, $instance ) {
			
			if( !class_exists('WooCommerce') ){
				return;
			}
			
			extract($args);
			$title 				= apply_filters('widget_title', $instance['title']);
			$limit 				= ($instance['limit'] != 0)?absint($instance['limit']):4;
			$product_type 		= $instance['product_type'];
			$product_cats 		= $instance['product_cats'];
			$show_thumbnail 	= empty($instance['show_thumbnail'])?0:$instance['show_thumbnail'];
			$show_categories 	= empty($instance['show_categories'])?0:$instance['show_categories'];
			$show_product_title = empty($instance['show_product_title'])?0:$instance['show_product_title'];
			$show_price 		= empty($instance['show_price'])?0:$instance['show_price'];
			$show_rating 		= empty($instance['show_rating'])?0:$instance['show_rating'];
			$show_tab_number 	= empty($instance['show_tab_number'])?0:$instance['show_tab_number'];
			$thumbnail_border 	= empty($instance['thumbnail_border'])?0:$instance['thumbnail_border'];
			
			$options = array(
					'show_image'		=> $show_thumbnail
					,'show_label'		=> 0
					,'show_title'		=> $show_product_title
					,'show_sku'			=> 0
					,'show_price'		=> $show_price
					,'show_short_desc'	=> 0
					,'show_categories'	=> $show_categories
					,'show_rating'		=> $show_rating
					,'show_add_to_cart'	=> 1
				);
			if( function_exists('ts_remove_product_hooks_shortcode') ){
				ts_remove_product_hooks_shortcode( $options );
			}
			
			$args = array(
				'post_type'				=> 'product'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'posts_per_page' 		=> $limit
				,'orderby' 				=> 'date'
				,'order' 				=> 'desc'
				,'meta_query' 			=> WC()->query->get_meta_query()
				,'tax_query'           	=> WC()->query->get_tax_query()
			);
			
			switch( $product_type ){
				case 'sale':
					$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
				break;
				case 'featured':
					$args['tax_query'][] = array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
						'operator' => 'IN',
					);
				break;
				case 'best_selling':
					$args['meta_key'] 	= 'total_sales';
					$args['orderby'] 	= 'meta_value_num';
					$args['order'] 		= 'desc';
				break;
				case 'top_rated':		
					$args['meta_key'] 	= '_wc_average_rating';
					$args['orderby'] 	= 'meta_value_num';
					$args['order'] 		= 'desc';
				break;
				case 'mixed_order':
					$args['orderby'] 	= 'rand';
				break;
				default: /* Recent */
					$args['orderby'] 	= 'date';
					$args['order'] 		= 'desc';
				break;
			}
			
			if( is_array($product_cats) && count($product_cats) > 0 ){
				$field_name = is_numeric($product_cats[0])?'term_id':'slug';
				$args['tax_query'][] = array(
											'taxonomy' 	=> 'product_cat'
											,'terms' 	=> $product_cats
											,'field' 	=> $field_name
										);
			}
			
			global $post, $product;
			
			echo $before_widget;
			
			if( $title ){
				echo $before_title . $title . $after_title;
			}
			
			$products = new WP_Query($args);
			if( $products->have_posts() ){
				
				$classes 	= array();
				$classes[] 	= 'ts-products-tabs-wrapper woocommerce';
				$classes[] 	= $show_tab_number?'show-tab-number':'';
				$classes[] 	= $thumbnail_border?'':'thumbnail-no-border';
				$shortcode_str = '[vc_tta_accordion]';
				?>
				<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
					<?php 
					woocommerce_product_loop_start();
					
					while( $products->have_posts() ){
						$products->the_post(); 
						$shortcode_str .= '[vc_tta_section tab_id="ts-acc-'.rand().'" title="'.esc_attr(get_the_title()).'"]';
						ob_start();
						wc_get_template_part( 'content', 'product' );
						$shortcode_str .= ob_get_clean();
						$shortcode_str .= '[/vc_tta_section]';
					}
					
					$shortcode_str .= '[/vc_tta_accordion]';
					echo do_shortcode($shortcode_str);
					
					woocommerce_product_loop_end();
					?>
				</div>
				<?php
			}
			echo $after_widget;
			
			if( function_exists('ts_restore_product_hooks_shortcode') ){
				ts_restore_product_hooks_shortcode();
			}
			
			wp_reset_postdata();
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['title'] 				= strip_tags($new_instance['title']);
			$instance['product_type'] 		= $new_instance['product_type'];
			$instance['product_cats'] 		= $new_instance['product_cats'];
			$instance['limit'] 				= absint($new_instance['limit']);
			$instance['show_thumbnail'] 	= $new_instance['show_thumbnail'];
			$instance['show_categories'] 	= $new_instance['show_categories'];
			$instance['show_product_title'] = $new_instance['show_product_title'];
			$instance['show_price'] 		= $new_instance['show_price'];
			$instance['show_rating'] 		= $new_instance['show_rating'];
			$instance['show_tab_number'] 	= $new_instance['show_tab_number'];
			$instance['thumbnail_border'] 	= $new_instance['thumbnail_border'];
			return $instance;
		}

		function form( $instance ) {
			
			$defaults = array(
				'title'					=> 'Recommended Products'
				,'product_type'			=> 'best_selling'
				,'product_cats'			=> array()
				,'limit'				=> 4
				,'show_thumbnail' 		=> 1
				,'show_categories' 		=> 0
				,'show_product_title' 	=> 1
				,'show_price' 			=> 1
				,'show_rating' 			=> 1
				,'show_tab_number' 		=> 1
				,'thumbnail_border' 	=> 1
			);
		
			$instance = wp_parse_args( (array) $instance, $defaults );	
			$categories = $this->get_list_categories(0);
			if( !is_array($instance['product_cats']) ){
				$instance['product_cats'] = array();
			}
			
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Enter your title', 'themesky'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('product_type'); ?>"><?php esc_html_e('Product type', 'themesky'); ?> </label>
				<select class="widefat" id="<?php echo $this->get_field_id('product_type'); ?>" name="<?php echo $this->get_field_name('product_type'); ?>">
					<option value="recent" <?php selected($instance['product_type'], 'recent'); ?>><?php esc_html_e('Recent', 'themesky'); ?></option>
					<option value="sale" <?php selected($instance['product_type'], 'sale'); ?>><?php esc_html_e('Sale', 'themesky'); ?></option>
					<option value="featured" <?php selected($instance['product_type'], 'featured'); ?>><?php esc_html_e('Featured', 'themesky'); ?></option>
					<option value="best_selling" <?php selected($instance['product_type'], 'best_selling'); ?>><?php esc_html_e('Best selling', 'themesky'); ?></option>
					<option value="top_rated" <?php selected($instance['product_type'], 'top_rated'); ?>><?php esc_html_e('Top rated', 'themesky'); ?></option>
					<option value="mixed_order" <?php selected($instance['product_type'], 'mixed_order'); ?>><?php esc_html_e('Mixed order', 'themesky'); ?></option>
				</select>
			</p>
			
			<p>
				<label><?php esc_html_e('Select categories', 'themesky'); ?></label>
				<div class="categorydiv">
					<div class="tabs-panel">
						<ul class="categorychecklist">
							<?php foreach($categories as $cat){ ?>
							<li>
								<label>
									<input type="checkbox" name="<?php echo $this->get_field_name('product_cats'); ?>[<?php esc_attr($cat->term_id); ?>]" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo (in_array($cat->term_id,$instance['product_cats']))?'checked':''; ?> />
									<?php echo esc_html($cat->name); ?>
								</label>
								<?php $this->get_list_sub_categories($cat->term_id, $instance); ?>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_html_e('Number of posts to show', 'themesky'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" min="0" value="<?php echo esc_attr($instance['limit']); ?>" />
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" value="1" <?php echo ($instance['show_thumbnail'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php esc_html_e('Show thumbnail', 'themesky'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_categories'); ?>" name="<?php echo $this->get_field_name('show_categories'); ?>" value="1" <?php echo ($instance['show_categories'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_categories'); ?>"><?php esc_html_e('Show categories', 'themesky'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_product_title'); ?>" name="<?php echo $this->get_field_name('show_product_title'); ?>" value="1" <?php echo ($instance['show_product_title'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_product_title'); ?>"><?php esc_html_e('Show product title', 'themesky'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_price'); ?>" name="<?php echo $this->get_field_name('show_price'); ?>" value="1" <?php echo ($instance['show_price'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_price'); ?>"><?php esc_html_e('Show price', 'themesky'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_rating'); ?>" name="<?php echo $this->get_field_name('show_rating'); ?>" value="1" <?php echo ($instance['show_rating'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_rating'); ?>"><?php esc_html_e('Show rating', 'themesky'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_tab_number'); ?>" name="<?php echo $this->get_field_name('show_tab_number'); ?>" value="1" <?php echo ($instance['show_tab_number'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_tab_number'); ?>"><?php esc_html_e('Show tab number', 'themesky'); ?></label>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('thumbnail_border'); ?>" name="<?php echo $this->get_field_name('thumbnail_border'); ?>" value="1" <?php echo ($instance['thumbnail_border'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('thumbnail_border'); ?>"><?php esc_html_e('Thumbnail border', 'themesky'); ?></label>
			</p>
			
			<?php 
		}
		
		function get_list_categories( $cat_parent_id ){
			if ( !class_exists('WooCommerce') ) {
				return array();
			}
			$args = array(
					'taxonomy' 			=> 'product_cat'
					,'hierarchical'		=> 1
					,'parent'			=> $cat_parent_id
					,'title_li'			=> ''
					,'child_of'			=> 0
				);
			$cats = get_categories($args);
			return $cats;
		}
		
		function get_list_sub_categories( $cat_parent_id, $instance ){
			$sub_categories = $this->get_list_categories($cat_parent_id); 
			if( count($sub_categories) > 0){
			?>
				<ul class="children">
					<?php foreach( $sub_categories as $sub_cat ){ ?>
						<li>
							<label>
								<input type="checkbox" name="<?php echo $this->get_field_name('product_cats'); ?>[<?php esc_attr($sub_cat->term_id); ?>]" value="<?php echo esc_attr($sub_cat->term_id); ?>" <?php echo (in_array($sub_cat->term_id,$instance['product_cats']))?'checked':''; ?> />
								<?php echo esc_html($sub_cat->name); ?>
							</label>
							<?php $this->get_list_sub_categories($sub_cat->term_id, $instance); ?>
						</li>
					<?php } ?>
				</ul>
			<?php }
		}
		
	}
}

