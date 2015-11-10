<?php

echo json_encode(
	array(
		$tryed_module['db_alias'] => array(
			/* define the form_messages box */
			'setup_box' => array(
				'title' 	=> 'Install plugin settings',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> array(
					'install_btn' => array(
						'type' => 'submit',
						'value' => 'Install settings',
						'color' => 'blue',
						'action' => 'AmazonWooCommerce-installDefaultOptions',
					)
				), // true|false|array
				'style' 	=> 'panel', // panel|panel-widget
				
				// create the box elements array
				'elements'	=> array(
					'install_box' => array(
						'type' 		=> 'textarea',
						'std' 		=> file_get_contents( $tryed_module["folder_path"] . 'default-setup.json' ),
						'size' 		=> 'large',
						'cols' 		=> '130',
						'title' 	=> 'Paste settings here',
						'desc' 		=> 'Default settings configuration loaded here.',
					)
				)
			)
			/* define the form_messages box */
			, 'backup_box' => array(
				'title' 	=> 'backup you current plugin settings',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> false, // true|false
				'style' 	=> 'panel', // panel|panel-widget
				
				// create the box elements array
				'elements'	=> array(
					'backup_box' => array(
						'type' 		=> 'textarea',
						'std' 		=> str_replace('&', '#!#', str_replace("'", "\'", $this->getAllSettings('json'))),
						'size' 		=> 'large',
						'cols' 		=> '130',
						'title' 	=> 'Your current settings ',
						'desc' 		=> 'Copy / Paste this file if you want to backup all you plugins settings.',
					)
				)
			)
			
			/* define the form_messages box */
			, 'asin_backupt' => array(
				'title' 	=> 'backup you current show products',
				'icon' 		=> '{plugin_folder_uri}assets/amazon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> false, // true|false
				'style' 	=> 'panel', // panel|panel-widget
				
				// create the box elements array
				'elements'	=> array(
					'backup_box' => array(
						'type' 		=> 'textarea',
						'std' 		=> $this->getAllProductsMeta('text', '_amzASIN'),
						'size' 		=> 'large',
						'height' 	=> '230px',
						'title' 	=> 'Your current product(s) ASIN',
						'desc' 		=> '',
					)
				)
			)
		)
	)
);