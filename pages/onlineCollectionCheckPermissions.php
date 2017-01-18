<?php

require_once __DIR__ . '/../bootstrap.php';
if (!isset($_GET['collection_consumer_key'])) {
  $userService = new OpenBibIdApi\Service\UserService($consumer);
  $list = $userService->getUserAvailableOnlineCollections();
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
$onlineCollectionService = new OpenBibIdApi\Service\OnlineCollectionService($consumer);
print luminous::head_html();
print luminous::highlight('xml', $onlineCollectionService->getOnlineCollectionPermissions($_GET['collection_consumer_key'])->saveXML(), FALSE);
