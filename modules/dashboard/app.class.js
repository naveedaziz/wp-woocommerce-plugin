
AmazonWooCommerceDashboard = (function ($) {
    "use strict";

    // public
    var debug = false;
    var maincontainer = null;

	// init function, autoload
	function init()
	{
		maincontainer = $("#AmazonWooCommerce-ajax-response");
		triggers();
	};
	
	function boxLoadAjaxContent( box )
	{
		var allAjaxActions = [];
		box.find('.is_ajax_content').each(function(key, value){
			
			var alias = $(value).text().replace( /\n/g, '').replace("{", "").replace("}", "");
			$(value).attr('id', 'AmazonWooCommerce-row-alias-' + alias);
			allAjaxActions.push( alias );
		}); 
		
		 
		jQuery.post(ajaxurl, {
			'action' 		: 'AmazonWooCommerceDashboardRequest',
			'sub_actions'	: allAjaxActions.join(","),
			'prod_per_page'	: box.find(".AmazonWooCommerce-numer-items-in-top").val(),
			'debug'			: debug
		}, function(response) {
			$.each(response, function(key, value){
				if( value.status == 'valid' ){
					var row = box.find( "#AmazonWooCommerce-row-alias-" + key );
					row.html(value.html);
					
					row.removeClass('is_ajax_content');
					
					tooltip();
				} 
			});
			
		}, 'json');
	}
	
	function tooltip()
	{
		var xOffset = -30,
			yOffset = -300,
			winW 	= $(window).width();
		
		$(".AmazonWooCommerce-aa-products-container ul li a").hover(function(e){
			
			var that = $(this),
				preview = that.data('preview');

			$("body").append("<p id='AmazonWooCommerce-aa-preview'>"+ ( '<img src="' + ( preview ) + '" >' ) +"</p>");
			
			var new_left = e.pageX + yOffset;
			
			if( new_left > (winW - 640) ){
				new_left = (winW - 640)
			}
			$("#AmazonWooCommerce-aa-preview")
				.css("top",(e.pageY - xOffset) + "px")
				.css("left",(new_left) + "px")
				.fadeIn("fast");
	    },
		function(){
			this.title = this.t;
			$("#AmazonWooCommerce-aa-preview").remove();
	    });
		
	
		$(".AmazonWooCommerce-aa-products-container ul li a").mousemove(function(e){
			
			var new_left = e.pageX + yOffset;
			if( new_left > (winW - 640) ){
				new_left = (winW - 640)
			}
			
			$("#AmazonWooCommerce-aa-preview")
				.css("top",(e.pageY - xOffset) + "px")
				.css("left",(new_left) + "px");
		});
	}

	
	function triggers()
	{
		maincontainer.find(">div").each( function(e){
			var that = $(this);
			// check if box has ajax content
			if( that.find('.is_ajax_content').size() > 0 ){
				boxLoadAjaxContent(that);
			}
		});
		
		maincontainer.find(".AmazonWooCommerce-numer-items-in-top").on('change', function(){
			var that = $(this),
				box = that.parents('.AmazonWooCommerce-dashboard-status-box').eq(0);
			
			box.find('.AmazonWooCommerce-dashboard-status-box-content').addClass('is_ajax_content').html('{products_performances}');
			 
			boxLoadAjaxContent(box);
		});
		
		$(".AmazonWooCommerce-aa-products-tabs").on('click', "li:not(.on) a", function(e){
			e.preventDefault();
			
			var that = $(this),
				alias = that.attr('class').split("items-"),
				alias = alias[1];
			
			$('.AmazonWooCommerce-aa-products-container').hide();
			$("#aa-prod-" + alias).show();
			
			$(".AmazonWooCommerce-aa-products-tabs").find("li.on").removeClass('on');
			that.parent('li').addClass('on');
		});
	}
	
	// external usage
	return {
		"init": init
    }
})(jQuery);
