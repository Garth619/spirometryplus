<?php 
$options = array();
		
$options[] = array(
				'id'		=> 'portfolio_url'
				,'label'	=> esc_html__('Portfolio URL', 'boxshop')
				,'desc'		=> esc_html__('Enter URL to the live version of the project', 'boxshop')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'video_url'
				,'label'	=> esc_html__('Video URL', 'boxshop')
				,'desc'		=> esc_html__('Enter Youtube or Vimeo video URL. Display this video instead of the featured image on the detail page', 'boxshop')
				,'type'		=> 'text'
			);

$options[] = array(
				'id'		=> 'bg_color'
				,'label'	=> esc_html__('Background Color', 'boxshop')
				,'desc'		=> esc_html__('Used for the shortcode. It will display this background color on hover', 'boxshop')
				,'type'		=> 'colorpicker'
			);
			
$options[] = array(
				'id'		=> 'portfolio_custom_field'
				,'label'	=> esc_html__('Custom Field', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
									'0'		=> esc_html__('Default', 'boxshop')
									,'1'	=> esc_html__('Override', 'boxshop')
								)
			);
			
$options[] = array(
				'id'		=> 'portfolio_custom_field_title'
				,'label'	=> esc_html__('Custom Field Title', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'portfolio_custom_field_content'
				,'label'	=> esc_html__('Custom Field Content', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'textarea'
			);
?>
