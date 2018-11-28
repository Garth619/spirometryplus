<?php
$options = array();
$default_sidebars = boxshop_get_list_sidebars();
$sidebar_options = array();
foreach( $default_sidebars as $key => $_sidebar ){
	$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
}

/* Get list menus */
$menus = array('0' => esc_html__('Default', 'boxshop'));
$nav_terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
if( is_array($nav_terms) ){
	foreach( $nav_terms as $term ){
		$menus[$term->term_id] = $term->name;
	}
}

/* Get list Footer Blocks */
$footer_blocks = array('0' => esc_html__('Default', 'boxshop'));

$args = array(
	'post_type'			=> 'ts_footer_block'
	,'post_status'	 	=> 'publish'
	,'posts_per_page' 	=> -1
);

$posts = new WP_Query($args);

if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
	foreach( $posts->posts as $p ){
		$footer_blocks[$p->ID] = $p->post_title;
	}
}

wp_reset_postdata();

$options[] = array(
				'id'		=> 'page_layout_heading'
				,'label'	=> esc_html__('Page Layout', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);

$options[] = array(
				'id'		=> 'layout_style'
				,'label'	=> esc_html__('Layout Style', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
									'default'  	=> esc_html__('Default', 'boxshop')
									,'boxed' 	=> esc_html__('Boxed', 'boxshop')
									,'wide' 	=> esc_html__('Wide', 'boxshop')
								)
			);
			
$options[] = array(
				'id'		=> 'page_layout'
				,'label'	=> esc_html__('Page Layout', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
									'0-1-0'  => esc_html__('Fullwidth', 'boxshop')
									,'1-1-0' => esc_html__('Left Sidebar', 'boxshop')
									,'0-1-1' => esc_html__('Right Sidebar', 'boxshop')
									,'1-1-1' => esc_html__('Left & Right Sidebar', 'boxshop')
								)
			);
			
$options[] = array(
				'id'		=> 'left_sidebar'
				,'label'	=> esc_html__('Left Sidebar', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $sidebar_options
			);

$options[] = array(
				'id'		=> 'right_sidebar'
				,'label'	=> esc_html__('Right Sidebar', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $sidebar_options
			);
			
$options[] = array(
				'id'		=> 'header_breadcrumb_heading'
				,'label'	=> esc_html__('Header - Breadcrumb', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);
			
$options[] = array(
				'id'		=> 'header_layout'
				,'label'	=> esc_html__('Header Layout', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
									'default'  	=> esc_html__('Default', 'boxshop')
									,'v1'  		=> esc_html__('Header Layout 1', 'boxshop')
									,'v2' 		=> esc_html__('Header Layout 2', 'boxshop')
									,'v3' 		=> esc_html__('Header Layout 3', 'boxshop')
									,'v4' 		=> esc_html__('Header Layout 4', 'boxshop')
									,'v5' 		=> esc_html__('Header Layout 5', 'boxshop')
									,'v6' 		=> esc_html__('Header Layout 6', 'boxshop')
									,'v7' 		=> esc_html__('Header Layout 7', 'boxshop')
								)
			);
			
$options[] = array(
				'id'		=> 'top_header_transparent'
				,'label'	=> esc_html__('Top Header Transparent', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
								'1'		=> esc_html__('Yes', 'boxshop')
								,'0'	=> esc_html__('No', 'boxshop')
								)
				,'default'	=> '0'
			);
			
$options[] = array(
				'id'		=> 'top_header_text_color'
				,'label'	=> esc_html__('Top Header Text Color', 'boxshop')
				,'desc'		=> esc_html__('Available when Top Header Transparent is enabled', 'boxshop')
				,'type'		=> 'select'
				,'options'	=> array(
								'default'	=> esc_html__('Default', 'boxshop')
								,'light'	=> esc_html__('Light', 'boxshop')
								)
			);

$options[] = array(
				'id'		=> 'menu_id'
				,'label'	=> esc_html__('Primary Menu', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $menus
			);
			
$options[] = array(
				'id'		=> 'display_vertical_menu_by_default'
				,'label'	=> esc_html__('Display Vertical Menu By Default', 'boxshop')
				,'desc'		=> esc_html__('If this option is enabled, you wont need to hover to see the vertical menu', 'boxshop')
				,'type'		=> 'select'
				,'default'	=> 0
				,'options'	=> array(
								'1'		=> esc_html__('Yes', 'boxshop')
								,'0'	=> esc_html__('No', 'boxshop')
								)
			);
			
$options[] = array(
				'id'		=> 'show_page_title'
				,'label'	=> esc_html__('Show Page Title', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
								'1'		=> esc_html__('Yes', 'boxshop')
								,'0'	=> esc_html__('No', 'boxshop')
								)
			);
			
$options[] = array(
				'id'		=> 'show_breadcrumb'
				,'label'	=> esc_html__('Show Breadcrumb', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
								'1'		=> esc_html__('Yes', 'boxshop')
								,'0'	=> esc_html__('No', 'boxshop')
								)
			);
			
$options[] = array(
				'id'		=> 'breadcrumb_layout'
				,'label'	=> esc_html__('Breadcrumb Layout', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
									'default'  	=> esc_html__('Default', 'boxshop')
									,'v1'  		=> esc_html__('Breadcrumb Layout 1', 'boxshop')
									,'v2' 		=> esc_html__('Breadcrumb Layout 2', 'boxshop')
									,'v3' 		=> esc_html__('Breadcrumb Layout 3', 'boxshop')
								)
			);
			
$options[] = array(
				'id'		=> 'breadcrumb_bg_parallax'
				,'label'	=> esc_html__('Breadcrumb Background Parallax', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
								'default'  	=> esc_html__('Default', 'boxshop')
								,'1'		=> esc_html__('Yes', 'boxshop')
								,'0'		=> esc_html__('No', 'boxshop')
								)
			);
			
$options[] = array(
				'id'		=> 'bg_breadcrumbs'
				,'label'	=> esc_html__('Breadcrumb Background Image', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'upload'
			);	
			
$options[] = array(
				'id'		=> 'logo'
				,'label'	=> esc_html__('Logo', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'upload'
			);
			
$options[] = array(
				'id'		=> 'logo_mobile'
				,'label'	=> esc_html__('Mobile Logo', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'upload'
			);
			
$options[] = array(
				'id'		=> 'logo_sticky'
				,'label'	=> esc_html__('Sticky Logo', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'upload'
			);

$options[] = array(
				'id'		=> 'page_slider_heading'
				,'label'	=> esc_html__('Page Slider', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);			
			
$revolution_exists = class_exists('RevSliderSlider');

$page_sliders = array();
$page_sliders[0] = esc_html__('No Slider', 'boxshop');
if( $revolution_exists ){
	$page_sliders['revslider']	= esc_html__('Revolution Slider', 'boxshop');
}

$options[] = array(
				'id'		=> 'page_slider'
				,'label'	=> esc_html__('Page Slider', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $page_sliders
			);
			
$options[] = array(
				'id'		=> 'page_slider_position'
				,'label'	=> esc_html__('Page Slider Position', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
							'before_header'			=> esc_html__('Before Header', 'boxshop')
							,'before_main_content'	=> esc_html__('Before Main Content', 'boxshop')
							)
				,'default'	=> 'before_main_content'
			);

if( $revolution_exists ){
	global $wpdb;
	$revsliders = array();
	$revsliders[0] = esc_html__('Select a slider', 'boxshop');
	$sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
	if( $sliders ) {
		foreach( $sliders as $slider ) {
			$revsliders[$slider->id] = $slider->title;
		}
	}
				
	$options[] = array(
					'id'		=> 'rev_slider'
					,'label'	=> esc_html__('Select Revolution Slider', 'boxshop')
					,'desc'		=> ''
					,'type'		=> 'select'
					,'options'	=> $revsliders
				);
}

$options[] = array(
				'id'		=> 'page_footer_heading'
				,'label'	=> esc_html__('Page Footer', 'boxshop')
				,'desc'		=> esc_html__('You also need to add the TS - Footer Block widget to Footer (Copyright) Widget Area', 'boxshop')
				,'type'		=> 'heading'
			);
	
$options[] = array(
				'id'		=> 'footer_id'
				,'label'	=> esc_html__('Footer Widget Area', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $footer_blocks
			);
	
$options[] = array(
				'id'		=> 'footer_copyright_id'
				,'label'	=> esc_html__('Footer Copyright Widget Area', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $footer_blocks
			);
?>
