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
    $this->setUspsUserID($uspsUserID);
    $this->setAddress1($address->getAddress1());
    $this->setAddress2($address->getAddress2());
    $this->setCity($address->getCity());
    $this->setState($address->getState());
    $this->setZip5($address->getZip5());
    $this->setZip4($address->getZip4());
  }

  public function setUspsUserID($uspsUserID) {
    $this->uspsUserID = $uspsUserID;
  }

  public function getUspsUserID() {
    return $this->uspsUserID;
  }

  private function setAddress1($address1) {
    $this->address1 = $address1;
  }

  public function getAddress1() {
    return $this->address1;
  }

  private function setAddress2($address2) {
    $this->address2 = $address2;
  }

  public function getAddress2() {
    return $this->address2;
  }

  private function setCity($city) {
    $this->city = $city;
  }

  public function getCity() {
    return $this->city;
  }

  private function setState($state) {
    $this->state = $state;
  }

  public function getState() {
    return $this->state;
  }

  private function setZip5($zip5) {
    $this->zip5 = $zip5;
  }

  public function getZip5() {
    return $this->zip5;
  }

  private function setZip4($zip4) {
    $this->zip4 = $zip4;
  }

  public function getZip4() {
    return $this->zip4;
  }
}
