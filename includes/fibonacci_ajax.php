<?php

trait Fibonacci_Ajax {

	public function fibonacci_ajax() {
		if (!wp_verify_nonce( $_REQUEST['nonce'], 'fibonacci_nonce'))
			exit();

		$post_id = $_REQUEST['post_id'];
		$meta_key = $_REQUEST['meta_key'];

		// replace url friendly string with sequence with spaces for database
		$new_meta = str_replace('-', ' ', $_REQUEST['content']);

		// if new metadata is same as previous it won't be udpdated
		if ($new_meta === get_post_meta($post_id, $meta_key, true)) {
			$result['type'] = 'success';
			$result['status'] = 'metadata is same';
		} else {
			$updated = update_post_meta($post_id, $meta_key, $new_meta);
			
			if($updated === false) {
				$result['type'] = 'error';
				$result['status'] = 'error updating metadata';
			}
			else {
				$result['type'] = 'success';
				$result['status'] = 'metadata updated';
			}
		}
		echo json_encode($result);
		die();
	}

}