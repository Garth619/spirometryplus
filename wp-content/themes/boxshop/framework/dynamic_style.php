<?php 
global $boxshop_theme_options;
if( !isset($data) ){
	$data = $boxshop_theme_options;
}

$data = boxshop_array_atts(
			array(
				/* FONTS */
				'ts_body_font_enable_google_font'					=> 1
				,'ts_body_font_family'								=> "Arial"
				,'ts_body_font_family_weight'						=> 400
				,'ts_body_font_google'								=> "Roboto"
				,'ts_body_font_google_weight'						=> 400
				
				,'ts_heading_font_enable_google_font'				=> 1
				,'ts_heading_font_family'							=> "Arial"
				,'ts_heading_font_family_weight'					=> 500
				,'ts_heading_font_google'							=> "Roboto"
				,'ts_heading_font_google_weight'					=> 500
				
				,'ts_menu_font_enable_google_font'					=> 1
				,'ts_menu_font_family'								=> "Arial"
				,'ts_menu_font_family_weight'						=> 400
				,'ts_menu_font_google'								=> "Roboto"
				,'ts_menu_font_google_weight'						=> 400
				
				,'custom_font_ttf'								=> ""
				
				/* COLORS */
				,'ts_primary_color'									=> "#e72304"
				,'ts_text_color_in_bg_primary'						=> "#ffffff"

				,'ts_secondary_color'								=> "#000000"
				,'ts_text_color_in_bg_second'						=> "#ffffff"

				,'ts_heading_color'									=> "#535353"

				,'ts_main_content_background_color'					=> "#ffffff"
				,'ts_widget_content_background_color'				=> "#ffffff"
				,'ts_text_color'									=> "#848484"

				,'ts_link_color'									=> "#e72304"
				,'ts_link_color_hover'								=> "#e72304"

				,'ts_border_color'									=> "#ebebeb"
				
				,'ts_input_text_color'								=> "#848484"
				,'ts_input_text_color_hover'						=> "#666666"
				,'ts_input_border_color'							=> "#e5e5e5"
				,'ts_input_border_color_hover'						=> "#c0c0c0"

				,'ts_button_text_color'								=> "#ffffff"
				,'ts_button_text_color_hover'						=> "#ffffff"
				,'ts_button_border_color'							=> "#3f3f3f"
				,'ts_button_border_color_hover'						=> "#e72304"
				,'ts_button_background_color'						=> "#3f3f3f"
				,'ts_button_background_color_hover'					=> "#e72304"
				
				,'ts_revo_navigation_text_color'					=> "#000000"
				,'ts_revo_navigation_background_color'				=> "#ffffff"
				
				/* BREADCRUMB */
				,'ts_breadcrumb_border_bottom_color'				=> "#ebebeb"
				,'ts_breadcrumb_text_color'							=> "#ffffff"
				,'ts_breadcrumb_heading_color'						=> "#ffffff"
				,'ts_breadcrumb_link_color_hover'					=> "#e72304"
				,'ts_breadcrumb_background_color'					=> "#ffffff"
				
				/* HEADER */
				,'ts_top_header_top_logo_background'				=> "#e72304"
				,'ts_top_header_background_color'					=> "#ffffff"
				,'ts_top_header_text_color'							=> "#848484"
				,'ts_top_header_border_color'						=> "#ebebeb"
				,'ts_middle_header_background_color'				=> "#ffffff"
				,'ts_bottom_header_background_color'				=> "#f1f1f1"
				
				,'ts_search_background_color'						=> "#ffffff"
				,'ts_search_border_color'							=> "#e5e5e5"
				,'ts_search_categories_text_color'					=> "#000000"
				,'ts_search_categories_hightlighted_color'			=> "#000000"
				,'ts_search_input_text_background_color'			=> "#ffffff"
				,'ts_search_input_text_color'						=> "#666666"

				/* MENU */
				,'ts_header_cart_text_color'						=> "#000000"
				,'ts_header_cart_amount_color'						=> "#e72304"
				,'ts_header_cart_background_color'					=> "#ffffff"
				
				,'ts_vertical_menu_title_text'						=> "#ffffff"
				,'ts_vertical_menu_title_background_color'			=> "#202020"
				,'ts_vertical_menu_text_color'						=> "#000000"
				,'ts_vertical_menu_background_color'				=> "#f9f9f9"
				,'ts_vertical_menu_text_color_hover'				=> "#e72304"
				,'ts_vertical_menu_background_hover'				=> "#ffffff"
				
				,'ts_menu_border_color'								=> "#ebebeb"
				
				,'ts_menu_text_color'								=> "#848484"
				,'ts_menu_text_color_hover'							=> "#e72304"

				,'ts_sub_menu_background_color'						=> "#ffffff"
				,'ts_sub_menu_text_color'							=> "#848484"
				,'ts_sub_menu_text_color_hover'						=> "#e72304"
				,'ts_sub_menu_heading_color'						=> "#000000"
				
				/* FOOTER */
				,'ts_footer_social_icon_border_color'				=> "#848484"
				,'ts_footer_social_icon_color'						=> "#ffffff"
				,'ts_footer_social_background_color'				=> "#848484"
				,'ts_footer_background_color'						=> "#202020"
				,'ts_footer_text_color'								=> "#999999"
				,'ts_footer_text_color_hover'						=> "#ffffff"
				,'ts_footer_heading_color'							=> "#ffffff"
				,'ts_footer_end_background_color'					=> "#202020"
				,'ts_footer_end_text_color'							=> "#999999"

				/* PRODUCT */
				,'ts_product_hotdeal_background_color'				=> "#f7f7f7"
				,'ts_product_hotdeal_text_color'					=> "#666666"
				,'ts_product_hotdeal_border_color'					=> "#f1f1f1"
				
				,'ts_rating_color'									=> "#ffad00"
				
				,'ts_product_name_text_color'						=> "#202020"

				,'ts_product_button_text_color'						=> "#666666"
				,'ts_product_button_text_color_hover'				=> "#ffffff"
				,'ts_product_button_background_color'				=> "#ffffff"
				,'ts_product_button_background_color_hover'			=> "#e72304"
				,'ts_product_button_border_color'					=> "#e8e8e8"
				,'ts_product_button_border_color_hover'				=> "#e72304"
				
				,'ts_nav_slider_icon_color'							=> "#bbbbbb"
				,'ts_nav_slider_icon_color_hover'					=> "#000000"
				,'ts_nav_slider_border_color'						=> "#cccccc"
				,'ts_nav_slider_border_color_hover'					=> "#000000"
				,'ts_nav_slider_background_color'					=> "#ffffff"
				,'ts_nav_slider_background_color_hover'				=> "#ffffff"

				,'ts_product_sale_label_text_color'					=> "#ffffff"
				,'ts_product_sale_label_background_color'			=> "#e72304"
				,'ts_product_new_label_text_color'					=> "#ffffff"
				,'ts_product_new_label_background_color'			=> "#3a93ca"
				,'ts_product_feature_label_text_color'				=> "#ffffff"
				,'ts_product_feature_label_background_color'		=> "#72b728"
				,'ts_product_outstock_label_text_color'				=> "#ffffff"
				,'ts_product_outstock_label_background_color'		=> "#d4d4d4"

				,'ts_product_price_color'							=> "#000000"
				,'ts_product_sale_del_price_color'					=> "#000000"
				,'ts_product_sale_price_color'						=> "#000000"
				
				/* RESPONSIVE */
				,'ts_responsive'									=> 1
				,'ts_enable_rtl'									=> 0
				,'ts_layout_fullwidth'								=> 0
				
				/* FONT SIZE */
				/* Body */
				,'ts_font_size_body'								=> 14
				,'ts_line_height_body'								=> 26
				
				/* Menu */
				,'ts_font_size_menu'								=> 15
				,'ts_line_height_menu'								=> 20
				
				/* Button */
				,'ts_font_size_button'								=> 16
				,'ts_line_height_button'							=> 20
				
				
				/* Heading */
				,'ts_font_size_heading_1'							=> 40
				,'ts_line_height_heading_1'							=> 48
				,'ts_font_size_heading_2'							=> 36
				,'ts_line_height_heading_2'							=> 42
				,'ts_font_size_heading_3'							=> 30
				,'ts_line_height_heading_3'							=> 36
				,'ts_font_size_heading_4'							=> 24
				,'ts_line_height_heading_4'							=> 30
				,'ts_font_size_heading_5'							=> 18
				,'ts_line_height_heading_5'							=> 24
				,'ts_font_size_heading_6'							=> 16
				,'ts_line_height_heading_6'							=> 22
				
				/* Custom CSS */
				,'ts_custom_css_code'								=> ''
		), $data);		
		
$data = boxshop_of_filter_load_media_upload( $data ); /* Filter [site_url] */
$data = apply_filters('boxshop_custom_style_data', $data);

extract( $data );

/* font-body */
if( $data['ts_body_font_enable_google_font'] ){
	$ts_body_font				= $data['ts_body_font_google'];
	$ts_body_font_weight		= $data['ts_body_font_google_weight'];
}
else{
	$ts_body_font				= $data['ts_body_font_family'];
	$ts_body_font_weight		= $data['ts_body_font_family_weight'];
}
if( !$ts_body_font_weight ){
	$ts_body_font_weight = 'normal';
}

if( $data['ts_heading_font_enable_google_font'] ){
	$ts_heading_font			= $data['ts_heading_font_google'];
	$ts_heading_font_weight		= $data['ts_heading_font_google_weight'];
}
else{
	$ts_heading_font			= $data['ts_heading_font_family'];
	$ts_heading_font_weight		= $data['ts_heading_font_family_weight'];
}
if( !$ts_heading_font_weight ){
	$ts_heading_font_weight = 'bold';
}
/* FONT MENU */
if( $data['ts_menu_font_enable_google_font'] ){
	$ts_menu_font				= $data['ts_menu_font_google'];
	$ts_menu_font_weight		= $data['ts_menu_font_google_weight'];
}
else{
	$ts_menu_font				= $data['ts_menu_font_family'];
	$ts_menu_font_weight		= $data['ts_menu_font_family_weight'];
}
if( !$ts_menu_font_weight ){
	$ts_menu_font_weight = 'bold';
}

?>	
	
	/*
	1. FONT FAMILY
	2. GENERAL COLORS
	3. HEADER COLORS
	4. MENU COLORS
	5. FOOTER COLORS
	6. PRODUCT COLORS
	7. CUSTOM FONT SIZE
	8. RESPONSIVE
	9. FULLWIDTH LAYOUT
	10. DISABLED REPONSIVE
	*/
	/* ============= 1. FONT FAMILY ============== */
	<?php 
	/* Custom Font */
	if( $custom_font_ttf ):
	?>
	@font-face {
		font-family: 'CustomFont';
		src:url('<?php echo esc_url($custom_font_ttf); ?>') format('truetype');
		font-weight: normal;
		font-style: normal;
	}
	<?php endif; ?>
	html, 
	body,
	label,
	input, 
	textarea, 
	keygen, 
	select, 
	button,
	.mc4wp-form-fields label,
	.font-body,
	.ts-banner .heading-body,
	.ts-button.fa,
	li.fa,
	h3.product-name > a, 
	h3.product-name,
	#order_review_heading,
	.woocommerce-cart .cart-collaterals .cart_totals > h2,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab a,
	.ts-testimonial-wrapper.text-light .testimonial-content h4.name a,
	.ts-twitter-slider.text-light .twitter-content h4.name > a,
	.vc_toggle_default .vc_toggle_title h4,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title,
	.ts-milestone h3.subject, 
	.cart_totals table th,
	.woocommerce #order_review table.shop_table tfoot td, 
	.woocommerce table.shop_table.order_details tfoot th, 
	.woocommerce #order_review table.shop_table tfoot th, 
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	body div.pp_default .pp_nav .currentTextHolder,
	body .theme-default .nivo-caption,
	.dokan-category-menu .sub-block h3,
	.menu-wrapper nav > ul.menu li .menu-desc,
	body .dataTables_wrapper{
		font-family:<?php echo esc_html($ts_body_font) ?>, sans-serif;
	}
	.h1-big,
	.h2-big,
	h1,h2,h3,h4,h5,h6,
	.h1,.h2,.h3,.h4,.h5,.h6,
	h1.wpb_heading,
	h2.wpb_heading,
	h3.wpb_heading,
	h4.wpb_heading,
	h5.wpb_heading,
	h6.wpb_heading
	{
		font-family:<?php echo esc_html($ts_heading_font) ?>, sans-serif;
	}
	
	/* FONT MENU */
	.menu-wrapper nav > ul.menu > li > a,
	.vertical-menu-wrapper .vertical-menu-heading,
	/* Sub menu */
	.menu-wrapper nav > ul.menu ul.sub-menu > li > a,
	.menu-wrapper nav div.list-link li > a,
	.menu-wrapper nav > ul.menu li.widget_nav_menu li > a{
		font-family: <?php echo esc_html($ts_menu_font) ?>, sans-serif;
	}

	/* ============= 2. GENERAL COLORS ============== */
	
	/* Background Content Color */
	body #main,
	body.header-boxed header,
	body.dokan-store #main:before,
	body div.pp_pic_holder,
	#cboxLoadedContent,
	.woocommerce .woocommerce-ordering .orderby ul:before,
	form.checkout div.create-account,
	#main > .page-container,
	#main > .fullwidth-template,
	.thumbnails.loading:before,
	.ts-testimonial-wrapper.loading:before,
	.ts-twitter-slider.loading:before,
	.ts-logo-slider-wrapper.loading .content-wrapper:before,
	.related-posts.loading .content-wrapper:before,
	.ts-portfolio-wrapper.loading:before,
	.ts-blogs-wrapper.loading .content-wrapper:before,
	article .tags-link a:after,
	header .header-v5 .header-bottom,
	.content-no-border .widget.ts-products-widget .owl-nav:after,
	.ts-product-in-category-tab-2-wrapper .column-products.loading:before,
	header .header-v7 .is-sticky .header-bottom
	{
		background-color:<?php echo esc_html($ts_main_content_background_color) ?>;
	}
	/* Widget & Shortcode Background */
	footer .widget-container,
	footer .ts-shortcode,
	footer .vc_tta-container,
	footer .vc_tta-panels{
		background:transparent;
	}
	.widget.ts-products-widget,
	.woocommerce .no-margin:not(.thumbnail-no-border) .product .product-wrapper,
	.shopping-cart-wrapper .dropdown-container .form-content:after,
	.my-account-wrapper .form-content:after,
	#lang_sel_click:after,
	body .wpml-ls-legacy-dropdown > ul > li:before,
	body .wpml-ls-legacy-dropdown .wpml-ls-sub-menu:after,
	body .wpml-ls-legacy-dropdown-click > ul > li:before,
	body .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu:after,
	.header-currency > div:before,
	.shopping-cart-wrapper .dropdown-container:after,
	.my-account-wrapper .dropdown-container:after,
	#lang_sel_click ul ul:after,
	.header-currency ul:after,
	.shopping-cart-wrapper .dropdown-container:before,
	.my-account-wrapper .dropdown-container:before,
	#lang_sel_click ul ul:before,
	body .wpml-ls-legacy-dropdown .wpml-ls-sub-menu:before,
	body .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu:before,
	.header-currency ul:before,
	.product-category-top-content:before,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle:before,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tabs-container,
	.ts-product-in-category-tab-wrapper .column-products .owl-nav > div,
	.images-thumbnails >.thumbnails .owl-nav > div,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab,
	.widget-container,
	.ts-products-tabs-widget .widget-title-wrapper,
	.vc_tta-container .vc_general,
	table.shop_table,
	.single-navigation .product-info:before,
	body .select2-container--default .select2-selection--single,
	body .select2-dropdown,
	html input[type="search"],
	html input[type="text"], 
	html input[type="password"],
	html input[type="email"], 
	html input[type="number"], 
	html input[type="date"],  
	html input[type="tel"], 
	html textarea,
	#bbpress-forums #bbp-your-profile fieldset input, 
	#bbpress-forums #bbp-your-profile fieldset textarea,
	.bbp-login-form .bbp-username input, 
	.bbp-login-form .bbp-email input, 
	.bbp-login-form .bbp-password input,
	.woocommerce form .form-row input.input-text, 
	.woocommerce form .form-row textarea, 
	.woocommerce table.cart td.actions .coupon .input-text, 
	.widget-container .gallery.loading figure:before,
	.list-posts article .gallery.loading:before,
	.thumbnail.loading:before,
	.images.loading:before,
	.ts-product-category-slider-wrapper .content-wrapper.loading:before,
	.ts-product-in-category-tab-wrapper .column-banners.loading:before,
	.ts-product-in-category-tab-wrapper .column-products.loading:before,
	.woocommerce .product figure.loading:before,
	.ts-product .content-wrapper.loading:before,
	.tab-contents.loading:before,
	.ts-products-widget .ts-products-widget-wrapper.loading:before,
	.ts-blogs-widget .ts-blogs-widget-wrapper.loading:before,
	.ts-recent-comments-widget .ts-recent-comments-widget-wrapper.loading:before,
	.blogs article a.gallery.loading:before,
	.single .gallery.loading:before,
	.ts-portfolio-wrapper.loading:before,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-panels-container .vc_tta-panels,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab.vc_active a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab a:hover,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab.vc_active a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab a:hover,
	.woocommerce #payment div.payment_box, 
	.ts-blogs article .content-meta,
	.list-posts article,
	.ts-team-member .content-info,
	.vc_toggle,
	.ts-product-in-category-tab-wrapper,
	body .flexslider .slides,
	body .wpb_gallery_slides.wpb_slider_nivo,
	.woocommerce div.product .woocommerce-tabs ul.tabs li > a,
	/* Compare table */
	#cboxLoadingOverlay,
	/* Forum */
	#bbpress-forums ul.bbp-lead-topic, 
	#bbpress-forums ul.bbp-topics, 
	#bbpress-forums ul.bbp-forums, 
	#bbpress-forums ul.bbp-replies, 
	#bbpress-forums ul.bbp-search-results{
		background-color:<?php echo esc_html($ts_widget_content_background_color) ?>;
	}

	.tab-content.loading:before,
	.yith-wcwl-add-to-wishlist .loading:after{
		background-color:<?php echo esc_html($ts_widget_content_background_color) ?>;
		opacity:0.7;
	}

	.woocommerce-checkout #payment div.payment_box:before{
		border-bottom-color:<?php echo esc_html($ts_widget_content_background_color) ?>;
	}

	/* BODY COLOR */

	body,
	.gridlist-toggle a,
	.widget-container .tagcloud a,
	.product-categories a,
	body.wpb-js-composer .vc_toggle .vc_toggle_icon:before,
	body .star-rating.no-rating:before,
	.pp_woocommerce div.product .summary .woocommerce-product-details__short-description, 
	.woocommerce div.product.summary .woocommerce-product-details__short-description, 
	.entry-bottom .ts-social-sharing li a,
	.ts-feature-wrapper .feature-icon,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a i,
	/* Widget */
	p.lost_password a,
	span.bbp-admin-links a,
	span.bbp-admin-links,
	.ts-product-attribute > div a,
	.comment_list_widget .comment-body,
	header .header-template .my-account-wrapper .forgot-pass a,
	.woocommerce .woocommerce-ordering ul li a, 
	article .social-sharing li a, 
	div.product .social-sharing li a,
	.woocommerce table.shop_attributes td, 
	.woocommerce table.shop_attributes th, 
	.woocommerce p.stars a,
	.woocommerce-product-rating .woocommerce-review-link,
	table tfoot th,
	.ts-team-member .image-thumbnail .social,
	.woocommerce-checkout #payment div.payment_box,
	body div.pp_default .pp_nav .currentTextHolder,
	.dashboard-widget.products ul li a,
	.single-portfolio .cat-links > a,
	/* Forum */
	.bbp-login-links a,
	#bbpress-forums .status-category > li > .bbp-forums-list > li a,
	li.bbp-forum-freshness a, 
	li.bbp-topic-freshness a,
	.ts-list-of-product-categories-wrapper .list-categories li a,
	.list-cats li a,
	.woocommerce .widget-container .price_slider_amount .price_label,
	.widget-container ul li > a,
	.dokan-widget-area .widget ul li > a,
	.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li a,
	.dokan-dashboard .dokan-dashboard-content ul.dokan_tabs li.active > a,
	.dokan-dashboard .dokan-dashboard-content ul.dokan_tabs li > a:hover,
	.dokan-dashboard .dokan-dashboard-content a,
	.dokan-dashboard .dokan-dashboard-content a.dokan-btn-default:hover,
	.product-categories span.count,
	#lang_sel_click ul ul a,
	.header-currency ul li a:not(.button),
	.wishlist_table tr td.product-stock-status span.wishlist-in-stock,
	body.wpb-js-composer .ts-products-tabs-widget .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	.ts-product-in-category-tab-2-wrapper .see-more-button{
		color:<?php echo esc_html($ts_text_color) ?>;
	}
	.ts-social-icons .social-icons.style-vertical .ts-tooltip,
	.ts-social-sharing .sharing-title,
	.cats-link,
	.tags-link,
	.cats-link a,
	.tags-link a{
		color:<?php echo boxshop_calc_color($ts_text_color, '#272727',false) ?>; 
	}
	/* Quick view */
	select,
	textarea,
	html input[type="search"],
	html input[type="text"], 
	html input[type="email"],
	html input[type="password"],
	html input[type="date"],
	html input[type="number"],
	html input[type="tel"],
	#bbpress-forums #bbp-your-profile fieldset input, 
	#bbpress-forums #bbp-your-profile fieldset textarea,
	.bbp-login-form .bbp-username input, 
	.bbp-login-form .bbp-email input, 
	.bbp-login-form .bbp-password input,
	body .select2-container--default .select2-selection--single,
	body .select2-container--default .select2-search--dropdown .select2-search__field,
	.woocommerce form .form-row.woocommerce-validated .select2-container, 
	.woocommerce form .form-row.woocommerce-validated input.input-text, 
	.woocommerce form .form-row.woocommerce-validated select,
	body .select2-container--default .select2-selection--multiple{
		color:<?php echo esc_html($ts_input_text_color) ?>;
		border-color:<?php echo esc_html($ts_input_border_color) ?>;
	}
	body .select2-container--default .select2-selection--single .select2-selection__rendered{
		color:<?php echo esc_html($ts_input_text_color) ?>;
	}
	header .header-v3 .ts-search-by-category input[type="text"], 
	header .header-v4 .ts-search-by-category input[type="text"]{
		border-color:<?php echo esc_html($ts_input_border_color) ?>;
	}
	html input[type="search"]:hover,
	html input[type="text"]:hover, 
	html input[type="email"]:hover,
	html input[type="password"]:hover,
	html input[type="date"],
	html input[type="number"]:hover,
	html input[type="tel"]:hover,
	html textarea:hover,
	html input[type="search"]:focus,
	html input[type="text"]:focus, 
	html input[type="email"]:focus,
	html input[type="password"]:focus,
	html input[type="date"]:focus,
	html input[type="number"]:focus,
	html input[type="tel"]:focus,
	input:-webkit-autofill, 
	textarea:-webkit-autofill, 
	select:-webkit-autofill,
	html textarea:focus,
	.woocommerce form .form-row textarea:hover, 
	.woocommerce form .form-row textarea:focus, 
	#bbpress-forums #bbp-your-profile fieldset input:hover, 
	#bbpress-forums #bbp-your-profile fieldset textarea:hover,
	#bbpress-forums #bbp-your-profile fieldset input:focus, 
	#bbpress-forums #bbp-your-profile fieldset textarea:focus,
	.bbp-login-form .bbp-username input:hover, 
	.bbp-login-form .bbp-email input:hover, 
	.bbp-login-form .bbp-password input:hover,
	.bbp-login-form .bbp-username input:focus, 
	.bbp-login-form .bbp-email input:focus, 
	.bbp-login-form .bbp-password input:focus,
	body .select2-container--default.select2-container--focus .select2-selection--multiple,
	.woocommerce form .form-row.woocommerce-validated .select2-container, 
	.woocommerce form .form-row.woocommerce-validated input.input-text, 
	.woocommerce form .form-row.woocommerce-validated select,
	body .select2-container--open .select2-selection--single{
		color:<?php echo esc_html($ts_input_text_color_hover) ?>;
		border-color:<?php echo esc_html($ts_input_border_color_hover) ?>;
	}
	body .select2-container--open .select2-selection--single .select2-selection__rendered{
		color:<?php echo esc_html($ts_input_text_color_hover) ?>;
	}
	body .theme-default .nivo-controlNav a:before{
		border-color:<?php echo esc_html($ts_input_text_color) ?>;
	}
	body .theme-default .nivo-controlNav a:hover:before,
	body .theme-default .nivo-controlNav a.active:before{
		border-color:<?php echo esc_html($ts_input_text_color) ?>;
		background-color:<?php echo esc_html($ts_input_text_color) ?>;
	}

	/* HEADING COLOR */

	h1,h2,h3,h4,h5,h6,
	.h1,.h2,.h3,.h4,.h5,.h6,
	.woocommerce > form > fieldset legend{
		color:<?php echo esc_html($ts_heading_color) ?>;
	}

	/* LINK COLOR */

	a{
		color:<?php echo esc_html($ts_link_color) ?>;
	}
	a:hover,
	a:active{
		color:<?php echo esc_html($ts_link_color_hover) ?>;
	}


	/* PRIMARY TEXT COLOR */

	table thead th,
	label ,
	p > label,
	fieldset div > label,
	.wpcf7 p,
	.primary-text,
	.banner-fullwidth-wrapper .banner_detail a.banner-button,
	/* Widget */
	.widget-container .tagcloud a:hover,
	/* Product Detail */
	h3.heading-title > a,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	.ts-heading h1,
	.ts-heading h2,
	.ts-heading h3,
	.ts-heading h4,
	.avatar-name a,
	h1 > a,
	h2 > a,
	h3 > a,
	h4 > a,
	h5 > a,
	h6 > a,
	a.view-more,
	.secondary-color,
	.cart_list span.quantity,
	.widget-title,
	.widget.ts-products-widget > .widgettitle,
	.ts-product-in-category-tab-2-wrapper .column-tabs .heading-tab h3,
	.ts-product-categories-widget ul.product-categories span.icon-toggle,
	.ts-product-category-slider-wrapper .category-name h3 > a,
	.widget_categories > ul li.cat-parent > span.icon-toggle,
	.ts-product-categories-widget ul.product-categories > li >a,
	.widget_categories > ul > li > a,
	.ts-team-member .content-thumbnail .member-social a,
	body.error404 article h2,
	.ts-countdown.text-light .counter-wrapper > div,
	.total .total-title,
	.cart_list .quantity,
	.cart_list .icon,
	blockquote:before,
	.woocommerce div.product .woocommerce-tabs ul.tabs li > a,
	.pp_woocommerce div.product .product_title,
	.woocommerce div.product .product_title,
	.woocommerce-product-rating .woocommerce-review-link,
	/* Portfolio */
	.ts-portfolio-wrapper .filter-bar li,
	.portfolio-inner .item a,
	.widget-container .post_list_widget > li a.post-title,
	.entry-author .author-info .role,
	.vc_progress_bar .vc_single_bar .vc_label,
	.vc_progress_bar .vc_single_bar .vc_bar:before,
	.vc_toggle .vc_toggle_icon:before,
	.vc_toggle_default .vc_toggle_title h4,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title,
	.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
	.woocommerce p.stars a:hover,
	.woocommerce-cart .cart-collaterals .cart_totals table td, 
	.woocommerce-cart .cart-collaterals .cart_totals table th,
	.shipping-calculator-button,
	.woocommerce-billing-fields > h3,
	.woocommerce-shipping-fields > h3,
	#customer_login .col-1 > h2,
	#customer_login .col-2 > h2,
	.heading-wrapper > h2,
	.heading-shortcode > h3,
	.theme-title > h3,
	.cross-sells > h2,
	.upsells > h2,
	.related > h2,
	.cart_totals h2,
	.mc4wp-form-fields h2.title,
	.wp-caption p.wp-caption-text,
	.sku-wrapper,
	#order_review_heading,
	#ship-to-different-address, 
	.woocommerce form.login, 
	.woocommerce form.register, 
	.woocommerce .checkout #order_review table th,
	.desc-big,
	.mailchimp-subscription .widgettitle,
	.column-tabs .tabs li,
	.woocommerce .ts-product-deals-slider-wrapper.list .products .product .short-description,
	.dashboard-widget.products ul li a,
	.row-heading-tabs ul li,
	.row-heading-tabs ul li a,
	.widget-container .tagcloud a:hover,
	.heading-title,
	body div.pp_woocommerce .pp_description,
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	.woocommerce .products .product.product-category h3,
	.woocommerce .widget_layered_nav ul li a,
	.cats-link span:not(.cat-links),
	.tags-link span:not(.tags-links),
	.ts-product-social-sharing li a,
	.woocommerce-MyAccount-content > h2,
	.woocommerce-customer-details > h2,
	.woocommerce-order-details > h2,
	.woocommerce-account .addresses h3,
	.woocommerce-account .addresses h2,
	.woocommerce-customer-details .addresses h2,
	.woocommerce table.shop_table.order_details tfoot th,
	.woocommerce table.shop_table.customer_details th,
	.comments-area .reply a,
	.pp_woocommerce table .quantity .minus, 
	.pp_woocommerce table .quantity .plus, 
	.woocommerce table .quantity .minus, 
	.woocommerce table .quantity .plus,
	.mailchimp-subscription.text-default .widget-title-wrapper h3,
	.woocommerce #reviews #reply-title,
	.woocommerce .ts-product-category-slider-wrapper .product.product-category h3,
	.ts-gravatar-profile-widget .meta h4,
	.widget-container .social-icons li > a,
	.woocommerce div.wishlist-title h2,
	.woocommerce .products .product.product-category h3,
	.ts-social-icons .social-icons.style-vertical .ts-tooltip,
	#bbpress-forums #bbp-user-wrapper h2.entry-title,
	fieldset legend,
	.woocommerce ul.order_details li strong,
	/* Portfolio */
	.portfolio-info p,
	.single-portfolio .info-content .entry-title,
	.vc_pie_chart .vc_pie_chart_value,
	/* Team */
	.ts-team-member header > h3 a,
	/* Forum */
	#bbpress-forums .status-category .bbp-forum-title,
	.type-forum .bbp-forum-title,
	#bbpress-forums li.bbp-footer,
	span.bbp-admin-links a:hover,
	#bbpress-forums fieldset.bbp-form legend,
	.type-topic .bbp-topic-title > a,
	#bbpress-forums div.bbp-topic-author a.bbp-author-name, 
	#bbpress-forums div.bbp-reply-author a.bbp-author-name,
	.bbp-meta .bbp-topic-permalink,
	.bbp-topic-title-meta a,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
	#favorite-toggle a, 
	#subscription-toggle a,
	/* Compare table */
	body table.compare-list th,
	body table.compare-list tr.title th,
	body table.compare-list tr.image th,
	body table.compare-list tr.price th{
		color:<?php echo esc_html($ts_secondary_color) ?>;
	}
	body div.ppt,
	.woocommerce table.shop_table .product-remove a,
	.cart_list li .cart-item-wrapper a.remove,
	.woocommerce .widget_shopping_cart .cart_list li a.remove, 
	.woocommerce.widget_shopping_cart .cart_list li a.remove,
	body .yith-woocompare-widget ul.products-list a.removebefore,
	body .pp_nav .pp_play:before, 
	body .pp_nav .pp_pause:before,
	body .pp_arrow_previous:before, 
	body .pp_arrow_next:before,
	body div.pp_woocommerce.pp_pic_holder .pp_arrow_previous:before, 
	body div.pp_woocommerce.pp_pic_holder .pp_arrow_next:before{
		color:<?php echo esc_html($ts_secondary_color) ?> !important;
	}
	footer .widget_product_tag_cloud .tagcloud a:hover,
	footer .widget_tag_cloud .tagcloud a:hover,
	/* Header */
	header .ts-search-by-category .search-content input[type="submit"]:hover{
		background:<?php echo esc_html($ts_secondary_color) ?>;
	}
	.cats-portfolio:before,
	.ts-product-attribute > div.color a:before,
	.ts-product-attribute > div.selected:before,
	.product-filter-by-color ul li a:before{
		border-color:<?php echo esc_html($ts_secondary_color) ?>;
	}
	.text-light .owl-dots > div > span:before,
	body .flex-control-paging li a:before,
	body .theme-default .nivo-controlNav a:before,
	body #fp-nav ul li a span:before, 
	body .fp-slidesNav ul li a span:before,
	body div.pp_woocommerce .pp_gallery ul li a:hover, 
	body div.pp_woocommerce .pp_gallery ul li.selected a,
	body div.pp_default .pp_gallery ul li a:hover, 
	body div.pp_default .pp_gallery ul li.selected a{
		border-color:<?php echo esc_html($ts_text_color_in_bg_second) ?>;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li > a:hover,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a,
	/* Pagination */
	.woocommerce nav.woocommerce-pagination ul li a.next:hover, 
	.woocommerce nav.woocommerce-pagination ul li a.prev:hover, 
	.ts-pagination ul li a.prev:hover,
	.ts-pagination ul li a.next:hover,

	.woocommerce nav.woocommerce-pagination ul li a.next:focus, 
	.woocommerce nav.woocommerce-pagination ul li a.prev:focus, 
	.ts-pagination ul li a.prev:focus,
	.ts-pagination ul li a.next:focus,

	.dokan-pagination-container .dokan-pagination li:hover a,
	.dokan-pagination-container .dokan-pagination li.active a,
	.ts-pagination ul li a:hover,
	.ts-pagination ul li a:focus,
	.ts-pagination ul li span.current,
	.woocommerce nav.woocommerce-pagination ul li a:hover, 
	.woocommerce nav.woocommerce-pagination ul li span.current, 
	.woocommerce nav.woocommerce-pagination ul li a:focus, 
	 
	.woocommerce nav.woocommerce-pagination ul li a.next:focus 
	.woocommerce nav.woocommerce-pagination ul li a.prev:focus, 

	.woocommerce nav.woocommerce-pagination ul li a.next:hover, 
	.woocommerce nav.woocommerce-pagination ul li a.prev:hover, 

	.bbp-pagination-links a:hover, 
	.bbp-pagination-links span.current{
		background:<?php echo esc_html($ts_secondary_color) ?>;
		color:<?php echo esc_html($ts_text_color_in_bg_second) ?>;
		border-color:<?php echo esc_html($ts_secondary_color) ?>;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a:after{
		color:<?php echo esc_html($ts_secondary_color) ?>;
	}
	.portfolio-inner .icon-group a,
	.single-portfolio .ic-like{
		border-color:<?php echo esc_html($ts_secondary_color) ?>;
		color:<?php echo esc_html($ts_secondary_color) ?>;
		background-color:<?php echo esc_html($ts_text_color_in_bg_second) ?>;
	}
	div.product .summary .print a,
	div.product .summary .email a,
	div.product .summary .wishlist a,
	.woocommerce .summary div.yith-wcwl-add-to-wishlist a,
	.woocommerce div.product .summary a.compare,
	.woocommerce .button.button-secondary.transparent,
	body .button.button-secondary.transparent,
	.woocommerce .widget_price_filter .price_slider_amount .button,
	.woocommerce table.cart td.actions .coupon .button,
	.pp_woocommerce div.product form.cart table .button, 
	.woocommerce div.product form.cart table .button,
	.woocommerce table.my_account_orders tr td:last-child .button,
	.woocommerce .checkout_coupon input[type="submit"],
	.woocommerce .woocommerce-shipping-calculator .button,
	body .single-post .single-navigation > a{
		border-color:<?php echo boxshop_calc_color($ts_border_color, '#1f1f1f',false) ?>;/* color border + - */
		color:<?php echo esc_html($ts_secondary_color) ?>;
		background-color:<?php echo esc_html($ts_widget_content_background_color) ?>;
	}
	.quantity input[type="number"],
	.pp_woocommerce .quantity input.qty,
	.woocommerce .quantity input.qty, 
	.pp_woocommerce .quantity .minus, 
	.pp_woocommerce .quantity .plus,
	.woocommerce .quantity .minus, 
	.woocommerce .quantity .plus,
	.gridlist-toggle a,
	.ts-product-social-sharing li a,
	.woocommerce .woocommerce-ordering ul.orderby,
	.prod-cat-show-top-content-button{
		border-color:<?php echo boxshop_calc_color($ts_border_color, '#1f1f1f',false) ?>;/* color border + - */
	}
	.mc4wp-form-fields input[type="submit"],
	.pp_woocommerce div.product p.cart .button:hover, 
	.woocommerce div.product p.cart .button:hover,
	.pp_woocommerce div.product form.cart .button:hover, 
	.woocommerce div.product form.cart .button:hover,
	html body table.compare-list tr.add-to-cart td a:hover,
	.woocommerce-account .woocommerce-MyAccount-navigation li:hover a,
	.woocommerce-account .woocommerce-MyAccount-navigation li.is-active a,
	body .rev_slider .rev-btn-secondary,
	a.button.button-border-secondary:hover,
	input.button.button-border-secondary:hover,
	.woocommerce-page a.button.button-border-secondary:hover,
	.woocommerce-page input.button.button-border-secondary:hover,
	.woocommerce .button.button-transparent:hover,
	body .button.button-transparent:hover,
	body .button.button-secondary,
	.woocommerce .cart_totals a.continue-shopping.button,
	.woocommerce .button.button-secondary,
	.woocommerce .button.button-primary:hover,
	body .button.button-primary:hover,
	body footer .style-1 .mailchimp-subscription button.button:hover,
	.woocommerce footer .style-1 .mailchimp-subscription button.button:hover,
	body input.wpcf7-submit,
	.woocommerce #payment #place_order:hover, 
	.woocommerce #respond input#submit.disabled, 
	.woocommerce #respond input#submit:disabled, 
	.woocommerce #respond input#submit:disabled[disabled], 
	.woocommerce a.button.disabled, 
	.woocommerce a.button:disabled, 
	.woocommerce a.button:disabled[disabled], 
	.woocommerce button.button.disabled, 
	.woocommerce button.button:disabled, 
	.woocommerce button.button:disabled[disabled], 
	.woocommerce input.button.disabled, 
	.woocommerce input.button:disabled, 
	.woocommerce input.button:disabled[disabled],
	.woocommerce .woocommerce-ordering:hover ul.orderby,
	.woocommerce .button.button-secondary.transparent:hover,
	body .button.button-secondary.transparent:hover,
	.woocommerce .widget_price_filter .price_slider_amount .button:hover,
	.woocommerce table.my_account_orders tr td:last-child .button:hover,
	.woocommerce table.cart td.actions .coupon .button:hover,
	.woocommerce .checkout_coupon input[type="submit"]:hover,
	.pp_woocommerce div.product form.cart table .button:hover, 
	.woocommerce div.product form.cart table .button:hover,
	body .single-post .single-navigation > a:hover,
	/* Forum */
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a:hover,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,
	.widget_calendar caption{
		background-color:<?php echo esc_html($ts_button_background_color) ?>;
		color:<?php echo esc_html($ts_button_text_color) ?>;
		border-color:<?php echo esc_html($ts_button_border_color) ?>;
	}
	body .rev_slider .rev-btn-secondary:hover,
	a.button.button-border-secondary,
	input.button.button-border-secondary,
	.woocommerce-page a.button.button-border-secondary,
	.woocommerce-page input.button.button-border-secondary,
	body .button.button-secondary:hover,
	.woocommerce .button.button-secondary:hover,
	.woocommerce .cart_totals a.continue-shopping.button:hover{
		background-color:transparent;
		color:<?php echo esc_html($ts_button_border_color) ?>;
		border-color:<?php echo esc_html($ts_button_border_color) ?>;
	}
	/* Button Dots Slider */
	.owl-nav > div,
	div.product .single-navigation > div >  a,
	/* Slider Icon Thumbnail */
	.images-thumbnails > .thumbnails .owl-nav > div{
		border-color:<?php echo esc_html($ts_nav_slider_border_color) ?>;
		color:<?php echo esc_html($ts_nav_slider_icon_color) ?>;
		background:<?php echo esc_html($ts_nav_slider_background_color) ?>;
	}
	/* Slider Icon Thumbnail */
	.images-thumbnails > .thumbnails .owl-nav > div:hover,
	div.product .single-navigation > div >  a:hover,
	.single-navigation > a:hover,
	.owl-nav > div:hover{
		border-color:<?php echo esc_html($ts_nav_slider_border_color_hover) ?>;
		color:<?php echo esc_html($ts_nav_slider_icon_color_hover) ?>;
		background:<?php echo esc_html($ts_nav_slider_background_color_hover) ?>;
	}
	/* PRIMARY COLOR */
	table thead th,
	.ts-products-tabs-widget .vc_tta-accordion .vc_tta-panels > div .vc_tta-panel-heading a:before,
	.ts-products-widget-shortcode.title-background-color .widgettitle,
	.list-posts article:not(.format-quote) .entry-meta .date-time, 
	article.single .entry-meta .date-time, 
	.ts-blogs article:not(.quote) .entry-meta .date-time,
	.ts-dropcap.style-2,
	.ts-social-icons .ts-tooltip,
	.product-group-button .button-tooltip,
	/* Compare table */
	body > h1,
	body > h1 a.close{
		color:<?php echo esc_html($ts_text_color_in_bg_primary) ?>;
	}
	.primary-color,
	.cart_list .amount,
	.total .amount,
	.column-tabs .tabs li:hover,
	.column-tabs .tabs li.current,
	.ol-style ol li:before,
	.ol-style li:before,
	.ul-style li:before,
	.office-address:before,
	.phone-numbers:before,
	.email-address:before,
	.fax-numbers:before,
	.office-address:after,
	.phone-numbers:after,
	.email-address:after,
	.fax-numbers:after,
	.ts-dropcap,
	h1 > a:hover,
	h2 > a:hover,
	h3 > a:hover,
	h4 > a:hover,
	h5 > a:hover,
	h6 > a:hover,
	.comments-area .reply a:hover,
	.ts-product-in-category-tab-2-wrapper .see-more-button:hover,
	ul.product_list_widget li .product-categories a:hover,
	.ts-product-category-slider-wrapper .category-name h3 > a:hover,
	.cats-link a:hover,
	.tags-link a:hover,
	.woocommerce .checkout #order_review table thead th,
	.woocommerce-product-rating .woocommerce-review-link:hover,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab.vc_active > a:after,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab.vc_active a:after, 
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab.vc_active a:after, 
	body.wpb-js-composer .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-left .vc_tta-tab.vc_active > a:after, 
	body.wpb-js-composer .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-right .vc_tta-tab.vc_active > a:after,
	body.wpb-js-composer .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active > a:after,
	body .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a i,
	body .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a:hover i,
	body.wpb-js-composer .ts-products-tabs-widget .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a:hover,
	body.wpb-js-composer .ts-products-tabs-widget .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a:hover,
	body.wpb-js-composer .vc_toggle_default.vc_toggle_active .vc_toggle_title h4,
	body.wpb-js-composer .vc_toggle_default .vc_toggle_title:hover h4,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab.vc_active > a,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a:hover,
	body.wpb-js-composer .vc_toggle_active .vc_toggle_icon:before,
	/* Portfolio */
	.ts-portfolio-wrapper .filter-bar li:hover,
	.ts-portfolio-wrapper .filter-bar li.current,
	.portfolio-inner .item a:hover,
	.widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
	.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
	.ts-social-icons li.custom .ts-tooltip:before,
	body .style-3 .mailchimp-subscription.text-light button.button:hover,
	a.view-more:hover,
	/* Product Detail */
	.order-number a,
	label a:hover,
	.widget-container ul > li a:hover,
	.dokan-widget-area .widget ul li > a:hover,
	.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li.active a,
	.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li:hover a,
	.dokan-dashboard .dokan-dashboard-content a:hover,
	.dokan-dashboard .dokan-dashboard-content li.active > a,
	span.author a,
	section.widget_nav_menu > div > ul > li > a:hover,
	.widget-container ul ul li > a:hover,
	.list-posts .heading-title a:hover,
	p.lost_password a:hover,
	.products .product.product-category a:hover h3, 
	.woocommerce .products .product.product-category a:hover h3, 
	header .header-template .my-account-wrapper .forgot-pass a:hover,
	.woocommerce .products .product .product-categories a:hover, 
	.woocommerce .widget-container il li .product-categories a:hover,
	.widget-container ul li .product-categories a:hover,
	.widget.ts-products-widget .product-categories a:hover,
	.woocommerce .widget_layered_nav ul li:hover a,
	.woocommerce .widget_layered_nav ul li:hover span.count,
	.woocommerce .widget_layered_nav ul li.chosen a,
	.woocommerce .widget_layered_nav ul li.chosen span.count,
	.ts-feature-wrapper .feature-icon:hover,
	.ts-product-attribute > div:hover a,
	.ts-product-categories-widget ul.product-categories span.icon-toggle:hover,
	.widget_categories > ul li.cat-parent > span.icon-toggle:hover,
	.ts-product-categories-widget ul.product-categories li.current > a,
	.ts-product-categories-widget ul.product-categories li a:hover,
	.widget_categories > ul li.current-cat > a,
	.widget_categories > ul li a:hover,
	.ts-testimonial-wrapper.text-light .testimonial-content h4.name a:hover,
	.ts-twitter-slider.text-light .twitter-content h4.name > a:hover,
	.woocommerce .ts-product-deals-slider-wrapper .products .product .product-categories a:hover,
	.woocommerce .ts-product-deals-slider-wrapper .products .center .product-name a:hover,
	.gridlist-toggle a:hover,
	.gridlist-toggle a.active,
	.woocommerce .woocommerce-ordering ul li a:hover, 
	.shipping-calculator-button:hover,
	.widget-container .post_list_widget > li a.post-title:hover,
	.single-portfolio .cat-links > a:hover,
	body.error404 article h1,
	body.error404 .icon-404 i,
	.ts-tiny-cart-wrapper .ic-cart:before,
	footer#colophon .ts-social-icons .social-icons.style-vertical li.custom:hover a span,
	body .select2-container--default .select2-results__option[aria-selected=true],
	body .select2-container--default .select2-results__option--highlighted[aria-selected],
	/* Header */
	.ic-mobile-menu-close-button:hover,
	a.ic-home:hover i,
	/* Menu phone */
	.mobile-menu-wrapper li:hover > a,
	.mobile-menu-wrapper li .ts-menu-drop-icon:hover,
	.mobile-menu-wrapper li.current-menu-item > a,
	.mobile-menu-wrapper li.current_page_item > a,
	.mobile-menu-wrapper li:hover:before,
	.mobile-menu-wrapper li.current-menu-item:before,
	.mobile-menu-wrapper li.current_page_item:before,
	/* Team */
	.ts-team-member header > h3 a:hover,
	/* Product detail */
	.pp_woocommerce div.product form.cart .variations td .reset_variations,
	.woocommerce div.product form.cart .variations td .reset_variations, 
	/* Product */
	#ts-search-result-container .view-all-wrapper a:hover,
	#ts-search-result-container ul li a:hover,
	.pp_woocommerce table .quantity .minus:hover, 
	.pp_woocommerce table .quantity .plus:hover, 
	.woocommerce table .quantity .minus:hover, 
	.woocommerce table .quantity .plus:hover,
	/* Product name */
	.list-cats li a:hover,
	.widget-container .product_list_widget li a:hover,
	.woocommerce .widget-container .product_list_widget li a:hover,
	.widget.ts-products-widget .ts-wg-meta > a:hover,
	.woocommerce .ts-recently-viewed-products-wrapper li .ts-wg-meta > a:hover,
	.ts-header .header-top h3.product-name > a:hover, 
	h3.product-name > a:hover, 
	h3.product-name:hover,
	.product-name a:hover,
	.group_table a:hover,
	.ts-feature-wrapper.active-feature .feature-header h3 > a,
	/* Forum */
	.bbp-login-links a:hover,
	#bbpress-forums .status-category > .bbp-forum-info > a.bbp-forum-title:hover,
	.type-forum .bbp-forum-title:hover,
	.bbp-topic-started-in > a:hover,
	#bbpress-forums .status-category > li > .bbp-forums-list > li a:hover,
	li.bbp-forum-freshness a:hover, 
	li.bbp-topic-freshness a:hover,
	.type-topic .bbp-topic-title > a:hover,
	#bbpress-forums div.bbp-topic-author a.bbp-author-name:hover, 
	#bbpress-forums div.bbp-reply-author a.bbp-author-name:hover,
	.bbp-meta .bbp-topic-permalink:hover,
	.bbp-topic-title-meta a:hover,
	#favorite-toggle a:hover,
	#subscription-toggle a:hover,
	.dashboard-widget.products ul li a:hover{
		color:<?php echo esc_html($ts_primary_color) ?>;
	}
	/* Slider Icon Thumbnail */
	.text-light .owl-nav > div:hover:before,
	.text-light .owl-nav > div:hover,
	.style-light .owl-nav > div:hover,
	.owl-dots > div > span:hover:before,
	.owl-dots > div.active > span:before{
		border-color:<?php echo esc_html($ts_primary_color) ?>;
		background-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	.woocommerce .product figure .color-image.active span:before,
	.woocommerce .product figure .color.active span:before{
		border-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	body .pp_nav .pp_play:hover:before, 
	body .pp_nav .pp_pause:hover:before,
	body .pp_arrow_previous:hover:before, 
	body .pp_arrow_next:hover:before,
	body div.pp_woocommerce.pp_pic_holder .pp_arrow_previous:hover:before, 
	body div.pp_woocommerce.pp_pic_holder .pp_arrow_next:hover:before{
		color:<?php echo esc_html($ts_primary_color) ?> !important;
	}
	.tp-bullets.simplebullets .bullet:hover:after, 
	.tp-bullets.simplebullets .bullet.selected:after,
	body .rev_slider .tp-bullets .tp-bullet:hover:after, 
	body .rev_slider .tp-bullets .tp-bullet.selected:after,
	.widget-container:before,
	.menu-wrapper > .ic-close-menu-button:hover,
	.woocommerce div.product div.thumbnails li:hover a img,
	.pp_woocommerce div.product div.thumbnails li:hover a img,
	.ts-footer-block .widget-container ul li.custom:hover > a,
	footer#colophon .ts-social-icons li.custom:hover a,
	.ts-social-icons li.custom:hover a,
	footer#colophon .ts-social-icons .style-vertical li.custom:hover a i:after,
	.gridlist-toggle a:hover,
	.gridlist-toggle a.active,
	.shopping-cart-wrapper .ts-tiny-cart-wrapper,
	body.wpb-js-composer .vc_general.vc_tta-style-2 .vc_tta-tabs-container{
		border-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	table thead th,
	.ts-dropcap.style-2,
	.ts-products-widget-shortcode.title-background-color .widgettitle,
	.list-posts article:not(.format-quote) .entry-meta .date-time,
	article.single .entry-meta .date-time,
	.ts-blogs article:not(.quote) .entry-meta .date-time,
	.ts-products-tabs-widget .vc_tta-accordion .vc_tta-panels > div .vc_tta-panel-heading a:after,
	.title-background-color .shortcode-heading-wrapper .heading-title,
	/* Forum */
	#bbpress-forums ul.bbp-replies > .bbp-header,
	#bbpress-forums ul.bbp-lead-topic .bbp-header, 
	#bbpress-forums ul.bbp-topics .bbp-header, 
	#bbpress-forums ul.bbp-forums .bbp-header, 
	#bbpress-forums ul.bbp-replies > .bbp-header,
	#bbpress-forums ul.bbp-search-results .bbp-header,
	.woocommerce table.cart th,
	/* Team icon custom */
	.ts-team-member .image-thumbnail .social a.custom:hover,
	/* Compare table */
	body > h1,
	/* Social */
	.ts-social-icons .style-vertical li.custom:hover a i:after,
	footer#colophon .ts-social-icons .style-vertical li.c:hover a i:after,
	.ts-social-icons li.custom:hover a,
	footer#colophon .ts-social-icons li.custom:hover a,
	.ts-social-icons li.custom  .ts-tooltip,
	footer#colophon .ts-social-icons li.custom .ts-tooltip,
	/* Header */
	.ts-tiny-cart-wrapper .ic-cart:after,
	header .ts-search-by-category .search-content input[type="submit"]{
		background-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	.cart_list li .cart-item-wrapper a.remove:hover,
	.woocommerce .widget_shopping_cart .cart_list li a.remove:hover, 
	.woocommerce.widget_shopping_cart .cart_list li a.remove:hover,
	body table.compare-list tr.remove td > a .remove:hover:before,
	body .yith-woocompare-widget ul.products-list a.remove:hover:before{
		color:<?php echo esc_html($ts_primary_color) ?> !important;
	}

	/* INPUT COLOR */

	*,
	* :before,
	* :after,
	.woocommerce table.shop_table, 
	.woocommerce-page table.shop_table,
	.woocommerce ul.order_details li,
	#add_payment_method table.cart td.actions .coupon .input-text, 
	.woocommerce-cart table.cart td.actions .coupon .input-text, 
	.woocommerce-checkout table.cart td.actions .coupon .input-text, 
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a, 
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab a, 
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab a,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_toggle_default .vc_toggle_content, 
	body.wpb-js-composer .vc_toggle_size_md.vc_toggle_default .vc_toggle_content, 
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel-body,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	.widget.ts-products-widget li > a.ts-wg-thumbnail,
	.woocommerce ul.product_list_widget li > a.ts-wg-thumbnail,
	.dokan-dashboard .dokan-dashboard-content .edit-account fieldset,
	body > table.compare-list,
	.woocommerce table.my_account_orders tbody tr:first-child td:first-child,
	body .woocommerce table.my_account_orders td.order-actions,
	body div.pp_woocommerce .pp_gallery ul li a, 
	body.wpb-js-composer .vc_separator.border-color .vc_sep_line,
	.woocommerce table.shop_attributes th, 
	.woocommerce table.shop_attributes td, 
	.woocommerce .widget_layered_nav ul, 
	.woocommerce table.shop_table, 
	.woocommerce table.shop_table td, 
	body .wpb_flexslider.flexslider,
	.woocommerce table.wishlist_table thead th, 
	.woocommerce table.wishlist_table tbody td,
	.widget_product_search, 
	.widget_search, 
	.widget_display_search,
	.widget-container.widget_calendar,
	.entry-bottom .ts-social-sharing li a,
	.woocommerce p.stars a.star-1, 
	.woocommerce p.stars a.star-2, 
	.woocommerce p.stars a.star-3, 
	.woocommerce p.stars a.star-4, 
	.woocommerce p.stars a.star-5,
	.woocommerce #reviews #comments ol.commentlist li .comment-text,
	.woocommerce table.shop_attributes, 
	.woocommerce #reviews #comments ol.commentlist li ,
	.dataTables_wrapper,
	.woocommerce div.product div.thumbnails li a img,
	.pp_woocommerce div.product div.images-slider-wrapper img,
	.woocommerce div.product div.images-thumbnails img,
	.woocommerce ul.cart_list li img, 
	.woocommerce ul.product_list_widget li img,
	body.thumbnail-no-border div.product div.images-thumbnails div.thumbnails li:hover img,
	/* Forum */
	#bbpress-forums li.bbp-body ul.forum, 
	#bbpress-forums li.bbp-body ul.topic,
	#bbpress-forums ul.bbp-lead-topic, 
	#bbpress-forums ul.bbp-topics, 
	#bbpress-forums ul.bbp-forums, 
	#bbpress-forums ul.bbp-replies, 
	#bbpress-forums ul.bbp-search-results,
	#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content,
	#bbpress-forums div.bbp-forum-header,
	#bbpress-forums div.bbp-topic-header, 
	#bbpress-forums div.bbp-reply-header,
	#bbpress-forums li.bbp-header, 
	#bbpress-forums li.bbp-footer,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a{
		border-color:<?php echo esc_html($ts_border_color) ?>;
	}
	#bbpress-forums div.bbp-the-content-wrapper div.quicktags-toolbar,
	.ts-product-attribute > div:before{
		background-color:<?php echo esc_html($ts_border_color) ?>;
		border-color:<?php echo esc_html($ts_border_color) ?>;
	}

	/* REVOLUTION SLIDER */

	.vc_images_carousel .vc_left .icon-prev:after, 
	.vc_images_carousel .vc_right .icon-next:after,
	.tp-leftarrow.tparrows:after,
	.tp-rightarrow.tparrows:after,
	.wpb_gallery .wpb_flexslider .flex-direction-nav a:after,
	.theme-default .nivo-directionNav a:after{
		background-color:<?php echo esc_html($ts_revo_navigation_background_color) ?> !important;
	}
	.vc_images_carousel .vc_left .icon-prev:before, 
	.vc_images_carousel .vc_right .icon-next:before,
	.tp-leftarrow.tparrows:before,
	.tp-rightarrow.tparrows:before,
	.wpb_gallery .wpb_flexslider .flex-direction-nav a:before,
	.theme-default .nivo-directionNav a:before{
		color:<?php echo esc_html($ts_revo_navigation_text_color) ?> !important;
	}
	.vc_images_carousel .vc_left:hover .icon-prev:after, 
	.vc_images_carousel .vc_right:hover .icon-next:after,
	.tp-leftarrow.tparrows:hover:after,
	.tp-rightarrow.tparrows:hover:after,
	.wpb_gallery .wpb_flexslider .flex-direction-nav a:hover:after,
	.theme-default .nivo-directionNav a:hover:after{
		background-color:<?php echo esc_html($ts_revo_navigation_text_color) ?> !important;
	}
	.vc_images_carousel .vc_left:hover .icon-prev:before, 
	.vc_images_carousel .vc_right:hover .icon-next:before,
	.tp-leftarrow.tparrows:hover:before,
	.tp-rightarrow.tparrows:hover:before,
	.wpb_gallery .wpb_flexslider .flex-direction-nav a:hover:before,
	.theme-default .nivo-directionNav a:hover:before{
		color:<?php echo esc_html($ts_revo_navigation_background_color) ?> !important;
	}

	/* BUTTON */

	#to-top a:hover,
	a.button:hover,
	button:hover, 
	input[type="submit"]:hover, 
	.shopping-cart p.buttons a:hover, 
	.woocommerce #respond input#submit:hover, 
	.woocommerce a.button:hover, 
	.woocommerce button.button:hover, 
	.woocommerce input.button:hover, 
	.woocommerce #respond input#submit.alt:hover, 
	.woocommerce a.button.alt:hover, 
	.woocommerce button.button.alt:hover, 
	.woocommerce input.button.alt:hover, 
	.woocommerce #respond input#submit.alt.disabled,
	.woocommerce #respond input#submit.alt.disabled:hover,
	.woocommerce #respond input#submit.alt:disabled,
	.woocommerce #respond input#submit.alt:disabled:hover,
	.woocommerce #respond input#submit.alt:disabled[disabled],
	.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
	.woocommerce a.button.alt.disabled,
	.woocommerce a.button.alt.disabled:hover,
	.woocommerce a.button.alt:disabled,
	.woocommerce a.button.alt:disabled:hover,
	.woocommerce a.button.alt:disabled[disabled],
	.woocommerce a.button.alt:disabled[disabled]:hover,
	.woocommerce button.button.alt.disabled,
	.woocommerce button.button.alt.disabled:hover,
	.woocommerce button.button.alt:disabled,
	.woocommerce button.button.alt:disabled:hover,
	.woocommerce button.button.alt:disabled[disabled],
	.woocommerce button.button.alt:disabled[disabled]:hover,
	.woocommerce input.button.alt.disabled,
	.woocommerce input.button.alt.disabled:hover,
	.woocommerce input.button.alt:disabled,
	.woocommerce input.button.alt:disabled:hover,
	.woocommerce input.button.alt:disabled[disabled],
	.woocommerce input.button.alt:disabled[disabled]:hover,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab.vc_active > a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-style-2 .vc_tta-tab.vc_active > a:hover,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a:hover,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab.vc_active a, 
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab.vc_active a, 
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab:hover a, 
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab:hover a, 
	body.wpb-js-composer .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-left .vc_tta-tab.vc_active > a, 
	body.wpb-js-composer .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-right .vc_tta-tab.vc_active > a,
	.mc4wp-form-fields input[type="submit"]:hover,
	.woocommerce .cart_totals a.checkout-button.button,
	body .mailchimp-subscription.text-default button.button,
	.woocommerce .mailchimp-subscription.text-default button.button,
	a.button.button-border-primary:hover,
	input.button.button-border-primary:hover,
	.woocommerce a.button.button-border-primary:hover,
	.woocommerce input.button.button-border-primary:hover,
	.woocommerce .button.button-primary,
	body .button.button-primary,
	body footer .style-1 .mailchimp-subscription button.button,
	.woocommerce footer .style-1 .mailchimp-subscription button.button,
	body input.wpcf7-submit:hover,
	.portfolio-inner .icon-group a:hover,
	.woocommerce .button.button-primary.transparent:hover,
	body .button.button-primary.transparent:hover,
	.summary .quickshop .button-tooltip,
	.summary .wishlist .button-tooltip,
	.summary .compare .button-tooltip,
	div.product .summary .wishlist a:hover,
	.woocommerce .summary div.yith-wcwl-add-to-wishlist a:hover,
	.woocommerce div.product .summary a.compare:hover,
	div.product .summary .print a:hover,
	div.product .summary .email a:hover,
	.pp_woocommerce div.product form.cart .button, 
	.woocommerce div.product form.cart .button,
	.pp_woocommerce div.product p.cart .button, 
	.woocommerce div.product p.cart .button,
	html body table.compare-list tr.add-to-cart td a,
	.pp_woocommerce div.product form.cart .group_table .button:hover, 
	.woocommerce div.product form.cart .group_table .button:hover,
	.woocommerce .summary div.yith-wcwl-add-to-wishlist a:hover,
	.woocommerce div.product .summary a.compare:hover,
	div.product .summary .print a:hover,
	div.product .summary .email a:hover,
	.woocommerce #content table.shop_table input.button-secondary:hover, 
	.woocommerce table.shop_table input.button-secondary:hover, 
	.woocommerce-page #content table.shop_table input.button-secondary:hover, 
	.woocommerce-page table.shop_table input.button-secondary:hover,
	body .mfp-close-btn-in .mfp-close:hover,
	.woocommerce ul.product_list_widget li .loop-add-to-cart a:hover,
	/* Quick view hover */
	body #cboxClose:hover,
	#ts-search-popup .search-button input:hover,
	#ts-search-popup .ts-button-close:hover,
	body div.ts-product-video.pp_pic_holder .pp_close:hover,
	body .pp_nav .pp_play:hover, 
	body .pp_nav .pp_pause:hover,
	body div.pp_default .pp_close:hover,
	body div.pp_woocommerce.pp_pic_holder .pp_close:hover,
	body div.pp_woocommerce.pp_pic_holder .pp_expand:hover,
	body div.pp_woocommerce.pp_pic_holder .pp_contract:hover,
	body div.pp_default .pp_expand:hover,
	body div.pp_default.pp_contract:hover
	{
		background-color:<?php echo esc_html($ts_button_background_color_hover) ?>;
		border-color:<?php echo esc_html($ts_button_border_color_hover) ?>;
		color:<?php echo esc_html($ts_button_text_color_hover) ?>;
	}
	.woocommerce .cart_totals a.checkout-button.button:hover,
	.woocommerce .button.button-primary.transparent,
	body .button.button-primary.transparent,
	a.button.button-border-primary,
	input.button.button-border-primary,
	.woocommerce a.button.button-border-primary,
	.woocommerce input.button.button-border-primary,
	.woocommerce .woocommerce-shipping-calculator .button:hover{
		background:transparent;
		border-color:<?php echo esc_html($ts_button_border_color_hover) ?>;
		color:<?php echo esc_html($ts_button_border_color_hover) ?>;
	}
	.woocommerce .woocommerce-shipping-calculator .button:hover{
		background:#ffffff;
	}
	#to-top a,
	a.button,
	button,
	input[type="submit"],
	.shopping-cart p.buttons a,
	.woocommerce #payment #place_order,
	.woocommerce #respond input#submit,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt,
	body table.compare-list .add-to-cart td a,
	body .mailchimp-subscription.text-default button.button:hover,
	.woocommerce .mailchimp-subscription.text-default button.button:hover,
	body .mailchimp-subscription.text-default button.button:focus,
	.woocommerce .mailchimp-subscription.text-default button.button:focus{
		background-color:<?php echo esc_html($ts_button_background_color) ?>;
		border-color:<?php echo esc_html($ts_button_border_color) ?>;
		color:<?php echo esc_html($ts_button_text_color) ?>;
	}
	/* Pagination */
	.ts-pagination ul li a,
	.dokan-pagination-container .dokan-pagination li a,
	.woocommerce nav.woocommerce-pagination ul li a, 
	.woocommerce nav.woocommerce-pagination ul li span, 
	.bbp-pagination-links a{
		background-color:<?php echo esc_html($ts_widget_content_background_color) ?>;
		color:<?php echo boxshop_calc_color($ts_text_color, '#1e1e1e',false) ?>;/* color text strong */
		border-color:<?php echo boxshop_calc_color($ts_border_color, '#1f1f1f',false) ?>;/* color border + - */
	}
	/* Breadcrumb */
	.breadcrumb-title-wrapper.breadcrumb-v2{
		border-color:<?php echo esc_html($ts_breadcrumb_border_bottom_color) ?>;
	}
	.breadcrumb-title-wrapper{
		background-color:<?php echo esc_html($ts_breadcrumb_background_color) ?>;
	}
	.breadcrumb-title-wrapper .breadcrumb-title *{
		color:<?php echo esc_html($ts_breadcrumb_text_color) ?>;
	}
	.breadcrumb-title-wrapper .breadcrumb-title a:hover{
		color:<?php echo esc_html($ts_breadcrumb_link_color_hover) ?>;
	}
	.breadcrumb-title-wrapper .breadcrumb-title h1{
		color:<?php echo esc_html($ts_breadcrumb_heading_color) ?>;
	}

	/* ============= 3. HEADER COLORS ============== */

	/* Header top */
	.header-v1 .top-right,
	.header-top{
		border-color:<?php echo esc_html($ts_top_header_border_color) ?>;
	}
	.header-v1 .top-logo,
	.header-v1 .logo-vetical-ipad{
		background-color:<?php echo esc_html($ts_top_header_top_logo_background) ?>;
	}
	.header-top,
	.header-v1 .header-top .header-right:before{
		background-color:<?php echo esc_html($ts_top_header_background_color) ?>;
	}
	.header-top a:not(.button),
	.header-top,
	.header-v2 .header-top .shopping-cart-wrapper a.cart-control{
		color:<?php echo esc_html($ts_top_header_text_color) ?>;
	}
	/* Text Hover header top */
	#lang_sel_click ul ul a:hover,
	.header-currency ul li:hover a:not(.button),
	.header-top .my-account-wrapper .account-control > a:hover,
	.header-top .my-wishlist-wrapper > a:hover,
	.header-top #lang_sel_click > ul > li > a:hover,
	.header-top .wpml-ls a:hover, 
	.header-top .wpml-ls a:focus, 
	.header-top .wpml-ls ul ul li a:hover,
	.header-top .wpml-ls ul ul li a:focus,
	header.top-header-transparent .header-top .wpml-ls ul ul li a:hover,
	header.top-header-transparent .header-top .wpml-ls ul ul li a:focus,
	.header-top .wpml-ls .wpml-ls-current-language > a,
	.header-top .header-currency > div > a:hover,
	header.top-header-transparent .header-top .my-account-wrapper .account-control > a:hover,
	header.top-header-transparent .header-top .my-wishlist-wrapper > a:hover,
	header.top-header-transparent .header-top #lang_sel_click > ul > li > a:hover,
	header.top-header-transparent .header-top .wpml-ls a:hover, 
	header.top-header-transparent .header-top .wpml-ls a:focus, 
	header.top-header-transparent .header-top .wpml-ls .wpml-ls-current-language > a,
	header.top-header-transparent .header-top .header-currency > div > a:hover,
	.header-template .shopping-cart-wrapper .ic-cart:before{
		color:<?php echo esc_html($ts_primary_color) ?>;/* primary color */
	}
	/* Header middle */
	.header-middle{
		background-color:<?php echo esc_html($ts_middle_header_background_color) ?>;
	}
	/* Header bottom */
	header .header-bottom,
	header .header-v5 .header-bottom .header-left,
	.header-v1 .header-bottom .header-right:before,
	header .header-v7 .header-bottom .menu-wrapper{
		background-color:<?php echo esc_html($ts_bottom_header_background_color) ?>;
	}

	/* Header Search */
	body .category-dropdown .select2-dropdown,
	header .ts-search-by-category{
		background-color:<?php echo esc_html($ts_search_background_color) ?>;
	}
	body .category-dropdown .select2-dropdown,
	body .category-dropdown .select2-search--dropdown .select2-search__field,
	body .category-dropdown .select2-container--open .select2-dropdown--below,
	.header-v1 .ts-search-by-category:before,
	.header-v2 .ts-search-by-category:before,
	.header-v5 .ts-search-by-category:before,
	.header-v7 .ts-search-by-category:before{
		border-color:<?php echo esc_html($ts_search_border_color) ?>;
	}
	.category-dropdown li,
	header .select2-container--default .select2-selection--single .select2-selection__rendered,
	.ts-header .ts-search-by-category select{
		color:<?php echo esc_html($ts_search_categories_text_color) ?>;
	}
	header .select2-container--default .select2-selection--single .select2-selection__arrow b{
		border-top-color:<?php echo esc_html($ts_search_categories_text_color) ?>;
	}
	header .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b{
		border-bottom-color:<?php echo esc_html($ts_search_categories_text_color) ?>;
	}
	header .search-content input[type="text"]{
		color:<?php echo esc_html($ts_search_input_text_color) ?>;
		background-color<?php echo esc_html($ts_search_input_text_background_color) ?>;
	}
	body .category-dropdown .select2-results__option[aria-selected=true], 
	body .category-dropdown .select2-results__option--highlighted[aria-selected]{
		color:<?php echo esc_html($ts_search_categories_hightlighted_color) ?>;
	}

	/* Shopping Cart */
	header.top-header-transparent .shopping-cart-wrapper a.cart-control,
	.shopping-cart-wrapper a.cart-control{
		color:<?php echo esc_html($ts_header_cart_text_color) ?>;
	}
	.shopping-cart-wrapper a.cart-control .amount{
		color:<?php echo esc_html($ts_header_cart_amount_color) ?>;
	}
	.header-v3 .header-top .shopping-cart-wrapper:before, 
	.header-v4 .header-top .shopping-cart-wrapper:before,
	header .header-v5 .header-bottom .header-right,
	.header-v7 .header-middle .shopping-cart-wrapper{
		background:<?php echo esc_html($ts_header_cart_background_color) ?>;
	}
	
	/* ============= 4. MENU COLORS ============== */
	.header-v4 .header-bottom,
	.header-v6 .header-bottom{
		border-color:<?php echo esc_html($ts_menu_border_color) ?>;
	}
	/* Color Vertical Menu */
	.vertical-menu-wrapper .vertical-menu-heading,
	.widget-container.ts-menus-widget .widget-title,
	.header-v1 .header-bottom .header-left{
		background-color:<?php echo esc_html($ts_vertical_menu_title_background_color) ?>;
		color:<?php echo esc_html($ts_vertical_menu_title_text) ?>;
	}
	/* End Color Vertical Menu */

	header .header-v3 .toggle-search:before,
	header .header-v4 .toggle-search:before,
	.ts-menu > nav.pc-menu > ul.menu > li >.ts-menu-drop-icon,
	.menu-wrapper nav > ul.menu > li > a,
	.menu-wrapper nav > ul.menu li.fa:before{
		color:<?php echo esc_html($ts_menu_text_color) ?>;
	}
	.ts-menu > nav.pc-menu > ul.menu li:hover >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current_page_item >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current-menu-item >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current_page_parent >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current-menu-parent >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current-menu-ancestor >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current-product_cat-ancestor >.ts-menu-drop-icon,
	.ic-close-menu-button:hover,
	.menu-wrapper nav > ul.menu > li:hover > a,
	.menu-wrapper nav > ul.menu li.fa:hover:before,
	.menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	.menu-wrapper nav > ul.menu > li.fa.current_page_item:before,
	.menu-wrapper nav > ul.menu > li.fa.current-menu-item:before,
	.menu-wrapper nav > ul.menu > li.fa.current_page_parent:before,
	.menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	.menu-wrapper nav > ul.menu > li.fa.current-menu-ancestor:before,
	.menu-wrapper nav > ul.menu > li.current_page_item > a,
	.menu-wrapper nav > ul.menu > li.current-menu-item > a,
	.menu-wrapper nav > ul.menu > li.current_page_parent > a,
	.menu-wrapper nav > ul.menu > li.current-menu-parent > a,
	.menu-wrapper nav > ul.menu > li.current-menu-ancestor > a,
	.menu-wrapper nav > ul.menu li.current-product_cat-ancestor > a,
	.ts-menu-drop-icon.active:before,
	.ts-menu-drop-icon:hover:before,
	header .search-wrapper.active .toggle-search:before{
		color:<?php echo esc_html($ts_menu_text_color_hover) ?>;
	}
	/* Vertical sub menu */
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu li.fa:before{
		color:<?php echo esc_html($ts_vertical_menu_text_color) ?>;
	}
	.menu-wrapper .vertical-menu > ul.menu > li > .ts-menu-drop-icon,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li > a,
	header .ts-menu .vertical-menu-wrapper > ul.menu > ul > li > a{
		color:<?php echo esc_html($ts_vertical_menu_text_color) ?>;
		background-color:<?php echo esc_html($ts_vertical_menu_background_color) ?>;
	}
	.vertical-menu-small .menu-wrapper .vertical-menu > ul.menu{
		background-color:<?php echo esc_html($ts_vertical_menu_background_color) ?>;
	}
	.menu-wrapper .vertical-menu > ul.menu > li:hover > .ts-menu-drop-icon,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-product_cat-ancestor > .ts-menu-drop-icon,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current_page_item > .ts-menu-drop-icon,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-menu-item > .ts-menu-drop-icon,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current_page_parent > .ts-menu-drop-icon,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-menu-parent > .ts-menu-drop-icon,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-menu-ancestor > .ts-menu-drop-icon,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li:hover > a,
	header .ts-menu .vertical-menu-wrapper > ul.menu > ul > li:hover > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current_page_item > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-menu-item > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current_page_parent > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-menu-parent > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-menu-ancestor > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-product_cat-ancestor > a{
		color:<?php echo esc_html($ts_vertical_menu_text_color_hover) ?>;
		background-color:<?php echo esc_html($ts_vertical_menu_background_hover) ?>;
	}
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu li.fa:hover:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current_page_item:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current-menu-item:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current_page_parent:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current-menu-ancestor:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu li.fa:hover:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa:hover:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa:hover:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa:hover:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa:hover:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa:hover:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa:hover:before{
		color:<?php echo esc_html($ts_vertical_menu_text_color_hover) ?>;
	}
	.menu-wrapper nav > ul.menu li ul.sub-menu:before,
	.menu-wrapper .ts-menu > nav > ul.menu > li:after,
	.menu-wrapper .ts-menu > nav > ul.menu > li > a:after,
	.menu-wrapper .vertical-menu > ul.menu > li li ul.sub-menu:before,
	.vertical-menu-wrapper .vertical-menu{
		background-color:<?php echo esc_html($ts_sub_menu_background_color) ?>;
	}

	/* Menu sub heading */
	.menu-wrapper nav > ul.menu ul.sub-menu h1,
	.menu-wrapper nav > ul.menu ul.sub-menu h2,
	.menu-wrapper nav > ul.menu ul.sub-menu h3,
	.menu-wrapper nav > ul.menu ul.sub-menu h4,
	.menu-wrapper nav > ul.menu ul.sub-menu h5,
	.menu-wrapper nav > ul.menu ul.sub-menu h6,
	.menu-wrapper nav > ul.menu ul.sub-menu .h1,
	.menu-wrapper nav > ul.menu ul.sub-menu .h2,
	.menu-wrapper nav > ul.menu ul.sub-menu .h3,
	.menu-wrapper nav > ul.menu ul.sub-menu .h4,
	.menu-wrapper nav > ul.menu ul.sub-menu .h5,
	.menu-wrapper nav > ul.menu ul.sub-menu .h6,
	h1.wpb_heading,
	h2.wpb_heading,
	h3.wpb_heading,
	h4.wpb_heading,
	h5.wpb_heading,
	h6.wpb_heading{
		color:<?php echo esc_html($ts_sub_menu_heading_color) ?>;
	}

	/* Menu sub text */
	.menu-wrapper nav > ul.menu ul.sub-menu > li > a,
	.menu-wrapper nav div.list-link li > a,
	.menu-wrapper nav > ul.menu li.widget_nav_menu li > a{
		color:<?php echo esc_html($ts_sub_menu_text_color) ?>;
	}
	.ts-menu > nav.pc-menu > ul.menu ul li >.ts-menu-drop-icon{
		color:<?php echo esc_html($ts_sub_menu_text_color) ?>;
	}
	/* Menu sub a hover */
	.ts-menu > nav.pc-menu > ul.menu ul li:hover >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current_page_item >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current-menu-item >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current_page_parent >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current-menu-parent >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current-menu-ancestor >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current-product_cat-ancestor >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu ul li:hover >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu li.current_page_item >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu li.current-menu-item >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu li.current_page_parent >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu li.current-menu-parent >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu li.current-menu-ancestor >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu ul li.current-product_cat-ancestor >.ts-menu-drop-icon,
	.menu-wrapper nav > ul.menu ul.sub-menu > li > a:hover,
	.menu-wrapper nav div.list-link li > a:hover,
	.menu-wrapper nav > ul.menu li.widget_nav_menu li > a:hover,
	.menu-wrapper nav > ul.menu li.widget_nav_menu li.current-menu-item > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current-menu-item > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current_page_parent > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current-menu-parent > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current_page_item > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current-menu-ancestor > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current-product_cat-ancestor > a{
		color:<?php echo esc_html($ts_sub_menu_text_color_hover) ?>;
	}

	/* ============= 5. FOOTER COLORS ============== */

	/* Social */
	.ts-social-icons li a,
	footer#colophon .ts-social-icons a{
		border-color:<?php echo esc_html($ts_footer_social_icon_border_color) ?>;
		color:<?php echo esc_html($ts_footer_social_icon_color) ?>;
	}
	footer .ts-social-icons li a:before{
		border-color:<?php echo esc_html($ts_footer_social_icon_border_color) ?>;
	}
	ul.info-content li:after,
	footer .box-office-address:after,
	footer .box-phone-numbers:after,
	footer .box-email-address:after,
	footer .box-fax-numbers:after{
		border-color:<?php echo esc_html($ts_footer_social_icon_border_color) ?>;
	}
	.ts-social-icons .style-fill-bg li a,
	footer#colophon .ts-social-icons .style-fill-bg li a{
		background:<?php echo esc_html($ts_footer_social_background_color) ?>;
		color:<?php echo esc_html($ts_footer_social_icon_color) ?>;
	}
	footer .end-footer{
		background-color:<?php echo esc_html($ts_footer_end_background_color) ?>;
	}
	footer .footer-container{
		background-color:<?php echo esc_html($ts_footer_background_color) ?>;
	}
	footer .widget_calendar caption{
		color:<?php echo esc_html($ts_footer_background_color) ?>;
	}
	footer#colophon,
	footer#colophon a,
	footer#colophon dt,
	footer .mc4wp-form-fields label{
		color:<?php echo esc_html($ts_footer_text_color) ?>;
	}
	footer#colophon h1,
	footer#colophon h2,
	footer#colophon h3,
	footer#colophon h4,
	footer#colophon h5,
	footer#colophon h6,
	footer#colophon .h1,
	footer#colophon .h2,
	footer#colophon .h3,
	footer#colophon .h4,
	footer#colophon .h5,
	footer#colophon .h6,
	footer#colophon h1.wpb_heading,
	footer#colophon h2.wpb_heading,
	footer#colophon h3.wpb_heading,
	footer#colophon h4.wpb_heading,
	footer#colophon h5.wpb_heading,
	footer#colophon h6.wpb_heading{
		color:<?php echo esc_html($ts_footer_heading_color) ?>;
	}
	.box-office-address,
	.box-phone-numbers,
	.box-email-address,
	.box-fax-numbers,
	footer .ts-social-icons .social-icons.style-vertical .ts-tooltip,
	footer .mc4wp-form-fields h2.title,
	footer#colophon a:hover,
	footer#colophon .wp-caption p.wp-caption-text,
	footer#colophon .woocommerce ul.cart_list li span.amount, 
	footer#colophon .woocommerce ul.product_list_widget li span.amount, 
	footer#colophon .ts-blogs-widget-wrapper ul li a,
	footer#colophon .ts-recent-comments-widget-wrapper ul li a,
	.info-company li,
	footer .widget_product_tag_cloud .tagcloud a:hover,
	footer .widget_tag_cloud .tagcloud a:hover{
		color:<?php echo esc_html($ts_footer_text_color_hover) ?>;
	}
	footer .ts-social-icons .social-icons.style-vertical li a i:after{
		border-color:<?php echo esc_html($ts_footer_heading_color) ?>;
	}
	footer .widget_calendar caption{
		background:<?php echo esc_html($ts_footer_heading_color) ?>;
	}
	footer#colophon .end-footer,
	footer#colophon .end-footer a,
	footer#colophon .end-footer dt{
		color:<?php echo esc_html($ts_footer_end_text_color) ?>;
	}

	/* ============= 6. PRODUCT COLORS ============== */
	
	.ts-product-deals-slider-wrapper .counter-wrapper > div,
	.counter-wrapper > div{
		background-color:<?php echo esc_html($ts_product_hotdeal_background_color) ?>;
		border-color:<?php echo esc_html($ts_product_hotdeal_border_color) ?>;
		color:<?php echo esc_html($ts_product_hotdeal_text_color) ?>;
	}
	/* Rating Product */
	.ts-price-table .rating:before,
	.star-rating:before, 
	.pp_woocommerce .star-rating:before, 
	.woocommerce .star-rating:before, 
	.testimonial-content .rating:before{
		color:<?php echo esc_html($ts_rating_color) ?>;
	}
	.ts-price-table .rating span:before,
	.star-rating span:before,
	.pp_woocommerce .star-rating span:before, 
	.woocommerce .star-rating span:before, 
	.testimonial-content .rating span:before{
		color:<?php echo esc_html($ts_rating_color) ?>;
	}
	/* Name Product */
	#ts-search-result-container ul li a,
	#ts-search-result-container .view-all-wrapper a,
	.widget-container ul.product_list_widget li .ts-wg-meta > a,
	.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a,
	.widget.ts-products-widget .ts-wg-meta > a,
	.woocommerce .ts-recently-viewed-products-wrapper li .ts-wg-meta > a,
	.ts-header .header-top h3.product-name > a,
	h3.product-name > a,
	h3.product-name,
	.product-name a,
	.woocommerce #order_review table.shop_table tbody td.product-name, 
	.woocommerce #order_review table.shop_table tfoot td.product-name,
	.single-navigation .product-info,
	.group_table a,
	body table.compare-list tr.title td{
		color:<?php echo esc_html($ts_product_name_text_color) ?>;
	}
	/* Button Product */
	.woocommerce .product .thumbnail-wrapper .product-group-button > div a,
	.meta-wrapper div.wishlist a,
	.meta-wrapper div.compare a,
	.woocommerce .product .meta-wrapper a.added_to_cart,
	.woocommerce .product .meta-wrapper a.button,
	.woocommerce .product .meta-wrapper .wishlist a{
		background-color:<?php echo esc_html($ts_product_button_background_color) ?>;
		border-color:<?php echo esc_html($ts_product_button_border_color) ?>;
		color:<?php echo esc_html($ts_product_button_text_color) ?>;
	}
	body table.compare-list .add-to-cart td a:hover,
	.woocommerce .product .thumbnail-wrapper .loop-add-to-cart a.button:hover,
	.woocommerce .product .thumbnail-wrapper .button-in:hover a,
	.button-in a:hover,
	.meta-wrapper .button-in.wishlist a:hover,
	.meta-wrapper .button-in.compare a:hover,
	.woocommerce .product .thumbnail-wrapper .product-group-button > div a:hover,
	.woocommerce .product .meta-wrapper a.added_to_cart:hover, 
	.woocommerce .product .meta-wrapper a.button:hover,
	.woocommerce .product .meta-wrapper a.added_to_cart:focus, 
	.woocommerce .product .meta-wrapper a.button:focus,
	.woocommerce .product .meta-wrapper .wishlist a:hover,
	.woocommerce .product .meta-wrapper .wishlist a:focus,
	.meta-wrapper div.wishlist a:hover,
	.meta-wrapper div.compare a:hover,
	.single-portfolio .ic-like:hover,
	.product-group-button .button-tooltip,
	.quickshop .button-tooltip,
	.wishlist .button-tooltip,
	.compare .button-tooltip{
		background-color:<?php echo esc_html($ts_product_button_background_color_hover) ?>;
		border-color:<?php echo esc_html($ts_product_button_border_color_hover) ?>;
		color:<?php echo esc_html($ts_product_button_text_color_hover) ?>;
	}
	.quickshop .button-tooltip:after, 
	.wishlist .button-tooltip:after, 
	.compare .button-tooltip:after{
		color:<?php echo esc_html($ts_product_button_background_color_hover) ?>;
	}
	body .product-group-button .button-tooltip:after{
		border-left-color:<?php echo esc_html($ts_product_button_background_color_hover) ?>;
	}
	body .product-group-button .button-tooltip:after{
		border-right-color:<?php echo esc_html($ts_product_button_background_color_hover) ?>;
	}

	/* Label Product */
	.woocommerce .product .product-label .onsale,
	.pp_woocommerce div.product .images .product-label span.onsale{
		color:<?php echo esc_html($ts_product_sale_label_text_color) ?>;
		background:<?php echo esc_html($ts_product_sale_label_background_color) ?>;
	}
	.woocommerce .product .product-label .onsale.amount,
	.pp_woocommerce div.product .images .product-label span.onsale.amount{
		color:<?php echo esc_html($ts_product_sale_label_text_color) ?>;
	}
	.woocommerce .product .product-label .onsale:before,
	.pp_woocommerce div.product .images .product-label .onsale:before{
		border-top-color:<?php echo esc_html($ts_product_sale_label_background_color) ?>;
	}
	.woocommerce .product .product-label .onsale:after,
	.pp_woocommerce div.product .images .product-label .onsale:after{
		border-bottom-color:<?php echo esc_html($ts_product_sale_label_background_color) ?>;
	}
	.woocommerce .product .product-label .new,
	.pp_woocommerce div.product .images .product-label span.new{
		color:<?php echo esc_html($ts_product_new_label_text_color) ?>;
		background:<?php echo esc_html($ts_product_new_label_background_color) ?>;
	}
	.woocommerce .product .product-label .new:before,
	.pp_woocommerce div.product .images .product-label .new:before{
		border-top-color:<?php echo esc_html($ts_product_new_label_background_color) ?>;
	}
	.woocommerce .product .product-label .new:after,
	.pp_woocommerce div.product .images .product-label .new:after{
		border-bottom-color:<?php echo esc_html($ts_product_new_label_background_color) ?>;
	}
	.woocommerce .product .product-label .featured,
	.pp_woocommerce div.product .images .product-label span.featured{
		color:<?php echo esc_html($ts_product_feature_label_text_color) ?>;
		background:<?php echo esc_html($ts_product_feature_label_background_color) ?>;
	}
	.woocommerce .product .product-label .featured:before,
	.pp_woocommerce div.product .images .product-label .featured:before{
		border-top-color:<?php echo esc_html($ts_product_feature_label_background_color) ?>;
	}
	.woocommerce .product .product-label .featured:after,
	.pp_woocommerce div.product .images .product-label .featured:after{
		border-bottom-color:<?php echo esc_html($ts_product_feature_label_background_color) ?>;
	}
	.woocommerce .product .product-label .out-of-stock,
	.pp_woocommerce div.product .images .product-label span.out-of-stock{
		color:<?php echo esc_html($ts_product_outstock_label_text_color) ?>;
		background:<?php echo esc_html($ts_product_outstock_label_background_color) ?>;
	}
	.woocommerce .product .product-label .out-of-stock:before,
	.pp_woocommerce div.product .images .product-label .out-of-stock:before{
		border-top-color:#<?php echo esc_html($ts_product_outstock_label_background_color) ?>;
	}
	.woocommerce .product .product-label .out-of-stock:after,
	.pp_woocommerce div.product .images .product-label .out-of-stock:after{
		border-bottom-color:<?php echo esc_html($ts_product_outstock_label_background_color) ?>;
	}
	/* Amount Product */
	.amount,
	.woocommerce .products .product .price,
	.woocommerce .products .product .amount,
	.woocommerce div.product p.price, 
	.woocommerce div.product span.price, 
	.single-navigation .product-info .price,
	/* Compare table */
	body table.compare-list tr.price td{
		color:<?php echo esc_html($ts_product_price_color) ?>;
	}
	del .amount,
	.woocommerce .products .product del .amount{
		color:<?php echo esc_html($ts_product_sale_del_price_color) ?>;
	}
	ins .amount,
	.woocommerce .products .product ins .amount{
		color:<?php echo esc_html($ts_product_sale_price_color) ?>;
	}
	/* Has Responsive */
	@media only screen and (max-width: 767px){
		.ic-mobile-menu-button,
		.ts-group-meta-icon-toggle,
		.ts-header .header-template .shopping-cart-wrapper.cart-mobile a{
			color:<?php echo esc_html($ts_top_header_text_color) ?>;
		}
		.ic-mobile-menu-button:hover,
		.ts-group-meta-icon-toggle:hover,
		.header-template .shopping-cart-wrapper a.cart-control .amount{
			color:<?php echo esc_html($ts_primary_color) ?>;
		}
	}
	@media 
	only screen and (max-width: 991px)	and (min-width: 768px){
		.header-v2 .header-right .shopping-cart-wrapper a.cart-control .amount, 
		.header-v5 .header-right .shopping-cart-wrapper a.cart-control .amount{
			color:<?php echo esc_html($ts_primary_color) ?>;
		}
	}
	
	
	/* ============= 7. CUSTOM FONT SIZE ============== */
	/* FONT WEIGHT */
	/* Font weight heading */
	h1,h2,h3,h4,h5,h6 ,
	.h1,.h2,.h3,.h4,.h5,.h6,
	.ts-feature-wrapper .feature-header h3 > a,
	.widget.ts-products-widget > .widgettitle,
	.ts-banner header .discount,
	.widget-title,
	body > h1{
		font-weight:<?php echo esc_html($ts_heading_font_weight) ?>;
	}

	/* Font weight body */
	h4.heading-title > a,
	h3.product-name > a,
	h3.product-name,
	body h3.entry-title > a,
	.header-template .menu-wrapper .vertical-menu > ul.menu > li > a,
	.woocommerce .pp_woocommerce div.product .product_title,
	.pp_woocommerce div.product .product_title,
	.woocommerce div.product .product_title,
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	.pp_woocommerce table .quantity .minus, 
	.pp_woocommerce table .quantity .plus,
	.woocommerce table .quantity .minus, 
	.woocommerce table .quantity .plus,
	.woocommerce #order_review table.shop_table tfoot td,
	.woocommerce table.shop_table.order_details tfoot th,
	.woocommerce #order_review table.shop_table tfoot th,
	body table.compare-list td,
	.woocommerce table.shop_attributes td,
	.woocommerce table.shop_attributes th, 
	.woocommerce table.shop_attributes .alt td, 
	.woocommerce table.shop_attributes .alt th,
	.ts-product-attribute > div a,
	.pp_woocommerce div.product form.cart .variations label, 
	.woocommerce div.product form.cart .variations label,
	div.product .summary .yith-wcwl-add-to-wishlist a,
	div.product .summary .wishlist a,
	section.product .yith-wcwl-wishlistexistsbrowse.show i,
	section.product .yith-wcwl-wishlistaddedbrowse.show i,
	.product-group-button .button-tooltip,
	section.widget_display_stats > dl dt,
	.comment_list_widget .comment-body,
	.widget_calendar th, 
	.widget_calendar td,
	.woocommerce.widget_recent_reviews ul.product_list_widget li a,
	.widget.ts-products-widget .ts-wg-meta > a,
	.woocommerce .ts-recently-viewed-products-wrapper li .ts-wg-meta > a,
	.widget-container ul.product_list_widget li .ts-wg-meta > a,
	.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a,
	.woocommerce ul.cart_list li a, 
	.woocommerce ul.product_list_widget li a,
	.woocommerce .widget-container .price_slider_amount .price_label span,
	.widget-container .tagcloud a,
	.dokan-category-menu .sub-block h3,
	.woocommerce a.button.added:before, 
	.woocommerce button.button.added:before, 
	.woocommerce input.button.added:before, 
	.woocommerce #respond input#submit.added:before, 
	.woocommerce #respond input#submit.added:before, 
	.woocommerce .meta-wrapper .loop-add-to-cart a:first-child:before,
	body .style-3 .mailchimp-subscription button.button,
	.woocommerce .ts-product-category-slider-wrapper .product.product-category h3,
	.ts-banner header div{
		font-weight:<?php echo esc_html($ts_body_font_weight) ?>;
	}
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	.ts-banner header .discount,
	.wp-caption p.wp-caption-text,
	.product-subtotal .amount,
	body div.ppt,
	.woocommerce #reviews #reply-title,  
	.widget_shopping_cart_content p.total strong,
	.row-heading-tabs .heading-tab .heading-title,
	body table.compare-list th,
	.wp-caption p.wp-caption-text,
	body div.ppt,
	a.button, 
	button, 
	input[type^="submit"], 
	.shopping-cart p.buttons a, 
	.woocommerce #content input.button, 
	.woocommerce #respond input#submit, 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button, 
	.woocommerce-page #content input.button, 
	.woocommerce-page #respond input#submit, 
	.woocommerce-page a.button, 
	.woocommerce-page button.button, 
	.woocommerce-page input.button, 
	.woocommerce #content input.button.alt, 
	.woocommerce #respond input#submit.alt, 
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt, 
	.woocommerce-page #content input.button.alt, 
	.woocommerce-page #respond input#submit.alt, 
	.woocommerce-page a.button.alt, 
	.woocommerce-page button.button.alt, 
	.woocommerce-page input.button.alt, 
	#content button.button, 
	.woocommerce .widget_price_filter .price_slider_amount .button, 
	.woocommerce-page .widget_price_filter .price_slider_amount .button, 
	body .single-post .single-navigation > a,
	.woocommerce div.product .images .product-label span,
	.pp_woocommerce div.product .images .product-label span,
	.woocommerce .products .product .product-label .onsale,
	.woocommerce .products .product .product-label .new,
	.woocommerce .products .product .product-label .featured,
	.woocommerce .products .product .product-label .out-of-stock,
	.bbp-meta .bbp-topic-permalink,
	.bbp-topic-title-meta a,
	#bbpress-forums div.bbp-topic-author a.bbp-author-name, 
	#bbpress-forums div.bbp-reply-author a.bbp-author-name,
	#bbpress-forums .bbp-header div.bbp-topic-content a, 
	#bbpress-forums .bbp-header div.bbp-reply-content a,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
	#bbpress-forums fieldset.bbp-form legend,
	#bbpress-forums .status-category > li.bbp-forum-info > .bbp-forum-title,
	#bbpress-forums #bbp-user-navigation ,
	#bbpress-forums .type-forum .bbp-forum-title,
	.type-topic .bbp-topic-title > a,
	#favorite-toggle a, 
	#subscription-toggle a,
	#bbpress-forums ul.bbp-lead-topic .bbp-header, 
	#bbpress-forums ul.bbp-topics .bbp-header, 
	#bbpress-forums ul.bbp-forums .bbp-header, 
	#bbpress-forums ul.bbp-replies > .bbp-header, 
	#bbpress-forums ul.bbp-search-results .bbp-header,
	.list-posts article:not(.format-quote) .entry-meta .date-time > span:first-child,
	article.single .entry-meta .date-time > span:first-child,
	.ts-blogs article:not(.quote) .entry-meta .date-time > span:first-child,
	article.single .ts-social-sharing .sharing-title,
	.summary .ts-social-sharing .sharing-title,
	.images-thumbnails .ts-social-sharing .sharing-title,
	.entry-author .author-info .author,
	.comments-area .comment-meta > span.author a,
	.avatar-name a,
	.comments-area .reply a,
	.portfolio-info p,
	.woocommerce > form > fieldset legend,
	.cloud-zoom-title,
	.woocommerce table.shop_table th,
	.woocommerce-cart .cart-collaterals .cart_totals .order-total th,
	.woocommerce-cart .cart-collaterals .cart_totals table td:before,
	.woocommerce-cart .cart-collaterals .cart_totals table,
	.woocommerce-cart .cart-collaterals .cart_totals table th,
	.woocommerce-cart .cart-collaterals .cart_totals table td,
	.shopping-cart-wrapper .total > span.total-title,
	.widget_shopping_cart .total-title,
	body table.compare-list .add-to-cart td a,
	body table.compare-list tr.price th, 
	body table.compare-list tr.price td,
	.wishlist_table tr td.product-stock-status span.wishlist-in-stock,
	.ts-products-tabs-widget .vc_tta-accordion .vc_tta-panels > div .vc_tta-panel-heading a:before,
	.widget_calendar #today,
	.widget_calendar caption,
	body .product-edit-new-container .dokan-btn-lg,
	#ts-search-result-container .view-all-wrapper,
	#ts-search-result-container li a span.hightlight,
	.cart_list span.quantity,
	.ts-product-in-category-tab-wrapper .see-more-button:hover,
	.ts-countdown.style-border .counter-wrapper > div .ref-wrapper,
	.ts-milestone .number,
	.ts-price-table .desc-price,
	.ts-price-table .table-title,
	.ts-price-table .table-price span,
	.vc_pie_chart .vc_pie_chart_value,
	.vc_progress_bar .vc_single_bar .vc_label,
	.ts-button.fa,
	.ts-button,
	.vc_column_container .vc_btn, 
	.vc_column_container .wpb_button,
	.counter-wrapper .number,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab a, 
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab a,
	.ts-product-in-category-tab-2-wrapper.horizontal-tab .column-tabs ul li{
		font-weight:<?php echo esc_html($ts_body_font_weight) + 100 ?>;
	}

	.woocommerce div.product .woocommerce-tabs ul.tabs li > a,
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	.woocommerce-cart .cart-collaterals .cart_totals table td:before,
	body .yith-woocompare-widget ul.products-list a.remove,
	.cart_list li .cart-item-wrapper a.remove,
	.woocommerce .widget_shopping_cart .cart_list li a.remove,
	.ts-milestone h3.subject,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_toggle_title h4{
		font-weight:<?php echo esc_html($ts_body_font_weight) ?> !important;
	}

	/* Font weight menu */
	.menu-wrapper nav > ul.menu > li > a,
	.menu-wrapper nav > ul.menu li:before,
	.menu-wrapper .vertical-menu ul.menu > li > a,
	.vertical-menu-wrapper .vertical-menu-heading,
	.nav > ul.menu > ul > li > a{
		font-weight:<?php echo esc_html($ts_menu_font_weight) ?>;
	}

	/* FONT SIZE */
	
	html, 
	body,
	.woocommerce div.product p.price, 
	.woocommerce div.product span.price,
	.mc4wp-form-fields label,
	ul li .ts-megamenu-container,
	.comment-text,
	.shopping-cart-wrapper .ts-tiny-cart-wrapper,
	.woocommerce .order_details li,  
	.woocommerce table.my_account_orders td, 
	.comment_list_widget .comment-body,
	#bbpress-forums,
	.woocommerce ul.products li.product .price del,
	.woocommerce ul.products li.product .price,
	.shopping-cart-wrapper .form-content > label,
	.widget_calendar th, 
	.widget_calendar td,
	.woocommerce .widget-container .price_slider_amount .price_label,
	#ts-search-result-container ul li a,
	#ts-search-result-container .view-all-wrapper a,
	#lang_sel_click > ul li a,
	body .wpml-ls-legacy-dropdown .wpml-ls-sub-menu a,
	body .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu a,
	.header-currency ul li a:not(.button),
	select option,
	.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
	.yith-wcwl-share h4.yith-wcwl-share-title,
	.woocommerce-cart .cart-collaterals .cart_totals table td, 
	.woocommerce-cart .cart-collaterals .cart_totals table th,
	.woocommerce table.wishlist_table,
	body table.compare-list tr.image td, 
	body table.compare-list tr.price td,
	h3 > label,
	body.wpb-js-composer .vc_tta.vc_general,
	.dokan-category-menu .sub-block h3,
	.woocommerce table.shop_table.my_account_orders,
	.feature-content .feature-excerpt,
	.woocommerce div.product .woocommerce-tabs .panel,
	.woocommerce .products.list .product .short-description,
	/* Forum */
	#bbpress-forums div.bbp-forum-title h3, 
	#bbpress-forums div.bbp-topic-title h3, 
	#bbpress-forums div.bbp-reply-title h3,
	/* COMPARE TABLE */
	body table.compare-list,
	body table.compare-list tr.title td
	{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
		line-height:<?php echo esc_html($ts_line_height_body) ?>px;
	}
	.ts-blogs .entry-meta > span.author a,
	.list-posts article .entry-meta > span.author a,
	article.single .entry-meta > span.author a{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
	}
	.ts-shortcode{
		line-height:<?php echo esc_html($ts_line_height_body) ?>px;
	}
	.list-posts article.format-quote blockquote{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
		line-height:<?php echo esc_html($ts_line_height_body) + 4 ?>px;
	}
	.woocommerce .products .product .short-description,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	.woocommerce form .form-row input.input-text, 
	.woocommerce form .form-row textarea,
	.dokan-form-control,
	.feature-content .feature-header,
	.font-normal .description,
	.single-navigation .product-info > div > span:first-child,
	input, 
	textarea, 
	keygen, 
	#add_payment_method table.cart td.actions .coupon .input-text, 
	.woocommerce-cart table.cart td.actions .coupon .input-text, 
	.woocommerce-checkout table.cart td.actions .coupon .input-text, 
	h3.product-name > a, 
	h3.product-name,
	.widget.ts-products-widget .ts-wg-meta > a,
	.woocommerce .ts-recently-viewed-products-wrapper li .ts-wg-meta > a,
	.widget-container ul.product_list_widget li .ts-wg-meta > a,
	.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a,
	.woocommerce ul.cart_list li a, 
	.woocommerce ul.product_list_widget li a,
	body .style-3 .mailchimp-subscription.text-light button.button{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
		line-height:18px;
	}
	body .select2-container--default .select2-selection--single .select2-selection__rendered,
	select{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
	}
	.widget_product_tag_cloud .tagcloud a,
	.widget_tag_cloud .tagcloud a{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
		line-height:18px !important;
	}
	.ts-portfolio-wrapper .filter-bar li,
	.pp_woocommerce table .quantity input.qty, 
	.woocommerce table .quantity input.qty{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
	}
	h4 > a,
	.amount,
	.portfolio-inner h3,
	.cats-portfolio,
	.woocommerce-account .addresses h3,
	.woocommerce-account .addresses h2,
	.woocommerce-customer-details .addresses h2,
	.woocommerce .ts-product-category-slider-wrapper .product.product-category h3,
	.woocommerce .products .product.product-category h3,
	.woocommerce .checkout #order_review table thead th,
	.mailchimp-subscription .newsletter,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab a, 
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab a,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title a,
	.vc_toggle_default .vc_toggle_title h4,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	.column-tabs .tabs li,
	.font-big .description,
	.list-cats li a,
	.list .product h3.product-name > a,
	.vc_progress_bar .vc_single_bar .vc_label,
	.ts-team-member header > h3,
	.ts-team-member header > h3 a,
	.woocommerce-column > h3,
	.mc4wp-form-fields .mailchimp-input input[type="email"]{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
		line-height:20px;
	}
	h1,
	.h1,
	.ts-heading h1
	{
		font-size:<?php echo esc_html($ts_font_size_heading_1) ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_1) ?>px;
	}
	h2,
	.h2,
	h1.wpb_heading,
	.ts-heading h2,
	.breadcrumb-title-wrapper .breadcrumb-title h1,
	div.product p.price .woocommerce-Price-amount, 
	div.product .single_variation .amount, 
	.woocommerce div.product .single_variation .amount
	{
		font-size:<?php echo esc_html($ts_font_size_heading_2) ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_2) ?>px;
	}
	h3,
	.h3,
	h2.wpb_heading,
	.theme-title > h3,
	.ts-heading h3,
	.ts-mailchimp-subscription-shortcode .widgettitle,
	.woocommerce .cross-sells > h2,
	.woocommerce .upsells > h2,
	.woocommerce .related > h2,
	body .ts-footer-block .ts-mailchimp-subscription-shortcode.style-1 .widget .widgettitle,
	.woocommerce div.wishlist-title h2,
	.heading-wrapper > h2,
	.ts-product-in-category-tab-2-wrapper .column-tabs .heading-tab h3,
	.ts-product-in-category-tab-2-wrapper.horizontal-tab .column-tabs .heading-tab h3
	{
		font-size:<?php echo esc_html($ts_font_size_heading_3) ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_3) ?>px;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li > a,
	.ts-feature-wrapper .feature-header h3 > a,
	.ts-banner header .discount,
	.ts-list-of-product-categories-wrapper .heading-title,
	.wp-caption p.wp-caption-text,
	.product-subtotal .amount,
	.woocommerce-account div.woocommerce > h2,
	.cart-collaterals .cart_totals > h2,
	.heading-shortcode > h3,
	.related > h2,
	body > h1,
	body div.ppt,
	.entry-content h1.blog-title,
	.widget.ts-products-widget > .widgettitle,
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	.woocommerce #reviews #reply-title, 
	.woocommerce #reviews #comments > h2, 
	.widget_shopping_cart_content p.total strong,
	.widget-title,
	.row-heading-tabs .heading-tab .heading-title,
	#order_review_heading,
	h3.wpb_heading,
	.style-normal .mailchimp-subscription h2,
	.mc4wp-form-fields > h2.title,
	body table.compare-list th{
		font-size:<?php echo esc_html($ts_font_size_heading_6) ?>px;
	}
	h4,
	.h4,
	.ts-heading h4,
	h3.entry-title > a,
	#bbpress-forums #bbp-user-wrapper h2.entry-title,
	.woocommerce-billing-fields > h3,
	.widget.ts-products-widget > .widgettitle,
	.breadcrumb-title-wrapper.breadcrumb-v2 .breadcrumb-title > h1,
	.ts-recently-viewed-products-wrapper .shortcode-heading-wrapper .heading-title,
	.title-background-color .shortcode-heading-wrapper .heading-title,
	.mailchimp-subscription .widget-title-wrapper h3,
	.mc4wp-form-fields .mailchimp-wrapper h2.title,
	.woocommerce-MyAccount-content > h2,
	.woocommerce-customer-details > h2,
	.woocommerce-order-details > h2,
	.single-portfolio .info-content .entry-title,
	.pp_woocommerce div.product .product_title, 
	.woocommerce div.product .product_title,
	.horizontal-tab .column-tabs .heading-tab h3,
	.horizontal-tab .column-tabs .heading-tab i,
	#customer_login .col-1 > h2,
	#customer_login .col-2 > h2,
	.banner-content h4{
		font-size:<?php echo esc_html($ts_font_size_heading_4) ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_4) ?>px;
	}
	h5,
	.h5,
	h4.wpb_heading,
	h5.wpb_heading,
	body .ts-footer-block .widget .widgettitle,
	body .ts-footer-block .widget-title,
	.column-tabs .heading-tab h3,
	.breadcrumb-title-wrapper.breadcrumb-v2 .breadcrumbs-container,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-style-2 .vc_tta-tab > a,
	.ts-products-widget-shortcode:not(.title-background-color ) .widgettitle{
		font-size:<?php echo esc_html($ts_font_size_heading_5) ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_5) ?>px;
	}
	h6,.h6,
	.vc_message_box .h4,
	h6.wpb_heading,
	.woocommerce table.shop_table thead th,
	.breadcrumb-title-wrapper .breadcrumbs-container,
	.member-name h3,
	.ts-milestone h3.subject,
	.ts-testimonial-wrapper.text-light .testimonial-content h4 > a,
	.ts-twitter-slider.text-light .twitter-content h4 > a,
	.horizontal-tab.horizontal-style-2 .column-tabs .tabs li{
		font-size:<?php echo esc_html($ts_font_size_heading_6) ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_6) ?>px;
	}
	/*----------------------------------------------------------------*/
	/*- HEADER -------------------------------------------------------*/
	.info-desc,
	.my-account-wrapper .account-control > a,
	.my-wishlist-wrapper a,
	#lang_sel_click > ul > li > a,
	.header-currency .wcml_currency_switcher > a,
	.group-meta-header .shopping-cart-wrapper a.cart-control span.amount{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
		line-height:<?php echo esc_html($ts_line_height_body) ?>px;
	}
	.my-account-wrapper .dropdown-container{
		line-height:<?php echo esc_html($ts_line_height_body) ?>px;
	}

	/*----------------------------------------------------------------*/
	/*- MENU ---------------------------------------------------------*/
	.menu-wrapper nav > ul.menu > li > a,
	.menu-wrapper nav > ul.menu li:before,
	.vertical-menu-wrapper .vertical-menu-heading,
	.widget-container.ts-menus-widget .widget-title,
	header .vertical-menu-wrapper .vertical-menu-heading:before,
	.widget-container.ts-menus-widget .widget-title:before{
		font-size:<?php echo esc_html($ts_font_size_menu) ?>px;
		line-height:<?php echo esc_html($ts_line_height_menu) ?>px;
	}
	.header-template .menu-wrapper .vertical-menu > ul.menu > li > a{
		font-size:<?php echo esc_html($ts_font_size_body) + 1 ?>px;
	}
	/* WIDGET CUSTOM MENU FOR MEGAMENU */
	.menu-wrapper nav li.widget > .widgettitle,
	.menu-wrapper nav div.list-link > .widgettitle{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
	}
	/*----------------------------------------------------------------*/
	/*- PRODUCT ------------------------------------------------------*/
	.total .total-title,
	.total .amount,
	.product .amount,
	.woocommerce .menu ul.product_list_widget li span.amount,
	.menu .woocommerce ul.product_list_widget li span.amount,
	.woocommerce ul.product_list_widget li ins .amount,
	.woocommerce ul.product_list_widget li .price > .amount{
		font-size:<?php echo esc_html($ts_font_size_body) + 4 ?>px;
	}
	.woocommerce .products .product .product-label .onsale,
	.woocommerce .products .product .product-label .new,
	.woocommerce .products .product .product-label .featured,
	.woocommerce .products .product .product-label .out-of-stock{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
	}
	.woocommerce div.product .images .product-label span,
	.pp_woocommerce div.product .images .product-label span{
		font-size:<?php echo esc_html($ts_font_size_body) + 4 ?>px;
	}
	.woocommerce a.button.added:before, 
	.woocommerce button.button.added:before, 
	.woocommerce input.button.added:before, 
	.woocommerce #respond input#submit.added:before, 
	.woocommerce #respond input#submit.added:before, 
	.woocommerce .meta-wrapper .loop-add-to-cart a:first-child:before,
	a.view-more,
	a.ts-button,
	a.button,
	button,
	.meta-wrapper div.compare a i,
	.meta-wrapper div.compare a:before,
	body .single-post .single-navigation > a,
	html body.woocommerce table.compare-list tr.add-to-cart td a:before,
	html body table.compare-list tr.add-to-cart td a:before,
	input[type="submit"], 
	.shopping-cart p.buttons a, 
	.woocommerce #respond input#submit, 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button, 
	.woocommerce #respond input#submit.alt, 
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt, 
	.woocommerce table.shop_table input, 
	body .product-edit-new-container .dokan-btn-lg,
	.button-banner,
	.woocommerce .product .meta-wrapper .has-wishlist.has-compare.has-add-to-cart a.added_to_cart:before,
	.woocommerce .product .meta-wrapper .has-wishlist.has-compare.has-add-to-cart a.button:before, 
	/* Forum */
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
	/* Compare */
	body table.compare-list .add-to-cart td a,
	/* Dokan */
	input[type="submit"].dokan-btn, 
	a.dokan-btn, 
	.dokan-btn{
		font-size:<?php echo esc_html($ts_font_size_button)?>px;
		line-height:<?php echo esc_html($ts_line_height_button)?>px;
	}
	
	/* ============= 8. RESPONSIVE ============== */
	
	<?php if( isset($data['ts_responsive']) && $data['ts_responsive'] == 0 ): ?>
		/* NO RESPONSIVE */
		.ts-col-1, .ts-col-2, .ts-col-3, .ts-col-4, .ts-col-5, .ts-col-6, .ts-col-7, .ts-col-8, .ts-col-9, .ts-col-10, .ts-col-11, .ts-col-12, .ts-col-1, .ts-col-2, .ts-col-3, .ts-col-4, .ts-col-5, .ts-col-6, .ts-col-7, .ts-col-8, .ts-col-9, .ts-col-10, .ts-col-11, .ts-col-12, .ts-col-13, .ts-col-14, .ts-col-15, .ts-col-16, .ts-col-17, .ts-col-18, .ts-col-19, .ts-col-20, .ts-col-21, .ts-col-22, .ts-col-23, .ts-col-24 {
			float: left;
		}
		.ts-col-24 {
			width: 100%;
		}
		.ts-col-23 {
			width: 95.83333333%;
		}
		.ts-col-22 {
			width: 91.66666667%;
		}
		.ts-col-21 {
			width: 87.5%;
		}
		.ts-col-20 {
			width: 83.33333333%;
		}
		.ts-col-19 {
			width: 79.16666667%;
		}
		.ts-col-18 {
			width: 75%;
		}
		.ts-col-17 {
			width: 70.83333333%;
		}
		.ts-col-16 {
			width: 66.66666667%;
		}
		.ts-col-15 {
			width: 62.5%;
		}
		.ts-col-14 {
			width: 58.33333333%;
		}
		.ts-col-13 {
			width: 54.16666667%;
		}
		.ts-col-12 {
			width: 50%;
		}
		.ts-col-11 {
			width: 45.83333333%;
		}
		.ts-col-10 {
			width: 41.66666667%;
		}
		.ts-col-9 {
			width: 37.5%;
		}
		.ts-col-8 {
			width: 33.33333333%;
		}
		.ts-col-7 {
			width: 29.16666667%;
		}
		.ts-col-6 {
			width: 25%;
		}
		.ts-col-5 {
			width: 20.83333333%;
		}
		.ts-col-4 {
			width: 16.66666667%;
		}
		.ts-col-3 {
			width: 12.5%;
		}
		.ts-col-2 {
			width: 8.33333333%;
		}
		.ts-col-1 {
			width: 4.16666667%;
		}
		/* Overwrite visual */
		.vc_col-sm-1, .vc_col-sm-2, .vc_col-sm-3, .vc_col-sm-4, .vc_col-sm-5, .vc_col-sm-6, .vc_col-sm-7, .vc_col-sm-8, .vc_col-sm-9, .vc_col-sm-10, .vc_col-sm-11, .vc_col-sm-12 {
			float: left;
		}
		.vc_col-sm-12 {
			width: 100%;
		}
		.vc_col-sm-11 {
			width: 91.66666667%;
		}
		.vc_col-sm-10 {
			width: 83.33333333%;
		}
		.vc_col-sm-9 {
			width: 75%;
		}
		.vc_col-sm-8 {
			width: 66.66666667%;
		}
		.vc_col-sm-7 {
			width: 58.33333333%;
		}
		.vc_col-sm-6 {
			width: 50%;
		}
		.vc_col-sm-5 {
			width: 41.66666667%;
		}
		.vc_col-sm-4 {
			width: 33.33333333%;
		}
		.vc_col-sm-3 {
			width: 25%;
		}
		.vc_col-sm-2 {
			width: 16.66666667%;
		}
		.vc_col-sm-1 {
			width: 8.33333333%;
		}
		.vc_col-sm-pull-12 {
			right: 100%;
		}
		.vc_col-sm-pull-11 {
			right: 91.66666667%;
		}
		.vc_col-sm-pull-10 {
			right: 83.33333333%;
		}
		.vc_col-sm-pull-9 {
			right: 75%;
		}
		.vc_col-sm-pull-8 {
			right: 66.66666667%;
		}
		.vc_col-sm-pull-7 {
			right: 58.33333333%;
		}
		.vc_col-sm-pull-6 {
			right: 50%;
		}
		.vc_col-sm-pull-5 {
			right: 41.66666667%;
		}
		.vc_col-sm-pull-4 {
			right: 33.33333333%;
		}
		.vc_col-sm-pull-3 {
			right: 25%;
		}
		.vc_col-sm-pull-2 {
			right: 16.66666667%;
		}
		.vc_col-sm-pull-1 {
			right: 8.33333333%;
		}
		.vc_col-sm-pull-0 {
			right: auto;
		}
		.vc_col-sm-push-12 {
			left: 100%;
		}
		.vc_col-sm-push-11 {
			left: 91.66666667%;
		}
		.vc_col-sm-push-10 {
			left: 83.33333333%;
		}
		.vc_col-sm-push-9 {
			left: 75%;
		}
		.vc_col-sm-push-8 {
			left: 66.66666667%;
		}
		.vc_col-sm-push-7 {
			left: 58.33333333%;
		}
		.vc_col-sm-push-6 {
			left: 50%;
		}
		.vc_col-sm-push-5 {
			left: 41.66666667%;
		}
		.vc_col-sm-push-4 {
			left: 33.33333333%;
		}
		.vc_col-sm-push-3 {
			left: 25%;
		}
		.vc_col-sm-push-2 {
			left: 16.66666667%;
		}
		.vc_col-sm-push-1 {
			left: 8.33333333%;
		}
		.vc_col-sm-push-0 {
			left: auto;
		}
		.vc_col-sm-offset-12 {
			margin-left: 100%;
		}
		.vc_col-sm-offset-11 {
			margin-left: 91.66666667%;
		}
		.vc_col-sm-offset-10 {
			margin-left: 83.33333333%;
		}
		.vc_col-sm-offset-9 {
			margin-left: 75%;
		}
		.vc_col-sm-offset-8 {
			margin-left: 66.66666667%;
		}
		.vc_col-sm-offset-7 {
			margin-left: 58.33333333%;
		}
		.vc_col-sm-offset-6 {
			margin-left: 50%;
		}
		.vc_col-sm-offset-5 {
			margin-left: 41.66666667%;
		}
		.vc_col-sm-offset-4 {
			margin-left: 33.33333333%;
		}
		.vc_col-sm-offset-3 {
			margin-left: 25%;
		}
		.vc_col-sm-offset-2 {
			margin-left: 16.66666667%;
		}
		.vc_col-sm-offset-1 {
			margin-left: 8.33333333%;
		}
		.vc_col-sm-offset-0 {
			margin-left: 0%;
		}
		.ts-columns .one_half{
			width:50%;
		}
		.ts-columns .one_third{
			width:33.33333%;
			float:left;/* rtl */
		}
		.ts-columns .one_fourth{
			width:20%;
		}
	<?php endif; ?>
	<?php if( isset($data['ts_responsive']) && $data['ts_responsive'] == 1 ): ?>
		@media screen and (max-device-width: 767px) {
			body table.compare-list th, 
			body table.compare-list td, 
			body table.compare-list .price.repeated td, 
			body table.compare-list tr.image th, 
			body table.compare-list tr.image td, 
			body table.compare-list tr.price th, 
			body table.compare-list tr.price td, 
			body table.compare-list tr.add-to-cart th, 
			body table.compare-list tr.add-to-cart td{
				width:auto;
				padding:10px;
			}
			body table.compare-list tr.remove th, 
			body table.compare-list tr.remove td, 
			body table.compare-list tr.image th, 
			body table.compare-list tr.image td, 
			body table.compare-list tr.title th, 
			body table.compare-list tr.title td, 
			body table.compare-list tr.price th, 
			body table.compare-list tr.price td{
				padding:10px;
			}
			body > h1{
				padding:10px;
			}
			body table.compare-list th{
				display:none !important;
			}
			body table.compare-list .add-to-cart td a{
				font-size:12px;
				line-height:16px;
			}
		}
	<?php endif; ?>
	
	/* ============= 9. FULLWIDTH LAYOUT ============== */
	<?php if( isset($data['ts_layout_fullwidth']) && $data['ts_layout_fullwidth'] == 1 ): ?>
	.page-container,
	.dokan-store #page > #main,
	.breadcrumb-title-wrapper .breadcrumb-content,
	.container{
		width:100%;
		max-width:100%;
	}
	<?php endif; ?>
	
	/* ============= 10. DISABLED REPONSIVE ============== */
	<?php if( isset($data['ts_responsive']) && $data['ts_responsive'] == 0 ): ?>
		/* NO RESPONSIVE */
		.ts-col-1, .ts-col-2, .ts-col-3, .ts-col-4, .ts-col-5, .ts-col-6, .ts-col-7, .ts-col-8, .ts-col-9, .ts-col-10, .ts-col-11, .ts-col-12, .ts-col-1, .ts-col-2, .ts-col-3, .ts-col-4, .ts-col-5, .ts-col-6, .ts-col-7, .ts-col-8, .ts-col-9, .ts-col-10, .ts-col-11, .ts-col-12, .ts-col-13, .ts-col-14, .ts-col-15, .ts-col-16, .ts-col-17, .ts-col-18, .ts-col-19, .ts-col-20, .ts-col-21, .ts-col-22, .ts-col-23, .ts-col-24 {
			float: left;
		}
		.ts-col-24 {
			width: 100%;
		}
		.ts-col-23 {
			width: 95.83333333%;
		}
		.ts-col-22 {
			width: 91.66666667%;
		}
		.ts-col-21 {
			width: 87.5%;
		}
		.ts-col-20 {
			width: 83.33333333%;
		}
		.ts-col-19 {
			width: 79.16666667%;
		}
		.ts-col-18 {
			width: 75%;
		}
		.ts-col-17 {
			width: 70.83333333%;
		}
		.ts-col-16 {
			width: 66.66666667%;
		}
		.ts-col-15 {
			width: 62.5%;
		}
		.ts-col-14 {
			width: 58.33333333%;
		}
		.ts-col-13 {
			width: 54.16666667%;
		}
		.ts-col-12 {
			width: 50%;
		}
		.ts-col-11 {
			width: 45.83333333%;
		}
		.ts-col-10 {
			width: 41.66666667%;
		}
		.ts-col-9 {
			width: 37.5%;
		}
		.ts-col-8 {
			width: 33.33333333%;
		}
		.ts-col-7 {
			width: 29.16666667%;
		}
		.ts-col-6 {
			width: 25%;
		}
		.ts-col-5 {
			width: 20.83333333%;
		}
		.ts-col-4 {
			width: 16.66666667%;
		}
		.ts-col-3 {
			width: 12.5%;
		}
		.ts-col-2 {
			width: 8.33333333%;
		}
		.ts-col-1 {
			width: 4.16666667%;
		}
		/* Overwrite visual */
		.vc_col-sm-1, .vc_col-sm-2, .vc_col-sm-3, .vc_col-sm-4, .vc_col-sm-5, .vc_col-sm-6, .vc_col-sm-7, .vc_col-sm-8, .vc_col-sm-9, .vc_col-sm-10, .vc_col-sm-11, .vc_col-sm-12 {
			float: left;
		}
		.vc_col-sm-12 {
			width: 100%;
		}
		.vc_col-sm-11 {
			width: 91.66666667%;
		}
		.vc_col-sm-10 {
			width: 83.33333333%;
		}
		.vc_col-sm-9 {
			width: 75%;
		}
		.vc_col-sm-8 {
			width: 66.66666667%;
		}
		.vc_col-sm-7 {
			width: 58.33333333%;
		}
		.vc_col-sm-6 {
			width: 50%;
		}
		.vc_col-sm-5 {
			width: 41.66666667%;
		}
		.vc_col-sm-4 {
			width: 33.33333333%;
		}
		.vc_col-sm-3 {
			width: 25%;
		}
		.vc_col-sm-2 {
			width: 16.66666667%;
		}
		.vc_col-sm-1 {
			width: 8.33333333%;
		}
		.vc_col-sm-pull-12 {
			right: 100%;
		}
		.vc_col-sm-pull-11 {
			right: 91.66666667%;
		}
		.vc_col-sm-pull-10 {
			right: 83.33333333%;
		}
		.vc_col-sm-pull-9 {
			right: 75%;
		}
		.vc_col-sm-pull-8 {
			right: 66.66666667%;
		}
		.vc_col-sm-pull-7 {
			right: 58.33333333%;
		}
		.vc_col-sm-pull-6 {
			right: 50%;
		}
		.vc_col-sm-pull-5 {
			right: 41.66666667%;
		}
		.vc_col-sm-pull-4 {
			right: 33.33333333%;
		}
		.vc_col-sm-pull-3 {
			right: 25%;
		}
		.vc_col-sm-pull-2 {
			right: 16.66666667%;
		}
		.vc_col-sm-pull-1 {
			right: 8.33333333%;
		}
		.vc_col-sm-pull-0 {
			right: auto;
		}
		.vc_col-sm-push-12 {
			left: 100%;
		}
		.vc_col-sm-push-11 {
			left: 91.66666667%;
		}
		.vc_col-sm-push-10 {
			left: 83.33333333%;
		}
		.vc_col-sm-push-9 {
			left: 75%;
		}
		.vc_col-sm-push-8 {
			left: 66.66666667%;
		}
		.vc_col-sm-push-7 {
			left: 58.33333333%;
		}
		.vc_col-sm-push-6 {
			left: 50%;
		}
		.vc_col-sm-push-5 {
			left: 41.66666667%;
		}
		.vc_col-sm-push-4 {
			left: 33.33333333%;
		}
		.vc_col-sm-push-3 {
			left: 25%;
		}
		.vc_col-sm-push-2 {
			left: 16.66666667%;
		}
		.vc_col-sm-push-1 {
			left: 8.33333333%;
		}
		.vc_col-sm-push-0 {
			left: auto;
		}
		.vc_col-sm-offset-12 {
			margin-left: 100%;
		}
		.vc_col-sm-offset-11 {
			margin-left: 91.66666667%;
		}
		.vc_col-sm-offset-10 {
			margin-left: 83.33333333%;
		}
		.vc_col-sm-offset-9 {
			margin-left: 75%;
		}
		.vc_col-sm-offset-8 {
			margin-left: 66.66666667%;
		}
		.vc_col-sm-offset-7 {
			margin-left: 58.33333333%;
		}
		.vc_col-sm-offset-6 {
			margin-left: 50%;
		}
		.vc_col-sm-offset-5 {
			margin-left: 41.66666667%;
		}
		.vc_col-sm-offset-4 {
			margin-left: 33.33333333%;
		}
		.vc_col-sm-offset-3 {
			margin-left: 25%;
		}
		.vc_col-sm-offset-2 {
			margin-left: 16.66666667%;
		}
		.vc_col-sm-offset-1 {
			margin-left: 8.33333333%;
		}
		.vc_col-sm-offset-0 {
			margin-left: 0%;
		}
		.ts-columns .one_half{
			width:50%;
		}
		.ts-columns .one_third{
			width:33.33333%;
			float:left;/* rtl */
		}
		.ts-columns .one_fourth{
			width:20%;
		}
		@media only screen and (max-width: 1229px){
			body.boxed #page,
			.page-container,
			.container{
				width:980px;
			}
			.dokan-store #page > #main,
			.breadcrumb-title-wrapper .breadcrumb-content,
			body.boxed header.ts-header .header-sticky{
				max-width:980px;
			}
			/* 1229px - 768px */
			.visible-ipad{
				display:block !important
			}
			/* HEADER */
			/* Vertical Menu */
			header .header-v2 .vertical-menu-wrapper .vertical-menu-heading,
			header .header-v5 .vertical-menu-wrapper .vertical-menu-heading{
				font-size:0;
				padding:19px 0 19px 0;
				width:54px;
				text-align:center;
				line-height:0;
			}
			.header-v2 .vertical-menu-wrapper .vertical-menu,
			.header-v2 .vertical-menu-wrapper:hover .vertical-menu,
			.display-vertical-menu .header-v2 .vertical-menu-wrapper .vertical-menu,
			.header-v5 .vertical-menu-wrapper .vertical-menu,
			.header-v5 .vertical-menu-wrapper:hover .vertical-menu,
			.display-vertical-menu .header-v5 .vertical-menu-wrapper .vertical-menu{
				right:auto;/* rtl */
				width:240px;
			}
			header .header-v2 .vertical-menu-wrapper .vertical-menu-heading:before,
			header .header-v5 .vertical-menu-wrapper .vertical-menu-heading:before{
				position:static;
				transform:none;
				-webkit-transform:none;
				-moz-transform:none;
				display:inline-block;
			}
			header .header-v2 .vertical-menu-wrapper .vertical-menu-heading,
			header .header-v5 .vertical-menu-wrapper .vertical-menu-heading{
				font-size:0;
				padding:20px 0 20px 0;
				width:54px;
				text-align:center;
				line-height:0;
			}
			.header-v2 .vertical-menu-wrapper,
			.header-v5 .vertical-menu-wrapper{
				min-width:50px;
				margin:0;
			}
			/* Header version 3 */
			.header-v3 .header-middle > .container{
				display:block;
				position:relative;
			}
			.header-v3 .header-middle > .container > div{
				display:block;
				text-align:center;
			}
			.header-v3 .header-middle > .container > .logo-wrapper{
				padding:20px 0;
			}
			.header-v3 .menu-wrapper nav > ul.menu{
				float:none;/* rtl */
				display:inline-block;
				text-align:left /* rtl */
			}
			.header-v3 .menu-wrapper nav > ul.menu > li > a{
				padding-top:30px;
				padding-bottom:30px;
			}
			.header-v3 .header-middle > .container > .search-wrapper{
				position:absolute;
				right:10px;/*rtl */
				bottom:0;
				padding:23px 0;
			}
			.top-header-transparent .header-v3 .header-middle > .container > .search-wrapper{
				padding:12px 0;
			}
			/* Header version 4 */
			header .header-v4 .search-wrapper{
				right:10px;/* rtl */
			}
			/* SEARCH CATEGORIES */
			header .select2-container--default .select2-selection--single .select2-selection__rendered, 
			header .ts-search-by-category select{
				padding-right:35px;/* rtl */
				padding-left:15px;
			}
			header .ts-search-by-category form > .select2, 
			header .ts-search-by-category select{
				width:35% !important;
			}
			header .search-content{
				display:inline-block;
				width:65%;
			}
			/* SHORTCODE */
			/* Shortcode Price Table */
			.ts-price-table .table-description > a.button{
				margin:0 15px;
			}
			.ts-price-table .table-title{
				min-width:100px;
			}
			.ts-price-table .table-price{
				font-size:50px;
			}
			/* Shortcode Tab Product Categories */
			.ts-product-in-category-tab-wrapper .woocommerce.columns-4 .products .product.first,
			.ts-product-in-category-tab-wrapper .woocommerce.columns-3 .products .product.first{
				clear:none;
			}
			
			.ts-product-in-category-tab-wrapper .woocommerce.columns-4 .products .product,
			.ts-product-in-category-tab-wrapper .woocommerce.columns-3 .products .product{
				width:50%;float:left/* rtl */
			}

			.ts-product-in-category-tab-wrapper .woocommerce.columns-4 .products .product:nth-child(2n+1),
			.ts-product-in-category-tab-wrapper .woocommerce.columns-3 .products .product:nth-child(2n+1){
				clear:both;float:left;/* rtl */
			}
			/* Shortcode Widget Product */
			.woocommerce ul.product_list_widget li .loop-add-to-cart .button:before{
				display:none !important;
			}
			/* Shortcode Hot Deal */
			.title-background-color .shortcode-heading-wrapper .heading-title{
				font-size:18px !important;
			}
			/* PRODUCT DETAIL */
			.woocommerce .ts-col-12 div.product.vertical-thumbnail .thumbnails li{
				padding:10px 0 0 0;
			}
			.woocommerce .ts-col-12 div.product.vertical-thumbnail .thumbnails{
				margin-top:-10px;
			}
			.woocommerce .ts-col-12 .vertical-thumbnail .images-thumbnails > .thumbnails .owl-nav > div.owl-next{
				top:11px;
			}
			body .ts-col-18 div.product .summary .ts-social-sharing{
				padding: 10px 0 0 0;
				margin: 10px 0 0 0;
			}
			.woocommerce .ts-col-18 div.product.vertical-thumbnail div.images-thumbnails,
			.woocommerce .ts-col-18 div.product.vertical-thumbnail div.summary{
				width:100%;
			}
			.woocommerce .ts-col-18 div.product.vertical-thumbnail div.summary{
				clear:both;
				padding:0;
			}
			.woocommerce .ts-col-18 div.product.vertical-thumbnail .images .product-label{
				right:auto;
				left:15px;/* rtl */
			}
			#main-content.ts-col-18 div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-left:110px /* rtl */
			}
			#main-content.ts-col-18 div.product.vertical-thumbnail .thumbnails{
				width:100px;
			}
			#main-content.ts-col-18 div.product.vertical-thumbnail .thumbnails li{
				padding-top:10px;
			}
			#main-content.ts-col-18 div.product.vertical-thumbnail .thumbnails{
				margin-top:-10px;
			}
			#main-content.ts-col-18 .vertical-thumbnail .images-thumbnails > .thumbnails .owl-nav > div.owl-next{
				top:12px;
			}
			.woocommerce .ts-col-18 div.product .woocommerce-tabs.accordion-tabs{
				padding-top:20px;
			}
			div.product .ref-wrapper{
				font-size:10px;
				line-height:12px;
			}
			.woocommerce .ts-col-12 div.product .woocommerce-tabs ul.tabs li{
				margin-bottom:10px;
				min-width:120px;
			}
			.woocommerce .ts-col-12 div.product .woocommerce-tabs ul.tabs:before{
				display:none;
			}
			.woocommerce .ts-col-18 div.product .woocommerce-tabs ul.tabs li{
				min-width:120px;
			}
			/* CONTENT RESET */
			.list-posts article.post_format-post-format-quote{
				padding:20px;
			}
			/* SHOP PAGE */
			/* WIDGET */
			.ts-wg-meta .amount{
				font-size:13px;
				line-height:16px;
			}
			/* Widget Cart */
			.widget_shopping_cart .buttons{
				clear:both;
				padding-top:10px;
				padding-bottom:5px;
			}
			/* Widget padding */
			.widget-container .owl-nav, 
			.widget .owl-nav{
				right:-10px /* rtl */
			}
			.widget.ts-products-widget .owl-nav{
				right:10px;/* rtl */
			}
			.widget-container.ts-products-widget .owl-nav{
				right:0 /* rtl */
			}
			.widget-container{
				padding-left:10px;
				padding-right:10px;
			}
			.ts-products-tabs-widget .widget-title{
				padding-left:5px;/* rtl */
				padding-right:5px;/* rtl */
			}
			.ts-products-widget .widget-title{
				padding-left:5px;/* rtl */
				padding-right:60px;
			}
			.ts-products-tabs-widget{
				padding-left:0;
				padding-right:0;
			}
			.widget-title:after,
			.woocommerce .widget_shopping_cart .total:before, 
			.woocommerce.widget_shopping_cart .total:before{
				left:-10px;/* rtl */
				right:-10px;/* rtl */
			}
			.comment_list_widget .comment-meta > *{
				width:60%;
			}
			.comment_list_widget .comment-meta > .avatar{
				width:40%;
			}
			body .widget-container > select, 
			.widget_mc4wp_form_widget .mc4wp-form{
				margin:10px 0;
			}
			.widget_product_search, 
			.widget_search, 
			.widget_display_search{
				padding:0;
			}
			.widget-container .comment_list_widget > li{
				margin:10px 0 11px 0;
			}
			.widget-container.widget_text .textwidget{
				padding-top:0;
				padding-bottom:8px;
			}
			.widget_categories > ul{
				padding-top:5px;
				padding-bottom:10px;
			}
			
			.widget-container .ts-blogs-widget-wrapper{
				padding:0 0 10px 0;
			}
			.widget-container .comment_list_widget > li:before{
				bottom:-10px;
			}
			.widget-container .comment_list_widget > li:last-child:before,
			.widget-container .post_list_widget > li:last-child:before{
				display:none
			}
			.widget-container .post_list_widget > li{
				margin:10px 0 11px 0;
			}
			.widget-container .post_list_widget > li:before{
				bottom:-7px;
			}
			.ts-blogs-widget-wrapper .entry-meta span{
				margin-right:15px /* rtl */
			}
			.entry-meta span i{
				margin-right:0 /* rtl */
			}
			body.wpb-js-composer .ts-products-tabs-widget .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel-body{
				padding:10px 10px 0 10px;
			}
			.widget-container > ul, 
			section.widget_nav_menu > div > ul, 
			section.widget_display_stats > dl{
				padding-top:5px;
				margin-bottom:0;
			}
			section.widget_display_stats > dl{
				padding-bottom:0;
				margin-bottom:10px;
			}
			.woocommerce .widget_shopping_cart .total,
			.woocommerce.widget_shopping_cart .total{
				padding:10px 0 0 0;
			}
			section.product-filter-by-color > ul,
			.bbp_widget_login form,
			.widget-container .tagcloud,
			section.ts-social-icons .social-icons,
			.widget-container .widget_shopping_cart_content,
			section.ts-flickr-widget .ts-flickr-wrapper,
			section.ts-instagram-widget .ts-instagram-wrapper,
			.widget-container .widget_shopping_cart_content{
				padding:10px 0 0 0;
			}
			.mailchimp-subscription{
				padding-top:25px;
				padding-bottom:30px;
			}
			.ts-twitter-widget .item{
				margin:10px 0;
			}
			.ts-twitter-widget .item:before{
				bottom:-9px;
			}
			section.feedburner-subscription .subscribe-widget,
			.widget-container .ts-facebook-page-wrapper,
			section.bbp_widget_login .bbp-logged-in{
				padding:10px 0;
			}
			.widget-container ul.product-categories{
				padding:0 0 10px 0 !important
			}
			.product-filter-by-color ul li{
				margin:0 11px 11px 0;/* rtl */
			}
			.woocommerce .widget_layered_nav ul li{
				padding-bottom:6px;
			}
			section.product-filter-by-color > ul,
			section.woocommerce.widget-container > ul{
				padding:10px 0 0 0;
			}
			section.woocommerce.widget_rating_filter > ul,
			section.woocommerce.widget_layered_nav > ul{
				padding:10px 0 5px 0;
			}
			.ts-flickr-wrapper,
			.ts-instagram-wrapper{
				margin-bottom:10px;
			}
			.ts-gravatar-profile-widget .thumbnail{
				margin-top:10px;
			}
			.ts-gravatar-profile-widget .ts-social-icons .social-icons{
				margin-bottom:0;
			}
			.ts-gravatar-profile-widget .meta p{
				margin-bottom:5px;
			}
			body.wpb-js-composer .ts-products-tabs-widget .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a{
				padding:8px 13px; /* rtl */
			}
			body.wpb-js-composer .ts-products-tabs-widget .show-tab-number .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a{
				padding-left:47px;/* rtl */
				padding-right:13px;/* rtl */
			}
			/* CUSTOM WIDGET PRODUCTS */
			.widget-container .ts-products-widget-wrapper ul.product_list_widget ,
			.widget-container ul.product_list_widget,
			.woocommerce ul.product_list_widget{
				padding:10px 0 0 0;
			}
			.woocommerce .widget-container.ts-products-widget .thumbnail-no-border ul.product_list_widget li, 
			.widget-container.ts-products-widget .thumbnail-no-border ul.product_list_widget li{
				padding-left:10px;
				padding-right:10px;
				margin-bottom:9px;
			}
			.woocommerce .widget-container.ts-products-widget ul.product_list_widget li,
			.widget-container.ts-products-widget .woocommerce ul.product_list_widget li{
				padding:0 10px 20px 10px;
			}
			/* Filter size */
			.ts-col-24 .woocommerce .widget_layered_nav ul li{
				width:50%;
			}
			.woocommerce .ts-col-24 .widget_layered_nav ul li:nth-child(3n+1){
				clear:none;
			}
			.woocommerce .ts-col-24 .widget_layered_nav ul li:nth-child(2n+1){
				clear:both;
			}
			/* Tab blog */
			.widget-container .post_list_widget .thumbnail{
				float:none; /* rtl */
				margin:0 0 10px 0;
				width:auto;
				display:inline-block;
			}
			/* PORTFOLIO DETAIL */
			article.single-portfolio .entry-content{
				width:45%;
			}
			.single-portfolio .thumbnails{
				width:55%;
				padding-right:20px;/* rtl */
			}
			article.single.single-portfolio .ts-social-sharing{
				float:none;/* rtl */
				width:100%;
				margin-bottom:10px;
			}
			.single-portfolio .portfolio-like{
				float:none;/* rtl */
				clear:both;
			}
			/* BLOG DETAIL */
			.comment-respond textarea,
			#commentform textarea{
				height:150px;
			}
			/* SHOPPING CART */
			.ts-col-12 .woocommerce table.cart td.actions .coupon{
				float:none !important;
				width:100%;
			} 
			.ts-col-12 .woocommerce table.cart .actions > .button{
				margin:10px 0 0 0;
				float:left;/* rtl */
			}
			.ts-col-12 .woocommerce table.cart td.product-thumbnail{
				width:0;
				padding:0;
				min-width:10px;
			}
			.ts-col-12 .woocommerce table.cart td.actions .coupon .input-text{
				width:50%;
			}
			.ts-col-12 .woocommerce table.cart td.actions .coupon .button{
				width:48%;
			}
			.ts-col-12 .woocommerce table.cart td.product-thumbnail a{
				display:none !important;
			}
			/* CHECK OUT */
			.woocommerce table.shop_table.woocommerce-checkout-review-order-table tr:nth-child(2n) td, 
			.woocommerce-page table.shop_table.woocommerce-checkout-review-order-table tr:nth-child(2n) td{
				background:transparent;
			}
			.woocommerce table.shop_table.woocommerce-checkout-review-order-table tr{
				display:table-row;
			}
			.woocommerce table.shop_table.woocommerce-checkout-review-order-table tr td{
				display:table-cell;
			}
			.woocommerce table.shop_table.woocommerce-checkout-review-order-table tr td:before{
				display:none;
			}
			.woocommerce .checkout-login-coupon-wrapper .checkout_coupon .form-row-first{
				width:50%;
			}
			.woocommerce .checkout-login-coupon-wrapper .checkout_coupon .form-row{
				width:48%;
			}
			/* HOT DEAL */
			.counter-wrapper > div{
				width:40px;
				padding:3px 2px;
			}
			.counter-wrapper .ref-wrapper{
				font-size:10px;
			}
			
			/* 1229px - 991px */
			/* HEADER */
			/* Header Vertical */
			.display-vertical-menu .vertical-menu-wrapper .vertical-menu{
				display:block !important;
			}
			.vertical-menu-wrapper{
				width:207px;
			}
			.header-v2 .vertical-menu-wrapper,
			.header-v5 .vertical-menu-wrapper{
				width:50px;
			}
			.vertical-menu-wrapper .vertical-menu-heading{
				padding:20px; /* rtl */
			}
			.vertical-menu-wrapper .vertical-menu-heading:before{
				display:none;
			}
			/* Header version 2 */
			.header-v2 .shopping-cart-wrapper .cart-number,
			.header-v2 .shopping-cart-wrapper .hyphen,
			.header-v5 .shopping-cart-wrapper .cart-number,
			.header-v5 .shopping-cart-wrapper .hyphen{
				display:none;
			}
			/* Header version 3 */
			.group-meta-header > div{
				margin-right:20px;/* rtl */
			}
			.header-v3 .header-top .shopping-cart-wrapper, 
			.header-v4 .header-top .shopping-cart-wrapper{
				margin-left:20px /* rtl */
			}
			.header-v3 .ts-tiny-cart-wrapper, 
			.header-v4 .ts-tiny-cart-wrapper{
				padding:0 10px;
			}
			.header-v3 .header-top .shopping-cart-wrapper .cart-number,
			.header-v3 .header-top .shopping-cart-wrapper .hyphen,
			.header-v4 .header-top .shopping-cart-wrapper .cart-number,
			.header-v4 .header-top .shopping-cart-wrapper .hyphen{
				display:none;
			}
			/* Service page */
			.fix-size-heading h2{
				font-size:30px;
				line-height:34px;
				margin-bottom:15px;
			}
			/* SUPERMARKET 1 */
			.home1-fix-columns-slideshow .rev_slider{
				height:412px !important;
			}
			.fix-columns-hotdeals .vc_col-sm-4{
				width:30.063%;
			}
			.fix-columns-hotdeals .vc_col-sm-8{
				width:69.937%;
			}
			/* SUPERMARKET 2 */
			.hidden-button-product .ts-product.item-list .products{
				padding-top:22px;
			}
			.hidden-button-product .ts-product.item-list .owl-nav > div{
				margin-top:5px;
			}
			/* HOME ELECTRONIC */
			.vetical-slideshow{
				margin-left:260px;/* rtl */
				width:calc(100% - 260px );
			}
			.vertical-banner{
				width:100%;
				float:none;
				clear:both;
			}
			.vertical-banner > .wpb_wrapper > *{
				width:50%;
				float:left;
			}
			.vertical-banner > .wpb_wrapper > * img,
			.vertical-banner .image-link{
				width:100%;
			}
			/* WIDGET */
			/* Shortcode Widget Products */
			.widget .ts-products-widget-wrapper ul li, 
			.woocommerce .widget .ts-products-widget-wrapper ul li{
				padding:0 10px 20px 10px;
				margin-bottom:20px;
			}
			.widget .ts-products-widget-wrapper ul, 
			.woocommerce .widget .ts-products-widget-wrapper ul{
				padding-top:16px !important;
			}
			/* Widget products */
			.woocommerce ul.cart_list li img, 
			.woocommerce ul.product_list_widget li img{
				width:54px;
			}
			.widget_shopping_cart ul.product_list_widget li .ts-wg-meta,
			ul.product_list_widget li .ts-wg-meta{
				margin-left:64px; /* rtl */
			}
			.ts-products-widget .big-thumbnail ul.product_list_widget li .ts-wg-meta{
				margin-left:125px /* rtl */
			}
			.woocommerce .ts-products-widget .big-thumbnail ul.product_list_widget li img, 
			.ts-products-widget .big-thumbnail ul.product_list_widget li img{
				width:113px;
			}
			/* SHORTCODE */
			/* Shortcode categories slider */
			.title-left > .shortcode-heading-wrapper{
				width:260px;
			}
			.title-left.show-nav .shortcode-heading-wrapper .heading-title{
				max-width:90%;
			}
			.title-left > .content-wrapper{
				width:calc(100% - 260px)
			}
			/* Shortcode Video */
			.vc_row.ts-video-bg > .wpb_column{
				padding-top:150px;
				padding-bottom:150px;
			}
			.ts-youtube-video-bg .mb_YTPBar, 
			.ts-hosted-video-bg .video-control{
				top:40px;
			}
			.ts-youtube-video-bg .loading{
				top:60px;
			}
			/* Shortcode Tab Product Categories */
			.vc_col-sm-9 .horizontal-tab .column-tabs .heading-tab,
			.ts-col-18 .horizontal-tab .column-tabs .heading-tab{
				width:32.09%;
			}
			.horizontal-tab .column-tabs .heading-tab{
				width:32.09%;
			}
			.horizontal-tab .column-tabs .heading-tab .heading-title{
				font-size:18px !important;
			}
			.ts-col-18 .horizontal-tab.banner-right .column-banners,
			.ts-col-18 .horizontal-tab.banner-left .column-banners,
			.vc_col-sm-9 .horizontal-tab.banner-right .column-banners,
			.vc_col-sm-9 .horizontal-tab.banner-left .column-banners,
			.vc_col-sm-9 .horizontal-tab.banner-left.column-3 .column-banners,
			.vc_col-sm-9 .horizontal-tab.banner-right.column-3 .column-banners{
				width:32.09%;
			}
			.horizontal-tab.banner-right .column-banners,
			.horizontal-tab.banner-left .column-banners{
				width:32.088%;
			}
			.ts-col-18 .horizontal-tab.banner-right .column-products,
			.ts-col-18 .horizontal-tab.banner-left .column-products,
			.vc_col-sm-9 .horizontal-tab.banner-right .column-products,
			.vc_col-sm-9 .horizontal-tab.banner-left .column-products,
			.vc_col-sm-9 .horizontal-tab.banner-left.column-3 .column-products,
			.vc_col-sm-9 .horizontal-tab.banner-right.column-3 .column-products{
				width:67.91%;
			}
			.horizontal-tab.banner-right .column-products,
			.horizontal-tab.banner-left .column-products{
				width:67.912%;
			}
			.ts-product-in-category-tab-wrapper .column-tabs,
			.vertical-tab.column-3 .column-tabs{
				width:28.784%;
			}
			.vertical-tab .column-tabs:before,
			.vertical-tab.column-3 .column-tabs:before{
				left:28.784%; /* rtl */
			}
			.vertical-tab .column-content,
			.vertical-tab.column-3 .column-content{
				width:71.216%
			}
			/* PRODUCT DETAIL */
			.woocommerce .ts-col-12 div.product.vertical-thumbnail .thumbnails{
				width:70px;
			}
			.woocommerce .ts-col-12 div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-left:80px;/* rtl */
			}
			/* PRODUCT DETAIL */
			/* Group table */
			.woocommerce #main-content:not(.ts-col-24) div.product form.cart .group_table tr{
				margin-bottom:10px;
				display:inline-block;
				width:100%;
			}
			.woocommerce #main-content:not(.ts-col-24) div.product form.cart .group_table td{
				display:inline-block;
				width:50%;float:left; /* rtl */
				padding:5px 0 0 0;
			}
			.woocommerce #main-content:not(.ts-col-24) div.product form.cart .group_table td.label{
				clear:both;
				padding:8px 0 0 0;
			}
			/* End group table */
			.woocommerce div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-left:100px /* rtl */
			}
			.woocommerce div.product.vertical-thumbnail .thumbnails{
				width:90px;
			}
			div.product.vertical-thumbnail .thumbnails li{
				padding-top:10px;
			}
			.woocommerce div.product.vertical-thumbnail .thumbnails{
				margin-top:-10px;
			}
			.vertical-thumbnail .images-thumbnails > .thumbnails .owl-nav > div.owl-next{
				top:11px;
			}
			/* 1 Sidebar */
			/* PRODUCT DETAIL */
			.woocommerce .ts-col-24 div.product.vertical-thumbnail div.summary{
				width:45%;
			}
			.woocommerce div.product.vertical-thumbnail div.images-thumbnails{
				width:55%;
			}
			.woocommerce .ts-col-18 div.product.vertical-thumbnail form.cart, 
			.woocommerce .ts-col-18 div.product.vertical-thumbnail p.cart{
				width:auto;
				margin:0 5px 20px 0;/* rtl */
			}
			.woocommerce .ts-col-18 div.product.horizontal-thumbnail form.cart .button:before,
			.woocommerce .ts-col-18 div.product.horizontal-thumbnail p.cart .button:before{
				display:none;
			}
			.woocommerce .ts-col-18 div.product.horizontal-thumbnail form.cart .button,
			.woocommerce .ts-col-18 div.product.horizontal-thumbnail p.cart .button{
				min-width:130px;
			}
			.woocommerce .ts-col-18 div.product div.summary{
				padding-left:15px; /* rtl */
			}
			/* CHECKOUT */
			.woocommerce .checkout .col2-set{
				width:60%;
			}
			.woocommerce .checkout #order_review,
			#order_review_heading{
				width:40%;
			}
			.woocommerce ul#shipping_method li label{
				font-size:88%;
			}
			.ts-col-18 .woocommerce > form.checkout{
				padding-top:20px;
			}
			.ts-col-18 .checkout-login-coupon-wrapper{
				width:100%;
			}
			.ts-col-18 .woocommerce .checkout .col2-set{
				width:100%;
				padding-right:0 /* rtl */
			}
			.ts-col-18 .woocommerce .checkout #order_review,
			.ts-col-18 #order_review_heading{
				width:100%;
			}
			/* SHOPPING CART */
			.woocommerce-cart .ts-col-24 article > .woocommerce > form{
				width:68%;
			}
			.woocommerce-cart .ts-col-24 article > .woocommerce > .cart-collaterals{
				width:32%;
			}
			.woocommerce table.shop_table td.actions{
				padding:10px;
			}
			.woocommerce table.cart td.product-thumbnail{
				padding:10px 0 10px 10px;/* rtl */
			}
			.woocommerce table.cart td{
				padding:10px 10px 10px 0;/* rtl */
			}
			.woocommerce table.shop_table .product-thumbnail{
				width:70px;
				max-width:70px;
			}
			.woocommerce table.shop_table td.actions{
				padding:10px;
			}
			/* FOOTER */
			/* Subscription */
			body .ts-footer-block .style-fullwidth .widget h2.widgettitle{
				width:33%;
			}
			
			<?php if( isset($data['ts_enable_rtl']) && $data['ts_enable_rtl'] == 1 ): ?>
			/* 1229px - 768px */
			/* HEADER */
			/* Vertical Menu */
			.header-v2 .vertical-menu-wrapper .vertical-menu,
			.header-v2 .vertical-menu-wrapper:hover .vertical-menu, 
			.display-vertical-menu .header-v2 .vertical-menu-wrapper .vertical-menu,
			.header-v5 .vertical-menu-wrapper .vertical-menu,
			.header-v5 .vertical-menu-wrapper:hover .vertical-menu, 
			.display-vertical-menu .header-v5 .vertical-menu-wrapper .vertical-menu{
				right:auto;/* rtl */
				left:auto;
			}
			/* Header version 3 */
			.header-v3 .menu-wrapper nav > ul.menu{
				float:none;
				text-align:right /* rtl */
			}
			.header-v3 .header-middle > .container > .search-wrapper{
				left:10px;/*rtl */
				right:auto;
			}
			/* Header version 4 */
			header .header-v4 .search-wrapper{
				left:10px;/* rtl */
				right:auto;
			}
			/* SEARCH CATEGORIES */
			header .select2-container--default .select2-selection--single .select2-selection__rendered, 
			header .ts-search-by-category select{
				padding-right:15px;/* rtl */
				padding-left:35px;
			}
			/* SHORTCODE */
			/* Shortcode Tab Product Categories */
			.ts-product-in-category-tab-wrapper .woocommerce.columns-4 .products .product,
			.ts-product-in-category-tab-wrapper .woocommerce.columns-3 .products .product{
				float:right/* rtl */
			}
			.ts-product-in-category-tab-wrapper .woocommerce.columns-4 .products .product:nth-child(2n+1),
			.ts-product-in-category-tab-wrapper .woocommerce.columns-3 .products .product:nth-child(2n+1){
				float:right;/* rtl */
			}
			.vertical-tab.column-3 .column-tabs:before,
			.vertical-tab .column-tabs:before{
				right:32%; /* rtl */
				left:auto;
			}
			/* WIDGET */
			/* Widget padding */
			.widget-container .owl-nav, 
			.widget .owl-nav{
				left:-10px; /* rtl */
				right:auto;
			}
			.widget.ts-products-widget .owl-nav{
				left:10px;/* rtl */
				right:auto;
			}
			.widget-container.ts-products-widget .owl-nav{
				left:0; /* rtl */
				right:auto;
			}
			.ts-products-tabs-widget .widget-title{
				padding-left:5px;/* rtl */
				padding-right:5px;/* rtl */
			}
			.ts-products-widget .widget-title{
				padding-right:5px;/* rtl */
				padding-left:60px;
			}
			.widget-title:after,
			.woocommerce .widget_shopping_cart .total:before, 
			.woocommerce.widget_shopping_cart .total:before{
				right:-10px;/* rtl */
				left:-10px;/* rtl */
			}
			.ts-blogs-widget-wrapper .entry-meta span{
				margin-left:15px; /* rtl */
				margin-right:0;
			}
			.entry-meta span i{
				margin-right:0; /* rtl */
				margin-left:0;
			}
			.product-filter-by-color ul li{
				margin:0 0 11px 11px;/* rtl */
			}
			body.wpb-js-composer .ts-products-tabs-widget .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a{
				padding:8px 13px; /* rtl */
			}
			body.wpb-js-composer .ts-products-tabs-widget .show-tab-number .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a{
				padding-right:47px;/* rtl */
				padding-left:13px;/* rtl */
			}
			/* Tab blog */
			.widget-container .post_list_widget .thumbnail{
				float:none; /* rtl */
			}
			/* PORTFOLIO DETAIL */
			.single-portfolio .thumbnails{
				padding-left:20px;
				padding-right:0;/* rtl */
			}
			article.single.single-portfolio .ts-social-sharing{
				float:none;/* rtl */
			}
			.single-portfolio .portfolio-like{
				float:none;/* rtl */
			}
			/* SHOPPING CART */
			.ts-col-12 .woocommerce table.cart .actions > .button{
				float:right;/* rtl */
			}
			/* PRODUCT DETAIL */
			.woocommerce .ts-col-18 div.product.vertical-thumbnail .images .product-label{
				left:auto;
				right:15px;/* rtl */
			}
			#main-content.ts-col-18 div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-right:110px; /* rtl */
				margin-left:0;
			}
			
			/* 1229px - 991px */
			/* HEADER */
			/* Header Vertical */
			.vertical-menu-wrapper .vertical-menu-heading{
				padding:20px; /* rtl */
			}
			/* Header version 3 */
			.group-meta-header > div,
			.group-meta-header > div:first-child{
				margin-left:20px;/* rtl */
				margin-right:0;/* rtl */
			}
			.header-v3 .header-top .shopping-cart-wrapper, 
			.header-v4 .header-top .shopping-cart-wrapper{
				margin-right:20px; /* rtl */
				margin-left:0;
			}
			.header-v3 .ts-tiny-cart-wrapper, 
			.header-v4 .ts-tiny-cart-wrapper{
				padding:0 10px;
			}
			/* HOME ELECTRONIC */
			.vetical-slideshow{
				margin-left:0;
				margin-right:240px;/* rtl */
				width:calc(100% - 240px );
			}
			.vertical-slideshow-banner{
				display: -webkit-box;
				display: -moz-box;
				display: -ms-flexbox;
				display: flex;
				flex-flow: row wrap;
				max-width:100%;
				margin-left:0;
				margin-right:0;
			}
			.vertical-slideshow-banner .vertical-banner{ 
				-ms-flex-order: 2;
				order: 2;
				flex: 1 100%;
				flex: 1 1 100%;
				max-width:100%;
				border-width:1px 0 0 0;
				border-style:solid;
			}
			.vertical-slideshow-banner .vetical-slideshow{ 
				-ms-flex-order: 1;
				order: 1;
				flex: 1 100%;
				flex: 1 1 100%;
				max-width:100%;
			}
			/* Service page */
			.fix-size-heading h2{
				font-size:30px;
				line-height:34px;
				margin-bottom:15px;
			}
			/* WIDGET */
			/* Widget products */
			.widget_shopping_cart ul.product_list_widget li .ts-wg-meta,
			ul.product_list_widget li .ts-wg-meta{
				margin-right:64px; /* rtl */
				margin-left:0;
			}
			.ts-products-widget .big-thumbnail ul.product_list_widget li .ts-wg-meta{
				margin-right:125px; /* rtl */
				margin-left:0;
			}
			/* SHORTCODE */
			/* Shortcode Tab Product Categories */
			.vertical-tab.column-3 .column-tabs:before,
			.vertical-tab .column-tabs:before{
				right:28.784%; /* rtl */
				left:auto;
			}
			/* PRODUCT DETAIL */
			/* Group table */
			.woocommerce #main-content:not(.ts-col-24) div.product form.cart .group_table td{
				float:right; /* rtl */
			}
			/* End group table */
			.woocommerce div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-right:100px; /* rtl */
				margin-left:0;
			}
			/* 1 Sidebar */
			/* PRODUCT DETAIL */
			.woocommerce .ts-col-12 div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-right:80px;/* rtl */
				margin-left:0;
			}
			.woocommerce .ts-col-18 div.product.vertical-thumbnail form.cart, 
			.woocommerce .ts-col-18 div.product.vertical-thumbnail p.cart{
				margin:0 0 20px 5px;/* rtl */
			}
			.woocommerce .ts-col-18 div.product div.summary{
				padding-right:15px; /* rtl */
				padding-left:0;
			}
			/* CHECKOUT */
			.ts-col-18 .woocommerce .checkout .col2-set{
				padding-left:0;
				padding-right:0 /* rtl */
			}
			/* SHOPPING CART */
			.woocommerce table.cart td.product-thumbnail{
				padding:10px 10px 10px 0;/* rtl */
			}
			.woocommerce table.cart td{
				padding:10px 0 10px 10px;/* rtl */
			}
		}
		<?php endif; ?>
	<?php endif; ?>
	
	/* Custom CSS */
	<?php 
	if( !empty($ts_custom_css_code) ){
		echo html_entity_decode( trim( $ts_custom_css_code ) );
	}
	?>
