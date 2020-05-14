<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
    	<meta charset="<?php bloginfo( 'charset' ); ?>">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="profile" href="https://gmpg.org/xfn/11">
    
    	<?php wp_head(); ?>
    </head>

  <body <?php body_class(); ?>>
        <div class="container">
            <div class="row">
            	<header id="masthead" class="site-header">
            		<div class="site-branding">
            			<?php j4k_header_logo(); ?>
            		</div><!-- .site-branding -->
            
            		<nav id="site-navigation" class="main-navigation">
            			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fas fa-bars"></i></button>
            			<?php
            			wp_nav_menu(
            				array(
                                'theme_location' => 'primary',
            					'menu_id'        => 'primary-menu',
            				)
            			);
            			?>
            		</nav><!-- #site-navigation -->
            	</header><!-- #masthead -->
            </div>
        </div>