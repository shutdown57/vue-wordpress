<?php
/**
 * Theme Functions
*/
// add_action( 'wp_head', 'ajax_vue_routes' );
// function ajax_vue_routes() {

//     $base_url = esc_url_raw( home_url() );
//     $base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/');
    
//     echo '<script type="text/javascript">
//         var ajax_vue = {
//             root: ' . esc_url_raw( rest_url() ) . ',
//             base_url: "' . $base_url . '",
//             base_path: "' . $base_path ? $base_path . '/' : '/' . '",
//             nonce: "' . wp_create_nonce( 'wp_vue' ) . '",
//             site_name: "' . get_bloginfo( 'name' ) . '"
//         };
//         </script>';
// }


// function vue_iranian_init() {

//     $base_url = esc_url_raw( home_url() );
//     $base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/');

//     wp_enqueue_script( 'vue-iranian', get_template_directory_uri() . '/dist/build.js', array(), '1.0.0', true );
//     wp_localize_script( 'vue-iranian', 'ajax_vue', array(
//         // 'url' => admin_url( 'admin-ajax.php' ),
//         'root'       => esc_url_raw( rest_url() ),
//         'base_url'   => $base_url,
//         'base_path'  => $base_path ? $base_path . '/' : '/',
//         'nonce'      => wp_create_nonce( 'wp_vue' ),
//         'site_name'  => get_bloginfo( 'name' )
//     ) );
// }

// add_action( 'wp_enqueue_scripts', 'vue_iranian_init' );

add_theme_support( 'title-tag' );

function vue_iranian_routes() {
    $routes = [];
    $args = array(
        'post_type' => 'any',
        'post_status' => 'published',
        'posts_per_page' => -1
    );
    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            $routes = array(
                'id' => get_the_ID(),
                'type' => get_post_type(),
                'slug' => basename( get_permalink() )
            );
        }
    }
    wp_reset_query();

    return $routes;
}

/**
 * Theme Supports
 */
add_theme_support( 'post-thumbnails' );
add_theme_support( 
    'post-formats', 
    array('aside', 'image', 'video', 'gallery', 'link', 'quote', 'status', 'chat')
 );