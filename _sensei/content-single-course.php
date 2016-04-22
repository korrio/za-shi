<?php
/**
 * The template for displaying product content in the single-course.php template
 *
 * Override this template by copying it to yourtheme/sensei/content-single-course.php
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $woothemes_sensei, $post, $current_user;

// Get User Meta
get_currentuserinfo();
// Check if the user is taking the course
$is_user_taking_course = WooThemes_Sensei_Utils::user_started_course( $post->ID, $current_user->ID );

// Content Access Permissions
$access_permission = false;
if ( ( isset( Sensei()->settings->get['access_permission'] ) && ! Sensei()->settings->get['access_permission'] ) || sensei_all_access() ) {
	$access_permission = true;
} // End If Statement
?>
	<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	if ( WooThemes_Sensei_Utils::sensei_is_woocommerce_activated() ) {
		do_action( 'woocommerce_before_single_product' );
	} // End If Statement
	?>

        	<article <?php post_class( array( 'course', 'post', 'card', 'content-single-course' ) ); ?>>

				<?php skillfully_single_sensei_header(); // replaces sensei_course_image and sensei_course_single_title ?>

    <?php

    /**
     * Hook inside the single course post above the content
     *
     * @since 1.9.0
     *
     * @param integer $course_id
     *
     * @hooked Sensei()->frontend->sensei_course_start     -  10
     * @hooked Sensei_Course::the_title                    -  10 - removed on fuctions-sensei.php
     * @hooked Sensei()->course->course_image              -  20
     * @hooked Sensei_WC::course_in_cart_message           -  20
     * @hooked Sensei_Course::the_course_enrolment_actions -  30
     * @hooked Sensei()->message->send_message_link        -  35
     * @hooked Sensei_Course::the_course_video             -  40
     */
    do_action( 'sensei_single_course_content_inside_before', get_the_ID() );

    ?>
		
    <section class="entry fix">

        <?php while ( have_posts() ) : the_post(); ?>

		       <?php the_content(); ?>
		
		    <?php endwhile; ?>

    </section>

    <?php

    /**
     * Hook inside the single course post below the content
     *
     * @since 1.9.0
     *
     * @param integer $course_id
     *
     */
    do_action( 'sensei_single_course_content_inside_after', get_the_ID() );

    ?>

</article><!-- .post -->