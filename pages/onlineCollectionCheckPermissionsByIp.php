<?php

require_once __DIR__ . '/../bootstrap.php';
if (!isset($_GET['collection_consumer_key']) || !isset($_GET['collection_ip'])) {
  $userService = new OpenBibIdApi\Service\UserService($consumer);
  $list = $userService->getUserAvailableOnlineCollections();
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
$onlineCollectionService = new OpenBibIdApi\Service\OnlineCollectionService($consumer);
print luminous::head_html();
print luminous::highlight('xml', $onlineCollectionService->getOnlineCollectionPermissionsByIp($_GET['collection_consumer_key'], $_GET['collection_ip'])->saveXML(), FALSE);
