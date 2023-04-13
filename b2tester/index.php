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

require_once dirname( __FILE__ ) . '/class.php';

add_action('init', 'b2tester_init');
function b2tester_init(){
	$b2tester = new B2Tester;
	$b2tester->initialize();
}
b2tester_init();

?>