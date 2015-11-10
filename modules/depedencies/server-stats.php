<?php
// soap
if (extension_loaded('soap')) {
?>
<div class="AmazonWooCommerce-message AmazonWooCommerce-success">
	SOAP extension installed on server
</div>
<?php
}else{
?>
<div class="AmazonWooCommerce-message AmazonWooCommerce-error">
	SOAP extension not installed on your server, please talk to your hosting company and they will install it for you.
</div>
<?php
}

// Woocommerce
if( class_exists( 'Woocommerce' ) ){
?>
<div class="AmazonWooCommerce-message AmazonWooCommerce-success">
	 WooCommerce plugin installed
</div>
<?php
}else{
?>
<div class="AmazonWooCommerce-message AmazonWooCommerce-error">
	WooCommerce plugin not installed, in order the product to work please install WooCommerce wordpress plugin.
</div>
<?php
}

// curl
if ( function_exists('curl_init') ) {
?>
<div class="AmazonWooCommerce-message AmazonWooCommerce-success">
	cURL extension installed on server
</div>
<?php
}else{
?>
<div class="AmazonWooCommerce-message AmazonWooCommerce-error">
	cURL extension not installed on your server, please talk to your hosting company and they will install it for you.
</div>
<?php
}
?>
<?php
