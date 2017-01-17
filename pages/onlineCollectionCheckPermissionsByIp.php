<?php

require_once __DIR__ . '/../init.php';
$client = new OpenBibIdApi\BibConsumer(CONSUMER_KEY, CONSUMER_SECRET, CURRENT_ENV);
if (!isset($_GET['collection_consumer_key']) || !isset($_GET['collection_ip'])) {
  $list = $client->user()->getUserAvailableOnlineCollections();
  $form = '<form method="GET" action="/pages/' . basename(__FILE__) . '?' . http_build_query($_GET) . '">';
  $form .= '<select name="collection_consumer_key">';
  foreach ($list->getElementsByTagName('subscription') as $sub) {
    $form .= '<option value="' . $sub->getElementsByTagName('consumerKey')->item(0)->nodeValue . '">' . $sub->getElementsByTagName('name')->item(0)->nodeValue . '</option>';
  }
  $form .= '</select>';
  $form .= 'IP (bvb: 212.123.26.150)<input type="text" name="collection_ip"/>';
  foreach ($_GET as $key => $val) {
    $form .= '<input type="hidden" name="' . $key . '" value="' . $val . '" />';
  }
  $form .= '<input type="submit" value="Submit"/>';
  $form .= '</form>';
  print $form;
  exit;
}
print luminous::head_html();
print luminous::highlight('xml', $client->onlineCollection()->getOnlineCollectionPermissionsByIp($_GET['collection_consumer_key'], $_GET['collection_ip'])->saveXML(), FALSE);
