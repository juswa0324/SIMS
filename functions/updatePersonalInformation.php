<?php

session_start();

include("../config/database.php");

try {

    $pdo->beginTransaction();

    $required = [
        'loginid',
        'roleid',
        'firstname',
        'lastname',
        'email',
        'department',
        'position',
    ];

    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            throw new Exception(ucfirst($field . "is required"));
        }
    }

    $loginid = $_POST['loginid'];
    $roleid = $_POST['roleid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $position = $_POST['position'];

    $userSql = "UPDATE users 
            SET Firstname = :firstname, 
                Lastname = :lastname, 
                Email= :email,
                Department = :department
            WHERE UserID  = :loginid AND Deleted = 0";

    $userQuery = $pdo->prepare($userSql);
    $userQuery->bindValue(':loginid', $loginid, PDO::PARAM_INT);
    $userQuery->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $userQuery->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $userQuery->bindValue(':email', $email, PDO::PARAM_STR);
    $userQuery->bindValue(':department', $department, PDO::PARAM_STR);
    $userQuery->execute();

    $roleSql = "UPDATE roles 
            SET Role = :position 
            WHERE id  = :roleid AND Deleted = 0";

    $roleQuery = $pdo->prepare($roleSql);
    $roleQuery->bindValue(':roleid', $roleid, PDO::PARAM_INT);
    $roleQuery->bindValue(':position', $position, PDO::PARAM_STR);
    $roleQuery->execute();

    $pdo->commit();

    echo json_encode(['success' => true]);
} catch (PDOException $ex) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'error' => $ex->getMessage()]);
} catch (Exception $ex) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'error' => $ex->getMessage()]);
}
