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

//check if all fields have been entered to add an item
else if (!isset($_POST["addName"]) || empty($_POST["addName"]) || !isset($_POST["addUnit"]) || empty($_POST["addUnit"]) || !isset($_POST["addQuantity"]) || empty($_POST["addQuantity"])) {
	$responseToAjax["error"] = "Please enter all fields for the item.";
	$responseToAjax["success"] = false;
}

//check if quantity is numeric
else if (! is_numeric($_POST["addQuantity"]) || $_POST["addQuantity"]<0) {
	$responseToAjax["error"] = "You must enter a valid number for Quantity.";
	$responseToAjax["success"] = false;	
}

else{

	$addName = $_POST["addName"];
	$addUnit = $_POST["addUnit"];
	$addQuantity = $_POST["addQuantity"];

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
	if ($mysqli->connect_errno) {
			$responseToAjax["error"] = "There was an issue connecting to the database:". $mysqli->connect_errno . ")" . $mysqli->connect_error;
			$responseToAjax["success"] = false;
	} else {
		
		$addItem = $mysqli->prepare("INSERT INTO Groceries(userId,name,unit,quantity) VALUES (?,?,?,?)"); 
		$addItem->bind_param("issd", $_SESSION['userid'], $addName, $addUnit, $addQuantity);
		$addItem->execute();
		$addItem->close();
	}
}

//respond to request
echo json_encode($responseToAjax);