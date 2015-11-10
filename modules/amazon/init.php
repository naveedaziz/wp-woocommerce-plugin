<?php

if(	is_admin() ) {
	require_once( 'ajax-request.php' );

	/* Use the admin_menu action to define the custom box */
    add_action('admin_menu', 'AmazonWooCommerce_api_search_metabox');

    /* Adds a custom section to the "side" of the product edit screen */
    function AmazonWooCommerce_api_search_metabox() {
		//add_meta_box('AmazonWooCommerce_api_search', 'Search product(s) on Amazon', 'AmazonWooCommerce_api_search_custom_box', 'product', 'normal', 'high');
    }

	/* The code for api search custom metabox */
	function AmazonWooCommerce_api_search_custom_box() {
		global $AmazonWooCommerce;

		$amazon_settings = $AmazonWooCommerce->getAllSettings('array', 'amazon');
		$plugin_uri = $AmazonWooCommerce->cfg['paths']['plugin_dir_url'] . 'modules/amazon/';
	?>
		<link rel='stylesheet' id='AmazonWooCommerce-metabox-css' href='<?php echo $plugin_uri . 'meta-box.css';?>' type='text/css' media='all' />

		<script type='text/javascript' src='<?php echo $plugin_uri . 'meta-box.js';?>'></script>

		</form> <!-- closing the top form -->
			<form id="AmazonWooCommerce-search-form" action="/" method="POST">
			<div style="bottom: 0px; top: 0px;" class="AmazonWooCommerce-shadow"></div>
			<div id="AmazonWooCommerce-search-bar">
				<div class="AmazonWooCommerce-search-content">
					<div class="AmazonWooCommerce-search-block">
						<label for="AmazonWooCommerce-search">Search by Keywords or ASIN:</label>
						<input type="text" name="AmazonWooCommerce-search" id="AmazonWooCommerce-search" value="" />
					</div>

					<div class="AmazonWooCommerce-search-block" style="width: 220px">
						<span class="caption">Category:</span>
						<select name="AmazonWooCommerce-category" id="AmazonWooCommerce-category">
						<?php
							foreach ($AmazonWooCommerce->amazonCategs() as $key => $value){
								echo '<option value="' . ( $value ) . '">' . ( $value ) . '</option>';
							}
						?>
						</select>
					</div>

					<div class="AmazonWooCommerce-search-block" style="width: 320px">
						<span>Import to category:</span>
						<?php
						$args = array(
							'orderby' 	=> 'menu_order',
							'order' 	=> 'ASC',
							'hide_empty' => 0
						);
						$categories = get_terms('product_cat', $args);
						echo '<select name="AmazonWooCommerce-to-category" id="AmazonWooCommerce-to-category" style="width: 200px;">';
						echo '<option value="amz">Use category from Amazon</option>';
						if(count($categories) > 0){
							foreach ($categories as $key => $value){
								echo '<option value="' . ( $value->name ) . '">' . ( $value->name ) . '</option>';
							}
						}
						echo '</select>';
						?>
					</div>

					<input type="submit" class="button-primary" id="AmazonWooCommerce-search-link" value="Search" />
				</form>
				<div id="AmazonWooCommerce-ajax-loader"><img src="<?php echo $plugin_uri;?>assets/ajax-loader.gif" /> searching on <strong>Amazon.<?php echo $amazon_settings['country'];?></strong> </div>
			</div>
		</div>
		<div id="AmazonWooCommerce-results">
			<div id="AmazonWooCommerce-ajax-results"><!-- dynamic content here --></div>
			<div style="clear:both;"></div>
		</div>

		<?php
		if($_REQUEST['action'] == 'edit'){
			echo '<style>#amzStore_shop_products_price, #amzStore_shop_products_markers { display: block; }</style>';
		}
		?>
	<?php
	}
}
require_once( 'product-tabs.php' );