<?php 
/**
 * Plugin Name: ThemeSky Demo
 * Plugin URI: http://theme-sky.com
 * Description: Add Demo Options
 * Version: 1.0.0
 * Author: ThemeSky Team
 * Author URI: http://theme-sky.com
 */
class ThemeSky_Demo{

	function __construct(){
		add_action('template_redirect', array($this, 'template_redirect'), 1);
		add_action('init', array($this, 'update_portfolio_like_action'));
		
		add_filter('ts_metabox_options_page_options', array($this, 'metabox_page_options'));
		
		if( !is_admin() && !defined('DOING_AJAX') && isset($_GET['color']) ){
			add_filter('boxshop_custom_style_data', array($this, 'custom_style_data'));
			add_action('wp_enqueue_scripts', array($this, 'add_inline_custom_style'), 1000000);
		}
		
		/* Remove some scripts, styles from demo */
		add_action('wp_enqueue_scripts', array($this, 'remove_some_scripts_on_demo'), 10000);
		
		/* remove emoji */
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}
	
	function template_redirect(){
		global $boxshop_theme_options, $post;
		
		if( is_page() ){
			$page_intro = get_post_meta( $post->ID, 'ts_page_intro', true);
			if( $page_intro ){
				add_filter('body_class', function( $classes ){ $classes[]='ts-header-intro'; return $classes; });
				add_filter('theme_mod_background_image', '__return_empty_string');
				add_filter('ts_page_intro_feature_filter', '__return_true');
				add_action('wp_footer', array($this, 'page_intro_script_handle'));
				add_action('wp_enqueue_scripts', array($this, 'page_intro_dequeue_scripts'), 9999);
				$boxshop_theme_options['ts_responsive'] = 0;
				$boxshop_theme_options['ts_enable_tiny_shopping_cart'] = 0;
				add_action('wp_enqueue_scripts', array($this, 'page_intro_dynamic_style_handle'), 9999);
			}
			
			if( is_page_template('page-templates/blog-template.php') && isset($_GET['style']) ){
				$boxshop_theme_options['ts_blog_style'] = $_GET['style'];
			}
		}
		
		if( is_singular('product') ){
			if( isset($_GET['options']) ){
				$options = $_GET['options'];
				$options = explode('-', $options);
				if( is_array($options) && count($options) > 0 ){
					if( isset($options[0]) ){ /* Thumbnail vertical slider */
						$boxshop_theme_options['ts_prod_thumbnails_style'] = $options[0]?'vertical':'horizontal';
					}
					
					if( isset($options[1]) ){ /* Accordion tabs */
						$boxshop_theme_options['ts_prod_accordion_tabs'] = $options[1];
					}
					
					if( isset($options[2]) ){ /* Tab inside summary */
						$boxshop_theme_options['ts_prod_tabs_position'] = $options[2]?'inside_summary':'after_summary';
					}
					
					if( isset($options[3]) ){ /* Product Sidebar */
						switch( $options[3] ){
							case 1:
								$boxshop_theme_options['ts_prod_layout'] = '1-1-0';
							break;
							case 2:
								$boxshop_theme_options['ts_prod_layout'] = '0-1-1';
							break;
							case 3:
								$boxshop_theme_options['ts_prod_layout'] = '1-1-1';
							break;
							default:
								$boxshop_theme_options['ts_prod_layout'] = '0-1-0';
						}
					}
					
					if( isset($options[4]) ){ /* Product Attribute Dropdown */
						$boxshop_theme_options['ts_prod_attr_dropdown'] = $options[4]?1:0;
					}
					
				}
			}
		}
		
		if( is_tax('product_cat') || is_tax('product_tag') || is_post_type_archive('product') ){
			if( isset( $_GET['options'] ) ){
				$options = explode('-', $_GET['options']);
				if( is_array($options) && count($options) > 0 ){
					if( isset($options[0]) ){
						$boxshop_theme_options['ts_prod_cat_top_content'] = $options[0]?1:0;
					}
					if( isset($options[1]) ){
						switch( $options[1] ){
							case 1:
								$boxshop_theme_options['ts_prod_cat_layout'] = '1-1-0';
							break;
							case 2:
								$boxshop_theme_options['ts_prod_cat_layout'] = '0-1-1';
							break;
							case 3:
								$boxshop_theme_options['ts_prod_cat_layout'] = '1-1-1';
							break;
							default:
								$boxshop_theme_options['ts_prod_cat_layout'] = '0-1-0';
						}
					}
				}
			}
			add_action('wp_enqueue_scripts', array($this, 'shop_breadcrumb_color'), 10000);
		}
		
		if( isset($_GET['rtl']) ){
			$boxshop_theme_options['ts_enable_rtl'] = (int)$_GET['rtl'];
		}
		
	}
	
	function shop_breadcrumb_color(){
		$breadcrumb_css = 	'.breadcrumb-title-wrapper.breadcrumb-v2 .breadcrumb-title h1{color: #202020;}
							.breadcrumb-title-wrapper.breadcrumb-v2 .breadcrumb-title *{color: #444444;}
							';
		wp_add_inline_style('boxshop-style', $breadcrumb_css);
	}
	
	function page_intro_script_handle(){
	?>
		<script type="text/javascript">
			if( !jQuery('body').hasClass('ts_desktop') ){
				jQuery('.wpb_animate_when_almost_visible').removeClass('wpb_animate_when_almost_visible');
			}
			jQuery(document).ready(function($){
				"use strict";
				
				$('body.ts-header-intro .menu a').bind('click', function(e){
					var href = $(this).attr('href');
					if( href.indexOf('#') == 0 ){
						e.preventDefault();
						var section = $(href);
						if( section.length != 0 ){
							var extra_space = 0;
							var offset_top = section.offset().top;
							offset_top -= extra_space;
							var scroll_top = $(window).scrollTop();
							var speed_mul = Math.ceil( Math.abs(offset_top - scroll_top) / 6000 );
							$('body,html').animate({
								scrollTop: offset_top
							}, 1500 * speed_mul);
						}
						else{
							if( $(this).parents('li.logo-header-menu').length > 0 ){
								$('body,html').animate({
									scrollTop: 0
								}, 2000);
							}
						}
						return false;
					}
				});
				
				$('body.ts-header-intro img.lazy-loading').load(function(){
					$(this).removeClass('lazy-loading').addClass('lazy-loaded');
				});
				$('body.ts-header-intro img.lazy-loading').each(function(){
					if( $(this).data('src') ){
						$(this).attr('src', $(this).data('src'));
					}
				});
				
				$('body.ts-header-intro .ts-feature-wrapper a').bind('click', function(){
					return false;
				});
			});
		</script>
	<?php
	}
	
	function page_intro_dequeue_scripts(){
		wp_dequeue_style('woocommerce-layout');
		wp_dequeue_style('woocommerce-smallscreen');
		wp_dequeue_style('woocommerce-general');
		wp_dequeue_style('woocommerce_prettyPhoto_css');
		wp_dequeue_style('prettyPhoto');
		wp_dequeue_style('jquery-colorbox');
		wp_dequeue_style('jquery-selectBox');
		wp_dequeue_style('yith-wcwl-main');
		
		wp_dequeue_style('boxshop-dynamic-css');
		wp_dequeue_style('select2');
		wp_dequeue_style('owl-carousel');
		
		wp_dequeue_script('contact-form-7');
		
		wp_dequeue_script('woocommerce');
		wp_dequeue_script('wc-cart-fragments');
		wp_dequeue_script('wc-add-to-cart');
		wp_dequeue_script('prettyPhoto');
		wp_dequeue_script('prettyPhoto-init');
		
		wp_dequeue_script('vc_woocommerce-add-to-cart-js');
		
		wp_dequeue_script('jquery-selectBox');
		wp_dequeue_script('jquery-yith-wcwl');
		
		wp_dequeue_script('yith-woocompare-main');
		wp_dequeue_script('jquery-colorbox');
		
		wp_dequeue_script('select2');
		wp_dequeue_script('wc-add-to-cart-variation');
		wp_dequeue_script('owl-carousel');
		
	}
	
	function page_intro_dynamic_style_handle(){
		$file_name = 'boxshop_intro';
		$upload_dir = wp_upload_dir();
		$filename_dir = trailingslashit($upload_dir['basedir']) . $file_name . '.css';
		$filename = trailingslashit($upload_dir['baseurl']) . $file_name . '.css';
		if( !file_exists($filename_dir) ){ /* Create File */
			global $wp_filesystem;
			if( empty( $wp_filesystem ) ) {
				require_once( ABSPATH .'/wp-admin/includes/file.php' );
				WP_Filesystem();
			}
			
			$creds = request_filesystem_credentials($filename_dir, '', false, false, array());
			if( ! WP_Filesystem($creds) ){
				return false;
			}
			
			if( $wp_filesystem ) {
				ob_start();
				include get_template_directory() . '/framework/dynamic_style.php';
				$dynamic_css = ob_get_contents();
				ob_end_clean();
		
				$wp_filesystem->put_contents(
					$filename_dir,
					$dynamic_css,
					FS_CHMOD_FILE
				);
			}
		}
		
		wp_enqueue_style('intro-dynamic-css', $filename);
	}
	
	function update_portfolio_like_action(){
		global $ts_portfolios;
		if( is_a($ts_portfolios, 'TS_Portfolios') && !is_user_logged_in() ){
			remove_action('wp_ajax_ts_portfolio_update_like', array($ts_portfolios, 'update_like'));
			remove_action('wp_ajax_nopriv_ts_portfolio_update_like', array($ts_portfolios, 'update_like'));
			add_action('wp_ajax_ts_portfolio_update_like', array($this, 'update_portfolio_like'));
			add_action('wp_ajax_nopriv_ts_portfolio_update_like', array($this, 'update_portfolio_like'));
			
			add_filter('ts_portfolio_like_num', array($this, 'portfolio_get_like'), 10, 2);
			add_filter('ts_portfolio_already_like', array($this, 'portfolio_already_like'), 10, 2);
		}
	}
	
	function update_portfolio_like(){
		if( isset($_POST['post_id']) ){
			global $ts_portfolios;
			$post_id = $_POST['post_id'];
			$like_num = $ts_portfolios->get_like($post_id);
			if( isset($_COOKIE['ts_portfolio_like_'.$post_id]) ){ /* Liked => Unlike */
				setcookie('ts_portfolio_like_'.$post_id, '', time()-3600, '/');
			}
			else{
				$like_num++;
				setcookie('ts_portfolio_like_'.$post_id, '1', time()+3600, '/');
			}
			die((string)$like_num);
		}
		die('');
	}
	
	function portfolio_get_like( $val, $post_id ){
		if( isset($_COOKIE['ts_portfolio_like_'.$post_id]) && !is_ajax() ){
			$val++;
		}
		return $val;
	}
	
	function portfolio_already_like( $val, $post_id ){
		if( isset($_COOKIE['ts_portfolio_like_'.$post_id]) ){
			return true;
		}
		return $val;
	}
	
	/* Metabox Page Options */
	function metabox_page_options( $options ){
		$options[] = array(
				'id'		=> 'page_options_demo_heading'
				,'label'	=> 'Page Options - Demo'
				,'desc'		=> ''
				,'type'		=> 'heading'
			);
		
		$options[] = array(
				'id'		=> 'page_intro'
				,'label'	=> 'Page Intro'
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
								'1'		=> 'Yes'
								,'0'	=> 'No'
								)
				,'default'	=> '0'
			);
	
		return $options;
	}
	
	/* Custom Style */
	function custom_style_data( $data = array() ){
		if( isset($_GET['color']) ){
			$color_name = $_GET['color'];
			$xml_folder = get_template_directory() . '/admin/color_xml/';
			$file_path = $xml_folder . $color_name . '.xml';
			if( file_exists($file_path) ){
				$obj_xml = simplexml_load_file( $file_path );
				foreach($obj_xml->children() as $child ){
					if( isset($child->name, $child->value) ){
						$name = (string)$child->name;
						$value = (string)$child->value;
						if( isset($data[$name]) ){
							$data[$name] = $value;
						}
					}
				}
			}
		}
		return $data;
	}
	
	function add_inline_custom_style(){
		$custom_file = get_template_directory() .'/framework/dynamic_style.php';
		if( file_exists( $custom_file ) ){
			wp_dequeue_style('boxshop-dynamic-css');
			
			ob_start();
			include $custom_file;
			$custom_css = ob_get_clean();
			
			wp_add_inline_style( 'boxshop-style', $custom_css );
		}
	}
	
	function remove_some_scripts_on_demo(){
		global $post;
		wp_dequeue_style('jquery-selectBox');
		wp_deregister_script('vc_tta_autoplay_script');
		
		if( isset($post->post_content) && !has_shortcode($post->post_content, 'contact-form-7') ){
			wp_dequeue_style('contact-form-7');
			wp_dequeue_script('jquery-form');
			wp_dequeue_script('contact-form-7');
		}
	}
	
} 
new ThemeSky_Demo();

?>
