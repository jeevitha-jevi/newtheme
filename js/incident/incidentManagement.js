$(document).ready(function() {   
    $('#litigationstatus').change(function() {
var selection = $(this).val();
if(selection == "Yes")
{
$('#litigate').show();
}
if(selection == "No")
{
$('#litigate').hide();
}
});




    $('#modaldetails').on('click', 'tr', function(){
        if ($(this).hasClass('selected')){
             var selectedData = table.rows('.selected').data();
             
            if(selectedData[0][3]=="create"){
                     $('#diagnosis').show();
                     $('#resolution').hide();
                     $('#closure').hide();
                     $('#review').hide();                    

                     
             }
              if(selectedData[0][3]=="managed"){
                     $('#diagnosis').hide();
                     $('#resolution').show();
                     $('#closure').hide();
                     $('#review').hide();                    

                    
             } 
             if(selectedData[0][3]=="resolved"){
                     $('#diagnosis').hide();
                     $('#resolution').hide();
                     $('#closure').show();
                     $('#review').hide();                    

             }
             if(selectedData[0][3]=="closure"){
                     $('#diagnosis').hide();
                     $('#resolution').hide();
                     $('#closure').hide();
                     $('#review').show();                    

             }
                 
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
        url: "/freshgrc/php/incident/incidentlist.php",
        data: userCredentials,
        success: success
    });
    $(".datepickerClass").each(function() {
        $(this).datepicker({
            dateFormat: "yy-mm-dd",
            minDate:-90,
            maxDate:0,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099"  
        });
    });
     $(".datepickerforrep").each(function() {
        $(this).datepicker({
            dateFormat: "yy-mm-dd",
            minDate:0,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099"  
        });
    });

});

var table;

function tableInit() {

    table = $('#modaldetails').DataTable({
        select: {
            style: 'single'
        },
        "ordering":false,
        columnDefs: [
            {
                targets: [0,6],
                visible: false
            }
        ]
    });
}
function success(data) {
    buildHtmlTable(data);
    tableInit();
}
function buildHtmlTable(data) {    
    var columns = addAllColumnHeaders(data);
    for (var i = 0; i < data.length; i++) {
        var row$ = $('<tr/>');
        for (var colIndex = 0; colIndex < columns.length; colIndex++) {
            var cellValue = data[i][columns[colIndex]];
            var incidentstatus = data[i].IncidentStatus;
            if (colIndex == 4 && "Assigned" == incidentstatus){
              cellValue="Assigned";
              row$.append($('<td class="btn"  style="width:114px; height:50% ; background-color:#5cb85c; color:#fff; text-align:center;margin: 10px;"/>').html(cellValue));   
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

function showModal(isUpdate) {
    $('#myModal').modal('show');
    if (isUpdate) {
        prepareModalForUpdate();
    } else {
        $('#action').val('create');
    }
}
function incidentUrgency(value)
{
    

       $('#incidenturgency').val(value);
}
function incidentImpact(value)
{
  

       $('#incidentimpact').val(value);
}
function diagonsisUrgency(value)
{
    

       $('#diagonsisurgency').val(value);
}
function diagonsisImpact(value)
{
  

       $('#diagonsisimpact').val(value);
}

function getModalDetailsFromModal() {  
    var modalDetails = {
        'loggInUser': $('#loggedInUser').val(),
        'Title': $('#system_name').val(),
        'Type': $('#requesttype').val(),
        'source': $('#source').val(),
        'contact_no': $('#phone').val(),
        'Category': $('#incidentcategory').val(),
        'sub_category': $('#subcategory').val(),
        'date_occured': $('#date_occured').val(),
        'date_filing': $('#date_filling').val(),
        'reported_by': $('#reportedby').val(),
        'Recorded_By': $('#recordedby').val(),
        'urgency': $('#incidenturgency').val(),
        'impact': $('#incidentimpact').val(),
        'priority':$('#priority').val(),
        'incident_response_team':$('#incidentresponsetime').val(),
        'summary':$('#summary').val(),
        'comment':$('#comment').val(),
        'action':'create',
        'company_id':$('#company').val(),
        'impacteddepartment':$('#impacteddepartment').val(),
        'lineofbusiness':$('#lineofbusiness').val(),
        'channelimpacted':$('#channelimpacted').val(),
        'description_of_event':$('#description_of_event').val(),
        'reportingdepartment':$('#reportingdepartment').val(),
        'eventtype':$('#eventtype').val()
    }
    return modalDetails;
}




function saveincident() { 
    var arr="";
    if (document.getElementById("system_name").value== 0) {
        arr+="Incident";
    } 
    if (document.getElementById("requesttype").value== 0) {
        if(arr=="")
        {
        arr+="requesttype";
        }
        else{
        arr+=",requesttype";
        }
    } 


     if (document.getElementById("source").value== 0) {
        if(arr=="")
        {
        arr+="source";
        }
        else{
        arr+=",source";
        }
    } 

      if (document.getElementById("phone").value== 0) {
        if(arr=="")
        {
        arr+="phone";
        }
        else{
        arr+=",phone";
        }
    } 


      if (document.getElementById("incidentcategory").value== 0) {
        if(arr=="")
        {
        arr+="incidentcategory";
        }
        else{
        arr+=",incidentcategory";
        }
    } 


      if (document.getElementById("date_occured").value== 0) {
        if(arr=="")
        {
        arr+="date_occured";
        }
        else{
        arr+=",date_occured";
        }
    } 


      if (document.getElementById("date_filling").value== 0) {
        if(arr=="")
        {
        arr+="date_filling";
        }
        else{
        arr+=",date_filling";
        }
    } 


      if (document.getElementById("reportedby").value== 0) {
        if(arr=="")
        {
        arr+="reportedby";
        }
        else{
        arr+=",reportedby";
        }
    } 


      if (document.getElementById("incidenturgency").value== 0) {
        if(arr=="")
        {
        arr+="incidenturgency";
        }
        else{
        arr+=",incidenturgency";
        }
    } 


      if (document.getElementById("incidentimpact").value== 0) {
        if(arr=="")
        {
        arr+="incidentimpact";
        }
        else{
        arr+=",incidentimpact";
        }
    } 


      if (document.getElementById("priority").value== 0) {
        if(arr=="")
        {
        arr+="priority";
        }
        else{
        arr+=",priority";
        }
    } 


      if (document.getElementById("incidentresponsetime").value== 0) {
        if(arr=="")
        {
        arr+="incidentresponsetime";
        }
        else{
        arr+=",incidentresponsetime";
        }
    } 


      if (document.getElementById("summary").value== 0) {
        if(arr=="")
        {
        arr+="summary";
        }
        else{
        arr+=",summary";
        }
    } 


     if (document.getElementById("comment").value== 0) {
        if(arr=="")
        {
        arr+="comment";
        }
        else{
        arr+=",comment";
        }
    } 

      if (document.getElementById("impacteddepartment").value== 0) {
        if(arr=="")
        {
        arr+="impacteddepartment";
        }
        else{
        arr+=",impacteddepartment";
        }
    } 

      if (document.getElementById("lineofbusiness").value== 0) {
        if(arr=="")
        {
        arr+="lineofbusiness";
        }
        else{
        arr+=",lineofbusiness";
        }
    } 

      if (document.getElementById("channelimpacted").value== 0) {
        if(arr=="")
        {
        arr+="channelimpacted";
        }
        else{
        arr+=",channelimpacted";
        }
    } 
if (document.getElementById("eventtype").value=='Select') {
        if(arr=="")
        {
        arr+="eventtype";
        }
        else{
        arr+=",eventtype";
        }
    } 
    if (document.getElementById("reportingdepartment").value=='Select') {
        if(arr=="")
        {
        arr+="reportingdepartment";
        }
        else{
        arr+=",reportingdepartment";
        }
    } 
    if (document.getElementById("description_of_event").value== 0) {
        if(arr=="")
        {
        arr+="description_of_event";
        }
        else{
        arr+=",description_of_event";
        }
    } 

    if(arr==""){
            var   modalDetails= getModalDetailsFromModal();

          $.ajax({
        type: "POST",
        url: "/freshgrc/php/incident/manageIncident.php",
        data: modalDetails
    }).done(function (data) {
        debugger
         swal({ 
           title:  'Diagnosis Completed!',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'Ok',
           timer: 3500
        });
window.location="/freshgrc/view/incident/incidentList.php";


    });
    }
    else{
    alert("Enter the field "+arr);    
    }

console.log(arr);
    
}





function performIncidentDiagnosis() {    
    var selectedData = table.rows('.selected').data();
    if(selectedData[0][4]=="Recorded"){
    window.location = "/freshgrc/view/incident/diagnosis.php?IncidentId=" + selectedData[0][0];

}
 if(selectedData[0][4]=="Assigned"){
    window.location = "/freshgrc/view/incident/diagnosis.php?IncidentId=" + selectedData[0][0];

}

}
function performIncidentResolution() {    
    var selectedData = table.rows('.selected').data();
 if(selectedData[0][4]=="Assigned"){
    window.location = "/freshgrc/view/incident/resolution.php?IncidentId=" + selectedData[0][0];

 }

}
function performIncidentClosure() {    
    var selectedData = table.rows('.selected').data();
   
 var length = selectedData.length;
    if (length>0) {
    window.location = "/freshgrc/view/incident/closure.php?IncidentId=" + selectedData[0][0];
 }

}
function performIncidentReview() {    
    var selectedData = table.rows('.selected').data();
   
 var length = selectedData.length;
    if (length>0) {
     window.location = "/freshgrc/view/incident/review.php?IncidentId=" + selectedData[0][0];
}

}

function getSubCategory(){    
    var Category = {
        'category': $('#incidentcategory').val()
    } 
     $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/incident/incidentsubcategory.php",
        data: Category,
        success: function(data){            
            $('#subcategory').html("");
        $.each(data, function(i, value) {
        
            
            $('#subcategory').append($('<option>').text(data[i].name).attr('value', data[i].id));
        });

        }
    });


}

function getDiagnosisDetailsFromModal(IncidentId) { 
    var modalDetailsDiagnosis = {
        'manager_urgency' :$('#diagonsisurgency').val(),
        'manager_impact': $('#diagonsisimpact').val(),
        'action' : 'managed',
        'manager_priority': $('#manager_priority').val(),
        'manager_sla': $('#manager_sla').val(),
        'assignee': $('#assignee').val(),
        'escalation_users': $('#escalation_users').val(),
        'IncidentId' : IncidentId,       
        'loggInUser': $('#loggedInUser').val(),
        'category' :$('#category').val(),
        'subCategory' : $('#subCategory').val(),
        'category2' : $('#category2').val(),
        'quantified_loss' : $('#quantified_loss').val(),
        'currency' : $('#currency').val(),
        'realised_loss' : $('#realised_loss').val(),
        'policies_impacted' : $('#policies_impacted').val(),

      
    }
    return modalDetailsDiagnosis;
}

function savediagnosis(IncidentId){    
    var modalDetailsDiagnosis= getDiagnosisDetailsFromModal(IncidentId);
    
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/incident/manageIncident.php",
        data: modalDetailsDiagnosis
    }).done(function (data) {
         swal({ 
           title:  'Diagnosis Completed !',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'OK',
           timer: 3500
        });
 window.location="/freshgrc/view/incident/incidentList.php";

    });
}

function getResolutionDetailsFromModal(IncidentId) {    
    
    var modalDetails = {        
        'action' : 'resolved', 
        'IncidentId' : IncidentId,       
        'course_classification': $('#course_classification').val(),  
        'actiontaken': $('#actiontaken').val(),         
        'managementactionplan': $('#managementactionplan').val(),
        'selectimapctstatus': $('#selectimapctstatus').val(),         
        'litigationstatus': $('#litigationstatus').val(), 
        'litigatestatus': $('#litigatestatus').val(),        
        'comment': $('#comment').val(),
        'loggInUser': $('#loggedInUser').val(),
        
    }
    return modalDetails;
}
function saveResolution(IncidentId){  
var   modalDetails= getResolutionDetailsFromModal(IncidentId);
    
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/incident/manageIncident.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Diagnosis Completed !',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 3500
        });
 window.location="/freshgrc/view/incident/incidentList.php";

    });
}


function getClosureDetailsFromModal(IncidentId) {  
debugger  
    var modalDetails = {
        'IncidentId' :IncidentId,
        'action' : 'closure',
        'loggInUser': $('#loggedInUser').val(),
        'root_cause' :$('#root_cause').val(),
        'evaluate': $('#evaluate').val(),
        'review_status': $('#review_status').val(), 
      

    }
    return modalDetails;
}
function closure(IncidentId){  
    debugger
var   modalDetails= getClosureDetailsFromModal(IncidentId);
    
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/incident/manageIncident.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title: 'Diagnosis Completed !',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 3500
        });
 window.location="/freshgrc/view/incident/incidentList.php";

    });
}
