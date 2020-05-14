<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package j4k
 * @since j4k 1.1.0
 */

?>
<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <header class="entry-header">
                    <h1 class="page-title"><?php esc_html_e( 'Not Found', 'j4k' ); ?></h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <h2><?php esc_html_e( "This is somewhat embarrassing, isn't it?", 'j4k' ); ?></h2>
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'j4k' ); ?></p>

                    <?php get_search_form(); ?>
                </div><!-- .entry-content -->

            </article><!-- #post-## -->
        </div>
    </div>
</div>

<?php get_footer(); ?>
