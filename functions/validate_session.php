<?php
session_start();

try {

    $timeout = 1800;

    if ((time() - $_SESSION["LAST_ACTIVITY"]) > $timeout) {
        session_unset();
        session_destroy();

        echo json_encode(['success' => true, 'active' => false]);
    }

    $_SESSION["LAST_ACTIVITY"] = time();

    echo json_encode(['success' => true, 'active' => true]);
} catch (Exception $ex) {
    echo json_encode(['success' => false, 'error' => $ex->getMessage()]);
}
