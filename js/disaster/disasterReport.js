$(document).ready(function() { $.fn.dataTable.ext.errMode = 'none'; });

    $(document).ready(function() {
        
    
    
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
             if(selectedData[0][3]=="training"){
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
        url: "/freshgrc/php/disaster/disasterReportList.php",
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

        'disaster_plan_id' :$('#disaster_plan_id').val(),
        'loggedInUser': $('#loggedInUser').val(),
        'action': "training",
        'training_date': $('#training_date').val(),
        'training': $('#training').val(),
        'plan_review_date': $('#plan_review_date').val(),
        'revision_date': $('#revision_date').val(),
        'summary_of_changes': $('#summary_of_changes').val(),
        'approval_revision_date': $('#approval_revision_date').val(),
        'approval_date': $('#approval_date').val(),
        'approver_name_and_sign': $('#approver_name_and_sign').val(),
        'status':"training",
        
    }

    return modalDetails;
}
function manageModal5() 
{  
var   modalDetails= getModalDetailsFromModal();
    
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/disaster/manageDisaster.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Training completed!',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
 window.location="/freshgrc/view/disaster/disasterTrainingList.php";

    });
}

function performDMActions() {
    
    var selectedData = table.rows('.selected').data();
    if(selectedData[0][3]=="create"){
    window.location = "/freshgrc/view/disaster/disasterTest.php?id=" + selectedData[0][0];
}
 if(selectedData[0][3]=="tested"){
    window.location = "/freshgrc/view/disaster/disasterTraining.php?id=" + selectedData[0][0];
}
 if(selectedData[0][3]=="training"){
    window.location = "/freshgrc/view/disaster/disasterReport.php?id=" + selectedData[0][0];
}
 
 
}


