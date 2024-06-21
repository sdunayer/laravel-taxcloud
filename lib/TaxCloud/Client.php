<?php

/**
 * Portions Copyright (c) 2009-2012 The Federal Tax Authority, LLC (FedTax).
 * All Rights Reserved.
 *
 * This file contains Original Code and/or Modifications of Original Code as
 * defined in and that are subject to the FedTax Public Source License (the
 * ‘License’). You may not use this file except in compliance with the License.
 * Please obtain a copy of the License at http://FedTax.net/ftpsl.pdf or
 * http://dev.taxcloud.net/ftpsl/ and read it before using this file.
 *
 * The Original Code and all software distributed under the License are
 * distributed on an ‘AS IS’ basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND FEDTAX  HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY, FITNESS FOR
 * A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 *
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 *
 *
 *
 * Modifications made August 20, 2013 by Brian Altenhofel
 * Modifications made May 12, 2023 by Brett Porcelli
 */

namespace TaxCloud;

use TaxCloud\Exceptions\AddExemptCertificateException;
use TaxCloud\Exceptions\AddTransactionsException;
use TaxCloud\Exceptions\AuthorizedException;
use TaxCloud\Exceptions\AuthorizedWithCaptureException;
use TaxCloud\Exceptions\CapturedException;
use TaxCloud\Exceptions\DeleteExemptCertificateException;
use TaxCloud\Exceptions\GetExemptCertificatesException;
use TaxCloud\Exceptions\GetTICsException;
use TaxCloud\Exceptions\LookupException;
use TaxCloud\Exceptions\PingException;
use TaxCloud\Exceptions\ReturnedException;
use TaxCloud\Exceptions\USPSIDException;
use TaxCloud\Exceptions\VerifyAddressException;
use TaxCloud\Exceptions\RequestException;
use TaxCloud\Exceptions\GetLocationsException;
use TaxCloud\Request\AddExemptCertificate;
use TaxCloud\Request\AddTransactions;
use TaxCloud\Request\Authorized;
use TaxCloud\Request\AuthorizedWithCapture;
use TaxCloud\Request\Captured;
use TaxCloud\Request\DeleteExemptCertificate;
use TaxCloud\Request\GetExemptCertificates;
use TaxCloud\Request\GetLocations;
use TaxCloud\Request\GetTICs;
use TaxCloud\Request\Lookup;
use TaxCloud\Request\LookupForDate;
use TaxCloud\Request\Ping;
use TaxCloud\Request\Returned;
use TaxCloud\Request\VerifyAddress;
use TaxCloud\Response\AddExemptCertificateResponse;
use TaxCloud\Response\AddTransactionsResponse;
use TaxCloud\Response\AuthorizedResponse;
use TaxCloud\Response\AuthorizedWithCaptureResponse;
use TaxCloud\Response\CapturedResponse;
use TaxCloud\Response\DeleteExemptCertificateResponse;
use TaxCloud\Response\GetExemptCertificatesResponse;
use TaxCloud\Response\GetLocationsResponse;
use TaxCloud\Response\GetTICsResponse;
use TaxCloud\Response\LookupResponse;
use TaxCloud\Response\PingResponse;
use TaxCloud\Response\ReturnedResponse;
use TaxCloud\Response\VerifyAddressResponse;
use \JsonSerializable;

/**
 * TaxCloud Web Service
 *
 * @author    Brian Altenhofel, Brett Porcelli
 * @package   php-taxcloud
 */
class Client
{
  /**
   * @var array Default request headers.
   * @since 0.2.0
   */
  protected static $headers = array(
    'Accept: application/json',
    'Content-Type: application/json',
  );

  /**
   * @var string API base URI.
   * @since 1.0.0
   */
  protected $base_uri;

  /**
   * Constructor.
   *
   * @since 0.2.0
   *
   * @param $base_uri URI of TaxCloud webservice. (default: 'https://api.taxcloud.net/1.0/TaxCloud/')
   */
  public function __construct($base_uri = "https://api.taxcloud.net/1.0/TaxCloud/")
  {
    $this->base_uri = $base_uri;
  }

  /**
   * Verify that your implementation can communicate with TaxCloud.
   *
   * @since 0.1.1
   *
   * @param  Ping $parameters
   * @return PingResponse
   */
  public function Ping(Ping $parameters)
  {
    try {
      $response = new PingResponse($this->post('Ping', $parameters));
      $result   = $response->getPingResult();

      if ($result->getResponseType() == 'OK') {
        return TRUE;
      } else {
        foreach ($result->getMessages() as $message) {
          throw new PingException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new PingException($ex->getMessage());
    }
  }

  /**
   * Inspect and verify a customer provided address to ensure the most accurate
   * tax jurisdiction(s) can be identified.
   *
   * @param  VerifyAddress $parameters
   * @return VerifiedAddress
   */
  public function VerifyAddress(VerifyAddress $parameters)
  {
    try {
      $response = new VerifyAddressResponse($this->post('VerifyAddress', $parameters));
      $result   = $response->getVerifyAddressResult();

      if ($result->getErrNumber() == 0) {
        return $result->getAddress();
      } elseif ($result->getErrNumber() == '80040B1A') {
        throw new USPSIDException('Error ' . $result->getErrNumber() . ': ' . $result->getErrDescription());
      } else {
        throw new VerifyAddressException('Error ' . $result->getErrNumber() . ': ' . $result->getErrDescription());
      }
    } catch (RequestException $ex) {
      throw new VerifyAddressException($ex->getMessage());
    }
  }

  /**
   * Lookup the applicable tax amounts for items in a cart.
   *
   * @param  Lookup $parameters
   * @return array
   *   An array of cart items.
   *   The top level key of the array is the cart ID so that applications can
   *   verify that this is indeed the cart they are looking for.
   *
   *   Inside that is an array of tax amounts indexed by the cart item index
   *   (which is the line item ID in some applications).
   */
  public function Lookup(Lookup $parameters)
  {
    try {
      $response = new LookupResponse($this->post('Lookup', $parameters));

      if ($response->getResponseType() == 'OK') {
        $cart_id = $response->getCartID();
        $return = array();
        foreach ($response->getCartItemsResponse() as $CartItemResponse) {
          $return[$cart_id][$CartItemResponse->getCartItemIndex()] = $CartItemResponse->getTaxAmount();
        }
        return $return;
      } else {
        foreach ($response->getMessages() as $message) {
          throw new LookupException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new LookupException($ex->getMessage());
    }
  }

  /**
   * Lookup tax amounts using a different date than the inferred today's date
   * for lookup.
   *
   * @param  LookupForDate $parameters
   * @return array
   *   An array of cart items.
   *   The top level key of the array is the cart ID so that applications can
   *   verify that this is indeed the cart they are looking for.
   *
   *   Inside that is an array of tax amounts indexed by the cart item index
   *   (which is the line item ID in some applications).
   */
  public function LookupForDate(LookupForDate $parameters)
  {
    return $this->Lookup($parameters);
  }

  /**
   * Mark an order as authorized (pending payment).
   *
   * @param  Authorized $parameters
   * @return bool
   */
  public function Authorized(Authorized $parameters)
  {
    try {
      $response = new AuthorizedResponse($this->post('Authorized', $parameters));

      if ($response->getResponseType() == 'OK') {
        return TRUE;
      } else {
        foreach ($response->getMessages() as $message) {
          throw new AuthorizedException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new AuthorizedException($ex->getMessage());
    }
  }

  /**
   * Mark a previous Lookup as both Authorized and Captured in a single step - do
   * this AFTER capturing payment with payment processor.
   *
   * @param  AuthorizedWithCapture $parameters
   * @return bool
   */
  public function AuthorizedWithCapture(AuthorizedWithCapture $parameters)
  {
    try {
      $response = new AuthorizedWithCaptureResponse($this->post('AuthorizedWithCapture', $parameters));

      if ($response->getResponseType() == 'OK') {
        return TRUE;
      } else {
        foreach ($response->getMessages() as $message) {
          throw new AuthorizedWithCaptureException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new AuthorizedWithCaptureException($ex->getMessage());
    }
  }

  /**
   * Mark a previous Lookup as Captured - do this AFTER calling Authorized API
   * and after capturing payment with payment processor.
   *
   * @param  Captured $parameters
   * @return bool
   */
  public function Captured(Captured $parameters)
  {
    try {
      $response = new CapturedResponse($this->post('Captured', $parameters));

      if ($response->getResponseType() == 'OK') {
        return TRUE;
      } else {
        foreach ($response->getMessages() as $message) {
          throw new CapturedException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new CapturedException($ex->getMessage());
    }
  }

  /**
   * Return a previously Captured transaction. Supports entire order returns as
   * well as individual item returns and even partial item-level returns.
   *
   * @param  Returned $parameters
   * @return true
   */
  public function Returned(Returned $parameters)
  {
    try {
      $response = new ReturnedResponse($this->post('Returned', $parameters));

      if ($response->getResponseType() == 'OK') {
        return TRUE;
      } else {
        foreach ($response->getMessages() as $message) {
          throw new ReturnedException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new ReturnedException($ex->getMessage());
    }
  }

  /**
   * Save an Entity Exemption Certificate for a given customerID.
   *
   * @param  AddExemptCertificate $parameters
   * @return string CertificateID.
   */
  public function AddExemptCertificate(AddExemptCertificate $parameters)
  {
    try {
      $response = new AddExemptCertificateResponse($this->post('AddExemptCertificate', $parameters));

      if ($response->getResponseType() == 'OK') {
        return $response->getCertificateID();
      } else {
        foreach ($response->getMessages() as $message) {
          throw new AddExemptCertificateException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new AddExemptCertificateException($ex->getMessage());
    }
  }

  /**
   * Remove a previously saved/created Entity Exemption Certificate for a given
   * customerID.
   *
   * @param  DeleteExemptCertificate $parameters
   * @return bool
   */
  public function DeleteExemptCertificate(DeleteExemptCertificate $parameters)
  {
    try {
      $response = new DeleteExemptCertificateResponse($this->post('DeleteExemptCertificate', $parameters));

      if ($response->getResponseType() == 'OK') {
        return TRUE;
      } else {
        foreach ($response->getMessages() as $message) {
          throw new DeleteExemptCertificateException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new DeleteExemptCertificateException($ex->getMessage());
    }
  }

  /**
   * Get previously saved Entity Exemption Certificates for a given customerID.
   *
   * @param  GetExemptCertificates $parameters
   * @return ExemptCertificate[]
   */
  public function GetExemptCertificates(GetExemptCertificates $parameters)
  {
    try {
      $response = new GetExemptCertificatesResponse($this->post('GetExemptCertificates', $parameters));

      if ($response->getResponseType() == 'OK') {
        return $response->getExemptCertificates();
      } else {
        foreach ($response->getMessages() as $message) {
          throw new GetExemptCertificatesException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new GetExemptCertificatesException($ex->getMessage());
    }
  }

  /**
   * Get an array of all known Taxability Information Codes (TICs).
   *
   * @param  GetTICs $parameters
   * @return array Array of TIC descriptions, indexed by TIC id.
   */
  public function GetTICs(GetTICs $parameters)
  {
    try {
      $response = new GetTICsResponse($this->post('GetTICs', $parameters));

      if ($response->getResponseType() == 'OK') {
        $return = array();
        foreach ($response->getTICs() as $tic) {
          $return[$tic->getTICID()] = $tic->getDescription();
        }
        return $return;
      } else {
        foreach ($response->getMessages() as $message) {
          throw new GetTICsException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new GetTICsException($ex->getMessage());
    }
  }

  /**
   * Get a list of the locations currently associated with the TaxCloud account associated with the API ID being used.
   *
   * @param  GetLocations $parameters
   * @return Location[]
   */
  public function GetLocations(GetLocations $parameters)
  {
    try {
      $response = new GetLocationsResponse($this->post('GetLocations', $parameters));

      if ($response->getResponseType() == 'OK') {
        return $response->getLocations();
      } else {
        foreach ($response->getMessages() as $message) {
          throw new GetLocationsException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new GetLocationsException($ex->getMessage());
    }
  }

  /**
   * Add a batch of transactions (up to 25 at a time) from offline sources.
   *
   * All transactions will be imported into TaxCloud, and re-calculated to ensure proper tax amounts are included in
   * subsequent sales tax reports and filings.
   *
   * @param AddTransactions $parameters
   *
   * @return bool Boolean true on success.
   *
   * @throws AddTransactionsException If the AddTransactions request fails.
   */
  public function AddTransactions(AddTransactions $parameters)
  {
    try {
      $response = new AddTransactionsResponse($this->post('AddTransactions', $parameters));

      if ('OK' !== $response->getResponseType()) {
        foreach ($response->getMessages() as $message) {
          throw new AddTransactionsException($message->getMessage());
        }
      }
    } catch (RequestException $ex) {
      throw new AddTransactionsException($ex->getMessage());
    }

    return true;
  }

  /**
   * Send a POST request to a TaxCloud API endpoint.
   *
   * @param string           $endpoint Endpoint name
   * @param JsonSerializable $payload  Request payload
   * @return string Response
   * @throws RequestException If request fails
   */
  protected function post(string $endpoint, JsonSerializable $payload) {
    $url = "{$this->base_uri}{$endpoint}";
    $ch = curl_init($url);

    curl_setopt_array($ch, array(
      CURLOPT_HTTPHEADER => self::$headers,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => getenv('PHP_TAXCLOUD_REQUEST_TIMEOUT') ?: 30,
      CURLOPT_CAINFO => dirname(dirname(dirname(__FILE__))) . '/cacert.pem',
      CURLOPT_POSTFIELDS => json_encode($payload),
    ));

    try {
      $result = curl_exec($ch);

      if ($result === false) {
        throw new RequestException(curl_error($ch));
      }

      return $result;
    } catch (RequestException $ex) {
      throw $ex;
    } finally {
      curl_close($ch);
    }
  }
}
