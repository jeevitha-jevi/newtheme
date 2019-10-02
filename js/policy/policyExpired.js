$(document).ready(function () {     

    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    }   

    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/policy/policylistExpired.php",
        data: userCredentials,
        success: success
    }); 

    $("#hiddenText").each(function() {
        $(this).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099",
            onSelect: function(dateText) {
                table = $('#modaldetails').DataTable()
                var selectedData = table.rows('.selected').data();
                if(selectedData.length == 0)
                    return;
                var extendDetails = {
                    'policyId': selectedData[0][0],
                    'date': $('input:text').val(),
                    'loggedInUser': $('#loggedInUser').val(),
                    'action': "extend"
                }
                $.ajax({
                   type: "POST",
                   url: "/freshgrc/php/policy/managePolicy.php",
                   data: extendDetails 
                }).done(function(data){
                    swal({ 
                        title:  'Policy Extended',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText:'ok',
                        type: "success",
                              }, function () {
                                      setTimeout(function () {
                                        location.reload();
                                    });
                     
                         });
                });
           }
        });
    });

    $(function() {
        $(".datepickerClass").datepicker();
        $('.ui-datepicker').addClass('notranslate');
    });
    
    $('#extendButton').click(function() {
        $('#hiddenDate').datepicker("show");
    });

    getSubPolicy();
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
    });

    $('#modaldetails tbody').on('dblclick', 'tr', function () {
        var data = table.row( this ).data();
        var policyData = {
            'action' : 'view',
            'policyId' : data[0]
        }
        $.ajax({
            dataType: "json",
            type: "POST",
            url: "/freshgrc/php/policy/managePolicy.php",
            data: policyData,
            success: viewPolicyData
        }); 
    } );
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

            if (cellValue == null) {
                cellValue = "";
            }

            row$.append($('<td/>').html(cellValue));
        }
        $("#modaldetails").append(row$);
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
function showPolicyPlan() {
    window.location = "/freshgrc/view/policy/policyPlan.php";
}
function showPolicyReview() {
    var selectedData = table.rows('.selected').data();

    if (selectedData[0][3] == "identified" || selectedData[0][3] == "Returned") {
         window.location = "/freshgrc/view/policy/policyPublish.php?PolicyId=" + selectedData[0][0];
    }    
}
function showPolicyApprove() {
    var selectedData = table.rows('.selected').data();
    var length = selectedData.length;
    if (length>0) {
         window.location = "/freshgrc/view/policy/policyApprove.php?PolicyId=" + selectedData[0][0];
    }    
}
function policyClasification(id) {
    
       $('#policy_classification').val(id);
}

function policyprocedure(id){
    $('#policy_procedure').val(id);
}
function policyAudience(id) {
       $('#audience').val(id);         
}
 

function securityClasification(){
    
    if( $('#securityClassification').prop('checked'))
    {
        $('#security_classification').val("1");
      
    }
    else{
      $('#security_classification').val("2");  
    }

    
}

function getModalDetailsFromPlan() { 
    debugger
    
var action = "create"; 
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'title': $('#title').val(),
        'policy_type': $('#policytype').val(),
        'security_classification': $('#security_classification').val(),
        'policy_classification': $('#policy_classification').val(),
        'audience': $('#audience').val(),
        'scope': $('#scope').val(),
        'purpose': $('#purpose').val(),
        'description': $('#description').val(),
        //'notes': $('#notes').val(),
        'owner': $('#policyowner').val(),
        'reviewer': $('#policyreviewer').val(),
        'approver': $('#policyapprover').val(),
        'effective_from': $('#effective_form').val(),
        'effective_till': $('#effective_till').val(),
        'expected_publish_date': $('#expected_publish_date').val(),
        'review_within_date': $('#review_within_date').val(),
        'policy_procedure': $('#policy_procedure').val(),
        'organization_type_id': $('#organization_type_id').val(),
        'subPolicy':$('#subPolicy').val(),
        'action':action,       

    }
    return modalDetails;
}


function validate() {
    if($('#loggedInUser').val() == ""){
        return false;
    }
    if($('#title').val() == ""){
        return false;
    }
    if($('#policytype').val() == ""){
        return false;
    }
    if($('#scope').val() == ""){
        return false;
    }
    if($('#purpose').val() == ""){
        return false;
    }
    if($('#description').val() == ""){
        return false;
    }
    if($('#policyowner').val() == ""){
        return false;
    }
    if($('#policyreviewer').val() == ""){
        return false;
    }
    if($('#policyapprover').val() == ""){
        return false;
    }
    if($('#effective_from').val() == ""){
        return false;
    }
    if($('#effective_till').val() == ""){
        return false;
    }
   
    if($('#expected_publish_date').val() == ""){
        return false;
    }
    if($('#review_within_date').val() == ""){
        return false;
    }
    if($('#document_forward_reference').val() == ""){
        return false;
    }
    if($('#security_backward_reference').val() == ""){
        return false;
    }
    if($('#policy_procedure').val() == ""){
        return false;
    }
    return true;
}

function expirydaterror(){
    var a=new Date($('#effective_form').val());
   var b=new Date($('#effective_till').val());
   var c=new Date($('#expected_publish_date').val());
   var d=new Date($('#review_within_date').val());

   debugger

     if (a>b || a>c || a>d){
         return false;
       }
       else{
        return true;
       }

}
function savePolicyPlan() {

    if(!validate()){
        swal({ 
            title:  'Please fill all the fields',
            type: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText:'ok'
         });
         return;
    }

    if(!expirydaterror()){
        swal({ 
            title:  'Expiry,Review,Expected Date should be ahead of Policy Creation',
            type: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText:'ok'
         });
         return;
    }


    var modalDetails = getModalDetailsFromPlan();
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/policy/managePolicy.php",
        data: modalDetails,
        success: savePolicyControl
    });    
}

 function savePolicyControl(data){
 var controls1 = []; 
 var controls2 = [];
 var controls3 = []; 
 var controls=[];
        
        $('.mainheading').each(function (index) {
                                        
            controls1.push($(this).val());     
        });
        $('.subheading').each(function (index)
        {
            
            controls2.push($(this).val());
        }) ;
         $('.description').each(function (index)
        {
            
            controls3.push($(this).val());
        });
         var i;
for( i=0;i<controls1.length;i++){
controls.push({
    'statement':i+1,
    'mainHeading':controls1[i],
    'subHeading':controls2[i],
    'description':controls3[i]
});

}
var controls4=controls;  
 
 var controlDetails = {
    'policy_id': data,
    'controls': controls4,
    'action': 'create', 
 } 

$.ajax({
    type: "POST",
    url: "/freshgrc/php/policy/managePolicy.php",
    data: controlDetails,
    success: function(data){
        swal({ 
            title:  'Successfully Updated',
            type: "success",
            timer: 1000,
            showConfirmButton: false
        });
        setTimeout(function(){window.location = "/freshgrc/view/policy/policyAdmin.php"},1000);        
    }
}); 
   
    

 }

 function savePublish(PolicyId){     
    var action = "publish";
    var publishDetails = {
        'policy_id': PolicyId,
        'loggedInUser': $('#loggedInUser').val(),
        'comments': $('#comment').val(),
        'status': $('#status').val(),
        'action': action,
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/policy/managePolicy.php",
        data: publishDetails        
    }).done(function(data){        
          window.location = "/freshgrc/view/policy/policyAdmin.php";
    });
 }

 function saveMailToUsers(){    
    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    } 
    
   $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/policy/sendingemail.php",
        data: userCredentials,
        success: sendMailToUser        
    });

 }
 function getSubPolicy(){

        var modalDetails= {'id':$('#policytype').val(),
                            'oldSubPolicy':$('#oldSubPolicy').val()};

        $.ajax({
        type: "POST",
        url: "/freshgrc/view/policy/policysubpolicy.php",
        data: modalDetails,
        success:function(data){
            $('#subPolicydropdown').html(data);
        
        }
    });
         
    }

 function sendMailToUser(data){    
     var mailDetails = {
        'sendFrom': data[0].email,
        'sendTo': $('#distributionuser').val(),
        'subject': $('#subject').val(),
        'content': $('#content').val(),
        }
        $.ajax({
        type: "POST",
       url: "/freshgrc/php/policy/policyMailCtrlManager.php",
        data: mailDetails,
        success: function(data){
            
        }       
    });

 }
 function viewReport() {
    var selectedData = table.rows('.selected').data();
    var length = selectedData.length;
    if (length>0) {
         window.location = "/freshgrc/view/policy/policyReport.php?PolicyId=" + selectedData[0][0];
    }    
}

 function viewPolicyData(data) {
    var heading = document.querySelector('#policyDetailsModal h4');
    heading.innerHTML = "<b>" + data[0].Title + "<b>";
    var details = document.querySelectorAll('#policyDetailsModal p');
    details[0].innerHTML  = data[0].policyType;
    details[1].innerHTML  = data[0].audience;
    details[2].innerHTML  = data[0].policyClassification;
    details[3].innerHTML  = data[0].securityClassification;
    details[4].innerHTML  = data[0].scope;
    details[5].innerHTML  = data[0].purpose;
    details[6].innerHTML  = data[0].description;
    details[7].innerHTML  = data[0].owner;
    details[8].innerHTML  = data[0].effective_from;
    details[9].innerHTML  = data[0].effective_till;
    details[10].innerHTML = data[0].expected_publish_date;
    details[11].innerHTML = data[0].review_within_date;
    $('#policyDetailsModal').modal('show');
 }

 function deletePolicy() {
    table = $('#modaldetails').DataTable()
    var selectedData = table.rows('.selected').data();
    var action = "delete";
    var publishDetails = {
        'policyId': selectedData[0][0],
        'action': action,
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/policy/managePolicy.php",
        data: publishDetails        
    }).done(function(data){
        swal({ 
            title:  'Policy Deleted',
            confirmButtonColor: '#3085d6',
            confirmButtonText:'ok',
            type: "error",
                  }, function () {
                          setTimeout(function () {
                              window.location = "/freshgrc/view/policy/policyExpired.php";
                        });
         
             });  
    });
 }

 function deletePolicyId(policy_id)
{
    var action = "delete";
    var publishDetails = {
        'policyId': policy_id,
        'action': action,
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/policy/managePolicy.php",
        data: publishDetails        
    }).done(function(data){        
    });
}
 function goToEditPage(){
    table = $('#modaldetails').DataTable()
    var selectedData = table.rows('.selected').data();
    window.location =  "/freshgrc/view/policy/policyEdit.php?PolicyId=" + selectedData[0][0];
 }