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

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    // NOT YET IMPLEMENTED
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
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
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
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
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
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }
}
