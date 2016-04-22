<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/bootstrap.min.css" type="text/css">

    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/zashi.css" type="text/css">

<?php wp_head(); ?>
<?php echo get_theme_mod( 'understrap_theme_script_code_setting' ); ?>
</head>

<body id="page-top" <?php body_class(); ?>>

<div id="page" class="hfeed site">
    
    <!-- ******************* The Navbar Area ******************* -->
    <div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">
	
        <nav id="mainNav" class="site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                            
            <div class="navbar navbar-inverse">

                <div class="container">

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="navbar-header">

                                <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                                <!-- Your site title as branding in the menu -->
                                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>

                            </div>

                            <!-- The WordPress Menu goes here -->
                            <?php wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary',
                                        'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                                        'menu_class' => 'nav navbar-nav',
                                        'fallback_cb' => '',
                                        'menu_id' => 'main-menu',
                                        'walker' => new wp_bootstrap_navwalker()
                                    )
                            ); ?>

                        </div> <!-- .col-md-11 or col-md-12 end -->

                    </div> <!-- .row end -->

                </div> <!-- .container -->
                
            </div><!-- .navbar -->
            
        </nav><!-- .site-navigation -->
        
    </div><!-- .wrapper-navbar end -->






