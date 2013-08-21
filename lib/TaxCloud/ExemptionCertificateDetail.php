<?php

namespace TaxCloud;

class ExemptionCertificateDetail {
  private $ExemptStates; // ArrayOfExemptState
  private $SinglePurchase; // boolean
  private $SinglePurchaseOrderNumber; // string
  private $PurchaserFirstName; // string
  private $PurchaserLastName; // string
  private $PurchaserTitle; // string
  private $PurchaserAddress1; // string
  private $PurchaserAddress2; // string
  private $PurchaserCity; // string
  private $PurchaserState; // State
  private $PurchaserZip; // string
  private $PurchaserTaxID; // TaxID
  private $PurchaserBusinessType; // BusinessType
  private $PurchaserBusinessTypeOtherValue; // string
  private $PurchaserExemptionReason; // ExemptionReason
  private $PurchaserExemptionReasonValue; // string
  private $CreatedDate; // dateTime
}

