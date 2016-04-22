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
<meta name="viewport" content="width=1290">
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
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/parallax.css" type="text/css">

    <!-- Sensei CSS -->
        <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/parallax.css" type="text/css">

    <style>
        body {
            margin-top: -28px;
            padding-bottom: 28px;
        }
        body.admin-bar #wphead {
            padding-top: 0;
        }
        body.admin-bar #footer {
            padding-bottom: 28px;
        }
        #wpadminbar {
            top: auto !important;
            bottom: 0;
        }
        #wpadminbar .quicklinks .menupop ul {
            bottom: 28px;
        }
    </style>

<?php wp_head(); ?>
<?php echo get_theme_mod( 'understrap_theme_script_code_setting' ); ?>
</head>

<body id="page-top" <?php body_class(); ?>>

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top site-navigation">
        <div class="container-fluid">
            
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <!--  <a class="navbar-brand page-scroll" href="#page-top">Start Bootstrap</a> -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- The WordPress Menu goes here -->
                            <?php wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary',
                                        'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                                        'menu_class' => 'nav navbar-nav navbar-right',
                                        'nav_menu_css_class' => 'page-scroll',
                                        'fallback_cb' => '',
                                        'menu_id' => 'main-menu',
                                        'walker' => new wp_bootstrap_navwalker()
                                    )
                            ); ?>
                      
                <!-- <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#home">ผู้สอน</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#course">คอร์สออนไลน์</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll" href="#portfolio">ZA-SHI</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">ความเห็นผู้เรียน</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">รูปภาพ</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#video">Video</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">ติดต่อ</a>
                    </li>
                </ul> -->

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

<div id="page" class="hfeed site" style="">

<?php if(!is_home() && !is_front_page()) {
?>
<header id="not-home">
    <div class="row">
            <div class="col-lg-4" >
                <a class="page-scroll" href="#home"><img style="margin-top: 24px;" class="lazy" src="http://e-nihongo.com/wp-content/themes/za-shi/img/logo-shadow.png"></a>
            </div>
        </div>
</header>
<?php } else {?>
<header id="home">
        <div class="row" >
            <div class="col-lg-4">
                <a class="page-scroll" href="#home"><img  style="margin-top: 24px;" class="lazy" src="<?php echo get_bloginfo('template_url'); ?>/img/logo-shadow.png" /></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                 <div id="the-container" class="the-container">
                    <ul id="scene" class="scene">
                        <li class="layer" data-depth="0.80"><img class="lazy" src="<?php echo get_bloginfo('template_url'); ?>/images/layer1.png"></li>
                        <li class="layer" data-depth="0.60"><img class="lazy" src="<?php echo get_bloginfo('template_url'); ?>/images/layer2.png"></li>
                        <li class="layer" data-depth="0.40"><img class="lazy" src="<?php echo get_bloginfo('template_url'); ?>/images/layer3.png"></li>
                        <li class="layer" data-depth="0.20"><img class="lazy" src="<?php echo get_bloginfo('template_url'); ?>/images/layer4.png"></li>
                        <li class="layer" data-depth="1.00"><a class="fancybox iframe" href="https://www.youtube.com/embed/TUqsz4uLnGg?autoplay=1">
                            <img class="lazy" src="<?php echo get_bloginfo('template_url'); ?>/images/layer5.png">
                        </a></li>
                    </ul>
                </div>
                
            </div>
        </div>
        <div class="header-content">
        <div class="container">
            <div class="row">

            
            </div>
            <div class="header-content-inner">
              <!--   <h1>Your Favorite Source of Free Bootstrap Themes</h1>
                <hr>
                <p>Start Bootstrap can help you build better websites using the Bootstrap CSS framework! Just download your template and start going, no strings attached!</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a> -->
            </div>
        </div>
    </header>

        <script src="<?php echo get_bloginfo('template_url'); ?>/js/parallax.js"></script>
    <script type="text/javascript">
         var scene = document.getElementById('scene');
    var parallax = new Parallax(scene);
    </script>
<?php } ?>
    
    

                
