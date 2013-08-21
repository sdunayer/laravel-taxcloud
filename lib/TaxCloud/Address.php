<?php

namespace TaxCloud;

class Address {

  private $Address1;
  private $Address2;
  private $City;
  private $State;
  private $Zip5;
  private $Zip4;

  function __construct($Address1, $Address2, $City, $State, $Zip5, $Zip4) {
    $this->setAddress1($Address1);
    $this->setAddress2($Address2);
    $this->setCity($City);
    $this->setState($State);
    $this->setZip5($Zip5);
    $this->setZip4($Zip4);
  }

  public function setAddress1($address1) {
    $this->Address1 = $address1;
  }

  public function getAddress1() {
    return $this->Address1;
  }

  public function setAddress2($address2) {
    $this->Address2 = $address2;
  }

  public function getAddress2() {
    return $this->Address2;
  }

  public function setCity($city) {
    $this->City = $city;
  }

  public function getCity() {
    return $this->City;
  }

  public function setState($state) {
    $this->State = $state;
  }

  public function getState() {
    return $this->State;
  }

  public function setZip5($zip5) {
    if (!preg_match('#[0-9]{5}#', $zip5)) {
      throw new \Exception('Zip5 must be five numeric characters.');
    }
    $this->Zip5 = $zip5;
  }

  public function getZip5() {
    return $this->Zip5;
  }

  public function setZip4($zip4) {
    if (!empty($zip4) && !preg_match('#[0-9]{4}#', $zip4)) {
      throw new \Exception('Zip4 must be four numeric characters.');
    }
    $this->Zip4 = $zip4;
  }

  public function getZip4() {
    return $this->Zip4;
  }
}
