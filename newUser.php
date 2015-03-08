<?php
if(empty($_GET["username"]) || empty($_GET["password"])) {
		//GIVE AN ERROR MESSAGE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	echo"Empty";
} else {
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;	
	} else {
		echo "Connection worked! <br/>";
		$addUser = $mysqli->prepare("INSERT INTO Users(username, password, name) VALUES (?,?,?)"); 
		$addUser->bind_param("sss", $_GET["username"], $_GET["password"], $_GET["name"]);
		$addUser->execute();
		$addUser->close();
	}
}
