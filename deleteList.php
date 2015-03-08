<?php
session_start();

$responseToAjax = array(
	"error" => null,
	"success" => true
);

//check if session has not been started / not a valid user
if(session_status() != PHP_SESSION_ACTIVE || !isset($_SESSION['userid']) ) {
	$responseToAjax["error"] = "Invalid user. Please log in.";
	$responseToAjax["success"] = false;
} 

else{
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
	if ($mysqli->connect_errno) {
		$responseToAjax["error"] = "There was an issue connecting to the database:". $mysqli->connect_errno . ")" . $mysqli->connect_error;
		$responseToAjax["success"] = false;
	} else {

	$deleteList = $mysqli->prepare("DELETE FROM Groceries"); 
	$deleteList->execute();
	$deleteList->close();

	}
}