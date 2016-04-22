<?php
/**
 * Template Name: Paper Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published
 *
 * @package understrap
 */

get_header(); ?>

<style>
    /* Minimum width of 960 pixels. */
@media screen and (min-width: 960px) {
    body {
        background-color: #e6e6e6;
    }
    body .site {
        background: #fff;
        padding: 0 40px;
        padding: 0 2.857142857rem;
        margin-top: 48px;
        margin-top: 3.428571429rem;
        margin-bottom: 48px;
        margin-bottom: 3.428571429rem;
        box-shadow: 0 2px 6px rgba(100, 100, 100, 0.3);
    }
    body.custom-background-empty {
        background-color: #fff;
    }
    body.custom-background-empty .site,
    body.custom-background-white .site {
        padding: 0;
        margin-top: 0;
        margin-bottom: 0;
        box-shadow: none;
    }
}
</style>

<div class="wrapper" id="page-wrapper">
    
    <div  id="content" class="container">
        
	   <div id="primary" class="col-md-12 content-area">

            <main id="main" class="site-main" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'loop-templates/content', 'page' ); ?>

                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :

                            comments_template();
                        
                        endif;
                    ?>

                <?php endwhile; // end of the loop. ?>

            </main><!-- #main -->
           
	    </div><!-- #primary -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>