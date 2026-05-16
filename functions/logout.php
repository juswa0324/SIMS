<?php

session_start();

include ('functions.php');


// audit_logs($_SESSION["fname"] . " " . $_SESSION["lname"], "Logout", "", "");



//Clear Session

$_SESSION["LoginID"] = "";

session_destroy();



header("Location: ../index.php");

exit();

?>