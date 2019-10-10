$(document).ready(function () {    
    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    } 


    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/risk/riskreviewedlistdashboard.php",
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
        buttons: [
             { extend: 'print', className: 'btn dark btn-outline',titleAttr:'Print', text: '<span class="glyphicon glyphicon-print" data-toggle="tooltip"></span>' },
            { extend: 'copy', className: 'btn red btn-outline' ,titleAttr:'Copy', text: '<span class="glyphicon glyphicon-copy" data-toggle="tooltip"></span>'},
            { extend: 'pdf', className: 'btn green btn-outline' ,titleAttr:'PDF', text: '<span class="glyphicon glyphicon-file" data-toggle="tooltip"></span>'},
            { extend: 'csv', className: 'btn purple btn-outline ' ,titleAttr:'CSV', text: '<img src="/freshgrc/assets/images/csv.png" alt=csv width="20" height="20" data-toggle="tooltip"/>'},
            { extend: 'colvis', className: 'btn dark btn-outline',titleAttr:'Columns', text: '<span class="glyphicon glyphicon-th-list" data-toggle="tooltip"></span>'}
 ],
            "pageLength": 20,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        columnDefs: [
            {
                targets: [0,5],
                visible: false
            },{
                searchable:true,
                orderable:false,
                targets: [0,1,2,3,4,5]
            }
        ],
        "order": [[ 0, 'asc' ]]
    });
    
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            table.cell(cell).invalidate('dom');
        } );
    } ).draw();


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
            if(colIndex == 0){
                row$.append($('<td/>').html(""));
            }
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
function viewReport() {
    var selectedData = table.rows('.selected').data();
    var length = selectedData.length;
    if (length>0) {
        window.location = "/freshgrc/view/risk/riskReport.php?RiskId=" + selectedData[0][1];
    }    
}


