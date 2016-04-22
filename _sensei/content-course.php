<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Content-course.php template file
 *
 * responsible for content on archive like pages. Only shows the course excerpt.
 *
 * For single course content please see single-course.php
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
?>

<li class="woo_card course_card card">
	
	<?php
    /**
     * This action runs before the sensei course content. It runs inside the sensei
     * content-course.php template.
     *
     * @since 1.9
     *
     * @param integer $course_id
     */
    do_action( 'sensei_course_content_before', get_the_ID() );
    ?>
    <?php 
		
		//$image_id = get_post_thumbnail_id( $post_item->ID );
		$course_id = 0;
		$image_id = get_post_thumbnail_id($course_id);
		$image_url = false;
		
		if ( $image_id ) {
			$image_url = wp_get_attachment_image_src($image_id,'xl_featured');
		}
		
		if ( $image_url ) {
		
					$featured_bg_img = $image_url[0];
				
					echo '<a href="'. get_the_permalink($course_id) .'" class="card_image_link" style="background-image:url('. esc_url($featured_bg_img) .')"></a>';
				
				} elseif ( function_exists( 'of_get_option' ) && ('' != of_get_option('course_fallback_image')) ) {
					
					echo '<a href="'. get_the_permalink($course_id) .'" class="card_image_link" style="background-image:url('. esc_url(of_get_option("course_fallback_image")) .')"></a>';
					
		} 
	?>
		<div class="post_content">
			<div class="card_content">
				<div class="woo_card-height">
					<?php
	            /**
	             * Fires just before the course content in the content-course.php file.
	             *
	             * @since 1.9
	             *
	             * @param integer $course_id
	             *
	             * @hooked Sensei_Templates::the_title          - 5
	             * @hooked Sensei()->course->course_image       - 10
	             * @hooked  Sensei()->course->the_course_meta   - 20 - removed and replaced with custom skillfully course meta function
	             */
	            do_action('sensei_course_content_inside_before', get_the_ID() );
	            ?>
	
	            
	
	            <?php
	            /**
	             * Fires just after the course content in the content-course.php file.
	             *
	             * @since 1.9
	             *
	             * @param integer $course_id
	             *
	             * @hooked  Sensei()->course->the_course_free_lesson_preview - 20
	             */
	            do_action('sensei_course_content_inside_after', get_the_ID() );
	            ?>
				</div>
			</div>
		</div> <!-- div .post-content -->
    <?php
    /**
     * Fires after the course block in the content-course.php file.
     *
     * @since 1.9
     *
     * @param integer $course_id
     *
     * @hooked  Sensei()->course->the_course_free_lesson_preview - 20
     */
    do_action('sensei_course_content_after', get_the_ID() );
    ?>


</li> <!-- article .(<?php esc_attr_e( join( ' ', get_post_class( array( 'course', 'post' ) ) ) ); ?>  -->


	 