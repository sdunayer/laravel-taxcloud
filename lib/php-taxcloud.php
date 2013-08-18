<?php

/**
 * @file
 * Load php-taxcloud library.
 */

require_once(__DIR__ . '/Autoload.php');

$classLoader = new ClassLoader;
$classLoader->registerNamespace(array(
  'TaxCloud' => array(__DIR__, __DIR__ . '/../tests')
));
$classLoader->register();
