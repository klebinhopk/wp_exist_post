<?php
	/**
	 * Check Exist Post By Title
	 * @Version 1.0.0
	 * @global class $wpdb
	 *
	 * @str $title title name post
	 * @str $author ID number of author post ( no required )
	 * @str $post_type no required and default post or other
	 *
	 **/
	function wp_exist_post( $title = '', $author = '', $post_type='post' ) {
		global $wpdb;
		if( empty( trim( $title ) ) )
			return NULL;

		$title = urldecode( $title );

		$sql  = "SELECT * FROM {$wpdb->posts} WHERE ";
		if( !empty( $author ) ){
			$arr[] = esc_sql( $author );
			$sql .= "post_author = %d ";
		}
		$arr[] = esc_sql( $title );
		$arr[] = esc_sql( $post_type );
		$sql .= " AND post_title = %s AND post_type = %s";

		$result = count( $wpdb->get_results( $wpdb->prepare( $sql, $arr ) ) );

		if($result > 0)
			return $result;

		return NULL;
	}
