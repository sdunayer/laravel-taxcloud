<?php

namespace TaxCloud;

/**
 * @file
 * Contains class to build VerifyAddress object.
 */

class VerifyAddress {
  private $uspsUserID; // USPS User ID
  private $address1;
  private $address2;
  private $city;
  private $state;
  private $zip5;
  private $zip4;

  public function __construct($uspsUserID, Address $address) {
    $this->uspsUserID = $uspsUserID;
    $this->address1 = $address->getAddress1();
    $this->address2 = $address->getAddress2();
    $this->city = $address->getCity();
    $this->state = $address->getState();
    $this->zip5 = $address->getZip5();
    $this->zip4 = $address->getZip4();
  }

  public function setUspsUserID($uspsUserID) {
    $this->uspsUserID = $uspsUserID;
  }

  public function getUspsUserID() {
    return $this->uspsUserID;
  }
}
