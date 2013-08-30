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
