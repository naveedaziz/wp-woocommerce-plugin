<?php 

! defined( 'ABSPATH' ) and exit;
// load the modules managers class
$module_class_path = $module['folder_path'] . 'advanced-search.class.php';
if(is_file($module_class_path)) {
	
	require_once( 'advanced-search.class.php' );
		
	// Initalize the your aaModulesManger
	$AmazonWooCommerceAdvancedSearch = new AmazonWooCommerceAdvancedSearch($this->cfg, $module);
	
	$__module_is_setup_valid = $AmazonWooCommerceAdvancedSearch->moduleValidation();
	$__module_is_setup_valid = (bool) $__module_is_setup_valid['status'];
		
	// print the lists interface 
	echo $AmazonWooCommerceAdvancedSearch->printSearchInterface();
}