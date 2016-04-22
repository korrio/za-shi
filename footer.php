<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */
?>

<?php get_template_part('widget-templates/footerfull'); ?>

<div class="wrapper" id="wrapper-footer">
    
    <div class="container">

        <div class="row">

            <div class="col-md-12">
    
                <footer id="colophon" class="site-footer" role="contentinfo">

                    <div class="site-info">
                        
                    </div><!-- .site-info -->

                </footer><!-- #colophon -->

            </div><!--col end -->

        </div><!-- row end -->
        
    </div><!-- container end -->
    
</div><!-- wrapper end -->

</div><!-- #page -->

<?php wp_footer(); ?>



<!-- Loads slider script and settings if a widget on pos hero is published -->
<?php if ( is_active_sidebar( 'hero' ) ): ?>

<script>
    jQuery(document).ready(function() {
        var owl = jQuery('.owl-carousel');
        owl.owlCarousel({
            items:<?php echo get_theme_mod( 'understrap_theme_slider_count_setting', 1 );?>,
            loop:<?php echo get_theme_mod( 'understrap_theme_slider_loop_setting', true );?>,
            autoplay:true,
            autoplayTimeout:<?php echo get_theme_mod( 'understrap_theme_slider_time_setting', 5000 );?>,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            nav: false,
            dots: true,
            autoplayHoverPause:true,
            margin:0,
            autoHeight:true
        });

        jQuery('.play').on('click',function(){
            owl.trigger('autoplay.play.owl',[1000])
        });
        jQuery('.stop').on('click',function(){
            owl.trigger('autoplay.stop.owl')
        });

        $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
        });
    });


</script>
<?php endif; ?>



    <!-- Plugin JavaScript -->
    <script src="<?php echo get_bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo get_bloginfo('template_url'); ?>/js/jquery.easing.min.js"></script>
    <script src="<?php echo get_bloginfo('template_url'); ?>/js/jquery.fittext.js"></script>
    <script src="<?php echo get_bloginfo('template_url'); ?>/js/wow.min.js"></script>
    <script src="<?php echo get_bloginfo('template_url'); ?>/js/creative.js"></script>

    

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.js">
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>


    <script>

    // Pretty simple huh?
   
    jQuery(document).ready(function() {
        jQuery("#main-menu").append('<li id="menu-item-39" style="list-style: none;" class="menu-item menu-item-type-post_type menu-item-object-page nav-item menu-item-39"><a title="ห้องเรียนออนไลน์" href="http://128.199.113.225/server.php?id=<?=get_current_user_id()?>" target="_blank">ห้องเรียนออนไลน์</a></li>');
        jQuery("img.lazy").lazyload();
        jQuery(".fancybox").fancybox({
                        padding : 0
                    });
    });

    </script>

    

</body>

</html>
