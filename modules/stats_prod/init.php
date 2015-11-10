<?php

!defined('ABSPATH') and exit;
      
if (class_exists('AmazonWooCommerceStatsProd') != true) {
    class AmazonWooCommerceStatsProd
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
		private $module = '';

		static protected $_instance;

        /*
        * Required __construct() function that initalizes the AA-Team Framework
        */
        public function __construct()
        {
        	global $AmazonWooCommerce;

        	$this->the_plugin = $AmazonWooCommerce;
			$this->module_folder = $this->the_plugin->cfg['paths']['plugin_dir_url'] . 'modules/stats_prod/';
			$this->module = $this->the_plugin->cfg['modules']['stats_prod'];
   
			if (is_admin()) {
	            add_action('admin_menu', array( &$this, 'adminMenu' ));
			}

			if ( $this->the_plugin->is_admin !== true ) {
				$this->addFrontFilters();
			}
        }

		/**
	    * Singleton pattern
	    *
	    * @return AmazonWooCommerceStatsProd Singleton instance
	    */
	    static public function getInstance()
	    {
	        if (!self::$_instance) {
	            self::$_instance = new self;
	        }

	        return self::$_instance;
	    }

		/**
	    * Hooks
	    */
	    static public function adminMenu()
	    {
	       self::getInstance()
	    		->_registerAdminPages();
	    }

	    /**
	    * Register plug-in module admin pages and menus
	    */
		protected function _registerAdminPages()
    	{
    		

			return $this;
		}

		public function display_index_page()
		{
			$this->printBaseInterface();
		}
		
		/**
		 * frontend methods: update hits for amazon product!
		 *
		 */
		public function addFrontFilters() {
			add_action('wp', array( $this, 'frontend' ), 0);
		}

		public function frontend() {
			global $wpdb, $wp;

			// $currentUri = home_url(add_query_arg(array(), $wp->request));

			if ( !is_admin() /*&& is_singular()*/ ) {
				global $post;
				$post_id = (int)$post->ID;
  
				// verify if it's an woocommerce amazon product!
				if ( $post_id <= 0 || !$this->the_plugin->verify_product_isamazon($post_id) )
					return false;

				// update hits
				$hits = (int) get_post_meta($post_id, '_amzaff_hits', true);
				update_post_meta($post_id, '_amzaff_hits', (int)($hits+1));
			}
		}
		
		/*
		* printBaseInterface, method
		* --------------------------
		*
		* this will add the base DOM code for you options interface
		*/
		private function printBaseInterface()
		{
			global $wpdb;
?>
		<script type="text/javascript" src="<?php echo $this->module_folder;?>app.class.js" ></script>
		<div id="AmazonWooCommerce-wrapper" class="fluid wrapper-AmazonWooCommerce">
			
			<?php
			// show the top menu
			AmazonWooCommerceAdminMenu::getInstance()->make_active('info|stats_prod')->show_menu(); 
			?>

			<!-- Content -->
			<div id="AmazonWooCommerce-content">
				
				<h1 class="AmazonWooCommerce-section-headline">
					<?php 
					if( isset($this->module['stats_prod']['in_dashboard']['icon']) ){
						echo '<img src="' . ( $this->module_folder . $this->module['stats_prod']['in_dashboard']['icon'] ) . '" class="AmazonWooCommerce-headline-icon">';
					}
					?>
					<?php echo $this->module['stats_prod']['menu']['title'];?>
					<span class="AmazonWooCommerce-section-info"><?php echo $this->module['stats_prod']['description'];?></span>
					<?php
					$has_help = isset($this->module['stats_prod']['help']) ? true : false;
					if( $has_help === true ){
						
						$help_type = isset($this->module['stats_prod']['help']['type']) && $this->module['stats_prod']['help']['type'] ? 'remote' : 'local';
						if( $help_type == 'remote' ){
							echo '<a href="#load_docs" class="AmazonWooCommerce-show-docs" data-helptype="' . ( $help_type ) . '" data-url="' . ( $this->module['stats_prod']['help']['url'] ) . '">HELP</a>';
						} 
					}
					echo '<a href="#load_docs" class="AmazonWooCommerce-show-feedback" data-helptype="' . ( 'remote' ) . '" data-url="' . ( $this->the_plugin->feedback_url ) . '" data-operation="feedback">Feedback</a>';
					?>
				</h1>
				
				<!-- Main loading box -->
				<div id="AmazonWooCommerce-main-loading">
					<div id="AmazonWooCommerce-loading-overlay"></div>
					<div id="AmazonWooCommerce-loading-box">
						<div class="AmazonWooCommerce-loading-text"><?php _e('Loading', $this->the_plugin->localizationName);?></div>
						<div class="AmazonWooCommerce-meter AmazonWooCommerce-animate" style="width:86%; margin: 34px 0px 0px 7%;"><span style="width:100%"></span></div>
					</div>
				</div>

				<!-- Container -->
				<div class="AmazonWooCommerce-container clearfix" style="position: relative;">
					
					<?php //echo $this->the_plugin->premium_message('row-large');?>

					<!-- Main Content Wrapper -->
					<div id="AmazonWooCommerce-content-wrap" class="clearfix">

						<!-- Content Area -->
						<div id="AmazonWooCommerce-content-area">
							<div class="AmazonWooCommerce-grid_4">
	                        	<div class="AmazonWooCommerce-panel">
									<div class="AmazonWooCommerce-panel-content">
										<form class="AmazonWooCommerce-form" action="#save_with_ajax">
											<div class="AmazonWooCommerce-form-row AmazonWooCommerce-table-ajax-list" id="AmazonWooCommerce-table-ajax-response">
											<?php
											AmazonWooCommerceAjaxListTable::getInstance( $this->the_plugin )
												->setup(array(
													'id' 				=> 'AmazonWooCommercePriceUpdateMonitor',
													'show_header' 		=> true,
													'search_box' 		=> false,
													'items_per_page' 	=> '15',
													'post_statuses' 	=> array(
														'publish'   => __('Published', $this->the_plugin->localizationName)
													),
													'list_post_types'	=> array('product'),
													'columns'			=> array(

														'id'		=> array(
															'th'	=> __('ID', $this->the_plugin->localizationName),
															'td'	=> '%ID%',
															'width' => '40'
														),
														
														'thumb'		=> array(
															'th'	=> __('Thumb', $this->the_plugin->localizationName),
															'td'	=> '%thumb%',
															'align' => 'center',
															'width' => '50'
														),
														
														'asin'		=> array(
															'th'	=> __('ASIN', $this->the_plugin->localizationName),
															'td'	=> '%asin%',
															'align' => 'center',
															'width' => '70'
														),

														'title'		=> array(
															'th'	=> __('Title', $this->the_plugin->localizationName),
															'td'	=> '%title%',
															'align' => 'left'
														),
														
														'hits'		=> array(
															'th'	=> __('Hits', $this->the_plugin->localizationName),
															'td'	=> '%hits%',
															'align' => 'center',
															'width' => '70'
														),
														
														'redirected_to_amazon'	=> array(
															'th'	=> __('Redirected to Amazon', $this->the_plugin->localizationName),
															'td'	=> '%redirected_to_amazon%',
															'align' => 'center',
															'width' => '140'
														),
														
														'date'		=> array(
															'th'	=> __('Date Added', $this->the_plugin->localizationName),
															'td'	=> '%date%',
															'width' => '120'
														),
													)
												))
												->print_html();
								            ?>
								            </div>
							            </form>
				            		</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php
		}
    }
}
 
// Initialize the AmazonWooCommerceStatsProd class
$AmazonWooCommerceStatsProd = AmazonWooCommerceStatsProd::getInstance();
