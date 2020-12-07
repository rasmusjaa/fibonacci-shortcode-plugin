<?php

trait Fibonacci_Shortcode {

	use Fibonacci_Array;

	private $error_div = '<div class="fibonacci fib_error">
		Set valid "length" parameter to fibonacci shortcode
		</div>';

	public function fibonacci_shortcode_func($atts, $content = null, $tag) {
		$a = shortcode_atts( array(
			'length' => 0,
		), $atts );

		$length = intval($a['length']);

		if ($length < 1)
			return $this->error_div;
		
		// create fibonacci array
		$array = $this->fibonacci_array($length);

		// normal or reversed depending on used shortcode
		// meta key used for database
		switch( $tag ) {
			case 'fibonacci':
				$meta_key = 'fibonacci_sequence';
				break;
			case 'fibonacci_reversed':
				$array = array_reverse($array);
				$meta_key = 'fibonacci_reversed';
				break;
		}

		// create normal and url friendly version of string
		$content = implode(' ', $array);
		$content_url = implode('-', $array);

		$action = 'fibonacci';
		$post_id = get_the_ID();
		$nonce = wp_create_nonce('fibonacci_nonce');
		$link = admin_url(
			'admin-ajax.php?
			action='.$action.'&
			post_id='.$post_id.'&
			nonce='.$nonce.'&
			content='.$content_url.'&
			meta_key='.$meta_key
		);
		
		return '<div class="fibonacci fibonacci_sequence"
			data-action="' . $action . '"
			data-post_id="' . $post_id . '"
			data-nonce="' . $nonce . '"
			data-content="' . $content_url . '"
			data-meta_key="' . $meta_key . '"
			>
			<span>'.$content.'</span>
			</div>';
	}

}