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
 */

namespace TaxCloud;

use TaxCloud\Exceptions\AuthorizedException;
use TaxCloud\Exceptions\AuthorizedWithCaptureException;
use TaxCloud\Exceptions\CapturedException;
use TaxCloud\Exceptions\GetTICsException;
use TaxCloud\Exceptions\GetTICsByGroupException;
use TaxCloud\Exceptions\GetTICGroupsException;
use TaxCloud\Exceptions\LookupException;
use TaxCloud\Exceptions\PingException;
use TaxCloud\Exceptions\ReturnedException;
use TaxCloud\Exceptions\USPSIDException;
use TaxCloud\Exceptions\VerifyAddressException;
use TaxCloud\Request\AddExemptCertificate;
use TaxCloud\Request\Authorized;
use TaxCloud\Request\AuthorizedWithCapture;
use TaxCloud\Request\Captured;
use TaxCloud\Request\DeleteExemptCertificate;
use TaxCloud\Request\GetExemptCertificates;
use TaxCloud\Request\GetTICs;
use TaxCloud\Request\GetTICsByGroup;
use TaxCloud\Request\GetTICGroups;
use TaxCloud\Request\Lookup;
use TaxCloud\Request\LookupForDate;
use TaxCloud\Request\Ping;
use TaxCloud\Request\Returned;
use TaxCloud\Request\VerifyAddress;
use TaxCloud\Response\PingResponse;
use TaxCloud\Response\VerifyAddressResponse;
use TaxCloud\Response\LookupResponse;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;

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
    'Accept'       => 'application/json',
    'Content-Type' => 'application/json',
  );

  /**
   * Constructor.
   *
   * @since 0.2.0
   *
   * @param $base_uri URI of TaxCloud webservice. (default: 'https://api.taxcloud.net/1.0/TaxCloud/')
   */
  public function __construct($base_uri = "https://api.taxcloud.net/1.0/TaxCloud/")
  {
    $this->buildClient($base_uri);
  }

  /**
   * Build Guzzle client.
   *
   * @since 0.2.0
   *
   * @param $base_uri URI of TaxCloud webservice.
   */
  private function buildClient($base_uri)
  {
    $client = new GuzzleClient(array(
      'base_uri' => $base_uri,
      'timeout'  => 10.0,
    ));

    $this->setClient($client);
  }

  /**
   * Set Guzzle client.
   *
   * @since 0.2.0
   *
   * @param GuzzleClient $client
   */
  public function setClient(GuzzleClient $client)
  {
    $this->client = $client;
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
    $request = new Request('POST', 'Ping', self::$headers, json_encode($parameters));

    try {
      $response = new PingResponse($this->client->send($request));
      $result   = $response->getPingResult();

      if ($result->getResponseType() == 'OK') {
        return TRUE;
      } else {
        foreach ($result->getMessages() as $message) {
          throw new PingException($message->getMessage());
        }
      }
    } catch (\GuzzleHttp\Exception\RequestException $ex) {
      throw new PingException($ex->getMessage());
    }
  }

  /**
   * Inspect and verify a customer provided address to ensure the most accurate
   * tax jurisdiction(s) can be identified.
   *
   * @param VerifyAddress $parameters
   * @return VerifiedAddress
   */
  public function VerifyAddress(VerifyAddress $parameters)
  {
    $request = new Request('POST', 'VerifyAddress', self::$headers, json_encode($parameters));

    try {
      $response = new VerifyAddressResponse($this->client->send($request));
      $result   = $response->getVerifyAddressResult();

      if ($result->getErrNumber() == 0) {
        return $result->getAddress();
      } elseif ($result->getErrNumber() == '80040B1A') {
        throw new USPSIDException('Error ' . $result->getErrNumber() . ': ' . $result->getErrDescription());
      } else {
        throw new VerifyAddressException('Error ' . $result->getErrNumber() . ': ' . $result->getErrDescription());
      }
    } catch (\GuzzleHttp\Exception\RequestException $ex) {
      throw new VerifyAddressException($ex->getMessage());
    }
  }

  /**
   * Lookup the applicable tax amounts for items in a cart.
   *
   * @param Lookup $parameters
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
    $request = new Request('POST', 'Lookup', self::$headers, json_encode($parameters));

    try {
      $response = new LookupResponse($this->client->send($request));

      if ($response->getResponseType() == 'OK') {
        $cart_id = $response->getCartID();
        $return  = array();

        foreach ($response->getCartItemsResponse() as $CartItemResponse) {
          $return[$cart_id][$CartItemResponse->getCartItemIndex()] = $CartItemResponse->getTaxAmount();
        }
        
        return $return;
      } else {
        foreach ($response->getMessages() as $message) {
          throw new LookupException($message->getMessage());
        }
      }
    } catch (\GuzzleHttp\Exception\RequestException $ex) {
      throw new LookupException($ex->getMessage());
    }
  }

  /**
   *
   *
   * @param LookupForDate $parameters
   * @return LookupForDateResponse
   */
  public function LookupForDate(LookupForDate $parameters)
  {
    return $this->soapClient->__soapCall('LookupForDate', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param Authorized $parameters
   * @return AuthorizedResponse
   */
  public function Authorized(Authorized $parameters)
  {
    $AuthorizedResponse = $this->soapClient->__soapCall('Authorized', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
         );

    $AuthorizedResult = $AuthorizedResponse->getAuthorizedResult();

    if ($AuthorizedResult->getResponseType() == 'OK') {
      return TRUE;
    }
    else {
      foreach ($AuthorizedResult->getMessages() as $message) {
        throw new AuthorizedException($message->getMessage());
      }
    }
  }

  /**
   *
   *
   * @param AuthorizedWithCapture $parameters
   * @return AuthorizedWithCaptureResponse
   */
  public function AuthorizedWithCapture(AuthorizedWithCapture $parameters)
  {
    $AuthorizedWithCaptureResponse = $this->soapClient->__soapCall('AuthorizedWithCapture', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
         );

    $AuthorizedWithCaptureResult = $AuthorizedWithCaptureResponse->getAuthorizedWithCaptureResult();

    if ($AuthorizedWithCaptureResult->getResponseType() == 'OK') {
      return TRUE;
    }
    else {
      foreach ($AuthorizedWithCaptureResult->getMessages() as $message) {
        throw new AuthorizedWithCaptureException($message->getMessage());
      }
    }
  }

  /**
   *
   *
   * @param Captured $parameters
   * @return CapturedResponse
   */
  public function Captured(Captured $parameters)
  {
    $CapturedResponse = $this->soapClient->__soapCall('Captured', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
         );

    $CapturedResult = $CapturedResponse->getCapturedResult();

    if ($CapturedResult->getResponseType() == 'OK') {
      return TRUE;
    }
    else {
      foreach ($CapturedResult->getMessages() as $message) {
        throw new CapturedException($message->getMessage());
      }
    }
  }

  /**
   *
   *
   * @param Returned $parameters
   * @return ReturnedResponse
   */
  public function Returned(Returned $parameters)
  {
    $ReturnedResponse = $this->soapClient->__soapCall('Returned', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
         );

    $ReturnedResult = $ReturnedResponse->getReturnedResult();

    if ($ReturnedResult->getResponseType() == 'OK') {
      return TRUE;
    }
    else {
      foreach ($ReturnedResult->getMessages() as $message) {
        throw new ReturnedException($message->getMessage());
      }
    }
  }

  /**
   *
   *
   * @param GetTICGroups $parameters
   * @return GetTICGroupsResponse
   */
  public function GetTICGroups(GetTICGroups $parameters)
  {
    $GetTICGroupsResponse = $this->soapClient->__soapCall('GetTICGroups', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
         );

    $GetTICGroupsResult = $GetTICGroupsResponse->getTICGroupsResult();
    if ($GetTICGroupsResult->getResponseType() == 'OK') {
      $TICGroups = $GetTICGroupsResult->getTICGroups();

      $return = array();
      foreach ($TICGroups as $TICGroupsArray) {
        foreach ($TICGroupsArray as $TICGroup) {
          $return[$TICGroup->getGroupID()] = $TICGroup->getDescription();
        }
      }

      return $return;
    }
    else {
      foreach ($GetTICGroupsResult->getMessages() as $message) {
        throw new GetTICGroupsException($message->getMessage());
      }
    }
  }

  /**
   *
   *
   * @param GetTICs $parameters
   * @return GetTICsResponse
   */
  public function GetTICs(GetTICs $parameters)
  {
    $GetTICsResponse = $this->soapClient->__soapCall('GetTICs', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
         );

    $GetTICsResult = $GetTICsResponse->getTICsResult();

    if ($GetTICsResult->getResponseType() == 'OK') {
      $TICs = $GetTICsResult->getTICs();

      $return = array();
      foreach ($TICs as $TICArray) {
        foreach ($TICArray as $TIC) {
          $return[$TIC->getTICID()] = $TIC->getDescription();
        }
      }

      return $return;
    }
    else {
      foreach ($GetTICsResult->getMessages() as $message) {
        throw new GetTICsException($message->getMessage());
      }
    }
  }

  /**
   *
   *
   * @param GetTICsByGroup $parameters
   * @return GetTICsByGroupResponse
   */
  public function GetTICsByGroup(GetTICsByGroup $parameters)
  {
    $GetTICsByGroupResponse = $this->soapClient->__soapCall('GetTICsByGroup', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
         );

    $GetTICsByGroupResult = $GetTICsByGroupResponse->GetTICsByGroupResult();

    if ($GetTICsByGroupResult->getResponseType() == 'OK') {
      $TICs = $GetTICsByGroupResult->getTICs();

      $return = array();
      foreach ($TICs as $TICArray) {
        foreach ($TICArray as $TIC) {
          $return[$TIC->getTICID()] = $TIC->getDescription();
        }
      }

      return $return;
    }
    else {
      foreach ($GetTICsByGroupResult->getMessages() as $message) {
        throw new GetTICsByGroupException($message->getMessage());
      }
    }
  }

  /**
   *
   *
   * @param AddExemptCertificate $parameters
   * @return AddExemptCertificateResponse
   */
  public function AddExemptCertificate(AddExemptCertificate $parameters)
  {
    return $this->soapClient->__soapCall('AddExemptCertificate', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param DeleteExemptCertificate $parameters
   * @return DeleteExemptCertificateResponse
   */
  public function DeleteExemptCertificate(DeleteExemptCertificate $parameters)
  {
    return $this->soapClient->__soapCall('DeleteExemptCertificate', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param GetExemptCertificates $parameters
   * @return GetExemptCertificatesResponse
   */
  public function GetExemptCertificates(GetExemptCertificates $parameters)
  {
    return $this->soapClient->__soapCall('GetExemptCertificates', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }
}
