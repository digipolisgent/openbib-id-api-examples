<?php

require_once __DIR__ . '/../bootstrap.php';
$libraryService = new OpenBibIdApi\Service\LibraryService($consumer);
print luminous::head_html();
print luminous::highlight('xml', $libraryService->getLibraryList()->saveXML(), FALSE);
