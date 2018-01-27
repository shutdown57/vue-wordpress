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
// TODO: Make privilage for routes
add_action( 'rest_api_init', function () {
    register_rest_route( 'forms/v1', '/ask-question',
        array(
            'methods' => 'GET',
            'callback' => 'ask_question_form'
        ) );
    
    register_rest_route( 'complete/v1', '/register', 
        array(
            'methods' => 'GET',
            'callback' => 'complete_registeration'
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
    
    register_rest_route( 'info/v1', '/user_info',
        array(
            'methods' => 'GET',
            'callback' => 'get_user_info'
        )
     );
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
        return array('status' => 'مشکل در دریافت اطلاعات.');
    }

    $comp_email = 'iranian.group@yahoo.com';

    $to = array($user_email, $comp_email);

    wp_mail( $to, $title, $content );

    return array('status' => 'اطلاعات به درستی دریافت شد.');
}

/**
 * Send user information
 */
function get_user_info( WP_REST_Request $request ) {
    $email = esc_attr( $request->get_param('email') );

    $user = get_user_by( 'email', $email );
    
    return new WP_REST_Response( array(
        'status' => 'success',
        'data' => array(
            'user_info' => get_user_meta( $user->ID )
        )
    ) );
}

/**
 * Complete registration user information
 */
function complete_registeration( WP_REST_Request $request ) {
    $email = esc_attr( $request->get_param('email') );
    $phone = esc_attr( $request->get_param('phone') );
    $mobile = esc_attr( $request->get_param('mobile') );
    $address = esc_attr( $request->get_param('address') );
    $bussiness = esc_attr( $request->get_param('bussiness') );

    $user = get_user_by( 'email', $email );

    add_user_meta( $user->ID, 'phone', $phone );
    add_user_meta( $user->ID, 'mobile', $mobile );
    add_user_meta( $user->ID, 'address', $address );
    add_user_meta( $user->ID, 'bussiness', $bussiness );

    return new WP_REST_Response( array(
        'status' => 'success',
        'data' => array(
            'message' => 'اطلاعات دریافت شد.'
        )
    ) );
}

/**
 * Handling order form
 */
function order_form( WP_REST_Request $request ) {
    $user_email = esc_attr( $request->get_param('user_email') );
    $title = esc_attr( $request->get_param('title') );
    $description = esc_attr( $request->get_param( 'description' ) );
    $name = esc_attr( $request->get_param( 'name' ) );
    $productType = esc_attr( $request->get_param( 'productType' ) );
    $circulation = esc_attr( $request->get_param( 'circulation' ) );
    $size_X = esc_attr( $request->get_param( 'size_X' ) );
    $size_Y = esc_attr( $request->get_param( 'size_Y' ) );
    if ( !$description || !$name ||
         !$productType || !$circulation ||
         !$size_X || !$size_Y )
    {
        return array('status' => 'مشکل در دریافت اطلاعات');
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

    $user = get_user_by( 'email', $user_email );

    wp_remote_get( $message );

    global $wpdb;

    $wpdb->query("CREATE TABLE IF NOT EXISTS wp_orders(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED NOT NULL,
        description TEXT,
        title VARCHAR(50),
        name VARCHAR(50),
        product_type VARCHAR(50) NOT NULL,
        circulation VARCHAR(10),
        size VARCHAR(10),
        date DATE
        )ENGINE=MyISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci"
    );

    $current_date = current_time( 'Y-m-d' );

    $wpdb->insert('wp_orders',
        array(
            'user_id' => $user->ID,
            'description' => $description,
            'title' => $title,
            'name' => $name,
            'product_type' => $productType,
            'circulation' => $circulation,
            'size' => $size_X . 'x' . $size_Y,
            'date' => $current_date
        ),
        array( '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
    );

     return new WP_REST_Response( array(
        'status' => 'success',
        'data' => array(
            'message' => 'اطلاعات دریافت شد.'
        ),
        'ok' => true
    ), 200 );
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