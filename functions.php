<?php

/**
 * Import Jalali DateTime
 */
require_once('jdf.php');

/**
 * Set cooie in browser
 */
function my_update_cookie( $logged_in_cookie ){
    $_COOKIE[LOGGED_IN_COOKIE] = $logged_in_cookie;
}
add_action( 'set_logged_in_cookie', 'my_update_cookie' );

/**
 * Get and set current user
 */
function prefix_return_current_user( $result ) {
    $result = wp_get_current_user();
    $user_id = get_current_user_id();
    
    if ( !is_user_logged_in() ) {
        return new WP_Error( 
            'not-logged-in', 
            'این درخواست غیر مجاز میباشد', 
            array( 'status' => 401 ) 
        );
    }
}
add_filter( 'rest_pre_dispatch', 'prefix_return_current_user' );

/**
 * Send cookie filter
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
 * Main configuration in wp-config.php
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
    
    register_rest_route( 'forms/v1', '/orders', 
         array(
             'methods' => 'GET',
             'callback' => 'get_orders'
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
        return new WP_Error(
            'not-filled-fields',
            'اطلاعات به درستی وارد نشده‌اند',
            array( 'status' => 'faild' )
        );
    }

    $comp_email = ''; // company email address

    $to = array($user_email, $comp_email);

    wp_mail( $to, $title, $content );

    return new WP_REST_Response(
        array(
            'status' => 'success',
            'data' => array(
                'message' => 'اطلاعات به درستی دریافت شد.'
            ),
            'ok' => true
        ),
        201 );
}

/**
 * Send user information
 */
function get_user_info( WP_REST_Request $request ) {
    $email = esc_attr( $request->get_param('email') );

    $user = get_user_by( 'email', $email );
    
    return new WP_REST_Response( 
        array(
            'status' => 'success',
            'data' => array(
                'user_info' => get_user_meta( $user->ID )
            )
        ),
        200 );
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

    if ( !$email || !$phone || !$mobile || !$bussiness) {
        return new WP_Error(
            'not-filled-fields',
            'اطلاعات به درستی وارد نشده‌اند',
            array( 'status' => 'faild' )
        );
    }

    $user = get_user_by( 'email', $email );

    add_user_meta( $user->ID, 'phone', $phone );
    add_user_meta( $user->ID, 'mobile', $mobile );
    add_user_meta( $user->ID, 'address', $address );
    add_user_meta( $user->ID, 'bussiness', $bussiness );

    return new WP_REST_Response( 
        array(
            'status' => 'success',
            'data' => array(
                'message' => 'اطلاعات دریافت شد.'
            )
        ), 
        201 );
}

/**
 * Get orders by user
 */
function get_orders( WP_REST_Request $request ) {
    $user_email = esc_attr( $request->get_param('user_email') );

    if ( !$user_email ) {
        return new WP_Error(
            'not-filled-fields',
            'اطلاعات به درستی وارد نشده‌اند',
            array( 'status' => 'faild' )
        );
    }

    $user = get_user_by( 'email', $user_email );

    global $wpdb;

    $orders = $wpdb->get_results("SELECT * FROM wp_orders WHERE user_id='" . $user->ID . "' ORDER BY date DESC");

    for($i = 0; $i < count($orders); $i++) {
        $gDate = explode('-', $orders[$i]->date);
        $orders[$i]->date = gregorian_to_jalali((int)$gDate[0], (int)$gDate[1], (int)$gDate[2], '-');
    }

    return new WP_REST_Response(
        array(
            'status' => 'success',
            'data' => array(
                'orders' => $orders
            )
        ),
        200 );
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

    if ( !$description || !$name || !$productType || !$circulation || !$size_X || !$size_Y ) {
        return new WP_Error(
            'not-filled-fields',
            'اطلاعات به درستی وارد نشده‌اند',
            array( 'status' => 'faild' )
        );
    }
    $BOT_TOKEN = ''; // Telegram bot api token
    $BOT_ID = ''; // Telegram bot id
    $CHAT_ID = ''; // Telegram chat id

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

     return new WP_REST_Response( 
         array(
            'status' => 'success',
            'data' => array(
                'message' => 'اطلاعات دریافت شد.'
            ),
            'ok' => true
        ), 
        201 );
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
        return new WP_Error(
            'not-filled-fields',
            'اطلاعات به درستی وارد نشده‌اند',
            array( 'status' => 'faild' )
        );
    }

    $BOT_TOKEN = '';
    $BOT_ID = '';
    $CHAT_ID = '';

    $API_URL = 'https://api.telegram.org/bot' . $BOT_TOKEN . '/sendMessage?chat_id=' . $CHAT_ID;

    $API_URL = $API_URL . '&text=' . urlencode( 
        'ایمیل: ' . $user_email . '    ' .
        'شماره تلفن موبایل: ' . $mobile . '    ' .
        'موضوع: ' . $title . '    ' .
        'متن پیام: ' . $content
     );
    wp_remote_get( $API_URL );
    return new WP_REST_Response(
        array(
            'status' => 'success',
            'data' => 'اطلاعات دریافت شد',
            'ok' => true
        ),
        200 );
}
