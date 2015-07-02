<?php

require './calculateshipping.php';

class TestCase extends \PHPUnit_Framework_TestCase
{
  public function testTest()
  {
    $data = array(
        'destination' => array(
          'country' => 'AU',
          'postal_code' => '2000',
          ),
        'items' => array(
            '0' => array(
              ),
            '1' => array(
              ),
            ),
            'currency' => 'AUD',
            );

    $this->assertEquals(
        array(
          array(
            'service_name' => 'USPS Priority Mail',
            'service_code' => 'USPS_PRIORITY_MAIL',
            'total_price' => 10000,
            'currency' => 'USD'
            )
          ), calculateshipping($data));
  }
}
