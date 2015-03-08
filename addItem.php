<?php
session_start();

$responseToAjax = array(
	"error" => null,
	"success" => true
);

//check if session has not been started / not a valid user
if(session_status() != PHP_SESSION_ACTIVE || !isset($_SESSION['username']) ) {
	$responseToAjax["error"] = "Invalid user. Please log in.";
	$responseToAjax["success"] = false;
} 

//check if all fields have been entered to add an item
else if (!isset($_GET["addName"]) || empty($_GET["addName"]) || !isset($_GET["addUnit"]) || empty($_GET["addUnit"]) || !isset($_GET["addQuantity"]) || empty($_GET["addQuantity"])) {
	$responseToAjax["error"] = "Please enter all fields for the item.";
	$responseToAjax["success"] = false;
}

else{

	$addName = $_GET["addName"];
	$addUnit = $_GET["addUnit"];
	$addQuantity = $_GET["addQuantity"];

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
	if ($mysqli->connect_errno) {
			$responseToAjax["error"] = "There was an issue connecting to the database:". $mysqli->connect_errno . ")" . $mysqli->connect_error;
			$responseToAjax["success"] = false;
	} else {
		
		$addItem = $mysqli->prepare("INSERT INTO Groceries(name,unit,quantity) VALUES (?,?,?)"); 
		$addItem->bind_param("ssd", $addName, $addUnit, $addQuantity);
		$addItem->execute();
		$addItem->close();
	}
}

//respond to request
echo json_encode($responseToAjax);