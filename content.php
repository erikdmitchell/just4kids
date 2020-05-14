<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search. -- Currently page.php and index.php
 *
 * @subpackage j4k
 * @since j4k 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if ( is_single() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
        endif;
        ?>

        <div class="entry-meta">
            <?php
            if ( 'post' == get_post_type() ) {
                j4k_theme_posted_on();
            }

            if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
                ?>
                    <span class="comments-link"><span class="glyphicon glyphicon-comment"></span><?php comments_popup_link( __( 'Leave a comment', 'j4k' ), __( '1 Comment', 'j4k' ), __( '% Comments', 'j4k' ) ); ?></span>
                <?php
                endif;

                edit_post_link( __( 'Edit', 'j4k' ), '<span class="edit-link"><span class="glyphicon glyphicon-pencil"></span>', '</span>' );
            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <?php if ( is_search() ) : ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-content">
        <?php
            the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'j4k' ) );
            wp_link_pages(
                array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'j4k' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                )
            );
        ?>
    </div><!-- .entry-content -->
    <?php endif; ?>

    <?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
