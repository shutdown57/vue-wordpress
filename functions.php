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

/**
 * PHPMAILER Configuration
 */
add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = SMTP_HOST;
    $phpmailer->SMTPAuth   = SMTP_AUTH;
    $phpmailer->Port       = SMTP_PORT;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->Username   = SMTP_USERNAME;
    $phpmailer->Password   = SMTP_PASSWORD;
    $phpmailer->From       = SMTP_FROM;
    $phpmailer->FromName   = SMTP_FROMNAME;
}

/**
 * Ask form handling
 */
add_action( 'rest_api_init', function () {
    register_rest_route( 'forms/v1', '/ask-question',
        array(
            'methods' => 'GET',
            'callback' => 'ask_question_form'
        ) );

    register_rest_route( 'forms/v1', '/order', 
        array(
            'methods' => 'GET',
            'callback' => 'order_form'
        ));

    register_rest_route( 'hook/v1', '/message',
        array(
            'methods' => 'GET',
            'callback' => 'telegram_webhook'
        ));
} );
/**
 * Handling send mail
 */
function ask_question_form( WP_REST_Request $request ) {
    
    $user_email = esc_attr( $request->get_param( 'email' ) );
    $mobile = esc_attr( $request->get_param( 'mobile' ) );
    $title = esc_attr( $request->get_param('title') );
    $content = esc_attr( $request->get_param('content') );

    if ( !$user_email || !$title || !$content || !$mobile ) {
        return WP_REST_Response( array('status' => 'مشکل در دریافت اطلاعات.') );
    }

    $comp_email = 'iranian.group@yahoo.com';

    $to = array($user_email, $comp_email);

    wp_mail( $to, $title, $content );

    return WP_REST_Response( array('status' => 'اطلاعات به درستی دریافت شد.'), 200 );
}

/**
 * Handling order form
 */
function order_form( WP_REST_Request $request ) {
    $description = esc_attr( $request->get_param( 'description' ) );
    $name = esc_attr( $request->get_param( 'name' ) );
    $productType = esc_attr( $request->get_param( 'productType' ) );
    $circulation = esc_attr( $request->get_param( 'circulation' ) );
    $size_X = esc_attr( $request->get_param( 'X' ) );
    $size_Y = esc_attr( $request->get_param( 'Y' ) );
    if ( !$description || !$name ||
         !$productType || !$circulation ||
         !$size_X || !$size_Y )
    {
        return WP_REST_Response( array('status' => 'مشکل در دریافت اطلاعات') );
    }
    $BOT_TOKEN = '518028163:AAEXiscPjLh6RE7GAi-J5ujf-TLk_5dSoMU';
    $BOT_ID = '@Iranianmagnetbot';
    $CHAT_ID = '-300909047';
    $URL = 'http://wordpress.app/wp-json/hook/v1/message';
    $API_URL = 'https://api.telegram.org/bot' . $BOT_TOKEN . '/sendMessage?chat_id=' . $CHAT_ID;
    
    $message = $API_URL . '&text=' . urlencode( 
        'توضیحات: ' . $description . '    ' .
        'نام: ' . $name . '    ' .
        'نوع محصول: ' . $productType . '    ' .
        'تیراژ:‌ ' . $circulation . '    ' .
        'اندازه: ' . $size_X . 'x' . $size_Y
     );

     wp_remote_get( $message );

     return wp_json_encode( array(
        'status' => 'success',
        'data' => 'اطلاعات دریافت شد.',
        'ok' => true
     ) );
}

/**
 * Handling telegram webhook
 */
function telegram_webhook( WP_REST_Request $request ) {

    $user_email = esc_attr( $request->get_param( 'email' ) );
    $mobile = esc_attr( $request->get_param( 'mobile' ) );
    $title = esc_attr( $request->get_param('title') );
    $content = esc_attr( $request->get_param('content') );

    if ( !$request->get_param('email') ) {
        return WP_REST_Response( array('status' => 'مشکل در دریافت اطلاعات.') );
    }

    $BOT_TOKEN = '518028163:AAEXiscPjLh6RE7GAi-J5ujf-TLk_5dSoMU';
    $BOT_ID = '@Iranianmagnetbot';
    $CHAT_ID = '-300909047';
    $URL = 'http://wordpress.app/wp-json/hook/v1/message';
    $API_URL = 'https://api.telegram.org/bot' . $BOT_TOKEN . '/sendMessage?chat_id=' . $CHAT_ID;

    $API_URL = $API_URL . '&text=' . urlencode( 
        'ایمیل: ' . $user_email . '    ' .
        'شماره تلفن موبایل: ' . $mobile . '    ' .
        'موضوع: ' . $title . '    ' .
        'متن پیام: ' . $content
     );
    wp_remote_get( $API_URL );
    return wp_json_encode( array(
        'status' => 'success',
        'data' => 'اطلاعات دریافت شد.',
        'ok' => true
    ) );
}

//add_action( 'wp_ajax_form_sign_up', 'form_sign_up' ); // ajax for logged in users
//add_action( 'wp_ajax_nopriv_form_sign_up', 'form_sign_up' ); // ajax for not logged in users
//function form_sign_up() {
//    if (isset($_REQUEST) && wp_verify_nonce($_REQUEST["nonce"], "_user_nonce")) {
//        $username = $_REQUEST["username"];
//        $password = $_REQUEST["password"];
//        $passconf = $_REQUEST["passconf"];
//        $first_name = $_REQUEST["first_name"];
//        $last_name = $_REQUEST["last_name"];
//        $brand_name = $_REQUEST["brand_name"];
//        $email = $_REQUEST["email"];
//        $phone = $_REQUEST["phone"];
//        $mobile = $_REQUEST["mobile"];
//        $address = $_REQUEST["address"];
//
//        if (empty($username) || empty($password) || empty($passconf) ||
//            empty($first_name) || empty($last_name) || empty($brand_name) ||
//            empty($email) || empty($phone) || empty($mobile) ||
//            ($password !== $passconf) || (empty($address))) {
//            $result["data"] = "لطفا تمامی فیلدها را به درستی و کامل پر کنید";
//            $result = json_encode($result);
//            echo $result;
//            wp_die();
//        }
//
//        // Insert data into database by $wpdb
//        global $wpdb;
//
//        $user = $wpdb->get_row(
//            "SELECT * FROM wp_clients WHERE username='". $username ."'"
//        );
//
//        if ($user){
//            $result["message"] = "کاربر با این نام کاربری موجود است";
//            $result["data"] = true;
//            $result = json_encode($result);
//            echo $result;
//            wp_die();
//        } else {
//            $wpdb->insert('wp_clients',
//                array(
//                    'username' => $username,
//                    'password' => wp_hash_password($password),
//                    'firstname' => $first_name,
//                    'lastname' => $last_name,
//                    'email' => $email,
//                    'brandname' => $brand_name,
//                    'phone' => $phone,
//                    'mobile' => $mobile,
//                    'address' => $address
//                ),
//                array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));
//            $result["data"] = "به ایرانیان مگنت خوش آمدید";
//            $result = json_encode($result);
//            echo $result;
//        }
//
//    } else {
//        $result["data"] = "لطفا اطلاعات را به صورت کامل وارد نمایید";
//        $result = json_encode($result);
//        echo $result;
//    }
//    wp_die();
//}