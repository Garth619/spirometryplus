<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $boxshop_theme_options;

$attachment_ids = $product->get_gallery_image_ids();

$vertical_thumbnail = isset($boxshop_theme_options['ts_prod_thumbnails_style']) && $boxshop_theme_options['ts_prod_thumbnails_style'] == 'vertical';

if ( $attachment_ids ) {
	if( is_array($attachment_ids) && has_post_thumbnail() && $boxshop_theme_options['ts_prod_cloudzoom'] == 1 ){
		array_unshift($attachment_ids, get_post_thumbnail_id());
	}
	$count_product = count($attachment_ids);
	?>
	<div class="thumbnails ts-slider <?php echo ( $count_product > 1 )?'loading':''; ?>">
		<ul class="product-thumbnails">
		<?php
		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop === 0 || $loop % $columns === 0 ) {
				$classes[] = 'first';
			}

			if ( ( $loop + 1 ) % $columns === 0 ) {
				$classes[] = 'last';
			}
			$image_class 	= esc_attr( implode( ' ', $classes ) );
			
			$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
			$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'woocommerce_thumbnail' );
			
			if( $boxshop_theme_options['ts_prod_cloudzoom'] == 1 ){
				$single_thumbnail = wp_get_attachment_image_src( $attachment_id, 'woocommerce_single' );
				$image_class 	.= ' cloud-zoom-gallery ';
				$attributes = array(
					'title'                   => get_post_field( 'post_title', $attachment_id )
				);
				$html  = '<li data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="'.esc_attr($image_class).'" data-rel="useZoom: \'product_zoom\', smallImage: \''.esc_url( $single_thumbnail[0] ).'\'">';
				$html .= wp_get_attachment_image( $attachment_id, 'woocommerce_thumbnail', false, $attributes );
				$html .= '</a></li>';
			}
			else{
				$attributes = array(
					'title'                   => get_post_field( 'post_title', $attachment_id ),
					'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
					'data-index' 			  => $loop + 1,
				);
				$html  = '<li data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="'.esc_attr($image_class).'">';
				$html .= wp_get_attachment_image( $attachment_id, 'woocommerce_thumbnail', false, $attributes );
				$html .= '</a></li>';
			}
			
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );

			$loop++;
		}
	?>
		</ul>
		
		<?php if( $vertical_thumbnail ): ?>
		<div class="owl-controls">
			<div class="owl-nav">
				<div class="owl-prev"></div>
				<div class="owl-next"></div>
			</div>
		</div>
		<?php endif; ?>
		
	</div>
	<?php
}
