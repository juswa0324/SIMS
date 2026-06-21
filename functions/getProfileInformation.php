<?php
session_start();

include("../config/database.php");

if (!empty($_POST['loginid']) && isset($_POST['loginid'])) {
    try {
        $loginid = $_POST['loginid'];

        $sql = "SELECT users.*, roles.Role 
                FROM users 
                LEFT JOIN roles ON roles.id = users.RoleID 
                WHERE users.UserID = :loginid AND users.Deleted = 0";

        $query = $pdo->prepare($sql);
        $query->bindValue(":loginid", $loginid, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();

        if (!$result) {
            echo json_encode(['success' => false, 'error' => "Profile information found."]);
        }

        $data = [];
        foreach ($result as $row) {

            $row['Password'] =
                $data[] = $row;
        }

        echo json_encode(['success' => true, 'data' => $data]);
    } catch (PDOException $ex) {
        echo json_encode(['success' => false, 'error' => $ex->getMessage()]);
    } catch (Exception $ex) {
        echo json_encode(['success' => false, 'error' => $ex->getMessage()]);
    }
}
