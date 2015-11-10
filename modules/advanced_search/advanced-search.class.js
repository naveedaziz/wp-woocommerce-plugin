
AmazonWooCommerceAdvancedSearch = (function ($) {
    "use strict";

    // public
    var ASINs = [];
    var loaded_products = 0;
    var debug_level = 0;

	// init function, autoload
	(function init() {
		// init the tooltip
		tooltip();

		// load the triggers
		$(document).ready(function(){
			var loading = $("#AmazonWooCommerce-advanced-search #main-loading");

			triggers();
 
			load_categ_parameters( $(".AmazonWooCommerce-categories-list li.on a") );

			// show debug hint
			console.log( '// want some debug?' );
			console.log( 'AmazonWooCommerceAdvancedSearch.setDegubLevel(1);' );
		});
	})();

	function load_categ_parameters( that )
	{
		var loading = $("#AmazonWooCommerce-advanced-search #main-loading");
		loading.css('display', 'block');
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, {
			'action' 		: 'AmazonWooCommerceCategParameters',
			'categ'			: that.data('categ'),
			'nodeid'		: that.data('nodeid'),
			'debug_level'	: debug_level
		}, function(response) {
			if( response.status == 'valid' ){
				$('#AmazonWooCommerce-parameters-container').html( response.html );

				// clear the products from right panel
				$(".AmazonWooCommerce-product-list").html('');
			}

			loading.css('display', 'none');
		}, 'json');
	}

	function updateExecutionQueue()
	{
		var queue_list = $("input.AmazonWooCommerce-items-select");
		if( queue_list.length > 0 ){
			$.each( queue_list, function(){
				var that = $(this),
					asin = that.val();

				if( that.is(':checked') ){
					// if not in global asins storage than push to array
					if( $.inArray( asin, ASINs) == -1 ){
						ASINs.push( asin );
					}
				}

				if( that.is(':checked') == false ){
					// if not in global asins storage than push to array
					if( $.inArray( asin, ASINs) > -1){
						// remove array key by value
						ASINs.splice( ASINs.indexOf(asin), 1 );
					}
				}
			});

		}else{
			// refresh the array list
			ASINs = [];
		}

		// update the queue list DOM
		if( ASINs.length > 0 ){
			var newHtml = [];
			$.each( ASINs, function( key, value ){
				var original_img = $("img#AmazonWooCommerce-item-img-" + value);

				if( original_img.length > 0 ){
					newHtml.push( '<a href="#' + ( value ) + '" class="removeFromQueue" title="Remove from Queue">' );
					newHtml.push( 	'<img src="' + ( original_img.attr('src') ) + '" width="30" height="30">' );
					newHtml.push( 	'<span></span>' );
					newHtml.push( '</a>' );
				}
			});

			// append the new html DOM elements to queue container
			$("#AmazonWooCommerce-execution-queue-list").html( newHtml.join( "\n" ) );
		}

		// clear the execution queue if not ASIN(s)
		else{
			$("#AmazonWooCommerce-execution-queue-list").html( 'No item(s) yet' );

			// uncheck "select all" if need
			if( jQuery("#AmazonWooCommerce-items-select-all").is(':checked') ){
				jQuery("#AmazonWooCommerce-items-select-all").removeAttr('checked');
			}
		}
	}
	var objectToMap = false;
	var objectToMapForm = false;
	var productCounter = 1;
	function launchSearch( that, reset_page )
	{
		//var loading = $("#AmazonWooCommerce-advanced-search #main-loading");
		//loading.css('display', 'block');
		
		// get the current browse node
		var current_node = '';
		jQuery("#AmazonWooCommerceGetChildrens select").each(function(){
		    var that_select = jQuery(this);

		    if( that_select.val() != "" ){
		        current_node = that_select.val();
		    }
		});

		var page = $("select#AmazonWooCommerce-page").val() > 0 ? parseInt($("select#AmazonWooCommerce-page").val(), 10) : 1;
		if( reset_page == true ){
			page = 1;
		}
		console.log(that);
		if($('#ASINS').val()){
			var strs = $('#ASINS').val();
			strs = strs.replace(/\r?\n/g, ',');
			objectToMap = false;
			objectToMap = strs.split(',');
			jQuery.each(objectToMap,function(index,item){
				if(!item){
					delete objectToMap[index];
				}
			});
			objectToMapForm = false;
			objectToMapForm = that;
			startJob();
			if(objectToMap.length){
				var counterdss = objectToMap.length -1;
			}else{
				var counterdss = '';
			}
			$(".AmazonWooCommerce-product-list").html('<h2>Loading product <span id="voybrs">'+productCounter+'</span> / '+counterdss+'</h2><div id="syal"></div><h2></h2>');
		}
		return true;
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		
	}
	function startJob (){
		var page = $("select#AmazonWooCommerce-page").val() > 0 ? parseInt($("select#AmazonWooCommerce-page").val(), 10) : 1;
		var current_node = '';
		var objects = false;
		jQuery.each(objectToMap,function(index,item){
			if(item && !objects){
				objects = item;
				delete objectToMap[index];
			}
		});
		if(objects){
			objectToMapForm[0][3].value = objects;
				jQuery.post(ajaxurl, {
					'action' 		: 'AmazonWooCommerceLaunchSearch',
					'params'		: objectToMapForm.serialize(),
					'page'			: page,
					'node'			: current_node,
					'debug_level'	: debug_level
				}, function(response) {
					$('#voybrs').html(productCounter);
					productCounter++;
					if(response == 'true'){
						$('#syal').append('<div>&#10004; &nbsp;'+objects+'</div>');
					}else{
						$('#syal').append('<div>&#10060; &nbsp;'+objects+' Failed</div>');
					}
					startJob ();
				}, 'html');
		}else{
			$(".AmazonWooCommerce-product-list h2").html( 'Completed ALL' );
		}
	}
	function tailProductImport( import_step, callback )
	{
		//console.log( import_step ); 
		// stop if not valid ASINs key
		if(typeof ASINs[import_step] == 'undefined') return false;

		var asin = ASINs[import_step];

		// increse the loaded products marker
		++loaded_products;

		// make the import
		jQuery.post(ajaxurl, {
			'action' 		: 'AmazonWooCommerceImportProduct',
			'asin'			: asin,
			'category'		: $(".AmazonWooCommerce-categories-list li.on a").data('categ'),
			'to-category'	: $("#amzStore-to-category").val(),
			'debug_level'	: debug_level
		}, function(response) {

			if( typeof response.status != 'undefined' && response.status == 'valid' ) {
				// show the download assets lightbox
				if( response.show_download_lightbox == true ){
					$("#AmazonWooCommerce-wrapper").append( response.download_lightbox_html );
					
					AmazonWooCommerceAssetDownload.download_asset( $('.AmazonWooCommerce-images-tail').find('li').eq(0), undefined, 100, function(){
						
						$(".AmazonWooCommerce-asset-download-lightbox").remove();
				
						jQuery('a.removeFromQueue[href$="#' + ( asin ) + '"]').html( '<span class="success"></span>' );

						// continue insert the rest of ASINs
						if( ASINs.length > import_step ) tailProductImport( ++import_step, callback );
		
						// execute the callback at the end of loop
						if( ASINs.length == import_step ){
							callback( loaded_products );
						}
					} );
				}
				else{
					jQuery('a.removeFromQueue[href$="#' + ( asin ) + '"]').html( '<span class="success"></span>' );

					// continue insert the rest of ASINs
					if( ASINs.length > import_step ) tailProductImport( ++import_step, callback );
	
					// execute the callback at the end of loop
					if( ASINs.length == import_step ){
						callback( loaded_products );
					}
				}
			} else {
				// alert('Unable to import product: ' + asin );
				// return false;
				
				var errMsg = '';
				if ( typeof response.status != 'undefined' )
					errMsg = response.msg;
				else
					errMsg = 'unknown error occured: could be related to max_execution_time, memory_limit server settings!';
 
				jQuery('a.removeFromQueue[href$="#' + ( asin ) + '"]').html( '<span class="error"></span>' );
				jQuery('.AmazonWooCommerce-queue-table').find('tbody:last').append('<tr><td colspan=3>' + errMsg + '</td></tr>');

				// continue insert the rest of ASINs
				if( ASINs.length > import_step ) tailProductImport( ++import_step, callback );
	
				// execute the callback at the end of loop
				if( ASINs.length == import_step ){
					callback( loaded_products );
				}
			}

		}, 'json');
	}

	// public method
	function launchImport( that )
	{
		var loading = $("#AmazonWooCommerce-advanced-search #main-loading");
		loading.css('display', 'block');
		if( ASINs.length == 0 ){
			alert( 'First please select products from the list!' );
			loading.css('display', 'none');
			return false;
		}
  
		tailProductImport( 0, function( loaded_products ){
			//console.log( 'done', loaded_products ) ;

			jQuery('body').find('#AmazonWooCommerce-advanced-search .AmazonWooCommerce-items-list tr.on').remove();
			loading.css('display', 'none');

			return true;
		});
	}

	function getChildNodes( that )
	{
		var loading = $("#AmazonWooCommerce-advanced-search #main-loading");
		loading.css('display', 'block');

		// prev element valud
		var ascensor_value = that.val(),
			that_index = that.index();

		// max 3 deep
		if ( that_index > 10 ){
			loading.css('display', 'none');
			return false;
		}

		var container = $('#AmazonWooCommerceGetChildrens');
		var remove = false;
		// remove items prev of current selected
		container.find('select').each( function(i){
			if( remove == true ) $(this).remove();
			if( $(this).index() == that_index ){
				remove = true;
			}
		});

		// store current childrens into array
		if( ascensor_value != "" ){
			// make the import
			jQuery.post(ajaxurl, {
				'action' 		: 'AmazonWooCommerceGetChildNodes',
				'ascensor'		: ascensor_value,
				'debug_level'	: debug_level
			}, function(response) {
				if( response.status == 'valid' ){
					$('#AmazonWooCommerceGetChildrens').append( response.html );

					loading.css('display', 'none');
				}
			}, 'json');

		}else{
			loading.css('display', 'none');
		}
	}

	function setDegubLevel( new_level )
	{
		debug_level = new_level;
		return "new debug level: " + debug_level;
	}

	function tooltip()
	{
		/* CONFIG */
		var xOffset = -40,
			yOffset = -250;

		/* END CONFIG */
		jQuery('body').on('mouseover', '.AmazonWooCommerce-tooltip', function (e) {
			var img_src = $(this).data('img');
			console.log( $(this), img_src ); 
			$("body").append("<img id='AmazonWooCommerce-tooltip' src="+ img_src +">");
			$("#AmazonWooCommerce-tooltip")
				.css("top",(e.pageY - xOffset) + "px")
				.css("left",(e.pageX + yOffset) + "px")
				.show();
	  	});
		
		jQuery('body').on('mouseout', '.AmazonWooCommerce-tooltip', function (e) {
			$("#AmazonWooCommerce-tooltip").remove();
	    });
		jQuery('body').on('mousemove', '.AmazonWooCommerce-tooltip', function (e) {
			$("#AmazonWooCommerce-tooltip")
				.css("top",(e.pageY - xOffset) + "px")
				.css("left",(e.pageX + yOffset) + "px");
		});
	}

	function triggers()
	{
		jQuery('body').on('click', '.AmazonWooCommerce-categories-list a', function (e) {
			e.preventDefault();

			var that = $(this),
				that_p = that.parent('li');

			// escape if is the same block
			if( that.parent('li').hasClass('on') ) return true;

			// get current clicked category paramertes
			load_categ_parameters(that);

			$(".AmazonWooCommerce-categories-list li.on").removeClass('on');
			that_p.addClass('on');
		});
		
		jQuery('body').on('change', 'select.AmazonWooCommerceParameter-sort', function (e) {
		    var that = $(this),
		        val = that.val(),
		        opt = that.find("[value=" + ( val ) + "]"),
		        desc = opt.data('desc');

		    $("p#AmazonWooCommerceOrderDesc").html( "<strong>" + ( val ) + ":</strong> " + desc );
		});

		// check / uncheck all
		jQuery('body').on('change', '#AmazonWooCommerce-items-select-all', function (e)
		{
			var that = $(this),
				selectors = $("input.AmazonWooCommerce-items-select");

			if( that.is(':checked') == true){

				selectors.each(function(){
					var sub_that = $(this),
						tr_parent = sub_that.parents('tr').eq(0);
					sub_that.attr('checked', 'true');
					tr_parent.addClass('on');
				});
			}else{
				selectors.each(function(){
					var sub_that = $(this),
						tr_parent = sub_that.parents('tr').eq(0);
					sub_that.removeAttr('checked');
					tr_parent.removeClass('on');
				});
			}

			// update the execution queue
			updateExecutionQueue();
		})

		// temp
		.click();
		
		jQuery('body').on('change', 'input.AmazonWooCommerce-items-select', function (e)
		{
			var that = $(this),
				tr_parent = that.parents('tr').eq(0);
			if( that.is(':checked') == false){
				tr_parent.removeClass('on');
			}else{
				tr_parent.addClass('on');
			}

			// update the execution queue
			updateExecutionQueue();
		});
		
		jQuery('body').on('click', '#AmazonWooCommerce-advanced-search .AmazonWooCommerce-items-list tr td:not(:last-child, :first-child)', function (e)
		{
			var that = $(this),
				tr_parent = that.parent('tr'),
				input = tr_parent.find('input');
			input.click();
		});
		
		jQuery('body').on('click', '#AmazonWooCommerce-advanced-search a.removeFromQueue', function (e) 
		{
			e.preventDefault();

			var that = $(this),
				href = that.attr('href').replace("#", ''),
				tr_parent = $('tr#AmazonWooCommerce-item-row-' + href),
				input = tr_parent.find('input');

			input.click();
		});
		
		jQuery('body').on('submit', '#AmazonWooCommerce_import_panel', function (e) {
			e.preventDefault();
			
			launchSearch( $(this), true );
		});
		
		jQuery('body').on('change', 'select#AmazonWooCommerce-page', function (e) {
			e.preventDefault();

			launchSearch( $("#AmazonWooCommerce_import_panel"), false );
		});

		jQuery('body').on('click', 'a#AmazonWooCommerce-advance-import-btn', function (e) {
			e.preventDefault();

			launchImport();
		});
		
		jQuery('body').on('change', '#AmazonWooCommerceGetChildrens select', function (e) {
			e.preventDefault();

			getChildNodes( $(this) );
		});
	}

	// external usage
	return {
		"setDegubLevel": setDegubLevel,
        "ASINs": ASINs,
        "launchImport": launchImport
    }
})(jQuery);