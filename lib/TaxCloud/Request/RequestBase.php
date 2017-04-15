<?php

namespace TaxCloud\Request;

use TaxCloud\Exceptions\RequestException;

class RequestBase implements \JsonSerializable
{
  protected $apiLoginID;
  protected $apiKey;

  /**
   * Constructor.
   *
   * @since 0.2.0
   *
   * @param string $apiLoginID TaxCloud API Login ID.
   * @param string $apiKey TaxCloud API key.
   */
  public function __construct($apiLoginID, $apiKey)
  {
    if (empty($apiLoginID)) {
      throw new RequestException('API Login ID not set.');
    } elseif (is_string($apiLoginID) === FALSE) {
      throw new RequestException('API Login ID must be a string.');
    }

    if (empty($apiKey)) {
      throw new RequestException('API Key not set.');
    } elseif (is_string($apiKey) === FALSE) {
      throw new RequestException('API Key must be a string.');
    }

    $this->apiLoginID = $apiLoginID;
    $this->apiKey = $apiKey;
  }

  /**
   * Return JSON-serializable representation of request.
   *
   * @since 0.2.0
   *
   * @return array
   */
  public function jsonSerialize()
  {
    $request = array();
    $props   = get_object_vars($this);

    if ($props !== NULL) {
      foreach ($props as $key => $value) {
        $request[$key] = $value;
      }
    }

    return $props;
  }
}
