<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

  <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

        <div class="container-fluid primary-nav">
            <div class="container">
                <?php j4k_header_logo(); ?>
                <nav class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".j4k-mobile-menu">
                            <span class="sr-only"><?php _e( 'Toggle navigation', 'j4k' ); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse primary-menu">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'menu_class' => 'nav navbar-nav pull-right',
                                'fallback_cb' => 'j4k_wp_bootstrap_navwalker::fallback',
                                'walker' => new j4k_wp_bootstrap_navwalker(),
                            )
                        );
                        ?>
                    </div> <!-- .primary-menu -->
                </nav>
            </div><!-- .container -->
        </div><!-- .navigation -->
