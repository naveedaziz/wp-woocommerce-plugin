<?php

 echo json_encode(
	array(
		'setup_backup' => array(
			'version' => '0.1',
			'menu' => array(
				'order' => 20,
				'title' => 'Setup / Backup',
				'icon' => 'assets/16_setupbackup.png'
			),
			'in_dashboard' => array(
				'icon' 	=> 'assets/32_setupbackup.png',
				'url'	=> admin_url("admin.php?page=AmazonWooCommerce#!/setup_backup")
			),
			'help' => array(
				'type' => 'remote',
				'url' => 'http://docs.aa-team.com/woocommerce-amazon-affiliates/documentation/setup-backup/'
			),
			'description' => "Using the setup backup module you can setup the plugin for the first time, and backup settings & products if you change servers.",
			'load_in' => array(
				'backend' => array(
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