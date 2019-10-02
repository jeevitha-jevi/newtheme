var modalDetails;

//alert(user);

// function call(){
// setInterval(function(){chatHistory(user)},1000);
// }


function saveuserChat() {
    debugger;
 
            // document.getElementById("user-"+sender_id).appendChild(para);
  var action = "saveChatDetails";
 modalDetails = {
          // 'Id': $('#chatid').val(),
        'senderId': $('#loggedInUser').val(),
        'message': $('#usermessage').val(),
        'receiverId': $('#userid').val(),
        'action': action,
      
    }
    
    debugger


   // var foo1=document.createElement("DIV");
   //      foo1.setAttribute("id","senduser"+data);
   //      foo1.className = "post out";
   //      var message_received=document.createTextNode(modalDetails.message);
   //      //foo1.innerHTML=modalDetails.message;
   //      foo1.appendChild(message_received);
   //      var foo2=document.getElementById("userid"+modalDetails.receiverId);
     /* para.setAttribute("id", "senduser");
    para.className = "post out";*/
/*
    var message_received = document.createTextNode(modalDetails.message);
    para.appendChild(message_received);
    document.getElementById("senduser").appendChild(para);*/
    // var foo = document.getElementById("senduser");
    // foo.appendChild(para); 
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/common/chatManager.php",
        data: modalDetails,
        success:function(data){
          $('#usermessage').val("");
          UsersForid(user);

        }
         });
  // callback(modalDetails);
}
function getUserDetails() {
    $('#action').val('create');
       
}

function UsersForid(userid) {
    debugger;
var senderid = document.getElementById("userid"+userid).value;
       // = $('#userid').val();
    var modalDetails={'userId':senderid};
    // var modalDetails = getUserDetails();  

  $.ajax({
        type: "POST",
        url: "/freshgrc/view/common/ChatTemplete.php",
        data: modalDetails,
         success:function(data){
            $('#chatTemplate').html(data);
        }
        });
  user=userid;
 
}

 setInterval(function(){UsersForid(user)},1000);




// function chatHistory(userid) {
//     debugger;
//     // var modalDetails = getDetailsForChat();
//     // UsersForid(userid);
//     var senderid = document.getElementById("userid"+userid).value;
//  var modalDetails = {
//         'senderId': $('#loggedInUser').val(),
//         'receiverId': senderid,
//         'action':"getChatHistory"
          
//     }   
//   $.ajax({
//      dataType: "json",
//         type: "POST",
//         url: "/freshgrc/php/common/chatManager.php",
//         data: modalDetails,
//         success:function(data){

//           console.log(data);
//         }
//         });
//   user=userid;
  
// }




// function saveChat() {
//     debugger;
//     var modalDetails = getDetailsForChat();   
//   $.ajax({
//         type: "POST",
//         url: "/freshgrc/php/common/saveChat.php",
//         data: modalDetails,
//         success:function(data){
//           UsersForid(user);

//         }
//         });
// }
// function UsersForChat() {
//     debugger;
//     var modalDetails = getUserDetails();   
//   $.ajax({
//         type: "POST",
//         url: "/freshgrc/php/common/chatManager.php",
//         data: modalDetails
//         });
// }



 // function callback(data) { 
 //    debugger
 //        //vm.text.push(message.message);
 //   /*     var para = document.createElement("DIV");
 //     para.setAttribute("id", "senduser"+data);
 //          para.className = "post out";*/
 //        /*var message_received = document.createTextNode("new message");
 //        para.appendChild(message_received);*/
       
 //        var foo1=document.createElement("DIV");
 //        foo1.setAttribute("id","senduser"+data);
 //        foo1.className = "post out";
 //        var message_received=document.createTextNode(modalDetails.message);
 //        //foo1.innerHTML=modalDetails.message;
 //        foo1.appendChild(message_received);
 //        var foo2=document.getElementById("userid"+modalDetails.receiverId);
 //         //var message_received=document.createTextNode(modalDetails.message);
 //         //foo1.appendChild(message_received);
 //         // var tempid=data-1;
 //         //var foo2 = document.getElementById("senduser"+data);
 //       //var foo1 = document.getElementById("receiveuser"+data);
 //          foo2.appendChild(foo1);
 //           var node = document.createElement("DIV");
 //    var textnode = document.createTextNode(modalDetails.message);
 //    node.appendChild(textnode);
 //    document.getElementById("senduser").appendChild(node);
 //      }

