<?php

namespace TaxCloud\Tests\Request;

use TaxCloud\Address;
use TaxCloud\Request\VerifyAddress;

class VerifyAddressTest extends \PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->_address = new Address(
      '1600 Pennsylvania Ave NW',
      '',
      'Washington',
      'DC',
      '20006',
      '0004'
    );

    $this->_verified = new VerifyAddress('123456789', $this->_address);
  }

  public function testGetUspsUserID()
  {
    $this->assertEquals('123456789', $this->_verified->getUspsUserID());
  }

  public function testGetAddress1()
  {
    $this->assertEquals('1600 Pennsylvania Ave NW', $this->_verified->getAddress1());
  }

  public function testGetAddress2()
  {
    $this->assertEquals('', $this->_verified->getAddress2());
  }

  public function testGetCity()
  {
    $this->assertEquals('Washington', $this->_verified->getCity());
  }

  public function testGetState()
  {
    $this->assertEquals('DC', $this->_verified->getState());
  }

  public function testGetZip5()
  {
    $this->assertEquals('20006', $this->_verified->getZip5());
  }

  public function testGetZip4()
  {
    $this->assertEquals('0004', $this->_verified->getZip4());
  }
}
