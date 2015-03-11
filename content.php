<!DOCTYPE html>
<html>
<head>
	<title>Grocery list</title>
</head>
<body>
	<div class= "float-right">
		<a href="signInPage.html">Logout </a>
	</div>

	<h1>Hello,</h1>

	<div id="list-display">
		<h2>Your List:</h2>
	<?php include 'table.php';?>

	</div>

	<div id="add-item">
		<h2>Need Something Else?</h2>
		<form>
		<input type="text" name="name" placeholder="item name"/>
		<input type="text" name="unit" placeholder="unit"/>
		<input type="text" name="quantity" placeholder="quantity needed"/>
		<input type="submit" value="submit"/>
		</form>
	</div>

	<div id="delete-list">
		<h2>Got it all?</h2>
		<input type="hidden" name="deleteList" value="Delete List"/>
		<input type="submit" value="Delete List"/>
		</form>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="content.js"></script>
</body>
</html>