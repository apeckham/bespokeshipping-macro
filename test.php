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
        'destination' => ['country' => 'US', 'postal_code' => '90210']
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-8',
        'total_price' => 997,
        'currency' => 'USD'
        ]], $actual);
  }

  public function test10001()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '10001']
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-3',
        'total_price' => 544,
        'currency' => 'USD'
        ]], $actual);
  }

  public function test96962()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '96962']
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-8',
        'total_price' => 997,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testInvalidZips()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '00000']
        ]);

    $this->assertEquals([], $actual);
  }
}
