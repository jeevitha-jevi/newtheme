



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
        url: "/freshgrc/php/disaster/disasterTestList.php",
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




function getModalDetailsFromModal() {
    debugger



    var modalDetails = {
        'disaster_plan_id' :$('#disaster_plan_id').val(),
        'loggedInUser': $('#loggedInUser').val(),
        'action' : 'tested',
        'system_name': $('#system_name').val(),
        'poc': $('#poc').val(),
        'organisation': $('#organisation').val(),
        'date': $('#date').val(),
        'system_manager': $('#system_manager').val(),
        'system_description': $('#system_description').val(),
        'backup_system_name': $('#backup_system_name').val(),
        'backup_backup': $('#backup_backup').val(),
        'backup_company_name': $('#backup_company_name').val(),
        'backup_offsite_location': $('#backup_offsite_location').val(),
        'backup_contractor_name': $('#backup_contractor_name').val(),
        'software_and_hardware_configuration': $('#software_and_hardware_configuration').val(),
        'alternate_site_software_and_hardware_configuration': $('#alternate_site_software_and_hardware_configuration').val(),
        'number_of_test_completed':$('#number_of_test_completed').val(),
        'test_no':$('#test_no').val(),
        'test_date':$('#test_date').val(),
        'system_to_be_tested':$('#system_to_be_tested').val(),
        'status':"tested",
        'company_id':"1",
        'created_by':"disaster_tester"
        
    }
    return modalDetails;
}
function manageModal(){ 
debugger 
var   modalDetails= getModalDetailsFromModal();
    
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/disaster/manageDisaster.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Test Completed !',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
 window.location="/freshgrc/view/disaster/disasterTestList.php";

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
