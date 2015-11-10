<?php

echo json_encode(
	array(
		$tryed_module['db_alias'] => array(
			/* define the form_messages box */
			'import_panel' => array(
				'title' 	=> 'Bulk import',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> true, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> false, // true|false
				'style' 	=> 'panel', // panel|panel-widget
				
				'panel_setup_verification' => true,

				// create the box elements array
				'elements'	=> array(
					array(
						'type' 		=> 'app',
						'path' 		=> '{plugin_folder_path}panel.php',
					)
				)
			)
		)
	)
);