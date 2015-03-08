<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
//check if username and password are empty
if(empty($_GET["username"]) || empty($_GET["password"])) {
		//GIVE AN ERROR MESSAGE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	echo "Empty!";
} else {
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;	
	} else {
		echo "Connection worked! <br/>";
		$user = $_GET["username"];
		$pwd = $_GET["password"];

		$s = $mysqli->prepare("SELECT username FROM Users WHERE username = ? AND password = ?");
		$s->bind_param("ss", $user, $pwd);
		$s->execute();
		$s->store_result();

		if($s->num_rows >= 1) {
			//User successfully logged in
			echo "User logged in!";
		} else {
			//User not successfully authenticated
			echo "Not a user!";

		}
	}
}

