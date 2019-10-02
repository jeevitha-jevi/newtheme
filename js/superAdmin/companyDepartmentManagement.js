$(document).ready(function () {
	// debugger;
	var locationId=$('#locationId').val();
	//alert(locationId);
    //setTimeout(tableInit, 2000);
    var data={'locationId':locationId};
    $.ajax({
        dataType: "JSON",
        url: "/freshgrc/php/company/companydepartmentlist.php",
        data: data,
        success: success
    });

});


var table;
function tableInit() {
// debugger
    table = $('#departmentDetails').DataTable({
        select: {
            style: 'single'
        },
        // columnDefs: [
        //     {
        //         targets: [0,1],
        //         visible: false
        //     }
        // ]         
    });
    //  table.on( 'order.dt search.dt', function () {
    //     table.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    //         cell.innerHTML = i+1;
    //     } );
    // } ).draw();
}

function success(data) {
	//data=JSON.parse(data);
	console.log(data);
    buildHtmlTable(data);
    tableInit();
}

function buildHtmlTable(data) {
    var columns = addAllColumnHeaders(data);
    // console.log(columns.length);
    for (var i = 0; i < data.length; i++) {
        var row$ = $('<tr/>');
        for (var colIndex = 0; colIndex < columns.length; colIndex++) {

            var cellValue = data[i][columns[colIndex]];
            // if(colIndex == 1){
            //     row$.append($('<td/>').html(""));
            // }
            if (cellValue == null) {
                cellValue = "";
            }

            row$.append($('<td/>').html(cellValue));
        }
        $("#departmentDetails").append(row$);
    }
}
// function buildHtmlTable(data) {
//     var columns = addAllColumnHeaders(data);
//     for (var i = 0; i < data.length; i++) {
//         var row$ = $('<tr/>');
//         for (var colIndex = 0; colIndex < columns.length; colIndex++) {
//             var cellValue = data[i][columns[colIndex]];
//             if(colIndex == 1){
//                 row$.append($('<td/>').html(""));
//             }
//             if (cellValue == null) {
//                 cellValue = "";
//             }

//             row$.append($('<td/>').html(cellValue));
//         }
//         $("#modaldetails").append(row$);
//     }
// }



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
    // console.log(columnSet);
    return columnSet;

}
// function addAllColumnHeaders(data) {
//     var columnSet = [];
//     var headerTr$ = $('<tr/>');

//     for (var i = 0; i < data.length; i++) {
//         var rowHash = data[i];
//         for (var key in rowHash) {
//             if ($.inArray(key, columnSet) == -1) {
//                 columnSet.push(key);
//                 headerTr$.append($('<th/>').html(key));
//             }
//         }
//     }
//     return columnSet;
// }
function showCompanyDepartmentModal(isUpdate)
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
	 var selectedDepartment = table.rows('.selected').data();
	 $('#departmentId').val(selectedDepartment[0][0]);
	 $('#name').val(selectedDepartment[0][1]);
	 $('#description').val(selectedDepartment[0][2]);
	 $('#action').val('update');


}
function getDepartmentDetailsFromModal(){
	// debugger
	var modalDetails={
		'locationId':$('#locationId').val(),
	'loggedInUser':$('#loggedInUser').val(),
        'action':$('#action').val(),
		'name':$('#name').val(),
		'Description':$('#description').val(),
		'id':$('#departmentId').val(),
		
	}
	return modalDetails;

}
function manageCompanyDepartment(){
	

	var modalDetails=getDepartmentDetailsFromModal();
	 $.ajax({
        type: "POST",
        url: "/freshgrc/php/company/manageDepartment.php",
        data: modalDetails,
       
    }).done(function (data) {
    	alert(data);
        location.reload();
    });
	
}
// function addDepartmentToLocation(){
// 	 var selectedLocation = table.rows('.selected').data();
//     window.location = "/freshgrc/view/superadmin/departmentAdmin.php?locationId=" + selectedLocation[0][0];
// }
function redirect(){
    var locationId=$('#locationId').val();
	 window.location="/freshgrc/view/superadmin/companyAdmin.php";
}

function showDeleteDialog() {
    //var selectedUser = table.rows('.selected').data();
    $('#myModal2').modal('show');
    //$('#companyId_delete').val(selectedUser[0][0]);
}
function deleteDepartment() {
    var selectedDepartment = table.rows('.selected').data();
    var departmentId=selectedDepartment[0][0];
    alert(departmentId);
    var companyDatails = {
        'id': departmentId,
        'action': 'delete'
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/company/manageDepartment.php",
        data: companyDatails
    }).done(function (data) {
        location.reload();
    });
}