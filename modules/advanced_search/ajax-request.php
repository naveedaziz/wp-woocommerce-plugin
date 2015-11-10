<?php
add_action('wp_ajax_AmazonWooCommerceCategParameters', 'AmazonWooCommerceCategParameters');
function AmazonWooCommerceCategParameters() {

	global $AmazonWooCommerce;
	
	// retrive the item search parameters
	$ItemSearchParameters = $AmazonWooCommerce->amzHelper->getAmazonItemSearchParameters();
	
	// retrive the item search parameters
	$ItemSortValues = $AmazonWooCommerce->amzHelper->getAmazonSortValues();
	
	$html = array();
	$request = array(
		'categ' => isset($_REQUEST['categ']) ? $_REQUEST['categ'] : '',
		'nodeid' => isset($_REQUEST['nodeid']) ? $_REQUEST['nodeid'] : ''
	);

	$sort = array();

	$sort['relevancerank'] = 'Items ranked according to the following criteria: how often the keyword appears in the description, where the keyword appears (for example, the ranking is higher when keywords are found in titles), how closely they occur in descriptions (if there are multiple keywords), and how often customers purchased the products they found using the keyword.';
	$sort['salesrank'] = "Bestselling";
	$sort['pricerank'] = "Price: low to high";
	$sort['inverseprice'] = "Price: high to low";
	$sort['launch-date'] = "Newest arrivals";
	$sort['-launch-date'] = "Newest arrivals";
	$sort['sale-flag'] = "On sale";
	$sort['pmrank'] = "Featured items";
	$sort['price'] = "Price: low to high";
	$sort['-price'] = "Price: high to low";
	$sort['reviewrank'] = "Average customer review: high to low";
	$sort['titlerank'] = "Alphabetical: A to Z";
	$sort['-titlerank'] = "Alphabetical: Z to A";
	$sort['pricerank'] = "Price: low to high";
	$sort['inverse-pricerank'] = "Price: high to low";
	$sort['daterank'] = "Publication date: newer to older";
	$sort['psrank'] = "Bestseller ranking taking into consideration projected sales.The lower the value, the better the sales.";
	$sort['orig-rel-date'] = "Release date: newer to older";
	$sort['-orig-rel-date'] = "Release date: older to newer";
	$sort['releasedate'] = "Release date: newer to older";
	$sort['-releasedate'] = "Release date: older to newer";
	$sort['songtitlerank'] = "Most popular";
	$sort['uploaddaterank'] = "Date added";
	$sort['-video-release-date'] = "Release date: newer to older";
	$sort['-edition-sales-velocity'] = "Quickest to slowest selling products.";
	$sort['subslot-salesrank'] = "Bestselling";
	$sort['release-date'] = "Sorts by the latest release date from newer to older. See orig-rel-date, which sorts by the original release date.";
	$sort['-age-min'] = "Age: high to low";

	// print the title
	$html[] = '<h2>' . ( $request['categ'] ) . ' Search</h2>';

	// store categ into input, use in search FORM
	$html[] = '<input type="hidden" name="AmazonWooCommerceParameter[categ]" value="' . ( $request['categ'] ) . '" />';

	// Keywords
	$html[] = '<div class="AmazonWooCommerceParameterSection">';
	$html[] = 	'<label style="width:100%;">' . __('ASIN Numbers (Please copy page csv file content)', $AmazonWooCommerce->localizationName) .'</label>';
	$html[] = 	'<textarea "  name="AmazonWooCommerceParameter[ASIN]" id="ASINS"></textarea>';
	$html[] = '</div>';

	// Keywords
	$args = array(
		'orderby' 	=> 'menu_order',
		'order' 	=> 'ASC',
		'hide_empty' => 0,
		'post_per_page' => '-1'
	);
	$categories = get_terms('product_cat', $args);

	$html[] = '<div class="AmazonWooCommerceParameterSection">';
	$html[] = 	'<label>' . __('Import in WooCommerce Catagory:', $AmazonWooCommerce->localizationName) .'</label>';
	$categories = get_terms('product_cat', $args);
	$html[] = 	'<select name="AmazonWooCommerceParameter[TERMS]" id="amzStore-to-category" style="width: 200px;">';
			$taxonomies = array( 
			'post_tag',
			'my_tax',
		);
		
	$sql = mysql_query("SELECT * from wp_terms");
	//print_r();
	if(count($categories) > 0){
		foreach ($categories as $key => $value){
			$html[] = '<option value="' . ( $value->term_id ) . '">' . ( $value->name ) . '</option>';
		}
	}
	$html[] = '</select>';
	$html[] = '</div>';
	
	
	$html[] = '<div class="AmazonWooCommerceParameterSection">';
	$html[] = 	'<label>' . __('Amazon Playform:', $AmazonWooCommerce->localizationName) .'</label>';
	$html[] = 	'<select name="AmazonWooCommerceParameter[PLATFORM]" id="amzStore-to-platform" style="width: 200px;">';
	$html[] =   '<option value="US">US</option>';
	$html[] =   '<option value="CA">CA</option>';
	$html[] =   '<option value="DE">DE</option>';
	$html[] =   '<option value="UK">UK</option>';
	$html[] = '</select>';
	$html[] = '</div>';


	// BrowseNode
	if( isset($ItemSearchParameters[$request['categ']]) && in_array( 'BrowseNode', $ItemSearchParameters[$request['categ']] ) ){
		
		$nodes = $AmazonWooCommerce->getBrowseNodes( $request['nodeid'] );
		
		//var_dump('<pre>',$nodes,'</pre>'); die;  

		$html[] = '<div class="AmazonWooCommerceParameterSection">';
		$html[] = 	'<label>' . __('BrowseNode', $AmazonWooCommerce->localizationName) .'</label>';

		$html[] = 	'<div id="AmazonWooCommerceGetChildrens">';
		$html[] = 	'<select name="AmazonWooCommerceParameter[node]">';
		$html[] = '<option value="">' . __('All', $AmazonWooCommerce->localizationName) .'</option>';
		while ($rows == mysql_fetch_array($sql)){
			$html[] = '<option value="' . ( $rows['term_id'] ) . '">' . ( $rows['name'] ) . '</option>';
		}
		$html[] = 	'</select>';
		$html[] = '</div>';
		//$html[] = 	'<input type="button" class="AmazonWooCommerce-button blue AmazonWooCommerceGetChildNodes" value="' . __('Get Child Nodes', $AmazonWooCommerce->localizationName) .'" style="width: 100px; float: left;position: relative; bottom: -3px;" />';

		$html[] = 	'<div id="AmazonWooCommerceGetChildrens"></div>';
		$html[] = 	'<p>Browse nodes are identify items categories</p>';
		$html[] = '</div>';
	}

	// Brand
	if( isset($ItemSearchParameters[$request['categ']]) && in_array( 'Brand', $ItemSearchParameters[$request['categ']] ) ){
		$html[] = '<div class="AmazonWooCommerceParameterSection">';
		$html[] = 	'<label>' . __('Brand', $AmazonWooCommerce->localizationName) .'</label>';
		$html[] = 	'<input type="text" size="22" name="AmazonWooCommerceParameter[Brand]">';
		$html[] = 	'<p>Name of a brand associated with the item. You can enter all or part of the name. For example, Timex, Seiko, Rolex. </p>';
		$html[] = '</div>';
	}

	// Condition
	if( isset($ItemSearchParameters[$request['categ']]) && in_array( 'Condition', $ItemSearchParameters[$request['categ']] ) ){
		$html[] = '<div class="AmazonWooCommerceParameterSection">';
		$html[] = 	'<label>' . __('Condition', $AmazonWooCommerce->localizationName) .'</label>';
		$html[] = 	'<select name="AmazonWooCommerceParameter[Condition]">';
		$html[] = 		'<option value="">All Conditions</option>';
		$html[] = 		'<option value="New">New</option>';
		$html[] = 		'<option value="Used">Used</option>';
		$html[] = 		'<option value="Collectible">Collectible</option>';
		$html[] = 		'<option value="Refurbished">Refurbished</option>';
		$html[] = 	'</select>';
		$html[] = 	'<p>Use the Condition parameter to filter the offers returned in the product list by condition type. By default, Condition equals "New". If you do not get results, consider changing the value to "All. When the Availability parameter is set to "Available," the Condition parameter cannot be set to "New."</p>';
		$html[] = '</div>';
	}

	// Manufacturer
	if( isset($ItemSearchParameters[$request['categ']]) && in_array( 'Manufacturer', $ItemSearchParameters[$request['categ']] ) ){
		$html[] = '<div class="AmazonWooCommerceParameterSection">';
		$html[] = 	'<label>' . __('Manufacturer', $AmazonWooCommerce->localizationName) .'</label>';
		$html[] = 	'<input type="text" size="22" name="AmazonWooCommerceParameter[Manufacturer]">';
		$html[] = 	'<p>Name of a manufacturer associated with the item. You can enter all or part of the name.</p>';
		$html[] = '</div>';
	}

	// MaximumPrice
	if( isset($ItemSearchParameters[$request['categ']]) && in_array( 'MaximumPrice', $ItemSearchParameters[$request['categ']] ) ){
		$html[] = '<div class="AmazonWooCommerceParameterSection">';
		$html[] = 	'<label>' . __('Maximum Price', $AmazonWooCommerce->localizationName) .'</label>';
		$html[] = 	'<input type="text" size="22" name="AmazonWooCommerceParameter[MaximumPrice]">';
		$html[] = 	'<p>Specifies the maximum price of the items in the response. Prices are in terms of the lowest currency denomination, for example, pennies. For example, 3241 represents $32.41.</p>';
		$html[] = '</div>';
	}

	// MinimumPrice
	if( isset($ItemSearchParameters[$request['categ']]) && in_array( 'MinimumPrice', $ItemSearchParameters[$request['categ']] ) ){
		$html[] = '<div class="AmazonWooCommerceParameterSection">';
		$html[] = 	'<label>' . __('Minimum Price', $AmazonWooCommerce->localizationName) .'</label>';
		$html[] = 	'<input type="text" size="22" name="AmazonWooCommerceParameter[MinimumPrice]">';
		$html[] = 	'<p>Specifies the minimum price of the items to return. Prices are in terms of the lowest currency denomination, for example, pennies, for example, 3241 represents $32.41.</p>';
		$html[] = '</div>';
	}

	// MerchantId
	if( isset($ItemSearchParameters[$request['categ']]) && in_array( 'MerchantId', $ItemSearchParameters[$request['categ']] ) ){
		$html[] = '<div class="AmazonWooCommerceParameterSection">';
		$html[] = 	'<label>' . __('Merchant Id', $AmazonWooCommerce->localizationName) .'</label>';
		$html[] = 	'<input type="text" size="22" name="AmazonWooCommerceParameter[MerchantId]">';
		$html[] = 	'<p>An optional parameter you can use to filter search results and offer listings to only include items sold by Amazon. By default, Product Advertising API returns items sold by various merchants including Amazon. Use the Amazon to limit the response to only items sold by Amazon.</p>';
		$html[] = '</div>';
	}

	// MinPercentageOff
	if( isset($ItemSearchParameters[$request['categ']]) && in_array( 'MinPercentageOff', $ItemSearchParameters[$request['categ']] ) ){
		$html[] = '<div class="AmazonWooCommerceParameterSection">';
		$html[] = 	'<label>' . __('Min Percentage Off', $AmazonWooCommerce->localizationName) .'</label>';
		$html[] = 	'<input type="text" size="22" name="AmazonWooCommerceParameter[MinPercentageOff]">';
		$html[] = 	'<p>Specifies the minimum percentage off for the items to return.</p>';
		$html[] = '</div>';
	}

	// Sort
	
	// button
	$html[] = '<input type="submit" value="' . __('Import Items', 'Search for products') . '" class="AmazonWooCommerce-button blue" >';

	die(json_encode(array(
		'status' 	=> 'valid',
		'html'		=> implode("\n", $html)
	)));
}

add_filter('cron_schedules', 'new_interval');

// add once 10 minute interval to wp schedules
function new_interval($interval) {

    $interval['minutes_1'] = array('interval' => 1*60, 'display' => 'Once 10 minutes');

    return $interval;
}
add_action('wp_ajax_AmazonWooCommerceLaunchSearch', 'AmazonWooCommerceLaunchSearch_callback');
function AmazonWooCommerceLaunchSearch_callback() {
	$requestData = array(
		'params' => isset($_REQUEST['params']) ? $_REQUEST['params'] : '',
		'page' => isset($_REQUEST['page']) ? (int)($_REQUEST['page']) : '',
		'node' => isset($_REQUEST['node']) ? $_REQUEST['node'] : '',
	);
	$parameters = array();
	parse_str( ( $requestData['params'] ), $parameters);

	if( isset($parameters['AmazonWooCommerceParameter'])) {
		$parameters = $parameters['AmazonWooCommerceParameter'];
	}
	//$parameters['ASIN'] = split(' ',$parameters['ASIN']);
	//print_r(  $parameters['ASIN'] );die();
	$amz_settings = @unserialize( get_option( 'AmazonWooCommerce_amazon' ) );
	
	//register_activation_hook(__FILE__, 'my_activation');
	//add_action('my_hourly_event', 'do_this_hourly');
	//wp_clear_scheduled_hook('update_amazon_to_woo_commerce');
	//if ( ! wp_next_scheduled( 'update_amazon_to_woo_commerce' ) ) {
		//wp_schedule_event( time(), 'minutes_10', 'update_amazon_to_woo_commerce' );
	//}
	//print_r( _get_cron_array() );
	/*function my_activation() {
		wp_schedule_event(time(), 'hourly', 'my_hourly_event');
	}
	
	function do_this_hourly() {
		echo 'wroking';
	} */
	//print_r( $amz_settings );
	$val  = $parameters['ASIN'];
	$theBody = wp_remote_retrieve_body( wp_remote_get('http://datafeedplus.azurewebsites.net/bda?api_key='.urlencode($amz_settings['AccessKeyID']).'&api_secret='.urlencode($amz_settings['SecretAccessKey']).'&api_affilate='.urlencode(json_encode($amz_settings['AffiliateID'])).'&PLATFORM='.$parameters['PLATFORM'].'&ASIN='.$val) );
	$theBody =  json_decode($theBody);
	if($theBody){
		foreach ($theBody as $key => $value){
							$postarr = array(
								'post_author' => '1',
								'post_content' => $value->EditorialReviews[0]->EditorialReview[0]->Content[0],
								'post_excerpt' => $value->ItemAttributes[0]->Feature[0],
								'post_title' => $value->ItemAttributes[0]->Title[0],
								'post_excerpt' => '',
								'post_status' => 'publish',
								'post_type' => 'post',
								'comment_status' => 'open',
								'ping_status' => 'closed',
								'to_ping' =>  '',
								'pinged' => '',
								'post_parent' => 0,
								'menu_order' => 0,
								'guid' => $value->DetailPageURL[0],
								'post_type' => 'product',
								'menu_order' => 0,
							);
							
							$post_ID = wp_insert_post ($postarr,false );
							
							$postarr = array(
								'meta_key' => '1',
								'meta_value' => '',
								'post_id' => $post_ID
							);
							$url = $value->LargeImage[0]->URL[0];
							$post_id = $post_ID;
							$desc =  $value->ItemAttributes[0]->Title[0];
							$image = media_sideload_image($url, $post_id, $desc);
							$sql = mysql_query("SELECT id from wp_posts where post_parent = '".$post_id."'");
							$ids = mysql_fetch_array($sql) ;
							
							add_post_meta($post_ID, '_regular_price', $value->ItemAttributes[0]->ListPrice[0]->Amount[0], true);
							add_post_meta($post_ID, '_sale_price', $value->ItemAttributes[0]->ListPrice[0]->Amount[0], true);
							add_post_meta($post_ID, '_price', $value->ItemAttributes[0]->ListPrice[0]->Amount[0], true);
							add_post_meta($post_ID, '_stock_status', 'instock', true);
							add_post_meta($post_ID, '_sku', $value->ASIN[0], true);
							add_post_meta($post_ID, '_thumbnail_id', $ids['id'], true);
							//echo "INSERT INTO wp_term_relationships (object_id,term_taxonomy_id) values ('".$post_id."','".$parameters['TERMS']."')";
							//print_r($parameters);
							$sql = mysql_query("INSERT INTO wp_term_relationships (object_id,term_taxonomy_id) values ('".$post_ID."','".$parameters['TERMS']."')");
							echo 'true';
					}
					}else{
						echo 'false';
					}
	die();
	//echo 'http://datafeedplus.azurewebsites.net/bda?ASIN'.str_replace(' ','',str_replace('\r\n','-',mysql_real_escape_string($parameters['ASIN'])));
	$theBody = wp_remote_retrieve_body( wp_remote_get('http://datafeedplus.azurewebsites.net/bda?api_key='.urlencode($amz_settings['AccessKeyID']).'&api_secret='.urlencode($amz_settings['SecretAccessKey']).'&api_affilate='.urlencode(json_encode($amz_settings['AffiliateID'])).'&PLATFORM='.$parameters['PLATFORM'].'&ASIN='.str_replace(' ','',str_replace('\r\n',',',mysql_real_escape_string($parameters['ASIN'])))) );
	//echo $theBody;
	$theBody =  json_decode($theBody);
	//echo '<pre>';
	//print_r($theBody);
	//echo '<pre>';

	//echo $theBody[0]->DetailPageURL[0];
	//die();
	if($theBody){
	foreach ($theBody as $key => $value){
			$postarr = array(
				'post_author' => '1',
				'post_content' => $value->EditorialReviews[0]->EditorialReview[0]->Content[0],
				'post_excerpt' => $value->ItemAttributes[0]->Feature[0],
				'post_title' => $value->ItemAttributes[0]->Title[0],
				'post_excerpt' => '',
				'post_status' => 'publish',
				'post_type' => 'post',
				'comment_status' => 'open',
				'ping_status' => 'closed',
				'to_ping' =>  '',
				'pinged' => '',
				'post_parent' => 0,
				'menu_order' => 0,
				'guid' => $value->DetailPageURL[0],
				'post_type' => 'product',
				'menu_order' => 0,
			);
			
			$post_ID = wp_insert_post ($postarr,false );
			
			$postarr = array(
				'meta_key' => '1',
				'meta_value' => '',
				'post_id' => $post_ID
			);
			$url = $value->LargeImage[0]->URL[0];
			$post_id = $post_ID;
			$desc =  $value->ItemAttributes[0]->Title[0];
			$image = media_sideload_image($url, $post_id, $desc);
			$sql = mysql_query("SELECT id from wp_posts where post_parent = '".$post_id."'");
			$ids = mysql_fetch_array($sql) ;
			
			add_post_meta($post_ID, '_regular_price', $value->ItemAttributes[0]->ListPrice[0]->Amount[0], true);
			add_post_meta($post_ID, '_sale_price', $value->ItemAttributes[0]->ListPrice[0]->Amount[0], true);
			add_post_meta($post_ID, '_price', $value->ItemAttributes[0]->ListPrice[0]->Amount[0], true);
			add_post_meta($post_ID, '_stock_status', 'instock', true);
			add_post_meta($post_ID, '_sku', $value->ASIN[0], true);
			add_post_meta($post_ID, '_thumbnail_id', $ids['id'], true);
			//echo "INSERT INTO wp_term_relationships (object_id,term_taxonomy_id) values ('".$post_id."','".$parameters['TERMS']."')";
			//print_r($parameters);
			$sql = mysql_query("INSERT INTO wp_term_relationships (object_id,term_taxonomy_id) values ('".$post_ID."','".$parameters['TERMS']."')");
	}
		echo '<h2>Product Import SucessFull</h2>';
	}else{
		echo '<h2>Product Import Failed</h2>';
	}
	die();
	
}


add_action('wp_ajax_AmazonWooCommerceGetChildNodes', 'AmazonWooCommerceGetChildNodes');
function AmazonWooCommerceGetChildNodes() {
	global $AmazonWooCommerce;

	$request = array(
		'nodeid' => isset($_REQUEST['ascensor']) ? $_REQUEST['ascensor'] : ''
	);

	$nodes = $AmazonWooCommerce->getBrowseNodes( $request['nodeid'] );

	// Apparel & Accessories

 	$html = array();
	$has_nodes = false;
	//$html[] = '<div class="AmazonWooCommerceParameterSection">';
	$html[] = 	'<select name="AmazonWooCommerceParameter[node]" style="margin: 10px 0px 0px 0px;">';
	$html[] = '<option value="">' . __('All', $AmazonWooCommerce->localizationName) .'</option>';
	foreach ($nodes as $key => $value){
		if( isset($value['BrowseNodeId']) && trim($value['BrowseNodeId']) != "" )
			$has_nodes = true;
			
		$html[] = '<option value="' . ( $value['BrowseNodeId'] ) . '">' . ( $value['Name'] ) . '</option>';
	}
	$html[] = 	'</select>';
	//$html[] = 	'<input type="button" class="AmazonWooCommerce-button blue AmazonWooCommerceGetChildNodes" value="' . __('Get Child Nodes', $AmazonWooCommerce->localizationName) .'" style="width: 100px; float: left;position: relative; bottom: -3px;" />';
	//$html[] = '</div>';
	
	if( $has_nodes == false ){
		$html = array();
	}
	die(json_encode(array(
		'status' 	=> 'valid',
		'html'		=> implode("\n", $html)
	)));
}