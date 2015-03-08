<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$responseToAjax = array(
	"error" => null,
	"success" => true
);

//check for an empty username: NOT VALID
if(!isset($_GET["username"]) || empty($_GET["username"])) {
	$responseToAjax["error"] = "Please enter a valid username.";
	$responseToAjax["success"] = false;
}

//check for an empty password: NOT VALID
else if (!isset($_GET["password"]) || empty($_GET["password"])) {
	$responseToAjax["error"] = "Please enter a valid password.";
	$responseToAjax["success"] = false;
} 

//check database for username and password provided
else {
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
	if ($mysqli->connect_errno) {
		$responseToAjax["error"] = "There was an issue connecting to the database:". $mysqli->connect_errno . ")" . $mysqli->connect_error;
		$responseToAjax["success"] = false;
	} else {
		$user = $_GET["username"];
		$pwd = $_GET["password"];

		$s = $mysqli->prepare("SELECT username FROM Users WHERE username = ? AND password = ?");
		$s->bind_param("ss", $user, $pwd);
		$s->execute();
		$s->store_result();

		if($s->num_rows >= 1) {
			session_start();
			$_SESSION['username'] = $user;
		} else {
			$responseToAjax["error"] = "Not a valid username and/or password.";
			$responseToAjax["success"] = false;
		}
	}
}

//respond to request
echo json_encode($responseToAjax);

