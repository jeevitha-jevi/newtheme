
function getModalDetailsFromModal() {
    
    var modalDetails = {
        'name': $('#name').val(),
        'email': $('#email').val(),
        'password': $('#password').val(),
        'company': $('#company').val(),
        'number': $('#number').val(),
        'plan':$('#plan').val()
        
    }
    return modalDetails;
}

function manageModal() {

 var modalDetails = getModalDetailsFromModal();
    if(modalDetails.name==""||modalDetails.company==""||modalDetails.password==""||modalDetails.email==""||modalDetails.number==""){
        swal.fire({ 
           title:  'Please Fill all the form fields',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
        });
    }
   else
  {    
    $.ajax({
          type: "POST",
          url: "/newtheme/php/common/validationForSignup.php",
          data: modalDetails,
          success: success
     });
  }
}


function success(data) {
  debugger
  var modalDetails = getModalDetailsFromModal();
  console.log(data);
  if(data=="")
  {
    $.ajax({
          type: "POST",
        url: "/newtheme/php/common/signupCtrlManager.php",
        data: modalDetails        
    }).done(function (data) {
         swal.fire({ 
           title:  'Congrats From FixNix Your account has been created. If you need any help contact sales@fixnix.co',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'          
        });
setTimeout(function () { location.reload(1); }, 5000);
    });
              // window.location.href="/freshgrc/login.php";

  }
  else
  {
    swal.fire({ 
           title:  'Mail Id or Company is already taken',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
        });

  }
}



function updatePlan(){
  
    var modalDetails= {
      'company':$('#company').val(),
      'plan':$('#plan').val()
    }
    $.ajax({
          type: "POST",
        url: "/newtheme/php/common/subscriptionControlManager.php",
        data: modalDetails        
    }).done(function (data) {
         
       //window.location="/view/common/subscriptionCreate.php";
    });
}
