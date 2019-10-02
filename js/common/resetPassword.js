function manageModal(){
var modalDetails = getModalDetailsFromModal();
$.ajax({
        type: "POST",
        url: "/freshgrc/php/common/resetPasswordManager.php",
        data: modalDetails
    }).done(function (data) {
          swal({
              title: "Mail has been sent",
              text: "Mail has been sent with reset password link please activate it",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
                window.location="/freshgrc/index.php";
              }, 2000);
            });
    });
    
}

function getModalDetailsFromModal() {
    debugger
    var modalDetails = {
        'email': $('#email').val(),
    }
    return modalDetails;
}
function getModalDetailsFromModalForReset() {
    debugger
    var str=$('#string').val();
    var password=$('#password').val();
    var confirm=$('#confirm').val();
    if(str!=null && (password==confirm))
    {
    var modalDetails = {
        'id': $('#id').val(),
        'password':$('#password').val(),
        'email':$('#email').val()
    }

    return modalDetails;
}
else{
      swal({ 
           title:  'Either your password confirmation is incorrect or link has expired please contact the admin',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
}
}
function resetPassword(){
  var modalDetails=getModalDetailsFromModalForReset();
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/common/resetPassManager.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Mail Successfully Sent',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
    window.location= "/freshgrc/index.php";
    });

}