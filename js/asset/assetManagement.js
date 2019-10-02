$(document).ready(function() {
    
    var companyName=$('#company').val();
    var modalDetails={'id':companyName};
     $.ajax({
        type: "POST",
        url: "/freshgrc/view/common/locationDropdown.php",
        data: modalDetails
    });

      $.ajax({
        type: "POST",
        url: "/freshgrc/view/common/controldropdown.php",
        data: modalDetails,
        success:function(data){
            $('#controls').html(data);
        }
    });
 
       
    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    }
 
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/asset/assetlist.php",
        data: userCredentials
       
    });
});

var table;

function tableInit() {
    table = $('#modaldetails').DataTable({
        select: {
            style: 'single'
        },
       

        buttons: [
            { extend: 'print', className: 'btn dark btn-outline',text: '<span class="glyphicon glyphicon-print" data-toggle="tooltip" title="Print"></span>' },
            { extend: 'copy', className: 'btn red btn-outline' ,text: '<span class="glyphicon glyphicon-copy" data-toggle="tooltip" title="Copy"></span>'},
            { extend: 'pdf', className: 'btn green btn-outline' ,text: '<span class="glyphicon glyphicon-file" data-toggle="tooltip" title="PDF"></span>'},
            { extend: 'csv', className: 'btn purple btn-outline ' ,text: '<img src="/freshgrc/assets/images/csv.png" alt=csv width="20" height="20" data-toggle="tooltip" title="CSV"/>'},
            { extend: 'colvis', className: 'btn dark btn-outline', text: '<span class="glyphicon glyphicon-th-list" data-toggle="tooltip" title="Columns"></span>'}
        ],
        "pageLength": 5000,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        columnDefs: [ {
            targets: [0,1],
            visible: false
        } ],
        "ordering": false
    });
}



function prepareModalForUpdate() {
    var selectedData = table.rows('.selected').data();
    $('#manageButton').text('Update');
    $('#action').val('update');
}



function getDataFromRequest() {
    
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'action': $('#action').val(),
        'name': $('#name').val(),
        'compliance': $('#compliance').val(),
        'description': $('#description').val(),
        'company': $('#company').val(),
        'retention_period': $('#retention_period').val(),
        'asset_value': $('#asset_value').val(),
        'at_origin': $('#at_origin').val(),
        'info_moved': $('#info_moved').val(),
        'confidentiality': $('#confidentiality').val(),
        'availability': $('#availability').val(),
        'integrity': $('#integrity').val(),
        'classification': $('#classification').val(),
        'personal_data': $('#personal_data').val(),
        'sensitive_data': $('#sensitive_data').val(), 
        'customer_data': $('#customer_data').val(),
        'asset_owner': $('#asset_owner').val(),
        'asset_custodian': $('#asset_custodian').val(),
        'asset_reviewer': $('#asset_reviewer').val(),
        'asset_group':$('#asset_group').val(),
        'location':$('#location').val(),
        'department': $('#department').val(),
        'start_date': $('#start_date').val(),
        'end_date': $('#end_date').val(),
        'review_date': $('#review_date').val(),
        'created_by': $('#loggedInUser').val(),
        'storage_details': $('#storage_details').val(),
        'life_cycle': $('#life_cycle').val(),
        'name': $('#name').val(),
        'disposal_methods': $('#disposal_methods').val(),
        'backup_location': $('#backup_location').val(),
        'backup_schedule': $('#backup_schedule').val(),
        'sys_admin': $('#sys_admin').val(),
        'application': $('#application').val(),
        'technical_contact': $('#technical_contact').val(),
        'vendor': $('#vendor').val(),
        'expected_life': $('#expected_life').val(),
        'expired_life': $('#expired_life').val(),
        'maintainance_status': $('#maintainance_status').val(),
        'purpose': $('#purpose').val(),
        'dependency': $('#dependency').val(), 
        'business_specific_requrements': $('#business_specific_requrements').val(),
        'version_no': $('#version_no').val(),
        'serial_no': $('#serial_no').val(),
        'type': $('#type').val(),
        'users':$('#users').val(),
        'license_datails':$('#license_datails').val(),
        'no_of_licenses': $('#no_of_licenses').val(),
        'disposal': $('#disposal').val(),
        'backup': $('#backup').val(),
        'kra': $('#kra').val(),
        'reporting_to': $('#reporting_to').val(),
        'access': $('#access').val(),
        'alternate_role': $('#alternate_role').val(),
        'nda': $('#nda').val(),
        'min_req_capabilities': $('#min_req_capabilities').val(),
        'ip_address': $('#ip_address').val(),
        'rack_number': $('#rack_number').val(),
        'slot_number': $('#slot_number').val(),
        'info_moved': $('#info_moved').val(),
        'os': $('#os').val(),
        'service_packs_req': $('#service_packs_req').val(),
        'software': $('#software').val(),
        'sla': $('#sla').val(),
        'ola': $('#ola').val(),
        'cpu': $('#cpu').val(), 
        'ram': $('#ram').val(),
        'hdd': $('#hdd').val(),
        'stored_information_assets': $('#stored_information_assets').val(),
        'serial_number': $('#serial_number').val(),
        'netted_ip':$('#netted_ip').val(),
        'features':$('#features').val(),
        'configuration_backup': $('#configuration_backup').val(),
        'model': $('#model').val(),
        'used_out_of_premises': $('#used_out_of_premises').val(),
        'antivirus_updation': $('#antivirus_updation').val()
    }
    return modalDetails;
}

function manageModal() {
    debugger
    var modalDetails = getDataFromRequest();

     if( modalDetails.loggedInUser==""||modalDetails.action==""||modalDetails.name==""||modalDetails.compliance==""||modalDetails.description==""||modalDetails.company==""||modalDetails.retention_period==""||modalDetails.asset_value==""||modalDetails.at_origin==""||modalDetails.info_moved==""||modalDetails.info_moved==""||modalDetails.confidentiality==""||modalDetails.availability==""||modalDetails.integrity==""||modalDetails.classification==""||modalDetails.personal_data==""||modalDetails.sensitive_data==""||modalDetails.customer_data==""||modalDetails.asset_owner==""||modalDetails.asset_custodian==""||modalDetails.asset_reviewer==""||modalDetails.asset_group==""||modalDetails.location==""||modalDetails.department=="")
    {
        swal({ 
           title:  'Please Fill all the form fields',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
        });
    }
    else
    {
      $.ajax({
        type: "POST",
        url: "/freshgrc/php/asset/manageAsset.php",
        data: modalDetails
        }).done(function (data) {
            swal({ 
            title:  'Asset Indentified !',
            confirmButtonColor: '#3085d6',
            confirmButtonText:'ok',
               timer: 1500
            });
        // location.reload();
        });
                 window.location="/freshgrc/view/asset/assetAdmin.php";

}
}


        function assesstage(){
            
            var asses = $('#assessment').val()
             var status;
            if(asses == 'Access'){
             status = 'assessed';
             // alert(status);
            }
            else {
            status = 'assessment returned';
            // alert(status);
            }
             
             return status;
        }


function getDataFromAssesmentRequest() {
    
       var action = assesstage();
       var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'action': action ,
        'asset_id': $('#assetId').val(),
        'labelling': $('#labelling').val(),
        'disposal': $('#disposal').val(),
        'storage': $('#storage').val(),
        'transmission': $('#transmission').val(),
        'addressing': $('#addressing').val(),
        'classification': $('#classification').val(),
        'assessment': $('#assessment').val(),
        'conclusion': $('#conclusion').val(),
        'closure_data': $('#closure_data').val()
       
    }
    return modalDetails;
}

function manageModalAssesment() {
    
    var modalDetails = getDataFromAssesmentRequest();
    
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/asset/manageAssetAssesment.php",
        data: modalDetails,
      }).done(function (data) {
            swal({ 
            title:  'Assesment successfully !',
            confirmButtonColor: '#3085d6',
            confirmButtonText:'ok',
               timer: 1500
            });
        // location.reload();
        });
         window.location="/freshgrc/view/asset/assetAssessmentActionAdmin.php";
    
}


  function Reviewstage(){
            
            var asses = $('#asset_decision').val()
             var status;
            if(asses == 'Reviewed'){
             status = 'reviewed';
             // alert(status);
            }
            else {
            status = 'review returned';
            // alert(status);
            }
             
             return status;
        }


function getDataFromReviewRequest() {
    
     var action = Reviewstage();
    var modalDetails = {
       
        'loggedInUser': $('#loggedInUser').val(),
        'action': action,
          'asset_id': $('#assetId').val(),
        'review_comments': $('#review_comments').val(),
         'next_review_date': $('#next_review_date').val(),
        'asset_decision': $('#asset_decision').val()
       
    }
    return modalDetails;
}

function manageModalReview() {
    
    var modalDetails = getDataFromReviewRequest();
    
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/asset/manageAssetReview.php",
        data: modalDetails
        }).done(function (data) {
            swal({ 
            title:  'Review Indentified !',
            confirmButtonColor: '#3085d6',
            confirmButtonText:'ok',
               timer: 1500
            });
        // location.reload();
        });
         window.location="/freshgrc/view/asset/assetReportAdmin.php";
}
function getDataFromActionRequest() {
    
    var modalDetails = {
       
        'loggedInUser': $('#loggedInUser').val(),
        'action': $('#action').val(),
          'asset_id': $('#assetId').val(),
        'control_for_labelling': $('#labelling').val(),
         'control_for_disposal': $('#disposal').val(),
        'control_for_storage': $('#storage').val(),
         'control_for_transmission': $('#transport').val(),
         'control_for_addressing': $('#addressing').val(),
        'description': $('#comment').val()
       
       
    }
    return modalDetails;
}

function createAssetAction() {
    
    var modalDetails = getDataFromActionRequest();
    
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/asset/manageAssetAction.php",
        data: modalDetails
        }).done(function (data) {
            swal({ 
            title:  'Action!',
            confirmButtonColor: '#3085d6',
            confirmButtonText:'ok',
               timer: 1500
            });
        // location.reload();
        });
      window.location="/freshgrc/view/asset/assetAssessmentActionAdmin.php";
}

   function asset_groups(){  
    
    var assetgroupDetails =  $('#asset_group').val();
    
    switch (assetgroupDetails) { 
         case "1": 
        $('#DigitalAsset').modal('show');
        break;
         case "2": 
        $('#BusinessDatabases').modal('show');
        break;
         case "3": 
        $('#SourceCode').modal('show');
        break;
         case "4": 
        $('#software').modal('show');
        break;
         case "5": 
        $('#nonDigitalAsset').modal('show');
        break;
         case "6": 
        $('#peopleAssets').modal('show');
        break;
         case "7": 
        $('#Servers').modal('show');
        break;
         case "8": 
        $('#NetworkDevices').modal('show');
        break;
         case "9": 
        $('#Desktops').modal('show');
        break;
         case "10": 
        $('#Laptops').modal('show');
        break;
         case "11": 
        $('#Media').modal('show');
        break;
         case "12": 
        $('#Supportutilities').modal('show');
        break;
       default:
        alert('asset_group');
}

}

function performAuditActions() {
    
    var selectedData = table.rows('.selected').data();
    if(selectedData[0][6]=="identified"){
    window.location = "/freshgrc/view/asset/assetPlanCreate.php";
}
 if(selectedData[0][6]=="Checklist Assigned"){
    window.location = "/freshgrc/view/audit/auditeeDoPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="Response Planned"){
    window.location = "/freshgrc/view/audit/auditCheckPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="Published"){
    window.location = "/freshgrc/view/audit/auditReprt.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][6]=="Follow up planned"){
    window.location = "/freshgrc/view/audit/auditActPage.php?auditId=" + selectedData[0][0];
}
}
function viewReport() {
    var selectedData = table.rows('.selected').data();
    window.open("/freshgrc/view/audit/auditReprt.php?auditId=" + selectedData[0][0]);
}
// function getControl(){
//     
//     var companyName=$('#company').val();
//     var modalDetails={'id':companyName};
//      $.ajax({
//         type: "POST",
//         url: "/freshgrc/view/common/controldropdown.php",
//         data: modalDetails,
//         success:function(data){
//             $('#controls').html(data);
//         }
//     });

    
    

// }

function getDepartment(){
 
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

function goToPreviousPage(){
    window.history.back();
}