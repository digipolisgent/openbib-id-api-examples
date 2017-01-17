<?php

require_once __DIR__ . '/../init.php';
$client = new OpenBibIdApi\BibConsumer(CONSUMER_KEY, CONSUMER_SECRET, CURRENT_ENV);
print luminous::head_html();
print luminous::highlight('xml', $client->user()->getUserProfile()->saveXML(), FALSE);
