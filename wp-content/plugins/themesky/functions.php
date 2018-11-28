<?php
if( !function_exists('ts_remove_product_hooks_shortcode') ){
	function ts_remove_product_hooks_shortcode( $options = array() ){
		if( isset($options['show_image']) && !$options['show_image'] ){
			remove_action('woocommerce_before_shop_loop_item_title', 'boxshop_template_loop_product_thumbnail', 10);
		}
		if( isset($options['show_title']) && !$options['show_title'] ){
			remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_product_title', 20);
		}
		if( isset($options['show_sku']) && !$options['show_sku'] ){
			remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_product_sku', 30);
		}
		if( isset($options['show_price']) && !$options['show_price'] ){
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 60);
		}
		if( isset($options['show_short_desc']) && !$options['show_short_desc'] ){
			remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_short_description', 40);
		}
		if( isset($options['show_rating']) && !$options['show_rating'] ){
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 50);
		}
		if( isset($options['show_label']) && !$options['show_label'] ){
			remove_action('woocommerce_after_shop_loop_item_title', 'boxshop_template_loop_product_label', 1);
		}
		if( isset($options['show_categories']) && !$options['show_categories'] ){
			remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_categories', 10);
		}
		if( isset($options['show_add_to_cart']) && !$options['show_add_to_cart'] ){
			remove_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_add_to_cart', 70);
			remove_action('woocommerce_after_shop_loop_item_title', 'boxshop_template_loop_add_to_cart', 10001 );
		}
	}
}

if( !function_exists('ts_restore_product_hooks_shortcode') ){
	function ts_restore_product_hooks_shortcode(){
		add_action('woocommerce_after_shop_loop_item_title', 'boxshop_template_loop_product_label', 1);
		add_action('woocommerce_before_shop_loop_item_title', 'boxshop_template_loop_product_thumbnail', 10);
		
		add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_categories', 10);
		add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_product_title', 20);
		add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_product_sku', 30);
		add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 50);
		add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_short_description', 40); 
		add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 60);
		add_action('woocommerce_after_shop_loop_item', 'boxshop_template_loop_add_to_cart', 70); 
		add_action('woocommerce_after_shop_loop_item_title', 'boxshop_template_loop_add_to_cart', 10001 );
	}
}

if( !function_exists('ts_filter_product_by_product_type') ){
	function ts_filter_product_by_product_type( &$args = array(), $product_type = 'recent' ){
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
	}
}

/*** Social Sharing ***/
if( !function_exists('ts_template_social_sharing') ){
	function ts_template_social_sharing(){
	?>
	<ul class="ts-social-sharing">

		<li class="facebook">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
		</li>
	
		<li class="twitter">
			<a href="https://twitter.com/home?status=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
		</li>
	
		<li class="pinterest">
			<?php $image_link  = wp_get_attachment_url( get_post_thumbnail_id() );?>
			<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink()); ?>&amp;media=<?php echo esc_url($image_link);?>" target="_blank"><i class="fa fa-pinterest"></i></a>
		</li>
	
		<li class="google-plus">
			<a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
		</li>
	
		<li class="linkedin">
			<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url(get_permalink()); ?>&amp;title=<?php echo esc_attr(sanitize_title(get_the_title())); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
		</li>
	
		<li class="reddit">
			<a href="http://www.reddit.com/submit?url=<?php echo esc_url(get_permalink()); ?>&amp;title=<?php echo esc_attr(sanitize_title(get_the_title())); ?>" target="_blank"><i class="fa fa-reddit"></i></a>
		</li>

	</ul>
	<?php
	}
}

if( !function_exists('ts_crawler_detect') ){
	function ts_crawler_detect(){
		if( isset($_SERVER['HTTP_USER_AGENT']) ){
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			$crawlers = array(
				'Google' 			=> 'Google'
				,'MSN' 				=> 'msnbot'
				,'Rambler' 			=> 'Rambler'
				,'Yahoo' 			=> 'Yahoo'
				,'AbachoBOT' 		=> 'AbachoBOT'
				,'accoona' 			=> 'Accoona'
				,'AcoiRobot' 		=> 'AcoiRobot'
				,'ASPSeek' 			=> 'ASPSeek'
				,'CrocCrawler' 		=> 'CrocCrawler'
				,'Dumbot' 			=> 'Dumbot'
				,'FAST-WebCrawler' 	=> 'FAST-WebCrawler'
				,'GeonaBot' 		=> 'GeonaBot'
				,'Gigabot' 			=> 'Gigabot'
				,'Lycos spider' 	=> 'Lycos'
				,'MSRBOT' 			=> 'MSRBOT'
				,'Altavista robot' 	=> 'Scooter'
				,'AltaVista robot' 	=> 'Altavista'
				,'ID-Search Bot' 	=> 'IDBot'
				,'eStyle Bot' 		=> 'eStyle'
				,'Scrubby robot' 	=> 'Scrubby'
				,'Facebook' 		=> 'facebookexternalhit'
				,'robot' 			=> 'robot'
				,'spider' 			=> 'spider'
				,'crawler' 			=> 'crawler'
				,'curl' 			=> 'curl'
			);
			$crawlers_agents = implode('|', $crawlers);
			
			if( preg_match('/'.$crawlers_agents.'/i', $user_agent) ){
				return true;
			}
			return false;
		}
		return false;
	}
}
