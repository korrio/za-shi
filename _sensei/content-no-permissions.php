<?php
/**
 * The template for displaying product content in the no-permissions.php template
 *
 * Override this template by copying it to yourtheme/sensei/content-no-permissions.php
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */
 

if ( ! defined( 'ABSPATH' ) ) exit;

global $woothemes_sensei, $post;
?>
        	<article <?php post_class('content-no-permissions card'); ?>>

                <?php
                if ( is_singular( 'course' ) ) { ?>
                	<article <?php post_class( array( 'course', 'post' ) ); ?>>

                        <?php skillfully_single_sensei_header(); // replaces sensei_course_image and sensei_course_single_title ?>
                        
                        <div class="sensei-message alert restricted-message restricted-course"><?php echo wp_kses_post($woothemes_sensei->permissions_message['message']); ?></div>
                        
                        <?php do_action('sensei_single_course_content_inside_before'); ?>
                        

		            		    <section class="entry clearfix fix">
		            		    	<?php while ( have_posts() ) : the_post(); ?>

											       <?php the_content(); ?>
											
											    <?php endwhile; ?>
		            		    </section>
						
												<?php do_action('sensei_single_course_content_inside_after'); ?>				
	
            		</article><!-- .post -->
                <?php } else { ?>
                	
                	<?php skillfully_single_sensei_header(); // replaces sensei_course_image and sensei_course_single_title ?>
                        
                    <div class="sensei-message alert restricted-message restricted-lesson"><?php echo wp_kses_post($woothemes_sensei->permissions_message['message']); ?></div>

                	<section class="entry fix">
                        <?php if ( is_singular( 'lesson' ) ) {
                            echo Woothemes_Sensei_Lesson::lesson_excerpt( $post );
                        } ?>
                	</section>
                <?php } // End If Statement ?>
	
            </article><!-- .post -->