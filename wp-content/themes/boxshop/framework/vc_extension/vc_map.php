<?php 
add_action( 'vc_before_init', 'boxshop_integrate_with_vc' );
function boxshop_integrate_with_vc() {
	
	if( !function_exists('vc_map') ){
		return;
	}

	/********************** Content Shortcodes ***************************/
	/*** TS Features ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Feature', 'boxshop' ),
		'base' 		=> 'ts_feature',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'boxshop' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Horizontal', 'boxshop')	=>  'feature-horizontal'
						,esc_html__('Vertical', 'boxshop')	=>  'feature-vertical'	
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Horizontal style', 'boxshop' )
				,'param_name' 	=> 'horizontal_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('small icon', 'boxshop')	=> 'icon-small'
							,esc_html__('big icon', 'boxshop')	=> 'icon-big'
							)
				,'dependency' 	=> array('element' => 'style', 'value' => array('feature-horizontal'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Icon class', 'boxshop' )
				,'param_name' 	=> 'class_icon'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Use Pe-icon-7-stroke in site http://themes-pixeden.com/font-demos/7-stroke/index.html', 'boxshop')
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image Thumbnail', 'boxshop' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency'  	=> array('element' => 'style', 'value' => array('feature-vertical'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Thumbnail URL', 'boxshop' )
				,'param_name' 	=> 'img_url'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'boxshop')
				,'dependency' 	=> array('element' => 'style', 'value' => array('feature-vertical'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail Hover Effect', 'boxshop' )
				,'param_name' 	=> 'thumbnail_hover_effect'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Yes', 'boxshop')				=>  1	
						,esc_html__('No', 'boxshop')				=>  0
						)
				,'description' 	=> ''
				,'dependency' 	=> array('element' => 'style', 'value' => array('feature-vertical'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Has border', 'boxshop' )
				,'param_name' 	=> 'has_border'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Yes', 'boxshop')				=>  1	
						,esc_html__('No', 'boxshop')				=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Border color', 'boxshop' )
				,'param_name' 	=> 'border_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ebebeb'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'has_border', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Has background color', 'boxshop' )
				,'param_name' 	=> 'has_background'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('No', 'boxshop')				=>  0
						,esc_html__('Yes', 'boxshop')			=>  1	
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color', 'boxshop' )
				,'param_name' 	=> 'background_color'
				,'admin_label' 	=> false
				,'value' 		=> '#f8f8f8'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'has_background', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Feature title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Short description', 'boxshop' )
				,'param_name' 	=> 'excerpt'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text style', 'boxshop' )
				,'param_name' 	=> 'text_style'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('defaut', 'boxshop')				=>  'text-default'
						,esc_html__('light', 'boxshop')				=>  'text-light'	
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Active feature', 'boxshop' )
				,'param_name' 	=> 'active_feature'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('No', 'boxshop')				=>  0
						,esc_html__('Yes', 'boxshop')			=>  1	
						)
				,'description' 	=> esc_html__( 'Enable this option if you want title to be highlighted without hovering', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'boxshop' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'boxshop' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('New Window Tab', 'boxshop')	=>  '_blank'
						,esc_html__('Self', 'boxshop')			=>  '_self'	
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra class', 'boxshop' )
				,'param_name' 	=> 'extra_class'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Price Table ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Price Table', 'boxshop' ),
		'base' 		=> 'ts_price_table',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title Table', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Color Scheme', 'boxshop' )
				,'param_name' 	=> 'color_scheme'
				,'admin_label' 	=> false
				,'value' 		=> '#e5493a'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Price', 'boxshop' )
				,'param_name' 	=> 'price'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Currency', 'boxshop' )
				,'param_name' 	=> 'currency'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'During Price', 'boxshop' )
				,'param_name' 	=> 'during_price'
				,'admin_label' 	=> true
				,'value' 		=> '/month'
				,'description' 	=> esc_html__('Ex: /day, /month, /year', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'During Price Description', 'boxshop' )
				,'param_name' 	=> 'during_price_description'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Ex: 30 days free trial', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Rating', 'boxshop' )
				,'param_name' 	=> 'rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							'0'		=> 0
							,'1'	=> 1
							,'1.5'	=> 1.5
							,'2'	=> 2
							,'2.5'	=> 2.5
							,'3'	=> 3
							,'3.5'	=> 3.5
							,'4'	=> 4
							,'4.5'	=> 4.5
							,'5'	=> 5
						)
				,'description' 	=> esc_html__('Select 0 to remove rating', 'boxshop')
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Description', 'boxshop' )
				,'param_name' 	=> 'description'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Accept the ul, li, b, strong and i tags', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Button text', 'boxshop' )
				,'param_name' 	=> 'button_text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'boxshop' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> false
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Active Table', 'boxshop' )
				,'param_name' 	=> 'active_table'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Blogs ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Blogs', 'boxshop' ),
		'base' 		=> 'ts_blogs',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Layout', 'boxshop' )
				,'param_name' 	=> 'layout'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Grid', 'boxshop')		=> 'grid'
							,esc_html__('Slider', 'boxshop')	=> 'slider'
							,esc_html__('Masonry', 'boxshop')	=> 'masonry'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'boxshop' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(
							'1'				=> '1'
							,'2'			=> '2'
							,'3'			=> '3'
							,'4'			=> '4'
							)
				,'description' 	=> esc_html__( 'Number of Columns', 'boxshop' )
				,'std'			=> '3'
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Posts', 'boxshop' )
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'boxshop' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'post_cat'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'boxshop' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('None', 'boxshop')		=> 'none'
						,esc_html__('ID', 'boxshop')		=> 'ID'
						,esc_html__('Date', 'boxshop')		=> 'date'
						,esc_html__('Name', 'boxshop')		=> 'name'
						,esc_html__('Title', 'boxshop')		=> 'title'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'boxshop' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Descending', 'boxshop')	=> 'DESC'
						,esc_html__('Ascending', 'boxshop')	=> 'ASC'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post title', 'boxshop' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show thumbnail', 'boxshop' )
				,'param_name' 	=> 'show_thumbnail'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show author', 'boxshop' )
				,'param_name' 	=> 'show_author'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show comment', 'boxshop' )
				,'param_name' 	=> 'show_comment'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show view', 'boxshop' )
				,'param_name' 	=> 'show_view'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show date', 'boxshop' )
				,'param_name' 	=> 'show_date'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post excerpt', 'boxshop' )
				,'param_name' 	=> 'show_excerpt'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show read more button', 'boxshop' )
				,'param_name' 	=> 'show_readmore'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'boxshop' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> false
				,'value' 		=> '18'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show load more button', 'boxshop' )
				,'param_name' 	=> 'show_load_more'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')	=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Load more button text', 'boxshop' )
				,'param_name' 	=> 'load_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Show more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'boxshop' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> '20'
				,'description' 	=> esc_html__('Set margin between items', 'boxshop')
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
		)
	) );

	/*** TS Button ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Button', 'boxshop' ),
		'base' 		=> 'ts_button',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Text', 'boxshop' )
				,'param_name' 	=> 'content'
				,'admin_label' 	=> true
				,'value' 		=> 'Button text'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'boxshop' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Text color', 'boxshop' )
				,'param_name' 	=> 'text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#000000'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Text color hover', 'boxshop' )
				,'param_name' 	=> 'text_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color', 'boxshop' )
				,'param_name' 	=> 'bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color hover', 'boxshop' )
				,'param_name' 	=> 'bg_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#000000'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Border color', 'boxshop' )
				,'param_name' 	=> 'border_color'
				,'admin_label' 	=> false
				,'value' 		=> '#cccccc'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Border color hover', 'boxshop' )
				,'param_name' 	=> 'border_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#000000'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Border width', 'boxshop' )
				,'param_name' 	=> 'border_width'
				,'admin_label' 	=> false
				,'value' 		=> '0'
				,'description' 	=> esc_html__('In pixels. Ex: 1', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'boxshop' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Self', 'boxshop')				=> '_self'
						,esc_html__('New Window Tab', 'boxshop')	=> '_blank'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Size', 'boxshop' )
				,'param_name' 	=> 'size'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Small', 'boxshop')		=> 'small'
						,esc_html__('Medium', 'boxshop')	=> 'medium'
						,esc_html__('Large', 'boxshop')		=> 'large'
						,esc_html__('X-Large', 'boxshop')	=> 'x-large'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Font icon', 'boxshop' )
				,'param_name' 	=> 'font_icon'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'settings' 	=> array(
					'emptyIcon' 	=> true /* default true, display an "EMPTY" icon? */
					,'iconsPerPage' => 4000 /* default 100, how many icons per/page to display */
				)
				,'description' 	=> esc_html__('Add an icon before the text. Ex: fa-lock', 'boxshop')
			)
		)
	) );
	
	/*** TS Single Image ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Single Image', 'boxshop' ),
		'base' 		=> 'ts_single_image',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image', 'boxshop' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Size', 'boxshop' )
				,'param_name' 	=> 'img_size'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Ex: thumbnail, medium, large or full', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image URL', 'boxshop' )
				,'param_name' 	=> 'img_url'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'boxshop' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link Title', 'boxshop' )
				,'param_name' 	=> 'link_title'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Hover Effect', 'boxshop' )
				,'param_name' 	=> 'style_effect'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Widespread Left Right', 'boxshop')		=> 'eff-widespread-corner-left-right'
						,esc_html__('Border Scale', 'boxshop')				=> 'eff-border-scale'
						,esc_html__('Image Scale', 'boxshop')				=> 'eff-image-scale'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Effect Color', 'boxshop' )
				,'param_name' 	=> 'effect_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'boxshop' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('New Window Tab', 'boxshop')	=> '_blank'
						,esc_html__('Self', 'boxshop')			=> '_self'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Heading ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Heading', 'boxshop' ),
		'base' 		=> 'ts_heading',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Heading Size', 'boxshop' )
				,'param_name' 	=> 'size'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'1'				=> '1'
						,'2'			=> '2'
						,'3'			=> '3'
						,'4'			=> '4'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Text', 'boxshop' )
				,'param_name' 	=> 'text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'boxshop' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__( 'Default', 'boxshop')	=> 'default'
						,esc_html__( 'Center', 'boxshop')	=> 'center'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Banner ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Banner', 'boxshop' ),
		'base' 		=> 'ts_banner',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Background Image', 'boxshop' )
				,'param_name' 	=> 'bg_id'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Background Url', 'boxshop' )
				,'param_name' 	=> 'bg_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'boxshop')
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background Color', 'boxshop' )
				,'param_name' 	=> 'bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Heading Text Small', 'boxshop' )
				,'param_name' 	=> 'heading_title_small'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Allow add the span tag. To add class, use the single quote(\')', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Heading Text', 'boxshop' )
				,'param_name' 	=> 'heading_title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Allow add the span tag. To add class, use the single quote(\')', 'boxshop')
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Text Color', 'boxshop' )
				,'param_name' 	=> 'text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Description', 'boxshop' )
				,'param_name' 	=> 'description'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Align', 'boxshop' )
				,'param_name' 	=> 'text_align'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Left', 'boxshop')		=> 	'text-left'
							,esc_html__('Center', 'boxshop')	=>  'text-center'
							,esc_html__('Right', 'boxshop')		=> 	'text-right'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show Button', 'boxshop' )
				,'param_name' 	=> 'show_button'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Button Text', 'boxshop' )
				,'param_name' 	=> 'button_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Shop now'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Text Color', 'boxshop' )
				,'param_name' 	=> 'button_text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#000000'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Background Color', 'boxshop' )
				,'param_name' 	=> 'button_background_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Text Color Hover', 'boxshop' )
				,'param_name' 	=> 'button_text_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Background Color Hover', 'boxshop' )
				,'param_name' 	=> 'button_background_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#e72304'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Banner Content Position', 'boxshop' )
				,'param_name' 	=> 'position_content'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Left Top', 'boxshop')		=>  'left-top'
						,esc_html__('Left Bottom', 'boxshop')	=>  'left-bottom'
						,esc_html__('Left Center', 'boxshop')	=>  'left-center'
						,esc_html__('Right Top', 'boxshop')		=>  'right-top'
						,esc_html__('Right Bottom', 'boxshop')	=>  'right-bottom'
						,esc_html__('Right Center', 'boxshop')	=>  'right-center'
						,esc_html__('Center Top', 'boxshop')	=>  'center-top'
						,esc_html__('Center Bottom', 'boxshop')	=>  'center-bottom'
						,esc_html__('Center Center', 'boxshop')	=>  'center-center'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'boxshop' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'boxshop' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('New Window Tab', 'boxshop')	=>  '_blank'
							,esc_html__('Self', 'boxshop')			=>  '_self'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link Title', 'boxshop' )
				,'param_name' 	=> 'link_title'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style Effect', 'boxshop' )
				,'param_name' 	=> 'style_effect'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Background Scale', 'boxshop')					=>  'background-scale'
						,esc_html__('Background Scale Opacity', 'boxshop')			=>  'background-scale-opacity'
						,esc_html__('Background Scale Dark', 'boxshop')				=>	'background-scale-dark'
						,esc_html__('Background Scale and Line', 'boxshop')			=>  'background-scale-and-line'
						,esc_html__('Background Scale Opacity and Line', 'boxshop')	=>  'background-scale-opacity-line'
						,esc_html__('Background Scale Dark and Line', 'boxshop')	=>  'background-scale-dark-line'
						,esc_html__('Background Opacity and Line', 'boxshop')		=>	'background-opacity-and-line'
						,esc_html__('Background Dark and Line', 'boxshop')			=>	'background-dark-and-line'
						,esc_html__('Background Opacity', 'boxshop')				=>	'background-opacity'
						,esc_html__('Background Dark', 'boxshop')					=>	'background-dark'
						,esc_html__('Line', 'boxshop')								=>	'eff-line'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Responsive size', 'boxshop' )
				,'param_name' 	=> 'responsive_size'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra Class', 'boxshop' )
				,'param_name' 	=> 'extra_class'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Banner 2 ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Banner 2', 'boxshop' ),
		'base' 		=> 'ts_banner_image',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image Background', 'boxshop' )
				,'param_name' 	=> 'img_bg_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Background URL', 'boxshop' )
				,'param_name' 	=> 'img_bg_url'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'boxshop')
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image Text', 'boxshop' )
				,'param_name' 	=> 'img_text_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Display this image before, after or over the main image', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Text URL', 'boxshop' )
				,'param_name' 	=> 'img_text_url'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Size', 'boxshop' )
				,'param_name' 	=> 'img_size'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Ex: thumbnail, medium, large or full', 'boxshop' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image Text Position', 'boxshop' )
				,'param_name' 	=> 'position_img_text'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Left Top', 'boxshop')		=>  'left-top'
						,esc_html__('Left Bottom', 'boxshop')	=>  'left-bottom'
						,esc_html__('Left Center', 'boxshop')	=>  'left-center'
						,esc_html__('Right Top', 'boxshop')		=>  'right-top'
						,esc_html__('Right Bottom', 'boxshop')	=>  'right-bottom'
						,esc_html__('Right Center', 'boxshop')	=>  'right-center'
						,esc_html__('Center Top', 'boxshop')	=>  'center-top'
						,esc_html__('Center Bottom', 'boxshop')	=>  'center-bottom'
						,esc_html__('Center Center', 'boxshop')	=>  'center-center'
						,esc_html__('Static Top', 'boxshop')	=>  'static-top'
						,esc_html__('Static Bottom', 'boxshop')	=>  'static-bottom'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'boxshop' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link Title', 'boxshop' )
				,'param_name' 	=> 'link_title'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Hover Effect', 'boxshop' )
				,'param_name' 	=> 'style_effect'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Scale and opacity', 'boxshop')		=> 'eff-scale-opacity'
						,esc_html__('Opacity', 'boxshop')				=> 'eff-opacity'
						,esc_html__('Border Scale', 'boxshop')			=> 'eff-border-scale'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Effect Color', 'boxshop' )
				,'param_name' 	=> 'effect_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'boxshop' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('New Window Tab', 'boxshop')	=> '_blank'
						,esc_html__('Self', 'boxshop')			=> '_self'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Team Members ***/
	$team_options = array();
	if( class_exists('TS_Team_Members') || post_type_exists('ts_team') ){
		$args = array(
				'post_type'				=> 'ts_team'
				,'post_status'			=> 'publish'
				,'ignore_sticky_posts'	=> true
				,'posts_per_page'		=> -1
				);
		$teams = new WP_Query($args);
		if( !empty( $teams->posts ) && is_array( $teams->posts ) ){
			foreach( $teams->posts as $p ){
				$team_options[$p->post_title] = $p->ID;
			}
		}
	}
	
	vc_map( array(
		'name' 		=> esc_html__( 'TS Team Member', 'boxshop' ),
		'base' 		=> 'ts_team_member',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Member name', 'boxshop' )
				,'param_name' 	=> 'id'
				,'admin_label' 	=> true
				,'value' 		=> $team_options
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'boxshop' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> true
				,'value' 		=> '30'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'boxshop' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('New Window Tab', 'boxshop')	=> '_blank'
						,esc_html__('Self', 'boxshop')			=> '_self'	
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/* TS Testimonial */
	vc_map( array(
		'name' 		=> esc_html__( 'TS Testimonial', 'boxshop' ),
		'base' 		=> 'ts_testimonial',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'boxshop' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'ts_testimonial'
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Testimonial IDs', 'boxshop' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('A comma separated list of testimonial ids', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show Avatar', 'boxshop' )
				,'param_name' 	=> 'show_avatar'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> '4'
				,'description' 	=> esc_html__('Number of Posts', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'boxshop' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> true
				,'value' 		=> '50'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'boxshop' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'boxshop')	=> 'text-default'
							,esc_html__('Light', 'boxshop')		=> 'text-light'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'boxshop' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show pagination dots', 'boxshop' )
				,'param_name' 	=> 'show_dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')	=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> esc_html__('If it is set, the navigation buttons will be removed', 'boxshop')
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
		)
	) );
	
	/* TS Portfolio */
	vc_map( array(
		'name' 		=> esc_html__( 'TS Portfolio', 'boxshop' ),
		'base' 		=> 'ts_portfolio',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'boxshop' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(
							'2'		=> '2'
							,'3'	=> '3'
							,'4'	=> '4'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> '8'
				,'description' 	=> esc_html__('Number of Posts', 'boxshop')
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'boxshop' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'ts_portfolio'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'boxshop' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'boxshop')	=> 'none'
							,esc_html__('ID', 'boxshop')	=> 'ID'
							,esc_html__('Date', 'boxshop')	=> 'date'
							,esc_html__('Name', 'boxshop')	=> 'name'
							,esc_html__('Title', 'boxshop')	=> 'title'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'boxshop' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Descending', 'boxshop')	=> 'DESC'
							,esc_html__('Ascending', 'boxshop')	=> 'ASC'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show portfolio title', 'boxshop' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show portfolio categories', 'boxshop' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show link icon', 'boxshop' )
				,'param_name' 	=> 'show_link_icon'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show like icon', 'boxshop' )
				,'param_name' 	=> 'show_like_icon'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show filter bar', 'boxshop' )
				,'param_name' 	=> 'show_filter_bar'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show load more button', 'boxshop' )
				,'param_name' 	=> 'show_load_more'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Load more button text', 'boxshop' )
				,'param_name' 	=> 'load_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Show more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'boxshop' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')	=>  0
							,esc_html__('Yes', 'boxshop')	=>  1
						)
				,'description' 	=> esc_html__('If slider is enabled, the filter bar and load more button will be removed', 'boxshop')
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
		)
	) );
	
	
	/*** TS Logos Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Logos Slider', 'boxshop' ),
		'base' 		=> 'ts_logos_slider',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style Logo', 'boxshop' )
				,'param_name' 	=> 'style_logo'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Default', 'boxshop')	=> 'style-default'
							,esc_html__('Light', 'boxshop')		=> 'style-light'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> '7'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Rows', 'boxshop' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> true
				,'value' 		=> 1
				,'description' 	=> esc_html__( 'Number of Rows', 'boxshop' )
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'boxshop' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'ts_logo'
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'boxshop' )
				,'param_name' 	=> 'margin_image'
				,'admin_label' 	=> false
				,'value' 		=> '20'
				,'description' 	=> esc_html__('Set margin between items', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Activate link', 'boxshop' )
				,'param_name' 	=> 'active_link'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
		)
	) );
	
	
	/*** TS Google Map ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Google Map', 'boxshop' ),
		'base' 		=> 'ts_google_map',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Address', 'boxshop' )
				,'param_name' 	=> 'address'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('You have to input your API Key in Appearance > Theme Options > General tab', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Height', 'boxshop' )
				,'param_name' 	=> 'height'
				,'admin_label' 	=> true
				,'value' 		=> 360
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Zoom', 'boxshop' )
				,'param_name' 	=> 'zoom'
				,'admin_label' 	=> true
				,'value' 		=> 12
				,'description' 	=> esc_html__('Input a number between 0 and 22', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Map Type', 'boxshop' )
				,'param_name' 	=> 'map_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
								esc_html__('ROADMAP', 'boxshop')	=> 'ROADMAP'
								,esc_html__('SATELLITE', 'boxshop')	=> 'SATELLITE'
								,esc_html__('HYBRID', 'boxshop')	=> 'HYBRID'
								,esc_html__('TERRAIN', 'boxshop')	=> 'TERRAIN'
							)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Twitter Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Twitter Slider', 'boxshop' ),
		'base' 		=> 'ts_twitter_slider',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Username', 'boxshop' )
				,'param_name' 	=> 'username'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit tweets', 'boxshop' )
				,'param_name' 	=> 'limit'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Exclude Replies', 'boxshop' )
				,'param_name' 	=> 'exclude_replies'
				,'admin_label' 	=> true
				,'value' 		=> array(
								esc_html__('No', 'boxshop')		=> 'false'
								,esc_html__('Yes', 'boxshop')	=> 'true'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'boxshop' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'boxshop')	=> 'text-default'
							,esc_html__('Light', 'boxshop')		=> 'text-light'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show pagination dots', 'boxshop' )
				,'param_name' 	=> 'show_dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')	=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> esc_html__('If it is set, the navigation buttons will be removed', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Cache time (hours)', 'boxshop' )
				,'param_name' 	=> 'cache_time'
				,'admin_label' 	=> true
				,'value' 		=> 12
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Consumer key', 'boxshop' )
				,'param_name' 	=> 'consumer_key'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Consumer secret', 'boxshop' )
				,'param_name' 	=> 'consumer_secret'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Access token', 'boxshop' )
				,'param_name' 	=> 'access_token'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Access token secret', 'boxshop' )
				,'param_name' 	=> 'access_token_secret'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'boxshop')
			)
		)
	) );
	
	/*** TS Milestone ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Milestone', 'boxshop' ),
		'base' 		=> 'ts_milestone',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number', 'boxshop' )
				,'param_name' 	=> 'number'
				,'admin_label' 	=> true
				,'value' 		=> '0'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Subject', 'boxshop' )
				,'param_name' 	=> 'subject'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'boxshop' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'boxshop')	=> 'text-default'
							,esc_html__('Light', 'boxshop')		=> 'text-light'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Countdown ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Countdown', 'boxshop' ),
		'base' 		=> 'ts_countdown',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'boxshop' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Default', 'boxshop')	=> 'style-default'
							,esc_html__('Border', 'boxshop')	=> 'style-border'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Day', 'boxshop' )
				,'param_name' 	=> 'day'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Month', 'boxshop' )
				,'param_name' 	=> 'month'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Year', 'boxshop' )
				,'param_name' 	=> 'year'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'boxshop' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'boxshop')	=> 'text-default'
							,esc_html__('Light', 'boxshop')		=> 'text-light'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Mailchimp Subscription ***/
	$mc_forms = boxshop_get_mailchimp_forms();
	$mc_form_option = array('' => '');
	foreach( $mc_forms as $mc_form ){
		$mc_form_option[$mc_form['title']] = $mc_form['id'];
	}
	vc_map( array(
		'name' 		=> esc_html__( 'TS Mailchimp Subscription', 'boxshop' ),
		'base' 		=> 'ts_mailchimp_subscription',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Form', 'boxshop' )
				,'param_name' 	=> 'form'
				,'admin_label' 	=> true
				,'value' 		=> $mc_form_option
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> 'Newsletter'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Intro Text', 'boxshop' )
				,'param_name' 	=> 'intro_text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Background Image', 'boxshop' )
				,'param_name' 	=> 'bg_image'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Style', 'boxshop' )
				,'param_name' 	=> 'text_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'boxshop')	=> 'text-default'
							,esc_html__('Light', 'boxshop')		=> 'text-light'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'boxshop' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Style 1', 'boxshop')	=> 'style-1'
							,esc_html__('Style 2', 'boxshop')	=> 'style-2'
							,esc_html__('Style 3', 'boxshop')	=> 'style-3'
						)
				,'description' 	=> ''
			)
		)
	) );

	/*** TS Image Gallery ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Image Gallery', 'boxshop' ),
		'base' 		=> 'ts_image_gallery',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_images'
				,'heading' 		=> esc_html__( 'Images', 'boxshop' )
				,'param_name' 	=> 'images'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image size', 'boxshop' )
				,'param_name' 	=> 'image_size'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Thumbnail', 'boxshop')	=> 'thumbnail'
							,esc_html__('Medium', 'boxshop')	=> 'medium'
							,esc_html__('Large', 'boxshop')		=> 'large'
							,esc_html__('Full', 'boxshop')		=> 'full'
						)
				,'description' 	=> esc_html__('You go to Settings > Media to change image size', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Layout', 'boxshop' )
				,'param_name' 	=> 'layout'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Slider', 'boxshop')	=> 'slider'
							,esc_html__('Grid', 'boxshop')	=> 'grid'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'boxshop' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> false
				,'value' 		=> array(
							1 	=> 1
							,2 	=> 2
							,3 	=> 3
							,4 	=> 4
							,6 	=> 6
							)
				,'description' 	=> esc_html__( 'Number of Columns', 'boxshop' )
				,'std'			=> 6
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'On click', 'boxshop' )
				,'param_name' 	=> 'on_click'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'boxshop')					=> 'none'
							,esc_html__('Open prettyPhoto', 'boxshop')		=> 'prettyphoto'
							,esc_html__('Open custom links', 'boxshop')		=> 'custom_link'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Custom links', 'boxshop' )
				,'param_name' 	=> 'custom_links'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('A comma separated list of links. Ex: if you have 3 images, the value of this field should be "link1, link2, link3"', 'boxshop')
				,'dependency'	=> array( 'element' => 'on_click', 'value' => array('custom_link') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Custom link target', 'boxshop' )
				,'param_name' 	=> 'custom_link_target'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Self', 'boxshop')				=> '_self'
							,esc_html__('New Window Tab', 'boxshop')	=> '_blank'
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'on_click', 'value' => array('custom_link') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=>  1
							,esc_html__('No', 'boxshop')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'boxshop' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> 0
				,'description' 	=> esc_html__('Set margin between items. It is only used for slider', 'boxshop')
			)
		)
	) );
	
	/********************** TS Product Shortcodes ************************/

	/*** TS Products ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Products', 'boxshop' ),
		'base' 		=> 'ts_products',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'boxshop' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'boxshop')			=> 'recent'
						,esc_html__('Sale', 'boxshop')			=> 'sale'
						,esc_html__('Featured', 'boxshop')		=> 'featured'
						,esc_html__('Best Selling', 'boxshop')	=> 'best_selling'
						,esc_html__('Top Rated', 'boxshop')		=> 'top_rated'
						,esc_html__('Mixed Order', 'boxshop')	=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'boxshop' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Products', 'boxshop' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'boxshop' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product IDs', 'boxshop' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Enter product name or slug to search', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item layout', 'boxshop' )
				,'param_name' 	=> 'item_layout'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Grid', 'boxshop')	=> 'grid'
							,esc_html__('List', 'boxshop')	=> 'list'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail border', 'boxshop' )
				,'param_name' 	=> 'thumbnail_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Big Thumbnail', 'boxshop' )
				,'param_name' 	=> 'big_thumbnail'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> esc_html__('Use Single Product Image size', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item margin', 'boxshop' )
				,'param_name' 	=> 'item_margin'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> esc_html__( 'Set margin between items. If this option is disabled, Thumbnail border will change to Item border', 'boxshop' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail Slider', 'boxshop' )
				,'param_name' 	=> 'thumbnail_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> esc_html__('Each product displays as a slider. Use thumbnails from gallery or variation', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail Slider Number', 'boxshop' )
				,'param_name' 	=> 'thumbnail_slider_number'
				,'admin_label' 	=> false
				,'value' 		=> array(
							3		=> 3
							,4		=> 4
							,5		=> 5
							,6		=> 6
							)
				,'description' 	=> ''
				,'dependency'  	=> array('element' => 'thumbnail_slider', 'value' => array('1'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail Slider Variation', 'boxshop' )
				,'param_name' 	=> 'thumbnail_slider_variation'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> esc_html__('If product is a variable product, its variations will be used', 'boxshop')
				,'dependency'  	=> array('element' => 'thumbnail_slider', 'value' => array('1'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail Slider Variation Color', 'boxshop' )
				,'param_name' 	=> 'thumbnail_slider_variation_color'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> esc_html__('If variations have the "color" attribute, color of dot navigation will be replaced by color of the color attribute', 'boxshop')
				,'dependency'  	=> array('element' => 'thumbnail_slider', 'value' => array('1'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'boxshop' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'boxshop' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'boxshop' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'boxshop' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'boxshop' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'boxshop' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'boxshop' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'boxshop' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'boxshop' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'boxshop' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Row', 'boxshop' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> false
				,'value' 		=> array(
								1 	=> 1
								,2 	=> 2
								,3 	=> 3
							)
				,'description' 	=> esc_html__( 'Number of Rows for slider', 'boxshop' )
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Navigation button position', 'boxshop' )
				,'param_name' 	=> 'position_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Top', 'boxshop')		=> 'nav-top'
							,esc_html__('Middle', 'boxshop')	=> 'nav-middle'
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show dot navigation', 'boxshop' )
				,'param_name' 	=> 'show_dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> esc_html__('Show dot navigation at the bottom', 'boxshop')
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Disable slider responsive', 'boxshop' )
				,'param_name' 	=> 'disable_slider_responsive'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> esc_html__('You should only enable this option when Columns is 1 or 2', 'boxshop')
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
		)
	) );
	
	/*** TS Products Widget ***/
	vc_map( array(
		'name' 			=> esc_html__( 'TS Products Widget', 'boxshop' ),
		'base' 			=> 'ts_products_widget',
		'class' 		=> '',
		'description' 	=> '',
		'category' 		=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 		=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'boxshop' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Default', 'boxshop')			=> ''
						,esc_html__('Background color', 'boxshop')	=> 'title-background-color'
						)
				,'description' 	=> ''
				,'std'			=> 'title-background-color'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Content border', 'boxshop' )
				,'param_name' 	=> 'content_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('No', 'boxshop')		=> 0
						,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> ''
				,'std'			=> 1
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'boxshop' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'boxshop')			=> 'recent'
						,esc_html__('Sale', 'boxshop')			=> 'sale'
						,esc_html__('Featured', 'boxshop')		=> 'featured'
						,esc_html__('Best Selling', 'boxshop')	=> 'best_selling'
						,esc_html__('Top Rated', 'boxshop')		=> 'top_rated'
						,esc_html__('Mixed Order', 'boxshop')	=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 6
				,'description' 	=> esc_html__( 'Number of Products', 'boxshop' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'boxshop' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'boxshop' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'boxshop' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'boxshop' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'boxshop' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'boxshop' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'boxshop' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail style', 'boxshop' )
				,'param_name' 	=> 'image_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'boxshop')	=> 'default'
							,esc_html__('Big', 'boxshop')		=> 'big'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail border', 'boxshop' )
				,'param_name' 	=> 'thumbnail_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'boxshop' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Row', 'boxshop' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> false
				,'value' 		=> 3
				,'description' 	=> esc_html__( 'Number of Rows for slider', 'boxshop' )
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
		)
	) );
	
	/*** TS Product Deals Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Product Deals Slider', 'boxshop' ),
		'base' 		=> 'ts_product_deals_slider',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'boxshop' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Default', 'boxshop')			=> ''
						,esc_html__('Background color', 'boxshop')	=> 'title-background-color'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Title background color', 'boxshop' )
				,'param_name' 	=> 'title_bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#e72304'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'title_style', 'value' => array('title-background-color') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'boxshop' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'boxshop')			=> 'recent'
						,esc_html__('Featured', 'boxshop')		=> 'featured'
						,esc_html__('Best Selling', 'boxshop')	=> 'best_selling'
						,esc_html__('Top Rated', 'boxshop')		=> 'top_rated'
						,esc_html__('Mixed Order', 'boxshop')	=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'boxshop' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> false
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Products', 'boxshop' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'boxshop' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product IDs', 'boxshop' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> false
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__( 'Enter product name or slug to search', 'boxshop' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item border', 'boxshop' )
				,'param_name' 	=> 'item_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail border', 'boxshop' )
				,'param_name' 	=> 'thumbnail_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> esc_html__( 'If this option is enabled, Item border will be disabled', 'boxshop' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show counter', 'boxshop' )
				,'param_name' 	=> 'show_counter'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Counter position', 'boxshop' )
				,'param_name' 	=> 'counter_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Bottom', 'boxshop')			=> 'bottom'
							,esc_html__('On thumbnail', 'boxshop')	=> 'on-thumbnail'
							)
				,'description' 	=> ''
				,'dependency' 	=> array('element' => 'show_counter', 'value' => array('1'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Big counter', 'boxshop' )
				,'param_name' 	=> 'big_counter'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> esc_html__( 'Make counter bigger. You should only enable this option when the width of item is big', 'boxshop' )
				,'dependency' 	=> array('element' => 'show_counter', 'value' => array('1'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'boxshop' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'boxshop' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'boxshop' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'boxshop' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'boxshop' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'boxshop' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'boxshop' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'boxshop' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'boxshop' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Navigation button position', 'boxshop' )
				,'param_name' 	=> 'position_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Top', 'boxshop')		=> 'nav-top'
							,esc_html__('Middle', 'boxshop')	=> 'nav-middle'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Product Categories Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Product Categories Slider', 'boxshop' ),
		'base' 		=> 'ts_product_categories_slider',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title position', 'boxshop' )
				,'param_name' 	=> 'title_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'boxshop')	=> ''
							,esc_html__('Left', 'boxshop')		=> 'title-left'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'boxshop' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Product Categories', 'boxshop' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Parent', 'boxshop' )
				,'param_name' 	=> 'parent'
				,'admin_label' 	=> true
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Select a category. Get direct children of this category', 'boxshop' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Child Of', 'boxshop' )
				,'param_name' 	=> 'child_of'
				,'admin_label' 	=> true
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Select a category. Get all descendents of this category', 'boxshop' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'boxshop' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Include these categories', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Hide empty product categories', 'boxshop' )
				,'param_name' 	=> 'hide_empty'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product category title', 'boxshop' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product count', 'boxshop' )
				,'param_name' 	=> 'show_product_count'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'boxshop' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> '0'
				,'description' 	=> esc_html__('Set margin between items', 'boxshop')
			)
		)
	) );
	
	/*** TS Products In Category Tabs ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Products In Category Tabs', 'boxshop' ),
		'base' 		=> 'ts_products_in_category_tabs',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab style', 'boxshop' )
				,'param_name' 	=> 'tab_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Vertical', 'boxshop')		=> 'vertical-tab'
							,esc_html__('Horizontal', 'boxshop')	=> 'horizontal-tab'
							)
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab horizontal style', 'boxshop' )
				,'param_name' 	=> 'horizontal_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Style 1', 'boxshop')	=> 'horizontal-style-1'
							,esc_html__('Style 2', 'boxshop')	=> 'horizontal-style-2'
							)
				,'dependency' 	=> array('element' => 'tab_style', 'value' => array('horizontal-tab'))
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Color', 'boxshop' )
				,'param_name' 	=> 'color'
				,'admin_label' 	=> true
				,'value' 		=> '#40bea7'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Icon', 'boxshop' )
				,'param_name' 	=> 'icon_fontawesome'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' 	=> array(
					'emptyIcon' 	=> true /* default true, display an "EMPTY" icon? */
					,'iconsPerPage' => 4000 /* default 100, how many icons per/page to display */
				)
				,'description' 	=> esc_html__('Add this icon before the block title', 'boxshop')
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Custom Icon', 'boxshop' )
				,'param_name' 	=> 'icon_image'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Icon background color', 'boxshop' )
				,'param_name' 	=> 'icon_bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#0a84cd'
				,'description' 	=> ''
				,'dependency' 	=> array('element' => 'horizontal_style', 'value' => array('horizontal-style-2'))
			)
			,array(
				'type' 			=> 'attach_images'
				,'heading' 		=> esc_html__( 'Banners', 'boxshop' )
				,'param_name' 	=> 'banners'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Display these banners on the right side', 'boxshop')
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Links for banners', 'boxshop' )
				,'param_name' 	=> 'links'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('A comma separated list of links. Ex: if you have 3 banners, the value of this field should be "link1, link2, link3"', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Banner position', 'boxshop' )
				,'param_name' 	=> 'banner_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Top', 'boxshop')		=> 'top'
							,esc_html__('Left', 'boxshop')		=> 'left'
							,esc_html__('Right', 'boxshop')		=> 'right'
							)
				,'dependency' 	=> array('element' => 'horizontal_style', 'value' => array('horizontal-style-1'))
				,'std'			=> 'right'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'boxshop' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'boxshop')			=> 'recent'
						,esc_html__('Sale', 'boxshop')			=> 'sale'
						,esc_html__('Featured', 'boxshop')		=> 'featured'
						,esc_html__('Best Selling', 'boxshop')	=> 'best_selling'
						,esc_html__('Top Rated', 'boxshop')		=> 'top_rated'
						,esc_html__('Mixed Order', 'boxshop')	=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'boxshop' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 3
				,'description' 	=> esc_html__( 'Number of Columns', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 6
				,'description' 	=> esc_html__( 'Number of Products', 'boxshop' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'boxshop' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Parent Category', 'boxshop' )
				,'param_name' 	=> 'parent_cat'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> false
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Each tab will be a sub category of this category. This option is available when the Product Categories option is empty', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Include children', 'boxshop' )
				,'param_name' 	=> 'include_children'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('No', 'boxshop')		=> 0
						,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> esc_html__( 'Load the products of sub categories in each tab', 'boxshop' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show general tab', 'boxshop' )
				,'param_name' 	=> 'show_general_tab'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> esc_html__('Get products from all categories or sub categories', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'General tab heading', 'boxshop' )
				,'param_name' 	=> 'general_tab_heading'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type of general tab', 'boxshop' )
				,'param_name' 	=> 'product_type_general_tab'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'boxshop')			=> 'recent'
						,esc_html__('Sale', 'boxshop')			=> 'sale'
						,esc_html__('Featured', 'boxshop')		=> 'featured'
						,esc_html__('Best Selling', 'boxshop')	=> 'best_selling'
						,esc_html__('Top Rated', 'boxshop')		=> 'top_rated'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'boxshop' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail border', 'boxshop' )
				,'param_name' 	=> 'thumbnail_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
				,'dependency' 	=> array('element' => 'tab_style', 'value' => array('vertical-tab'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'boxshop' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'boxshop' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'boxshop' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'boxshop' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'boxshop' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'boxshop' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'boxshop' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'boxshop' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'boxshop' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show see more button', 'boxshop' )
				,'param_name' 	=> 'show_see_more_button'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show see more button in general tab', 'boxshop' )
				,'param_name' 	=> 'show_see_more_general_tab'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'See more button label', 'boxshop' )
				,'param_name' 	=> 'see_more_button_text'
				,'admin_label' 	=> true
				,'value' 		=> 'See more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'boxshop' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Rows', 'boxshop' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'1'			=> '1'
						,'2'		=> '2'
						)
				,'description' 	=> esc_html__( 'Number of Rows in slider', 'boxshop' )
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
		)
	) );
	
	/*** TS Products In Category Tabs 2 ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Products In Category Tabs 2', 'boxshop' ),
		'base' 		=> 'ts_products_in_category_tabs_2',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab style', 'boxshop' )
				,'param_name' 	=> 'tab_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Vertical', 'boxshop')		=> 'vertical-tab'
							,esc_html__('Horizontal', 'boxshop')	=> 'horizontal-tab'
							)
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Color', 'boxshop' )
				,'param_name' 	=> 'color'
				,'admin_label' 	=> true
				,'value' 		=> '#40bea7'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'boxshop' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'boxshop')			=> 'recent'
						,esc_html__('Sale', 'boxshop')			=> 'sale'
						,esc_html__('Featured', 'boxshop')		=> 'featured'
						,esc_html__('Best Selling', 'boxshop')	=> 'best_selling'
						,esc_html__('Top Rated', 'boxshop')		=> 'top_rated'
						,esc_html__('Mixed Order', 'boxshop')	=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'boxshop' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'boxshop' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 8
				,'description' 	=> esc_html__( 'Number of Products', 'boxshop' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'boxshop' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Parent Category', 'boxshop' )
				,'param_name' 	=> 'parent_cat'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> false
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Each tab will be a sub category of this category. This option is available when the Product Categories option is empty', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Include children', 'boxshop' )
				,'param_name' 	=> 'include_children'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('No', 'boxshop')		=> 0
						,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> esc_html__( 'Load the products of sub categories in each tab', 'boxshop' )
			)
			,array(
				'type' 			=> 'attach_images'
				,'heading' 		=> esc_html__( 'Tab icons', 'boxshop' )
				,'param_name' 	=> 'tab_icons'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Display these icons before tab title. For example, if you have 3 tabs, you need to add 3 icons', 'boxshop')
			)
			,array(
				'type' 			=> 'attach_images'
				,'heading' 		=> esc_html__( 'Tab icons hover', 'boxshop' )
				,'param_name' 	=> 'tab_icons_hover'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Display these icons when hovering', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show general tab', 'boxshop' )
				,'param_name' 	=> 'show_general_tab'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> esc_html__('Get products from all categories or sub categories', 'boxshop')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'General tab heading', 'boxshop' )
				,'param_name' 	=> 'general_tab_heading'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type of general tab', 'boxshop' )
				,'param_name' 	=> 'product_type_general_tab'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'boxshop')			=> 'recent'
						,esc_html__('Sale', 'boxshop')			=> 'sale'
						,esc_html__('Featured', 'boxshop')		=> 'featured'
						,esc_html__('Best Selling', 'boxshop')	=> 'best_selling'
						,esc_html__('Top Rated', 'boxshop')		=> 'top_rated'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'boxshop' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Thumbnail border', 'boxshop' )
				,'param_name' 	=> 'thumbnail_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'boxshop' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'boxshop' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'boxshop' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'boxshop' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'boxshop' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'boxshop' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'boxshop' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'boxshop' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'boxshop' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show see more button', 'boxshop' )
				,'param_name' 	=> 'show_see_more_button'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show see more button in general tab', 'boxshop' )
				,'param_name' 	=> 'show_see_more_general_tab'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'See more button label', 'boxshop' )
				,'param_name' 	=> 'see_more_button_text'
				,'admin_label' 	=> true
				,'value' 		=> 'See All'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'boxshop' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Rows', 'boxshop' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'1'			=> '1'
						,'2'		=> '2'
						)
				,'description' 	=> esc_html__( 'Number of Rows in slider', 'boxshop' )
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'boxshop')		=> 0
							,esc_html__('Yes', 'boxshop')	=> 1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'boxshop')
			)
		)
	) );
	
	/*** TS Recently Viewed Products Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Recently Viewed Products Slider', 'boxshop' ),
		'base' 		=> 'ts_recently_viewed_products_slider',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'boxshop'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'boxshop' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'boxshop' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(
							1	=> 1
							,2	=> 2
							,3	=> 3
							,4	=> 4
							,5	=> 5
						)
				,'description' 	=> esc_html__( 'Number of Columns', 'boxshop' )
				,'std'			=> 4
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Rows', 'boxshop' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> false
				,'value' 		=> array(
								1 	=> 1
								,2 	=> 2
							)
				,'description' 	=> ''
				,'std'			=> 2
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'boxshop' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 12
				,'description' 	=> esc_html__( 'Number of Products. Maximum is 15', 'boxshop' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'From all users', 'boxshop' )
				,'param_name' 	=> 'from_all_users'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> esc_html__( 'Get recently viewed products from all users or only the current user', 'boxshop' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'boxshop' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'boxshop' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'boxshop' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'boxshop' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'boxshop' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'boxshop' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'boxshop')	=> 1
							,esc_html__('No', 'boxshop')	=> 0
							)
				,'description' 	=> ''
			)
		)
	) );
}

/*** Add Shortcode Param ***/
WpbakeryShortcodeParams::addField('ts_category', 'boxshop_product_catgories_shortcode_param');
if( !function_exists('boxshop_product_catgories_shortcode_param') ){
	function boxshop_product_catgories_shortcode_param($settings, $value){
		$categories = boxshop_get_list_categories_shortcode_param(0, $settings);
		$arr_value = explode(',', $value);
		ob_start();
		?>
		<input type="hidden" class="wpb_vc_param_value wpb-textinput product_cats textfield ts-hidden-selected-categories" name="<?php echo esc_attr($settings['param_name']); ?>" value="<?php echo esc_attr($value); ?>" />
		<div class="categorydiv">
			<div class="tabs-panel">
				<ul class="categorychecklist">
					<?php foreach($categories as $cat){ ?>
					<li>
						<label>
							<input type="checkbox" class="checkbox ts-select-category" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo (in_array($cat->term_id, $arr_value))?'checked':''; ?> />
							<?php echo esc_html($cat->name); ?>
						</label>
						<?php boxshop_get_list_sub_categories_shortcode_param($cat->term_id, $arr_value, $settings); ?>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
			jQuery('.ts-select-category').bind('change', function(){
				"use strict";
				
				var selected = jQuery('.ts-select-category:checked');
				jQuery('.ts-hidden-selected-categories').val('');
				var selected_id = new Array();
				selected.each(function(index, ele){
					selected_id.push(jQuery(ele).val());
				});
				selected_id = selected_id.join(',');
				jQuery('.ts-hidden-selected-categories').val(selected_id);
			});
		</script>
		<?php
		return ob_get_clean();
	}
}

if( !function_exists('boxshop_get_list_categories_shortcode_param') ){
	function boxshop_get_list_categories_shortcode_param( $cat_parent_id, $settings ){
		$taxonomy = 'product_cat';
		if( isset($settings['class']) ){
			if( $settings['class'] == 'post_cat' ){
				$taxonomy = 'category';
			}
			if( $settings['class'] == 'ts_testimonial' ){
				$taxonomy = 'ts_testimonial_cat';
			}
			if( $settings['class'] == 'ts_portfolio' ){
				$taxonomy = 'ts_portfolio_cat';
			}
			if( $settings['class'] == 'ts_logo' ){
				$taxonomy = 'ts_logo_cat';
			}
		}
		
		$args = array(
				'taxonomy' 			=> $taxonomy
				,'hierarchical'		=> 1
				,'hide_empty'		=> 0
				,'parent'			=> $cat_parent_id
				,'title_li'			=> ''
				,'child_of'			=> 0
			);
		$cats = get_categories($args);
		return $cats;
	}
}

if( !function_exists('boxshop_get_list_sub_categories_shortcode_param') ){
	function boxshop_get_list_sub_categories_shortcode_param( $cat_parent_id, $arr_value, $settings ){
		$sub_categories = boxshop_get_list_categories_shortcode_param($cat_parent_id, $settings); 
		if( count($sub_categories) > 0){
		?>
			<ul class="children">
				<?php foreach( $sub_categories as $sub_cat ){ ?>
					<li>
						<label>
							<input type="checkbox" class="checkbox ts-select-category" value="<?php echo esc_attr($sub_cat->term_id); ?>" <?php echo (in_array($sub_cat->term_id, $arr_value))?'checked':''; ?> />
							<?php echo esc_html($sub_cat->name); ?>
						</label>
						<?php boxshop_get_list_sub_categories_shortcode_param($sub_cat->term_id, $arr_value, $settings); ?>
					</li>
				<?php } ?>
			</ul>
		<?php }
	}
}

if( class_exists('Vc_Vendor_Woocommerce') ){
	$vc_woo_vendor = new Vc_Vendor_Woocommerce();

	/* autocomplete callback */
	add_filter( 'vc_autocomplete_ts_products_ids_callback', array($vc_woo_vendor, 'productIdAutocompleteSuggester') );
	add_filter( 'vc_autocomplete_ts_products_ids_render', array($vc_woo_vendor, 'productIdAutocompleteRender') );
	
	add_filter( 'vc_autocomplete_ts_product_deals_slider_ids_callback', array($vc_woo_vendor, 'productIdAutocompleteSuggester') );
	add_filter( 'vc_autocomplete_ts_product_deals_slider_ids_render', array($vc_woo_vendor, 'productIdAutocompleteRender') );
	
	$shortcode_field_cats = array();
	$shortcode_field_cats[] = array('ts_products', 'product_cats');
	$shortcode_field_cats[] = array('ts_products_widget', 'product_cats');
	$shortcode_field_cats[] = array('ts_product_deals_slider', 'product_cats');
	$shortcode_field_cats[] = array('ts_products_in_category_tabs', 'product_cats');
	$shortcode_field_cats[] = array('ts_products_in_category_tabs', 'parent_cat');
	$shortcode_field_cats[] = array('ts_products_in_category_tabs_2', 'product_cats');
	$shortcode_field_cats[] = array('ts_products_in_category_tabs_2', 'parent_cat');
	$shortcode_field_cats[] = array('ts_product_categories_slider', 'parent');
	$shortcode_field_cats[] = array('ts_product_categories_slider', 'child_of');
	$shortcode_field_cats[] = array('ts_product_categories_slider', 'ids');
		
	foreach( $shortcode_field_cats as $shortcode_field ){
		add_filter( 'vc_autocomplete_'.$shortcode_field[0].'_'.$shortcode_field[1].'_callback', array($vc_woo_vendor, 'productCategoryCategoryAutocompleteSuggester') );
		add_filter( 'vc_autocomplete_'.$shortcode_field[0].'_'.$shortcode_field[1].'_render', array($vc_woo_vendor, 'productCategoryCategoryRenderByIdExact') );
	}
}
?>
