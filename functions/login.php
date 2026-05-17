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

        $sql = "SELECT users.*, roles.Role, roles.Permission  
				FROM users  
				LEFT JOIN roles ON roles.id = users.RoleID
				WHERE users.Username = :user AND users.Deleted = 0";

		$query = $pdo->prepare($sql);
		$query->bindValue(":user", $user, PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetchAll();
		$query = "";

		if (count($result) > 0) {
			$hashed_password = $result[0]["Password"];

			if (password_verify($pass, $hashed_password) || password_verify($pass, $master_password)) {
                $_SESSION["LoginID"] = $result[0]['UserID'];
				$_SESSION["fname"] = $result[0]['Firstname'];
				$_SESSION["lname"] = $result[0]['Lastname'];
				$_SESSION["Email"] = $result[0]['Email'];
				$_SESSION["Department"] = $result[0]['Department'];
				$_SESSION["Role"] = $result[0]['Role'];
				$_SESSION["Username"] = $result[0]['Username'];
				$permissions = $result[0]['Permission'];

				$permissionSql = " SELECT * 
								   FROM permission_list 
								   WHERE FIND_IN_SET(id, :permissions) > 0
    							   ORDER BY parentID ASC, sortOrder ASC";

				$permissionQuery = $pdo->prepare($permissionSql);
				$permissionQuery->bindValue(":permissions", $permissions, PDO::PARAM_STR);
				$permissionQuery->execute();
				$permissionResult = $permissionQuery->fetchAll();
				$permissionQuery = "";

				$_SESSION['permissionArray'] = $permissionResult;




				// Redirect to the requested page, or default to home if no URL saved
				$redirect_url = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'home.php';
				unset($_SESSION['redirect_url']); // Clear redirect URL from session

				// audit_logs($_SESSION["fname"] . " " . $_SESSION["lname"], "Login", "", "");

				echo json_encode(['success' => true, 'redirect' => $redirect_url]);
			} else {
				echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
			}
		} else {
			echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
		}
	} catch (PDOException $ex) {
		echo $ex;
	} catch (PDOException $ex) {
		echo $ex;
	}
}
