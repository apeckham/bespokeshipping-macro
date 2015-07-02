<?php

require './calculateshipping.php';

class TestCase extends \PHPUnit_Framework_TestCase
{
  public function testTest()
  {
    $data = array(
        'origin' => array(
          'country' => 'AU',
          'postal_code' => '3000',
          'province' => 'VIC',
          'city' => 'melbourne',
          'name' => '',
          'address1' => '1 main street',
          'address2' => '',
          'address3' => '',
          'phone' => '',
          'fax' => '',
          'address_type' => '',
          'company_name' => '',
          ),
        'destination' => array(
          'country' => 'AU',
          'postal_code' => '2000',
          'province' => 'NSW',
          'city' => '',
          'name' => '',
          'address1' => '',
          'address2' => '',
          'address3' => '',
          'phone' => '',
          'fax' => '',
          'address_type' => '',
          'company_name' => '',
          ),
        'items' => array(
            '0' => array(
              'name' => 'product10',
              'sku' => 'SKUP00310',
              'quantity' => '1',
              'grams' => '1000',
              'price' => '300',
              'vendor' => 'PRODUCT',
              'requires_shipping' => '1',
              'taxable' => '1',
              'fulfillment_service' => 'manual',
              'product_id' => '128436738',
              'variant_id' => '290813760',
              ),
            '1' => array(
              'name' => 'product11',
              'sku' => 'SKUP0011',
              'quantity' => '1',
              'grams' => '1100',
              'price' => '300',
              'vendor' => 'PRODUCT',
              'requires_shipping' => '1',
              'taxable' => '1',
              'fulfillment_service' => 'manual',
              'product_id' => '128436744',
              'variant_id' => '290813772',
              ),
            ),
            'currency' => 'AUD',
            );

    $this->assertEquals(
        array(
          array(
            'service_name' => 'International Shipping',
            'service_code' => 'AUSPOST_INT',
            'total_price' => 10000,
            'currency' => 'AUD'
            )
          ), calculateshipping($data));
  }
}