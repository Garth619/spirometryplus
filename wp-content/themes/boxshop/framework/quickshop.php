<?php 
if( class_exists('WooCommerce') && !class_exists('Boxshop_Quickshop') && !wp_is_mobile() ){
		
	class Boxshop_Quickshop{
	
		public $id;
		
		function __construct(){
			global $boxshop_theme_options;
			if( !empty($boxshop_theme_options['ts_enable_quickshop']) ){
				$this->add_hook();
			}
		}
		
		function add_quickshop_button(){
			global $product;
			$href = admin_url('admin-ajax.php', is_ssl()?'https':'http') . '?ajax=true&action=boxshop_load_quickshop_content&product_id='.$product->get_id();
			echo '<div class="button-in quickshop">';
			echo '<a class="quickshop" href="'.esc_url($href).'"><i class="pe-7s-search"></i><span class="ts-tooltip button-tooltip">'.esc_html__('Quick view', 'boxshop').'</span></a>';
			echo '</div>';
		}
		
		function add_hook(){
			global $boxshop_theme_options;
			
			add_action('woocommerce_after_shop_loop_item_title', array($this, 'add_quickshop_button'), 10002 );
			
			/** Product content hook **/
			if( $boxshop_theme_options['ts_prod_title'] ){
				add_action('boxshop_quickshop_single_product_title', array($this, 'product_title'), 10);
			}
			if( $boxshop_theme_options['ts_prod_rating'] ){
				add_action('boxshop_quickshop_single_product_summary', 'woocommerce_template_single_rating', 10);
			}
			if( $boxshop_theme_options['ts_prod_excerpt'] ){
				add_action('boxshop_quickshop_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			}
			if( $boxshop_theme_options['ts_prod_availability'] ){
				add_action('boxshop_quickshop_single_product_summary', 'boxshop_template_single_availability', 30);
			}
			if( $boxshop_theme_options['ts_prod_sku'] ){
				add_action('boxshop_quickshop_single_product_summary', 'boxshop_template_single_sku', 40);
			}
			if( $boxshop_theme_options['ts_prod_price'] ){
				add_action('boxshop_quickshop_single_product_summary', 'woocommerce_template_single_price', 50);
			}
			if( !$boxshop_theme_options['ts_enable_catalog_mode'] && $boxshop_theme_options['ts_prod_add_to_cart'] ){
				add_action('boxshop_quickshop_single_product_summary', 'woocommerce_template_single_add_to_cart', 60); 
			}
			if( function_exists('boxshop_add_wishlist_button_to_product_list') ){
				add_action('boxshop_quickshop_single_product_summary', 'boxshop_add_wishlist_button_to_product_list', 70);
			}
			add_action('boxshop_quickshop_single_product_summary', array($this, 'email_button'), 80);
			
			/* Register ajax */
			add_action('wp_ajax_boxshop_load_quickshop_content', array( $this, 'load_quickshop_content_callback') );
			add_action('wp_ajax_nopriv_boxshop_load_quickshop_content', array( $this, 'load_quickshop_content_callback') );		
		}
		
		function product_title(){
			?>
			<h1 itemprop="name" class="product_title entry-title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h1>
			<?php
		}
		
		function email_button(){
			?>
			<div class="email">
				<a href="mailto:?subject=<?php echo esc_attr(sanitize_title(get_the_title())); ?>&amp;body=<?php echo esc_url(get_permalink()); ?>">
					<i class="pe-7s-mail"></i>
				</a>
			</div>
			<?php
		}
		
		function filter_add_to_cart_url(){
			$ref_url = wp_get_referer();
			$ref_url = remove_query_arg( array('added-to-cart','add-to-cart'), $ref_url );
			$ref_url = add_query_arg( array( 'add-to-cart' => $this->id ), $ref_url );
			return esc_url( $ref_url );
		}
		
		function filter_review_link( $review_link = '#reviews' ){
			global $product;
			$link = get_permalink( $product->get_id() );
			if( $link ){
				return trailingslashit($link) . $review_link;
			}
			else{
				return $review_link;
			}
		}
		
		function load_quickshop_content_callback(){
			global $post, $product, $boxshop_theme_options;
			$prod_id = absint($_GET['product_id']);
			$post = get_post( $prod_id );
			$product = wc_get_product( $prod_id );

			if( $prod_id <= 0 ){
				die( esc_html__('Invalid Product', 'boxshop') );
			}
			if( !isset($post->post_type) || strcmp($post->post_type,'product') != 0 ){
				die( esc_html__('Invalid Product', 'boxshop') );
			}
			
			$this->id = $prod_id;
			
			add_filter( 'woocommerce_add_to_cart_url', array($this, 'filter_add_to_cart_url'), 10 );
			add_filter( 'boxshop_woocommerce_review_link_filter', array($this, 'filter_review_link'), 10 );
			
			$_wrapper_class = 'ts-quickshop-wrapper product type-' . $product->get_type();
			if( !$boxshop_theme_options['ts_prod_thumbnail_border'] ){
				$_wrapper_class .= ' thumbnail-no-border';
			}
			ob_start();	
			?>		
			<div itemscope itemtype="http://schema.org/Product" id="product-<?php echo get_the_ID();?>" <?php post_class( apply_filters('single_product_wrapper_class',$_wrapper_class  ) ); ?>>
					
				<div class="images-slider-wrapper">
				<?php	
					$image_ids = array();
					/* Main image */
					if ( has_post_thumbnail() ){
						$image_ids[] = get_post_thumbnail_id();				
					}
					/* Thumbnails */
					$attachment_ids = $product->get_gallery_image_ids();
					if( is_array($attachment_ids) ){
						$image_ids = array_merge($image_ids, $attachment_ids);
						if( count($image_ids) > 5 ){
							$image_ids = array_slice($image_ids, 0, 5);
						}
					}
					
					if( count($image_ids) == 0 ){ /* Always show image */
						$image_ids[] = 0;
					}
					
					?>
					<div class="image-items">
						<?php foreach( $image_ids as $image_id ): ?>
						<?php 
							$image_info = wp_get_attachment_image_src($image_id, 'woocommerce_single');
							$image_link = isset($image_info[0])?$image_info[0]:wc_placeholder_img_src();
						?>
						<div class="image-item">
							<img src="<?php echo esc_url($image_link); ?>" alt="" />
						</div>
						<?php endforeach; ?>
					</div>
					
				</div>
				<!-- Product summary -->
				<div class="summary entry-summary">
					<?php do_action('boxshop_quickshop_single_product_title'); ?>
					<?php do_action('boxshop_quickshop_single_product_summary'); ?>
				</div>
			
			</div>
				
			<?php
			
			remove_filter( 'woocommerce_add_to_cart_url', array($this, 'filter_add_to_cart_url'), 10 );
			remove_filter( 'boxshop_woocommerce_review_link_filter', array($this, 'filter_review_link'), 10 );

			$return_html = ob_get_clean();
			wp_reset_postdata();
			die($return_html);
		}
		
	}
	new Boxshop_Quickshop();
}
?>
