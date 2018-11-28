<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $boxshop_theme_options;

$vertical_thumbnail = isset($boxshop_theme_options['ts_prod_thumbnails_style']) && $boxshop_theme_options['ts_prod_thumbnails_style'] == 'vertical';
?>
<div class="images-thumbnails">

	<?php
		if( $vertical_thumbnail ){
			do_action( 'woocommerce_product_thumbnails' ); 
		}
		
		echo '<div class="images">';
		
		do_action('boxshop_before_product_image');
		
		if ( has_post_thumbnail() ) {
			$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
			$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
			$attributes = array(
				'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
				'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
				'data-index' 			  => 0,
			);

			if( $boxshop_theme_options['ts_prod_cloudzoom'] == 1 ){
				$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'woocommerce_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="woocommerce-main-image cloud-zoom zoom '.(wp_is_mobile()?'':'on_pc').'" id=\'product_zoom\' data-rel="position:\'inside\',showTitle:0,titleOpacity:0.5,lensOpacity:0.5,fixWidth:362,fixThumbWidth:72,fixThumbHeight:72,adjustX: 0, adjustY:'.(wp_is_mobile()?'0':'-4').'">';
				$html .= get_the_post_thumbnail( $post->ID, 'woocommerce_single', $attributes );
				$html .= '</a></div>';
			}
			else{
				$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'woocommerce_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
				$html .= get_the_post_thumbnail( $post->ID, 'woocommerce_single', $attributes );
				$html .= '</a></div>';
			}

		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'boxshop' ) );
			$html .= '</div>';
		}
		
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
		
		echo '</div>';
	?>

	<?php 
	if( !$vertical_thumbnail ){
		do_action( 'woocommerce_product_thumbnails' ); 
	}
	?>

</div>
