var updateTable =  function(){
	$.ajax({
		type: "POST",
		url: "table.php",
		success: function(data){

			console.log(data);
			var $oldTable = $("#grocery-list-table");

			$oldTable.replaceWith(data);

			bindDeleteItemClick();

		},
		error: function(data){console.log(data)}
	});
};



var bindDeleteItemClick = function(){
	var $deleteItemButtons = $(".delete-item");

	$deleteItemButtons.click(function(){
		//get the button that was actually clicked
		var $actualButton = $(this);

		var buttonID = $actualButton.val();

		$.ajax({
			type: "POST",
			url: "deleteItem.php",
			data: {"deleteid": buttonID},
			dataType: "json",
			success: function(data){

				console.log(data);
				
				//handle any errors
				if (data.success != true) {
					alert(data.error);
				} 
				//if successful
				else {
					updateTable();
				}
			},
			error: function(data){console.log(data)}
		});		
	});
};

var bindAddItemSubmit = function(){
	var $addItemForm = $("#add-item-form");
	var $errorMessage = $addItemForm.find(".error-message");

	$addItemForm.submit(function(event) {
		//get ird of default behavior (submit form)
		event.preventDefault();

		$.ajax({
			type: "POST",
			url: "addItem.php",
			data: $addItemForm.serialize(),
			dataType: "json",
			success: function(data){
				console.log(data);

				//handle any errors
				if(data.success != true) {
					$errorMessage.text(data.error);
				}
				//if successful
				else {
					//show no errors
					$errorMessage.text("");

					//update the table
					updateTable();
				}
			},
			error: function(data){console.log(data)}
		});
	});
};

$(document).ready(function(){

//delete item button
bindDeleteItemClick();

//add item form submit
bindAddItemSubmit();

//delete all button
// bindDeleteAllClick();

});