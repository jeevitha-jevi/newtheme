$(document).ready(function() {

	debugger
	var userCredentials={'user_id':loggedInUser}
	  $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/common/manageFeed.php",
        data: userCredentials,
        success: success
    });




});