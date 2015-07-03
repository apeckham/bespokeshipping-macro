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
        'destination' => ['country' => 'US', 'postal_code' => '90210'],
        'items' => [[]]
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
        'destination' => ['country' => 'US', 'postal_code' => '10001'],
        'items' => [[]]
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
        'destination' => ['country' => 'US', 'postal_code' => '96962'],
        'items' => [[]]
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
        'destination' => ['country' => 'US', 'postal_code' => '44113'],
        'items' => [[]]
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
        'destination' => ['country' => 'US', 'postal_code' => '14607'],
        'items' => [[]]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-1',
        'total_price' => 532,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testZone2_twoItems()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '13000'],
        'items' => [[], []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-2',
        'total_price' => 616,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testZone3_twoItems()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '44113'],
        'items' => [[], []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-3',
        'total_price' => 725,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testZone4_twoItems()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '28203'],
        'items' => [[], []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-4',
        'total_price' => 810,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testZone5_twoItems()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '32209'],
        'items' => [[], []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-5',
        'total_price' => 1066,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testZone6_twoItems()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '75201'],
        'items' => [[], []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-6',
        'total_price' => 1337,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testZone7_twoItems()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '77900'],
        'items' => [[], []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-7',
        'total_price' => 1628,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testZone8_twoItems()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '90001'],
        'items' => [[], []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-8',
        'total_price' => 1628,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testZone1_twoItems()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '14607'],
        'items' => [[], []]
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-1',
        'total_price' => 616,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testUnservedZip()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '96939'],
        'items' => []
        ]);

    $this->assertEquals([], $actual);
  }

  public function testInvalidZip()
  {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => '00000'],
        'items' => []
        ]);

    $this->assertEquals([], $actual);
  }
}
