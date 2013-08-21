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
    $this->apiLoginID = $apiLoginID;
    $this->apiKey = $apiKey;
    $this->customerID = $customerID;
    $this->cartID = $cartID;
    $this->cartItems = $cartItems;
    $this->origin = $origin;
    $this->destination = $destination;
    $this->deliveredBySeller = FALSE;
  }
}

