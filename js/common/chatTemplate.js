

user = $('#userid').val();


function chatHistory(userid) {
    debugger;
    // var modalDetails = getDetailsForChat();
    // UsersForid(userid);
    var senderid = document.getElementById("userid"+userid).value;
 var modalDetails = {
        'senderId': $('#loggedInUser').val(),
        'receiverId': senderid,
        'action':"getChatHistory"
          
    }   
  $.ajax({
     dataType: "json",
        type: "POST",
        url: "/freshgrc/php/common/chatManager.php",
        data: modalDetails,
        success:function(data){

          console.log(data);
        }
        });
  user=userid;
}


//setInterval(function(){chatHistory(user)},1000);