$(document).ready(function () {
    //setTimeout(tableInit, 1000);
    //tableInit();
    var companyId=$('#companyId').val();
   
    var data={'companyId':companyId};
    $.ajax({
        dataType: "json",
        type:"POST",
        url: "/freshgrc/php/user/userlist.php",
        data: data,
        success: success
    });
});

var table;

function tableInit() {

    table = $('#userdetails').DataTable({
        select: {
            style: 'single'           
        },
        columnDefs: [
            {
                targets: [0,5],
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
        $("#userdetails").append(row$);
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

function showUserModal(isUpdate) {
    $('#myModal').modal('show');
    if (isUpdate) {
        prepareModalForUpdate();
    } else {
        $('#action').val('create');
    }
}

function prepareModalForUpdate() {
    
    var selectedUser = table.rows('.selected').data();
    $('#userId').val(selectedUser[0][0]);
    $('#firstName').val(selectedUser[0][1]);
    $('#lastName').val(selectedUser[0][2]);
    $('#email').val(selectedUser[0][3]);
    // 7th element is the company id.
    $('#role').val(selectedUser[0][6]);
    $('#email').attr('readonly', true);
    $('#managerUserButton').text('Update');
    $('#action').val('update');
}

function showDeleteDialog() {
    var selectedUser = table.rows('.selected').data();
    $('#myModal2').modal('show');
    $('#userId_delete').val(selectedUser[0][0]);
    $('#email_delete').val(selectedUser[0][4]);
}

function getUserDetailsFromModal() {
    
    var userDetails = {
        'userId': $('#userId').val(),
        'action': $('#action').val(),
        'lastName': $('#lastName').val(),
        'firstName': $('#firstName').val(),
        'middleName': $('#middleName').val(),
        'email': $('#email').val(),
        'company': $('#company').val(),
        'role': $('#role').val()
    }
    return userDetails;
}
function getUserProfileDetailsFromModal() {
    var userDetails = {
        'userId': $('#userId').val(),
        'action': $('#action').val()
    }
    return userDetails;
}

function manageUser() {
    if($('#action').val()=='update')
    {
    var userDatails = getUserDetailsFromModal();
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/user/manageUser.php",
        data: userDatails,
    });
    location.reload();
}
else
{
      var userDatails = getUserDetailsFromModal();

    $.ajax({
        type: "POST",
        url: "/freshgrc/php/user/manageUser.php",
        data: userDatails,
        success:userProfileCreate
    });
}

}
function userProfileCreate(data){
    
    data=JSON.parse(data);
    var userDetails= {'userId':data.id,'action':'create'};

     $.ajax({
        type: "POST",
        url: "/freshgrc/php/user/manageUserProfile.php",
        data: userDetails
    }).done(function (data) {
        location.reload();
    });
}

function deleteUser() {
    var userDetails = {
        'userId': $('#userId_delete').val(),
        'action': 'delete',
        'email': $('#email_delete').val()
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/user/manageUser.php",
        data: userDetails
    }).done(function (data) {
        location.reload();
    });
}
