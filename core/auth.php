<?php

require_once 'PermissionService.php';

function checkAccess($pdo, $userId, $link)
{
    $service = new PermissionService($pdo);
    return $service->checkAccess($userId, $link);
}
