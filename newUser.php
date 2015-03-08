<?php
$responseToAjax = array(
	"error" => null,
	"success" => true
	);

//check for an empty username: NOT VALID
if(empty($_GET["username"])) {
	$responseToAjax["error"] = "Please enter a valid username.";
	$responseToAjax["success"] = false;
}

//check for an empty password: NOT VALID
else if (empty($_GET["password"])) {
	$responseToAjax["error"] = "Please enter a valid password.";
	$responseToAjax["success"] = false;
} 

//create new user in database
else {
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
	if ($mysqli->connect_errno) {
		$responseToAjax["error"] = "There was an issue connecting to the database:". $mysqli->connect_errno . ")" . $mysqli->connect_error;
		$responseToAjax["success"] = false;
	} else {
		$addUser = $mysqli->prepare("INSERT INTO Users(username, password, name) VALUES (?,?,?)"); 
		$addUser->bind_param("sss", $_GET["username"], $_GET["password"], $_GET["name"]);
		$addUser->execute();
		$addUser->close();
	}
}

//respond to request
echo json_encode($responseToAjax);