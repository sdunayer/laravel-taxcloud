<?php

/**
 * @file
 * Unit Tests
 */

namespace TaxCloud\Tests;

use \ReflectionClass;
use TaxCloud\Address;
use TaxCloud\CartItem;
use TaxCloud\CartItemResponse;
use TaxCloud\Client;
use TaxCloud\PingResponse;
use TaxCloud\PingRsp;
use TaxCloud\ResponseMessage;
use TaxCloud\Request\Lookup;
use TaxCloud\LookupResponse;
use TaxCloud\LookupRsp;
use TaxCloud\Request\Ping;
use TaxCloud\Request\VerifyAddress;
use TaxCloud\VerifiedAddress;
use TaxCloud\VerifyAddressResponse;

class ClientTest extends \PHPUnit_Framework_TestCase {

  protected $taxcloud;

  // Use a local copy of the WSDL.
  const WSDL = "TaxCloud.wsdl";

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->soapmock = $this->getMockFromWSDL(self::WSDL);
    $this->taxcloud = new Client();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * Test ::VerifyAddress
   * @todo Test exception handling
   */
  public function testVerifyAddress()
  {
    $client = $this->taxcloud;

    $uspsUserID = '123ABCDE5678';

    $address = new Address(
      '1600 Pennsylvania Ave NW',
      '',
      'Washington',
      'DC',
      '20500',
      '0003'
    );

    $verifyAddress = new VerifyAddress($uspsUserID, $address);
    $this->assertEquals($uspsUserID, $verifyAddress->getUspsUserID());

    $resultobj = new VerifiedAddress();
    $result = new ReflectionClass('\TaxCloud\VerifiedAddress');
    $property = $result->getProperty('Address1');
    $property->setAccessible(true);
    $property->setValue($resultobj, $address->getAddress1());
    $property = $result->getProperty('City');
    $property->setAccessible(true);
    $property->setValue($resultobj, $address->getCity());
    $property = $result->getProperty('State');
    $property->setAccessible(true);
    $property->setValue($resultobj, $address->getState());
    $property = $result->getProperty('Zip5');
    $property->setAccessible(true);
    $property->setValue($resultobj, $address->getZip5());
    $property = $result->getProperty('Zip4');
    $property->setAccessible(true);
    $property->setValue($resultobj, $address->getZip4());
    $property = $result->getProperty('ErrNumber');
    $property->setAccessible(true);
    $property->setValue($resultobj, '0');

    $expected = new ReflectionClass('\TaxCloud\VerifyAddressResponse');
    $expectedobj = new VerifyAddressResponse();
    $property = $expected->getProperty('VerifyAddressResult');
    $property->setAccessible(true);
    $property->setValue($expectedobj, $resultobj);

    $this->soapmock->expects($this->any())
           ->method('__soapCall')
           ->with('VerifyAddress')
           ->will($this->returnValue($expectedobj));
    $client->setSoapClient($this->soapmock);
    $this->assertEquals($address, $client->VerifyAddress($verifyAddress));
  }

  /**
   * @todo   Implement testLookupForDate().
   */
  public function testLookupForDate()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  public function testLookup()
  {
    $client = $this->taxcloud;
    $cartID = 456;
    $customerID = 123;
    $uspsUserID = '123ABCDE5678';
    $apiLoginID = 'apiLoginID';
    $apiKey = 'apiKey';

    $cartItems = array();
    $cartItem = new CartItem($cartID + 1, 'ABC123', '00000', 12.00, 1);
    $cartItems[] = $cartItem;
    $cartItemShipping = new CartItem($cartID + 2, 'SHIPPING123', 11010, 8.95, 1);
    $cartItems[] = $cartItemShipping;

    $address = new Address(
      '1600 Pennsylvania Ave NW',
      '',
      'Washington',
      'DC',
      '20050',
      '1234'
    );

    $verifyAddress = new VerifyAddress($uspsUserID, $address);

    $verifiedAddress = $client->VerifyAddress($verifyAddress);

    $originAddress = clone $address;

    $destAddress = new Address(
      'PO Box 573',
      '',
      'Clinton',
      'OK',
      '73601',
      ''
    );

    $lookup = new Lookup($apiLoginID, $apiKey, $customerID, $cartID, $cartItems, $originAddress, $destAddress);
    $this->assertEquals($customerID, $lookup->getCustomerID(), 'customerID should be ' . $customerID);
    $this->assertEquals($cartID, $lookup->getCartID(), 'cartID should be ' . $cartID);
    $this->assertEquals($originAddress, $lookup->getOrigin());
    $this->assertInstanceOf('TaxCloud\Address', $lookup->getOrigin());
    $this->assertEquals($destAddress, $lookup->getDestination());
    $this->assertInstanceOf('TaxCloud\Address', $lookup->getDestination());
    $this->assertFalse($lookup->getDeliveredBySeller(), 'deliveredBySeller should be FALSE');

    $lookupResult = new ReflectionClass('\TaxCloud\LookupRsp');
    $lookupResultobj = new LookupRsp();
    $property = $lookupResult->getProperty('CartID');
    $property->setAccessible(true);
    $property->setValue($lookupResultobj, $cartID);

    $cartItemResponseItems = array();
    $cartItemResponse1obj = new CartItemResponse();
    $cartItemResponse1 = new ReflectionClass('\TaxCloud\CartItemResponse');
    $property = $cartItemResponse1->getProperty('CartItemIndex');
    $property->setAccessible(true);
    $property->setValue($cartItemResponse1obj, $cartID + 1);
    $property = $cartItemResponse1->getProperty('TaxAmount');
    $property->setAccessible(true);
    $property->setValue($cartItemResponse1obj, '0.54');
    $cartItemResponseItems[] = $cartItemResponse1obj;
    $cartItemResponse2obj = new CartItemResponse();
    $cartItemResponse2 = new ReflectionClass('\TaxCloud\CartItemResponse');
    $property = $cartItemResponse2->getProperty('CartItemIndex');
    $property->setAccessible(true);
    $property->setValue($cartItemResponse2obj, $cartID + 2);
    $property = $cartItemResponse2->getProperty('TaxAmount');
    $property->setAccessible(true);
    $property->setValue($cartItemResponse2obj, '0');
    $cartItemResponseItems[] = $cartItemResponse2obj;

    $property = $lookupResult->getProperty('CartItemsResponse');
    $property->setAccessible(true);
    $property->setValue($lookupResultobj, $cartItemResponseItems);
    $property = $lookupResult->getProperty('ResponseType');
    $property->setAccessible(true);
    $property->setValue($lookupResultobj, 'OK');

    $lookupResponse = new ReflectionClass('\TaxCloud\LookupResponse');
    $lookupResponseobj = new LookupResponse();
    $property = $lookupResponse->getProperty('LookupResult');
    $property->setAccessible(true);
    $property->setValue($lookupResponseobj, $lookupResultobj);

    $expected = array(
      '456' => array(
        '457' => '0.54',
        '458' => '0',
      ),
    );

    $this->soapmock->expects($this->any())
           ->method('__soapCall')
           ->with('Lookup')
           ->will($this->returnValue($lookupResponseobj));
    $client->setSoapClient($this->soapmock);
    $this->assertEquals($expected, $client->Lookup($lookup));
  }

  /**
   * @todo   Implement testAuthorized().
   */
  public function testAuthorized()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testAuthorizedWithCapture().
   */
  public function testAuthorizedWithCapture()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testCaptured().
   */
  public function testCaptured()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testReturned().
   */
  public function testReturned()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testGetTICGroups().
   */
  public function testGetTICGroups()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testGetTICs().
   */
  public function testGetTICs()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testGetTICsByGroup().
   */
  public function testGetTICsByGroup()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testAddExemptCertificate().
   */
  public function testAddExemptCertificate()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testDeleteExemptCertificate().
   */
  public function testDeleteExemptCertificate()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testGetExemptCertificates().
   */
  public function testGetExemptCertificates()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  public function testPing()
  {
    $apiLoginID = 'apiLoginID';
    $apiKey = 'apiKey';

    $ping = new Ping($apiLoginID, $apiKey);

    $pingResult = new ReflectionClass('\TaxCloud\PingRsp');
    $pingResultobj = new PingRsp();
    $property = $pingResult->getProperty('ResponseType');
    $property->setAccessible(true);
    $property->setValue($pingResultobj, 'OK');
    $property = $pingResult->getProperty('Messages');
    $property->setAccessible(true);
    $property->setValue($pingResultobj, array());

    $pingResponse = new ReflectionClass('\TaxCloud\PingResponse');
    $pingResponseobj = new PingResponse();
    $property = $pingResponse->getProperty('PingResult');
    $property->setAccessible(true);
    $property->setValue($pingResponseobj, $pingResultobj);

    $client = $this->taxcloud;
    $this->soapmock->expects($this->any())
           ->method('__soapCall')
           ->with('Ping')
           ->will($this->returnValue($pingResponseobj));
    $client->setSoapClient($this->soapmock);
    $this->assertTrue($client->Ping($ping));
  }
}
