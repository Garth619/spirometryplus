<?php 
global $post;
$per_page = 6;
$cat_list = get_the_category($post->ID);
$cat_ids = array();
foreach( $cat_list as $cat ){
	$cat_ids[] = $cat->term_id;
}
$cat_ids = implode(',', $cat_ids);

if( strlen($cat_ids) > 0 ){
	$arg = array(
		'post_type' 		=> $post->post_type
		,'cat' 				=> $cat_ids
		,'post__not_in' 	=> array($post->ID)
		,'posts_per_page' 	=> $per_page
		,'fields'			=> 'ids'
	);
}
else{
	$arg = array(
		'post_type' 		=> $post->post_type
		,'post__not_in' 	=> array($post->ID)
		,'posts_per_page' 	=> $per_page
		,'fields'			=> 'ids'
	);
}

$related_posts = new WP_Query($arg);

if( $related_posts->have_posts() ){
	$post_ids = $related_posts->posts;
	$post_ids = implode(',', $post_ids);
	$shortcode_str = '[ts_portfolio include="'.$post_ids.'" title="'.esc_html__('Related Projects', 'boxshop').'" columns="3" is_slider="1"]';
	echo do_shortcode( $shortcode_str );
}
wp_reset_postdata();
?>
