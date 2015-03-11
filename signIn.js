//not yet a user
var bindNewUserClick = function() {
	
	var $newUserLink = $("#new-user");
	var $newUserContent = $("#new-user-content");
	var $userContent = $("#user-content");

	$newUserLink.click(function(event){
		//hide login form
		$userContent.hide();

		//show new user form
		$newUserContent.show();

		//get rid of # in url
		event.preventDefault();
	});
};	

//accidentally click new user
var bindCancelNewUserClick = function() {
	
	var $newUserLink = $("#new-user");
	var $newUserContent = $("#new-user-content");
	var $userContent = $("#user-content");
	var $cancelNewUserLink = $("#cancel-new-user");

	$cancelNewUserLink.click(function(event){
		//hide new user form
		$newUserContent.hide();

		//show login form
		$userContent.show();

		//get rid of # in url
		event.preventDefault();
	});
};	
	
//new user submits information
var bindNewUserSubmit = function() {
	
	var $newUserForm = $("#new-user-form");
	var $userContent = $("#user-content");
	var $newUserContent = $("#new-user-content");
	var $errorMessage = $newUserForm.find(".error-message");
	var $successMessage = $userContent.find(".success-message");

	$newUserForm.submit(function(event){
		
		//get rid of default behavior (submit form)
		event.preventDefault();
   
		$.ajax({
			type: "POST",
			url: "newUser.php",
			data: $newUserForm.serialize(),
			dataType: "json",
			success: function(data){

				console.log(data);
				
				//handle any errors
				if (data.success != true) {
					$errorMessage.text(data.error);
				} 
				//if successful
				else {
					//show no errors
					$errorMessage.text("");
					
					//tell user they were successful
					$successMessage.text("Thanks for signing up! Please log in.");

					//hide new user form
					$newUserContent.hide();

					//display login form
					$userContent.show();

				}
			},
			error: function(data){console.log(data)}
		});
	});
};	

//current user: login and check credentials
var bindLoginSubmit = function() {
	
	var $loginForm = $("#login-form");
	var $errorMessage = $loginForm.find(".error-message");

	$loginForm.submit(function(event){

		//get rid of default behavior (submit form)
		event.preventDefault();

		$.ajax({
			type: "POST",
			url: "login.php",
			data: $loginForm.serialize(),
			dataType: "json",
			success: function(data){
				
				console.log(data);
				
				//handle any errors
				if (data.success != true) {
					$errorMessage.text(data.error);
				}
				//if successful
				else{
					//show no errors
					$errorMessage.text("");

					//redirect user to content page
					window.location = "content.php";
				}
			}
		});
	});
};
	

		
$(document).ready(function(){
	
	//bind not yet a user click
	bindNewUserClick();
	
	//bind accidental new user click
	bindCancelNewUserClick();

	//bind new user submit 
	bindNewUserSubmit();
	
	//bind login submit
	bindLoginSubmit();

});
