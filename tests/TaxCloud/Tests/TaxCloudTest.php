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
    $this->taxcloud = $this->getMockBuilder('TaxCloud')
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
   * @covers TaxCloud::VerifyAddress
   * @todo   Implement testVerifyAddress().
   */
  public function testVerifyAddress()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @covers TaxCloud::LookupForDate
   * @todo   Implement testLookupForDate().
   */
  public function testLookupForDate()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @covers TaxCloud::Lookup
   * @todo   Implement testLookup().
   */
  public function testLookup()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @covers TaxCloud::Authorized
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
   * @covers TaxCloud::AuthorizedWithCapture
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
   * @covers TaxCloud::Captured
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
   * @covers TaxCloud::Returned
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
   * @covers TaxCloud::GetTICGroups
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
   * @covers TaxCloud::GetTICs
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
   * @covers TaxCloud::GetTICsByGroup
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
   * @covers TaxCloud::AddExemptCertificate
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
   * @covers TaxCloud::DeleteExemptCertificate
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
   * @covers TaxCloud::GetExemptCertificates
   * @todo   Implement testGetExemptCertificates().
   */
  public function testGetExemptCertificates()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @covers TaxCloud::Ping
   * @todo   Implement testPing().
   */
  public function testPing()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }


}
