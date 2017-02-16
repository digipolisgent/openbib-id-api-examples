<?php

require_once __DIR__ . '/../bootstrap.php';
$userService = new OpenBibIdApi\Service\UserService($consumer);
print luminous::head_html();
print luminous::highlight('php', print_r(\OpenBibIdApi\Value\User\AutoLogin::fromXml($userService->autoLogin()), true), FALSE);
