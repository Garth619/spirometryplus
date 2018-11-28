<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$show_cat_title = isset($show_title)?$show_title:true;
$show_cat_product_count = isset($show_product_count)?$show_product_count:true;
$show_cat_product_count = apply_filters('boxshop_product_cat_show_product_count', $show_cat_product_count);

$term_link = get_term_link( $category, 'product_cat' );
?>
<section <?php wc_product_cat_class('product-category product', $category); ?>>

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<a href="<?php echo esc_url($term_link) ?>">
	<?php
		/**
		 * woocommerce_before_subcategory_title hook
		 *
		 * @hooked woocommerce_subcategory_thumbnail - 10
		 */
		do_action( 'woocommerce_before_subcategory_title', $category );
	?>
	</a>
	
	<?php if( $show_cat_title ): ?>
	<div class="meta-wrapper">
		<div class="category-name">
			<h3 class="heading-title">
				<a href="<?php echo esc_url($term_link) ?>">
				<?php 
				echo esc_html($category->name); 
				if( $show_cat_product_count ){
					echo '<span class="count">(' . absint($category->count) . ')</span>';
				}
				?>
				</a>
			</h3>
		</div>
	</div>
	<?php endif; ?>
	
	<?php
		/**
		 * woocommerce_after_subcategory_title hook
		 */
		do_action( 'woocommerce_after_subcategory_title', $category );
	?>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</section>
