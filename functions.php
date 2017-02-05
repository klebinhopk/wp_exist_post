<?php
/**
 * Check Exist Post By Title
 * @version 1.0.1
 * @author Lenivene Bezerra
 * @global class $wpdb
 *
 * @str $title title name post
 * @str $author ID number of author post ( no required )
 * @str $post_type no required and default post or other
 *
 **/
function wp_post_exists( $title, $author = '', $post_type = 'post' ) {
	global $wpdb;

	if( empty( $title ) ){
		return 0;
	}

	$query = "SELECT ID FROM $wpdb->posts WHERE 1=1";
	$args  = array();

	$error = $args;
	$error_param = $args;


	if( !empty( $title ) ){
		$query .= " AND post_title = %s";
		$args[] = $title;

		if( is_array( $title ) || is_object( $title ) ){
			$error_param[] = $title;
			$error[] = __( 'Title required type string!', 'textdomain' );
		}
	}

	if( !empty( $author ) ){
		$query .= ' AND post_author = %d';
		$args[] = $author;

		if( !is_int( $author ) ){
			$error_param[] = $author;
			$error[] = __( 'Author ID required type int!', 'textdomain' );
		}
	}

	if( !empty( $post_type ) ){
		$query .= ' AND post_type = %s';
		$args[] = $post_type;
	}

	/**
	 * Instance error
	 */
	if( !empty( $error ) ){
		return new WP_Error( 'wp_exist_post', $error, $error_param );
	}

	if( !empty( $args ) ){
		return (int) $wpdb->get_var( $wpdb->prepare( $query, $args ) );
	}

	return 0;
}