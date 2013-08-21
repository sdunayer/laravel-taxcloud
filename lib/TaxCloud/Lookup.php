<?php

namespace TaxCloud;

class Lookup {
  private $apiLoginID; // string
  private $apiKey; // string
  private $customerID; // string
  private $cartID; // string
  private $cartItems; // ArrayOfCartItem
  private $origin; // Address
  private $destination; // Address
  private $deliveredBySeller; // boolean
  private $exemptCert; // ExemptionCertificate

  public function __construct($apiLoginID, $apiKey, $customerID, $cartID, $cartItems, Address $origin, Address $destination, $deliveredBySeller = FALSE) {
    $this->setApiLoginID($apiLoginID);
    $this->setApiKey($apiKey);
    $this->setCustomerID($customerID);
    $this->setCartID($cartID);
    $this->setCartItems($cartItems);
    $this->setOrigin($origin);
    $this->setDestination($destination);
    $this->setDeliveredBySeller($deliveredBySeller);
  }

  private function setApiLoginID($apiLoginID) {
    $this->apiLoginID = $apiLoginID;
  }

  public function getApiLoginID() {
    return $this->apiLoginID;
  }

  private function setApiKey($apiKey) {
    $this->apiKey = $apiKey;
  }

  public function getApiKey() {
    return $this->apiKey;
  }

  private function setCustomerID($customerID) {
    $this->customerID = $customerID;
  }

  public function getCustomerID() {
    return $this->customerID;
  }

  private function setCartID($cartID) {
    $this->cartID = $cartID;
  }

  public function getCartID() {
    return $this->cartID;
  }

  private function setCartItems($cartItems) {
    $this->cartItems = $cartItems;
  }

  public function getCartItems() {
    return $this->cartItems;
  }

  private function setOrigin($origin) {
    $this->origin = $origin;
  }

  public function getOrigin() {
    return $this->origin;
  }

  private function setDestination($destination) {
    $this->destination = $destination;
  }

  public function getDestination() {
    return $this->destination;
  }

  private function setDeliveredBySeller($deliveredBySeller) {
    $this->deliveredBySeller = (bool) $deliveredBySeller;
  }

  public function getDeliveredBySeller() {
    return $this->deliveredBySeller;
  }
}

