<?php

namespace TaxCloud;

class AuthorizedWithCapture {
  private $apiLoginID; // string
  private $apiKey; // string
  private $customerID; // string
  private $cartID; // string
  private $orderID; // string
  private $dateAuthorized; // dateTime
  private $dateCaptured; // dateTime

  public function __construct($apiLoginID, $apiKey, $customerID, $cartID, $orderID, $dateAuthorized, $dateCaptured) {
    $this->apiLoginID = $apiLoginID;
    $this->apiKey = $apiKey;
    $this->customerID = $customerID;
    $this->cartID = $cartID;
    $this->orderID = $orderID;
    $this->dateAuthorized = $dateAuthorized;
    $this->dateCaptured = $dateCaptured;
  }
}
