<?php 
$rand_id = '-'.rand(0, 1000); 
$placeholder_text = esc_html__('Search', 'boxshop');

if( class_exists('WooCommerce') ){
	$placeholder_text = esc_html__('Search for products', 'boxshop');
}

if( is_404() ){
	$placeholder_text = esc_html__('You can back to homepage or seach anything', 'boxshop');
}
?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform<?php echo esc_attr($rand_id); ?>">
	<div class="search-table">
		<div class="search-field search-content">
			<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s<?php echo esc_attr($rand_id); ?>" placeholder="<?php echo esc_attr($placeholder_text); ?>" autocomplete="off" />
			<?php if( class_exists('WooCommerce') ): ?>
			<input type="hidden" name="post_type" value="product" />
			<?php endif; ?>
		</div>
		<div class="search-button">
			<input type="submit" id="searchsubmit<?php echo esc_attr($rand_id); ?>" value="<?php esc_html_e('Search', 'boxshop'); ?>" />
		</div>
	</div>
</form>
