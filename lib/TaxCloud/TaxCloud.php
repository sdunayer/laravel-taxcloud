<?php

/**
 * TaxCloud Web Service
 *
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */
class TaxCloud extends SoapClient {

  private static $classmap = array(
    'VerifyAddress' => 'VerifyAddress',
    'VerifyAddressResponse' => 'VerifyAddressResponse',
    'VerifiedAddress' => 'VerifiedAddress',
    'Address' => 'Address',
    'LookupForDate' => 'LookupForDate',
    'CartItem' => 'CartItem',
    'ExemptionCertificate' => 'ExemptionCertificate',
    'ExemptionCertificateDetail' => 'ExemptionCertificateDetail',
    'ExemptState' => 'ExemptState',
    'State' => 'State',
    'TaxID' => 'TaxID',
    'TaxIDType' => 'TaxIDType',
    'BusinessType' => 'BusinessType',
    'ExemptionReason' => 'ExemptionReason',
    'LookupForDateResponse' => 'LookupForDateResponse',
    'LookupRsp' => 'LookupRsp',
    'ResponseBase' => 'ResponseBase',
    'MessageType' => 'MessageType',
    'ResponseMessage' => 'ResponseMessage',
    'CartItemResponse' => 'CartItemResponse',
    'Lookup' => 'Lookup',
    'LookupResponse' => 'LookupResponse',
    'Authorized' => 'Authorized',
    'AuthorizedResponse' => 'AuthorizedResponse',
    'AuthorizedRsp' => 'AuthorizedRsp',
    'AuthorizedWithCapture' => 'AuthorizedWithCapture',
    'AuthorizedWithCaptureResponse' => 'AuthorizedWithCaptureResponse',
    'Captured' => 'Captured',
    'CapturedResponse' => 'CapturedResponse',
    'CapturedRsp' => 'CapturedRsp',
    'Returned' => 'Returned',
    'ReturnedResponse' => 'ReturnedResponse',
    'ReturnedRsp' => 'ReturnedRsp',
    'GetTICGroups' => 'GetTICGroups',
    'GetTICGroupsResponse' => 'GetTICGroupsResponse',
    'GetTICGroupsRsp' => 'GetTICGroupsRsp',
    'TICGroup' => 'TICGroup',
    'GetTICs' => 'GetTICs',
    'GetTICsResponse' => 'GetTICsResponse',
    'GetTICsRsp' => 'GetTICsRsp',
    'TIC' => 'TIC',
    'GetTICsByGroup' => 'GetTICsByGroup',
    'GetTICsByGroupResponse' => 'GetTICsByGroupResponse',
    'AddExemptCertificate' => 'AddExemptCertificate',
    'AddExemptCertificateResponse' => 'AddExemptCertificateResponse',
    'AddCertificateRsp' => 'AddCertificateRsp',
    'DeleteExemptCertificate' => 'DeleteExemptCertificate',
    'DeleteExemptCertificateResponse' => 'DeleteExemptCertificateResponse',
    'DeleteCertificateRsp' => 'DeleteCertificateRsp',
    'GetExemptCertificates' => 'GetExemptCertificates',
    'GetExemptCertificatesResponse' => 'GetExemptCertificatesResponse',
    'GetCertificatesRsp' => 'GetCertificatesRsp',
    'Ping' => 'Ping',
    'PingResponse' => 'PingResponse',
    'PingRsp' => 'PingRsp',
  );

  public function TaxCloud($wsdl = "https://api.taxcloud.net/1.0/?wsdl", $options = array()) {
    foreach(self::$classmap as $key => $value) {
      if(!isset($options['classmap'][$key])) {
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

