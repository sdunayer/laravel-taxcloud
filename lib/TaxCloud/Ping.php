<?php

namespace TaxCloud;

class Ping {
  private $apiLoginID; // string
  private $apiKey; // string

  public function __construct($apiLoginID, $apiKey) {
    $this->setApiLoginID($apiLoginID);
    $this->setApiKey($apiKey);
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
}
