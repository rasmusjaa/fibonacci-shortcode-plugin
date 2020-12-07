<?php

trait Fibonacci_Shortcode
{
	use Fibonacci_Array;

	private $error_div = '<div class="fibonacci fib_error">
		Set valid "length" parameter to fibonacci shortcode
		</div>';

	private function enqueue_script_and_style()
	{
		if(!wp_script_is('fibonacci-script', $list = 'enqueued'))
		{
			wp_enqueue_script('fibonacci-script');
			wp_localize_script( 'fibonacci-script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
		}
		if(!wp_style_is('fibonacci-style', $list = 'enqueued'))
		{
			wp_enqueue_style('fibonacci-style');
		}
	}

	public function fibonacci_shortcode_func($atts, $content = null, $tag)
	{
		$a = shortcode_atts( array(
			'length' => 0,
		), $atts );

		$this->enqueue_script_and_style();

		$length = intval($a['length']);
		if ($length < 1)
			return $this->error_div;
		
		// create fibonacci array
		$array = $this->fibonacci_array($length);

		// normal or reversed depending on used shortcode
		// meta key used for database
		switch( $tag )
		{
			case 'fibonacci':
				$meta_key = 'fibonacci_sequence';
				break;
			case 'fibonacci-reverse':
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

		return '<div
			class="fibonacci fibonacci_sequence"
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