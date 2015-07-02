<?php

require './calculateshipping.php';

class TestCase extends \PHPUnit_Framework_TestCase
{
  public function testAustralia() {
    $this->assertEquals([], calculateshipping([
          'destination' => ['country' => 'AU']
          ]));
  }

  public function test90210()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '90210'],
        'items' => ['0' => [], '1' => []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-8',
        'total_price' => 10000,
        'currency' => 'USD'
        ]], $actual);
  }

  public function test10001()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '10001'],
        'items' => ['0' => [], '1' => []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-3',
        'total_price' => 10000,
        'currency' => 'USD'
        ]], $actual);
  }

  public function test96962()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '96962'],
        'items' => ['0' => [], '1' => []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-8',
        'total_price' => 10000,
        'currency' => 'USD'
        ]], $actual);
  }
}
