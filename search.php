<?php
/**
 * The template for displaying search results pages.
 *
 * @package j4k
 * @since j4k 1.0.0
 */
 
?>
<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <?php if ( have_posts() ) : ?>
                <header class="page-header">
                    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'j4k' ), get_search_query() ); ?></h1>
                </header><!-- .page-header -->

                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <?php get_template_part( 'content', 'search' ); ?>
                <?php endwhile; ?>

                <?php
                the_posts_navigation(
                    array(
                        'prev_text' => __( '&laquo; Older Posts', 'j4k' ),
                        'next_text' => __( 'Newer Posts &raquo;', 'j4k' ),
                    )
                );
                ?>

            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>

        </div>
        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div><!-- .container -->

<?php get_footer(); ?>
