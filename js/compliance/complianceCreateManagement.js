function insertData()
{

var data={
  'ucf_name':'MAS Regulatory Policy',
  'action':'insert'
}

$.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/compliance/complianceUcf.php",
        data: data,
    });
getdata();
}

function getdata()
{
  
  $.ajax({
        dataType: "json",
        type: "GET",
        url: "/freshgrc/php/compliance/compliancegetUcfId.php",
        data: "",
        success: addlibrary
    });
}



function addlibrary(data)
{
   var t=data.length;
    var lib_id=data[t-1].id;  
  


var settings = {
  "async": true,
  "crossDomain": true,
  "url": "http://142.93.210.126:3000/?token=510738691f70235b13ad8cf5e5d8f71a459f98bc",
  "method": "GET",
  "headers": {
    "cache-control": "no-cache",
    "postman-token": "004ba85d-4ab9-fa90-e545-c0589c97ca19"
  }
}

$.ajax(settings).done(function (response) {
  
var object=Object.keys(response);
  


var compliancedata={
 "live":response[object[0]],
 "deprecated_by":response[object[1]],
 "deprecation_notes":response[object[2]],
 "time_created":response[object[3]],
 "date_added":response[object[4]],
 "time_updated":response[object[5]],
 "date_modified":response[object[6]],
 "language":response[object[7]],
 "license_info":response[object[8]],
 "sort_value":response[object[9]],
 "genealogy":response[object[10]],
 "sort_id":response[object[11]],
 "common_name":response[object[12]],
 "published_name":response[object[13]],
 "published_version":response[object[14]],
 "official_name":response[object[15]],
 "type":response[object[16]],
 "url":response[object[17]],
 "description":response[object[18]],
 "title_type":response[object[19]],
 "availability":response[object[20]],
 "parent_category":response[object[21]],
 "originator":response[object[22]],
 "status":response[object[23]],
 "effective_date":response[object[24]],
 "release_date":response[object[25]],
 "release_availability":response[object[26]],
 "price":response[object[27]],
 "citation_format":response[object[28]],
 "tab_category":response[object[29]],
 "will_supercede_id":response[object[30]],
 "subject_matter":response[object[31]],
 "request_id":response[object[32]],
 "id":response[object[33]],
 "parent_id": 677,
 "parent_href": "https://api.unifiedcompliance.com/authority-document/677/details",
 "term_id": 261434,
 "term_href": "https://api.unifiedcompliance.com/dictionary-term/261434/details",
 "cch_account":response[object[39]],
 "_href":response[object[40]],
 "check_digit":response[object[41]],
 "ucf_id":lib_id,
}

$.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/compliance/compliancelib.php",
        data: compliancedata,
    });




for(var j=0;j<response[object[34]].length;j++)
{
  var citation={
'live':response[object[34]][j].live,
"deprecated_by": response[object[34]][j].deprecated_by,
"deprecation_notes": response[object[34]][j].deprecation_notes,
"time_created": response[object[34]][j].time_created,
"date_added": response[object[34]][j].date_added,
"time_updated": response[object[34]][j].time_updated,
"date_modified": response[object[34]][j].date_modified,
"language": response[object[34]][j].language,
"license_info": response[object[34]][j].license_info,
"sort_value": response[object[34]][j].sort_value,
"genealogy":response[object[34]][j].genealogy,
"sort_id":response[object[34]][j].sort_id,
"reference":response[object[34]][j].reference,
"guidance":response[object[34]][j].guidance,
"guidance_as_tagged":response[object[34]][j].guidance_as_tagged,
"is_audit_question":response[object[34]][j].deprecated_by,
"id":response[object[34]][j].id,
"audit_item":response[object[34]][j].audit_item,
"asset":response[object[34]][j].asset,
"compliance_document":response[object[34]][j].compliance_document,
"role":response[object[34]][j].role,
"data_content":response[object[34]][j].data_content,
"organizational_function":response[object[34]][j].organizational_function,
"record_example":response[object[34]][j].record_example,
"metric":response[object[34]][j].metric,
"monitored_event":response[object[34]][j].monitored_event,
"organizational_task":response[object[34]][j].organizational_task,
"record_category":response[object[34]][j].record_category,
"configurable_item_with_settings":response[object[34]][j].configurable_item_with_settings,
"sentence":response[object[34]][j].sentence,
"parent":response[object[34]][j].parent,
"check_digit":response[object[34]][j].check_digit,
'ucf_id':lib_id,

}
$.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/compliance/complianceCitation.php",
        data: citation,
    });
}


for(var j=0;j<response[object[34]].length;j++)
{




  var controls={

"live": response[object[34]][j].control.live,
"deprecated_by": response[object[34]][j].control.deprecated_by,
"deprecation_notes": response[object[34]][j].control.deprecation_notes,
"time_created": response[object[34]][j].control.time_created,
"date_added": response[object[34]][j].control.date_added,
"time_updated":response[object[34]][j].control.time_updated,
"date_modified": response[object[34]][j].control.date_modified,
"language":response[object[34]][j].control.language,
"license_info": response[object[34]][j].control.license_info,
"sort_value": response[object[34]][j].control.sort_value,
"genealogy":response[object[34]][j].control.genealogy,
"sort_id":response[object[34]][j].control.sort_id,
"name": response[object[34]][j].control.name,
"impact_zone":response[object[34]][j].control.impact_zone,
"type":response[object[34]][j].control.type,
"classification":response[object[34]][j].control.classification,
"metric_name": response[object[34]][j].control.metric_name,
"metric_calculation": response[object[34]][j].control.metric_calculation,
"metric_information_source": response[object[34]][j].control.metric_information_source,
"metric_target_result": response[object[34]][j].control.metric_target_result,
"metric_presentation_format": response[object[34]][j].control.metric_presentation_format,
"metric_image_reference": response[object[34]][j].control.metric_image_reference,
"control_id": response[object[34]][j].control.id,
"sentence_id":6074,
"parent_id": response[object[34]][j].control.parent.id,
"parent_href": response[object[34]][j].control.parent._href,
"href": response[object[34]][j].control._href,
"check_digit":response[object[34]][j].control.check_digit,
"citation_id":response[object[34]][j].id,
"ucf_id":lib_id
}

$.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/compliance/compliance_citation_control.php",
        data: controls,
    });

}
 for(var j=0;j<response[object[35]].length;j++)
{
var control_name={

"live": response[object[35]][j].live,
 "deprecated_by":  response[object[35]][j].deprecated_by,
"deprecation_notes": response[object[35]][j].deprecation_notes,
"time_created":response[object[35]][j].time_created,
"date_added": response[object[35]][j].date_added,
"time_updated": response[object[35]][j].time_updated,
"date_modified": response[object[35]][j].date_modified,
"language": response[object[35]][j].language,
"license_info": response[object[35]][j].license_info,
"name": response[object[35]][j].name,
 "stripped_name":response[object[35]][j].stripped_name,
"nonstandard":response[object[35]][j].nonstandard,
"common_name_id": response[object[35]][j].id,
"preferred_term": response[object[35]][j].preferred_term,
"href": response[object[35]][j]._href,
"check_digit": response[object[35]][j].check_digit,
"lib_id":response[object[33]],
"ucf_id":lib_id,

}

$.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/compliance/compliance_control_name.php",
        data: control_name,
    });

}

var issuer={
        "live":response[object[36]].live,
        "deprecated_by": response[object[36]].deprecated_by,
        "deprecation_notes": response[object[36]].deprecation_notes,
        "time_created": response[object[36]].time_created,
        "date_added":response[object[36]].date_added,
        "time_updated":response[object[36]].time_updated,
        "date_modified":response[object[36]].date_modified,
        "language": response[object[36]].language,
        "license_info":response[object[36]].license_info,
        "category": response[object[36]].category,
        "document_type":response[object[36]].document_type,
        "name":response[object[36]].name,
        "url":response[object[36]].url,
        "sub_directory": response[object[36]].sub_directory,
        "issuer_id": response[object[36]].live,
        "issuer_top_level_id": response[object[36]].issuer_top_level_id,
        "check_digit": response[object[36]].check_digit,
        'lib_id':response[object[33]],
        'ucf_id':lib_id,
}

$.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/compliance/compliance_issuer.php",
        data: issuer,
    });

});

}




$(document).ready(function () {
 
    var notificationofregulatery = {
        'complianceId': $('#company_id').val(),
        'action': 'seen'
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/compliance/notification.php",
        data: notificationofregulatery
    })
    /*$(".datepickerClass").each(function() {
        $(this).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099"  
        });
    });*/
    $('#modaldetails').on('click', 'tr', function(){
        if ($(this).hasClass('selected')){
             var selectedData = table.rows('.selected').data();
             
             if(selectedData[0][6]=="Published"){

                     $('#reportButton').show();
                     $('#kickOffbtn').hide();
                     $('#CheckForAuditorbtn').hide();
                     $('#auditeeDoPending').hide();
                     $('#btnForApproved').hide();

             }
              if(selectedData[0][6]=="prepared"){

                     $('#reportButton').hide();
                     $('#kickOffbtn').hide();
                     $('#CheckForAuditorbtn').hide();
                     $('#auditeeDoPending').hide();
                     $('#btnForApproved').hide();
                      $('#btnForRespond').show();

             }
             if(selectedData[0][6]=="create"){

                     $('#reportButton').hide();
                     $('#kickOffbtn').show();
                     $('#CheckForAuditorbtn').hide();
                     $('#auditeeDoPending').hide();
                     $('#btnForApproved').hide();

             }

             if(selectedData[0][6]=="performed" ||selectedData[0][6]=="returned"){

                     $('#reportButton').hide();
                     $('#kickOffbtn').hide();
                     $('#CheckForAuditorbtn').show();
                     $('#auditeeDoPending').hide();
                     $('#btnForApproved').hide();

             }
                if(selectedData[0][6]=="approved"  ){

                     $('#reportButton').hide();
                     $('#kickOffbtn').hide();
                     $('#CheckForAuditorbtn').hide();
                     $('#auditeeDoPending').hide();
                     $('#btnForApproved').show();

             }
           
            /*$('#newCompl').hide();
            $('#importCompl').hide();
            $('#editCompl').show();
            $('#deleteCompl').show();
            $('#manageCompl').show();*/     
                 
        }
    });
    //setTimeout(tableInit, 2000);
    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    }
    
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/compliance/complianceCreateList.php",
        data: userCredentials,
        success: success
    });
});

var table;

function tableInit() {
    table = $('#modaldetails').DataTable({
        select: {
            style: 'single',
            blurable: true
        },

        'searching':true,
       
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
            targets: [0,-1],
            visible: false
        } ],
        "ordering": false
    });
}

function success(data) {
    buildHtmlTable(data);
    tableInit();
}
function showModal(isUpdate) {
  
    $('#myModal').modal('show');
    if (isUpdate) {
        prepareModalForUpdate();
    } else {
        $('#action').val('create');
    }
}

function prepareModalForUpdate() {
  
    var selectedData = table.rows('.selected').data();
    $('#complianceId').val(selectedData[0][0]);
    $('#complianceName').val(selectedData[0][1]);
    $('#complianceDesc').val(selectedData[0][2]);
    $('#version').val(selectedData[0][3]);
    $('#company').val(selectedData[0][5]);
    $('#manageButton').text('Update');
    $('#action').val('update');
    
}

function getModalDetailsFromModal1() {
    var modalDetails1 = {
        'loggedInUser': $('#loggedInUser').val(),
        'complianceId': $('#complianceId').val(),
        'action': $('#action').val(),
        'complianceName': $('#complianceName').val(),
        'complianceDesc': $('#complianceDesc').val(),
        'version': $('#version').val(),
        'company': $('#company').val()
    }
    return modalDetails1;
}

function saveCompliance() {
  var complianceName = $('#complianceName').val();
    var complianceDesc = $('#complianceDesc').val();
    var version = $('#version').val();
     if(complianceName == "")
    {
      alert("Required Compliance Name");
        return false;
    }
    if(complianceDesc == "")
    {
      alert("Required Description");
      return false;
    }
    if(version == "")
    {
      alert("Required Version");
      return false;
    }
    if(complianceName != '')
  {
    var regexname = /^[a-zA-Z0-9\s]+$/;
    if(!regexname.test(complianceName)) {
      alert("Invalid Compliance Name");
      $('#complianceName').val('');
      return false;
  }
}
if(complianceDesc != '')
  {
    var regexname =/^[a-zA-Z0-9\s]+$/;
    if(!regexname.test(complianceDesc)) {
      alert("Invalid Description");
      $('#complianceDesc').val('');
       return false;
  }
}
if(version != '')
  {
    var regexname =/^((\d+(\\.\d{0,2})?)|((\d*(\.\d{1,2}))))$/;
    if(!regexname.test(version)) {
      alert("Invalid Version");
      $('#version').val('');
      return false;
  }
}
    
    var modalDetails1 = getModalDetailsFromModal1();
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/compliance/manageCompliance.php",
        data: modalDetails1
    }).done(function (data) {
        location.reload();
    });
}


function buildHtmlTable(data) {
    var columns = addAllColumnHeaders(data);
    for (var i = 0; i < data.length; i++) {
        
        var row$ = $('<tr/>');
        for (var colIndex = 0; colIndex < columns.length; colIndex++) {
            
             var cellValue = data[i][columns[colIndex]];
            var auditstatus = data[i].status;
            if (colIndex == 6 && "approved" == auditstatus){
              cellValue="Published";
              row$.append($('<td class="btn"  style="width:114px; height:50% ; background-color:#5cb85c; color:#fff; text-align:center;margin: 10px;"/>').html(cellValue));   
            }
            else if (colIndex == 6 && "performed" == auditstatus){
              cellValue="Response Planned";
              row$.append($('<td class="btn" style="width:114px; height:50% ; background-color:#32c5d2; color:#fff; margin: 10px;"/>').html(cellValue));   
            }
            else if (colIndex == 6 && "published" == auditstatus){
                cellValue="Published";
              row$.append($('<td class="btn" style="width:114px; height:50% ; background-color:#F1C40F; color:#fff; margin: 10px;"/>').html(cellValue));   
            }
            else if (colIndex == 6 && "prepared" == auditstatus){
                cellValue="Checklist Assigned";
              row$.append($('<td  class="btn" style="width:114px; height:50% ; background-color: #00a8ff; color:#fff;margin: 10px;"/>').html(cellValue));   
            }
            else if (colIndex == 6 && "create" == auditstatus){
                cellValue="Audit Launched";
              row$.append($('<td class="btn" style="width:114px; height:50% ; background-color:#00FFFF; color:#fff; margin: 10px;"/>"').html(cellValue));   
            }
             else if (colIndex == 6 && "returned" == auditstatus){
                cellValue="Follow up planned";
              row$.append($('<td class="btn" style="width:114px; height:50% ; background-color:red; color:#fff; margin: 10px;"/>"').html(cellValue));   
            }
            else
           {

            if (cellValue == null) {
                cellValue = "";
            }

            row$.append($('<td/>').html(cellValue));
        }

        $("#modaldetails").append(row$);
    }
}
}

function addAllColumnHeaders(data) {
    var columnSet = [];
    var headerTr$ = $('<tr/>');

    for (var i = 0; i < data.length; i++) {
        var rowHash = data[i];
        for (var key in rowHash) {
            if ($.inArray(key, columnSet) == -1) {
                columnSet.push(key);
                headerTr$.append($('<th/>').html(key));
            }
        }
    }
    return columnSet;
}



/*function prepareModalForUpdate() {
    var selectedData = table.rows('.selected').data();
    $('#manageButton').text('Update');
    $('#action').val('update');
}
*/
function getModalDetailsFromModal() {
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'auditTitle': $('#auditTitle').val(),
        'action': $('#action').val(),
        'company': $('#company').val(),
        'compliance': $('#compliance').val(),
        'auditType': $('#auditType').val(),
        'auditFreq': $('#auditFreq').val(),
        'scope': $('#scope').val(),
        'auditDesc': $('#auditDesc').val(),
        'auditProcedure': $('#auditProcedure').val(),
        'start_date': $('#start_date').val(),
        'end_date': $('#end_date').val(),
        'auditor': $('#auditor').val(),
        'auditee': $('#auditee').val(),
        'location':$('#location').val(),
        'department':$('#department').val()
    }
    return modalDetails;
}

function manageModal() {
    ;
    var modalDetails = getModalDetailsFromModal();
    if(modalDetails.auditTitle==""||modalDetails.company=="--Select Company--"||modalDetails.compliance=="--Select Compliance--"||modalDetails.auditType=="--Select Audit Type--"||modalDetails.auditFreq=="--Select Audit Freq--"||modalDetails.scope==" "||modalDetails.auditDesc==" "||modalDetails.auditProcedure==" "||modalDetails.start_date==" "||modalDetails.end_date==" "||modalDetails.auditor=="--Select Auditor--"||modalDetails.auditee=="--Select Auditee--"){
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
        url: "/freshgrc/php/audit/manageAudit.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Plan Created!',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
  location.reload();
    });
}
}

function performAuditActions() {
    var selectedData = table.rows('.selected').data();
    if(selectedData[0][6]=="Audit Launched"){
    window.location = "/freshgrc/view/audit/auditDoPage.php?auditId=" + selectedData[0][0];
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

function showComplClause() {
    var selectedData = table.rows('.selected').data();
    window.location = "/freshgrc/view/compliance/clauseAdmin.php?complianceId=" + selectedData[0][0];
}
// function gotoproperpage() {
//     var selectedData = document.getElementById("module").selectedIndex;
//     window.location ="/freshgrc/view/compliance/clauseAdmin.php?complianceId="+selectedData[][];
// }
function importCsv() {
 
    //var selectedData = table.rows('.selected').data();
    //var complianceId = selectedData[0][0];
    $('#complianceCsv').click();
     myFormData = new FormData();
    myFormData.append('complianceCsv', complianceCsv.files[0]);
    //myFormData.append('complianceId', complianceId);
    myFormData.append('loggedInUser', $('#loggedInUser').val());
     csvName = complianceCsv.files[0].name;
$('#complianceName').val(csvName);
 var regulatoryalert={
    'company_id':$('#company').val(),
    'complianceName':$('#complianceName').val(),
  
    'action':'notify'
  }
   $.ajax({
        url: "/freshgrc/php/compliance/notification.php",
        type: "POST",
        data: regulatoryalert,
        success:re
      }); 

}
// function delete()
// {
//   var regulatoryalert={
//     'company_id':$('$company').val(),
//     'complianceName':$('$complianceName').val(),
//     'action':'seen'
//   }
//   $.ajax(
//   {
//     url:"/freshgrc/php/compliance/notification.php",
//     type:"POST",
//     data:regulatoryalert,success:re
//   })
// }


function re()
{

    $.ajax({
        url: "/freshgrc/php/compliance/importCompliance.php",
        type: "POST",
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        success: function (data) {
            //alert('Successfully uploaded : '+data);
            swal({
              title: "Checklist is imported",
              // text: "Your Plan Has Been Created",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
 
setTimeout(function () {
                location.reload();
              }, 2000);
            });
            
        },
        error: function () {}
    });
}



function deletealert() {

    var regulatoryalert = {
        'company_id':$('#company').val(),
        'complianceName':$('#complianceName').val(),

        'action': 'seen'
    }
    $.ajax({
        type: "POST",
        url:  "/freshgrc/php/compliance/notification.php",
        data: regulatoryalert
    });
  location.reload();
    }





function showDeleteDialog() {
    
    var selectedData = table.rows('.selected').data();
    $('#myModal2').modal('show');
    $('#complianceId_delete').val(selectedData[0][0]);
}
function deleteModal() {
    var modalDetails1 = {
        'complianceId': $('#complianceId_delete').val(),
        'action': 'delete'
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/compliance/manageCompliance.php",
        data: modalDetails1
    }).done(function (data) {
        location.reload();
    });
}