<?php

session_start();

$responseToAjax = array(
	"error" => null,
	"success" => true,
	"list" => null
);

//check if session has not been started / not a valid user
if(session_status() != PHP_SESSION_ACTIVE || !isset($_SESSION['userid']) ) {
	$responseToAjax["error"] = "Invalid user. Please log in.";
	$responseToAjax["success"] = false;
} 

else {
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
	if ($mysqli->connect_errno) {
    	$responseToAjax["error"] = "There was an issue connecting to the database:". $mysqli->connect_errno . ")" . $mysqli->connect_error;
		$responseToAjax["success"] = false;
	}
	else {

		$query = "SELECT id, name, unit, quantity FROM Groceries WHERE userId = '". $_SESSION['userid']."'";

		if($result = $mysqli->query($query)) {
			$responseToAjax["list"] = array();

			while ($row = $result->fetch_row()) {
				$responseToAjax["list"][]=array(
					"id" => $row[0],
					"name" => $row[1],
					"unit" => $row[2],
					"quantity" => $row[3]
					);
			}
		}

		$result->close(); 
	}	
}

//respond to request
echo json_encode($responseToAjax);