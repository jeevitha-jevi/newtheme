/*$(document).ready(function() { $.fn.dataTable.ext.errMode = 'none'; });*/
$(document).ready(function () {
    //debugger;
      
  /*$('#report').DataTable( {
        dom: 'Bfrtip',
        "ordering": false,
        buttons: [
             'csv', 'excel', 'pdf', 'print'
        ]
    } );*/
    /*var dat={
        'id':('#auditId').val()
    };
$.ajax({
        type: "POST",
        url: "/newtheme/php/auditEndDate.php",
        data: dat,
        success:setDate
    });*/
     $(".datepickerClass").each(function() {
        $(this).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            maxDate: 18,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099"            
        });
    });
});
function setDate(){
var currentDate = new Date();
//$(".datepicker").datepicker("setDate",currentDate); 
    

}
function toggleEventCkl(checklistId){
    //debugger
    if( $('#auditStatusToggle'+checklistId).prop('checked'))
    {
        $('#auditorStatusCkl'+checklistId).val("accepted");
      
    }
    else{
      $('#auditorStatusCkl'+checklistId).val("rejected");  
    }

    
}
function toggleEventClause(clauseId){
    //debugger
    if( $('#auditClauseStatusToggle'+clauseId).prop('checked'))
    {
        updateCklStatus(clauseId,true);
        $('#auditorStatus'+clauseId).val("accepted");
      
    }
    else{
        updateCklStatus(clauseId,false);
      $('#auditorStatus'+clauseId).val("rejected");  
    }

    
}



function saveAuditStatus(auditId, statusForSave, isDraft,capa) {
    
    //capa=$('#auditCapaCheck').val();
    modalDetails = {
        'auditId': auditId,
        'status': statusForSave,
        'isDraft': isDraft,
        'loggedInUser': $('#loggedInUser').val(),
        'action': 'saveStatus'
    };
    $.ajax({
        type: "POST",
        url: "/newtheme/php/audit/manageAudit.php",
        data: modalDetails
    }).done(function (data) {

        debugger

         if(capa==false)
        {
        
               if(statusForSave== "prepare pending"){
                    Swal.fire({ 
                       title:  'Checklist Assigned for Auditee!',
                       confirmButtonColor: '#3085d6',
                       confirmButtonText:'ok'
                    });
                    //setTimeout("location.reload(true);",5000);
                    window.location="view/audit/auditorAdmin.php";
                  }  
                
                 if(statusForSave== "capa pending"){
                    Swal.fire({ 
                       title:  'CAPA completed Auditor Needs to check',
                       confirmButtonColor: '#3085d6',
                       confirmButtonText:'ok'
                    });
                    //setTimeout("location.reload(true);",5000);
                    window.location="view/audit/auditorAdmin.php";
                    }
                 
                if(statusForSave== "perform pending"){
                    Swal.fire({ 
                       title:  ' Auditor Needs to Check!',
                       confirmButtonColor: '#3085d6',
                       confirmButtonText:'ok'
                    });

                    //setTimeout("location.reload(true);",5000);
                    window.location="view/audit/auditorAdmin.php";
                    }
                
                if(statusForSave== "approved"){
                   Swal.fire({ 
                       title:  'Audit Scoring Done (No CAPA)!',
                       confirmButtonColor: '#3085d6',
                       confirmButtonText:'ok'
                    });
                   //setTimeout("location.reload(true);",5000);
                   window.location="view/audit/auditorAdmin.php";
                }   
                
                if(statusForSave== "returned"){
                    Swal.fire({ 
                       title:  'Scoring Done Auditee Needs to Act!',
                       confirmButtonColor: '#3085d6',
                       confirmButtonText:'ok'
                    });
                   //setTimeout("location.reload(true);",5000);
                   window.location="view/audit/auditorAdmin.php";
                }
                if(statusForSave== "capa pending"){
                Swal.fire({ 
                    title:  'CAPA completed Auditor Needs to check',
                    confirmButtonColor: '#3085d6',
                   confirmButtonText:'ok'
                   
                   });
                  //setTimeout("location.reload(true);",5000);
                  window.location="view/audit/auditorAdmin.php";
            }
             if(statusForSave== "publish pending"){
                Swal.fire({ 
                    title:  'Audit Publised',
                    confirmButtonColor: '#3085d6',
                   confirmButtonText:'ok'
                   
                   });
                 //setTimeout("location.reload(true);",5000);
                 window.location="view/audit/auditorAdmin.php";
            

            }
              
        }
    else if(capa==true)
        {
            if(statusForSave=="approved")
            {
                Swal.fire({ 
                    title:  'Happy about CAPA Proceed to publish audit',
                    confirmButtonColor: '#3085d6',
                   confirmButtonText:'ok'
                });   
                setTimeout("location.reload(true);",5000);
                window.location="view/audit/auditorAdmin.php";
            }
            if(statusForSave=="returned")
            {
                Swal.fire({ 
                    title:  'Not Satisfied with CAPA Please Redo act',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText:'ok'
                });
               setTimeout("location.reload(true);",5000);
               window.location="view/audit/auditorAdmin.php";      
            }
            if(statusForSave=="publish pending")
            {
                Swal.fire({ 
                    title:  'Audit Publised',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText:'ok'
                });
                setTimeout("location.reload(true);",5000);
                window.location="view/audit/auditorAdmin.php";     
            }
            /*  location.reload(true);*/
        }

       
   
             /*case "capa pending":
                Swal.fire({ 
                    title:  '!',
                    confirmButtonColor: '#3085d6',
                   confirmButtonText:'ok'
                   
                   });
            break;
            case "capa pending":
                Swal.fire({ 
                    title:  'Audit Published',
                    confirmButtonColor: '#3085d6',
                   confirmButtonText:'ok'
                   
                   });
            break;*/
    });
}

function saveClause(clauseId){
    saveOnlyClause(clauseId, true);
}

function saveOnlyClause(clauseId, isCklsUpdateReqd) {
    debugger
    isCklAuditorStatusUpdated = isCklsUpdateReqd && $('#isAuditorObsVisible' + clauseId).val();
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'auditId': $('#auditId').val(),
        'clauseId': clauseId,
        'priority': $('#priority' + clauseId).val(),
        'severity': $('#severity' + clauseId).val(),
        'auditee': $('#auditee' + clauseId).val(),
        'target_date': $('#target_date' + clauseId).val(),
        'auditor_comments': $('#auditor_comments' + clauseId).val(),
        //'score': $('#score' + clauseId).val(),
        'status': $('#auditorStatus' + clauseId).val(),
        'auditStatus': $('#auditStatus').val(),
        'auditor':$('#auditor'+clauseId).val(),
        'auditee':$('#auditee'+clauseId).val(),
        'action': 'saveClause',
        'isCklsUpdateReqd': isCklAuditorStatusUpdated,
        'auditCklIdsForClause': $('#auditCklIdsForClause' + clauseId).val()
    }
    $.ajax({
        type: "POST",
        url: "/newtheme/php/audit/manageAuditClause.php",
        data: modalDetails
    }).done(function (data) {
       
});
}
function saveAllAuditChecklists(clauseId){
    cklIdsForClause = $('#cklIdsForClause' + clauseId).val();
    
    cklIdArray = cklIdsForClause.split(',');  
    var deferreds = [];
    for (var index in cklIdArray){
        var cklId = cklIdArray[index];
        var modalDetails = getCklModalDetails(cklId);
        var cklPromise = $.ajax({
                type: "POST",
                url: "/newtheme/php/audit/manageAuditClause.php",
                data: modalDetails
            }).done(function (data) {
              // alert(data);
            });
        deferreds.push(cklPromise);
    }
    $.when.apply($, deferreds).done(function() {
        // Also save the clause level status if it has observations controls  
        if ($('#isAuditorObsVisible'+clauseId).val()){
            saveOnlyClause(clauseId, false);
        } else {

     
        }
    });       

}

function saveAuditChecklist(checklistId) {
    var modalDetails = getCklModalDetails(checklistId);
    var cklClauseId = $('#clauseId' + checklistId).val();
    $.ajax({
        type: "POST",
        url: "/newtheme/php/audit/manageAuditClause.php",
        data: modalDetails
    }).done(function (data) {
        //alert('Saved Successfully'.data);
        //location.reload();
    });
}

function getCklModalDetails(checklistId){
    //debugger
    var userFileId = document.getElementById('userFile'+checklistId);
    var cklClauseId = $('#clauseId' + checklistId).val();
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'auditId': $('#auditId').val(),
        'checklistId': checklistId,
        'clauseId': cklClauseId,
        'auditee_response': getAuditeeResponse(checklistId),
        'auditee_comments': $('#auditee_comments' + checklistId).val(),
        'file':    $('#userFileName'+checklistId).val(),
        'auditStatus': $('#auditStatus').val(),
        'action': 'saveAuditChecklist'
    }
    updateModalWithAuditorObs(modalDetails, checklistId);
    updateModalWithCapa(modalDetails, checklistId);   
    return modalDetails;
}

function updateModalWithAuditorObs(modalDetails, checklistId){
    if ($('#cklObsVisible-' + checklistId)){
        modalDetails.auditorStatusCkl = $('#auditorStatusCkl' + checklistId).val();
        modalDetails.auditorObs = $('#observation' + checklistId).val();
        auditScore=$('#auditorScoreCkl'+checklistId).val();
        checklistScore=$('#checklistScore'+checklistId).val();
        auditScore=auditScore/10;
        tempCheck=checklistScore;
        auditScore=auditScore*checklistScore;
        modalDetails.auditorScore=auditScore;
    } else {
        modalDetails.auditorStatusCkl = '';
        modalDetails.auditorObs = '';  
    }
}

function updateModalWithCapa(modalDetails, checklistId){
    if ($('#capaVisible-' + checklistId)){
        modalDetails.correctiveAction = $('#ca' + checklistId).val();
        modalDetails.preventiveAction = $('#pa' + checklistId).val();
    } else {
        modalDetails.correctiveAction = '';
        modalDetails.preventiveAction = '';        
    }
}

function getAuditeeResponse(checklistId) {
    //debugger;
    var auditeeResponse = '';
    // For multi choice questions, need to iterate and find the checked elements.
    // To achieve that first check whether multi choice was present to user.
    //alert($('#cklOptsModal' + checklistId).length);
    if ($('#cklOptsModal' + checklistId).length) {
        var selected = [];
        $('ul#cklOpts' + checklistId + ' li').each(function (index) {
            var li = $(this);
            var div = li.children('div');
            if (div.children(':nth-child(1)').prop("checked")) {
                var selectedOptId = div.children(':nth-child(2)').val();
                selected.push(div.children(':nth-child(2)').val());
            }
        });
        auditeeResponse = selected.join();
    } else {
        var auditeeresponse = $('#auditee_response'+checklistId).prop('checked');
        if(auditeeresponse == true){
             auditeeResponse = "yes";
        }
        else{
             auditeeResponse = "no";            
        }
        // This is Yes r No. So directly select the auditee response field.
        //auditeeResponse = $('#auditee_response' + checklistId).val()
    }
    return auditeeResponse;
}

function updateClauseStatus(checklistId){
    clauseId = $('#clauseId' + checklistId).val();
    $('#auditorStatus'+clauseId).val('in-progress');
}
function updateCklScore(clauseId)
{
  var cklIdsForEachClause=getCklIdsClause(clauseId);
  document.getElementById("scoreClause"+clauseId).innerHTML=$('#auditorScore'+clauseId).val();
  clauseScore=$('#auditorScore'+clauseId).val();
  cklIdsForEachClause.forEach(function(cklId){
     $('#auditorScoreCkl'+cklId).val(clauseScore);
      document.getElementById("Score"+cklId).innerHTML=$('#auditorScoreCkl'+cklId).val();
  });
}

function updateCklStatus(clauseId,status){
    cklIdsForClassArray = getCklIdsClause(clauseId);
    clauseStatus = $('#auditorStatus'+clauseId).val();
    cklIdsForClassArray.forEach(function(cklId){
        if(status==true)
        {
        $('#auditStatusToggle'+cklId).bootstrapToggle('on');
      }
      else{
         $('#auditStatusToggle'+cklId).bootstrapToggle('off');

      }/*  $('#auditStatusToggle'+cklId).prop('checked')=status;*/
    });
    if (clauseStatus == 'accepted'){
        $("#clausePanelHeading"+clauseId).attr("class", "panel panel-success");
        evaluateParentClausePanelToSuccess(clauseId);
    } else {
        $("#clausePanelHeading"+clauseId).attr("class", "panel panel-default");
        updateParentClausePanelsToDefault(clauseId);
    }
}

function updateParentClausePanelsToDefault(clauseId){
    parentClauseId = $("#parentClauseId"+clauseId).val();
    if (parentClauseId){
        // If parent clause id is there then change the panel status.
        $("#clausePanelHeading"+parentClauseId).attr("class", "panel panel-default");
        updateParentClausePanelsToDefault(parentClauseId);
    } else {
        return;
    }
}

function evaluateParentClausePanelToSuccess(clauseId){
    parentClauseId = $("#parentClauseId"+clauseId).val();
    if(parentClauseId){
        // If Parent present, check whehter all its child have success. Then change. Else don't.
        childClauaseIds = $("#childClauseIds"+parentClauseId).val();
        childClauaseIdsArray = childClauaseIds.split(",");
        isOneNotAccepted = false;
        for (var i = 0; i < childClauaseIdsArray.length; i++) {
            childClauseId = childClauaseIdsArray[i];
            childClausePanelClass = $('#clausePanelHeading'+childClauseId).attr("class");
            if (childClausePanelClass.indexOf('panel-default') != -1){
                // Means atleast one child is NOT accepted
                isOneNotAccepted = true;
                break;
            }            
        }
        if (isOneNotAccepted){
            $("#clausePanelHeading"+parentClauseId).attr("class", "panel panel-default");
        } else {
            $("#clausePanelHeading"+parentClauseId).attr("class", "panel panel-success");
        }
        evaluateParentClausePanelToSuccess(parentClauseId);
    } else {
        return;
    }
}

function getCklIdsClause(clauseId){
    
    cklIdsForClause = $('#cklIdsForClause'+clauseId).val();
    return cklIdsForClause.split(",");
}

function showAuditCklModal(clauseId){
    $('#auditCklModal'+clauseId).modal('show');
}

function fileUpload(checklistId){
    var myFormData = new FormData();
    var userFileId = document.getElementById('userFile'+checklistId);
    myFormData.append('userFile', userFileId.files[0]);

    var fileName = userFileId.files[0].name;
    $('#userFileName'+checklistId).val(fileName);

    $.ajax({
      url: "/newtheme/php/common/fileMgmt.php",
      type: "POST",
      processData: false, // important
      contentType: false, // important
      data: myFormData,
      success: function (data) {
          //alert('Successfully uploaded');
      }
    });
}
function saveAllClauses(allClauses){
    //debugger
    var clauses=allClauses;
    for(var i=0;i<clauses.length;i++){
        saveClause(clauses[i]);
    }
     Swal.fire({ 
           title:  'Checklist Assigned Successfully!',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
     
    });
}
function saveAllChecklists(allClauses){
    //debugger
    var clauses=allClauses;
    for(var i=0;i<clauses.length;i++){
        saveAllAuditChecklists(clauses[i]);
    }
    Swal.fire({ 
           title:  'Checklist Saved Successfully!',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
     
    });
}

function saveAndChangeAuditStatus(allClauses,auditId, statusForSave, isDraft,capa){
    debugger
    //debugger
    var cap=capa;
    saveAllClauses(allClauses);
    saveAuditStatus(auditId, statusForSave, isDraft,cap);
     
                    Swal.fire({ 
                       title:  'Checklist Assigned for Auditee!',
                       confirmButtonColor: '#3085d6',
                       confirmButtonText:'ok'
                    });
                    window.location="view/audit/auditorAdmin.php";


}
function saveAndChangeAuditCklStatus(allClauses,auditId, statusForSave, isDraft,capa){
    var cap=capa; 
    saveAllChecklists(allClauses);
    saveAuditStatus(auditId, statusForSave, isDraft,cap);
    debugger
       

  
}

function displayScore(checklistId){
    
    document.getElementById("Score"+checklistId).innerHTML=$('#auditorScoreCkl'+checklistId).val();

}
/*function scoreClauseComment(clauseId) {
    debugger
        $("#scoringModal"+clauseId).show();
    
}
function hideclauseComment(clauseId) {
    debugger
        $("#scoringModal"+clauseId).hide();
    
}
function scoreChlkComment(checklistId) {
debugger
    
        $("#scoreModal"+checklistId).show();
    
}
function hidechklComment(checklistId) {
    
        $("#scoreModal"+checklistId).hide();
    
}
*/
function scoreClauseComment(clauseId) {

    debugger
        $("#scoringModal"+clauseId).show();
    
  // body...
}

function hideclauseComment(clauseId) {

    debugger
        $("#scoringModal"+clauseId).hide();
    
  // body...
}
function scoreChlkComment(checklistId) {
debugger
    
        $("#chlkComment"+checklistId).show();
    
  // body...
}

function hidechlkComment(checklistId) {

    
        $("#chlkComment"+checklistId).hide();
    
  // body...
}

function setPriority(clauseId,value)
{
    debugger
    
    $('#priority'+clauseId).val(value);
    if(value=="low"){
         $("#priorityLow"+clauseId).css("background-color","green");
         $("#priorityHigh"+clauseId).css("background-color","#7a8994");
         $("#priorityMedium"+clauseId).css("background-color","#7a8994");

    }
    if(value=="medium"){
         $("#priorityLow"+clauseId).css("background-color","#7a8994");
         $("#priorityHigh"+clauseId).css("background-color","#7a8994");
         $("#priorityMedium"+clauseId).css("background-color","yellow");

    }
      if(value=="high"){
         $("#priorityLow"+clauseId).css("background-color","#7a8994");
         $("#priorityHigh"+clauseId).css("background-color","red");
         $("#priorityMedium"+clauseId).css("background-color","#7a8994");

    }
}
function setSeverity(clauseId,value)
{
    debugger
    
    $('#severity'+clauseId).val(value);
    if(value=="low"){
          $("#severityLow"+clauseId).css("background-color","green");
         $("#severityHigh"+clauseId).css("background-color","#7a8994");
         $("#severityMedium"+clauseId).css("background-color","#7a8994");


    }
    if(value=="medium"){
         $("#severityLow"+clauseId).css("background-color","#7a8994");
         $("#severityHigh"+clauseId).css("background-color","#7a8994");
         $("#severityMedium"+clauseId).css("background-color","yellow");

    }
      if(value=="high"){
         $("#severityLow"+clauseId).css("background-color","#7a8994");
         $("#severityHigh"+clauseId).css("background-color","red");
         $("#severityMedium"+clauseId).css("background-color","#7a8994");

    }
}


function openfileDialog(checklistId) {
    $("#userFile"+checklistId).click();
} 