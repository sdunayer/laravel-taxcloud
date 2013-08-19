<?php

/**
 * @file
 * Provide a factory for TaxCloud SOAP client.
 */

namespace TaxCloud;

class ClientFactory {

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

  public function factory($wsdl) {
    return new SoapClient($wsdl, array(
      'trace'     => 1,
      'features'  => \SOAP_SINGLE_ELEMENT_ARRAYS,
      'classmap'  => $this->classmap,
      'cache_wsdl' => \WSDL_CACHE_MEMORY
    ));
  }
}
