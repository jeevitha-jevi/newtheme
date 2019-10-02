

    $(document).ready(function() {
        debugger
    
    
    $('#modaldetails').on('click', 'tr', function(){
        if ($(this).hasClass('selected')){
             var selectedData = table.rows('.selected').data();
             
             if(selectedData[0][3]=="tested"){
                     $('#train').show();
                     $('#test').hide();
                     $('#create').hide();
                     
             }
              if(selectedData[0][3]=="create"){
                     $('#train').hide();
                     $('#test').show();
                     $('#create').hide();
                    
             } 
             if(selectedData[0][3]=="trained"){
                     $('#train').show();
                     $('#test').hide();
                     $('#create').hide();                    

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
        url: "/freshgrc/php/disaster/disasterlist.php",
        data: userCredentials,
        success: success
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
                // targets: [0,5],
                visible: true
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
    $('#manageButton').text('Update');
    $('#action').val('update');
}


function getModalDetailsFromModal() {
    debugger



    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'action': 'create',
        'summary': $('#summary').val(),
        'purpose': $('#purpose').val(),
        'disaster_definition': $('#disaster_definition').val(),
        'assumption': $('#assumption').val(),
        'company_name': $('#company_name').val(),
        'contracted_name': $('#contracted_name').val(),
        'covered_system_name': $('#covered_system_name').val(),
        'internal_name': $('#internal_name').val(),
        'internal_phone': $('#internal_phone').val(),
        'internal_email': $('#internal_email').val(),
        'internal_system': $('#internal_system').val(),
        'internal_role_description':$('#internal_role_description').val(),
        'external_name':$('#external_name').val(),
        'external_phone':$('#external_phone').val(),
        'external_email':$('#external_email').val(),
        'external_system':$('#external_system').val(),
        'external_role_description':$('#external_role_description').val(),
        'system_category':"1",
        'system_resource_type':$('#system_resource_type').val(),
        'scope':$('#scope').val(),
        'system_resource_name':$('#system_resource_name').val(),
        'system_resource_description':$('#system_resource_description').val(),
        'areawide_disaster':$('#areawide_disaster').val(),
        'critical_contract':"1",
        'critical_resources':"1",
        'impact_resource':"1",
        'impact_outage_impact':$('#impact_outage_impact').val(),
        'impact_resource_name':$('#impact_resource_name').val(),
        'impact_allowable_outage':$('#impact_allowable_outage').val(),
        'business_impact_scale':"1",
        'recovery_resource':$('#recovery_resource').val(),
        'recovery_comments':$('#recovery_comments').val(),
        'status':"create",
        'company_id':"1",
        
    }
    return modalDetails;
}
function manageModal4(){ 
debugger 
var   modalDetails= getModalDetailsFromModal();
    
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/disaster/manageDisaster.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Plan Created!',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
 window.location="/freshgrc/view/disaster/disasterlist.php";

    });
}

function performDMActions() {
    debugger
    var selectedData = table.rows('.selected').data();
    if(selectedData[0][3]=="create"){
    window.location = "/freshgrc/view/disaster/disasterTest.php?id=" + selectedData[0][0];
}
 if(selectedData[0][3]=="tested"){
    window.location = "/freshgrc/view/disaster/disasterTraining.php?id=" + selectedData[0][0];
}
 if(selectedData[0][3]=="trained"){
    window.location = "/freshgrc/view/disaster/disasterReport.php?id=" + selectedData[0][0];
}
 
 
}


