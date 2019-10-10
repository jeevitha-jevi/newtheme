function managemodal(){
var modalDetails = getModalDetailsFromModal();
$.ajax({
        type: "POST",
        url: "/freshgrc/php/common/resetPasswordManager.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
              title: "Mail has been sent",
              text: "Mail has the password reset link please activate it",
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