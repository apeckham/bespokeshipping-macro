<?php
/* This macro will be parsed as PHP code (see http://www.php.net)

The calculateshipping function is called every time a shipping calculation request is made by Shopify.

The function must return an array of available shipping options, otherwise no shipping options will be returned to your customers.
*/
function calculateshipping($DATA) {

	/* do not edit above this line */

	/*
	NB: only the following php functions are allowed. Use of anything else will return a syntax error when you try to save.
	'array_merge',
	'array_diff',
	'array_intersect',
	'array_reverse',
	'array_unique',
	'in_array',
	'date',
	'range',
	'geteparcelzonebypostcode',
	'isset',
	'ceil',
	'floor',
	'round',
	'strtoupper',
	'strtolower',
	*/

	//this holds the rates that will be returned to your customer
	$_RATES = array();

	/*
	this is what $DATA looks like, you can use any of the info in $DATA to generate your shipping rate
	Array
	(
		[origin] => Array
			(
				[country] => AU
				[postal_code] => 3000
				[province] => VIC
				[city] => melbourne
				[name] =>
				[address1] => 1 main street
				[address2] =>
				[address3] =>
				[phone] =>
				[fax] =>
				[address_type] =>
				[company_name] =>
			)

		[destination] => Array
			(
				[country] => AU
				[postal_code] => 2000
				[province] => NSW
				[city] =>
				[name] =>
				[address1] =>
				[address2] =>
				[address3] =>
				[phone] =>
				[fax] =>
				[address_type] =>
				[company_name] =>
			)

		[items] => Array
			(
				[0] => Array
					(
						[name] => product10
						[sku] => SKUP00310
						[quantity] => 1
						[grams] => 1000
						[price] => 300
						[vendor] => PRODUCT
						[requires_shipping] => 1
						[taxable] => 1
						[fulfillment_service] => manual
						[product_id] => 128436738
						[variant_id] => 290813760
					)

				[1] => Array
					(
						[name] => product11
						[sku] => SKUP0011
						[quantity] => 1
						[grams] => 1100
						[price] => 300
						[vendor] => PRODUCT
						[requires_shipping] => 1
						[taxable] => 1
						[fulfillment_service] => manual
						[product_id] => 128436744
						[variant_id] => 290813772
					)

			)

		[currency] => AUD
	)

	//this is how you insert a rate
	*/

	$_RATES[] = array(
		"service_name" => "International Shipping", //this is what the customer will see
		"service_code" => "AUSPOST_INT", //can be anything you like
		"total_price" => 10000, //in cents
		"currency" => "AUD",
	);

	return $_RATES;

	/* do not edit below this line */

}
