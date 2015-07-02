<?php

require './calculateshipping.php';

class TestCase extends \PHPUnit_Framework_TestCase
{
  public function testAustralia() {
    $this->assertEquals([], calculateshipping([
          'destination' => ['country' => 'AU']
          ]));
  }

  public function testUS()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '90210'],
        'items' => ['0' => [], '1' => []],
        'currency' => 'AUD',
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS_PRIORITY_MAIL',
        'total_price' => 10000,
        'currency' => 'USD'
        ]], $actual);
  }
}
