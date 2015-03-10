<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$responseToAjax = array(
	"error" => null,
	"success" => true
	);

//check for an empty username: NOT VALID
if(empty($_POST["username"])) {
	$responseToAjax["error"] = "Please enter a valid username.";
	$responseToAjax["success"] = false;
}

//check for an empty password: NOT VALID
else if (empty($_POST["password"])) {
	$responseToAjax["error"] = "Please enter a valid password.";
	$responseToAjax["success"] = false;
} 

//create new user in database
else {
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
	if ($mysqli->connect_errno) {
		$responseToAjax["error"] = "There was an issue connecting to the database:". $mysqli->connect_errno . ")" . $mysqli->connect_error;
		$responseToAjax["success"] = false;
	} 
	else {
		//see if username is already taken
		$checkName = $mysqli->prepare("SELECT id FROM Users WHERE username= ?"); 
		$checkName->bind_param("s", $_POST["username"]);
		$checkName->execute();
		$checkName->bind_result($result);
		$checkName->fetch();

		//if username is taken, send an error 
		if ($result) {
			$checkName->close();
			$responseToAjax["error"] = "That username is already taken. Please enter a different username.";
			$responseToAjax["success"] = false;
		}

		//if username is not taken, process username
		else {
			$checkName->close();

			$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
			if ($mysqli->connect_errno) {
				$responseToAjax["error"] = "There was an issue connecting to the database:". $mysqli->connect_errno . ")" . $mysqli->connect_error;
				$responseToAjax["success"] = false;
			} 
			else {
				$addUser = $mysqli->prepare("INSERT INTO Users(username, password, name) VALUES (?,?,?)"); 
				$addUser->bind_param("sss", $_POST["username"], $_POST["password"], $_POST["name"]);
				$addUser->execute();
				$addUser->close();
			}
		}
	}
}

//respond to request
echo json_encode($responseToAjax);