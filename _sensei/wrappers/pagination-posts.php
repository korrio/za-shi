<?php
/**
 * Pagination - Posts
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>
			<nav id="post-entries" class="post-entries fix">
	            <div class="nav-prev fl"><?php previous_post_link( '%link', '<i class="fa fa-long-arrow-left"></i> %title</a>' ); ?></div>
	            <div class="nav-next fr"><?php next_post_link( '%link', '%title <i class="fa fa-long-arrow-right"></i></a>' ); ?></div>
	        </nav><!-- #post-entries -->