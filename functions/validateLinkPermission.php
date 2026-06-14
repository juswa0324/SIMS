<?php
include("../config/database.php");
session_start();

header('Content-Type: application/json');

if (!empty($_POST['link'])) {

    try {

        $link = $_POST['link'];

        // 1. Get permission link
        $stmt = $pdo->prepare("
            SELECT id 
            FROM permission_list 
            WHERE link = :link AND Deleted = 0
        ");
        $stmt->bindValue(":link", $link, PDO::PARAM_STR);
        $stmt->execute();

        $linkResult = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$linkResult) {
            echo json_encode([
                'success' => true,
                'hasAccess' => false
            ]);
            exit;
        }

        $linkID = $linkResult['id'];

        // 2. Validate session role
        if (!isset($_SESSION["RoleID"])) {
            echo json_encode([
                'success' => false,
                'error' => 'No session role'
            ]);
            exit;
        }

        $roleId = $_SESSION["RoleID"];

        // 3. Get role permissions
        $stmt = $pdo->prepare("
            SELECT Permission 
            FROM roles 
            WHERE id = :roleId AND Deleted = 0
        ");
        $stmt->bindValue(":roleId", $roleId, PDO::PARAM_INT);
        $stmt->execute();

        $roleResult = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$roleResult) {
            echo json_encode([
                'success' => false,
                'error' => 'Role not found'
            ]);
            exit;
        }

        $permissionsArray = array_map(
            'trim',
            explode(',', $roleResult["Permission"])
        );

        // 4. Final response
        echo json_encode([
            'success' => true,
            'hasAccess' => in_array($linkID, $permissionsArray)
        ]);
        exit;
    } catch (PDOException $ex) {

        echo json_encode([
            'success' => false,
            'error' => $ex->getMessage()
        ]);
        exit;
    } catch (Exception $ex) {

        echo json_encode([
            'success' => false,
            'error' => $ex->getMessage()
        ]);
        exit;
    }
} else {

    echo json_encode([
        'success' => false,
        'message' => 'No link provided'
    ]);
    exit;
}
