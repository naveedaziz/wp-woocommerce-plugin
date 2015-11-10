jQuery(document).ready(function($) {

	var AmazonWooCommerce_launch_search = function (data) {
		var searchAjaxLoader 	= jQuery("#AmazonWooCommerce-ajax-loader"),
			searchBtn 			= jQuery("#AmazonWooCommerce-search-link");
			
		searchBtn.hide();	
		searchAjaxLoader.show();
		
		var data = {
			action: 'amazon_request',
			search: jQuery('#AmazonWooCommerce-search').val(),
			category: jQuery('#AmazonWooCommerce-category').val(),
			page: ( parseInt(jQuery('#AmazonWooCommerce-page').val(), 10) > 0 ? parseInt(jQuery('#AmazonWooCommerce-page').val(), 10) : 1 )
		};
		
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			jQuery("#AmazonWooCommerce-ajax-results").html(response);
			
			searchBtn.show();	
			searchAjaxLoader.hide();
		});
	};
	
	jQuery('body').on('change', '#AmazonWooCommerce-page', function (e) {
		AmazonWooCommerce_launch_search();
	});
	
	jQuery("#AmazonWooCommerce-search-form").submit(function(e) {
		AmazonWooCommerce_launch_search();
		return false;
	});
	
	jQuery('body').on('click', 'a.AmazonWooCommerce-load-product', function (e) {
		e.preventDefault();
		
		var data = {
			'action': 'AmazonWooCommerce_load_product',
			'ASIN':  jQuery(this).attr('rel')
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.ajax({
			url: ajaxurl,
			type: 'POST',
			dataType: 'json',
			data: data,
			success: function(response) {
				if(response.status == 'valid'){
					window.location = response.redirect_url;
					return true;
				}else{
					alert(response.msg);
					return false
				}
			}
		});
	});
});