<?php

echo json_encode(
	array(
		'server_status' => array(
			'version' => '1.0',
			'menu' => array(
				'order' => 4,
				'show_in_menu' => false,
				'title' => 'Server status',
				'icon' => 'assets/16_serversts.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32_serverstatus.png',
				'url'	=> admin_url("admin.php?page=AmazonWooCommerce_server_status")
			),
			'help' => array(
				'type' => 'remote',
				'url' => 'http://docs.aa-team.com/woocommerce-amazon-affiliates/documentation/server-status/'
			),
			'description' => 'Using the server status module you can check if your install is correct, if you have the right server configuration and test product import.',
			'module_init' => 'init.php',
			'load_in' => array(
				'backend' => array(
					'admin.php?page=AmazonWooCommerce_server_status',
					'admin-ajax.php'
				),
				'frontend' => false
			),
			'javascript' => array(
				'admin',
				'hashchange',
				'tipsy'
			),
			'css' => array(
				'admin',
				'tipsy'
			)
		)
	)
);