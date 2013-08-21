<?php

namespace TaxCloud;

class CartItem {
  private $Index; // int
  private $ItemID; // string
  private $TIC; // int
  private $Price; // double
  private $Qty; // float

  public function __construct($index, $itemId, $tic, $price, $qty) {
    $this->Index = $index;
    $this->ItemID = $itemId;
    $this->TIC = $tic;
    $this->Price = $price;
    $this->Qty = $qty;
  }

  public function setIndex($index) {
    $this->Index = $index;
  }

  public function getIndex() {
    return $this->Index;
  }

  public function setItemID($itemId) {
    $this->ItemID = $itemId;
  }

  public function getItemID() {
    return $this->ItemID;
  }

  public function setTIC($tic) {
    $this->TIC = $tic;
  }

  public function getTIC() {
    return $this->TIC;
  }

  public function setPrice($price) {
    // @todo this needs validation
    $this->Price = $price;
  }

  public function getPrice() {
    return $this->Price;
  }

  public function setQty($qty) {
    $this->Qty = $qty;
  }

  public function getQty() {
    return $this->Qty;
  }
}

