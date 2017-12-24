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

/**
 * Set cooie in browser
 */
function my_update_cookie( $logged_in_cookie ){
    $_COOKIE[LOGGED_IN_COOKIE] = $logged_in_cookie;
}
add_action( 'set_logged_in_cookie', 'my_update_cookie' );

add_filter( 'rest_pre_dispatch', 'prefix_return_current_user' );

function prefix_return_current_user( $result ) {
    $result = wp_get_current_user();
    $user_id = get_current_user_id();
    // var_dump(wp_set_current_user( $user_id ));
    // return $result;
}

function vue_iranian_init() {

    $base_url = esc_url_raw( home_url() );
    $base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/');

    // wp_enqueue_script( 'vue-iranian', get_template_directory_uri() . '/dist/build.js', array(), '1.0.0', true );

    wp_register_script('ajax-main', plugins_url('/src/main.js', __FILE__));

    wp_localize_script( 'vue-iranian', 'ajaxPaths', array(
        'url' => admin_url( 'admin-ajax.php' ),
        'root'       => esc_url_raw( rest_url() ),
        'base_url'   => $base_url,
        'base_path'  => $base_path ? $base_path . '/' : '/',
        'nonce'      => wp_create_nonce( 'wp_vue' ), // Choose a good key for nonce
        'site_name'  => get_bloginfo( 'name' )
    ) );
    wp_enqueue_script( 'ajax-main');
}

// add_action( 'wp_enqueue_scripts', 'vue_iranian_init' );

/**
 * Filters
 */
apply_filters( 'send_auth_cookies', true );

/**
 * Theme Supports
 */
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 
    'post-formats', 
    array('aside', 'image', 'video', 'gallery', 'link', 'quote', 'status', 'chat')
 );