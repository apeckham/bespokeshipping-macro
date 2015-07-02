<?php
require './calculateshipping.php';

class TestCase extends \PHPUnit_Framework_TestCase
{
  public function testAU() {
    $this->assertEquals([], calculateshipping([
          'destination' => ['country' => 'AU']
          ]));
  }

  public function testZone8_90210()
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

  public function testZone3_10001()
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

  public function testZone8()
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

  public function testZone3()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '44113']
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-3',
        'total_price' => 544,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testZone1()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '14607']
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-1',
        'total_price' => 532,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testUnservedZip()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '96939']
        ]);

    $this->assertEquals([], $actual);
  }

  public function testInvalidZip()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '00000']
        ]);

    $this->assertEquals([], $actual);
  }
}
