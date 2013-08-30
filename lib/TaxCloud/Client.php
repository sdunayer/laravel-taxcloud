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

/**
 * TaxCloud Web Service
 *
 * @author    Brian Altenhofel
 * @package   php-taxcloud
 */
class Client extends \SoapClient {

  private static $classmap = array(
    'VerifyAddress' => '\TaxCloud\VerifyAddress',
    'VerifyAddressResponse' => '\TaxCloud\VerifyAddressResponse',
    'VerifiedAddress' => '\TaxCloud\VerifiedAddress',
    'Address' => '\TaxCloud\Address',
    'LookupForDate' => '\TaxCloud\LookupForDate',
    'CartItem' => '\TaxCloud\CartItem',
    'ExemptionCertificate' => '\TaxCloud\ExemptionCertificate',
    'ExemptionCertificateDetail' => '\TaxCloud\ExemptionCertificateDetail',
    'ExemptState' => '\TaxCloud\ExemptState',
    'State' => '\TaxCloud\State',
    'TaxID' => '\TaxCloud\TaxID',
    'TaxIDType' => '\TaxCloud\TaxIDType',
    'BusinessType' => '\TaxCloud\BusinessType',
    'ExemptionReason' => '\TaxCloud\ExemptionReason',
    'LookupForDateResponse' => '\TaxCloud\LookupForDateResponse',
    'LookupRsp' => '\TaxCloud\LookupRsp',
    'ResponseBase' => '\TaxCloud\ResponseBase',
    'MessageType' => '\TaxCloud\MessageType',
    'ResponseMessage' => '\TaxCloud\ResponseMessage',
    'CartItemResponse' => '\TaxCloud\CartItemResponse',
    'Lookup' => '\TaxCloud\Lookup',
    'LookupResponse' => '\TaxCloud\LookupResponse',
    'Authorized' => '\TaxCloud\Authorized',
    'AuthorizedResponse' => '\TaxCloud\AuthorizedResponse',
    'AuthorizedRsp' => '\TaxCloud\AuthorizedRsp',
    'AuthorizedWithCapture' => '\TaxCloud\AuthorizedWithCapture',
    'AuthorizedWithCaptureResponse' => '\TaxCloud\AuthorizedWithCaptureResponse',
    'Captured' => '\TaxCloud\Captured',
    'CapturedResponse' => '\TaxCloud\CapturedResponse',
    'CapturedRsp' => '\TaxCloud\CapturedRsp',
    'Returned' => '\TaxCloud\Returned',
    'ReturnedResponse' => '\TaxCloud\ReturnedResponse',
    'ReturnedRsp' => '\TaxCloud\ReturnedRsp',
    'GetTICGroups' => '\TaxCloud\GetTICGroups',
    'GetTICGroupsResponse' => '\TaxCloud\GetTICGroupsResponse',
    'GetTICGroupsRsp' => '\TaxCloud\GetTICGroupsRsp',
    'TICGroup' => '\TaxCloud\TICGroup',
    'GetTICs' => '\TaxCloud\GetTICs',
    'GetTICsResponse' => '\TaxCloud\GetTICsResponse',
    'GetTICsRsp' => '\TaxCloud\GetTICsRsp',
    'TIC' => '\TaxCloud\TIC',
    'GetTICsByGroup' => '\TaxCloud\GetTICsByGroup',
    'GetTICsByGroupResponse' => '\TaxCloud\GetTICsByGroupResponse',
    'AddExemptCertificate' => '\TaxCloud\AddExemptCertificate',
    'AddExemptCertificateResponse' => '\TaxCloud\AddExemptCertificateResponse',
    'AddCertificateRsp' => '\TaxCloud\AddCertificateRsp',
    'DeleteExemptCertificate' => '\TaxCloud\DeleteExemptCertificate',
    'DeleteExemptCertificateResponse' => '\TaxCloud\DeleteExemptCertificateResponse',
    'DeleteCertificateRsp' => '\TaxCloud\DeleteCertificateRsp',
    'GetExemptCertificates' => '\TaxCloud\GetExemptCertificates',
    'GetExemptCertificatesResponse' => '\TaxCloud\GetExemptCertificatesResponse',
    'GetCertificatesRsp' => '\TaxCloud\GetCertificatesRsp',
    'Ping' => '\TaxCloud\Ping',
    'PingResponse' => '\TaxCloud\PingResponse',
    'PingRsp' => '\TaxCloud\PingRsp',
  );

  public function __construct($wsdl = "https://api.taxcloud.net/1.0/?wsdl", $options = array()) {
    foreach (self::$classmap as $key => $value) {
      if (!isset($options['classmap'][$key])) {
        $options['classmap'][$key] = $value;
      }
    }

    parent::__construct($wsdl, $options);
  }

  /**
   *
   *
   * @param VerifyAddress $parameters
   * @return VerifyAddressResponse
   */
  public function VerifyAddress(VerifyAddress $parameters) {
    return $this->__soapCall('VerifyAddress', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param LookupForDate $parameters
   * @return LookupForDateResponse
   */
  public function LookupForDate(LookupForDate $parameters) {
    return $this->__soapCall('LookupForDate', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param Lookup $parameters
   * @return LookupResponse
   */
  public function Lookup(Lookup $parameters) {
    return $this->__soapCall('Lookup', array($parameters),       array(
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
  public function Authorized(Authorized $parameters) {
    return $this->__soapCall('Authorized', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param AuthorizedWithCapture $parameters
   * @return AuthorizedWithCaptureResponse
   */
  public function AuthorizedWithCapture(AuthorizedWithCapture $parameters) {
    return $this->__soapCall('AuthorizedWithCapture', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param Captured $parameters
   * @return CapturedResponse
   */
  public function Captured(Captured $parameters) {
    return $this->__soapCall('Captured', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param Returned $parameters
   * @return ReturnedResponse
   */
  public function Returned(Returned $parameters) {
    return $this->__soapCall('Returned', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param GetTICGroups $parameters
   * @return GetTICGroupsResponse
   */
  public function GetTICGroups(GetTICGroups $parameters) {
    return $this->__soapCall('GetTICGroups', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param GetTICs $parameters
   * @return GetTICsResponse
   */
  public function GetTICs(GetTICs $parameters) {
    return $this->__soapCall('GetTICs', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param GetTICsByGroup $parameters
   * @return GetTICsByGroupResponse
   */
  public function GetTICsByGroup(GetTICsByGroup $parameters) {
    return $this->__soapCall('GetTICsByGroup', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param AddExemptCertificate $parameters
   * @return AddExemptCertificateResponse
   */
  public function AddExemptCertificate(AddExemptCertificate $parameters) {
    return $this->__soapCall('AddExemptCertificate', array($parameters),       array(
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
  public function DeleteExemptCertificate(DeleteExemptCertificate $parameters) {
    return $this->__soapCall('DeleteExemptCertificate', array($parameters),       array(
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
  public function GetExemptCertificates(GetExemptCertificates $parameters) {
    return $this->__soapCall('GetExemptCertificates', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param Ping $parameters
   * @return PingResponse
   */
  public function Ping(Ping $parameters) {
    return $this->__soapCall('Ping', array($parameters),       array(
            'uri' => 'http://taxcloud.net',
            'soapaction' => ''
           )
      );
  }

}

