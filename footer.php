
        <footer>            
            <div class="footer-widgets">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <?php echo do_shortcode( '[mappress mapid="1" width="100%"]' ); ?>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <?php dynamic_sidebar( 'footer-1' ); ?>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <?php dynamic_sidebar( 'footer-2' ); ?>
                        </div>
                    </div>
                </div> <!-- /container -->
            </div><!-- .footer-widgets -->
            <div class="copyright">
                <?php echo get_bloginfo( 'name' ); ?> <?php _e( '&copy', 'j4k' ); ?> <?php echo date_i18n( esc_html__( 'Y', 'j4k' ) ); ?>
            </div>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html>
