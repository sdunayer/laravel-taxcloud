<?php

/**
 * This is not an exhaustive test.
 *
 * The purpose of the smoketest is to quickly identify if something has broken
 * integration with the TaxCloud API. The smoketest goes through the process
 * required by TaxCloud and actually makes connections to TaxCloud.
 */

// API credentials loaded from environment variables.
$apiLoginID = $_ENV["TaxCloud_apiLoginID"] . 'xxx';
$apiKey = $_ENV["TaxCloud_apiKey"];
$uspsUserID = $_ENV["TaxCloud_uspsUserID"];

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

print_r($client->VerifyAddress($verifyAddress));
