<?php

require_once __DIR__ . '/../bootstrap.php';
$listService = new OpenBibIdApi\Service\ListService($consumer);
print luminous::head_html();
print luminous::highlight('xml', $listService->getUserLists()->saveXML(), FALSE);
