<?php
/**
 * Plugin name: A Test APIs Result
 * Plugin URI: https://mediauganda.com
 * Description: Get information from external APIs in WordPress. Click the Query API Test link in the Admin menu on activation.
 * Author: Laurence Bahiirwa
 * Author URI: https://mediauganda.com
 * version: 0.1.0
 * License: GPL2 or later.
 * text-domain: query-apis
 */

// If this file is access directly, abort!!!
defined( 'ABSPATH' ) or die( 'Unauthorized Access' );

/**
 * Function responsible for fetching json data from external api
 *
 * @return void
 */
function techiepress_get_send_data() {

	// Add the API endpoint here.
    $url = 'https://jsonplaceholder.typicode.com/users';
    
    $arguments = array(
        'method' => 'GET'
    );
	//Performs an HTTP request using the GET method and returns its response.
	$response = wp_remote_get( $url, $arguments );

	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} else {
		echo '<pre>';

		// Whole API result.
		var_dump( $response );

		// Body Result
		// var_dump( wp_remote_retrieve_body( $response ) );
		echo '</pre>';
	}
}	

/**
 * Register a custom menu page to view the information queried.
 *
 * @return void
 */
function techiepress_register_my_custom_menu_page() {
	add_menu_page(
		__( 'Query API Test Settings', 'query-apis' ),
		'Query API Test',
		'manage_options',
		'api-test.php',
		'techiepress_get_send_data',
		'dashicons-testimonial',
		16
	);
}

//Hook fired to execute the function
add_action( 'admin_menu', 'techiepress_register_my_custom_menu_page' );
