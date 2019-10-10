$(document).ready(function () {
    //setTimeout(tableInit, 2000);
    $.ajax({
        dataType: "json",
        url: "/freshgrc/php/company/companylist.php",
        data: "",
        success: success
    });
});

var table;

function tableInit() {

    table = $('#companyDetails').DataTable({
        select: {
            style: 'single'
        },
        columnDefs: [
            {
                targets: [0,3],
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

            if (cellValue == null) {
                cellValue = "";
            }

            row$.append($('<td/>').html(cellValue));
        }
        $("#companyDetails").append(row$);
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

function showCompanyModal(isUpdate) {
    $('#myModal').modal('show');
    if (isUpdate) {
        prepareModalForUpdate();
    } else {
        $('#action').val('create');
    }
}

function prepareModalForUpdate() {
    var selectedUser = table.rows('.selected').data();
    $('#companyId').val(selectedUser[0][0]);
    $('#companyName').val(selectedUser[0][1]);
    $('#indstry').val(selectedUser[0][3]);
    $('#managerCompanyButton').text('Update');
    $('#action').val('update');
}

function showDeleteDialog() {
    var selectedUser = table.rows('.selected').data();
    $('#myModal2').modal('show');
    $('#companyId_delete').val(selectedUser[0][0]);
}

function getCompanyDetailsFromModal() {
        var companyDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'companyId': $('#companyId').val(),
        'action': $('#action').val(),
        'companyName': $('#companyName').val(),
        'industry': $('#indstry').val(),
        'updated_by': $('#updated_by').val(),
        'plan_id': $('#plan_id').val(),
    }
    return companyDetails;
}

function manageCompany() {
    debugger
    var companyDatails = getCompanyDetailsFromModal();

    $.ajax({
        type: "POST",
        url: "/freshgrc/php/company/manageCompany.php",
        data: companyDatails
    }).done(function (data) {
        location.reload();
    });
}

function deleteCompany() {
    var companyDatails = {
        'companyId': $('#companyId_delete').val(),
        'action': 'delete'
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/company/manageCompany.php",
        data: companyDatails
    }).done(function (data) {
        location.reload();
    });
}
function addLocationToCompany(){
    var selectedCompany = table.rows('.selected').data();
    window.location = "/freshgrc/view/superadmin/companyLocationAdmin.php?companyId=" + selectedCompany[0][0];

}
