<?php
/**
 * The default template
 *
 * @package j4k
 * @since j4k 1.0.0
 */
 
?>

<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <?php get_template_part( 'content' ); ?>
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
                ?>
            <?php endwhile; ?>
            
            <?php
                the_posts_navigation(
                    array(
                        'prev_text' => __( '&laquo; Older Posts', 'j4k' ),
                        'next_text' => __( 'Newer Posts &raquo;', 'j4k' ),
                    )
                );
                ?>
            
        </div>
        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div><!-- .container -->

<?php get_footer(); ?>
