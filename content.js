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


$(document).ready(function(){

//delete item button
bindDeleteItemClick();

//add item form submit
// bindAddItemSubmit();

//delete all button
// bindDeleteAllClick();

});