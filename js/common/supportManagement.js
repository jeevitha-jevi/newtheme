$(document).ready(function () {
    // debugger;
    $(".datepickerClass").each(function() {
        $(this).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099"  
        });
    });
       $('#create1').show();
       $('#reportButton').hide();
       $('#kickOffbtn').show();
       $('#CheckForAuditorbtn').hide();
       $('#auditeeDoPending').hide();
       $('#btnForApproved').hide();
       $('#btnForRespond').hide();
    $('#support').on('click', 'tr', function(){
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
    // debugger
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/common/supportTicket.php",
        data: userCredentials,
        success: success
    });
});

var table;

function tableInit() {
    table = $('#support').DataTable({
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
        // columnDefs: [ {
        //     targets: [0],
        //     visible: false
        // } ],
        "ordering": false
    });
}

function success(data) {
	
    buildHtmlTable(data);
    tableInit();
}

function buildHtmlTable(data) {
    var columns = addAllColumnHeaders(data);
    for (var i = 0; i < data.length; i++) {
        // debugger
        var row$ = $('<tr/>');
        for (var colIndex = 0; colIndex < columns.length; colIndex++) {
            // debugger
             var cellValue = data[i][columns[colIndex]];
         
           
            if (cellValue == null) {
                cellValue = "";
            }

            row$.append($('<td/>').html(cellValue));
        }

        $("#support").append(row$);
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
function showSupportModal(isUpdate) {
    // debugger
    $('#supportModal').modal('show');

    if (isUpdate) {
        prepareSupportModalForUpdate();
        $('#actionSupport').val('update');
        $('#statusModal').show();
        $('#supportCreate').hide();
        $('#supportUpdate').show();
    } else {
        $('#actionSupport').val('create');
        $('#statusModal').hide();
        $('#supportCreate').show();
        $('#supportUpdate').hide();
        $('#assignedToDropDown').show();
    }
}
function prepareSupportModalForUpdate(){
    // debugger
    var selectedData = table.rows('.selected').data();
    $('#supportId').val(selectedData[0][0]);
    $('#title').val(selectedData[0][1]);
    $('#title').prop('disabled',true);
    $('#customerName').val(selectedData[0][2]);
    $('#customerName').prop('disabled',true);
    $('#customerEmail').val(selectedData[0][3]);
    $('#customerEmail').prop('disabled',true);
    $('#assignedToDropDown').hide();
}
function getModalDetailsFromModal1() {
    debugger
    var modalDetails1 = {
        'title': $('#title').val(),
        'customername': $('#customerName').val(),
        'action': $('#actionSupport').val(),
        'customeremail': $('#customerEmail').val(),
        // 'assignedto': $('#assignedto').val()
    }
    return modalDetails1;
}

function saveSupport() {
    // debugger
    var modalDetails1 = getModalDetailsFromModal1();
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/common/manageSupport.php",
        data: modalDetails1
    }).done(function (data) {
        location.reload();
    });
}
function updateSupport(){
    // debugger
    var modalDetails1 = getModalDetailsFromModalForUpdate();
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/common/manageSupport.php",
        data: modalDetails1
    }).done(function (data) {
        location.reload();
    });
}
 function getModalDetailsFromModalForUpdate(){
    var modalDetails1={
        'id':$('#supportId').val(),
        'status':$('#status').val(),
        'action':$('#actionSupport').val()
    }
    return modalDetails1;
 }
  function showDeleteDialogSupport() {
    var selectedData = table.rows('.selected').data();
    $('#supportModalDelete').modal('show');
      $('#complianceId_delete').val(selectedData[0][0]);
      $('#title_name').val(selectedData[0][1]);
     $('#customer_Name').val(selectedData[0][2]);
      $('#customerEmail_delete').val(selectedData[0][3]);
  }

function deleteModalSupport() {
  
    var modalDetails = {
        'complianceId_delete':$('#complianceId_delete').val(),
        'action': 'delete'
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/common/manageSupport.php",
        data: modalDetails
    }).done(function (data) {
        location.reload();
    });
}
