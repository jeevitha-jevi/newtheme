$(document).ready(function () { 
//   $(document).on('click', '.edit_data', function(){
//        var editprofiledetid = $('#loggedInUser').val();
//       $.ajax({
//     method :'POST',
//     url : "/freshgrc/php/user/userProfileData.php",
//     data :{userId:editprofiledetid},
//     dataType:"json",
//     success:function(data){
//       var userprofileData = data;
//       $('#fname').val(userprofileData[0].firstName);
//       $('#lname').val(userprofileData[0].lastName);
//       $('#mno').val(userprofileData[0].MobileNumber);
//       $('#website').val(userprofileData[0].Site);
//       $('#it').val(userprofileData[0].Industry);
//       $('#fb').val(userprofileData[0].Facebook);
//       $('#twitt').val(userprofileData[0].Twitter);
//       $('#upid').val(userprofileData[0].UserId);
// }
// });
//   });
//   $(document).on('click', '.update', function(){
//     var updateprofiledetid = $('#upid').val();
//     var valupd1 = $('#fname').val();
//     var valupd2 = $('#lname').val();
//     var valupd3 = $('#mno').val();
//     var valupd4 = $('#website').val();
//     var valupd5 = $('#it').val();
//     var valupd6 = $('#fb').val();
//     var valupd7 = $('#twitt').val();
//     if(valupd1 == "")
//     {
//       alert("Required First Name");
//       return false;
//     }
//     if(valupd2 == "")
//     {
//       alert("Required Last Name");
//       return false;
//     }
//     if(valupd3 == "")
//     {
//       alert("Required Mobile Number");
//       return false;
//     }
//     if(valupd4 == "")
//     {
//       alert("Required Website");
//       return false;
//     }
    
//     if(valupd5 == "")
//     {
//       alert("Required Industry");
//       return false;
//     }
//     if(valupd1 != '')
//   {
//     var regexname = /^[a-zA-Z\s]+$/;
//     if(!regexname.test(valupd1)) {
//       alert("Invalid First Name");
//       $('#fname').val('');
//       return false;
//   }
// }
// if(valupd2 != '')
//   {
//     var regexname =/^[a-zA-Z\s]+$/;
//     if(!regexname.test(valupd2)) {
//       alert("Invalid Last Name");
//       $('#lname').val('');
//        return false;
//   }
// }
// if(valupd3 != '')
//   {
//     var regexname =/^\d{10}$/;
//     if(!regexname.test(valupd3)) {
//       alert("Invalid Mobile Number");
//       $('#mno').val('');
//       return false;
//   }
// }
// if(valupd4 != '')
//   {
//     var regexname =/^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
//     if(!regexname.test(valupd4)) {
//       alert("Invalid Website");
//       $('#website').val('');
//       return false;
//   }
// }
//  var userDetails1 = getUserprofileDetailsFromModal(); 
//     $.ajax({
//     method :'POST',
//     url : "/freshgrc/php/user/manageUserProfile.php",
//     data :userDetails1,
//     success:function(){
//       location.reload();
//       alert("Profile Account Updated Successfully");
//       // var userprofileData = data;
//       // $('#fname').val(userprofileData[0].firstName);
//       // $('#lname').val(userprofileData[0].lastName);
//       // $('#mno').val(userprofileData[0].MobileNumber);
//       // $('#website').val(userprofileData[0].Site);
//       // $('#it').val(userprofileData[0].Industry);
//       // $('#fb').val(userprofileData[0].Facebook);
//       // $('#twitt').val(userprofileData[0].Twitter);
//       // $('#upid').val(userprofileData[0].UserId);
// }
// });
//   });

    $.ajax({
      dataType: "json",
      url: "/freshgrc/php/common/totalProjects.php",
      data: "",                                                                         
      success: function(data){        
        document.getElementById("totaladminprojects").innerHTML=data[0].total_projects;
      }
    });
    $.ajax({
      dataType: "json",
      url: "/freshgrc/php/common/totalAuditProjects.php",
      data: "",                                                                         
      success: function(data){        
        document.getElementById("totalauditprojects").innerHTML=data[0].total_projects;
      }
    });
    $.ajax({
      dataType: "json",
      url: "/freshgrc/php/common/totalTasks.php",
      data: "",                                                                         
      success: function(data){        
        document.getElementById("totaladmintasks").innerHTML=data[0].total_tasks;
      }
    });
    $.ajax({
      dataType: "json",
      url: "/freshgrc/php/common/totalAuditTasks.php",
      data: "",                                                                         
      success: function(data){        
        document.getElementById("totalaudittasks").innerHTML=data[0].total_tasks;
      }
    });
    $.ajax({
      dataType: "json",
      url: "/freshgrc/php/common/totalRiskProjects.php",
      data: "",                                                                         
      success: function(data){        
        document.getElementById("totalriskprojects").innerHTML=data[0].total_projects;
      }
    });
    $.ajax({
      dataType: "json",
      url: "/freshgrc/php/common/totalRiskTasks.php",
      data: "",                                                                         
      success: function(data){        
        document.getElementById("totalrisktasks").innerHTML=data[0].total_tasks;
      }
    });

    $.ajax({
      dataType: "json",
      url: "/freshgrc/php/common/totalCompProjects.php",
      data: "",                                                                         
      success: function(data){        
        document.getElementById("totalcompprojects").innerHTML=data[0].total_projects;
      }
    });
    $.ajax({
      dataType: "json",
      url: "/freshgrc/php/common/totalCompTasks.php",
      data: "",                                                                         
      success: function(data){        
        document.getElementById("totalcomptasks").innerHTML=data[0].total_tasks;
      }
    });

    $.ajax({
      dataType: "json",
      url: "/freshgrc/php/common/totalUploads.php",
      data: "",                                                                         
      success: function(data){
        document.getElementById("totaluploads").innerHTML=data[0].total_uploads;
      }
    });   
    var upload = document.getElementById("upload");

    if(upload){
    upload.addEventListener("change", handleFiles, false);
    function handleFiles() { 
      var files = this.files;
      console.log(files);
      for (var i = 0; i < files.length; i++) {    
        var file = files[i];
        var imageType = /^image\//;
      
        var myFormData = new FormData();
        var userFileId = document.getElementById('upload');

        myFormData.append('userFile', userFileId.files[0]);    
        var fileName = userFileId.files[0].name;

        $('#userFileName').val(fileName);

        $.ajax({
          url: "/freshgrc/php/common/fileMgmt.php",
          type: "POST",
          processData: false, // important
          contentType: false, // important
          data: myFormData,
          success: function (data) {
              
          }
        });

      }
    }
    }
    var userCredentials = {
        'userId' : $('#loggedInUser').val(),
        'userRole' : $('#User').val(),
    }
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/user/userProfileData.php",
        data: userCredentials,
        success: userPic
    });  

});

function userPic(data) { 
 
    var userData = data;
    $('#firstname').val(userData[0].firstName);
     $('#lastname').val(userData[0].lastName);
    $('#mobileno').val(userData[0].MobileNumber);
    $('#facebook').val(userData[0].Facebook);
    $('#industry').val(userData[0].Industry);
    $('#twitter').val(userData[0].Twitter);
    $('#site').val(userData[0].Site);
    var imageSrc = "uploadedFiles/auditeeFiles/"+userData[0].file;
    var input = document.getElementById('userprofilepicture');
    input.src = imageSrc; 
       
}

function getUserDetailsFromModal() {    
    var action = "update";
    var userDetails = {  
        'action': action,     
        'firstname': $('#firstname').val(),
        'lastname': $('#lastname').val(),
        'mobileno': $('#mobileno').val(),
        'site': $('#site').val(),
        'industry': $('#industry').val(),
        'facebook': $('#facebook').val(),
        'twitter': $('#twitter').val(),
        'loggedInUser': $('#loggedInUser').val(), 
        'User': $('#User').val(),     
                
    }
    return userDetails;
}

function saveUserProfileChanges() {  
  var valup1 = $('#firstname').val();
    var valup2 = $('#lastname').val();
    var valup3 = $('#mobileno').val();
    var valup4 = $('#site').val();
    var valup5 = $('#industry').val();
    var valup6 = $('#facebook').val();
    var valup7 = $('#twitter').val();
    if(valup1 == "")
    {
      alert("Required First Name");
      return false;
    }
    if(valup2 == "")
    {
      alert("Required Last Name");
      return false;
    }
    if(valup3 == "")
    {
      alert("Required Mobile Number");
      return false;
    }
    if(valup4 == "")
    {
      alert("Required Website");
      return false;
    }
    
    if(valup5 == "")
    {
      alert("Required Industry");
      return false;
    }
    if(valup1 != '')
  {
    var regexname = /^[a-zA-Z\s]+$/;
    if(!regexname.test(valup1)) {
      alert("Invalid First Name");
      $('#firstname').val('');
      return false;
  }
}
if(valup2 != '')
  {
    var regexname =/^[a-zA-Z\s]+$/;
    if(!regexname.test(valup2)) {
      alert("Invalid Last Name");
      $('#lastname').val('');
       return false;
  }
}
if(valup3 != '')
  {
    var regexname =/^\d{10}$/;
    if(!regexname.test(valup3)) {
      alert("Invalid Mobile Number");
      $('#mobileno').val('');
      return false;
  }
}
if(valup4 != '')
  {
    var regexname =/^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
    if(!regexname.test(valup4)) {
      alert("Invalid Website");
      $('#site').val('');
      return false;
  }
}
 var userDetails = getUserDetailsFromModal();  
    
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/user/manageUserProfile.php",
        data: userDetails
    }).done(function (data) {
      location.reload();
      alert("Profile Account Created Successfully");
  //window.location.href = "/freshgrc/view/common/profiletable.php";
        // details = document.querySelectorAll("#savedDataModal p");
        // details[0].innerHTML = userDetails['firstname'];
        // details[1].innerHTML = userDetails['lastname'];
        // details[2].innerHTML = userDetails['mobileno'];
        // details[3].innerHTML = userDetails['site'];
        // details[4].innerHTML = userDetails['industry'];
        // details[5].innerHTML = userDetails['facebook'];
        // details[6].innerHTML = userDetails['twitter'];
        // $('#savedDataModal').modal('show');
    });

}

function reloadPage() {
    location.reload();
}

function saveUserProfilePicture() { 

   var action = "update"; 
   var valup2 = $('#userFileName').val();
   var image_extension=valup2.split('.').pop().toLowerCase();
   if(jQuery.inArray(image_extension,['gif','png','jpg','jpeg']) == -1)
   {
    alert("invalid image file");
    $('#upload').val('');
    $('#previewimage').val('');
    return false;
   }
   var userProfilePicture = {
        'action': action, 
        'imagename': $('#userFileName').val(),
        'loggedInUser': $('#loggedInUser').val()
   } 
  
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/user/manageUserProfile.php",
        data: userProfilePicture
    }).done(function (data) {         
       location.reload();
    });  

}
function setPriorityAndSeverity(){
  
  var modalDetails ={
    'priority':$('#priority').val(),
    'severity':$('#severity').val(),
    'severityMed':$('#severityMed').val(),
    'priorityMed':$('#priorityMed').val(),
    'priorityHigh':$('#priorityHigh').val(),
    'severityHigh':$('#severityHigh').val(),
    'company':$('#company').val(),
    'loggedInUser':$('#loggedInUser').val()
  }
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/common/setPriorityAndSeverity.php",
        data: modalDetails
    }).done(function (data) {         
        swal({ 
           title:  'Priority and Severity set',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'OK'
        });
    });
} 

function reloadpage() {
$('#button').click(function() {
    location.reload();
});
}



function getUserprofileDetailsFromModal() {    
    var action = "update";
    var userDetails1 = {  
        'action': action,     
        'firstname': $('#fname').val(),
        'lastname': $('#lname').val(),
        'mobileno': $('#mno').val(),
        'site': $('#website').val(),
        'industry': $('#it').val(),
        'facebook': $('#fb').val(),
        'twitter': $('#twitt').val(),
        'loggedInUser': $('#upid').val(),     
                
    }
    return userDetails1;
}

