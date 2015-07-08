<?php
require './calculateshipping.php';

class TestCase extends \PHPUnit_Framework_TestCase {
  public function testShippingOneItem() {
    $this->assertShipping(1, 532, 14607, 1);
    $this->assertShipping(2, 532, 13000, 1);
    $this->assertShipping(3, 544, 44113, 1);
    $this->assertShipping(3, 544, 10001, 1);
    $this->assertShipping(4, 584, 28203, 1);
    $this->assertShipping(5, 755, 32209, 1);
    $this->assertShipping(6, 826, 75201, 1);
    $this->assertShipping(7, 997, 77900, 1);
    $this->assertShipping(8, 997, 90210, 1);
    $this->assertShipping(8, 997, 96962, 1);
  }
  
  public function testShippingTwoItems() {
    $this->assertShipping(1, 616, 14607, 2);
    $this->assertShipping(2, 616, 13000, 2);
    $this->assertShipping(3, 725, 44133, 2);
    $this->assertShipping(4, 810, 28203, 2);
    $this->assertShipping(5, 1066, 32209, 2);
    $this->assertShipping(6, 1337, 75201, 2);
    $this->assertShipping(7, 1628, 77900, 2);
    $this->assertShipping(8, 1628, 90001, 2);
  }
  
  public function testTooManyItems() {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => 90210],
        'items' => array_fill(0, 3, [])
        ]);

    $this->assertEquals([], $actual);
  }

  public function testUnservedZip() {
    $this->assertNoShipping('US', 96939);
  }

  public function testInvalidZip() {
    $this->assertNoShipping('US', 00000);
  }

  public function testAU() {
    $this->assertNoShipping('AU', null);
  }
  
  public function assertShipping($zone_number, $total_price, $postal_code, $items_count) {
    $actual = calculateshipping([
        'destination' => ['country' => 'US', 'postal_code' => $postal_code],
        'items' => array_fill(0, $items_count, [])
        ]);

    $this->assertEquals([[
        'service_name' => 'USPS Priority Mail',
        'service_code' => 'USPS-ZONE-' . $zone_number,
        'total_price' => $total_price,
        'currency' => 'USD'
        ]], $actual);
  }
  
  public function assertNoShipping($country, $postal_code) {
    $actual = calculateshipping([
        'destination' => ['country' => $country, 'postal_code' => $postal_code],
        'items' => []
        ]);

    $this->assertEquals([], $actual);
  }
}
