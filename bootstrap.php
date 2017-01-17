<?php

require_once __DIR__ . '/vendor/autoload.php';
if (file_exists(__DIR__ . '/config.php')) {
  include_once __DIR__ . '/config.php';
}
session_start();
$environment = \OpenBibIdApi\Auth\Environment::staging();
if (defined('BIB_ENV') && BIB_ENV == 'prod') {
  $environment = \OpenBibIdApi\Auth\Environment::production();
}
$credentials = new \OpenBibIdApi\Auth\Credentials(CONSUMER_KEY, CONSUMER_SECRET, $environment);
$consumer = new \OpenBibIdApi\Consumer\BibConsumer($credentials);
