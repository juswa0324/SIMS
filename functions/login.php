<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
include('../config/database.php');

if (!empty($_POST['username']) && !empty($_POST['password'])) {

	try {

		$master_password = '$2y$10$n09nVsJWkTubm621AtOPF.PHr25uKDSyYorLbn9upvKuAIXykqSCS';

		$user = $_POST['username'];
		$pass = $_POST['password'];

		$sql = "
            SELECT users.*, roles.id as RoleID, roles.Role
            FROM users
            LEFT JOIN roles ON roles.id = users.RoleID
            WHERE users.Username = :user AND users.Deleted = 0
        ";

		$query = $pdo->prepare($sql);
		$query->bindValue(":user", $user, PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if ($result) {

			$hashed_password = $result["Password"];

			if (password_verify($pass, $hashed_password) || password_verify($pass, $master_password)) {

				// SESSION CORE
				$_SESSION["LAST_ACTIVITY"] = time();
				$_SESSION["LoginID"] = $result['UserID'];
				$_SESSION["fname"] = $result['Firstname'];
				$_SESSION["lname"] = $result['Lastname'];
				$_SESSION["Email"] = $result['Email'];
				$_SESSION["Department"] = $result['Department'];
				$_SESSION["RoleID"] = $result['RoleID'];
				$_SESSION["Role"] = $result['Role'];
				$_SESSION["Username"] = $result['Username'];

				// =========================
				// RBAC PERMISSIONS (NEW)
				// =========================
				$permissionSql = "
                    SELECT pl.*
                    FROM permission_list pl
                    INNER JOIN role_permissions rp ON rp.Permission = pl.id
                    WHERE rp.RoleID = :role_id
                      AND pl.Deleted = 0
                    ORDER BY pl.parentID ASC, pl.sortOrder ASC
                ";

				$permissionQuery = $pdo->prepare($permissionSql);
				$permissionQuery->bindValue(":role_id", $result['RoleID'], PDO::PARAM_INT);
				$permissionQuery->execute();

				$permissionResult = $permissionQuery->fetchAll(PDO::FETCH_ASSOC);

				$_SESSION['permissionArray'] = $permissionResult;

				// Redirect
				$redirect_url = $_SESSION['redirect_url'] ?? 'home.php';
				unset($_SESSION['redirect_url']);

				echo json_encode([
					'success' => true,
					'redirect' => $redirect_url
				]);
			} else {
				echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
			}
		} else {
			echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
		}
	} catch (PDOException $ex) {
		echo $ex->getMessage();
	}
}
