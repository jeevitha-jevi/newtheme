
$(document).ready(function() {
    debugger
    var companyName=$('#company').val();
    var modalDetails={'id':companyName};
     $.ajax({
        type: "POST",
        url: "/freshgrc/view/common/locationDropdown.php",
        data: modalDetails,
        success:locationDropDown
    });

$(".datepickerClass").each(function() {
        $(this).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099"  
        });
    });



  
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
  debugger  

       $('#auditFreq').val(value);
       manageModal();
     
  
   //return auditType;
}

function prepareModalForUpdate() {
    var selectedData = table.rows('.selected').data();
    $('#manageButton').text('Update');
    $('#action').val('update');
}

function getDataFromRequestforPrePlan() {
  debugger
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        // 'location_id': $('#location').val(),
        'action': $('#action').val(),
        'companyId': $('#company').val(),
        'start_date': $('#date').val(),
        'version_no': $('#version_no').val(),
        'implemented_by': $('#implemented_by1').val(),
        'review_date': $('#review_date').val(),
        'approved_by': $('#approved_by1').val(),
        'approved_date': $('#approved_date').val(),
        'reason_for_update': $('#reason_for_update').val(),
        // 'confidentiality_statement': $('#confidentiality_statement').val(),
        'bcpm_footer':$('#bcpm_footer1').val(),
        'update_name':$('#update_name').val(),
        'update_phone':$('#update_phone').val(),
        'update_office_location':$('#update_office_location').val(),
        'update_date_issue':$('#update_date_issue').val(),
         'update_date_update':$('#update_date_update').val()
         // 'update_name1':$('#name').val()
    }
    return modalDetails;
}

function manageModal() {
    debugger
    
    var modalDetails = getDataFromRequestforPrePlan();
     
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/bcpm/manageBCPM.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Pre-Plan Created!',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
 
    });
    window.location="/freshgrc/view/bcpm/bcpmCreateAdmin.php";

}
function getDataFromRequestforPlan() {
  debugger
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'bcpm_id':$('#bcpmId').val(),
        'action': $('#action').val(),
        'companyId': $('#company').val(),
        'overview': $('#overview').val(),
        'scope': $('#scope').val(),
        'policy': $('#policy').val(),
        'assumptions': $('#assumptions').val(),
        'objectives': $('#objectives').val(),
        'probability_scale': $('#probability_scale').val(),
        'business_impact_scale_view': $('#business_impact_scale_view').val(),
        'control_scale_view': $('#control_scale_view').val(),
        'threat':$('#threat').val(),
        'ideas_for_mitigation':$('#ideas_for_mitigation').val()
      
    }
    return modalDetails;
}

function manageModal1() {
    debugger
    
    var modalDetails = getDataFromRequestforPlan();
     
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/bcpm/manageBCPM.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Plan Created Successfully!',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
 
    });
    // window.location="/freshgrc/view/bcpm/bcpmImplementAdmin.php";

}
function getDataFromRequestforimplement() {
  debugger
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'bcpm_id': $('#bcpmId').val(),
        'action': $('#action').val(),
        'bia': $('#bia').val(),
        'company_id': $('#company').val(),
        'manager': $('#manager').val(),
        'process': $('#process').val(),
        'rto': $('#rto').val(),
        'daily_loss': $('#daily_loss').val(),
        'function': $('#function').val(),
        'risk': $('#risk').val(),
        'business_continuity_stratergy': $('#business_continuity_stratergy').val(),
        'eoc_location':$('#eoc_location').val(),
        'eoc_point_of_location':$('#eoc_point_of_location').val(),
        'phone_no': $('#phone_no').val(),
        'al_site_location': $('#al_site_location').val(),
        'al_point_of_location': $('#al_point_of_location').val(),
        'all_phone_no': $('#all_phone_no').val(),
        'of_site_location': $('#of_site_location').val(),
        'of_point_of_contact': $('#of_point_of_contact').val(),
        'of_phone_no': $('#of_phone_no').val(),
        'organisation_chart': $('#organisation_chart').val(),
        'team_desrcription_chart': $('#team_desrcription_chart').val(),
        't_name': $('#t_name').val(),
        't_mobile_no': $('#t_mobile_no').val(),
        't_work':$('#t_work').val(),
        't_phone':$('#t_phone').val(),
        't_home': $('#t_home').val(),
        't_email': $('#t_email').val(),
        't_dept': $('#t_dept').val(),
        't_home_address': $('#t_home_address').val(),
        'tl_task': $('#tl_task').val(),
        'tl_assigned': $('#tl_assigned').val(),
        'tl_frequency': $('#tl_frequency').val(),
        'tl_method': $('#tl_method').val(),
        'tl_schedule': $('#tl_schedule').val(),
        'ta_name': $('#ta_name').val(),
        'ta_mobile': $('#ta_mobile').val(),
        'ta_work_phone':$('#ta_work_phone').val(),
        'ta_team_or_dept':$('#ta_team_or_dept').val(),
        'ta_home': $('#ta_home').val(),
        'ta_email': $('#ta_email').val(),
        'ta_address': $('#ta_address').val(),
        'responsibilities': $('#responsibilities').val(),
        'tasks': $('#tasks').val(),
        'customer_name': $('#customer_name').val(),
        'tcl_tea_or_dept': $('#tcl_tea_or_dept').val(),
        'tcl_phone': $('#tcl_phone').val(),
        'tcl_email': $('#tcl_email').val(),
        'tcl_address': $('#tcl_address').val(),
        'tcl_product': $('#tcl_product').val(),
        'tsl_software_name':$('#tsl_software_name').val(),
        'tsl_version':$('#tsl_version').val(),
         'tsl_team_or_dept': $('#tsl_team_or_dept').val(),
        'tsl_purpose': $('#tsl_purpose').val(),
        'tsl_poc':$('#tsl_poc').val(),
        'tsl_phone':$('#tsl_phone').val(),
         'tsl_item': $('#tsl_item').val(),
        'tsl_quantity': $('#tsl_quantity').val(),
        'tsl_src':$('#tsl_src').val(),
        'tsl_item_no':$('#tsl_item_no').val(),
         'tsl_cost':$('#tsl_cost').val(),
          'tsl_total':$('#tsl_total').val(),
          'vc_rec_type':$('#vc_rec_type').val(),
          'vc_rec_name':$('#vc_rec_name').val(),
          'vc_team_or_dept':$('#vc_team_or_dept').val(),
          'vc_study_state_location':$('#vc_study_state_location').val(),
          'vc_backup':$('#vc_backup').val(),
          'vc_backup_location':$('#vc_backup_location').val()
      
    }
    return modalDetails;
}

function manageModal2() {
    debugger
    
    var modalDetails = getDataFromRequestforimplement();
     
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/bcpm/manageBCPM.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Implement Done Successfully',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
 
    });
    // window.location="/freshgrc/view/audit/auditorAdmin.php";

}
function getDataFromRequestformaintain() {
  debugger
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'bcpm_id': $('#bcpmId').val(),
         'action': $('#action').val(),
        'team_guidance': $('#team_guidance').val(),
        'pre_number': $('#pre_number').val(),
        'pre_team': $('#pre_team').val(),
        'post_number': $('#post_number').val(),
        'post_team': $('#post_team').val(),
        'awareness_activity': $('#awareness_activity').val(),
        'frequency': $('#frequency').val(),
        'responsable_office': $('#responsable_office').val(),
        'required_materials': $('#required_materials').val(),
        'comments':$('#comments').val()
        // 'created_by':$('#created_by').val(),
          // 'created_time':$('#created_time').val()
      
    }
    return modalDetails;
}

function manageModal3() {
    debugger
    
    var modalDetails = getDataFromRequestformaintain();
     
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/bcpm/manageBCPM.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Maintenance done Successfully',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
 
    });
    // window.location="/freshgrc/view/audit/auditorAdmin.php";

}
function getDataFromRequestforexercise() {
  debugger
    var modalDetails = {
    'loggedInUser': $('#loggedInUser').val(),
        'bcpm_id': $('#bcpmId').val(),
         'action': $('#action').val(),
        'number': $('#number_exercise').val(),
        'exercise_type': $('#exercise_type').val(),
        'purpose': $('#purpose').val(),
        'participants': $('#participants').val(),
        'dates': $('#dates').val(),
        'revision_date_approver': $('#revision_date_approver').val()
     
      
    }
    return modalDetails;
}

function manageModal4() {
    debugger
    
    var modalDetails = getDataFromRequestforexercise();
     
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/bcpm/manageBCPM.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Reviewed Successfully!',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
 
    });
    window.location="/freshgrc/view/bcpm/bcpmReport.php";

}

function performAuditActions() {
    var selectedData = table.rows('.selected').data();
    if(selectedData[0][6]=="create"){
    window.location = "/freshgrc/view/audit/auditDoPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="prepared"){
    window.location = "/freshgrc/view/audit/auditeeDoPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="performed"){
    window.location = "/freshgrc/view/audit/auditCheckPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="approved"){
    window.location = "/freshgrc/view/audit/auditReprt.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="returned"){
    window.location = "/freshgrc/view/audit/auditActPage.php?auditId=" + selectedData[0][0];
}
}
function viewReport() {
    var selectedData = table.rows('.selected').data();
    window.open("/freshgrc/view/audit/auditReprt.php?auditId=" + selectedData[0][0]);
}
function getLocation(){
    debugger;

    
    var companyName=$('#company').val();
    var modalDetails={'id':companyName};
     $.ajax({
        type: "POST",
        url: "/freshgrc/view/common/locationDropdown.php",
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
        url: "/freshgrc/view/common/departmentDropDown.php",
        data: modalDetails,
        success:function(data){
            $('#departmentDrop').html(data);
        
        }
    });
     
}
 

function publishAuditList(){
  window.location="/freshgrc/view/audit/auditPublished.php";
}       
