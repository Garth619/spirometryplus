<?php
add_action('init', 'boxshop_of_options');

if( !function_exists('boxshop_of_options') )
{
	function boxshop_of_options(){
	
		$list_family_fonts = boxshop_get_list_family_fonts();
		$list_google_fonts = boxshop_get_list_google_fonts();
		
		/* Default value for logo and favicon */
		$df_logo_image_uri 			= get_template_directory_uri(). '/images/logo.png'; 
		$df_icon_image_uri 			= get_template_directory_uri(). '/images/favicon.ico';
		
		/* Product Placeholder Image */
		$df_prod_placeholder_image_uri 	= get_template_directory_uri(). '/images/prod_loading.gif';

		/* Default Sidebar */
		$of_sidebars 	= array();
		$default_sidebars = boxshop_get_list_sidebars();
		if( $default_sidebars ){
			foreach( $default_sidebars as $key => $_sidebar ){
				$of_sidebars[$_sidebar['id']] = $_sidebar['name'];
			}
		}

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

/* Set the Options Array */
global $boxshop_of_options;
$boxshop_of_options = array();

/***************************/ 
/* General Options		   */
/***************************/
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("General", "boxshop")
						,"type" 	=> "heading"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Logo - Favicon", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_logo_favicon"
						,"std" 		=> "<h3>".esc_html__("Logo - Favicon", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Logo Image", "boxshop")
						,"desc" 	=> esc_html__("Select an image file for the main logo", "boxshop")
						,"id" 		=> "ts_logo"
						,"std"		=> $df_logo_image_uri
						,"type" 	=> "upload"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Logo Image On Mobile", "boxshop")
						,"desc" 	=> esc_html__("Leave blank to display the main logo on mobile", "boxshop")
						,"id" 		=> "ts_logo_mobile"
						,"std"		=> ""
						,"type" 	=> "upload"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Sticky Logo Image", "boxshop")
						,"desc" 	=> esc_html__("Display this logo on sticky header", "boxshop")
						,"id" 		=> "ts_logo_sticky"
						,"std"		=> ""
						,"type" 	=> "upload"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Favicon Image", "boxshop")
						,"desc" 	=> esc_html__("Accept ICO files", "boxshop")
						,"id" 		=> "ts_favicon"
						,"std"		=> $df_icon_image_uri
						,"type" 	=> "upload"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Text Logo", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_text_logo"
						,"std" 		=> "BoxShop"
						,"type" 	=> "text"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Layout Style", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_layout_style"
						,"std" 		=> "<h3>".esc_html__("Layout Style", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> esc_html__("You can override this option for the individual page", "boxshop")
						,"id" 		=> "ts_layout_style"
						,"std" 		=> "wide" 
						,"type" 	=> "select"
						,"options"	=> array(
									'wide'		=> esc_html__('Wide', 'boxshop')
									,'boxed'	=> esc_html__('Boxed', 'boxshop')
								)
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Fullwidth Layout", "boxshop")
						,"desc" 	=> esc_html__("Set fullwidth layout for all pages. If you activate this option, you can't set layout style is Boxed or Wide", "boxshop")
						,"id" 		=> "ts_layout_fullwidth"
						,"std" 		=> 0 
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Right To Left", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_rtl"
						,"std" 		=> "<h3>".esc_html__("Right To Left", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Right To Left", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_rtl"
						,"std" 		=> 0
						,"icon" 	=> true
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Responsive", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_responsive"
						,"std" 		=> "<h3>".esc_html__("Responsive", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Responsive", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_responsive"
						,"std" 		=> 1
						,"icon" 	=> true
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Smooth Scroll", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_smooth_scroll"
						,"std" 		=> "<h3>".esc_html__("Smooth Scroll", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Smooth Scroll", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_smooth_scroll"
						,"std" 		=> 1
						,"icon" 	=> true
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Back To Top Button", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_to_top_button"
						,"std" 		=> "<h3>".esc_html__("Back To Top Button", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Back To Top Button", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_back_to_top_button"
						,"std" 		=> 1
						,"icon" 	=> true
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Back To Top Button On Mobile", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_back_to_top_button_on_mobile"
						,"std" 		=> 1
						,"icon" 	=> true
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Google Map API Key", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_to_gmap_api_key"
						,"std" 		=> "<h3>".esc_html__("Google Map API Key", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enter your API key", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_gmap_api_key"
						,"std" 		=> ""
						,"type" 	=> "text"
				);

/***************************/ 
/* Color Scheme Options	   */
/***************************/				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Color Scheme", "boxshop")
						,"type" 	=> "heading"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Select Color Scheme of Theme", "boxshop")
						,"id" 		=> "ts_color_scheme"
						,"std" 		=> "default"
						,"type" 	=> "images"
						,"options" 	=> array(
							'default' 			=> ADMIN_IMAGES . 'color_scheme/default.jpg'
							,'blue' 			=> ADMIN_IMAGES . 'color_scheme/blue.jpg'
							,'blue2' 			=> ADMIN_IMAGES . 'color_scheme/blue2.jpg'
							,'green' 			=> ADMIN_IMAGES . 'color_scheme/green.jpg'
							,'pink' 			=> ADMIN_IMAGES . 'color_scheme/pink.jpg'
							,'yellow' 			=> ADMIN_IMAGES . 'color_scheme/yellow.jpg'
							,'orange' 			=> ADMIN_IMAGES . 'color_scheme/orange.jpg'
							,'green2' 			=> ADMIN_IMAGES . 'color_scheme/green2.jpg'
						)
				);

/** Primary Colors **/
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("General Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_general_colors"
						,"std" 		=> "<h3>".esc_html__("General Colors", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Primary Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_primary_color"
						,"std" 		=> "<h4>".esc_html__("Primary Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Primary Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_primary_color"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Text Color In Background Primary Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_text_color_in_bg_primary"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Secondary Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_secondary_color"
						,"std" 		=> "<h4>".esc_html__("Secondary Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Secondary Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_secondary_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Text Color In Background Secondary Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_text_color_in_bg_second"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_heading_color"
						,"std" 		=> "<h4>".esc_html__("Heading Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_heading_color"
						,"std" 		=> "#535353"
						,"type" 	=> "color"
				);
	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Main Content Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_main_content_color"
						,"std" 		=> "<h4>".esc_html__("Main Content Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Main Content Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_main_content_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Widget Content Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_widget_content_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_text_color"
						,"std" 		=> "#848484"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Link Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_link_color"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Link Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_link_color_hover"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Border Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_border_color"
						,"std" 		=> "#ebebeb"
						,"type" 	=> "color"
				);	

/* Input Colors */
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Input Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_button_color"
						,"std" 		=> "<h4>".esc_html__("Input Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Input Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_input_text_color"
						,"std" 		=> "#848484"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Input Text Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_input_text_color_hover"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Input Border Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_input_border_color"
						,"std" 		=> "#e5e5e5"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Input Border Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_input_border_color_hover"
						,"std" 		=> "#c0c0c0"
						,"type" 	=> "color"
				);
				
/* Button Colors */
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Button Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_button_color"
						,"std" 		=> "<h4>".esc_html__("Button Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Button Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Button Text Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_text_color_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Button Border Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_border_color"
						,"std" 		=> "#3f3f3f"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Button Border Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_border_color_hover"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);				
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Button Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_background_color"
						,"std" 		=> "#3f3f3f"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Button Background Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_button_background_color_hover"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);
				
/** Breadcrumb Colors **/		
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_breadcrumb_colors"
						,"std" 		=> "<h4>".esc_html__("Breadcrumb Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Border Bottom Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_border_bottom_color"
						,"std" 		=> "#ebebeb"
						,"type" 	=> "color"
				);				
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Heading Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_heading_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Link Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_link_color_hover"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);

/** Header Colors **/
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_header_colors"
						,"std" 		=> "<h3>".esc_html__("Header Colors", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Top Header", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_top_header"
						,"std" 		=> "<h4>".esc_html__("Top Header", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Top Header Logo Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_top_header_top_logo_background"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Top Header Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_top_header_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Top Header Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_top_header_text_color"
						,"std" 		=> "#848484"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Top Header Border Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_top_header_border_color"
						,"std" 		=> "#ebebeb"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Middle Header", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_middle_header"
						,"std" 		=> "<h4>".esc_html__("Middle Header", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Middle Header Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_middle_header_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Bottom Header", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_bottom_header"
						,"std" 		=> "<h4>".esc_html__("Bottom Header", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Bottom Header Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_bottom_header_background_color"
						,"std" 		=> "#f1f1f1"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Search", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_search_header"
						,"std" 		=> "<h4>".esc_html__("Header Search", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Search Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Search Border Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_border_color"
						,"std" 		=> "#e5e5e5"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Search Categories Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_categories_text_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Search Categories Hightlighted Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_categories_hightlighted_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
		
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Search Input Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_input_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);
		
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Search Input Text Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_search_input_text_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Shopping Cart", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_header_shopping_cart"
						,"std" 		=> "<h4>".esc_html__("Header Shopping Cart", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Shopping Cart Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_header_cart_text_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Shopping Cart Amount Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_header_cart_amount_color"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Shopping Cart Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_header_cart_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

/** Menu Colors **/
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_menu_colors"
						,"std" 		=> "<h3>".esc_html__("Menu Colors", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_vertical_menu_colors"
						,"std" 		=> "<h4>".esc_html__("Vertical Menu Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Title Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_title_text"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Title Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_title_background_color"
						,"std" 		=> "#202020"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_text_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_background_color"
						,"std" 		=> "#f9f9f9"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Text Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_text_color_hover"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Background Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_vertical_menu_background_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Main Menu Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_main_menu_color"
						,"std" 		=> "<h4>".esc_html__("Main Menu Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Border Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_border_color"
						,"std" 		=> "#ebebeb"
						,"type" 	=> "color"
				);					
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_text_color"
						,"std" 		=> "#848484"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Text Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_text_color_hover"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_sub_menu_color"
						,"std" 		=> "<h4>".esc_html__("Sub Menu Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_text_color"
						,"std" 		=> "#848484"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Text Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_text_color_hover"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Sub Menu Heading Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_sub_menu_heading_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
	

/** Footer Colors **/
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Footer Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_footer_colors"
						,"std" 		=> "<h3>".esc_html__("Footer Colors", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Footer Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_background_color"
						,"std" 		=> "#202020"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Footer Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_text_color"
						,"std" 		=> "#999999"
						,"type" 	=> "color"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Footer Text Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_text_color_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Footer Heading Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_heading_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);				
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Footer Social Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_footer_social_color"
						,"std" 		=> "<h4>".esc_html__("Footer Social Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Social Icon Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_social_icon_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);				
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Social Border Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_social_icon_border_color"
						,"std" 		=> "#848484"
						,"type" 	=> "color"
				);				
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Social Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_social_background_color"
						,"std" 		=> "#848484"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Footer End Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_footer_end_color"
						,"std" 		=> "<h4>".esc_html__("Footer End Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Footer End Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_end_background_color"
						,"std" 		=> "#202020"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Footer End Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_footer_end_text_color"
						,"std" 		=> "#999999"
						,"type" 	=> "color"
				);
		

/** Product Colors **/
		
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_colors"
						,"std" 		=> "<h3>".esc_html__("Product Colors", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
		
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Name Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_name_text_color"
						,"std" 		=> "#202020"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Price Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_price_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Price Del Sale Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_sale_del_price_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Price Sale Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_sale_price_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);					
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Rating Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_rating_color"
						,"std" 		=> "#ffad00"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Countdown Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_deal_color"
						,"std" 		=> "<h4>".esc_html__("Product Countdown Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Countdown Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_hotdeal_background_color"
						,"std" 		=> "#f7f7f7"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Countdown Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_hotdeal_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Countdown Border Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_hotdeal_border_color"
						,"std" 		=> "#f1f1f1"
						,"type" 	=> "color"
				);				
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Button Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_button_color"
						,"std" 		=> "<h4>".esc_html__("Product Button Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Button Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Button Text Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_text_color_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Button Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Button Background Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_background_color_hover"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Button Border Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_border_color"
						,"std" 		=> "#e8e8e8"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Button Border Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_button_border_color_hover"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);
			
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Nav Button Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_nav_color"
						,"std" 		=> "<h4>".esc_html__("Nav Button Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Nav Button Slider Text/Icon Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_nav_slider_icon_color"
						,"std" 		=> "#bbbbbb"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Nav Button Slider Text/Icon Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_nav_slider_icon_color_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Nav Button Slider Border Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_nav_slider_border_color"
						,"std" 		=> "#cccccc"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Nav Button Slider Border Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_nav_slider_border_color_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Nav Button Slider Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_nav_slider_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Nav Button Slider Background Color Hover", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_nav_slider_background_color_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Label Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_label_color"
						,"std" 		=> "<h4>".esc_html__("Product Label Colors", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Sale Label Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_sale_label_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Sale Label Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_sale_label_background_color"
						,"std" 		=> "#e72304"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product New Label Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_new_label_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product New Label Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_new_label_background_color"
						,"std" 		=> "#3a93ca"
						,"type" 	=> "color"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Feature Label Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_feature_label_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Feature Label Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_feature_label_background_color"
						,"std" 		=> "#72b728"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product OutStock Label Text Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_outstock_label_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product OutStock Label Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_outstock_label_background_color"
						,"std" 		=> "#d4d4d4"
						,"type" 	=> "color"
				);

/** Revolution Slider Colors **/
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Revolution Slider Colors", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_revolution_slider_colors"
						,"std" 		=> "<h3>".esc_html__("Revolution Slider Colors", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Revolution Navigation Text/Icon Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_revo_navigation_text_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Revolution Navigation Background Color", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_revo_navigation_background_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);			

				
/***************************/ 
/* Typography Config	   */
/***************************/				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Typography", "boxshop")
						,"type" 	=> "heading"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Fonts", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_fonts"
						,"std" 		=> "<h3>".esc_html__("Fonts", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Body Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_body_font"
						,"std" 		=> "<h4>".esc_html__("Body Font", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Body Font - Enable Google Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_body_font_enable_google_font"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Body Font - Family Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_body_font_family"
						,"std" 		=> "Arial" 
						,"fold"		=> "ts_body_font_enable_google_font"
						,"dfold"	=> 1
						,"type" 	=> "select"
						,"options"	=> $list_family_fonts
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Body Font - Family Font Weight", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_body_font_family_weight"
						,"std" 		=> "normal"
						,"fold"		=> "ts_body_font_enable_google_font"
						,"dfold"	=> 1
						,"type" 	=> "select"
						,"options"	=> array(
							'normal' => esc_html__("Normal", "boxshop")
							,'bold'	 => esc_html__("Bold", "boxshop")
							)
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Body Font - Google Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_body_font_google"
						,"std" 		=> "Roboto"
						,"fold"		=> "ts_body_font_enable_google_font"
						,"type" 	=> "select_google_font"
						,"preview" 	=> array(
										"text" => esc_html__("This is my font preview!", "boxshop")
										,"size" => "30px"
						)
						,"options"	=> $list_google_fonts
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Body Font - Google Font Weight", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_body_font_google_weight"
						,"std" 		=> "400"
						,"fold"		=> "ts_body_font_enable_google_font"
						,"type" 	=> "select"
						,"options"	=> array(100,200,300,400,500,600,700,800,900)
				);

/* Heading Body Font */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_heading_font"
						,"std" 		=> "<h4>".esc_html__("Heading Font", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font - Enable Google Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_heading_font_enable_google_font"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font - Family Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_heading_font_family"
						,"std" 		=> "Arial" 
						,"fold"		=> "ts_heading_font_enable_google_font"
						,"dfold"	=> 1
						,"type" 	=> "select"
						,"options"	=> $list_family_fonts
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font - Family Font Weight", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_heading_font_family_weight"
						,"std" 		=> "normal"
						,"fold"		=> "ts_heading_font_enable_google_font"
						,"dfold"	=> 1
						,"type" 	=> "select"
						,"options"	=> array(
							'normal' => esc_html__("Normal", "boxshop")
							,'bold'	 => esc_html__("Bold", "boxshop")
							)
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font - Google Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_heading_font_google"
						,"std" 		=> "Roboto"
						,"fold"		=> "ts_heading_font_enable_google_font"
						,"type" 	=> "select_google_font"
						,"preview" 	=> array(
										"text" => esc_html__("This is my font preview!", "boxshop")
										,"size" => "30px"
						)
						,"options"	=> $list_google_fonts
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font - Google Font Weight", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_heading_font_google_weight"
						,"std" 		=> "500"
						,"fold"		=> "ts_heading_font_enable_google_font"
						,"type" 	=> "select"
						,"options"	=> array(100,200,300,400,500,600,700,800,900)
				);
				
/* Menu Font */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_menu_font"
						,"std" 		=> "<h4>".esc_html__("Menu Font", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Font - Enable Google Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_font_enable_google_font"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Font - Family Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_font_family"
						,"std" 		=> "Arial" 
						,"fold"		=> "ts_menu_font_enable_google_font"
						,"dfold"	=> 1
						,"type" 	=> "select"
						,"options"	=> $list_family_fonts
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Font - Family Font Weight", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_font_family_weight"
						,"std" 		=> "normal"
						,"fold"		=> "ts_menu_font_enable_google_font"
						,"dfold"	=> 1
						,"type" 	=> "select"
						,"options"	=> array(
							'normal' => esc_html__("Normal", "boxshop")
							,'bold'	 => esc_html__("Bold", "boxshop")
							)
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Font - Google Font", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_font_google"
						,"std" 		=> "Roboto"
						,"fold"		=> "ts_menu_font_enable_google_font"
						,"type" 	=> "select_google_font"
						,"preview" 	=> array(
										"text" => esc_html__("This is my font preview!", "boxshop")
										,"size" => "30px"
						)
						,"options"	=> $list_google_fonts
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Font - Google Font Weight", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_menu_font_google_weight"
						,"std" 		=> "400"
						,"fold"		=> "ts_menu_font_enable_google_font"
						,"type" 	=> "select"
						,"options"	=> array(100,200,300,400,500,600,700,800,900)
				);
				
/*** Custom Font ***/				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Custom Fonts", "boxshop")
						,"desc" 	=> esc_html__("If you get the error message 'Sorry, this file type is not permitted for security reasons', you can add this line define('ALLOW_UNFILTERED_UPLOADS', true); to the wp-config.php file", "boxshop")
						,"id" 		=> "introduction_fonts"
						,"std" 		=> "<h3>".esc_html__("Custom Fonts", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Custom Font ttf", "boxshop")
						,"desc" 	=> esc_html__("Upload the .ttf font file", "boxshop")
						,"id" 		=> "custom_font_ttf"
						,"std"		=> ''
						,"type" 	=> "upload"
				);

/*** Font Sizes - Line Hight ***/				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Font Sizes - Line Hight", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_font_sizes_line_height"
						,"std" 		=> "<h3>".esc_html__("Font Sizes - Line Hight", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

/* Body Font Size */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Body Font Size", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_body_font_size"
						,"std" 		=> "<h4>".esc_html__("Body Font Size", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Body Font Size", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 14px", "boxshop")
						,"id" 		=> "ts_font_size_body"
						,"std" 		=> "14"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Body Font Line Height", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 26px", "boxshop")
						,"id" 		=> "ts_line_height_body"
						,"std" 		=> "26"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);

/* Menu Font Size */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Font Size", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_menu_font_size"
						,"std" 		=> "<h4>".esc_html__("Menu Font Size", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Font Size", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 15px", "boxshop")
						,"id" 		=> "ts_font_size_menu"
						,"std" 		=> "15"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Font Line Height", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 20px", "boxshop")
						,"id" 		=> "ts_line_height_menu"
						,"std" 		=> "20"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);

/* Button Font Size */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Button Font Size", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_button_font_size"
						,"std" 		=> "<h4>".esc_html__("Button Font Size", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Button Font Size", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 16px", "boxshop")
						,"id" 		=> "ts_font_size_button"
						,"std" 		=> "16"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Button Font Line Height", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 20px", "boxshop")
						,"id" 		=> "ts_line_height_button"
						,"std" 		=> "20"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);

/* Heading Font Size */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_heading_font_size"
						,"std" 		=> "<h4>".esc_html__("Heading Font Size", "boxshop")."</h4>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H1", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 40px", "boxshop")
						,"id" 		=> "ts_font_size_heading_1"
						,"std" 		=> "40"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H1", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 48px", "boxshop")
						,"id" 		=> "ts_line_height_heading_1"
						,"std" 		=> "48"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H2", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 36px", "boxshop")
						,"id" 		=> "ts_font_size_heading_2"
						,"std" 		=> "36"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H2", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 42px", "boxshop")
						,"id" 		=> "ts_line_height_heading_2"
						,"std" 		=> "42"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H3", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 30px", "boxshop")
						,"id" 		=> "ts_font_size_heading_3"
						,"std" 		=> "30"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H3", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 36px", "boxshop")
						,"id" 		=> "ts_line_height_heading_3"
						,"std" 		=> "36"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H4", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 24px", "boxshop")
						,"id" 		=> "ts_font_size_heading_4"
						,"std" 		=> "24"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H4", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 30px", "boxshop")
						,"id" 		=> "ts_line_height_heading_4"
						,"std" 		=> "30"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H5", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 18px", "boxshop")
						,"id" 		=> "ts_font_size_heading_5"
						,"std" 		=> "18"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H5", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 24px", "boxshop")
						,"id" 		=> "ts_line_height_heading_5"
						,"std" 		=> "24"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Size - H6", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 16px", "boxshop")
						,"id" 		=> "ts_font_size_heading_6"
						,"std" 		=> "16"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Heading Font Line Height - H6", "boxshop")
						,"desc" 	=> esc_html__("In pixels. Default is 22px", "boxshop")
						,"id" 		=> "ts_line_height_heading_6"
						,"std" 		=> "22"
						,"min" 		=> "10"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);

/***************************/ 
/* Header Options		   */
/***************************/				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header", "boxshop")
						,"type" 	=> "heading"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Options", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_header_options"
						,"std" 		=> "<h3>".esc_html__("Header Options", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Layout", "boxshop")
						,"id" 		=> "ts_header_layout"
						,"std" 		=> "v1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'v1' 	=> ADMIN_IMAGES . 'header/header_v1.jpg'
							,'v2' 	=> ADMIN_IMAGES . 'header/header_v2.jpg'
							,'v3' 	=> ADMIN_IMAGES . 'header/header_v3.jpg'
							,'v4' 	=> ADMIN_IMAGES . 'header/header_v4.jpg'
							,'v5' 	=> ADMIN_IMAGES . 'header/header_v5.jpg'
							,'v6' 	=> ADMIN_IMAGES . 'header/header_v6.jpg'
							,'v7' 	=> ADMIN_IMAGES . 'header/header_v7.jpg'
						)
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Contact Information", "boxshop")
						,"desc" 	=> esc_html__("You can add your email, phone number", "boxshop")
						,"id" 		=> "ts_header_contact_information"
						,"std"		=> "<i class='pe-7s-call'></i> +189 284 5679"
						,"type" 	=> "textarea"
					);				
					
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Vertical Menu Style", "boxshop")
						,"desc" 	=> esc_html__("Set height of vertical menu item", "boxshop")
						,"id" 		=> "ts_vertical_menu_style"
						,"std" 		=> ""
						,"type" 	=> "select"
						,"options" 	=> array(
								""			=> esc_html__("Big", "boxshop")
								,"small"	=> esc_html__("Small", "boxshop")
						)
					);
					
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Currency", "boxshop")
						,"desc" 	=> esc_html__("If you don't install WooCommerce Multilingual plugin, it will display demo html", "boxshop")
						,"id" 		=> "ts_header_currency"
						,"std"		=> "1"
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
					);
					
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Header Language", "boxshop")
						,"desc" 	=> esc_html__("If you don't install WPML plugin, it will display demo html", "boxshop")
						,"id" 		=> "ts_header_language"
						,"std"		=> '1'
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
					);
					
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Shopping Cart", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_tiny_shopping_cart"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Search Bar", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_search"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
				);
			
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Search By Category", "boxshop")
						,"desc" 	=> esc_html__("Enable or disable category dropdown in search bar. Please note that it is only available on some header layouts", "boxshop")
						,"id" 		=> "ts_search_by_category"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
				);
			
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("My Account", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_tiny_account"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Wishlist", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_tiny_wishlist"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Sticky Header", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_sticky_header"
						,"std" 		=> "1"
						,"on"		=> esc_html__("Enable", "boxshop")
						,"off"		=> esc_html__("Disable", "boxshop")
						,"type" 	=> "switch"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Options", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_breadcrumb_images"
						,"std" 		=> "<h3>".esc_html__("Breadcrumb Options", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumb Layout", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_layout"
						,"std" 		=> "v1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'v1' 	=> ADMIN_IMAGES . 'breadcrumb/breadcrumb_v1.jpg'
							,'v2' 	=> ADMIN_IMAGES . 'breadcrumb/breadcrumb_v2.jpg'
							,'v3' 	=> ADMIN_IMAGES . 'breadcrumb/breadcrumb_v3.jpg'
						)
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Breadcrumb Background Image", "boxshop")
						,"desc" 	=> esc_html__("You can set background color by going to Color Scheme tab > Breadcrumb Colors section", "boxshop")
						,"id" 		=> "ts_enable_breadcrumb_background_image"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Breadcrumbs Background Image", "boxshop")
						,"desc" 	=> esc_html__("Select a new image to override the default background image", "boxshop")
						,"id" 		=> "ts_bg_breadcrumbs"
						,"std"		=> "" 
						,"type" 	=> "upload"
					);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Breadcrumb Background Parallax", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_breadcrumb_bg_parallax"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);

/***************************/
/* Menu - Mega Menu Options*/
/***************************/				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu", "boxshop")
						,"type" 	=> "heading"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Mega Menu", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "mega_menu"
						,"std" 		=> "<h3>".esc_html__("Mega Menu", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Mega Menu Widget Area", "boxshop")
						,"desc" 	=> esc_html__("Number Of Widget Areas Available. Default is 6", "boxshop")
						,"id" 		=> "ts_menu_num_widget"
						,"std" 		=> "6"
						,"min" 		=> "1"
						,"step"		=> "1"
						,"max" 		=> "30"
						,"type" 	=> "sliderui" 
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Menu Thumbnail Size", "boxshop")
						,"desc" 	=> esc_html__("Thumbnail width. Default is 40", "boxshop")
						,"id" 		=> "ts_menu_thumb_width"
						,"std" 		=> "40"
						,"min" 		=> "5"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
$boxshop_of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> esc_html__("Thumbnail height. Default is 40", "boxshop")
						,"id" 		=> "ts_menu_thumb_height"
						,"std" 		=> "40"
						,"min" 		=> "5"
						,"step"		=> "1"
						,"max" 		=> "50"
						,"type" 	=> "sliderui" 
				);
				
/***************************/ 
/* Blog Options			   */
/***************************/
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog", "boxshop")
						,"type" 	=> "heading"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "blog"
						,"std" 		=> "<h3>".esc_html__("Blog", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Layout", "boxshop")
						,"desc" 	=> esc_html__("Select main content and sidebar alignment. It is available when Front page displays the latest posts", "boxshop")
						,"id" 		=> "ts_blog_layout"
						,"std" 		=> "0-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> ADMIN_IMAGES . '1col.png'
							,'0-1-1' 	=> ADMIN_IMAGES . '2cr.png'
							,'1-1-0' 	=> ADMIN_IMAGES . '2cl.png'
							,'1-1-1' 	=> ADMIN_IMAGES . '3cm.png'
						)
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Left Sidebar", "boxshop")
						,"id" 		=> "ts_blog_left_sidebar"
						,"std" 		=> "blog-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Right Sidebar", "boxshop")
						,"id" 		=> "ts_blog_right_sidebar"
						,"std" 		=> "blog-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Style", "boxshop")
						,"desc" 	=> esc_html__("Only use for Blog Template page", "boxshop")
						,"id" 		=> "ts_blog_style"
						,"std" 		=> ""
						,"type" 	=> "select"
						,"options" 	=> array(
							""		=> esc_html__("Default", "boxshop")
							,"list"	=> esc_html__("List", "boxshop")
						)
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Thumbnail", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_thumbnail"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Date", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_date"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Title", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_title"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Author", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_author"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Comment", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_comment"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog View", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_view"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Read More Button", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_read_more"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Categories", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_categories"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Excerpt", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_excerpt"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Excerpt Strip All Tags", "boxshop")
						,"desc" 	=> esc_html__("Strip all html tags in Excerpt", "boxshop")
						,"id" 		=> "ts_blog_excerpt_strip_tags"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Excerpt Max Words", "boxshop")
						,"desc" 	=> esc_html__("Input -1 to show full excerpt", "boxshop")
						,"id" 		=> "ts_blog_excerpt_max_words"
						,"std" 		=> "-1"
						,"type" 	=> "text"
				);

/*** Blog Details ***/
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Details", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "blog_details"
						,"std" 		=> "<h3>".esc_html__("Blog Details", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Details Layout", "boxshop")
						,"desc" 	=> esc_html__("Select main content and sidebar alignment", "boxshop")
						,"id" 		=> "ts_blog_details_layout"
						,"std" 		=> "0-1-1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> ADMIN_IMAGES . '1col.png'
							,'0-1-1' 	=> ADMIN_IMAGES . '2cr.png'
							,'1-1-0' 	=> ADMIN_IMAGES . '2cl.png'
							,'1-1-1' 	=> ADMIN_IMAGES . '3cm.png'
						)
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Left Sidebar", "boxshop")
						,"id" 		=> "ts_blog_details_left_sidebar"
						,"std" 		=> "blog-detail-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Right Sidebar", "boxshop")
						,"id" 		=> "ts_blog_details_right_sidebar"
						,"std" 		=> "blog-detail-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);								

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Thumbnail", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_thumbnail"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Date", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_date"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Title", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_title"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Author", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_author"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Comment", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_comment"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog View", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_view"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Content", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_content"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Tags", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_tags"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Categories", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_categories"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Sharing", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_sharing"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Author Box", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_author_box"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Related Posts", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_related_posts"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Blog Comment Form", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_blog_details_comment_form"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
/***************************/ 
/* Portfolio Config      */
/***************************/ 
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Details", "boxshop")
						,"type" 	=> "heading"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Thumbnail", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_thumbnail"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Title", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_title"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Likes", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_likes"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Content", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_content"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Date", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_date"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio URL", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_url"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Categories", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_categories"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Sharing", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_sharing"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Related Posts", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_related_posts"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Custom Field", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_custom_field"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Custom Field Title", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_custom_field_title"
						,"std" 		=> "Custom Field"
						,"type" 	=> "text"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Portfolio Custom Field Content", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_portfolio_custom_field_content"
						,"std" 		=> "Custom content goes here"
						,"type" 	=> "textarea"
				);				
				
/***************************/ 
/* WooCommerce Config      */
/***************************/ 
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("WooCommerce", "boxshop")
						,"type" 	=> "heading"
				);
				
/* Product Label */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Label", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "product_label_options"
						,"std" 		=> "<h3>".esc_html__("Product Label", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Show New Label", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_show_new_label"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product New Label Text", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_new_label_text"
						,"std" 		=> "New"
						,"fold" 	=> "ts_product_show_new_label"
						,"type" 	=> "text"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product New Label Time", "boxshop")
						,"desc" 	=> esc_html__("Number of days which you want to show New label since product is published", "boxshop")
						,"id" 		=> "ts_product_show_new_label_time"
						,"std" 		=> 30
						,"fold" 	=> "ts_product_show_new_label"
						,"type" 	=> "text"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Sale Label Text", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_sale_label_text"
						,"std" 		=> "Sale"
						,"type" 	=> "text"
				);	

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Feature Label Text", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_feature_label_text"
						,"std" 		=> "Hot"
						,"type" 	=> "text"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Out Of Stock Label Text", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_product_out_of_stock_label_text"
						,"std" 		=> "Sold out"
						,"type" 	=> "text"
				);				
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Show Sale Label As", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_show_sale_label_as"
						,"std" 		=> "text"
						,"type" 	=> "select"
						,"options" 	=> array(
							'text' 		=> esc_html__('Text', 'boxshop')
							,'number' 	=> esc_html__('Number', 'boxshop')
							,'percent' 	=> esc_html__('Percent', 'boxshop')
						)
				);			
				
/* Back Image */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Back Product Image", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_enable_img_back"
						,"std" 		=> "<h3>".esc_html__("Back Product Image", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Back Product Image", "boxshop")
						,"desc" 	=> esc_html__("Show back product image on hover. It will show an image from Product Gallery", "boxshop")
						,"id" 		=> "ts_effect_product"
						,"std" 		=> "1"
						,"type" 	=> "switch"
				);

/* Thumbnail Border */
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Thumbnail Border", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_prod_thumbnail_border"
						,"std" 		=> "<h3>".esc_html__("Thumbnail Border", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Thumbnail Border", "boxshop")
						,"desc" 	=> esc_html__("Add border to product thumbnail. It affects to Shop/Product Category page, Product Detail page, Quickshop, Related Products, Up-Sells and Cross-Sells", "boxshop")
						,"id" 		=> "ts_prod_thumbnail_border"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
/* Product Lazy Load */
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Lazy Load", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "prod_lazy_load_options"
						,"std" 		=> "<h3>".esc_html__("Lazy Load", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Activate Lazy Load", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_lazy_load"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Placeholder Image", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_placeholder_img"
						,"std"		=> $df_prod_placeholder_image_uri
						,"type" 	=> "upload"
				);
				
/* Quickshop */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Quickshop", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "quickshop_options"
						,"std" 		=> "<h3>".esc_html__("Quickshop", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Activate Quickshop", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_enable_quickshop"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
/* Catalog Mode */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Catalog Mode", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_catalog_mode"
						,"std" 		=> "<h3>".esc_html__("Catalog Mode", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Catalog Mode", "boxshop")
						,"desc" 	=> esc_html__("Hide all Add To Cart buttons on your site. You can also hide Shopping cart by going to Header tab > turn Shopping Cart option off", "boxshop")
						,"id" 		=> "ts_enable_catalog_mode"
						,"std" 		=> "0"
						,"type" 	=> "switch"
				);
								
/* Ajax Search */				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Ajax Search", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ajax_search_options"
						,"std" 		=> "<h3>".esc_html__("Ajax Search", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Enable Ajax Search", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_ajax_search"
						,"std" 		=> "1"
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Number Of Results", "boxshop")
						,"desc" 	=> esc_html__("Input -1 to show all results", "boxshop")
						,"id" 		=> "ts_ajax_search_number_result"
						,"std" 		=> 3
						,"type" 	=> "text"
				);
				
/***************************/ 
/* Product Category Config */
/***************************/ 
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Category", "boxshop")
						,"type" 	=> "heading"
				);				

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Category Layout", "boxshop")
						,"desc" 	=> esc_html__("Select main content and sidebar alignment", "boxshop")
						,"id" 		=> "ts_prod_cat_layout"
						,"std" 		=> "0-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> ADMIN_IMAGES . '1col.png'
							,'0-1-1' 	=> ADMIN_IMAGES . '2cr.png'
							,'1-1-0' 	=> ADMIN_IMAGES . '2cl.png'
							,'1-1-1' 	=> ADMIN_IMAGES . '3cm.png'
						)
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Left Sidebar", "boxshop")
						,"id" 		=> "ts_prod_cat_left_sidebar"
						,"std" 		=> "product-category-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Right Sidebar", "boxshop")
						,"id" 		=> "ts_prod_cat_right_sidebar"
						,"std" 		=> "product-category-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Columns", "boxshop")
						,"id" 		=> "ts_prod_cat_columns"
						,"std" 		=> "4"
						,"type" 	=> "select"
						,"options" 	=> array(
									3	=> 3
									,4	=> 4
									,5	=> 5
									,6	=> 6
									)
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Products per page", "boxshop")
						,"desc" 	=> esc_html__("Number of products per page", "boxshop")
						,"id" 		=> "ts_prod_cat_per_page"
						,"std" 		=> 16
						,"type" 	=> "text"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Top Content Widget Area", "boxshop")
						,"desc" 	=> esc_html__("Display Product Category Top Content widget area", "boxshop")
						,"id" 		=> "ts_prod_cat_top_content"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Thumbnail Slider", "boxshop")
						,"desc" 	=> esc_html__("Each product displays as a slider. Use thumbnails from gallery or variation", "boxshop")
						,"id" 		=> "ts_prod_cat_thumbnail_slider"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Thumbnail Slider Number", "boxshop")
						,"id" 		=> "ts_prod_cat_thumbnail_slider_number"
						,"std" 		=> "3"
						,"type" 	=> "select"
						,"fold" 	=> "ts_prod_cat_thumbnail_slider"
						,"options" 	=> array(
									3	=> 3
									,4	=> 4
									,5	=> 5
									,6	=> 6
									)
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Thumbnail Slider Variation", "boxshop")
						,"desc" 	=> esc_html__("If product is a variable product, its variations will be used", "boxshop")
						,"id" 		=> "ts_prod_cat_thumbnail_slider_variation"
						,"std" 		=> 0
						,"type" 	=> "switch"
						,"fold" 	=> "ts_prod_cat_thumbnail_slider"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Thumbnail Slider Variation Color", "boxshop")
						,"desc" 	=> esc_html__("If variations have the \"color\" attribute, color of dot navigation will be replaced by color of the color attribute", "boxshop")
						,"id" 		=> "ts_prod_cat_thumbnail_slider_variation_color"
						,"std" 		=> 0
						,"type" 	=> "switch"
						,"fold" 	=> "ts_prod_cat_thumbnail_slider"
				);				
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Thumbnail", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_thumbnail"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Label", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_label"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Categories", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_cat"
						,"std" 		=> 0
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Title", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_title"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product SKU", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_sku"
						,"std" 		=> 0
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Rating", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_rating"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Price", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_price"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Add To Cart Button", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat_add_to_cart"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Short Description - Grid View", "boxshop")
						,"desc" 	=> esc_html__("Show product description on grid view", "boxshop")
						,"id" 		=> "ts_prod_cat_grid_desc"
						,"std" 		=> 0
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Short Description - Grid View - Limit Words", "boxshop")
						,"desc" 	=> esc_html__("Number of words to show product description on grid view. It is also used for product shortcode", "boxshop")
						,"id" 		=> "ts_prod_cat_grid_desc_words"
						,"std" 		=> 8
						,"type" 	=> "text"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Short Description - List View", "boxshop")
						,"desc" 	=> esc_html__("Show product description on list view", "boxshop")
						,"id" 		=> "ts_prod_cat_list_desc"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Short Description - List View - Limit Words", "boxshop")
						,"desc" 	=> esc_html__("Number of words to show product description on list view", "boxshop")
						,"id" 		=> "ts_prod_cat_list_desc_words"
						,"std" 		=> 50
						,"type" 	=> "text"
				);
				
/***************************/ 
/* Product Details Config  */
/***************************/ 
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Details", "boxshop")
						,"type" 	=> "heading"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Layout", "boxshop")
						,"desc" 	=> esc_html__("Select main content and sidebar alignment", "boxshop")
						,"id" 		=> "ts_prod_layout"
						,"std" 		=> "0-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> ADMIN_IMAGES . '1col.png'
							,'0-1-1' 	=> ADMIN_IMAGES . '2cr.png'
							,'1-1-0' 	=> ADMIN_IMAGES . '2cl.png'
							,'1-1-1' 	=> ADMIN_IMAGES . '3cm.png'
						)
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Left Sidebar", "boxshop")
						,"id" 		=> "ts_prod_left_sidebar"
						,"std" 		=> "product-detail-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Right Sidebar", "boxshop")
						,"id" 		=> "ts_prod_right_sidebar"
						,"std" 		=> "product-detail-sidebar"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Breadcrumb", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_breadcrumb"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Cloud Zoom", "boxshop")
						,"desc" 	=> esc_html__("If you turn it off, product gallery images will open in a lightbox", "boxshop")
						,"id" 		=> "ts_prod_cloudzoom"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Attribute Dropdown", "boxshop")
						,"desc"		=> esc_html__("If you turn it off, the dropdown will be replaced by image or text label", "boxshop")
						,"id" 		=> "ts_prod_attr_dropdown"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Next/Prev Product Navigation", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_next_prev_navigation"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Thumbnail", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_thumbnail"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Label", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_label"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Title", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_title"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Title In Content", "boxshop")
						,"desc" 	=> esc_html__("Display the product title in the page content instead of above the breadcrumbs", "boxshop")
						,"id" 		=> "ts_prod_title_in_content"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Rating", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_rating"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product SKU", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_sku"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Availability", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_availability"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Excerpt", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_excerpt"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Count Down", "boxshop")
						,"desc" 	=> esc_html__("You have to activate ThemeSky plugin", "boxshop")
						,"id" 		=> "ts_prod_count_down"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Price", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_price"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Add To Cart Button", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_add_to_cart"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Categories", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_cat"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Tags", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_tag"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Sharing", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_sharing"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Thumbnails", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_thumbnails"
						,"std" 		=> "<h3>".esc_html__("Product Thumbnails", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Thumbnails Style", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_thumbnails_style"
						,"std" 		=> "vertical" 
						,"type" 	=> "select"
						,"options"	=> array(
									'vertical'		=> esc_html__('Vertical', 'boxshop')
									,'horizontal'	=> esc_html__('Horizontal', 'boxshop')
								)
				);				
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Tabs", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_tabs"
						,"std" 		=> "<h3>".esc_html__("Product Tabs", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Tabs", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_tabs"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Tabs As Accordion", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_accordion_tabs"
						,"std" 		=> 0
						,"fold"		=> "ts_prod_tabs"
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Tabs Position", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_tabs_position"
						,"std" 		=> "after_summary" 
						,"fold"		=> "ts_prod_tabs"
						,"type" 	=> "select"
						,"options"	=> array(
									'after_summary'		=> esc_html__('After Summary', 'boxshop')
									,'inside_summary'	=> esc_html__('Inside Summary', 'boxshop')
								)
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Custom Tab", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_custom_tab"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"fold"		=> "ts_prod_tabs"
						,"type" 	=> "switch"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Custom Tab Title", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_custom_tab_title"
						,"std" 		=> "Custom tab"
						,"fold"		=> "ts_prod_tabs"
						,"type" 	=> "text"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Product Custom Tab Content", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_custom_tab_content"
						,"std" 		=> "Your custom content goes here. You can add the content for individual product"
						,"fold"		=> "ts_prod_tabs"
						,"type" 	=> "textarea"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Ads Banner", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_product_ads_banner"
						,"std" 		=> "<h3>".esc_html__("Ads Banner", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Ads Banner", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_ads_banner"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Ads Banner Content", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_ads_banner_content"
						,"std" 		=> ''
						,"fold"		=> "ts_prod_ads_banner"
						,"type" 	=> "textarea"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Related - Up-Sell Products", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "introduction_related_upsell_product"
						,"std" 		=> "<h3>".esc_html__("Related - Up-Sell Products", "boxshop")."</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Up-Sell Products", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_upsells"
						,"std" 		=> 1
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Related Products", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_prod_related"
						,"std" 		=> 0
						,"on"		=> esc_html__("Show", "boxshop")
						,"off"		=> esc_html__("Hide", "boxshop")
						,"type" 	=> "switch"
				);
				
/***************************/ 
/* Custom CSS/JS Options      */
/***************************/			
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Custom Code", "boxshop")
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-custom.png"
				);

$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Custom CSS Code", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_custom_css_code"
						,"std" 		=> ""
						,"type" 	=> "css_field"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Custom Javascript Code", "boxshop")
						,"desc" 	=> ""
						,"id" 		=> "ts_custom_javascript_code"
						,"std" 		=> ""
						,"type" 	=> "js_field"
				);
				

/***************************/ 
/* Backup Options          */
/***************************/
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Backup", "boxshop")
						,"type" 	=> "heading"
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Backup and Restore Options", "boxshop")
						,"id" 		=> "of_backup"
						,"std" 		=> ""
						,"type" 	=> "backup"
						,"desc" 	=> esc_html__('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'boxshop')
				);
				
$boxshop_of_options[] = array( 	"name" 		=> esc_html__("Transfer Theme Options Data", "boxshop")
						,"id" 		=> "of_transfer"
						,"std" 		=> ""
						,"type" 	=> "transfer"
						,"desc" 	=> esc_html__('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'boxshop')
				);
				
	}
}

function boxshop_get_list_family_fonts(){
	$fonts = array(
					"Arial" => "Arial"
					,"Advent Pro" => "Advent Pro"
					,"Verdana" => "Verdana, Geneva"
					,"Trebuchet" => "Trebuchet"
					,"Georgia" => "Georgia"
					,"Times New Roman" => "Times New Roman"
					,"Tahoma, Geneva" => "Tahoma, Geneva"
					,"Palatino" => "Palatino"
					,"Helvetica" => "Helvetica"
					,"CustomFont" => esc_html__("Custom Font", "boxshop")
				);
	return apply_filters('boxshop_list_family_fonts', $fonts);
}

function boxshop_get_list_google_fonts(){
	$fonts = array(
					"ABeeZee" => "ABeeZee"
					,"Abel" => "Abel"
					,"Abril Fatface" => "Abril Fatface"
					,"Aclonica" => "Aclonica"
					,"Acme" => "Acme"
					,"Actor" => "Actor"
					,"Adamina" => "Adamina"
					,"Advent Pro" => "Advent Pro"
					,"Aguafina Script" => "Aguafina Script"
					,"Akronim" => "Akronim"
					,"Aladin" => "Aladin"
					,"Aldrich" => "Aldrich"
					,"Alef" => "Alef"
					,"Alegreya" => "Alegreya"
					,"Alegreya SC" => "Alegreya SC"
					,"Alex Brush" => "Alex Brush"
					,"Alfa Slab One" => "Alfa Slab One"
					,"Alice" => "Alice"
					,"Alike" => "Alike"
					,"Alike Angular" => "Alike Angular"
					,"Allan" => "Allan"
					,"Allerta" => "Allerta"
					,"Allerta Stencil" => "Allerta Stencil"
					,"Allura" => "Allura"
					,"Almendra" => "Almendra"
					,"Almendra Display" => "Almendra Display"
					,"Almendra SC" => "Almendra SC"
					,"Amarante" => "Amarante"
					,"Amaranth" => "Amaranth"
					,"Amatic SC" => "Amatic SC"
					,"Amethysta" => "Amethysta"
					,"Anaheim" => "Anaheim"
					,"Andada" => "Andada"
					,"Andika" => "Andika"
					,"Angkor" => "Angkor"
					,"Annie Use Your Telescope" => "Annie Use Your Telescope"
					,"Anonymous Pro" => "Anonymous Pro"
					,"Antic" => "Antic"
					,"Antic Didone" => "Antic Didone"
					,"Antic Slab" => "Antic Slab"
					,"Anton" => "Anton"
					,"Arapey" => "Arapey"
					,"Arbutus" => "Arbutus"
					,"Arbutus Slab" => "Arbutus Slab"
					,"Architects Daughter" => "Architects Daughter"
					,"Archivo Black" => "Archivo Black"
					,"Archivo Narrow" => "Archivo Narrow"
					,"Arimo" => "Arimo"
					,"Arizonia" => "Arizonia"
					,"Armata" => "Armata"
					,"Artifika" => "Artifika"
					,"Arvo" => "Arvo"
					,"Asap" => "Asap"
					,"Asset" => "Asset"
					,"Astloch" => "Astloch"
					,"Asul" => "Asul"
					,"Atomic Age" => "Atomic Age"
					,"Aubrey" => "Aubrey"
					,"Audiowide" => "Audiowide"
					,"Autour One" => "Autour One"
					,"Average" => "Average"
					,"Average Sans" => "Average Sans"
					,"Averia Gruesa Libre" => "Averia Gruesa Libre"
					,"Averia Libre" => "Averia Libre"
					,"Averia Sans Libre" => "Averia Sans Libre"
					,"Averia Serif Libre" => "Averia Serif Libre"
					,"Bad Script" => "Bad Script"
					,"Balthazar" => "Balthazar"
					,"Bangers" => "Bangers"
					,"Basic" => "Basic"
					,"Battambang" => "Battambang"
					,"Baumans" => "Baumans"
					,"Bayon" => "Bayon"
					,"Belgrano" => "Belgrano"
					,"Belleza" => "Belleza"
					,"BenchNine" => "BenchNine"
					,"Bentham" => "Bentham"
					,"Berkshire Swash" => "Berkshire Swash"
					,"Bevan" => "Bevan"
					,"Bigelow Rules" => "Bigelow Rules"
					,"Bigshot One" => "Bigshot One"
					,"Bilbo" => "Bilbo"
					,"Bilbo Swash Caps" => "Bilbo Swash Caps"
					,"Bitter" => "Bitter"
					,"Black Ops One" => "Black Ops One"
					,"Bokor" => "Bokor"
					,"Bonbon" => "Bonbon"
					,"Boogaloo" => "Boogaloo"
					,"Bowlby One" => "Bowlby One"
					,"Bowlby One SC" => "Bowlby One SC"
					,"Brawler" => "Brawler"
					,"Bree Serif" => "Bree Serif"
					,"Bubblegum Sans" => "Bubblegum Sans"
					,"Bubbler One" => "Bubbler One"
					,"Buda" => "Buda"
					,"Buenard" => "Buenard"
					,"Butcherman" => "Butcherman"
					,"Butterfly Kids" => "Butterfly Kids"
					,"Cabin" => "Cabin"
					,"Cabin Condensed" => "Cabin Condensed"
					,"Cabin Sketch" => "Cabin Sketch"
					,"Caesar Dressing" => "Caesar Dressing"
					,"Cagliostro" => "Cagliostro"
					,"Calligraffitti" => "Calligraffitti"
					,"Cambo" => "Cambo"
					,"Candal" => "Candal"
					,"Cantarell" => "Cantarell"
					,"Cantata One" => "Cantata One"
					,"Cantora One" => "Cantora One"
					,"Capriola" => "Capriola"
					,"Cardo" => "Cardo"
					,"Carme" => "Carme"
					,"Carrois Gothic" => "Carrois Gothic"
					,"Carrois Gothic SC" => "Carrois Gothic SC"
					,"Carter One" => "Carter One"
					,"Caudex" => "Caudex"
					,"Cedarville Cursive" => "Cedarville Cursive"
					,"Ceviche One" => "Ceviche One"
					,"Changa One" => "Changa One"
					,"Chango" => "Chango"
					,"Chau Philomene One" => "Chau Philomene One"
					,"Chela One" => "Chela One"
					,"Chelsea Market" => "Chelsea Market"
					,"Chenla" => "Chenla"
					,"Cherry Cream Soda" => "Cherry Cream Soda"
					,"Cherry Swash" => "Cherry Swash"
					,"Chewy" => "Chewy"
					,"Chicle" => "Chicle"
					,"Chivo" => "Chivo"
					,"Cinzel" => "Cinzel"
					,"Cinzel Decorative" => "Cinzel Decorative"
					,"Clicker Script" => "Clicker Script"
					,"Coda" => "Coda"
					,"Coda Caption" => "Coda Caption"
					,"Codystar" => "Codystar"
					,"Combo" => "Combo"
					,"Comfortaa" => "Comfortaa"
					,"Coming Soon" => "Coming Soon"
					,"Concert One" => "Concert One"
					,"Condiment" => "Condiment"
					,"Content" => "Content"
					,"Contrail One" => "Contrail One"
					,"Convergence" => "Convergence"
					,"Cookie" => "Cookie"
					,"Copse" => "Copse"
					,"Corben" => "Corben"
					,"Courgette" => "Courgette"
					,"Cousine" => "Cousine"
					,"Coustard" => "Coustard"
					,"Covered By Your Grace" => "Covered By Your Grace"
					,"Crafty Girls" => "Crafty Girls"
					,"Creepster" => "Creepster"
					,"Crete Round" => "Crete Round"
					,"Crimson Text" => "Crimson Text"
					,"Croissant One" => "Croissant One"
					,"Crushed" => "Crushed"
					,"Cuprum" => "Cuprum"
					,"Cutive" => "Cutive"
					,"Cutive Mono" => "Cutive Mono"
					,"Damion" => "Damion"
					,"Dancing Script" => "Dancing Script"
					,"Dangrek" => "Dangrek"
					,"Dawning of a New Day" => "Dawning of a New Day"
					,"Days One" => "Days One"
					,"Delius" => "Delius"
					,"Delius Swash Caps" => "Delius Swash Caps"
					,"Delius Unicase" => "Delius Unicase"
					,"Della Respira" => "Della Respira"
					,"Denk One" => "Denk One"
					,"Devonshire" => "Devonshire"
					,"Didact Gothic" => "Didact Gothic"
					,"Diplomata" => "Diplomata"
					,"Diplomata SC" => "Diplomata SC"
					,"Domine" => "Domine"
					,"Donegal One" => "Donegal One"
					,"Doppio One" => "Doppio One"
					,"Dorsa" => "Dorsa"
					,"Dosis" => "Dosis"
					,"Dr Sugiyama" => "Dr Sugiyama"
					,"Droid Sans" => "Droid Sans"
					,"Droid Sans Mono" => "Droid Sans Mono"
					,"Droid Serif" => "Droid Serif"
					,"Duru Sans" => "Duru Sans"
					,"Dynalight" => "Dynalight"
					,"EB Garamond" => "EB Garamond"
					,"Eagle Lake" => "Eagle Lake"
					,"Eater" => "Eater"
					,"Economica" => "Economica"
					,"Electrolize" => "Electrolize"
					,"Elsie" => "Elsie"
					,"Elsie Swash Caps" => "Elsie Swash Caps"
					,"Emblema One" => "Emblema One"
					,"Emilys Candy" => "Emilys Candy"
					,"Engagement" => "Engagement"
					,"Englebert" => "Englebert"
					,"Enriqueta" => "Enriqueta"
					,"Erica One" => "Erica One"
					,"Esteban" => "Esteban"
					,"Euphoria Script" => "Euphoria Script"
					,"Ewert" => "Ewert"
					,"Exo" => "Exo"
					,"Expletus Sans" => "Expletus Sans"
					,"Fanwood Text" => "Fanwood Text"
					,"Fascinate" => "Fascinate"
					,"Fascinate Inline" => "Fascinate Inline"
					,"Faster One" => "Faster One"
					,"Fasthand" => "Fasthand"
					,"Fauna One" => "Fauna One"
					,"Federant" => "Federant"
					,"Federo" => "Federo"
					,"Felipa" => "Felipa"
					,"Fenix" => "Fenix"
					,"Finger Paint" => "Finger Paint"
					,"Fjalla One" => "Fjalla One"
					,"Fjord One" => "Fjord One"
					,"Flamenco" => "Flamenco"
					,"Flavors" => "Flavors"
					,"Fondamento" => "Fondamento"
					,"Fontdiner Swanky" => "Fontdiner Swanky"
					,"Forum" => "Forum"
					,"Francois One" => "Francois One"
					,"Freckle Face" => "Freckle Face"
					,"Fredericka the Great" => "Fredericka the Great"
					,"Fredoka One" => "Fredoka One"
					,"Freehand" => "Freehand"
					,"Fresca" => "Fresca"
					,"Frijole" => "Frijole"
					,"Fruktur" => "Fruktur"
					,"Fugaz One" => "Fugaz One"
					,"GFS Didot" => "GFS Didot"
					,"GFS Neohellenic" => "GFS Neohellenic"
					,"Gabriela" => "Gabriela"
					,"Gafata" => "Gafata"
					,"Galdeano" => "Galdeano"
					,"Galindo" => "Galindo"
					,"Gentium Basic" => "Gentium Basic"
					,"Gentium Book Basic" => "Gentium Book Basic"
					,"Geo" => "Geo"
					,"Geostar" => "Geostar"
					,"Geostar Fill" => "Geostar Fill"
					,"Germania One" => "Germania One"
					,"Gilda Display" => "Gilda Display"
					,"Give You Glory" => "Give You Glory"
					,"Glass Antiqua" => "Glass Antiqua"
					,"Glegoo" => "Glegoo"
					,"Gloria Hallelujah" => "Gloria Hallelujah"
					,"Goblin One" => "Goblin One"
					,"Gochi Hand" => "Gochi Hand"
					,"Gorditas" => "Gorditas"
					,"Goudy Bookletter 1911" => "Goudy Bookletter 1911"
					,"Graduate" => "Graduate"
					,"Grand Hotel" => "Grand Hotel"
					,"Gravitas One" => "Gravitas One"
					,"Great Vibes" => "Great Vibes"
					,"Griffy" => "Griffy"
					,"Gruppo" => "Gruppo"
					,"Gudea" => "Gudea"
					,"Habibi" => "Habibi"
					,"Hammersmith One" => "Hammersmith One"
					,"Hanalei" => "Hanalei"
					,"Hanalei Fill" => "Hanalei Fill"
					,"Handlee" => "Handlee"
					,"Hanuman" => "Hanuman"
					,"Happy Monkey" => "Happy Monkey"
					,"Headland One" => "Headland One"
					,"Henny Penny" => "Henny Penny"
					,"Herr Von Muellerhoff" => "Herr Von Muellerhoff"
					,"Holtwood One SC" => "Holtwood One SC"
					,"Homemade Apple" => "Homemade Apple"
					,"Homenaje" => "Homenaje"
					,"IM Fell DW Pica" => "IM Fell DW Pica"
					,"IM Fell DW Pica SC" => "IM Fell DW Pica SC"
					,"IM Fell Double Pica" => "IM Fell Double Pica"
					,"IM Fell Double Pica SC" => "IM Fell Double Pica SC"
					,"IM Fell English" => "IM Fell English"
					,"IM Fell English SC" => "IM Fell English SC"
					,"IM Fell French Canon" => "IM Fell French Canon"
					,"IM Fell French Canon SC" => "IM Fell French Canon SC"
					,"IM Fell Great Primer" => "IM Fell Great Primer"
					,"IM Fell Great Primer SC" => "IM Fell Great Primer SC"
					,"Iceberg" => "Iceberg"
					,"Iceland" => "Iceland"
					,"Imprima" => "Imprima"
					,"Inconsolata" => "Inconsolata"
					,"Inder" => "Inder"
					,"Indie Flower" => "Indie Flower"
					,"Inika" => "Inika"
					,"Irish Grover" => "Irish Grover"
					,"Istok Web" => "Istok Web"
					,"Italiana" => "Italiana"
					,"Italianno" => "Italianno"
					,"Jacques Francois" => "Jacques Francois"
					,"Jacques Francois Shadow" => "Jacques Francois Shadow"
					,"Jim Nightshade" => "Jim Nightshade"
					,"Jockey One" => "Jockey One"
					,"Jolly Lodger" => "Jolly Lodger"
					,"Josefin Sans" => "Josefin Sans"
					,"Josefin Slab" => "Josefin Slab"
					,"Joti One" => "Joti One"
					,"Judson" => "Judson"
					,"Julee" => "Julee"
					,"Julius Sans One" => "Julius Sans One"
					,"Junge" => "Junge"
					,"Jura" => "Jura"
					,"Just Another Hand" => "Just Another Hand"
					,"Just Me Again Down Here" => "Just Me Again Down Here"
					,"Kameron" => "Kameron"
					,"Karla" => "Karla"
					,"Kaushan Script" => "Kaushan Script"
					,"Kavoon" => "Kavoon"
					,"Keania One" => "Keania One"
					,"Kelly Slab" => "Kelly Slab"
					,"Kenia" => "Kenia"
					,"Khmer" => "Khmer"
					,"Kite One" => "Kite One"
					,"Knewave" => "Knewave"
					,"Kotta One" => "Kotta One"
					,"Koulen" => "Koulen"
					,"Kranky" => "Kranky"
					,"Kreon" => "Kreon"
					,"Kristi" => "Kristi"
					,"Krona One" => "Krona One"
					,"La Belle Aurore" => "La Belle Aurore"
					,"Lancelot" => "Lancelot"
					,"Lato" => "Lato"
					,"League Script" => "League Script"
					,"Leckerli One" => "Leckerli One"
					,"Ledger" => "Ledger"
					,"Lekton" => "Lekton"
					,"Lemon" => "Lemon"
					,"Libre Baskerville" => "Libre Baskerville"
					,"Life Savers" => "Life Savers"
					,"Lilita One" => "Lilita One"
					,"Lily Script One" => "Lily Script One"
					,"Limelight" => "Limelight"
					,"Linden Hill" => "Linden Hill"
					,"Lobster" => "Lobster"
					,"Lobster Two" => "Lobster Two"
					,"Londrina Outline" => "Londrina Outline"
					,"Londrina Shadow" => "Londrina Shadow"
					,"Londrina Sketch" => "Londrina Sketch"
					,"Londrina Solid" => "Londrina Solid"
					,"Lora" => "Lora"
					,"Love Ya Like A Sister" => "Love Ya Like A Sister"
					,"Loved by the King" => "Loved by the King"
					,"Lovers Quarrel" => "Lovers Quarrel"
					,"Luckiest Guy" => "Luckiest Guy"
					,"Lusitana" => "Lusitana"
					,"Lustria" => "Lustria"
					,"Macondo" => "Macondo"
					,"Macondo Swash Caps" => "Macondo Swash Caps"
					,"Magra" => "Magra"
					,"Maiden Orange" => "Maiden Orange"
					,"Mako" => "Mako"
					,"Marcellus" => "Marcellus"
					,"Marcellus SC" => "Marcellus SC"
					,"Marck Script" => "Marck Script"
					,"Margarine" => "Margarine"
					,"Marko One" => "Marko One"
					,"Marmelad" => "Marmelad"
					,"Marvel" => "Marvel"
					,"Mate" => "Mate"
					,"Mate SC" => "Mate SC"
					,"Maven Pro" => "Maven Pro"
					,"McLaren" => "McLaren"
					,"Meddon" => "Meddon"
					,"MedievalSharp" => "MedievalSharp"
					,"Medula One" => "Medula One"
					,"Megrim" => "Megrim"
					,"Meie Script" => "Meie Script"
					,"Merienda" => "Merienda"
					,"Merienda One" => "Merienda One"
					,"Merriweather" => "Merriweather"
					,"Merriweather Sans" => "Merriweather Sans"
					,"Metal" => "Metal"
					,"Metal Mania" => "Metal Mania"
					,"Metamorphous" => "Metamorphous"
					,"Metrophobic" => "Metrophobic"
					,"Michroma" => "Michroma"
					,"Milonga" => "Milonga"
					,"Miltonian" => "Miltonian"
					,"Miltonian Tattoo" => "Miltonian Tattoo"
					,"Miniver" => "Miniver"
					,"Miss Fajardose" => "Miss Fajardose"
					,"Modern Antiqua" => "Modern Antiqua"
					,"Molengo" => "Molengo"
					,"Molle" => "Molle"
					,"Monda" => "Monda"
					,"Monofett" => "Monofett"
					,"Monoton" => "Monoton"
					,"Monsieur La Doulaise" => "Monsieur La Doulaise"
					,"Montaga" => "Montaga"
					,"Montez" => "Montez"
					,"Montserrat" => "Montserrat"
					,"Montserrat Alternates" => "Montserrat Alternates"
					,"Montserrat Subrayada" => "Montserrat Subrayada"
					,"Moul" => "Moul"
					,"Moulpali" => "Moulpali"
					,"Mountains of Christmas" => "Mountains of Christmas"
					,"Mouse Memoirs" => "Mouse Memoirs"
					,"Mr Bedfort" => "Mr Bedfort"
					,"Mr Dafoe" => "Mr Dafoe"
					,"Mr De Haviland" => "Mr De Haviland"
					,"Mrs Saint Delafield" => "Mrs Saint Delafield"
					,"Mrs Sheppards" => "Mrs Sheppards"
					,"Muli" => "Muli"
					,"Mystery Quest" => "Mystery Quest"
					,"Neucha" => "Neucha"
					,"Neuton" => "Neuton"
					,"New Rocker" => "New Rocker"
					,"News Cycle" => "News Cycle"
					,"Niconne" => "Niconne"
					,"Nixie One" => "Nixie One"
					,"Nobile" => "Nobile"
					,"Nokora" => "Nokora"
					,"Norican" => "Norican"
					,"Nosifer" => "Nosifer"
					,"Nothing You Could Do" => "Nothing You Could Do"
					,"Noticia Text" => "Noticia Text"
					,"Noto Sans" => "Noto Sans"
					,"Noto Serif" => "Noto Serif"
					,"Nova Cut" => "Nova Cut"
					,"Nova Flat" => "Nova Flat"
					,"Nova Mono" => "Nova Mono"
					,"Nova Oval" => "Nova Oval"
					,"Nova Round" => "Nova Round"
					,"Nova Script" => "Nova Script"
					,"Nova Slim" => "Nova Slim"
					,"Nova Square" => "Nova Square"
					,"Numans" => "Numans"
					,"Nunito" => "Nunito"
					,"Odor Mean Chey" => "Odor Mean Chey"
					,"Offside" => "Offside"
					,"Old Standard TT" => "Old Standard TT"
					,"Oldenburg" => "Oldenburg"
					,"Oleo Script" => "Oleo Script"
					,"Oleo Script Swash Caps" => "Oleo Script Swash Caps"
					,"Open Sans" => "Open Sans"
					,"Open Sans Condensed" => "Open Sans Condensed"
					,"Oranienbaum" => "Oranienbaum"
					,"Orbitron" => "Orbitron"
					,"Oregano" => "Oregano"
					,"Orienta" => "Orienta"
					,"Original Surfer" => "Original Surfer"
					,"Oswald" => "Oswald"
					,"Over the Rainbow" => "Over the Rainbow"
					,"Overlock" => "Overlock"
					,"Overlock SC" => "Overlock SC"
					,"Ovo" => "Ovo"
					,"Oxygen" => "Oxygen"
					,"Oxygen Mono" => "Oxygen Mono"
					,"PT Mono" => "PT Mono"
					,"PT Sans" => "PT Sans"
					,"PT Sans Caption" => "PT Sans Caption"
					,"PT Sans Narrow" => "PT Sans Narrow"
					,"PT Serif" => "PT Serif"
					,"PT Serif Caption" => "PT Serif Caption"
					,"Pacifico" => "Pacifico"
					,"Paprika" => "Paprika"
					,"Parisienne" => "Parisienne"
					,"Passero One" => "Passero One"
					,"Passion One" => "Passion One"
					,"Pathway Gothic One" => "Pathway Gothic One"
					,"Patrick Hand" => "Patrick Hand"
					,"Patrick Hand SC" => "Patrick Hand SC"
					,"Patua One" => "Patua One"
					,"Paytone One" => "Paytone One"
					,"Peralta" => "Peralta"
					,"Permanent Marker" => "Permanent Marker"
					,"Petit Formal Script" => "Petit Formal Script"
					,"Petrona" => "Petrona"
					,"Philosopher" => "Philosopher"
					,"Piedra" => "Piedra"
					,"Pinyon Script" => "Pinyon Script"
					,"Pirata One" => "Pirata One"
					,"Plaster" => "Plaster"
					,"Play" => "Play"
					,"Playball" => "Playball"
					,"Playfair Display" => "Playfair Display"
					,"Playfair Display SC" => "Playfair Display SC"
					,"Podkova" => "Podkova"
					,"Poiret One" => "Poiret One"
					,"Poller One" => "Poller One"
					,"Poly" => "Poly"
					,"Pompiere" => "Pompiere"
					,"Pontano Sans" => "Pontano Sans"
					,"Poppins" => "Poppins"
					,"Port Lligat Sans" => "Port Lligat Sans"
					,"Port Lligat Slab" => "Port Lligat Slab"
					,"Prata" => "Prata"
					,"Preahvihear" => "Preahvihear"
					,"Press Start 2P" => "Press Start 2P"
					,"Princess Sofia" => "Princess Sofia"
					,"Prociono" => "Prociono"
					,"Prosto One" => "Prosto One"
					,"Puritan" => "Puritan"
					,"Purple Purse" => "Purple Purse"
					,"Quando" => "Quando"
					,"Quantico" => "Quantico"
					,"Quattrocento" => "Quattrocento"
					,"Quattrocento Sans" => "Quattrocento Sans"
					,"Questrial" => "Questrial"
					,"Quicksand" => "Quicksand"
					,"Quintessential" => "Quintessential"
					,"Qwigley" => "Qwigley"
					,"Racing Sans One" => "Racing Sans One"
					,"Radley" => "Radley"
					,"Raleway" => "Raleway"
					,"Raleway Dots" => "Raleway Dots"
					,"Rambla" => "Rambla"
					,"Rammetto One" => "Rammetto One"
					,"Ranchers" => "Ranchers"
					,"Rancho" => "Rancho"
					,"Rationale" => "Rationale"
					,"Redressed" => "Redressed"
					,"Reenie Beanie" => "Reenie Beanie"
					,"Revalia" => "Revalia"
					,"Ribeye" => "Ribeye"
					,"Ribeye Marrow" => "Ribeye Marrow"
					,"Righteous" => "Righteous"
					,"Risque" => "Risque"
					,"Roboto" => "Roboto"
					,"Roboto Condensed" => "Roboto Condensed"
					,"Roboto Slab" => "Roboto Slab"
					,"Rochester" => "Rochester"
					,"Rock Salt" => "Rock Salt"
					,"Rokkitt" => "Rokkitt"
					,"Romanesco" => "Romanesco"
					,"Ropa Sans" => "Ropa Sans"
					,"Rosario" => "Rosario"
					,"Rosarivo" => "Rosarivo"
					,"Rouge Script" => "Rouge Script"
					,"Ruda" => "Ruda"
					,"Rufina" => "Rufina"
					,"Ruge Boogie" => "Ruge Boogie"
					,"Ruluko" => "Ruluko"
					,"Rum Raisin" => "Rum Raisin"
					,"Ruslan Display" => "Ruslan Display"
					,"Russo One" => "Russo One"
					,"Ruthie" => "Ruthie"
					,"Rye" => "Rye"
					,"Sacramento" => "Sacramento"
					,"Sail" => "Sail"
					,"Salsa" => "Salsa"
					,"Sanchez" => "Sanchez"
					,"Sancreek" => "Sancreek"
					,"Sansita One" => "Sansita One"
					,"Sarina" => "Sarina"
					,"Satisfy" => "Satisfy"
					,"Scada" => "Scada"
					,"Schoolbell" => "Schoolbell"
					,"Seaweed Script" => "Seaweed Script"
					,"Sevillana" => "Sevillana"
					,"Seymour One" => "Seymour One"
					,"Shadows Into Light" => "Shadows Into Light"
					,"Shadows Into Light Two" => "Shadows Into Light Two"
					,"Shanti" => "Shanti"
					,"Share" => "Share"
					,"Share Tech" => "Share Tech"
					,"Share Tech Mono" => "Share Tech Mono"
					,"Shojumaru" => "Shojumaru"
					,"Short Stack" => "Short Stack"
					,"Siemreap" => "Siemreap"
					,"Sigmar One" => "Sigmar One"
					,"Signika" => "Signika"
					,"Signika Negative" => "Signika Negative"
					,"Simonetta" => "Simonetta"
					,"Sintony" => "Sintony"
					,"Sirin Stencil" => "Sirin Stencil"
					,"Six Caps" => "Six Caps"
					,"Skranji" => "Skranji"
					,"Slackey" => "Slackey"
					,"Smokum" => "Smokum"
					,"Smythe" => "Smythe"
					,"Sniglet" => "Sniglet"
					,"Snippet" => "Snippet"
					,"Snowburst One" => "Snowburst One"
					,"Sofadi One" => "Sofadi One"
					,"Sofia" => "Sofia"
					,"Sonsie One" => "Sonsie One"
					,"Sorts Mill Goudy" => "Sorts Mill Goudy"
					,"Source Code Pro" => "Source Code Pro"
					,"Source Sans Pro" => "Source Sans Pro"
					,"Special Elite" => "Special Elite"
					,"Spicy Rice" => "Spicy Rice"
					,"Spinnaker" => "Spinnaker"
					,"Spirax" => "Spirax"
					,"Squada One" => "Squada One"
					,"Stalemate" => "Stalemate"
					,"Stalinist One" => "Stalinist One"
					,"Stardos Stencil" => "Stardos Stencil"
					,"Stint Ultra Condensed" => "Stint Ultra Condensed"
					,"Stint Ultra Expanded" => "Stint Ultra Expanded"
					,"Stoke" => "Stoke"
					,"Strait" => "Strait"
					,"Sue Ellen Francisco" => "Sue Ellen Francisco"
					,"Sunshiney" => "Sunshiney"
					,"Supermercado One" => "Supermercado One"
					,"Suwannaphum" => "Suwannaphum"
					,"Swanky and Moo Moo" => "Swanky and Moo Moo"
					,"Syncopate" => "Syncopate"
					,"Tangerine" => "Tangerine"
					,"Taprom" => "Taprom"
					,"Tauri" => "Tauri"
					,"Telex" => "Telex"
					,"Tenor Sans" => "Tenor Sans"
					,"Text Me One" => "Text Me One"
					,"The Girl Next Door" => "The Girl Next Door"
					,"Tienne" => "Tienne"
					,"Tinos" => "Tinos"
					,"Titan One" => "Titan One"
					,"Titillium Web" => "Titillium Web"
					,"Trade Winds" => "Trade Winds"
					,"Trocchi" => "Trocchi"
					,"Trochut" => "Trochut"
					,"Trykker" => "Trykker"
					,"Tulpen One" => "Tulpen One"
					,"Ubuntu" => "Ubuntu"
					,"Ubuntu Condensed" => "Ubuntu Condensed"
					,"Ubuntu Mono" => "Ubuntu Mono"
					,"Ultra" => "Ultra"
					,"Uncial Antiqua" => "Uncial Antiqua"
					,"Underdog" => "Underdog"
					,"Unica One" => "Unica One"
					,"UnifrakturCook" => "UnifrakturCook"
					,"UnifrakturMaguntia" => "UnifrakturMaguntia"
					,"Unkempt" => "Unkempt"
					,"Unlock" => "Unlock"
					,"Unna" => "Unna"
					,"VT323" => "VT323"
					,"Vampiro One" => "Vampiro One"
					,"Varela" => "Varela"
					,"Varela Round" => "Varela Round"
					,"Vast Shadow" => "Vast Shadow"
					,"Vibur" => "Vibur"
					,"Vidaloka" => "Vidaloka"
					,"Viga" => "Viga"
					,"Voces" => "Voces"
					,"Volkhov" => "Volkhov"
					,"Vollkorn" => "Vollkorn"
					,"Voltaire" => "Voltaire"
					,"Waiting for the Sunrise" => "Waiting for the Sunrise"
					,"Wallpoet" => "Wallpoet"
					,"Walter Turncoat" => "Walter Turncoat"
					,"Warnes" => "Warnes"
					,"Wellfleet" => "Wellfleet"
					,"Wendy One" => "Wendy One"
					,"Wire One" => "Wire One"
					,"Yanone Kaffeesatz" => "Yanone Kaffeesatz"
					,"Yellowtail" => "Yellowtail"
					,"Yeseva One" => "Yeseva One"
					,"Yesteryear" => "Yesteryear"
					,"Zeyada" => "Zeyada"
				);
				
	return apply_filters('boxshop_list_google_fonts', $fonts);
}
?>
