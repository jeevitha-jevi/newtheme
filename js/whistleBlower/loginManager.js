function checkUserCompany(){
    debugger
   
    var userMail = {               
        'company_search': $('#company_search').val()                  
    }    
    return $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/common/whistleLoginManager.php",
        data: userMail,
        success: success
    });
}
function success(data){
    debugger
   
    if (data == null) {
       
        alert("company name is incorrect");
    }
    else{
        location.href="view/whistleBlower/issue.php"; 
    }
}
