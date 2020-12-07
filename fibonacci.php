<?php
/**
 * Plugin Name: Fibonacci shortcode
 * Plugin URI: https://lense.fi
 * Description: Display fibonacci sequence of given length using a shortcode
 * Version: 1.0
 * Text Domain: fibonacci
 * Author: Rasmus Jaakonmäki
 * Author URI: https://lense.fi
 */

if ( ! class_exists( 'FibonacciPlugin' ) ) {
	include plugin_dir_path( __FILE__ ) . 'includes/fibonacci_array.php';
	include plugin_dir_path( __FILE__ ) . 'includes/fibonacci_ajax.php';
	include plugin_dir_path( __FILE__ ) . 'includes/fibonacci_shortcode.php';

    class FibonacciPlugin {

		use Fibonacci_Shortcode;
		use Fibonacci_Ajax;

		public function __construct() {
			$this->setup_actions();
		}

		private function setup_actions() {
            //Main plugin hooks
            add_shortcode( 'fibonacci', array( $this, 'fibonacci_shortcode_func' ) );
			add_shortcode( 'fibonacci_reversed', array( $this, 'fibonacci_shortcode_func' ) );

			add_action( 'wp_enqueue_scripts', function() {
				wp_enqueue_script('fibonacci-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', false);
				wp_localize_script('fibonacci-script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
				wp_enqueue_style('fibonacci-style', plugins_url('style.css', __FILE__), array(), '1.0', 'all');
			});

			add_action( 'wp_ajax_fibonacci', array( $this, 'fibonacci_ajax' ) );
		}

	}

	$fibonacci_instantiate = new FibonacciPlugin();
}

// lambda function
// trait