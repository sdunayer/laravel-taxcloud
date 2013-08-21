<?php

namespace TaxCloud;

class Client {

  /**
   * Construct client with required parameters.
   *
   * @param string $wsdl
   *   Path to WSDL
   * @param string $appId
   *   TaxCloud App ID
   * @param string $apiKey
   *   TaxCloud API key
   */
  public function __construct($wsdl, $appId, $apiKey) {
    $this->wsdl = $wsdl;
    $this->appId = $appId;
    $this->apiKey = $apiKey;
  }
}
