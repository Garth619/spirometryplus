<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; 
$show_pro_image = isset($show_image)?$show_image:true;
$show_pro_title = isset($show_title)?$show_title:true;
$show_pro_price = isset($show_price)?$show_price:true;
$show_pro_rating = isset($show_rating)?$show_rating:false;
?>

<li>
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
	
	<?php if( $show_pro_image ): ?>
	<a class="ts-wg-thumbnail" href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<?php echo $product->get_image(); ?>
	</a>
	<?php endif; ?>
	<div class="ts-wg-meta">
		<?php if( $show_pro_title ): ?>
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<?php echo $product->get_title(); ?>
		</a>
		<?php endif; ?>
		<?php if( $show_pro_rating ){ echo wc_get_rating_html( $product->get_average_rating() ); } ?>
		<?php if( $show_pro_price ): ?>
		<span class="price"><?php echo $product->get_price_html(); ?></span>
		<?php endif; ?>
	</div>
	
	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>
