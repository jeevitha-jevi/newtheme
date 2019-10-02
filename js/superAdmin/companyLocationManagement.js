$(document).ready(function () {
    
    var companyId=$('#companyId').val();
    //alert(companyId);
    //setTimeout(tableInit, 2000);
    var data={'companyId':companyId};
    $.ajax({
        dataType: "JSON",
        url: "/freshgrc/php/company/comanyLocationlist.php",
        data: data,
        success: success
    });

});


var table;
function tableInit() {

    table = $('#locationDetails').DataTable({
        select: {
            style: 'single'
        },
        columnDefs: [
            {
                targets: [0,5,6,7],
                visible: false
            }
        ]         
    });
}

function success(data) {
    //data=JSON.parse(data);
    console.log(data);
    buildHtmlTable(data);
    tableInit();
}

function buildHtmlTable(data) {
    var columns = addAllColumnHeaders(data);
    console.log(columns.length);
    for (var i = 0; i < data.length; i++) {
        var row$ = $('<tr/>');
        for (var colIndex = 0; colIndex < columns.length; colIndex++) {

            var cellValue = data[i][columns[colIndex]];

            if (cellValue == null) {
                cellValue = "";
            }

            row$.append($('<td/>').html(cellValue));
        }
        $("#locationDetails").append(row$);
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
    console.log(columnSet);
    return columnSet;

}
function showCompanyLocationModal(isUpdate)
{
     $('#myModal').modal('show');
    if(isUpdate){
         prepareModalForUpdate();

    }
    else{
          $('#action').val('create');
    }

}

function prepareModalForUpdate(){
     var selectedLocation = table.rows('.selected').data();
     $('#locationId').val(selectedLocation[0][0]);
     $('#areaName').val(selectedLocation[0][1]);
     $('#cityName').val(selectedLocation[0][2]);
     $('#stateName').val(selectedLocation[0][3]);
     $('#countryName').val(selectedLocation[0][4]);
     $('#postalCode').val(selectedLocation[0][5]);
     $('#addressName1').val(selectedLocation[0][6]);
     $('#addressName2').val(selectedLocation[0][7]);
     $('#action').val('update');


}
function getLocationDetailsFromModal(){
    
    var modalDetails={
        'companyId':$('#companyId').val(),
        'loggedInUser':$('#loggedInUser').val(),
        'action':$('#action').val(),
        'areaName':$('#areaName').val(),
        'cityName':$('#cityName').val(),
        'stateName':$('#stateName').val(),
        'countryName':$('#countryName').val(),
        'postalCode':$('#postalCode').val(),
        'addressLine1':$('#addressName1').val(),
        'id':$('#locationId').val(),
        'addressLine2':$('#addressName2').val(),
    }
    return modalDetails;

}
function manageCompanyLocation(){
    

    var modalDetails=getLocationDetailsFromModal();
     $.ajax({
        type: "POST",
        url: "/freshgrc/php/company/manageLocation.php",
        data: modalDetails,
       
    }).done(function (data) {
        alert(data);
        location.reload();
    });
    
}
function addDepartmentToLocation(){
     var selectedLocation = table.rows('.selected').data();
     var companyId=$('#companyId').val();
    window.location = "/freshgrc/view/superadmin/departmentAdmin.php?locationId=" + selectedLocation[0][0];
}
function redirect(){
     window.location="/freshgrc/view/superadmin/companyAdmin.php";
}
function showDeleteDialogLocation() {
    var selectedUser = table.rows('.selected').data();
    $('#LocationDelete').modal('show');
    $('#complianceId_delete').val(selectedUser[0][0]);
    // $('#email_delete').val(selectedUser[0][4]);
}
function deleteModalLocation() {
    
    var userDetails = {
        'complianceId_delete':$('#complianceId_delete').val(),
        'action': 'delete'
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/company/manageLocation.php",
        data: userDetails
    }).done(function (data) {
        location.reload();
    });
}

