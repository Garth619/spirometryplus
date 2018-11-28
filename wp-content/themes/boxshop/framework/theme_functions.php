<?php 
/*** Activate Theme ***/
function boxshop_theme_activation(){
	global $pagenow;
	if( is_admin() && 'themes.php' == $pagenow && isset($_GET['activated']) )
	{
		if( get_option( 'woocommerce_single_image_width' ) === false ){
			/* Single Image */
			update_option( 'woocommerce_single_image_width', 550 );
			
			/* Thumbnail Image */
			update_option('woocommerce_thumbnail_image_width', 380);
			update_option('woocommerce_thumbnail_cropping', 'custom');
			update_option('woocommerce_thumbnail_cropping_custom_width', 380);
			update_option('woocommerce_thumbnail_cropping_custom_height', 434);
		}
		
		if( get_option( 'yith_woocompare_image_size' ) === false ){
			update_option( 'yith_woocompare_image_size', array( 'width' => '380', 'height' => '434', 'crop' => 1 ) );
		}
	}
}
add_action('admin_init', 'boxshop_theme_activation');

/*** Theme Setup ***/
function boxshop_theme_setup(){
	global $boxshop_theme_options;

	/* Add editor-style.css file*/
	add_editor_style();
	
	/* Add Theme Support */
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'quote', 'video' ) );		
	
	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-header' );
	
	$defaults = array(
		'default-color'         => ''
		,'default-image'        => ''
	);
	add_theme_support( 'custom-background', $defaults );
	
	add_theme_support( 'woocommerce' );
	
	if( isset($boxshop_theme_options['ts_prod_cloudzoom']) && !$boxshop_theme_options['ts_prod_cloudzoom'] ){
		add_theme_support( 'wc-product-gallery-lightbox' );
	}
	
	if ( ! isset( $content_width ) ){ $content_width = 1200; }
	
	/* Translation */
	load_theme_textdomain( 'boxshop', get_template_directory() . '/languages' );
	
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) ){
		require_once $locale_file;
	}
	
	/* Register Menu Location */
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Navigation', 'boxshop' ),
	) );
	register_nav_menus( array(
		'vertical' => esc_html__( 'Vertical Navigation', 'boxshop' ),
	) );
	register_nav_menus( array(
		'mobile' => esc_html__( 'Mobile Navigation', 'boxshop' ),
	) );
}
add_action( 'after_setup_theme', 'boxshop_theme_setup');

/*** Add Image Size ***/
function boxshop_add_image_size(){
	global $boxshop_theme_options;
	$menu_icon_width = isset($boxshop_theme_options['ts_menu_thumb_width'])?(int)$boxshop_theme_options['ts_menu_thumb_width']:16;
	$menu_icon_height = isset($boxshop_theme_options['ts_menu_thumb_height'])?(int)$boxshop_theme_options['ts_menu_thumb_height']:16;
	add_image_size('boxshop_menu_icon_thumb', $menu_icon_width, $menu_icon_height, true);
	
	add_image_size('boxshop_blog_shortcode_thumb', 480, 320, true);
	add_image_size('boxshop_blog_thumb', 1170, 780, true);
	
	add_image_size('boxshop_product_category_thumb', 500, 500, true);
}
boxshop_add_image_size();

add_filter('subcategory_archive_thumbnail_size', 'boxshop_subcategory_archive_thumbnail_size_filter');
function boxshop_subcategory_archive_thumbnail_size_filter(){
	return 'boxshop_product_category_thumb';
}

/*** Register google font ***/
function boxshop_register_google_font(){		
	global $boxshop_theme_options;
	
	$font_names = array();
	$font_weights = array();
	
	$google_font_options = array('body', 'heading', 'menu');
	
	foreach( $google_font_options as $option ){
		if( $boxshop_theme_options['ts_'.$option.'_font_enable_google_font'] ){
			$font_name = $boxshop_theme_options['ts_'.$option.'_font_google'];
			$font_names[] = $font_name;
			if( !isset($font_weights[$font_name]) ){
				$font_weights[$font_name] = array();
			}
			$font_weights[$font_name][] = $boxshop_theme_options['ts_'.$option.'_font_google_weight'];
		}
	}
	
	foreach( $font_names as $font_name ){
		$font_weight = $font_weights[$font_name];
		$font_weight = array_unique( array_filter($font_weight) ); // font weight may be empty
		$font_weight = implode( ',', $font_weight );
		boxshop_load_google_font( $font_name, $font_weight );
	}
}

function boxshop_load_google_font( $font_name = '', $font_weight = '300,400,500,600,700,800,900' ){
	if( strlen($font_name) > 0 ){
		$font_name_id = sanitize_title( $font_name );
		
		if( $font_weight ){
			$font_weight = ':' . $font_weight . '&subset=latin,latin-ext';
		}
		
		$font_url = add_query_arg( 'family', urlencode( $font_name . $font_weight ), '//fonts.googleapis.com/css');
		wp_enqueue_style( "google-fonts-{$font_name_id}", $font_url );
	}
}

/*** Register Front End Scripts  ***/
function boxshop_register_scripts(){
	global $boxshop_theme_options, $boxshop_page_datas;
	boxshop_register_google_font();
	
	wp_deregister_style( 'font-awesome' );
	wp_deregister_style( 'yith-wcwl-font-awesome' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'font-awesome' );
	
	wp_register_style( 'font-pe-icon', get_template_directory_uri() . '/css/pe-icon-7-stroke.min.css' );
	wp_enqueue_style( 'font-pe-icon' );
	
	wp_register_style( 'boxshop-reset', get_template_directory_uri() . '/css/reset.css' );
	wp_enqueue_style( 'boxshop-reset' );
	
	wp_enqueue_style( 'boxshop-style', get_stylesheet_uri() );
	
	if( isset($boxshop_theme_options['ts_responsive']) && (int) $boxshop_theme_options['ts_responsive'] == 1 ){
		wp_register_style( 'boxshop-responsive', get_template_directory_uri() . '/css/responsive.css' );
		wp_enqueue_style( 'boxshop-responsive' );
	}
	
	wp_deregister_style( 'owl-carousel' );
	wp_register_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
	wp_enqueue_style( 'owl-carousel' );
	
	wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css' );
	wp_enqueue_style( 'prettyPhoto' );
	
	wp_deregister_style( 'select2' );
	wp_register_style( 'select2', get_template_directory_uri() . '/css/select2.css' );
	wp_enqueue_style( 'select2' );
	
	if( isset($boxshop_theme_options['ts_enable_rtl']) && $boxshop_theme_options['ts_enable_rtl'] ){
		wp_register_style( 'boxshop-rtl', get_template_directory_uri() . '/css/rtl.css' );
		wp_enqueue_style( 'boxshop-rtl' );
		if( isset($boxshop_theme_options['ts_responsive']) && $boxshop_theme_options['ts_responsive'] ){
			wp_register_style( 'boxshop-rtl-responsive', get_template_directory_uri() . '/css/rtl-responsive.css' );
			wp_enqueue_style( 'boxshop-rtl-responsive' );
		}
	}
	
	wp_register_script( 'boxshop-include-scripts', get_template_directory_uri().'/js/include_scripts.js', array('jquery'), null, true);
	wp_enqueue_script( 'boxshop-include-scripts' );
	
	wp_dequeue_script( 'owl-carousel' );
	wp_register_script( 'owl-carousel', get_template_directory_uri().'/js/owl.carousel.min.js', array(), null, true);
	wp_enqueue_script( 'owl-carousel' );
	
	wp_register_script( 'boxshop-script', get_template_directory_uri().'/js/main.js', array('jquery'), null, true);
	wp_enqueue_script( 'boxshop-script' );
	
	if( is_singular('product') && $boxshop_theme_options['ts_prod_cloudzoom'] ){
		wp_register_script( 'cloud-zoom', get_template_directory_uri().'/js/cloud-zoom.js', array('jquery'), null, true);
		wp_enqueue_script( 'cloud-zoom' );
	}
	
	if( is_singular('product') && isset($boxshop_theme_options['ts_prod_thumbnails_style']) && $boxshop_theme_options['ts_prod_thumbnails_style'] == 'vertical' ){
		wp_register_script( 'jquery-caroufredsel', get_template_directory_uri().'/js/jquery.carouFredSel-6.2.1.min.js', array(), null, true);
		wp_enqueue_script( 'jquery-caroufredsel' );
	}
	
	wp_enqueue_script( 'wc-add-to-cart-variation' );
	
	wp_register_script( 'select2', get_template_directory_uri().'/js/select2.min.js', array(), null, true);
	wp_enqueue_script('select2');
	
	if( is_single() && get_option( 'thread_comments' ) ){ 	
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Custom JS */
	if( isset($boxshop_theme_options['ts_custom_javascript_code']) && $boxshop_theme_options['ts_custom_javascript_code'] ){
		wp_add_inline_script( 'boxshop-script', stripslashes( trim( $boxshop_theme_options['ts_custom_javascript_code'] ) ) );
	}
}
add_action('wp_enqueue_scripts', 'boxshop_register_scripts', 1000);

function boxshop_register_custom_style(){
	$upload_dir = wp_upload_dir();
	$filename = trailingslashit($upload_dir['baseurl']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
	if( is_ssl() ){
		$filename = str_replace('http://', 'https://', $filename);
	}
	$filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';

	if( file_exists( $filename_dir ) ){ 
		wp_enqueue_style('boxshop-dynamic-css', $filename);
	}
	else{
		ob_start();
		include_once get_template_directory() . '/framework/dynamic_style.php';
		$dynamic_css = ob_get_contents();
		ob_end_clean();
		wp_add_inline_style( 'boxshop-style', $dynamic_css );
	}
}
add_action('wp_enqueue_scripts', 'boxshop_register_custom_style', 9999);

/* Add font style to compare popup - can not use wp_enqueue_scripts hook */
if( isset($_GET['action']) && $_GET['action'] == 'yith-woocompare-view-table' ){
	add_action('wp_print_styles', 'boxshop_add_font_style_to_compare_popup', 1000);
}
function boxshop_add_font_style_to_compare_popup(){
	global $boxshop_theme_options;
	boxshop_register_google_font();
	wp_enqueue_style( 'boxshop-reset' );
	wp_enqueue_style( 'boxshop-style' );
	wp_enqueue_style( 'font-awesome' );
	if( $boxshop_theme_options['ts_enable_rtl'] ){
		wp_enqueue_style( 'boxshop-rtl' );
	}
	wp_enqueue_style('boxshop-dynamic-css');
}

/*** Register Back End Scripts ***/
function boxshop_register_admin_scripts(){
	wp_enqueue_media();
	
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'font-awesome' );
	
	wp_register_style( 'boxshop-admin-style', get_template_directory_uri() . '/css/admin_style.css' );
	wp_enqueue_style( 'boxshop-admin-style' );
	
	wp_register_script( 'boxshop-admin-script', get_template_directory_uri().'/js/admin_main.js', array('jquery'), null, true);
	wp_enqueue_script( 'boxshop-admin-script' );
}
add_action('admin_enqueue_scripts', 'boxshop_register_admin_scripts');

/*** Register Javascript Global Variable***/
function boxshop_register_javascript_global_variable(){
	global $boxshop_theme_options;
	
	$smooth_scroll = 0;
	
	$window = false;
	$chrome = false;
	
	if( !empty($_SERVER['HTTP_USER_AGENT']) ){
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$window  = (bool)preg_match('/Windows/i', $user_agent );
		$chrome  = (bool)preg_match('/Chrome/i', $user_agent );
	}
	
	if( $boxshop_theme_options['ts_smooth_scroll'] && !wp_is_mobile() && $window && $chrome ){
		$smooth_scroll = 1;
	}
	
	?>
	<script type="text/javascript">
		<?php if( defined('ICL_LANGUAGE_CODE') ): ?>
			var _ts_ajax_uri = '<?php echo admin_url('admin-ajax.php?lang='.ICL_LANGUAGE_CODE, 'relative'); ?>';
		<?php else: ?>
			var _ts_ajax_uri = '<?php echo admin_url('admin-ajax.php', 'relative'); ?>';
		<?php endif; ?>
		var _ts_enable_sticky_header = <?php echo (int)$boxshop_theme_options['ts_enable_sticky_header']; ?>;
		var _ts_enable_responsive = <?php echo (int)$boxshop_theme_options['ts_responsive']; ?>;
		var _ts_enable_smooth_scroll = <?php echo (int)$smooth_scroll; ?>;
		var _ts_enable_ajax_search = <?php echo isset($boxshop_theme_options['ts_ajax_search'])?(int)$boxshop_theme_options['ts_ajax_search']:1; ?>;
	</script>
	<?php
}
add_action('wp_footer', 'boxshop_register_javascript_global_variable');


/*** Array Attribute Compare ***/
if( !function_exists ('boxshop_array_atts') ){
	function boxshop_array_atts($pairs, $atts) {
		$atts = (array)$atts;
		$out = array();
		foreach($pairs as $name => $default) {
			if ( array_key_exists($name, $atts) ){
				if( is_array($atts[$name]) && is_array($default) ){
					$out[$name] = boxshop_array_atts($default,$atts[$name]);
				}
				else{
					$out[$name] = $atts[$name];
				}
			}
			else{
				$out[$name] = $default;
			}	
		}
		return $out;
	}
}

/*** Vertical Menu Heading ***/
if( !function_exists ('boxshop_get_vertical_menu_heading') ){
	function boxshop_get_vertical_menu_heading(){
		$locations = get_nav_menu_locations();
		if( isset($locations['vertical']) ){
			$menu = wp_get_nav_menu_object($locations['vertical']);
			if( isset( $menu->name ) ){
				return $menu->name;
			}
			else{
				return esc_html__('Shop by category', 'boxshop');
			}
		}
		return '';
	}
}

/*** Get excerpt ***/
if( !function_exists ('boxshop_string_limit_words') ){
	function boxshop_string_limit_words($string, $word_limit){
		$words = explode(' ', $string, ($word_limit + 1));
		if( count($words) > $word_limit ){
			array_pop($words);
		}
		return implode(' ', $words);
	}
}

if( !function_exists ('boxshop_the_excerpt_max_words') ){
	function boxshop_the_excerpt_max_words( $word_limit = -1, $post = '', $strip_tags = true, $extra_str = '', $echo = true ) {
		if( $post ){
			$excerpt = boxshop_get_the_excerpt_by_id($post->ID);
		}
		else{
			$excerpt = get_the_excerpt();
		}
			
		if( $strip_tags ){
			$excerpt = wp_strip_all_tags($excerpt);
			$excerpt = strip_shortcodes($excerpt);
		}
			
		if( $word_limit != -1 )
			$result = boxshop_string_limit_words($excerpt, $word_limit);
		else
			$result = $excerpt;
		
		$result .= $extra_str;
			
		if( $echo ){
			echo do_shortcode($result);
		}
		return $result;
	}
}

if( !function_exists('boxshop_get_the_excerpt_by_id') ){
	function boxshop_get_the_excerpt_by_id( $post_id = 0 )
	{
		global $wpdb;
		$query = "SELECT post_excerpt, post_content FROM $wpdb->posts WHERE ID = %d LIMIT 1";
		$result = $wpdb->get_results( $wpdb->prepare($query, $post_id), ARRAY_A );
		if( $result[0]['post_excerpt'] ){
			return $result[0]['post_excerpt'];
		}
		else{
			return $result[0]['post_content'];
		}
	}
}

/* Get User Role */
if( !function_exists('boxshop_get_user_role') ){
	function boxshop_get_user_role( $user_id ){
		global $wpdb;
		$user = get_userdata( $user_id );
		$capabilities = $user->{$wpdb->prefix . 'capabilities'};
		if( empty($capabilities) ){
			return '';
		}
		if ( !isset( $wp_roles ) ){
			$wp_roles = new WP_Roles();
		}
		foreach ( $wp_roles->role_names as $role => $name ) {
			if ( array_key_exists( $role, $capabilities ) ) {
				return $role;
			}
		}
		return '';
	}
}

/*** Page Layout Columns Class ***/

if( !function_exists('boxshop_page_layout_columns_class') ){
	function boxshop_page_layout_columns_class($page_column){
		$data = array();
		
		if( empty($page_column) ){
			$page_column = '0-1-0';
		}
		
		$layout_config = explode('-', $page_column);
		$left_sidebar = (int)$layout_config[0];
		$right_sidebar = (int)$layout_config[2];
		$main_class = ($left_sidebar + $right_sidebar) == 2 ?'ts-col-12':( ($left_sidebar + $right_sidebar) == 1 ?'ts-col-18':'ts-col-24' );			
		
		$data['left_sidebar'] = $left_sidebar;
		$data['right_sidebar'] = $right_sidebar;
		$data['main_class'] = $main_class;
		$data['left_sidebar_class'] = 'ts-col-6';
		$data['right_sidebar_class'] = 'ts-col-6';
		
		return $data;
	}
}

/*** Show Page Slider ***/
function boxshop_show_page_slider(){
	global $boxshop_page_datas;
	$revolution_exists = class_exists('RevSliderSlider');
	switch( $boxshop_page_datas['ts_page_slider'] ){
		case 'revslider':
			if( $revolution_exists && $boxshop_page_datas['ts_rev_slider'] ){
				$rev_db = new RevSliderDB();
				$response = $rev_db->fetch(RevSliderGlobals::$table_sliders, 'id='.$boxshop_page_datas['ts_rev_slider']);
				if( !empty($response) ){
					RevSliderOutput::putSlider($boxshop_page_datas['ts_rev_slider'], '');
				}
			}
		break;
		default:
		break;
	}
}

/*** Breadcrumbs ***/
if(!function_exists('boxshop_breadcrumbs')){
	function boxshop_breadcrumbs() {
		global $boxshop_theme_options;
		
		$delimiter_char = '&rsaquo;';
		if( class_exists('WooCommerce') ){
			if( function_exists('woocommerce_breadcrumb') && function_exists('is_woocommerce') && is_woocommerce() ){
				woocommerce_breadcrumb(array('wrap_before'=>'<div class="breadcrumbs"><div class="breadcrumbs-container">','delimiter'=>'<span>'.$delimiter_char.'</span>','wrap_after'=>'</div></div>'));
				return;
			}
		}
		
		if( function_exists('bbp_breadcrumb') && function_exists('is_bbpress') && is_bbpress() ){
			$args = array(
				'before' 			=> '<div class="breadcrumbs"><div class="breadcrumbs-container">'
				,'after' 			=> '</div></div>'
				,'sep' 				=> $delimiter_char
				,'sep_before' 		=> '<span class="brn_arrow">'
				,'sep_after' 		=> '</span>'
				,'current_before' 	=> '<span class="current">'
				,'current_after' 	=> '</span>'
			);
			
			bbp_breadcrumb( $args );
			/* Remove bbpress breadcrumbs */
			add_filter('bbp_no_breadcrumb', '__return_true', 999);
			return;
		}
 
		$allowed_html = array(
			'a'		=> array('href' => array(), 'title' => array())
			,'span'	=> array('class' => array())
			,'div'	=> array('class' => array())
		);
		$output = '';
 
		$delimiter = '<span class="brn_arrow">'.$delimiter_char.'</span>';
	  
		$front_id = get_option( 'page_on_front' );
		if ( !empty( $front_id ) ) {
			$home = get_the_title( $front_id );
		} else {
			$home = esc_html__( 'Home', 'boxshop' );
		}
		$ar_title = array(
					'search' 		=> esc_html__('Search results for ', 'boxshop')
					,'404' 			=> esc_html__('Error 404', 'boxshop')
					,'tagged' 		=> esc_html__('Tagged ', 'boxshop')
					,'author' 		=> esc_html__('Articles posted by ', 'boxshop')
					,'page' 		=> esc_html__('Page', 'boxshop')
					,'portfolio' 	=> esc_html__('Portfolio', 'boxshop')
					);
	  
		$before = '<span class="current">'; /* tag before the current crumb */
		$after = '</span>'; /* tag after the current crumb */
		global $wp_rewrite;
		$rewriteUrl = $wp_rewrite->using_permalinks();
		if ( !is_home() && !is_front_page() || is_paged() ) {
	 
			$output .= '<div class="breadcrumbs"><div class="breadcrumbs-container">';
	 
			global $post;
			$homeLink = esc_url( home_url('/') ); 
			$output .= '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	 
			if ( is_category() ) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if ( $thisCat->parent != 0 ) { 
					$output .= get_category_parents($parentCat, true, ' ' . $delimiter . ' '); 
				}
				$output .= $before . single_cat_title('', false) . $after;
			}
			elseif ( is_search() ) {
				$output .= $before . $ar_title['search'] . '"' . get_search_query() . '"' . $after;
			}elseif ( is_day() ) {
				$output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				$output .= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
				$output .= $before . get_the_time('d') . $after;
			}elseif ( is_month() ) {
				$output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				$output .= $before . get_the_time('F') . $after;
			}elseif ( is_year() ) {
				$output .= $before . get_the_time('Y') . $after;
			}elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					$post_type_name = $post_type->labels->singular_name;
					if( strcmp('Portfolio Item', $post_type->labels->singular_name) == 0 ){
						$post_type_name = $ar_title['portfolio'];
					}
					if( $rewriteUrl ){
						$output .= '<a href="' . $homeLink . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}else{
						$output .= '<a href="' . $homeLink . '?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}
					
					$output .= $before . get_the_title() . $after;
			    } else {
					$cat = get_the_category(); $cat = $cat[0];
					$output .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					$output .= $before . get_the_title() . $after;
			    }
			}elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				$post_type_name = $post_type->labels->singular_name;
			    if( strcmp('Portfolio Item', $post_type->labels->singular_name) == 0 ){
					$post_type_name = $ar_title['portfolio'];
			    }
				if ( is_tag() ) {
					$output .= $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
				}
				elseif( is_taxonomy_hierarchical(get_query_var('taxonomy')) ){
					if($rewriteUrl){
						$output .= '<a href="' . $homeLink . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}else{
						$output .= '<a href="' . $homeLink . '?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}			
					
					$curTaxanomy = get_query_var('taxonomy');
					$curTerm = get_query_var( 'term' );
					$termNow = get_term_by( 'name', $curTerm, $curTaxanomy );
					$pushPrintArr = array();
					if( $termNow !== false ){
						while ((int)$termNow->parent != 0){
							$parentTerm = get_term((int)$termNow->parent,get_query_var('taxonomy'));
							array_push($pushPrintArr,'<a href="' . get_term_link((int)$parentTerm->term_id,$curTaxanomy) . '">' . $parentTerm->name . '</a> ' . $delimiter . ' ');
							$curTerm = $parentTerm->name;
							$termNow = get_term_by( 'name', $curTerm, $curTaxanomy );
						}
					}
					$pushPrintArr = array_reverse($pushPrintArr);
					array_push($pushPrintArr,$before  . get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) )->name  . $after);
					$output .= implode($pushPrintArr);
				}else{
					$output .= $before . $post_type_name . $after;
				}
		 
			}elseif( is_attachment() ) {
				if( (int)$post->post_parent > 0 ){
					$parent = get_post($post->post_parent);
					$cat = get_the_category($parent->ID);
					if( count($cat) > 0 ){
						$cat = $cat[0];
						$output .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					}
					$output .= '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
				}
				$output .= $before . get_the_title() . $after;
			} elseif ( is_page() && !$post->post_parent ) {
				$output .= $before . get_the_title() . $after;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_post($parent_id);
					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
			    }
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb){
					$output .= $crumb . ' ' . $delimiter . ' ';
				}
				$output .= $before . get_the_title() . $after;
			} elseif ( is_tag() ) {
				$output .= $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$output .= $before . $ar_title['author'] . $userdata->display_name . $after;
			} elseif ( is_404() ) {
				$output .= $before . $ar_title['404'] . $after;
			}
		 
			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
					$output .= $before .' ('; 
				}
				$output .= $ar_title['page'] . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
					$output .= ')'. $after; 
				}
			}
			else{ 
				if ( get_query_var('page') ) {
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
						$output .= $before .' ('; 
					}
					$output .= $ar_title['page'] . ' ' . get_query_var('page');
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
						$output .= ')'. $after; 
					}
				}
			}
			$output .= '</div></div>';
	 
	    }
		
		echo wp_kses($output, $allowed_html);
		
		wp_reset_postdata();
	}
}

if( !function_exists('boxshop_breadcrumbs_title') ){
	function boxshop_breadcrumbs_title( $show_breadcrumb = false, $show_page_title = false, $page_title = '', $extra_class_title = '' ){
		global $boxshop_theme_options;
		if( $show_breadcrumb || $show_page_title ){
			$breadcrumb_bg = '';
			$extra_class = 'breadcrumb-' . $boxshop_theme_options['ts_breadcrumb_layout'];
			if( $boxshop_theme_options['ts_enable_breadcrumb_background_image'] && $boxshop_theme_options['ts_breadcrumb_layout'] != 'v2' ){
				if( $boxshop_theme_options['ts_bg_breadcrumbs'] == '' ){ /* No Override */
					$breadcrumb_bg = get_template_directory_uri() . '/images/bg_breadcrumb_'.$boxshop_theme_options['ts_breadcrumb_layout'].'.jpg';
				}	
				else{
					$breadcrumb_bg = $boxshop_theme_options['ts_bg_breadcrumbs'];
				}
			}
			
			$style = '';
			if( $breadcrumb_bg != '' ){
				$style = 'style="background-image: url('. esc_url($breadcrumb_bg) .')"';
				if( isset($boxshop_theme_options['ts_breadcrumb_bg_parallax']) && $boxshop_theme_options['ts_breadcrumb_bg_parallax'] ){
					$extra_class .= ' ts-breadcrumb-parallax';
				}
			}
			echo '<div class="breadcrumb-title-wrapper '.$extra_class.'" '.$style.'><div class="breadcrumb-content"><div class="breadcrumb-title">';
				if( $show_page_title ){
					echo '<h1 class="heading-title page-title entry-title '.$extra_class_title.'">'.$page_title.'</h1>';
				}
				if( $show_breadcrumb ){
					boxshop_breadcrumbs();
				}
			echo '</div></div></div>';
		}
	}
}

/*** Pagination ***/
if( !function_exists('boxshop_pagination') ){
	function boxshop_pagination( $query = null ){
		global $wp_query;
		$max_num_pages = $wp_query->max_num_pages;
		$paged = $wp_query->get( 'paged' );
		if( $query != null ){
			$max_num_pages = $query->max_num_pages;
			$paged = $query->get( 'paged' );
		}
		if( !$paged ){
			$paged = 1;
		}
		?>
		<nav class="ts-pagination">
			<?php
			echo paginate_links( array(
				'base'         	=> esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) )
				,'format'       => ''
				,'add_args'     => ''
				,'current'      => max( 1, $paged )
				,'total'        => $max_num_pages
				,'prev_text'    => '&larr;'
				,'next_text'    => '&rarr;'
				,'type'         => 'list'
				,'end_size'     => 3
				,'mid_size'     => 3
			) );
			?>
		</nav>
		<?php
	}
}

/*** Logo ***/
if( !function_exists('boxshop_theme_logo') ){
	function boxshop_theme_logo(){
		global $boxshop_theme_options;
		$logo_image = isset($boxshop_theme_options['ts_logo'])?esc_url($boxshop_theme_options['ts_logo']):'';
		$logo_image_mobile = isset($boxshop_theme_options['ts_logo_mobile'])?esc_url($boxshop_theme_options['ts_logo_mobile']):'';
		$logo_image_sticky = isset($boxshop_theme_options['ts_logo_sticky'])?esc_url($boxshop_theme_options['ts_logo_sticky']):'';
		$logo_text = isset($boxshop_theme_options['ts_text_logo'])?stripslashes(esc_attr($boxshop_theme_options['ts_text_logo'])):'';
		
		if( empty($logo_image_sticky) ){
			$logo_image_sticky = $logo_image;
		}
		if( empty($logo_image_mobile) ){
			$logo_image_mobile = $logo_image;
		}
		?>
		<div class="logo">
			<a href="<?php echo esc_url( home_url('/') ); ?>">
			<!-- Main logo -->
			<?php if( strlen($logo_image) > 0 ): ?>
				<img src="<?php echo esc_url($logo_image); ?>" alt="<?php echo !empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" title="<?php echo !empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" class="normal-logo" />
			<?php endif; ?>
			
			<!-- Main logo on mobile -->
			<?php if( strlen($logo_image_mobile) > 0 ): ?>
				<img src="<?php echo esc_url($logo_image_mobile); ?>" alt="<?php echo !empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" title="<?php echo !empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" class="normal-logo mobile-logo" />
			<?php endif; ?>
			
			<!-- Sticky logo -->
			<?php if( strlen($logo_image_sticky) > 0 ): ?>
				<img src="<?php echo esc_url($logo_image_sticky); ?>" alt="<?php echo !empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" title="<?php echo !empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" class="normal-logo sticky-logo" />
			<?php endif; ?>
			
			<!-- Logo Text -->
			<?php 
			if( strlen($logo_image) == 0 ){
				echo esc_html($logo_text); 
			}
			?>
			</a>
		</div>
		<?php
	}
}

/*** Favicon ***/
if( !function_exists('boxshop_theme_favicon') ){
	function boxshop_theme_favicon(){
		if( function_exists('wp_site_icon') && function_exists('has_site_icon') && has_site_icon() ){
			return;
		}
		global $boxshop_theme_options;
		$favicon = isset($boxshop_theme_options['ts_favicon'])?esc_url($boxshop_theme_options['ts_favicon']):'';
		if( strlen($favicon) > 0 ):
		?>
			<link rel="shortcut icon" href="<?php echo esc_url($favicon);?>" />
		<?php
		endif;
	}
}

/*** Header Template ***/
if( !function_exists('boxshop_get_header_template') ){
	function boxshop_get_header_template(){
		global $boxshop_theme_options;
		$header_layout = $boxshop_theme_options['ts_header_layout'];
		get_template_part('templates/headers/header', $header_layout);
	}
}

/*** Save Of Options - Save Dynamic css ***/
add_action('boxshop_of_save_options_after', 'boxshop_update_dynamic_css', 10000);
if( !function_exists('boxshop_update_dynamic_css') ){
	function boxshop_update_dynamic_css( $data = array() ){
		
		if( !is_array($data) ){
			return -1;
		}
		if(is_array($data['data'])){
			$data = $data['data'];	
		}
		else{
			return -1;
		}
	
		$upload_dir = wp_upload_dir();
		$filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
		ob_start();
		include get_template_directory() . '/framework/dynamic_style.php';
		$dynamic_css = ob_get_contents();
		ob_end_clean();
		
		global $wp_filesystem;
		if( empty( $wp_filesystem ) ) {
			require_once ABSPATH .'/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		
		$creds = request_filesystem_credentials($filename_dir, '', false, false, array());
		if( ! WP_Filesystem($creds) ){
			return false;
		}

		if( $wp_filesystem ) {
			$wp_filesystem->put_contents(
				$filename_dir,
				$dynamic_css,
				FS_CHMOD_FILE
			);
		}
	}
}

/*** Product Search Form by Category ***/
if( !function_exists('boxshop_get_search_form_by_category') ){
	function boxshop_get_search_form_by_category(){
		global $boxshop_theme_options;
		$enable_category = !isset($boxshop_theme_options['ts_search_by_category']) || (isset($boxshop_theme_options['ts_search_by_category']) && $boxshop_theme_options['ts_search_by_category']);
		
		$search_for_product = class_exists('WooCommerce');
		if( $search_for_product ){
			$taxonomy = 'product_cat';
			$post_type = 'product';
			$placeholder_text = esc_html__('Search for products', 'boxshop');
		}
		else{
			$taxonomy = 'category';
			$post_type = 'post';
			$placeholder_text = esc_html__('Search', 'boxshop');
		}
		
		$rand = mt_rand(0, 1000);
		?>
		<div class="ts-search-by-category <?php echo ($enable_category)?'':'no-category'; ?>">
			<form method="get" id="searchform<?php echo esc_attr($rand) ?>" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
				<?php if( $enable_category ): ?>
				<select class="select-category" name="term"><?php echo boxshop_search_by_category_get_option_html($taxonomy, 0, 0); ?></select>
				<?php endif; ?>
				<div class="search-content">
					<input type="text" value="<?php echo get_search_query() ?>" name="s" id="s<?php echo esc_attr($rand) ?>" placeholder="<?php echo esc_attr($placeholder_text) ?>" autocomplete="off" />
					<input type="submit" title="<?php esc_attr_e( 'Search', 'boxshop' ) ?>" id="searchsubmit<?php echo esc_attr($rand) ?>" value="<?php esc_attr_e( 'Search', 'boxshop' ) ?>" />
					<input type="hidden" name="post_type" value="<?php echo esc_attr($post_type) ?>" />
					<?php if( $enable_category ): ?>
					<input type="hidden" name="taxonomy" value="<?php echo esc_attr($taxonomy) ?>" />
					<?php endif; ?>
				</div>
			</form>
		</div>
		<?php
	}
}

if( !function_exists('boxshop_search_by_category_get_option_html') ){
	function boxshop_search_by_category_get_option_html($taxonomy = 'product_cat', $parent = 0, $level = 0){
		$options = '';
		$spacing = '';
		
		if( $level == 0 ){
			$options = '<option value="">'.esc_html__('All categories', 'boxshop').'</option>';
		}
		
		for( $i = 0; $i < $level * 3 ; $i++ ){
			$spacing .= '&nbsp;';
		}
		
		$args = array(
			'number'     	=> ''
			,'hide_empty'	=> 1
			,'orderby'		=> 'name'
			,'order'		=> 'asc'
			,'parent'		=> $parent
		);
		
		$select = '';
		$categories = get_terms($taxonomy, $args);
		if( is_search() &&  isset($_GET['term']) && $_GET['term'] != '' ){
			$select = $_GET['term'];
		}
		$level++;
		if( is_array($categories) ){
			foreach( $categories as $cat ){
				$options .= '<option value="' . $cat->slug . '" ' . selected($select, $cat->slug, false) . '>' . $spacing . $cat->name . '</option>';
				$options .= boxshop_search_by_category_get_option_html($taxonomy, $cat->term_id, $level);
			}
		}
		
		return $options;
	}
}

/* Ajax search */
add_action( 'wp_ajax_boxshop_ajax_search', 'boxshop_ajax_search' );
add_action( 'wp_ajax_nopriv_boxshop_ajax_search', 'boxshop_ajax_search' );
if( !function_exists('boxshop_ajax_search') ){
	function boxshop_ajax_search(){
		global $wpdb, $post, $boxshop_theme_options;
		
		$search_for_product = class_exists('WooCommerce');
		if( $search_for_product ){
			$taxonomy = 'product_cat';
			$post_type = 'product';
		}
		else{
			$taxonomy = 'category';
			$post_type = 'post';
		}
		
		$num_result = isset($boxshop_theme_options['ts_ajax_search_number_result'])? (int)$boxshop_theme_options['ts_ajax_search_number_result']: 10;
		$desc_limit_words = isset($boxshop_theme_options['ts_prod_cat_grid_desc_words'])?(int)$boxshop_theme_options['ts_prod_cat_grid_desc_words']:10;
		
		$search_string = $_POST['search_string'];
		$category = isset($_POST['category'])? $_POST['category']: '';
		
		$args = array(
			'post_type'			=> $post_type
			,'post_status'		=> 'publish'
			,'s'				=> $search_string
			,'posts_per_page'	=> $num_result
			,'tax_query'		=> array()
		);
		
		if( $search_for_product ){
			$args['meta_query'] = WC()->query->get_meta_query();
			$args['tax_query'] = WC()->query->get_tax_query();
		}
		
		if( $category != '' ){
			$args['tax_query'][] = array(
					'taxonomy'  => $taxonomy
					,'terms'	=> $category
					,'field'	=> 'slug'
				);
		}
		
		$results = new WP_Query($args);
		
		if( $results->have_posts() ){
			$extra_class = '';
			if( isset($results->post_count, $results->found_posts) && $results->found_posts > $results->post_count ){
				$extra_class = 'has-view-all';
			}
			
			$html = '<ul class="'.$extra_class.'">';
			while( $results->have_posts() ){
				$results->the_post();
				$link = get_permalink($post->ID);
				
				$image = '';
				if( $post_type == 'product' ){
					$product = wc_get_product($post->ID);
					$image = $product->get_image();
				}
				else if( has_post_thumbnail($post->ID) ){
					$image = get_the_post_thumbnail($post->ID, 'thumbnail');
				}
				
				$html .= '<li>';
					$html .= '<div class="thumbnail">';
						$html .= '<a href="'.esc_url($link).'">'. $image .'</a>';
					$html .= '</div>';
					$html .= '<div class="meta">';
						$html .= '<a href="'.esc_url($link).'" class="title">'. boxshop_search_highlight_string($post->post_title, $search_string) .'</a>';
						$html .= '<div class="description">'. boxshop_the_excerpt_max_words($desc_limit_words, '', true, ' ...', false) .'</div>';
						if( $post_type == 'product' ){
							if( $price_html = $product->get_price_html() ){
								$html .= '<span class="price">'. $price_html .'</span>';
							}
						}
					$html .= '</div>';
				$html .= '</li>';
			}
			$html .= '</ul>';
			
			if( isset($results->post_count, $results->found_posts) && $results->found_posts > $results->post_count ){
				$view_all_text = sprintf( esc_html__('View all %d results', 'boxshop'), $results->found_posts );
				
				$html .= '<div class="view-all-wrapper">';
					$html .= '<a href="#">'. $view_all_text .'</a>';
				$html .= '</div>';
			}
			
			wp_reset_postdata();
			
			$return = array();
			$return['html'] = $html;
			$return['search_string'] = $search_string;
			die( json_encode($return) );
		}
		
		die('');
	}
}

if( !function_exists('boxshop_search_highlight_string') ){
	function boxshop_search_highlight_string($string, $search_string){
		$new_string = '';
		$pos_left = stripos($string, $search_string);
		if( $pos_left !== false ){
			$pos_right = $pos_left + strlen($search_string);
			$new_string_right = substr($string, $pos_right);
			$search_string_insensitive = substr($string, $pos_left, strlen($search_string));
			$new_string_left = stristr($string, $search_string, true);
			$new_string = $new_string_left . '<span class="hightlight">' . $search_string_insensitive . '</span>' . $new_string_right;
		}
		else{
			$new_string = $string;
		}
		return $new_string;
	}
}

/* Get post comment count */
if( !function_exists('boxshop_post_comment_count') ){
	function boxshop_post_comment_count( $post_id = 0 ){
		global $post;
		if( !$post_id ){
			$post_id = $post->ID;
		}
		
		$comments_count = wp_count_comments($post_id); 
		$comment_number = $comments_count->approved;
		if( $comment_number ){
			echo zeroise($comment_number, 2);
		}
		else{
			echo esc_html($comment_number);
		}
	}
}

/* Get post view count */
if( !function_exists('boxshop_post_view_count') ){
	function boxshop_post_view_count( $post_id = 0 ){
		global $post;
		if( !$post_id ){
			$post_id = $post->ID;
		}
		
		$view_number = get_post_meta($post_id, '_ts_post_views_count', true);
		$view_number = absint($view_number);
		if( $view_number ){
			echo zeroise($view_number, 2);
		}
		else{
			echo esc_html($view_number);
		}
	}
}

/* Match with ajax search results */
add_filter('woocommerce_get_catalog_ordering_args', 'boxshop_woocommerce_get_catalog_ordering_args_filter');
if( !function_exists('boxshop_woocommerce_get_catalog_ordering_args_filter') ){
	function boxshop_woocommerce_get_catalog_ordering_args_filter( $args ){
		global $boxshop_theme_options;
		if( is_search() && !isset($_GET['orderby']) && get_option( 'woocommerce_default_catalog_orderby' ) == 'menu_order' 
			&& isset($boxshop_theme_options['ts_ajax_search']) && $boxshop_theme_options['ts_ajax_search'] ){
			$args['orderby'] = '';
			$args['order'] = '';
		}
		return $args;
	}
}

/* Custom Sidebar */
add_action( 'sidebar_admin_page', 'boxshop_custom_sidebar_form' );
function boxshop_custom_sidebar_form(){
?>
	<form action="<?php echo admin_url( 'widgets.php' ); ?>" method="post" id="ts-form-add-sidebar">
        <input type="text" name="sidebar_name" id="sidebar_name" placeholder="<?php esc_html_e('Custom Sidebar Name', 'boxshop'); ?>" />
        <button class="button-primary" id="ts-add-sidebar"><?php esc_html_e('Add Sidebar', 'boxshop'); ?></button>
    </form>
<?php
}

function boxshop_get_custom_sidebars(){
	$option_name = 'ts_custom_sidebars';
	$custom_sidebars = get_option($option_name);
    return is_array($custom_sidebars)?$custom_sidebars:array();
}

add_action('wp_ajax_boxshop_add_custom_sidebar', 'boxshop_add_custom_sidebar');
function boxshop_add_custom_sidebar(){
	if( isset($_POST['sidebar_name']) ){
		$option_name = 'ts_custom_sidebars';
		if( !get_option($option_name) || get_option($option_name) == '' ){
			delete_option($option_name);
		}
		
		$sidebar_name = $_POST['sidebar_name'];
		
		if( get_option($option_name) ){
			$custom_sidebars = boxshop_get_custom_sidebars();
			if( !in_array($sidebar_name, $custom_sidebars) ){
				$custom_sidebars[] = $sidebar_name;
			}
			$result = update_option($option_name, $custom_sidebars);
		}
		else{
			$custom_sidebars = array();
			$custom_sidebars[] = $sidebar_name;
			$result = add_option($option_name, $custom_sidebars);
		}
		
		if( $result ){
			die( esc_html__('Successfully added the sidebar', 'boxshop') );
		}
		else{
			die( esc_html__('Error! It seems that the sidebar exists. Please try again!', 'boxshop') );
		}
	}
	die('');
}

add_action('wp_ajax_boxshop_delete_custom_sidebar', 'boxshop_delete_custom_sidebar');
function boxshop_delete_custom_sidebar(){
	if( isset($_POST['sidebar_name']) ){
		$option_name = 'ts_custom_sidebars';
		$del_sidebar = trim($_POST['sidebar_name']);
		$custom_sidebars = boxshop_get_custom_sidebars();
		foreach( $custom_sidebars as $key => $value ){
			if( $value == $del_sidebar ){
				unset($custom_sidebars[$key]);
				break;
			}
		}
		$custom_sidebars = array_values($custom_sidebars);
		update_option($option_name, $custom_sidebars);
		die( esc_html__('Successfully deleted the sidebar', 'boxshop') );
	}
	die('');
}

/* Calculate Color */
if( !function_exists('boxshop_hex2rgb') ){
	function boxshop_hex2rgb($hex){
		if( substr( $hex, 0, 1 ) == "#" ){
			$hex = substr( $hex, 1 );
		}
		if( strlen($hex) == 6 ){
			$R = substr($hex, 0, 2);
			$G = substr($hex, 2, 2);
			$B = substr($hex, 4, 2);
		}
		else{
			$R = substr($hex, 0, 1);
			$G = substr($hex, 1, 1);
			$B = substr($hex, 2, 1);
		}

		$R = hexdec($R);
		$G = hexdec($G);
		$B = hexdec($B);

		$RGB['R'] = $R;
		$RGB['G'] = $G;
		$RGB['B'] = $B;

		return $RGB;
	}
}

if( !function_exists('boxshop_rgb2hex') ){
	function boxshop_rgb2hex($rgb) {
	   $hex = "#";
	   $hex .= str_pad(dechex($rgb['R']), 2, dechex($rgb['R']), STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb['G']), 2, dechex($rgb['G']), STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb['B']), 2, dechex($rgb['B']), STR_PAD_LEFT);

	   return $hex;
	}
}

if( !function_exists('boxshop_calc_color') ){
	function boxshop_calc_color($first_color = '', $second_color = '', $add = true){
		if( strrpos($first_color, '#') !== false && strrpos($second_color, '#') !== false ){
			$rgb_first_color = boxshop_hex2rgb($first_color);
			$rgb_second_color = boxshop_hex2rgb($second_color);
			if( $add ){
				$rgb_first_color['R'] += $rgb_second_color['R'];
				$rgb_first_color['G'] += $rgb_second_color['G'];
				$rgb_first_color['B'] += $rgb_second_color['B'];
			}
			else{
				$rgb_first_color['R'] -= $rgb_second_color['R'];
				$rgb_first_color['G'] -= $rgb_second_color['G'];
				$rgb_first_color['B'] -= $rgb_second_color['B'];
			}
			return boxshop_rgb2hex($rgb_first_color);
		}
		else{
			return $first_color;
		}
	}
}

if( !function_exists('boxshop_get_mailchimp_forms') ){
	function boxshop_get_mailchimp_forms(){
		$args = array(
			'post_type'			=> 'mc4wp-form'
			,'post_status'		=> 'publish'
			,'posts_per_page'	=> -1
		);
		$results = array();
		$forms = new WP_Query( $args );
		if( !empty( $forms->posts ) && is_array( $forms->posts ) ){
			foreach( $forms->posts as $p ){
				$results[] = array(
					'id'		=> $p->ID
					,'title'	=> $p->post_title
				);
			}
		}
		
		return $results;
	}
}

/* Support Dokan */
add_action('dokan_dashboard_wrap_before', 'boxshop_dokan_dashboard_wrap_before', 10, 2);
add_action('dokan_edit_product_wrap_before', 'boxshop_dokan_dashboard_wrap_before', 10, 2);
function boxshop_dokan_dashboard_wrap_before( $post, $post_id ){
	global $boxshop_theme_options;
	$from_shortcode = false;
	if( isset( $_GET['product_id'] ) ){
		$from_shortcode = true;
	}
	if( ! $from_shortcode ){
		boxshop_breadcrumbs_title(true, true, get_the_title());
	}
	if( ! $from_shortcode ){
	?>
		<div class="page-container show_breadcrumb_<?php echo esc_attr($boxshop_theme_options['ts_breadcrumb_layout']) ?>">
			<div id="main-content" class="ts-col-24">
	<?php
	}
}

add_action('dokan_dashboard_wrap_after', 'boxshop_dokan_dashboard_wrap_after', 10, 2);
add_action('dokan_edit_product_wrap_after', 'boxshop_dokan_dashboard_wrap_after', 10, 2);
function boxshop_dokan_dashboard_wrap_after( $post, $post_id ){
	$from_shortcode = false;
	if( isset( $_GET['product_id'] ) ){
		$from_shortcode = true;
	}
	if( ! $from_shortcode ){
	?>
		</div>
	</div>
	<?php
	}
}

/* Install Required Plugins */
add_action( 'tgmpa_register', 'boxshop_register_required_plugins' );
function boxshop_register_required_plugins(){
	$plugin_dir_path = get_template_directory() . '/framework/plugins/';
    $plugins = array(

        array(
            'name'                => 'ThemeSky'
            ,'slug'               => 'themesky'
            ,'source'             => $plugin_dir_path . 'themesky.zip'
            ,'required'           => true
            ,'version'            => '1.0.8'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'BoxShop Importer'
            ,'slug'               => 'boxshop-importer'
            ,'source'             => $plugin_dir_path . 'boxshop-importer.zip'
            ,'required'           => false
            ,'version'            => '1.0.4'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'WooCommerce'
            ,'slug'               => 'woocommerce'
			,'source'             => 'https://downloads.wordpress.org/plugin/woocommerce.3.4.1.zip'
            ,'required'           => true
			,'version'            => '3.4.1'
			,'external_url'       => ''
        )
		,array(
            'name'                => 'WPBakery Page Builder'
            ,'slug'               => 'js_composer'
            ,'source'             => $plugin_dir_path . 'js_composer.zip'
            ,'required'           => true
            ,'version'            => '5.4.7'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'Slider Revolution'
            ,'slug'               => 'revslider'
            ,'source'             => $plugin_dir_path . 'revslider.zip'
            ,'required'           => false
            ,'version'            => '5.4.7.4'
            ,'external_url'       => ''
        )
		,array(
            'name'                => 'Contact Form 7'
            ,'slug'               => 'contact-form-7'
			,'source'             => 'https://downloads.wordpress.org/plugin/contact-form-7.5.0.2.zip'
            ,'required'           => false
			,'version'            => '5.0.2'
			,'external_url'       => ''
        )
		,array(
            'name'                => 'MailChimp for WordPress'
            ,'slug'               => 'mailchimp-for-wp'
			,'source'             => 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.2.2.zip'
            ,'required'           => false
			,'version'            => '4.2.2'
			,'external_url'       => ''
        )
		,array(
            'name'                => 'YITH WooCommerce Wishlist'
            ,'slug'               => 'yith-woocommerce-wishlist'
			,'source'             => 'https://downloads.wordpress.org/plugin/yith-woocommerce-wishlist.2.2.2.zip'
            ,'required'           => false
			,'version'            => '2.2.2'
			,'external_url'       => ''
        )
		,array(
            'name'                => 'YITH WooCommerce Compare'
            ,'slug'               => 'yith-woocommerce-compare'
			,'source'             => 'https://downloads.wordpress.org/plugin/yith-woocommerce-compare.2.3.0.zip'
            ,'required'           => false
			,'version'            => '2.3.0'
			,'external_url'       => ''
        )

    );

    $config = array(
		'id'           	=> 'tgmpa'
		,'default_path' => ''
		,'menu'         => 'tgmpa-install-plugins'
		,'parent_slug'  => 'themes.php'
		,'capability'   => 'edit_theme_options'
		,'has_notices'  => true
		,'dismissable'  => true
		,'dismiss_msg'  => ''
		,'is_automatic' => false
		,'message'      => ''
	);

    tgmpa( $plugins, $config );
}
?>
