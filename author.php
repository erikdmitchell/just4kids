<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
 *
 * @subpackage j4k
 * @since j4k 1.0.0
 */
?>
<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if ( have_posts() ) : ?>

                <?php
                    /*
                     Queue the first post, that way we know
                     * what author we're dealing with (if that is the case).
                     *
                     * We reset this later so we can run the loop
                     * properly with a call to rewind_posts().
                     */
                    the_post();
                ?>

                <header class="archive-header">
                    <h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'j4k' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
                </header><!-- .archive-header -->

                <?php
                    /*
                     Since we called the_post() above, we need to
                     * rewind the loop back to the beginning that way
                     * we can run the loop properly, in full.
                     */
                    rewind_posts();
                ?>

                <?php
                the_posts_navigation(
                    array(
                        'prev_text' => __( '&laquo; Older Posts', 'j4k' ),
                        'next_text' => __( 'Newer Posts &raquo;', 'j4k' ),
                    )
                );
                ?>

                <?php
                // If a user has filled out their description, show a bio on their entries.
                if ( get_the_author_meta( 'description' ) ) :
                    ?>
                <div class="author-info">
                    <div class="author-avatar">
                        <?php
                        /**
                         * Filter the author bio avatar size.
                         *
                         * @since Twenty Twelve 1.0
                         *
                         * @param int $size The height and width of the avatar in pixels.
                         */
                        $author_bio_avatar_size = apply_filters( 'j4k_author_bio_avatar_size', 68 );
                        echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
                        ?>
                    </div><!-- .author-avatar -->
                    <div class="author-description">
                        <h2><?php printf( __( 'About %s', 'j4k' ), get_the_author() ); ?></h2>
                        <p><?php the_author_meta( 'description' ); ?></p>
                    </div><!-- .author-description  -->
                </div><!-- .author-info -->
                <?php endif; ?>

                <?php /* Start the Loop */ ?>
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <?php get_template_part( 'content', get_post_format() ); ?>
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
