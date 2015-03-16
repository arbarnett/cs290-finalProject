<?php

	session_start();

	$name = "";

	//check if session has not been started / not a valid user
	if(session_status() != PHP_SESSION_ACTIVE || !isset($_SESSION['userid']) ) {
		header("Location: signInPage.php");
		die();
	} 

	else{
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");
		if (!$mysqli->connect_errno) {

			$query = "SELECT username, name FROM Users WHERE id=?";

			if ($stmt = $mysqli->prepare($query)) {

				$stmt->bind_param('i', $_SESSION['userid']);

				$stmt->execute();

				$stmt->bind_result($username, $name);

				while ($stmt->fetch()) {
					$name = empty($name) ? $username : $name;
				}

				$stmt->close();
			}

			$mysqli->close();
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Grocery list</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="pull-right">
			<a href="signInPage.php">Logout </a>
		</div>

		<h1>Hello, <?=$name ?></h1>

		<div id="list-display">
			<h2>Your List:</h2>
			<?php include 'table.php';?>

		</div>

		<div id="add-item-content">
			<h2>Need Something Else?</h2>
			<form id="add-item-form" class="form-inline">
				<div class="form-group">
					<input class="form-control" type="text" name="addName" placeholder="item name"/>
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="addUnit" placeholder="unit"/>
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="addQuantity" placeholder="quantity needed"/>
				</div>
				<button class="btn btn-default" type="submit">Submit</button>
				<p class= "error-message text-danger"></p>
			</form>
		</div>

		<div>
			<h2>Got it all?</h2>
			<button class="delete-list btn btn-default">Delete List</button>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="content.js"></script>
</body>
</html>