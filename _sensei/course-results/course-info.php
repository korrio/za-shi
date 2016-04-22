<?php
/**
 * The Template for displaying the course results page data.
 *
 * Override this template by copying it to yourtheme/sensei/course-results/course-info.php
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $woothemes_sensei, $course, $current_user, $wp_query;

$course = get_page_by_path( $wp_query->query_vars['course_results'], OBJECT, 'course' );

// Get User Meta
get_currentuserinfo();

	?>
	<article <?php post_class( array( 'course', 'post', 'card', 'course-info' ) ); ?>>
		<section class="entry fix">
			<?php

			do_action( 'sensei_frontend_messages' );

			global $course, $current_user;
			
			$image_id = get_post_thumbnail_id($course->ID);
			$image_url = false;
		
			if ( $image_id ) {
				$image_url = wp_get_attachment_image_src($image_id,'xl_featured');
			}
		
			if ( $image_url ) {
		
				$featured_bg_img = $image_url[0];
		
				echo '<div class="entry-title_wrap featured_image_title" style="background-image:url('. esc_url($featured_bg_img) .')">';
				echo '<h1 class="entry-title scrim">'. esc_attr($course->post_title) .'</h1>';
				echo '</div>';
			
			} else {
				
				echo '<div class="entry-title_wrap"><h1 class="entry-title">'. esc_attr($course->post_title) .'</h1></div>';
				
			}
		
			do_action( 'sensei_course_results_top', $course->ID );
	
			$course_status = WooThemes_Sensei_Utils::sensei_user_course_status_message( $course->ID, $current_user->ID );
			echo '<div class="sensei-message ' . esc_attr($course_status['box_class']) . '">' . wp_kses_post($course_status['message']) . '</div>';
	
			do_action( 'sensei_course_results_lessons', $course );
	
			do_action( 'sensei_course_results_bottom', $course->ID );

			?>
		</section>
	</article>