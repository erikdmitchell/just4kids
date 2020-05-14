<?php
/**
 * Template Name: Front Page
 **/
?>
<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <?php
                    if ( has_post_thumbnail() ) :
                        the_post_thumbnail( 'thumbnail' );
                    endif;
                    ?>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div><!-- .row -->
    </div><!-- .container -->

<?php
get_footer();
