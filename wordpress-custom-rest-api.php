<?php

/**
 * Plugin Name: Wordpress Custom REST API
 * Plugin URI: https://developernoob.in
 * Description: This plugin provide a REST API for all wordpress user
 * Version: 1.0
 * Author: Mr. Kahnu
 * Author URI: https://developernoob.in
 */


add_action('rest_api_init', function () {
    register_rest_route( 'public/v1', 'all-users',array(
                  'methods'  => 'GET',
                  'callback' => 'get_latest_posts_by_category'
        ));
  });


function get_latest_posts_by_category($request)
{


    global $wpdb;
    $wp_users = $wpdb->prefix . "users";


    $allUsers = $wpdb->get_results("SELECT * FROM $wp_users ");

    $response = array(
        "success" => true,
        "data"=> $allUsers
    );

    $response = new WP_REST_Response($response );
    $response->set_status(200);

    return $response;
}
