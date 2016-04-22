<?php
/**
 * Pagination
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $wp_query;
?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>

<div class="navigation clearfix">
	<div class="nav-next"><?php next_posts_link( __( 'Next <i class="fa fa-long-arrow-right"></i>', 'skillfully' ) ); ?></div>
	<div class="nav-prev"><?php previous_posts_link( __( '<i class="fa fa-long-arrow-left"></i> Previous', 'skillfully' ) ); ?></div>
</div>
<?php endif; ?>