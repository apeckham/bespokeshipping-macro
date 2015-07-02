<?php
/* This macro will be parsed as PHP code (see http://www.php.net)

   The calculateshipping function is called every time a shipping calculation request is made by Shopify.

   The function must return an array of available shipping options, otherwise no shipping options will be returned to your customers.
 */
function calculateshipping($DATA) {

  /* do not edit above this line */

  $_RATES = array();

  if ($DATA['destination']['country'] == 'US') {
    $_RATES[] = array(
        "service_name" => "USPS Priority Mail",
        "service_code" => "USPS_PRIORITY_MAIL",
        "total_price" => 10000,
        "currency" => "USD"
        );
  }

  return $_RATES;

  /* do not edit below this line */

}
