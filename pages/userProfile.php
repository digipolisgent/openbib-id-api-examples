<?php

require_once __DIR__ . '/../bootstrap.php';
$userService = new OpenBibIdApi\Service\UserService($consumer);
print luminous::head_html();
print luminous::highlight('xml', $userService->getUserProfile()->saveXML(), FALSE);
