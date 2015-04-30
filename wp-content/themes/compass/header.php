<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
  <!--  <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="page-wrap">

    <header class="site-header">
        <nav class="navbar" role="navigation" style="background-color:rgb(13,139,161);height:125px">
            <div class="inner-wrap">
                <div class="navbar-brand" style="display:inline-block">

                    <?php if ( ! compass_has_logo() ) echo '<h1>';?>

                    <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'description' ); ?>" >
<img src="https://gamers-cv.com/blog-iapulse/wp-content/uploads/2015/04/IA-Blanc.png" width="75" height="75" title="" alt="ia-pulse" style="margin-bottom:12px"/>              
 <?php
                        if ( compass_has_logo() ) {
                            compass_logo();
                        } else {
                            bloginfo( 'name' );
                        }
                        ?>

                    </a>

                    <?php if ( ! compass_has_logo() ) echo '</h1>'; ?>

                </div><!-- .navbar-brand -->


                <nav class="main-navbar" role="navigation" style="display:inline-block">

                    <div class="navbar-header">
                        <?php if ( has_nav_menu( 'primary' ) ) { ?>

                           <a class="navbar-toggle" href="#menu-main-slide">
                               <span class="icon-bar"></span>
                               <span class="icon-bar"></span>
                               <span class="icon-bar"></span>
                           </a>


                           <?php wp_nav_menu( array(
                               'container_id'   => 'menu-main-slide',
                               'theme_location' => 'primary'
                           ) );
                       }  ?>

                    </div>


                    <div id="navbar-main">

                        <?php if (has_nav_menu( 'primary' )) {
                            wp_nav_menu( array(
                                'menu_class'     => 'nav navbar-nav dropdown sf-menu',
                                'theme_location' => 'primary'
                            ) );
                        } 


?>


                    </div><!-- #navbar-main -->



                </nav><!-- .navbar -->

                <?php if ( ! get_theme_mod( 'navbar-hide-search', compass_get_default( 'navbar-hide-search' ) ) ) : ?>
                    <?php get_search_form(); ?>
                <?php endif; ?>

                <div class="clear"></div>

            </div>

        </nav><!-- .navbar -->

    </header><!-- .site-header -->

    <?php if ( option::is_on( 'breaking_on' ) ) : ?>

        <?php get_template_part( 'breaking-news' ); ?>

    <?php endif; ?>
