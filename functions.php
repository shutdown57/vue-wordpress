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


function vue_iranian_init() {

    $base_url = esc_url_raw( home_url() );
    $base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/');

    // wp_enqueue_script( 'vue-iranian', get_template_directory_uri() . '/dist/build.js', array(), '1.0.0', true );
    wp_localize_script( 'vue-iranian', 'ajaxPaths', array(
        'url' => admin_url( 'admin-ajax.php' ),
        'root'       => esc_url_raw( rest_url() ),
        'base_url'   => $base_url,
        'base_path'  => $base_path ? $base_path . '/' : '/',
        'nonce'      => wp_create_nonce( 'wp_vue' ), // Choose a good key for nonce
        'site_name'  => get_bloginfo( 'name' )
    ) );
}

// add_action( 'wp_enqueue_scripts', 'vue_iranian_init' );


/**
 * Theme Supports
 */
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 
    'post-formats', 
    array('aside', 'image', 'video', 'gallery', 'link', 'quote', 'status', 'chat')
 );