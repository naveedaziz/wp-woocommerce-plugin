<?php

!defined('ABSPATH') and exit;
if (class_exists('AmazonWooCommerceDashboard') != true) {
    class AmazonWooCommerceDashboard
    {
        /*
        * Some required plugin information
        */
        const VERSION = '1.0';

        /*
        * Store some helpers config
        */
		public $the_plugin = null;

		private $module_folder = '';
		
		public $ga = null;
		public $ga_params = array();
		
		public $boxes = array();

		static protected $_instance;

        /*
        * Required __construct() function that initalizes the AA-Team Framework
        */
        public function __construct()
        { 
        	global $AmazonWooCommerce;
 
        	$this->the_plugin = $AmazonWooCommerce;
			$this->module_folder = $this->the_plugin->cfg['paths']['plugin_dir_url'] . 'modules/dashboard/';
			
			if (is_admin()) {
	            add_action( "admin_enqueue_scripts", array( &$this, 'admin_print_styles') );
				add_action( "admin_print_scripts", array( &$this, 'admin_load_scripts') );
			}
			 
			// load the ajax helper
			require_once( $this->the_plugin->cfg['paths']['plugin_dir_path'] . 'modules/dashboard/ajax.php' );
			new AmazonWooCommerceDashboardAjax( $this->the_plugin );
			
			// add the boxes
			$this->addBox( 'website_preview', '', $this->website_preview(), array(
				'size' => 'grid_1'
			) );
			
			$this->addBox( 'dashboard_links', '', $this->links(), array(
				'size' => 'grid_3'
			) );
			
			
			
			/*$this->addBox( 'aateam_products', 'Other products by AA-Team:', $this->aateam_products(), array(
				'size' => 'grid_4'
			) );*/
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
	    
		public function admin_print_styles()
		{
			wp_register_style( 'AmazonWooCommerce-DashboardBoxes', $this->module_folder . 'app.css', false, '1.0' );
        	wp_enqueue_style( 'AmazonWooCommerce-DashboardBoxes' );
		}
		
		public function admin_load_scripts()
		{
			wp_enqueue_script( 'AmazonWooCommerce-DashboardBoxes', $this->module_folder . 'app.class.js', array(), '1.0', true );
		}
		
		public function getBoxes()
		{
			$ret_boxes = array();
			if( count($this->boxes) > 0 ){
				foreach ($this->boxes as $key => $value) { 
					$ret_boxes[$key] = $value;
				}
			}
 
			return $ret_boxes;
		}
		
		private function formatAsFreamworkBox( $html_content='', $atts=array() )
		{
			return array(
				'size' 		=> isset($atts['size']) ? $atts['size'] : 'grid_4', // grid_1|grid_2|grid_3|grid_4
	            'header' 	=> isset($atts['header']) ? $atts['header'] : false, // true|false
	            'toggler' 	=> false, // true|false
	            'buttons' 	=> isset($atts['buttons']) ? $atts['buttons'] : false, // true|false
	            'style' 	=> isset($atts['style']) ? $atts['style'] : 'panel-widget', // panel|panel-widget
	            
	            // create the box elements array
	            'elements' => array(
	                array(
	                    'type' => 'html',
	                    'html' => $html_content
	                )
	            )
			);
		}
		
		private function addBox( $id='', $title='', $html='', $atts=array() )
		{ 
			// check if this box is not already in the list
			if( isset($id) && trim($id) != "" && !isset($this->boxes[$id]) ){
				
				$box = array();
				
				$this->boxes[$id] = $this->formatAsFreamworkBox( implode("\n", $box), $atts );
				
			}
		}
		
		public function formatRow( $content=array() )
		{
			$html = array();
			
			
			return implode("\n", $html);
		}
		
		public function products_performances()
		{
			$html = array();
			
			$html[] = $this->formatRow( array( 
				'id' 			=> 'products_performances',
				'title' 		=> '',
				'html'			=> '',
				'ajax_content' 	=> true
			) );
			
			return implode("\n", $html);
		}

		public function audience_overview()
		{
			$html = array();
			return  implode("\n", $html);
		}
		
		public function website_preview()
		{
			$html = array();
			//return  implode("\n", $html);
		}
		
		public function links()
		{
			$html = array();
			$html[] = '<ul class="AmazonWooCommerce-summary-links">';
			
			foreach ($this->the_plugin->cfg['modules'] as $key => $value) {
  
				if( !in_array( $key, array_keys($this->the_plugin->cfg['activate_modules'])) ) continue;  
				$in_dashboard = isset($value[$key]['in_dashboard']) ? $value[$key]['in_dashboard'] : array();
  
				
			}
			
			$html[] = '</ul>';
			
			return implode("\n", $html);
		}
    }
}

// Initialize the AmazonWooCommerceDashboard class
$AmazonWooCommerceDashboard = AmazonWooCommerceDashboard::getInstance();