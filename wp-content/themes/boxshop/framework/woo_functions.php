<?php 
/*** Tiny account ***/
if( !function_exists('boxshop_tiny_account') ){
	function boxshop_tiny_account(){
		$login_url = '#';
		$register_url = '#';
		$profile_url = '#';
		$logout_url = wp_logout_url(get_permalink());
		
		if( class_exists('WooCommerce') ){
			$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
			if ( $myaccount_page_id ) {
			  $login_url = get_permalink( $myaccount_page_id );
			  $register_url = $login_url;
			  $profile_url = $login_url;
			}		
		}
		else{
			$login_url = wp_login_url();
			$register_url = wp_registration_url();
			$profile_url = admin_url( 'profile.php' );
		}
		
		global $wp;
		$redirect_to = home_url( add_query_arg( array(), $wp->request ) );
		
		$_user_logged = is_user_logged_in();
		ob_start();
		
		?>
		<div class="ts-tiny-account-wrapper">
			<div class="account-control">
				<i class="pe-7s-users"></i>
				<?php if( !$_user_logged ): ?>
					<a  class="login" href="<?php echo esc_url($login_url); ?>" title="<?php esc_html_e('Login','boxshop'); ?>"><span><?php esc_html_e('Login','boxshop');?></span></a>
					 / 
					<a class="sign-up" href="<?php echo esc_url($register_url); ?>" title="<?php esc_html_e('Create New Account','boxshop'); ?>"><span><?php esc_html_e('Sign up','boxshop');?></span></a>
				<?php else: ?>
					<a class="my-account" href="<?php echo esc_url($profile_url); ?>" title="<?php esc_html_e('My Account','boxshop'); ?>"><span><?php esc_html_e('My Account','boxshop');?></span></a> / 
					<a class="log-out" href="<?php echo esc_url($logout_url); ?>" title="<?php esc_html_e('Logout','boxshop'); ?>"><span><?php esc_html_e('Logout','boxshop');?></span></a>
				<?php endif; ?>
			</div>
			<?php if( !$_user_logged ): ?>
			<div class="account-dropdown-form dropdown-container">
				<div class="form-content">	
					<form name="ts-login-form" class="ts-login-form" action="<?php echo esc_url(wp_login_url()); ?>" method="post">
			
						<p class="login-username">
							<label><?php esc_html_e('Username', 'boxshop'); ?></label>
							<input type="text" name="log" class="input" value="" size="20" autocomplete="off">
						</p>
						<p class="login-password">
							<label><?php esc_html_e('Password', 'boxshop'); ?></label>
							<input type="password" name="pwd" class="input" value="" size="20">
						</p>
						
						<p class="login-submit">
							<input type="submit" name="wp-submit" class="button" value="<?php esc_html_e('Login', 'boxshop'); ?>">
							<input type="hidden" name="redirect_to" value="<?php echo esc_url($redirect_to); ?>">
						</p>
						
					</form>
		
					<p class="forgot-pass"><a href="<?php echo esc_url(wp_lostpassword_url()); ?>" title="<?php esc_html_e('Forgot Your Password?','boxshop');?>"><?php esc_html_e('Forgot Your Password?','boxshop');?></a></p>
				</div>
			</div>
			<?php endif; ?>
		</div>
		
		<?php
		return ob_get_clean();
	}
}

/*** Tiny Cart ***/
if( !function_exists('boxshop_tiny_cart') ){
	function boxshop_tiny_cart(){
		if( !class_exists('WooCommerce') ){
			return '';
		}
		$cart_empty = WC()->cart->is_empty();
		$cart_url = wc_get_cart_url();
		$checkout_url = wc_get_checkout_url();
		$cart_number = WC()->cart->get_cart_contents_count();
		ob_start();
		?>
			<div class="ts-tiny-cart-wrapper">
				<a class="cart-control" href="<?php echo esc_url($cart_url); ?>" title="<?php esc_html_e('View your shopping bag','boxshop');?>">
					<span class="pe-7s-cart cart-icon"></span>
					<span class="cart-number"><?php echo esc_html($cart_number) . ' ' . _n('item', 'items', $cart_number , 'boxshop') ?></span>
					<span class="hyphen">-</span>
					<span class="cart-total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
				</a>
				<span class="cart-drop-icon drop-icon"></span>
				<div class="cart-dropdown-form dropdown-container">
					<div class="form-content">
						<?php if( $cart_empty ): ?>
							<label><?php esc_html_e('Your shopping cart is empty', 'boxshop'); ?></label>
						<?php else: ?>
							<ul class="cart_list">
								<?php 
								$cart = WC()->cart->get_cart();
								foreach( $cart as $cart_item_key => $cart_item ):
									$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
									if ( !( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) ){
										continue;
									}
										
									$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
									$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
									<li>
										<a href="<?php echo esc_url($product_permalink); ?>">
											<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
										</a>
										<div class="cart-item-wrapper">	
											<h3 class="product-name">
												<a href="<?php echo esc_url($product_permalink); ?>">
													<?php echo apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key); ?>
												</a>
											</h3>
											<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . $cart_item['quantity'] . '</span> ', $cart_item, $cart_item_key ); ?>
											<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="price"><span class="icon"> x </span> ' . $product_price . '</span>', $cart_item, $cart_item_key ); ?>
											<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-cart_item_key="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'boxshop' ), $cart_item_key ), $cart_item_key ); ?>
										</div>
									</li>
								
								<?php endforeach; ?>
							</ul>
							<div class="dropdown-footer">
								<div class="total"><span class="total-title"><?php esc_html_e('Subtotal :', 'boxshop');?></span><?php echo WC()->cart->get_cart_subtotal(); ?> </div>
								
								<a href="<?php echo esc_url($cart_url); ?>" class="button button-border-primary view-cart"><?php esc_html_e('View cart', 'boxshop'); ?></a>
								<a href="<?php echo esc_url($checkout_url); ?>" class="button checkout button-border-secondary"><?php esc_html_e('Checkout', 'boxshop'); ?></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php
		return ob_get_clean();
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'boxshop_tiny_cart_filter');
function boxshop_tiny_cart_filter($fragments){
	$fragments['.ts-tiny-cart-wrapper'] = boxshop_tiny_cart();
	return $fragments;
}

/** Tini wishlist **/
function boxshop_tini_wishlist(){
	if( !(class_exists('WooCommerce') && class_exists('YITH_WCWL')) ){
		return;
	}
	
	ob_start();
	
	$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );
	if( function_exists( 'wpml_object_id_filter' ) ){
		$wishlist_page_id = wpml_object_id_filter( $wishlist_page_id, 'page', true );
	}
	$wishlist_page = get_permalink( $wishlist_page_id );
	
	$count = yith_wcwl_count_products();
	
	?>

	<a title="<?php  esc_html_e('Wishlist','boxshop'); ?>" href="<?php echo esc_url($wishlist_page); ?>" class="tini-wishlist">
		<i class="pe-7s-like"></i>
		<?php esc_html_e('Wishlist','boxshop'); ?> <?php echo '('.($count > 0?zeroise($count, 2):'0').')'; ?>
	</a>

	<?php
	$tini_wishlist = ob_get_clean();
	return $tini_wishlist;
}

function boxshop_update_tini_wishlist() {
	die(boxshop_tini_wishlist());
}

add_action('wp_ajax_boxshop_update_tini_wishlist', 'boxshop_update_tini_wishlist');
add_action('wp_ajax_nopriv_boxshop_update_tini_wishlist', 'boxshop_update_tini_wishlist');

if( !function_exists('boxshop_woocommerce_multilingual_currency_switcher') ){
	function boxshop_woocommerce_multilingual_currency_switcher(){
		if( class_exists('woocommerce_wpml') && class_exists('WooCommerce') && class_exists('SitePress') ){
			global $sitepress, $woocommerce_wpml;
			
			if( !isset($woocommerce_wpml->multi_currency) ){
				return;
			}
			
			$settings = $woocommerce_wpml->get_settings();
			
			$format = isset($settings['wcml_curr_template']) && $settings['wcml_curr_template'] != '' ? $settings['wcml_curr_template']:'%code%';
			$wc_currencies = get_woocommerce_currencies();
			if( !isset($settings['currencies_order']) ){
				$currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
			}else{
				$currencies = $settings['currencies_order'];
			}
			
			$selected_html = '';
			foreach( $currencies as $currency ){
				if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
					$currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
													array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
						
					if( $currency == $woocommerce_wpml->multi_currency->get_client_currency() ){
						$selected_html = '<a href="javascript: void(0)" class="wcml_selected_currency">'.$currency_format.'</a>';
						break;
					}
				}
			}
			
			echo '<div class="wcml_currency_switcher">';
				echo  $selected_html;
				echo '<ul>';
			
				foreach( $currencies as $currency ){
					if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
						$currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
														array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
						echo '<li><a rel="' . $currency . '">' . $currency_format . '</a></li>';
					}
				}
				
				echo '</ul>';
			echo '</div>';
		}
		else if( class_exists('WOOCS') && class_exists('WooCommerce') ){ /* Support WooCommerce Currency Switcher */
			global $WOOCS;
			$currencies = $WOOCS->get_currencies();
			if( !is_array($currencies) ){
				return;
			}
			?>
			<div class="wcml_currency_switcher">
				<a href="javascript: void(0)" class="wcml_selected_currency"><?php echo esc_html($WOOCS->current_currency); ?></a>
				<ul>
					<?php 
					foreach( $currencies as $key => $currency ){
						$link = add_query_arg('currency', $currency['name']);
						echo '<li rel="'.$currency['name'].'"><a href="'.esc_url($link).'">'.esc_html($currency['name']).'</a></li>';
					}
					?>
				</ul>
			</div>
			<?php
		}else{/* Demo html */
			?>
			<div class="wcml_currency_switcher">
				<a href="javascript: void(0)" class="wcml_selected_currency">USD</a>
				<ul>
					<li><a rel="USD">USD</a></li>
					<li><a rel="EUR">EUR</a></li>
					<li><a rel="AUD">AUD</a></li>
				</ul>
			</div>
			<?php
		}
	}
}

add_filter( 'wcml_multi_currency_ajax_actions', 'boxshop_wcml_multi_currency_ajax_actions_filter' );
if( !function_exists('boxshop_wcml_multi_currency_ajax_actions_filter') ){
	function boxshop_wcml_multi_currency_ajax_actions_filter( $actions ){
		$actions[] = 'remove_from_wishlist';
		$actions[] = 'boxshop_ajax_search';
		$actions[] = 'boxshop_load_quickshop_content';
		$actions[] = 'ts_get_product_content_in_category_tab';
		return $actions;
	}
}

if( !function_exists('boxshop_wpml_language_selector') ){
	function boxshop_wpml_language_selector(){
		if( class_exists('SitePress') ){
			do_action('wpml_add_language_selector');
		}
		else{ /* Demo html */
			?>
			<div id="lang_sel_click" class="lang_sel_click">
				<ul>
					<li>
						<a href="#" class="lang_sel_sel icl-en">English</a>
						<ul style="visibility: hidden;">
							<li class="icl-fr"><a rel="alternate" href="#"><span class="icl_lang_sel_native">French</span></a></li>
							<li class="icl-de"><a rel="alternate" href="#"><span class="icl_lang_sel_native">German</span></a></li>
						</ul>
					</li>
				</ul>
			</div>
			<?php
		}
	}
}
?>
