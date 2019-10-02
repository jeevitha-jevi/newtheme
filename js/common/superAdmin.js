function checkUserMail(){
    
    var userMail = {               
        'usermail': $('#usermail').val()                  
    }    
    return $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/common/manageSuperAdmin.php",
        data: userMail,
        success: success
    });
    location.reload();
}
function success(data){
    
    if (data != null) {
                window.location="https://freshgrc.com/freshgrc/login.php";       

    }
    else{
                alert("Email-id is incorrect");
    }

}
