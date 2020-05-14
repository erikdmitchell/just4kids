<?php
/**
 * Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @package j4k
 * @since j4k 1.0.0
 */

/**
 * Set our global variables for theme options.
 *
 * @since j4k 1.0.0
 */
if ( ! isset( $j4k_theme_options ) ) {
    $j4k_theme_options = array( 'option_name' => 'j4k_theme_options' );
}

if ( ! isset( $j4k_theme_options_tabs ) ) {
    $j4k_theme_options_tabs = array();
}

if ( ! isset( $j4k_theme_options_hooks ) ) {
    $j4k_theme_options_hooks = array();
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since j4k 1.0.0
 */
function j4k_theme_setup() {
    // Set the content width based on the theme's design and stylesheet //
    $GLOBALS['content_width'] = apply_filters( 'j4k_content_width', 1200 );

    /**
     * add our theme support options
     */
    $custom_header_args = array(
        'width' => 163,
        'height' => 76,
        'flex-width' => true,
        'flex-height' => true,
    );

    $custom_background_args = array(
        'deafult-color' => 'ffffff',
    );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-header', $custom_header_args );
    add_theme_support( 'custom-background', $custom_background_args );
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );

    /**
     * add our image size(s)
     */
    add_image_size( 'j4k-navbar-logo', 163, 100, true );
    add_image_size( 'j4k-home-image', 9999, 400, true );
    add_image_size( 'j4k-home-blog-post-image', 555, 225, true );

    // register our navigation area
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'j4k' ),
        )
    );

    /**
     * This theme styles the visual editor to resemble the theme style
     */
    add_editor_style( 'inc/css/editor-style.css' );

}
add_action( 'after_setup_theme', 'j4k_theme_setup' );

/**
 * Register widget area.
 *
 * @since j4k 1.0.0
 */
function j4k_theme_widgets_init() {

    register_sidebar(
        array(
            'name' => 'Footer 1',
            'id' => 'footer-1',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name' => 'Footer 2',
            'id' => 'footer-2',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );

}
add_action( 'widgets_init', 'j4k_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 *
 * @since j4k 1.1.9
 */
function j4k_theme_scripts() {
    // scripts
    wp_enqueue_script( 'j4k-theme-script', get_template_directory_uri() . '/inc/js/j4k-theme.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'j4k-navigation-script', get_template_directory_uri() . '/inc/js/navigation.min.js', array( 'jquery' ), '1.0.0', true );

    if ( is_singular() ) {
        wp_enqueue_script( 'comment-reply' );
    }

    /**
     * Load our IE specific scripts for a range of older versions:
     * <!--[if lt IE 9]> ... <![endif]-->
     * <!--[if lte IE 8]> ... <![endif]-->
    */
    // HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries //
    wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/inc/js/html5shiv.js', array(), '3.7.3-pre' );
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'respond', get_template_directory_uri() . '/inc/js/respond.js', array(), '1.4.2' );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    // enqueue font awesome and our main stylesheet
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/css/fa.min.css', array(), '5.13.0' );
    wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri() . '/inc/css/bootstrap-grid.min.css', array(), '4.5.0' );
    wp_enqueue_style( 'j4k-theme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'j4k_theme_scripts' );

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since j4k 1.0
 * @based on twentyfourteen
 *
 * @return void
 */
function j4k_theme_post_thumbnail( $size = 'full' ) {
    global $post;

    $html = null;
    $attr = array(
        'class' => 'img-responsive',
    );

    if ( post_password_required() || ! has_post_thumbnail() ) {
        return;
    }

    if ( is_singular() ) :
        $html .= '<div class="post-thumbnail">';
            $html .= get_the_post_thumbnail( $post->ID, $size, $attr );
        $html .= '</div>';
    else :
        $html .= '<a class="post-thumbnail" href="' . esc_url( get_permalink( $post->ID ) ) . '">';
            $html .= get_the_post_thumbnail( $post->ID, $size, $attr );
        $html .= '</a>';
    endif;

    $image = apply_filters( 'j4k_theme_post_thumbnail', $html, $size, $attr );

    echo $image;
}

/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since j4k 1.0
 * @based on twentyfourteen
 *
 * @return void
 */
function j4k_theme_posted_on() {
    $html = null;

    if ( is_sticky() && is_home() && ! is_paged() ) :
        $html = '<span class="featured-post"><span class="glyphicon glyphicon-pushpin"></span>' . __( 'Sticky', 'j4k' ) . '</span>';
    elseif ( ! is_sticky() ) :     // Set up and print post meta information. -- hide date if sticky
        $html = '<span class="entry-date"><span class="glyphicon glyphicon-time"></span><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><time class="entry-date" datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time></a></span>';
    else :
        $html = '<span class="byline"><span class="glyphicon glyphicon-user"></span><span class="author vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author">' . get_the_author() . '</a></span></span>';
    endif;

    echo apply_filters( 'j4k_posted_on', $html );
}

/**
 * j4k_display_meta_description function.
 *
 * a custom function to display a meta description for our site pages
 *
 * @access public
 * @return void
 */
function j4k_display_meta_description() {
    global $post;

    $title = null;

    if ( isset( $post->post_title ) ) {
        $title = $post->post_title;
    }

    if ( is_single() ) :
        return apply_filters( 'j4k_display_meta_description', single_post_title( '', false ) );
    else :
        return apply_filters( 'j4k_display_meta_description', $title . ' - ' . get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' ) );
    endif;

    return false;
}

/**
 * j4k_back_to_top function.
 *
 * @access public
 * @return void
 */
function j4k_back_to_top() {
    $html = null;

    $html .= '<a href="#0" class="j4k-back-to-top"></a>';

    echo apply_filters( 'j4k_back_to_top', $html );
}
add_action( 'wp_footer', 'j4k_back_to_top' );

/**
 * j4k_wp_parse_args function.
 *
 * Similar to wp_parse_args() just a bit extended to work with multidimensional arrays
 *
 * @access public
 * @param mixed &$a
 * @param mixed $b
 * @return void
 */
function j4k_wp_parse_args( &$a, $b ) {
    $a = (array) $a;
    $b = (array) $b;
    $result = $b;

    foreach ( $a as $k => &$v ) {
        if ( is_array( $v ) && isset( $result[ $k ] ) ) {
            $result[ $k ] = j4k_wp_parse_args( $v, $result[ $k ] );
        } else {
            $result[ $k ] = $v;
        }
    }

    return $result;
}

/**
 * j4k_get_excerpt_by_id function.
 *
 * @access public
 * @param string $post (default: '')
 * @param int    $length (default: 10)
 * @param string $tags (default: '<a><em><strong>')
 * @param string $extra (default: '...')
 * @return void
 */
function j4k_get_excerpt_by_id( $post = '', $length = 10, $tags = '<a><em><strong>', $extra = '...' ) {
    // if post is id, get the post, if it's the object we are ok, else bail //
    if ( is_int( $post ) ) :
        $post = get_post( $post );
    elseif ( ! is_object( $post ) ) :
        return false;
    endif;

    // check for excerpt and return that, else grab the post content //
    if ( has_excerpt( $post->ID ) ) :
        $the_excerpt = $post->post_excerpt;
        return apply_filters( 'the_content', $the_excerpt );
    else :
        $the_excerpt = $post->post_content;
    endif;

    $the_excerpt = strip_shortcodes( strip_tags( $the_excerpt ), $tags ); // remove shortcodes and tags
    $the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2 + 1 ); // do our length (words)
    $excerpt_waste = array_pop( $the_excerpt ); // grab the "excerpt"
    $the_excerpt = implode( $the_excerpt ); // convert our array of words to an actual exceprt
    $the_excerpt .= $extra; // append the extra

    return apply_filters( 'the_content', $the_excerpt );
}

/**
 * j4k_theme_get_image_id_from_url function.
 *
 * @access public
 * @param mixed $image_url
 * @return void
 */
function j4k_theme_get_image_id_from_url( $image_url ) {
    global $wpdb;

    $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );

    return $attachment[0];
}

/**
 * j4k_array_recursive_diff function.
 *
 * @access public
 * @param mixed $aArray1
 * @param mixed $aArray2
 * @return void
 */
function j4k_array_recursive_diff( $aArray1, $aArray2 ) {
    $aReturn = array();

    foreach ( $aArray1 as $mKey => $mValue ) {
        if ( array_key_exists( $mKey, $aArray2 ) ) {
            if ( is_array( $mValue ) ) {
                $aRecursiveDiff = j4k_array_recursive_diff( $mValue, $aArray2[ $mKey ] );
                if ( count( $aRecursiveDiff ) ) {
                    $aReturn[ $mKey ] = $aRecursiveDiff; }
            } else {
                if ( $mValue != $aArray2[ $mKey ] ) {
                    $aReturn[ $mKey ] = $mValue;
                }
            }
        } else {
            $aReturn[ $mKey ] = $mValue;
        }
    }
    return $aReturn;
}

function j4k_header_logo() {
    echo '<img src="' . get_stylesheet_directory_uri() . '/inc/images/just4kids-logo.png" alt="j4k-logo" />';
}
