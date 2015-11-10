<?php

echo json_encode(array(
    'dashboard' => array(
        'version' => '1.0',
        'menu' => array(
            'order' => 1,
            'title' => 'Dashboard'
            ,'icon' => 'assets/16_dashboard.png'
        ),
        'description' => "Coming Soon",
        'help' => array(
			'type' => 'remote',
			'url' => 'http://docs.aa-team.com/products/woocommerce-amazon-affiliates/'
		),
        'module_init' => 'init.php',
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
));