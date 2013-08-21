<?php

namespace TaxCloud;

class Authorized {
  private $apiLoginID; // string
  private $apiKey; // string
  private $customerID; // string
  private $cartID; // string
  private $cartItems; // array
  private $orderID; // string
  private $dateAuthorized; // dateTime

  public function __construct($apiLoginId, $apiKey, $customerId, $cartId, $cartItems, $orderId, $dateAuthorized) {
    $this->apiLoginID = $apiLoginId;
    $this->apiKey = $apiKey;
    $this->customerID = $customerId;
    $this->cartID = $cartId;
    $this->orderID = $orderId;
    $this->dateAuthorized = $dateAuthorized;
  }

  public function setApiLoginID($apiLoginId) {
    $this->apiLoginID = $apiLoginId;
  }

  public function getApiLoginID() {
    return $this->apiLoginID;
  }

  public function setApiKey($apiKey) {
    $this->apiKey = $apiKey;
  }

  public function getApiKey() {
    return $this->apiKey;
  }

  public function setCustomerID($customerId) {
    $this->customerID = $customerId;
  }

  public function getCustomerID() {
    return $this->customerID;
  }

  public function setCartID($cartId) {
    $this->cartID = $cartId;
  }

  public function getCartID() {
    return $this->cartID;
  }

  public function setCartItems($cartItems) {
    $this->cartItems = $cartItems;
  }

  public function getCartItems() {
    return $this->cartItems;
  }

  public function setOrderID($orderId) {
    $this->orderID = $orderId;
  }

  public function getOrderID() {
    return $this->orderID;
  }

  public function setAuthorizedDate($authorizedDate) {
    $this->authorizedDate = $authorizedDate;
  }

  public function getAuthorizedDate() {
    return $this->authorizedDate;
  }
}

