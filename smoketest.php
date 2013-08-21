<?php

/**
 * This is not an exhaustive test.
 *
 * The purpose of the smoketest is to quickly identify if something has broken
 * integration with the TaxCloud API. The smoketest goes through the process
 * required by TaxCloud and actually makes connections to TaxCloud.
 */

// API credentials loaded from environment variables.
$apiLoginID = $_ENV["TaxCloud_apiLoginID"];
$apiKey = $_ENV["TaxCloud_apiKey"];
$uspsUserID = $_ENV["TaxCloud_uspsUserID"];

// Some variable that need to be unique, but can't change.
$orderID = rand();
$cartID = rand(1, 999);

/**
 * Show us what step we are on.
 */
function step($message) {
  global $STEPCOUNTER;
  printf("\nStep %d. %s\n", $STEPCOUNTER++, sprintf($message));
}

require_once 'lib/php-taxcloud.php';

$client = new \TaxCloud\TaxCloud('TaxCloud.wsdl');

step('Ping');
$pingParams = new \TaxCloud\Ping;
$pingParams->apiLoginID = $apiLoginID;
$pingParams->apiKey = $apiKey;

print_r($client->Ping($pingParams));

step('Get TICs');

$params = new \TaxCloud\GetTICs($apiLoginID, $apiKey);
print_r($client->GetTICs($params));

step('Cart Item');
$cartItems = array();
$cartItem = new \TaxCloud\CartItem($cartID + 1, 'ABC123', '00000', 12.00, 1);
$cartItems[] = $cartItem;
print_r($cartItem);

step('Cart Item - Shipping');

$cartItemShipping = new \TaxCloud\CartItem($cartID + 2, 'SHIPPING123', 11010, 8.95, 1);
$cartItems[] = $cartItemShipping;
print_r($cartItemShipping);

step('Cart Items Array');

print_r($cartItems);

step('Verify Address');
$address = new \TaxCloud\Address;

$address->setAddress1('1600 Pennsylvania Ave NW');
$address->setAddress2('');
$address->setCity('Washington');
$address->setState('DC');
// Intentionally wrong zip
$address->setZip5('20006');
$address->setZip4('1234');

$verifyAddress = new \TaxCloud\VerifyAddress;
$verifyAddress->uspsUserID = $uspsUserID;
$verifyAddress->address1 = $address->getAddress1();
$verifyAddress->address2 = $address->getAddress2();
$verifyAddress->city = $address->getCity();
$verifyAddress->state = $address->getState();
$verifyAddress->zip5 = $address->getZip5();
$verifyAddress->zip4 = $address->getZip4();

$verifiedAddress = $client->VerifyAddress($verifyAddress);
print_r($verifiedAddress);

step('Lookup');

print_r($address);

$originAddress = new \TaxCloud\Address();
$originAddress->setAddress1($verifiedAddress->VerifyAddressResult->Address1);
$originAddress->setCity($verifiedAddress->VerifyAddressResult->City);
$originAddress->setState($verifiedAddress->VerifyAddressResult->State);
$originAddress->setZip5($verifiedAddress->VerifyAddressResult->Zip5);
$originAddress->setZip4($verifiedAddress->VerifyAddressResult->Zip4);

$destAddress = new \TaxCloud\Address();
$destAddress->setAddress1('PO Box 573');
$destAddress->setCity('Clinton');
$destAddress->setState('OK');
$destAddress->setZip5('73601');

print_r($destAddress);

$lookup = new \TaxCloud\Lookup($apiLoginID, $apiKey, '123', $cartID, $cartItems, $originAddress, $destAddress);
print_r($client->Lookup($lookup));

step('Authorized');

$authorization = new \TaxCloud\Authorized($apiLoginID, $apiKey, '123', $cartID, $cartItems, $orderID, date("c"));
print_r($client->Authorized($authorization));

step('Captured');
$capture = new \TaxCloud\Captured($apiLoginID, $apiKey, $orderID);
print_r($client->Captured($capture));

step('Authorized With Capture');
$authcap = new \TaxCloud\AuthorizedWithCapture($apiLoginID, $apiKey, '123', $cartID, $cartItems, $orderID, date("c"), date("c"));
print_r($client->AuthorizedWithCapture($authcap));
