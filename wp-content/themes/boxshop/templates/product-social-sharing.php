<ul class="ts-product-social-sharing">

	<li class="twitter">
		<a href="https://twitter.com/home?status=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i><?php esc_html_e('Tweet', 'boxshop') ?></a>
	</li>
	
	<li class="facebook">
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i><?php esc_html_e('Share', 'boxshop') ?></a>
	</li>

	<li class="google-plus">
		<a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i><?php esc_html_e('Google+', 'boxshop') ?></a>
	</li>
	
	<li class="pinterest">
		<?php $image_link  = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
		<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink()); ?>&amp;media=<?php echo esc_url($image_link);?>" target="_blank"><i class="fa fa-pinterest"></i><?php esc_html_e('Pinterest', 'boxshop') ?></a>
	</li>

</ul>
