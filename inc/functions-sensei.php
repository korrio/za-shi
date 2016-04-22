<?php
/**
 * Functions Skillfully needs for Sensei
 * @package skillfully
 * since Skillfully 1.0
 */
 
 /**
 * Display notice to install Sensei
 * @package skillfully
 * since Skillfully 1.1
 */
if ( current_user_can( 'install_plugins' ) ) {	
	skillfully_woosensei_check();
}
function skillfully_woosensei_check() {
	if ( ( !function_exists( 'is_sensei' ) ) ) {
		add_action('admin_notices', 'skillfully_woosensei_check_notice');
	}
}
// Woo and Sensei Admin Notice
function skillfully_woosensei_check_notice() {
	global $current_user ;
    $user_id = $current_user->ID;
    
    /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'skillfully_woo_ignore_notice') ) {
        echo '<div class="updated"><p>'; 
        printf(__('The <strong>WooCommerce</strong> and <strong>Sensei</strong> plugins are needed to make Skillfully a Learning Management System. | <a href="%1$s">Don\'t Remind Me</a>'), '?skillfully_woo_ignore=0', 'skillfully');
        echo "</p></div>";
	}
	
}
add_action('admin_init', 'skillfully_woo_ignore');
function skillfully_woo_ignore() {
	global $current_user;
    $user_id = $current_user->ID;
    /* If user clicks to ignore the notice, add that to their user meta */
    if ( isset($_GET['skillfully_woo_ignore']) && '0' == $_GET['skillfully_woo_ignore'] ) {
         add_user_meta($user_id, 'skillfully_woo_ignore_notice', 'true', true);
	}
}
 
if ( function_exists( 'is_sensei' ) ) :
 
	/**
	 * Implement Sensei
	 */
	add_action( 'after_setup_theme', 'declare_sensei_support' );
	function declare_sensei_support() {
		add_theme_support( 'sensei' );
	}
	
	global $woothemes_sensei;
	
	
	// Remove Sensei Wrappers
	remove_action( 'sensei_before_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper' ), 10 );
	remove_action( 'sensei_after_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper_end' ), 10 );
	
	
	// Add New Sensei Wrappers
	add_action('sensei_before_main_content', 'skillfully_sensei_wrapper_start', 10);
	add_action('sensei_after_main_content', 'skillfully_sensei_wrapper_end', 10);
	
	function skillfully_sensei_wrapper_start() {
		if ('cl_no_sidebar' != of_get_option('cl_sidebar')) {
			$cl_sidebar = 'cl_has_sidebar';
		} else {
			$cl_sidebar = 'no-sidebar';
		}
		echo '<div id="primary" class="content-area '. esc_attr($cl_sidebar) .'"><div id="main" class="site-main" role="main">';
	}
	
	function skillfully_sensei_wrapper_end() {
		echo '</div><!-- #main -->
		</div><!-- #primary -->';
		
		if ('cl_no_sidebar' != of_get_option('cl_sidebar')) {
		
			get_sidebar();
		
		}
		
	}
	
	/**
	 * sensei_course_category_main_content output for course archives
	 * @since 1.0.0
	 */
	
	remove_action( 'sensei_course_category_main_content', array( $woothemes_sensei->frontend, 'sensei_course_category_main_content' ), 10, 4 );
	add_action('sensei_course_category_main_content', 'skillfully_sensei_course_category_main_content', 10);
	
	function skillfully_sensei_course_category_main_content() {
		global $post;
		if ( have_posts() ) { ?>
	
			<section id="main-course" class="course-container course_cat_archive">
				
	    	    <?php do_action( 'sensei_course_archive_header' ); ?>
	    	    
	    	    <div class="card full_card clearfix" id="course_cat_list">
					<ul>
						<li><?php _e('All Categories:','skillfully'); ?></li>
						<?php $currentCategory = get_the_category();
						
					    $args = array(
							'title_li'           => '', // no title
							'current_category'   => $currentCategory, // highligt current page (we'll use this in the archives)
							'taxonomy'           => 'course-category' // the course category
					    );
					    wp_list_categories( $args ); ?>
				    </ul>
			    </div>
	    	    
	    	    <div class="course_cat_archive_cards clearfix">
		    	    <?php while ( have_posts() ) { the_post(); ?>
						<?php get_template_part('sensei-course', 'card'); ?>
		    		<?php } // End While Loop ?>
	    		</div>
	    		
	    	</section>
	    	
		<?php } else { ?>
			<p><?php _e( 'No courses found that match your selection.', 'skillfully' ); ?></p>
		<?php } // End If Statement
	} // End skillfully_sensei_course_category_main_content()
		
	
	/**
     * Get the featured image, or use the fallback.
     *
     * @since Skillfully 1.0
     * @return void
     */
	function skillfully_card_image() {
		
		$image_id = get_post_thumbnail_id();
		$image_url = false;
	
		if ( $image_id ) {
			$image_url = wp_get_attachment_image_src($image_id,'xl_featured');
		}
	
		if ( $image_url ) {
	
			$featured_bg_img = $image_url[0];
	
			echo '<a href="'. get_the_permalink() .'" class="card_image_link" style="background-image:url('. esc_url($featured_bg_img) .')"></a>';
		
		} elseif ( function_exists( 'of_get_option' ) && ('' != of_get_option('course_fallback_image')) ) {
			
			echo '<a href="'. get_the_permalink() .'" class="card_image_link" style="background-image:url('. esc_url(of_get_option("course_fallback_image")) .')"></a>';
			
		}
	
	}




	/**
	 * UPDATES TO SENSEI FUNCTIONS SINCE v1.9
	 */
	
	// Customize sensei breadcrumb
	function custom_sensei_breadcrumb_output( $html, $sep ) {
		$html = str_replace( 'class="sensei-breadcrumb', 'class="sensei-breadcrumb card', $html );
		
		return $html;
	}
	add_filter( 'sensei_breadcrumb_output', 'custom_sensei_breadcrumb_output', 10, 2 );
	
	// Remove sensei title from default course header
	remove_action( 'sensei_single_course_content_inside_before',array( 'Sensei_Course', 'the_title'), 10 );
		 
	// Remove sensei course lessons title 
	remove_action( 'sensei_single_course_content_inside_after' , array( 'Sensei_Course','the_course_lessons_title'), 9 );
	
	// Remove sensei learner profile courses heading. Added to learner profile directly
	remove_action( 'sensei_learner_profile_info', array( Sensei()->learner_profiles, 'learner_profile_courses_heading' ), 30, 1 );
	
	//Add author box to Courses & Lessons (changed priority)
	add_action( 'sensei_single_course_lessons_before', array('Sensei_Course','load_single_course_lessons_query' ) );
	remove_action( 'sensei_single_course_content_inside_after', 'course_single_lessons', 10 );
	add_action( 'sensei_single_course_content_inside_after', 'skillfully_author_box', 11 );
	add_action( 'sensei_single_course_content_inside_after', 'course_single_lessons', 12 );
	add_action( 'sensei_single_course_lessons_after', array( 'Sensei_Utils','restore_wp_query' ));
	
	// Remove course archive image (added custom markup to content-course.php)
	remove_action('sensei_course_content_inside_before', array( Sensei()->course, 'course_image' ) ,10, 1 );
	
	// Remove free lesson preview as we have it in the custom meta info
	remove_action( 'sensei_course_content_inside_after',array( Sensei()->course, 'the_course_free_lesson_preview' ) );
	
	// Remove single lesson title
	remove_action( 'sensei_single_lesson_content_inside_before', array( 'Sensei_Lesson', 'the_title' ), 15 );
	
	// Remove contact teacher link from lessons
	remove_action( 'sensei_single_lesson_content_inside_before', array( Sensei()->post_types->messages, 'send_message_link' ), 30, 2 );
	
	// Move the quiz buttons up on single lesson, above lesson tags
	remove_action( 'sensei_single_lesson_content_inside_after', array('Sensei_Lesson', 'footer_quiz_call_to_action' ));
	add_action( 'sensei_single_lesson_content_inside_after', array('Sensei_Lesson', 'footer_quiz_call_to_action' ), 9);
	
	remove_action( 'sensei_single_lesson_content_inside_after', array( 'Sensei_Lesson', 'prerequisite_complete_message' ), 20 );
	add_action( 'sensei_single_lesson_content_inside_after', array( 'Sensei_Lesson', 'prerequisite_complete_message' ), 1 );


	// Custom course meta info (removed sensei, customized for skillfully)
	function skillfully_course_meta( $course_id ){

		$course = get_post( $course_id );
		$category_output = get_the_term_list( $course->ID, 'course-category', '', ', ', '' );
		$author_display_name = get_the_author_meta( 'display_name', $course->post_author  );
		$preview_lesson_count = intval( Sensei()->course->course_lesson_preview_count( $course->ID ) );
		$is_user_taking_course = Sensei_Utils::user_started_course( $course->ID, get_current_user_id() );
		
		if ( isset( Sensei()->settings->settings[ 'course_author' ] ) && ( Sensei()->settings->settings[ 'course_author' ] ) ) {?>
		
		  <div class="post_meta author_meta clearfix course-author">
		  	<?php echo get_avatar( $course->post_author, '50' ); ?>
		
		      <div><a href="<?php esc_attr_e( get_author_posts_url( $course->post_author ) ); ?>" title="<?php esc_attr_e( $author_display_name ); ?>"><?php esc_attr_e( $author_display_name   ); ?></a></div>
		
		  </div>
		
		<?php } // End If Statement ?>
		
			<div class="post_desc">	
		  <?php the_excerpt(); ?>
			</div>
			
			<div class="post_meta course_meta clearfix">                      
										
				<div class="course_price_wrap"><?php sensei_simple_course_price( $course->ID ); ?></div>
				
				<span class="course-lesson-count"><?php echo Sensei()->course->course_lesson_count( $course->ID ) . '&nbsp;' .  __( 'Lessons', 'woothemes-sensei' ); ?></span>
				
				<?php if ( '' != $category_output ) { ?>
					<span class="course-category"><i class="fa fa-tag"></i><?php echo sprintf( __( 'in %s', 'woothemes-sensei' ), $category_output ); ?></span>
				<?php } // End If Statement ?>
			
			</div>
		
			<div class="card_action clearfix">
				<?php if ( 0 < $preview_lesson_count && !$is_user_taking_course ) {  ?>
		        	<a href="<?php echo esc_url(get_permalink( $course->ID )); ?>" class="button button_flat"><?php _e('Preview','skillfully'); ?></a>
		        <?php } else {?>
					<a href="<?php echo esc_url(get_permalink( $course->ID )); ?>" class="button button_flat"><?php _e('Learn More','skillfully'); ?></a>
				<?php } ?>									
			</div>
		
		
			<?php 
	
	
	} // end skillfully course meta 
    
	remove_action('sensei_course_content_inside_before', array( Sensei()->course, 'the_course_meta' ) );
	add_action('sensei_course_content_inside_before', 'skillfully_course_meta' );
	
	remove_action('sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 10, 0 );
	add_action('sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 1, 0 );
	
	// Customize sensei archive title
	function custom_sensei_archive_title_output( $html ) {
	  $html = str_replace( 'class="archive-header', 'class="course-archive-header card', $html );
	  
	  return $html;
	}
	add_filter( 'course_archive_title', 'custom_sensei_archive_title_output', 10, 2 );
	
	// Customize sensei category title
	function custom_sensei_category_title() {
		if( ! is_tax( 'course-category' ) ) {
			return;
		}
	
		$category_slug = get_query_var('course-category');
		$term  = get_term_by('slug',$category_slug,'course-category');
		
		if( ! empty($term) ){
		
			$title = $term->name;
		
		} else {
		
			$title = 'Course Category';
		
		}
		
		$html = '<h2 class="sensei-category-title">';
		$html .= __('') . ' ' . $title;
		$html .= '</h2>';
		
		echo apply_filters( 'course_category_title', $html , $term->term_id );
	}
	
	remove_action( 'sensei_loop_course_before', array( 'Sensei_Course', 'course_category_title' ), 70 , 1 );
	add_action( 'sensei_loop_course_before', 'custom_sensei_category_title', 70 , 1 );

endif; // end if is_sensei

// For Featured Course Cards
function skillfully_featured_card_image() {
	
	$image_id = get_post_thumbnail_id();
	$image_url = false;
	
	if ( $image_id ) {
		$image_url = wp_get_attachment_image_src($image_id,'xl_featured');
	}
	if ( $image_url ) {
		$latest_bg_img = $image_url[0];
		echo '<div class="box_card_img scrim" style="background-image:url('. esc_url($latest_bg_img) .')"></div>';
		
	
	} elseif ( function_exists( 'of_get_option' ) && ('' != of_get_option('course_fallback_image')) ) {
		
		echo '<div class="box_card_img" style="background-image:url('. esc_url(of_get_option("course_fallback_image")) .')"></div>';
		
	}
}
// For Single Courses and Lessons
function skillfully_single_sensei_header() {
	
	$image_id = get_post_thumbnail_id();
	$image_url = false;
	
	if ( $image_id ) {
		$image_url = wp_get_attachment_image_src($image_id,'xl_featured');
	}
	if ( $image_url ) {
		$featured_bg_img = $image_url[0];
		echo '<div class="entry-title_wrap featured_image_title" style="background-image:url('. esc_url($featured_bg_img) .')">';
		echo '<h1 class="entry-title scrim">'. get_the_title() .'</h1>';
		echo '</div>';
	
	} else {
		
		echo '<h1 class="entry-title">'. get_the_title() .'</h1>';
		
	}	
}
/**
 * Remove Course Product Category from shop page and archives
 */
if ('' != of_get_option('woo_course_category')) {
	
	add_action( 'pre_get_posts', 'woo_product_pre_get_posts_query' );
	
	function woo_product_pre_get_posts_query( $q ) {
	
		if ( ! $q->is_main_query() ) return;
		if ( ! $q->is_post_type_archive() ) return;
		
		if ( ! is_admin() && is_shop() ) {
	
			$q->set( 'tax_query', array(array(
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => esc_attr(stripslashes(of_get_option('woo_course_category'))),
				'operator' => 'NOT IN'
			)));
		
		}
	
		remove_action( 'pre_get_posts', 'woo_product_pre_get_posts_query' );
	
	}
	
}