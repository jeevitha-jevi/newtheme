function analyzeClause(checklistId)
{
    $('#myModal').modal('show');
    $('#checklistId').val(checklistId);
}

function analyze(){
	debugger

	var modalDetails={
		'id':$('#checklistId').val(),
		'treatmentStrategy':$('#treatmentStrategy').val(),
		'complianceEfficacy':$('#complianceEfficacy').val(),
		'mitigationControl':$('#controls').val(),
		'complianceException':$('#projectname').val()
	};

	$.ajax({
        type: "POST",
        url: "/freshgrc/php/compliance/manageChecklistAnalyzeForm.php",
        data: modalDetails
    }).done(function (data) {
        location.reload();
    });
}


function treat(value)
{
  debugger  

       $('#treatmentStrategy').val(value);
      /* analyze();*/
     
  
   //return auditType;
}
function updateScore(){
	debugger
	document.getElementById("scoreAnalyze").innerHTML=$('#complianceEfficacy').val();
}
function getControls(){
	debugger
	 var compliance=$('#compliance').val();
    var modalDetails={'id':compliance};
      $.ajax({
        type: "POST",
        url: "/freshgrc/view/common/controlsDropDown.php",
        data: modalDetails,
        success:function(data){
            $('#controlsDrop').html(data);
        
        }
    });
}

function saveComplStatus(isDraft){
    debugger
    var status=$('#currentWorkingStatus').val();
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'complianceId': $('#complianceId').val(),
        'status': $('#currentWorkingStatus').val(),
        'action': 'saveComplianceStatusForAnalyze',
        'isDraft': isDraft
    } 
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/compliance/manageCompliance.php",
        data: modalDetails
    }).done(function (data) {
        /*location.reload();*/
        
        
        
         window.location="/freshgrc/view/compliance/complianceReportAdmin.php";    
        
    });
    
}