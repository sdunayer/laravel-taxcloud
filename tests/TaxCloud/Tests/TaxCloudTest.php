<?php

/**
 * @file
 * Unit Tests
 */

namespace TaxCloud\Tests;

class TaxCloudTest extends \PHPUnit_Framework_TestCase {

  protected $taxcloud;

  // Use a local copy of the WSDL.
  const WSDL = "TaxCloud.wsdl";

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->taxcloud = $this->getMockBuilder('\TaxCloud\TaxCloud')
                           ->disableOriginalConstructor()
                           ->getMock();
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

    $address = new \TaxCloud\Address(
      '1600 Pennsylvania Ave NW',
      '',
      'Washington',
      'DC',
      '20500',
      '0003'
    );

    $verifyAddress = new \TaxCloud\VerifyAddress($uspsUserID, $address);
    $this->assertEquals($uspsUserID, $verifyAddress->getUspsUserID());

    $result = new \stdClass();
    $result->Address1 = $address->getAddress1();
    $result->City = $address->getCity();
    $result->State = $address->getState();
    $result->Zip5 = $address->getZip5();
    $result->Zip4 = $address->getZip4();
    $result->ErrNumber = 0;

    $expected = new \TaxCloud\VerifiedAddress;
    $expected->VerifyAddressResult = $result;

    $nousps = clone $verifyAddress;
    $nousps->setUspsUserID('');
    $this->assertEmpty($nousps->getUspsUserID());

    $nouspsResult = new \stdClass();
    $nouspsResult->ErrNumber = '80040b1a';

    $nouspsExpected = new \TaxCloud\VerifiedAddress;
    $nouspsExpected->VerifyAddressResult = $nouspsResult;

    $map = array(
      array($verifyAddress, $expected),
      array($nousps, $nouspsExpected)
    );

    $client->expects($this->any())
           ->method('VerifyAddress')
           ->will($this->returnValueMap($map));
    $this->assertEquals($expected, $client->VerifyAddress($verifyAddress));
    $this->assertEquals($nouspsExpected, $client->VerifyAddress($nousps));
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
    $cartItem = new \TaxCloud\CartItem($cartID, 'ABC123', '00000', 12.00, 1);
    $cartItems[] = $cartItem;
    $cartItemShipping = new \TaxCloud\CartItem($cartID, 'SHIPPING123', 11010, 8.95, 1);
    $cartItems[] = $cartItemShipping;

    $address = new \TaxCloud\Address(
      '1600 Pennsylvania Ave NW',
      '',
      'Washington',
      'DC',
      '20050',
      '1234'
    );

    $verifyAddress = new \TaxCloud\VerifyAddress($uspsUserID, $address);

    $verifiedAddress = $client->VerifyAddress($verifyAddress);

    $originAddress = clone $address;

    $destAddress = new \TaxCloud\Address(
      'PO Box 573',
      '',
      'Clinton',
      'OK',
      '73601',
      ''
    );

    $lookup = new \TaxCloud\Lookup($apiLoginID, $apiKey, $customerID, $cartID, $cartItems, $originAddress, $destAddress);
    $this->assertEquals($apiLoginID, $lookup->getApiLoginID(), 'apiLoginID should be ' . $apiLoginID);
    $this->assertEquals($apiKey, $lookup->getApiKey(), 'apiKey should be ' . $apiKey);
    $this->assertEquals($customerID, $lookup->getCustomerID(), 'customerID should be ' . $customerID);
    $this->assertEquals($cartID, $lookup->getCartID(), 'cartID should be ' . $cartID);
    $this->assertEquals($originAddress, $lookup->getOrigin());
    $this->assertInstanceOf('TaxCloud\Address', $lookup->getOrigin());
    $this->assertEquals($destAddress, $lookup->getDestination());
    $this->assertInstanceOf('TaxCloud\Address', $lookup->getDestination());
    $this->assertFalse($lookup->getDeliveredBySeller(), 'deliveredBySeller should be FALSE');
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

    $ping = new \TaxCloud\Ping($apiLoginID, $apiKey);
    $this->assertEquals($apiLoginID, $ping->getApiLoginID());
    $this->assertEquals($apiKey, $ping->getApiKey());

    $pingBad = new \TaxCloud\Ping('xxx', 'xxx');

    $pingResult = new \TaxCloud\PingRsp();
    $pingResult->ResponseType = 'OK';
    $pingResult->Messages = '';

    $pingResponse = new \TaxCloud\PingResponse();
    $pingResponse->PingResult = $pingResult;

    $pingResultBad = new \TaxCloud\PingRsp();
    $pingResultBad->ResponseType = 'OK';
    $pingResultBad->Messages = new \stdClass();

    $pingResultBadMessage = new \TaxCloud\ResponseMessage();
    $pingResultBadMessage->ResponseType = 'Error';
    $pingResultBadMessage->Message = 'Invalid apiLoginID and/or apiKey';

    $pingResultBad->ResponseMessage = $pingResultBadMessage;

    $pingResponseBad = new \TaxCloud\PingResponse();
    $pingResponseBad->PingResult = $pingResult;

    $map = array(
      array($ping, $pingResponse),
      array($pingBad, $pingResponseBad)
    );

    $client = $this->taxcloud;
    $client->expects($this->any())
           ->method('Ping')
           ->will($this->returnValueMap($map));

    $this->assertEquals($pingResponse, $client->Ping($ping));
    $this->assertEquals($pingResponseBad, $client->Ping($pingBad));
  }
}
