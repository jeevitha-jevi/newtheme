$(document).ready(function() {
    
    var companyName=$('#company').val();
    var modalDetails={'id':companyName};
     $.ajax({
        type: "POST",
        url: "/newtheme/view/common/locationDropdown.php",
        data: modalDetails,
        success:locationDropDown
    });
  $('#auditTyp').val('External');

$(".datepickerClass").each(function() {
        $(this).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099"  
        });
    }); 

 $('#frequency input[type=radio]').change(function(){
      $('#auditFreq').val( $(this).val()); 
      
      });
  $(".deselectRadioButton").click( function(e){
      if($(this).hasClass("on")){
         $(this).removeAttr('checked');
         $('#auditFreq').val("once");
      }
      $(this).toggleClass("on");
  }).find(":checked").addClass("on");



 });

function showModal(isUpdate) {
    $('#myModal').modal('show');
    if (isUpdate) {
        prepareModalForUpdate();
    } else {
        $('#action').val('create');
    }
}
 function auditType()
{
    
    
if( $('#auditTypeToggle').prop('checked'))
   {
       $('#auditTyp').val("Internal");
     
   }
   else{
     $('#auditTyp').val("External");  
   }
   
}

function auditFreq(value)
{
    

       $('#auditFreq').val(value);
       //manageModal();
       switch(value){
        case "weekly":
          document.getElementById("weekly").style.backgroundColor="green";
          document.getElementById("Monthly").style.backgroundColor="#204d74";
          document.getElementById("Quarterly").style.backgroundColor="#208992";
          document.getElementById("yearly").style.backgroundColor="#ed6b75";
          break;
        case "monthly":
          document.getElementById("weekly").style.backgroundColor="#F1C40F";
          document.getElementById("Monthly").style.backgroundColor="green";
          document.getElementById("Quarterly").style.backgroundColor="#208992";
          document.getElementById("yearly").style.backgroundColor="#ed6b75";
          
          break;
        case "quarterly":
          document.getElementById("weekly").style.backgroundColor="#F1C40F";
          document.getElementById("Monthly").style.backgroundColor="#204d74";
          document.getElementById("Quarterly").style.backgroundColor="green";
          document.getElementById("yearly").style.backgroundColor="#ed6b75";
          
          break;
        case "yearly":
          document.getElementById("weekly").style.backgroundColor="#F1C40F";
          document.getElementById("Monthly").style.backgroundColor="#204d74";
          document.getElementById("Quarterly").style.backgroundColor="#208992";
          document.getElementById("yearly").style.backgroundColor="green";
          break;
            
       }
     
  
   //return auditType;
}

function prepareModalForUpdate() {
    var selectedData = table.rows('.selected').data();
    $('#manageButton').text('Update');
    $('#action').val('update');
}

function getModalDetailsFromModal() {
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'auditTitle': $('#auditTitle').val(),
        'action': $('#action').val(),
        'company': $('#company').val(),
        'compliance': $('#compliance').val(),
        'auditType': $('#auditTyp').val(),
        'auditFreq': $('#auditFreq').val(),
        'auditDesc': $('#auditDesc').val(),
        // 'auditProcedure': $('#auditProcedure').val(),
        'start_date': $('#start_date').val(),
        'end_date': $('#end_date').val(),
        'auditor': $('#auditor').val(),
        'auditee': $('#auditee').val(),
        'location':$('#location').val(),
        'department':$('#department').val(),
        'parentAudit':$('#parentAudit').val()
    }
    return modalDetails;
}

function manageModal() {
    
    
    var modalDetails = getModalDetailsFromModal();
    if(modalDetails.auditTitle==""||modalDetails.company=="--Select Company--"||modalDetails.compliance==null||modalDetails.auditType==""||modalDetails.auditFreq=="--Select Audit Freq--"||modalDetails.auditDesc==""||modalDetails.start_date==""||modalDetails.end_date==""||modalDetails.auditor==null||modalDetails.auditee==null){

        Swal.fire({ 
           title:  'Please all the form fields',
           type: 'warning',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'OK'
        });
    }
   else
{    
    if(Date.parse(modalDetails.end_date)<Date.parse(modalDetails.start_date)){
      Swal.fire({ 
           title:  'Start date cannot be less than End date',
           type: 'warning',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'OK',
           timer: 1500
        });

    }
    else{
  $.ajax({
        type: "POST",
        url: "/newtheme/php/audit/manageAudit.php",
        data: modalDetails
    }).done(function (data) {
           Swal.fire({
              title: "Plan Created",
              text: "Your Plan Has Been Created",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
                window.location="/newtheme/view/audit/auditPlanCreate.php";
              }, 2000);
            });

 
    });
    

}
}
}

function performAuditActions() {
    var selectedData = table.rows('.selected').data();
    if(selectedData[0][6]=="created"){
    window.location = "/newtheme/view/audit/auditDoPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="prepared"){
    window.location = "/newtheme/view/audit/auditeeDoPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="performed"){
    window.location = "/newtheme/view/audit/auditCheckPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="approved"){
    window.location = "/newtheme/view/audit/auditReprt.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="returned"){
    window.location = "/newtheme/view/audit/auditActPage.php?auditId=" + selectedData[0][0];
}
}
function viewReport() {
    var selectedData = table.rows('.selected').data();
    window.open("/newtheme/view/audit/auditReprt.php?auditId=" + selectedData[0][0]);
}
function getLocation(){
    

    
    var companyName=$('#company').val();
    var modalDetails={'id':companyName};
     $.ajax({
        type: "POST",
        url: "/newtheme/view/common/locationDropDown.php",
        data: modalDetails,
        success:locationDropDown
    });

     
    

}
function locationDropDown(data){
    debugger
         
           
            $('#locationDrop').html(data);
          
        }
function getDepartment(){
  debugger
    var location=$('#location').val();
    var modalDetails={'id':location};
      $.ajax({
        type: "POST",
        url: "/newtheme/view/common/departmentDropDown.php",
        data: modalDetails,
        success:function(data){
            $('#departmentDrop').html(data);
        
        }
    });
     
}
 

function publishAuditList(){
  window.location="/newtheme/view/audit/auditPublished.php";
}


function importAuditCsv(){
    $('#auditCsv').click();
    var myFormData = new FormData();
    myFormData.append('auditCsv', auditCsv.files[0]);
    myFormData.append('location', $('#location').val());
    myFormData.append('department', $('#department').val());
    myFormData.append('compliance', $('#compliance').val());
    myFormData.append('auditor', $('#auditor').val());
    myFormData.append('auditee', $('#auditee').val());
    myFormData.append('company', $('#company').val());
    myFormData.append('loggedInUser', $('#loggedInUser').val());

      $.ajax({
        url: "/newtheme/php/audit/importAudits.php",
        type: "POST",
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        success: function (data) {
            Swal.fire({
              title: "Plan Created",
              text: "Your Plan Has Been Created",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
                window.location="/newtheme/view/audit/auditPlanCreate.php";
              }, 2000);
            });
            
        },
        error: function () {}
    });
    
}
