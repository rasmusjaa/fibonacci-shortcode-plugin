<?php
/**
 * Plugin Name: Fibonacci shortcode
 * Plugin URI: https://github.com/rasmusjaa/fibonacci-shortcode-plugin
 * Description: Display fibonacci sequence with shortcodes [fibonacci length=x] and [fibonacci-reversed length=x]
 * Version: 1.0
 * Text Domain: fibonacci
 * Author: Rasmus Jaakonmäki
 * Author URI: https://lense.fi
 */

if (!class_exists('FibonacciPlugin') )
{
	include plugin_dir_path( __FILE__ ) . 'includes/fibonacci_array.php';
	include plugin_dir_path( __FILE__ ) . 'includes/fibonacci_ajax.php';
	include plugin_dir_path( __FILE__ ) . 'includes/fibonacci_shortcode.php';

	class FibonacciPlugin
	{
		use Fibonacci_Shortcode;
		use Fibonacci_Ajax;

		public function __construct()
		{
			$this->setup_actions();
		}

		private function setup_actions()
		{
            add_shortcode( 'fibonacci', array( $this, 'fibonacci_shortcode_func' ) );
			add_shortcode( 'fibonacci-reverse', array( $this, 'fibonacci_shortcode_func' ) );

			// just register script and style so they are not loaded on pages without the shortcode
			add_action( 'wp_enqueue_scripts', function() {
				wp_register_script( 'fibonacci-script', plugins_url( 'js/script.js', __FILE__ ), array( 'jquery' ), '1.0', false );
				wp_register_style( 'fibonacci-style', plugins_url( 'css/style.css', __FILE__), array(), '1.0', 'all' );
			});

			add_action( 'wp_ajax_fibonacci', array( $this, 'fibonacci_ajax' ) );
		}

	}

	$fibonacci_instantiate = new FibonacciPlugin();
}
