<?php

require_once __DIR__ . '/../init.php';
$client = new OpenBibIdApi\BibConsumer(CONSUMER_KEY, CONSUMER_SECRET, CURRENT_ENV);
if (!isset($_GET['collection_consumer_key'])) {
  $list = $client->user()->getUserAvailableOnlineCollections();
  $form = '<form method="GET" action="/pages/' . basename(__FILE__) . '?' . http_build_query($_GET) . '">';
  $form .= '<select name="collection_consumer_key">';
  foreach ($list->getElementsByTagName('subscription') as $sub) {
    $form .= '<option value="' . $sub->getElementsByTagName('consumerKey')->item(0)->nodeValue . '">' . $sub->getElementsByTagName('name')->item(0)->nodeValue . '</option>';
  }
  $form .= '</select>';
  foreach ($_GET as $key => $val) {
    $form .= '<input type="hidden" name="' . $key . '" value="' . $val . '" />';
  }
  $form .= '<input type="submit" value="Submit"/>';
  $form .= '</form>';
  print $form;
  exit;
}
print luminous::head_html();
print luminous::highlight('xml', $client->onlineCollection()->getOnlineCollectionPermissions($_GET['collection_consumer_key'])->saveXML(), FALSE);
