<?php
	/**
	 * Check Exist Post By Title
	 * @Version 1.0.0
	 * @global class $wpdb
	 *
	 * @str $title return title post
	 * @str $author ID number of author post
	 * @str $post_type default post or other
	 *
	 **/
	function wp_exist_post($title = NULL, $author = '1', $post_type='post') {
		global $wpdb;
		if(empty(trim($title)))
			return NULL;

		$title = urldecode($title);
		$arr = array(esc_sql($author), esc_sql($title), esc_sql($post_type));
		
		$result = count($wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->posts} WHERE post_author = %d AND post_title = %s AND post_type = %s", $arr)));

		if($result >= 1)
			return $result;

		return NULL;
	}