<?php
/**
 * The Template for displaying course archives, including the course page template.
 *
 * Override this template by copying it to your_theme/sensei/archive-course.php
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
?>

<?php get_sensei_header();  ?>

<section id="main-course" class="course-container">
    <?php

        /**
         * This action before course archive loop. This hook fires within the archive-course.php
         * It fires even if the current archive has no posts.
         *
         * @since 1.9.0
         *
         * @hooked Sensei_Course::course_archive_sorting 20
         * @hooked Sensei_Course::course_archive_filters 20
         * @hooked Sensei_Templates::deprecated_archive_hook 80
         */
        do_action( 'sensei_archive_before_course_loop' );

    ?>
		<div class="card clearfix courses-overview-cat-list" id="course_cat_list">
			<ul>
				<li><?php _e('All Categories:','skillfully'); ?></li>
				<?php $args = array(
					'title_li'           => '', // no title
					'taxonomy'           => 'course-category' // the course category
			    );
			    wp_list_categories( $args ); ?>
			</ul>
		</div>
    <?php if ( have_posts() ): ?>

        <?php sensei_load_template( 'loop-course.php' ); ?>

    <?php else: ?>

        <p><?php _e( 'No courses found that match your selection.', 'woothemes-sensei' ); ?></p>

    <?php  endif; // End If Statement ?>

    <?php

        /**
         * This action runs after including the course archive loop. This hook fires within the archive-course.php
         * It fires even if the current archive has no posts.
         *
         * @since 1.9.0
         */
        do_action( 'sensei_archive_after_course_loop' );

    ?>
</section>
<?php get_sensei_footer(); ?>
