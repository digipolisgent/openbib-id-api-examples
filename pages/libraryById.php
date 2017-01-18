<?php

require_once __DIR__ . '/../bootstrap.php';
$libraryService = new OpenBibIdApi\Service\LibraryService($consumer);

if (!isset($_GET['library_id'])) {
  $list = $libraryService->getLibraryList();
  $form = '<form method="GET" action="/pages/' . basename(__FILE__) . '?' . http_build_query($_GET) . '">';
  $form .= '<select name="library_id">';
  foreach ($list->getElementsByTagName('library') as $lib) {
    $form .= '<option value="' . $lib->getElementsByTagName('id')->item(0)->nodeValue . '">' . $lib->getElementsByTagName('naam')->item(0)->nodeValue . '</option>';
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
print luminous::highlight('xml', $libraryService->getLibraryById($_GET['library_id'])->saveXML(), FALSE);
