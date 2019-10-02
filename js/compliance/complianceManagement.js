$(document).ready(function () {
    debugger;
    //Disable the compliance management buttons
    $('#newCompl').show();
    $('#importCompl').show();
    $('#editCompl').hide();
    $('#deleteCompl').hide();
    $('#manageCompl').hide();
    $('#modaldetails1').on('click', 'tr', function(){
        if ($(this).hasClass('selected')){
            $('#newCompl').hide();
            $('#importCompl').hide();
            $('#editCompl').show();
            $('#deleteCompl').show();
            $('#manageCompl').show();           
        } else {
            $('#newCompl').show();
            $('#importCompl').show();
            $('#editCompl').hide();
            $('#deleteCompl').hide();
            $('#manageCompl').hide();            
        }
    });
    
    $.ajax({
        dataType: "json",
        url: "/freshgrc/php/compliance/compliancelist.php",
        data: "",
        success: success
    });
});




var table;

function tableInit() {

    table = $('#modaldetails1').DataTable({
        select: {
            style: 'single'
        },
        columnDefs: [
            {
                targets: [0,5],
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
        $("#modaldetails1").append(row$);
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
    debugger
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

function showDeleteDialog() {
    debugger
    var selectedData = table.rows('.selected').data();
    $('#myModal2').modal('show');
    $('#complianceId_delete').val(selectedData[0][0]);
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
    debugger
    var modalDetails1 = getModalDetailsFromModal1();
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/compliance/manageCompliance.php",
        data: modalDetails1
    }).done(function (data) {
        location.reload();
    });
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


function showComplClause() {
    var selectedData = table.rows('.selected').data();
    window.location = "/freshgrc/view/compliance/clauseAdmin.php?complianceId=" + selectedData[0][0];
}

function importCsv() {
    //var selectedData = table.rows('.selected').data();
    //var complianceId = selectedData[0][0];
    $('#complianceCsv').click();
    var myFormData = new FormData();
    myFormData.append('complianceCsv', complianceCsv.files[0]);
    //myFormData.append('complianceId', complianceId);
    myFormData.append('loggedInUser', $('#loggedInUser').val());
    var csvName = complianceCsv.files[0].name;
    $.ajax({
        url: "/freshgrc/php/compliance/importCompliance.php",
        type: "POST",
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        success: function (data) {
            //alert('Successfully uploaded : '+data);
            location.reload();
        },
        error: function () {}
    });
}
