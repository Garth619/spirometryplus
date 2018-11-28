<?php 
$options = array();

$options[] = array(
				'id'		=> 'gravatar_email'
				,'label'	=> esc_html__('Gravatar Email Address', 'boxshop')
				,'desc'		=> esc_html__('Enter an e-mail address to display Gravatar profile image instead of using the "Featured Image". You have to remove the "Featured Image".', 'boxshop')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'byline'
				,'label'	=> esc_html__('Byline', 'boxshop')
				,'desc'		=> esc_html__('Enter a byline for the customer giving this testimonial. For example: CEO of Theme-Sky', 'boxshop')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'url'
				,'label'	=> esc_html__('URL', 'boxshop')
				,'desc'		=> esc_html__('Enter an URL that applies to this customer. For example: http://theme-sky.com/', 'boxshop')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'rating'
				,'label'	=> esc_html__('Rating', 'boxshop')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
						'-1'	=> esc_html__('no rating', 'boxshop')
						,'1'	=> esc_html__('1 star', 'boxshop')
						,'1.5'	=> esc_html__('1.5 star', 'boxshop')
						,'2'	=> esc_html__('2 stars', 'boxshop')
						,'2.5'	=> esc_html__('2.5 stars', 'boxshop')
						,'3'	=> esc_html__('3 stars', 'boxshop')
						,'3.5'	=> esc_html__('3.5 stars', 'boxshop')
						,'4'	=> esc_html__('4 stars', 'boxshop')
						,'4.5'	=> esc_html__('4.5 stars', 'boxshop')
						,'5'	=> esc_html__('5 stars', 'boxshop')
				)
			);
?>
