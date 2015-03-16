<?php
	
	session_start();

	//check if session has not been started / not a valid user
	if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['userid']) ) {
		unset($_SESSION['userid']);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome!</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<style>
		#new-user-content{display: none;}
	</style>
</head>
<body>
	<div class="container">
		<h1>Hey!</h1>
		<p class="lead">Welcome to your grocery list helper! Make your list, add to it whenever, and delete items as you put them in your cart!</p>

		<div id="user-content">
			<p class="success-message text-success"></p>
			<form id="login-form" class="form-inline">
				<div class="form-group">
					<input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off"/>
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="password" placeholder="Password" autocomplete="off"/>
				</div>
				<button class="btn btn-default" type="submit">Submit</button>
				<p class="error-message text-danger"> </p>
			</form>

			<a href="#" id="new-user">Not yet a user?</a>
		</div>

		<div id="new-user-content">
			<form id="new-user-form" class="form-inline">
				<div class="form-group">
					<label>Username*:</label>
					<input class="form-control" type="text" name="username" autocomplete="off" />
				</div>
				<br>
				<br>
				<div class="form-group">
					<label>Password*:</label>
					<input class="form-control" type="password" name="password" autocomplete="off" />
				</div>
				<br>
				<br>
				<div class="form-group">
					<label>Name:</label>
					<input class="form-control" type="text" name="name" />
				</div>
				<p>*required</p>
				<button class="btn btn-default" type="submit">Submit</button>
				<p class="error-message text-danger"></p>
			</form>

			<a href="#" id="cancel-new-user">Whoops, I am a user! Go back.</a>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="signIn.js"></script>
</body>
</html>