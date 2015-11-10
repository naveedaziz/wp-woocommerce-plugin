<?php
/*
Plugin Name:	AmazonWoo Light - Amazon WooCommerce  
Plugin URI: 	
Description: 	Wordpress Amazon WooCommerce Store
Version: 		1.0
Author: 		NIDOBDA
Author URI:		
*/
! defined( 'ABSPATH' ) and exit;

// Derive the current path and load up AmazonWooCommerce
$plugin_path = dirname(__FILE__) . '/';
if(class_exists('AmazonWooCommerce') != true) {
    require_once($plugin_path . 'aa-framework/framework.class.php');

	// Initalize the your plugin
	$AmazonWooCommerce = new AmazonWooCommerce();

	// Add an activation hook
	register_activation_hook(__FILE__, array(&$AmazonWooCommerce, 'activate'));
}