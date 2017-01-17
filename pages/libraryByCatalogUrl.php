<?php

require_once __DIR__ . '/../bootstrap.php';
$libraryService = new OpenBibIdApi\Service\LibraryService($consumer);
if (!isset($_GET['library_catalog'])) {
  $form = '<form method="GET" action="/pages/' . basename(__FILE__) . '?' . http_build_query($_GET) . '">';
  $form .= 'URL: (bvb: http://zoeken.gent.bibliotheek.be)<input type="text" name="library_catalog"/>';
  foreach ($_GET as $key => $val) {
    $form .= '<input type="hidden" name="' . $key . '" value="' . $val . '" />';
  }
  $form .= '<input type="submit" value="Submit"/>';
  $form .= '</form>';
  print $form;
  exit;
}
print luminous::head_html();
print luminous::highlight('xml', $libraryService->getLibraryByCatalogUrl($_GET['library_catalog'])->saveXML(), FALSE);
