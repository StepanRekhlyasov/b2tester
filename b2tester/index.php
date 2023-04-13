<?php
/*
Plugin Name: b2tester
Plugin URI: https://github.com/StepanRekhlyasov/b2tester
Description: This plugin will be automatically working on any page with post type “page” when enabled from the admin dashboard.
Author: Stepan Rekhlyasov <srekhlyasov@gmail.com>
Author URI: https://github.com/StepanRekhlyasov
Version: 0.1
*/ 
if(!defined( 'ABSPATH' )){
	exit;
}

if(!class_exists('B2Tester')) :

add_action('init', 'b2tester_init');
class B2Tester {
	function __construct(){
		add_action('wp_ajax_b2tester_fetch', [$this, 'b2tester_fetch']);
		add_action('wp_ajax_nopriv_b2tester_fetch', [$this, 'b2tester_fetch']);
	}
	function initialize(){
		add_action('wp_enqueue_scripts', [$this, 'register_b2tester_assets']);
	}
	function register_b2tester_assets(){
		if(is_page()){
			wp_enqueue_script('b2tester', plugin_dir_url(__FILE__).'assets/script.js', [], '0.0.1', true);
		} 
	}
	function b2tester_fetch(){
		switch($_POST['mode']){
			case 'native':
				$args = [
					'numberposts' => 3,
					'orderby' => 'post_date',
					'order' => 'ASC',
					'post_type' => 'post'
				];
				$posts = wp_get_recent_posts($args);
				$result = [];
				foreach($posts as $post){
					$result[] = [
						'ID' => $post['ID'],
						'post_content' => $post['post_content']
					];
				}
			break;
			case 'custom':
				/** alternative */
				global $wpdb, $table_prefix;
				$result = $wpdb->get_results("SELECT ID, post_content from ".$table_prefix."posts where post_type = 'post' order by post_date ASC limit 3");
			break;
		}
		wp_send_json($result);
	}
}
function b2tester_init(){
	$b2tester = new B2Tester;
	$b2tester->initialize();
}
b2tester_init();
endif;
?>