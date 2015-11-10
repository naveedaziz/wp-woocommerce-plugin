// Initialization and events code for the app
AmazonWooCommerce = (function ($) {
    "use strict";
    
    var current_aff = {};
    
    (function init() {
    	
    	var $current_aff = $('#AmazonWooCommerce_current_aff');
    	if ( $current_aff.length > 0 ) {
			current_aff = $current_aff.data('current_aff');
		}

    	$(document).ready(function(){
    	});
    	
    })();
    
    function popup(url, title, params) {
		//url = 'http://www.amazon' + current_aff['user_country']['website'] + url;
		window.open(url, title, params);
    };

   	return {
   		'popup'				: popup
   	}
})(jQuery);