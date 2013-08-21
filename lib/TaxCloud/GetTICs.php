<?php

namespace TaxCloud;

class GetTICs {
  private $apiLoginID; // string
  private $apiKey; // string

  public function __construct($apiLoginID, $apiKey) {
    $this->apiLoginID = $apiLoginID;
    $this->apiKey = $apiKey;
  }
}
