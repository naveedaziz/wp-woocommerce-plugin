<?php
 
function __AmazonWooCommerce_attributesList() {
	$attrList = array(
		'About' => 'About',
		'AboutMe' => 'AboutMe',
		'Actor' => 'Actor',
		'AdditionalName' => 'AdditionalName',
		'AlternateVersion' => 'AlternateVersion',
		'Amount' => 'Amount',
		'Artist' => 'Artist',
		'ASIN' => 'ASIN',
		'AspectRatio' => 'AspectRatio',
		'AudienceRating' => 'AudienceRating',
		'AudioFormat' => 'AudioFormat',
		'Author' => 'Author',
		'Availability' => 'Availability',
		'AvailabilityAttributes' => 'AvailabilityAttributes',
		'Benefit' => 'Benefit',
		'Benefits' => 'Benefits',
		'BenefitType' => 'BenefitType',
		'BenefitDescription' => 'BenefitDescription',
		'Bin' => 'Bin',
		'Binding' => 'Binding',
		'BinItemCount' => 'BinItemCount',
		'BinName' => 'BinName',
		'BinParameter' => 'BinParameter',
		'Brand' => 'Brand',
		'BrowseNodeId' => 'BrowseNodeId',
		'CartId' => 'CartId',
		'CartItem' => 'CartItem',
		'CartItemId' => 'CartItemId',
		'CartItems' => 'CartItems',
		'Category' => 'Category',
		'CEROAgeRating' => 'CEROAgeRating',
		'ClothingSize' => 'ClothingSize',
		'Code' => 'Code',
		'Collection' => 'Collection',
		'CollectionItem' => 'CollectionItem',
		'CollectionParent' => 'CollectionParent',
		'Color' => 'Color',
		'Comment' => 'Comment',
		'ComponentType' => 'ComponentType',
		'Condition' => 'Condition',
		'CorrectedQuery' => 'CorrectedQuery',
		'CouponCombinationType' => 'CouponCombinationType',
		'Creator' => 'Creator',
		'CurrencyAmount' => 'CurrencyAmount',
		'CurrencyCode' => 'CurrencyCode',
		'Date' => 'Date',
		'DateAdded' => 'DateAdded',
		'DateCreated' => 'DateCreated',
		'Department' => 'Department',
		'Details' => 'Details',
		'Director' => 'Director',
		'EAN' => 'EAN',
		'EANList' => 'EANList',
		'EANListElement' => 'EANListElement',
		'Edition' => 'Edition',
		'EditorialReviewIsLinkSuppressed' => 'EditorialReviewIsLinkSuppressed',
		'EISBN' => 'EISBN',
		'EligibilityRequirement' => 'EligibilityRequirement',
		'EligibilityRequirementDescription' => 'EligibilityRequirementDescription',
		'EligibilityRequirements' => 'EligibilityRequirements',
		'EligibilityRequirementType' => 'EligibilityRequirementType',
		'EndDate' => 'EndDate',
		'EpisodeSequence' => 'EpisodeSequence',
		'ESRBAgeRating' => 'ESRBAgeRating',
		'Feature' => 'Feature',
		'Feedback' => 'Feedback',
		'Fitment' => 'Fitment',
		'FitmentAttribute' => 'FitmentAttribute',
		'FitmentAttributes' => 'FitmentAttributes',
		'FixedAmount' => 'FixedAmount',
		'Format' => 'Format',
		'FormattedPrice' => 'FormattedPrice',
		'Genre' => 'Genre',
		'GroupClaimCode' => 'GroupClaimCode',
		'HardwarePlatform' => 'HardwarePlatform',
		'HazardousMaterialType' => 'HazardousMaterialType',
		'Height' => 'Height',
		'HelpfulVotes' => 'HelpfulVotes',
		'HMAC' => 'HMAC',
		'IFrameURL' => 'IFrameURL',
		'Image' => 'Image',
		'IsAdultProduct' => 'IsAdultProduct',
		'IsAutographed' => 'IsAutographed',
		'ISBN' => 'ISBN',
		'IsCategoryRoot' => 'IsCategoryRoot',
		'IsEligibleForSuperSaverShipping' => 'IsEligibleForSuperSaverShipping',
		'IsEligibleForTradeIn' => 'IsEligibleForTradeIn',
		'IsEmailNotifyAvailable' => 'IsEmailNotifyAvailable',
		'IsFit' => 'IsFit',
		'IsInBenefitSet' => 'IsInBenefitSet',
		'IsInEligibilityRequirementSet' => 'IsInEligibilityRequirementSet',
		'IsLinkSuppressed' => 'IsLinkSuppressed',
		'IsMemorabilia' => 'IsMemorabilia',
		'IsNext' => 'IsNext',
		'IsPrevious' => 'IsPrevious',
		'ItemApplicability' => 'ItemApplicability',
		'ItemDimensions' => 'ItemDimensions',
		'IssuesPerYear' => 'IssuesPerYear',
		'IsValid' => 'IsValid',
		'ItemAttributes' => 'ItemAttributes',
		'ItemPartNumber' => 'ItemPartNumber',
		'Keywords' => 'Keywords',
		'Label' => 'Label',
		'Language' => 'Language',
		'Languages' => 'Languages',
		'LargeImage' => 'LargeImage',
		'LastModified' => 'LastModified',
		'LegalDisclaimer' => 'LegalDisclaimer',
		'Length' => 'Length',
		'ListItemId' => 'ListItemId',
		'ListPrice' => 'ListPrice',
		'LoyaltyPoints' => 'LoyaltyPoints',
		'Manufacturer' => 'Manufacturer',
		'ManufacturerMaximumAge' => 'ManufacturerMaximumAge',
		'ManufacturerMinimumAge' => 'ManufacturerMinimumAge',
		'ManufacturerPartsWarrantyDescription' => 'ManufacturerPartsWarrantyDescription',
		'MaterialType' => 'MaterialType',
		'MaximumHours' => 'MaximumHours',
		'MediaType' => 'MediaType',
		'MediumImage' => 'MediumImage',
		'MerchandisingMessage' => 'MerchandisingMessage',
		'MerchantId' => 'MerchantId',
		'Message' => 'Message',
		'MetalType' => 'MetalType',
		'MinimumHours' => 'MinimumHours',
		'Model' => 'Model',
		'MoreOffersUrl' => 'MoreOffersUrl',
		'MPN' => 'MPN',
		'Name' => 'Name',
		'Nickname' => 'Nickname',
		'Number' => 'Number',
		'NumberOfDiscs' => 'NumberOfDiscs',
		'NumberOfIssues' => 'NumberOfIssues',
		'NumberOfItems' => 'NumberOfItems',
		'NumberOfPages' => 'NumberOfPages',
		'NumberOfTracks' => 'NumberOfTracks',
		'OccasionDate' => 'OccasionDate',
		'OfferListingId' => 'OfferListingId',
		'OperatingSystem' => 'OperatingSystem',
		'OtherCategoriesSimilarProducts' => 'OtherCategoriesSimilarProducts',
		'PackageQuantity' => 'PackageQuantity',
		'ParentASIN' => 'ParentASIN',
		'PartBrandBins' => 'PartBrandBins',
		'PartBrowseNodeBins' => 'PartBrowseNodeBins',
		'PartNumber' => 'PartNumber',
		'PartnerName' => 'PartnerName',
		'Platform' => 'Platform',
		'Price' => 'Price',
		'ProductGroup' => 'ProductGroup',
		'ProductTypeSubcategory' => 'ProductTypeSubcategory',
		'Promotion' => 'Promotion',
		'PromotionId' => 'PromotionId',
		'Promotions' => 'Promotions',
		'PublicationDate' => 'PublicationDate',
		'Publisher' => 'Publisher',
		'PurchaseURL' => 'PurchaseURL',
		'Quantity' => 'Quantity',
		'Rating' => 'Rating',
		'RegionCode' => 'RegionCode',
		'RegistryName' => 'RegistryName',
		'RelatedItem' => 'RelatedItem',
		'RelatedItems' => 'RelatedItems',
		'RelatedItemsCount' => 'RelatedItemsCount',
		'RelatedItemPage' => 'RelatedItemPage',
		'RelatedItemPageCount' => 'RelatedItemPageCount',
		'Relationship' => 'Relationship',
		'RelationshipType ' => 'RelationshipType ',
		'ReleaseDate' => 'ReleaseDate',
		'RequestId' => 'RequestId',
		'Role' => 'Role',
		'RunningTime' => 'RunningTime',
		'SalesRank' => 'SalesRank',
		'SavedForLaterItem' => 'SavedForLaterItem',
		'SearchBinSet' => 'SearchBinSet',
		'SearchBinSets' => 'SearchBinSets',
		'SeikodoProductCode' => 'SeikodoProductCode',
		'ShipmentItems' => 'ShipmentItems',
		'Shipments' => 'Shipments',
		'SimilarProducts' => 'SimilarProducts',
		'SimilarViewedProducts' => 'SimilarViewedProducts',
		'Size' => 'Size',
		'SKU' => 'SKU',
		'SmallImage' => 'SmallImage',
		'Source' => 'Source',
		'StartDate' => 'StartDate',
		'StoreId' => 'StoreId',
		'StoreName' => 'StoreName',
		'Studio' => 'Studio',
		'SubscriptionLength' => 'SubscriptionLength',
		'Summary' => 'Summary',
		'SwatchImage' => 'SwatchImage',
		'TermsAndConditions' => 'TermsAndConditions',
		'ThumbnailImage' => 'ThumbnailImage',
		'TinyImage' => 'TinyImage',
		'Title' => 'Title',
		'TopItem' => 'TopItem',
		'TopItemSet' => 'TopItemSet',
		'TotalCollectible' => 'TotalCollectible',
		'TotalItems' => 'TotalItems',
		'TotalNew' => 'TotalNew',
		'TotalOfferPages' => 'TotalOfferPages',
		'TotalOffers' => 'TotalOffers',
		'TotalPages' => 'TotalPages',
		'TotalRatings' => 'TotalRatings',
		'TotalRefurbished' => 'TotalRefurbished',
		'TotalResults' => 'TotalResults',
		'TotalReviewPages' => 'TotalReviewPages',
		'TotalReviews' => 'TotalReviews',
		'Totals' => 'Totals',
		'TotalTimesRead' => 'TotalTimesRead',
		'TotalUsed' => 'TotalUsed',
		'TotalVotes' => 'TotalVotes',
		'Track' => 'Track',
		'TradeInValue' => 'TradeInValue',
		'TransactionDate' => 'TransactionDate',
		'TransactionDateEpoch' => 'TransactionDateEpoch',
		'TransactionId' => 'TransactionId',
		'TransactionItem' => 'TransactionItem',
		'TransactionItemId' => 'TransactionItemId',
		'TransactionItems' => 'TransactionItems',
		'Type' => 'Type',
		'UPC' => 'UPC',
		'UPCList' => 'UPCList',
		'UPCListElement' => 'UPCListElement',
		'URL' => 'URL',
		'URLEncodedHMAC' => 'URLEncodedHMAC',
		'UserAgent' => 'UserAgent',
		'UserId' => 'UserId',
		'VariationAttribute' => 'VariationAttribute',
		'VariationDimension' => 'VariationDimension',
		'Warranty' => 'Warranty',
		'WEEETaxValue' => 'WEEETaxValue',
		'Weight' => 'Weight',
		'Width' => 'Width',
		'Year' => 'Year'
	);
	return $attrList;
}

function __AmazonWooCommerce_attributes_clean_duplicate( $istab = '' ) {
	global $AmazonWooCommerce;
   
	$html = array();
	
	$html[] = '<div class="AmazonWooCommerce-form-row attr-clean-duplicate' . ($istab!='' ? ' '.$istab : '') . '">';

	$html[] = '<label style="display:inline;float:none;" for="clean_duplicate_attributes">' . __('Clean duplicate attributes:', $AmazonWooCommerce->localizationName) . '</label>';

	$options = $AmazonWooCommerce->getAllSettings('array', 'amazon');
	$val = '';
	if ( isset($options['clean_duplicate_attributes']) ) {
		$val = $options['clean_duplicate_attributes'];
	}
		
	ob_start();
?>
		<select id="clean_duplicate_attributes" name="clean_duplicate_attributes" style="width:120px; margin-left: 18px;">
			<?php
			foreach (array('yes' => 'YES', 'no' => 'NO') as $kk => $vv){
				echo '<option value="' . ( $vv ) . '" ' . ( $val == $vv ? 'selected="true"' : '' ) . '>' . ( $vv ) . '</option>';
			} 
			?>
		</select>&nbsp;&nbsp;
<?php
	$html[] = ob_get_contents();
	ob_end_clean();

	$html[] = '<input type="button" class="AmazonWooCommerce-button blue" style="width: 160px;" id="AmazonWooCommerce-attributescleanduplicate" value="' . ( __('clean Now ', $AmazonWooCommerce->localizationName) ) . '">
	<span style="margin:0px; margin-left: 10px; display: block;" class="response"></span>';

	$html[] = '</div>';

	// view page button
	ob_start();
?>
	<script>
	(function($) {
		var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>'

		$("body").on("click", "#AmazonWooCommerce-attributescleanduplicate", function(){

			$.post(ajaxurl, {
				'action' 		: 'AmazonWooCommerce_AttributesCleanDuplicate',
				'sub_action'	: 'attr_clean_duplicate'
			}, function(response) {

				var $box = $('.attr-clean-duplicate'), $res = $box.find('.response');
				$res.html( response.msg_html );
				if ( response.status == 'valid' )
					return true;
				return false;
			}, 'json');
		});
   	})(jQuery);
	</script>
<?php
	$__js = ob_get_contents();
	ob_end_clean();
	$html[] = $__js;
  
	return implode( "\n", $html );
}

function __AmazonWooCommerce_category_slug_clean_duplicate( $istab = '' ) {
	global $AmazonWooCommerce;
   
	$html = array();
	
	$html[] = '<div class="AmazonWooCommerce-form-row category-slug-clean-duplicate' . ($istab!='' ? ' '.$istab : '') . '">';

	$html[] = '<label style="display:inline;float:none;" for="clean_duplicate_category_slug">' . __('Clean duplicate category slug:', $AmazonWooCommerce->localizationName) . '</label>';

	$options = $AmazonWooCommerce->getAllSettings('array', 'amazon');
	$val = '';
	if ( isset($options['clean_duplicate_category_slug']) ) {
		$val = $options['clean_duplicate_category_slug'];
	}
		
	ob_start();
?>
		<select id="clean_duplicate_category_slug" name="clean_duplicate_category_slug" style="width:120px; margin-left: 18px;">
			<?php
			foreach (array('yes' => 'YES', 'no' => 'NO') as $kk => $vv){
				echo '<option value="' . ( $vv ) . '" ' . ( $val == $vv ? 'selected="true"' : '' ) . '>' . ( $vv ) . '</option>';
			} 
			?>
		</select>&nbsp;&nbsp;
<?php
	$html[] = ob_get_contents();
	ob_end_clean();

	$html[] = '<input type="button" class="AmazonWooCommerce-button blue" style="width: 160px;" id="AmazonWooCommerce-categoryslugcleanduplicate" value="' . ( __('clean Now ', $AmazonWooCommerce->localizationName) ) . '">
	<span style="margin:0px; margin-left: 10px; display: block;" class="response"></span>';

	$html[] = '</div>';

	// view page button
	ob_start();
?>
	<script>
	(function($) {
		var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>'

		$("body").on("click", "#AmazonWooCommerce-categoryslugcleanduplicate", function(){

			$.post(ajaxurl, {
				'action' 		: 'AmazonWooCommerce_CategorySlugCleanDuplicate',
				'sub_action'	: 'category_slug_clean_duplicate'
			}, function(response) {

				var $box = $('.category-slug-clean-duplicate'), $res = $box.find('.response');
				$res.html( response.msg_html );
				if ( response.status == 'valid' )
					return true;
				return false;
			}, 'json');
		});
   	})(jQuery);
	</script>
<?php
	$__js = ob_get_contents();
	ob_end_clean();
	$html[] = $__js;
  
	return implode( "\n", $html );
}

function __AmazonWooCommerceAffIDsHTML( $istab = '' )
{
    global $AmazonWooCommerce;
    
    $html         = array();
    $img_base_url = $AmazonWooCommerce->cfg['paths']["plugin_dir_url"] . 'modules/amazon/assets/flags/';
    
    $config = @unserialize(get_option($AmazonWooCommerce->alias . '_amazon'));
    
    $html[] = '<div class="AmazonWooCommerce-form-row' . ($istab!='' ? ' '.$istab : '') . '">';
    $html[] = '<label>Your Affiliate IDs</label>';
    $html[] = '<div class="AmazonWooCommerce-form-item large">';
    $html[] = '<span class="formNote">Your Affiliate ID probably ends in -20, -21 or -22. You get this ID by signing up for Amazon Associates.</span>';
    $html[] = '<div class="AmazonWooCommerce-aff-ids">';
    $html[] = '<img src="' . ($img_base_url) . 'US-flag.gif" height="20"><input type="text" value="' . ($config['AffiliateID']['com']) . '" name="AffiliateID[com]" id="AffiliateID[com]"> <br />';
    $html[] = '<img src="' . ($img_base_url) . 'CA-flag.gif" height="20"><input type="text" value="' . ($config['AffiliateID']['ca']) . '" name="AffiliateID[ca]" id="AffiliateID[ca]"> <br />';
    $html[] = '<img src="' . ($img_base_url) . 'UK-flag.gif" height="20"><input type="text" value="' . ($config['AffiliateID']['uk']) . '" name="AffiliateID[uk]" id="AffiliateID[uk]"> <br />';
    $html[] = '<img src="' . ($img_base_url) . 'DE-flag.gif" height="20"><input type="text" value="' . ($config['AffiliateID']['de']) . '" name="AffiliateID[de]" id="AffiliateID[de]"> <br />';
    $html[] = '<img src="' . ($img_base_url) . 'FR-flag.gif" height="20"><input type="text" value="' . ($config['AffiliateID']['fr']) . '" name="AffiliateID[fr]" id="AffiliateID[fr]"> <br />';
    $html[] = '<img src="' . ($img_base_url) . 'IN-flag.gif" height="20"><input type="text" value="' . ($config['AffiliateID']['in']) . '" name="AffiliateID[in]" id="AffiliateID[in]"> <br />';
    $html[] = '<img src="' . ($img_base_url) . 'IT-flag.gif" height="20"><input type="text" value="' . ($config['AffiliateID']['it']) . '" name="AffiliateID[it]" id="AffiliateID[it]"> <br />';
    $html[] = '<img src="' . ($img_base_url) . 'ES-flag.gif" height="20"><input type="text" value="' . ($config['AffiliateID']['es']) . '" name="AffiliateID[es]" id="AffiliateID[es]"> <br />';
    $html[] = '<img src="' . ($img_base_url) . 'JP-flag.gif" height="20"><input type="text" value="' . ($config['AffiliateID']['jp']) . '" name="AffiliateID[jp]" id="AffiliateID[jp]"> <br />';
    $html[] = '<img src="' . ($img_base_url) . 'CN-flag.gif" height="20"><input type="text" value="' . ($config['AffiliateID']['cn']) . '" name="AffiliateID[cn]" id="AffiliateID[cn]"> <br />';
    $html[] = '</div>';
    $html[] = '</div>';
    $html[] = '</div>';
    
    return implode("\n", $html);
}

global $AmazonWooCommerce;
echo json_encode(array(
    $tryed_module['db_alias'] => array(
        
        /* define the form_sizes  box */
        'amazon' => array(
            'title' => 'Amazon settings',
            'icon' => '{plugin_folder_uri}assets/amazon.png',
            'size' => 'grid_4', // grid_1|grid_2|grid_3|grid_4
            'header' => true, // true|false
            'toggler' => false, // true|false
            'buttons' => true, // true|false
            'style' => 'panel', // panel|panel-widget
            
				// tabs
				'tabs'	=> array(
					'__tab1'	=> array(__('Amazon SETUP', $AmazonWooCommerce->localizationName), 'protocol, country, AccessKeyID, SecretAccessKey, AffiliateId, main_aff_id, buttons, help_required_fields, help_available_countries'),
					),
            
            // create the box elements array
            'elements' => array(
                'AccessKeyID' => array(
                    'type' => 'text',
                    'std' => '',
                    'size' => 'large',
                    'title' => 'Access Key ID',
                    'force_width' => '250',
                    'desc' => 'Are required in order to send requests to Amazon API.'
                ),
                'SecretAccessKey' => array(
                    'type' => 'text',
                    'std' => '',
                    'size' => 'large',
                    'force_width' => '300',
                    'title' => 'Secret Access Key',
                    'desc' => 'Are required in order to send requests to Amazon API.'
                ),
                'AffiliateId' => array(
                    'type' => 'html',
                    'std' => '',
                    'size' => 'large',
                    'title' => 'Affiliate Information',
                    'html' => __AmazonWooCommerceAffIDsHTML( '__tab1' )
                ),
                'spin_at_import' => array(
                    'type' => 'select',
                    'premium' => true,
                    'std' => 'no',
                    'size' => 'large',
                    'force_width' => '100',
                    'title' => 'Spin on Import',
                    'desc' => 'Choose YES if you want to auto spin post, page content at amazon import',
                    'options' => array(
                        'yes' => 'YES',
                        'no' => 'NO'
                    )
                ),
                'spin_max_replacements' => array(
                    'type' => 'select',
                    'premium' => true,
                    'std' => '10',
                    'force_width' => '150',
                    'size' => 'large',
                    'title' => 'Spin max replacements',
                    'desc' => 'Choose the maximum number of replacements for auto spin post, page content at amazon import.',
                    'options' => array(
						'10' 		=> '10 replacements',
						'30' 		=> '30 replacements',
						'60' 		=> '60 replacements',
						'80' 		=> '80 replacements',
						'100' 		=> '100 replacements',
						'0' 		=> 'All possible replacements',
					)
                ),
                
				'buttons' => array(
					'type' => 'buttons',
					'options' => array(
						'check_amz' => array(
							'width' => '162px',
							'type' => 'button',
							'value' => 'Check Amazon AWS Keys',
							'color' => 'blue',
							'action' => 'AmazonWooCommerceCheckAmzKeys'
						)
					)
				),
            )
        )
    )
));