<?php

namespace TaxCloud;

class Captured {
  private $apiLoginID; // string
  private $apiKey; // string
  private $orderID; // string

  public function __construct($apiLoginID, $apiKey, $orderID) {
    $this->apiLoginID = $apiLoginID;
    $this->apiKey = $apiKey;
    $this->orderID = $orderID;
  }
}

