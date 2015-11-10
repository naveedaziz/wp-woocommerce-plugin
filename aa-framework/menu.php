<?php

! defined( 'ABSPATH' ) and exit;

if(class_exists('AmazonWooCommerceAdminMenu') != true) {
	class AmazonWooCommerceAdminMenu {
		
		/*
        * Some required plugin information
        */
        const VERSION = '1.0';

        /*
        * Store some helpers config
        */
		public $the_plugin = null;
		private $the_menu = array();
		private $current_menu = '';
		private $ln = '';
		
		private $menu_depedencies = array();

		static protected $_instance;

        /*
        * Required __construct() function that initalizes the AA-Team Framework
        */
        public function __construct()
        {
        	global $AmazonWooCommerce;
        	$this->the_plugin = $AmazonWooCommerce;
			$this->ln = $this->the_plugin->localizationName;
			
			// update the menu tree
			$this->the_menu_tree();
			
			return $this;
        }

		/**
	    * Singleton pattern
	    *
	    * @return AmazonWooCommerceDashboard Singleton instance
	    */
	    static public function getInstance()
	    {
	        if (!self::$_instance) {
	            self::$_instance = new self;
	        }

	        return self::$_instance;
	    }
		
		private function the_menu_tree()
		{
			if ( isset($this->the_plugin->cfg['modules']['depedencies']['folder_uri'])
				&& !empty($this->the_plugin->cfg['modules']['depedencies']['folder_uri']) ) {
				$this->menu_depedencies['depedencies'] = array( 
					'title' => __( 'Plugin depedencies', $this->ln ),
					'url' => admin_url("admin.php?page=AmazonWooCommerce"),
					'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
					'menu_icon' => 'images/16_dashboard.png'
				);
				return true;
			}

			$this->the_menu['dashboard'] = array( 
				'title' => __( 'Dashboard', $this->ln ),
				'url' => admin_url("admin.php?page=AmazonWooCommerce#!/dashboard"),
				'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
				'menu_icon' => 'images/16_dashboard.png'
			);
			
			$this->the_menu['configuration'] = array( 
				'title' => __( 'Configuration', $this->ln ),
				'url' => "#!/",
				'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
				'menu_icon' => 'images/16_config.png',
				'submenu' => array(
					'amazon' => array(
						'title' => __( 'Amazon config', $this->ln ),
						'url' => admin_url("admin.php?page=AmazonWooCommerce#!/amazon"),
						'folder_uri' => $this->the_plugin->cfg['modules']['amazon']['folder_uri'],
						'menu_icon' => 'assets/16_amzconfig.png'
					),
				)
			);
			
			$this->the_menu['import'] = array( 
				'title' => __( 'Import Products', $this->ln ),
				'url' => "#!/",
				'folder_uri' => $this->the_plugin->cfg['paths']['freamwork_dir_url'],
				'menu_icon' => 'images/16_import.png',
				'submenu' => array(
					'advanced_search' => array(
						'title' => __( 'Bulk Import', $this->ln ),
						'url' => admin_url("admin.php?page=AmazonWooCommerce#!/advanced_search"),
						'folder_uri' => $this->the_plugin->cfg['modules']['advanced_search']['folder_uri'],
						'menu_icon' => 'assets/16_advancedsearch.png'
					),
				)
			);
		}
		
		public function show_menu( $pluginPage='' )
		{
			$plugin_data = $this->the_plugin->get_plugin_data();
			
			$html = array();
			// id="AmazonWooCommerce-nav-dashboard" 
			$html[] = '<div id="AmazonWooCommerce-header">';
			$html[] = 	'<div id="AmazonWooCommerce-header-bottom">';
			$html[] = 		'<div id="AmazonWooCommerce-topMenu">';
			$html[] = 			'<a href="" target="_blank" class="AmazonWooCommerce-product-logo">
									<img src="' . ( $this->the_plugin->cfg['paths']['plugin_dir_url'] ) . 'thumb.png" alt="">
									<h3>' . ( $plugin_data['version'] ) . '</h3>
									
								</a>';
			$html[] = 			'<ul>';

			if ( $pluginPage == 'depedencies' ) {
				$menu = $this->menu_depedencies;
				$this->current_menu = array(
					0 => 'depedencies',
					1 => 'depedencies'
				);
			} else {
				$menu = $this->the_menu;
			}

								foreach ($menu as $key => $value) {
									$iconImg = '<img src="' . ( $value['folder_uri'] . $value['menu_icon'] ) . '" />';
									$html[] = '<li id="AmazonWooCommerce-nav-' . ( $key ) . '" class="AmazonWooCommerce-section-' . ( $key ) . ' ' . ( isset($this->current_menu[0]) && ( $key == $this->current_menu[0] ) ? 'active' : '' ) . '">';
									
									if( $value['url'] == "#!/" ){
										$value['url'] = 'javascript: void(0)';
									}
									$html[] = 	'<a href="' . ( $value['url'] ) . '">' . ( $iconImg ) . '' . ( $value['title'] ) . '</a>';
									if( isset($value['submenu']) ){
										$html[] = 	'<ul class="AmazonWooCommerce-sub-menu">';
										foreach ($value['submenu'] as $kk2 => $vv2) {
											if( ($kk2 != 'synchronization_log') && isset($this->the_plugin->cfg['activate_modules']) && is_array($this->the_plugin->cfg['activate_modules']) && !in_array( $kk2, array_keys($this->the_plugin->cfg['activate_modules'])) ) continue;
		
											$iconImg = '<img src="' . ( $vv2['folder_uri'] . $vv2['menu_icon'] ) . '" />';
											$html[] = '<li class="AmazonWooCommerce-section-' . ( $kk2 ) . '  ' . ( isset($this->current_menu[1]) && $kk2 == $this->current_menu[1] ? 'active' : '' ) . '" id="AmazonWooCommerce-sub-nav-' . ( $kk2 ) . '">';
											$html[] = 	$iconImg;
											$html[] = 	'<a href="' . ( $vv2['url'] ) . '">' . ( $vv2['title'] ) . '</a>'; 
											
											if( isset($vv2['submenu']) ){
												$html[] = 	'<ul class="AmazonWooCommerce-sub-sub-menu">';
												foreach ($vv2['submenu'] as $kk3 => $vv3) {
													$html[] = '<li id="AmazonWooCommerce-sub-sub-nav-' . ( $kk3 ) . '">';
													$html[] = 	'<a href="' . ( $vv3['url'] ) . '">' . ( $vv3['title'] ) . '</a>';
													$html[] = '</li>';
												}
												$html[] = 	'</ul>';
											}
											$html[] = '</li>';
										}
										$html[] = 	'</ul>';
									}
									$html[] = '</li>';
								}
			$html[] = 			'</ul>';
			$html[] = 		'</div>';
			$html[] = 	'</div>';
			
			$html[] = 	'<a href="" class="AmazonWooCommerce-aateam-logo">AA-Team</a>';
			
			$html[] = '</div>';
			
			$html[] = '<script>
			(function($) {
				var AmazonWooCommerceMenu = $("#AmazonWooCommerce-topMenu");
				
				AmazonWooCommerceMenu.on("click", "a", function(e){
					
					var that = $(this),
						href = that.attr("href");
					
					if( href == "javascript: void(0)" ){
						var current_open = AmazonWooCommerceMenu.find("li.active");
						current_open.find(".AmazonWooCommerce-sub-menu").slideUp(350);
						current_open.removeClass("active");
						
						that.parent("li").eq(0).find(".AmazonWooCommerce-sub-menu").slideDown(350, function(){
							that.parent("li").eq(0).addClass("active");
						});
					}
				});
			})(jQuery);
			
			</script>';
			
			echo implode("\n", $html);
		}

		public function make_active( $section='' )
		{
			$this->current_menu = explode("|", $section);
			return $this;
		}
	}
}