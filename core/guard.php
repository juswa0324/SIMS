<?php

function requireAccess($pdo, $userId, $link)
{
    require_once 'auth.php';

    if (!checkAccess($pdo, $userId, $link)) {
        http_response_code(403);
        exit("Unauthorized Access!");
    }
}
