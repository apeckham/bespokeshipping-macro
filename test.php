<?php
require './calculateshipping.php';

class TestCase extends \PHPUnit_Framework_TestCase {
  public function testZone8_90210() {
    $this->assertShipping('USPS-ZONE-8', 997, '90210', 1);
  }

  public function testZone3_10001() {
    $this->assertShipping('USPS-ZONE-3', 544, '10001', 1);
  }

  public function testZone8() {
    $this->assertShipping('USPS-ZONE-8', 997, '96962', 1);
  }

  public function testZone3() {
    $this->assertShipping('USPS-ZONE-3', 544, '44113', 1);
  }

  public function testZone1() {
    $this->assertShipping('USPS-ZONE-1', 532, '14607', 1);
  }

  public function testZone2_twoItems() {
    $this->assertShipping('USPS-ZONE-2', 616, '13000', 2);
  }

  public function testZone3_twoItems() {
    $this->assertShipping('USPS-ZONE-3', 725, '44133', 2);
  }

  public function testZone4_twoItems() {
    $this->assertShipping('USPS-ZONE-4', 810, '28203', 2);
  }

  public function testZone5_twoItems() {
    $this->assertShipping('USPS-ZONE-5', 1066, '32209', 2);
  }

  public function testZone6_twoItems() {
    $this->assertShipping('USPS-ZONE-6', 1337, '75201', 2);
  }

  public function testZone7_twoItems() {
    $this->assertShipping('USPS-ZONE-7', 1628, '77900', 2);
  }

  public function testZone8_twoItems() {
    $this->assertShipping('USPS-ZONE-8', 1628, '90001', 2);
  }

  public function testZone1_twoItems() {
    $this->assertShipping('USPS-ZONE-1', 616, '14607', 2);
  }
  
  public function test_threeItems() {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => 90210],
        'items' => array_fill(0, 3, [])
        ]);

    $this->assertEquals([], $actual);
  }
  
  public function assertShipping($service_code, $total_price, $postal_code, $items_count) {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => $postal_code],
        'items' => array_fill(0, $items_count, [])
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => $service_code,
        'total_price' => $total_price,
        'currency' => 'USD'
        ]], $actual);
  }

  public function testUnservedZip() {
    $this->assertNoShipping('US', '96939');
  }

  public function testInvalidZip() {
    $this->assertNoShipping('US', '00000');
  }

  public function testAU() {
    $this->assertNoShipping('AU', null);
  }
  
  public function assertNoShipping($country, $postal_code) {
    $actual = calculateshipping([
        'destination' => ['country' => $country, 'postal_code' => $postal_code],
        'items' => []
        ]);

    $this->assertEquals([], $actual);
  }
}
