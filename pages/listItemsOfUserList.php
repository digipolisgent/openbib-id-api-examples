<?php

require_once __DIR__ . '/../bootstrap.php';
$listService = new OpenBibIdApi\Service\ListService($consumer);
if (!isset($_GET['list_id'])) {
  $list = $listService->getUserLists();
  $form = '<form method="GET" action="/pages/' . basename(__FILE__) . '?' . http_build_query($_GET) . '">';
  $form .= '<select name="list_id">';
  foreach ($list->getElementsByTagName('list') as $lib) {
    $form .= '<option value="' . $lib->getElementsByTagName('id')->item(0)->nodeValue . '">' . $lib->getElementsByTagName('title')->item(0)->nodeValue . '</option>';
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
print luminous::highlight('xml', $listService->getListItems($_GET['list_id'])->saveXML(), FALSE);
