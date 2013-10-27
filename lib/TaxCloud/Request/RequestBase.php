<?php

namespace TaxCloud\Request;

class RequestBase
{
  protected $apiLoginID;
  protected $apiKey;

  public function __construct($apiLoginID, $apiKey)
  {
    $this->apiLoginID = $apiLoginID;
    $this->apiKey = $apiKey;
  }
}
