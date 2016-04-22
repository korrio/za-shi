<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<div class="meta_block block-sku">
			<span class="sku_wrapper"><?php _e( 'SKU:', 'skillfully' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'skillfully' ); ?></span>.</span>
		</div>
	<?php endif; ?>
	
	<div class="meta_block block-category">
		<?php echo wp_kses_post($product->get_categories( ', ', '<span class="posted_in">' . _n( '<i class="fa fa-th-list"></i> Category:', '<i class="fa fa-th-list"></i> Categories:', $cat_count, 'skillfully' ) . ' ', '.</span>' )); ?>
	</div>

	<div class="meta_block block-product-tags">
		<?php echo wp_kses_post($product->get_tags( ', ', '<span class="tagged_as">' . _n( '<i class="fa fa-tag"></i> Tag:', '<i class="fa fa-tag"></i> Tags:', $tag_count, 'skillfully' ) . ' ', '.</span>' )); ?>
	</div>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
