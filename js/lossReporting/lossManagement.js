$(document).ready(function () {  
    $.ajax({
        dataType: "json",
        type:"POST",
        url:"/freshgrc/php/lossReporting/lossList.php",
        success:success
    });
   
});
var table;

function tableInit() {

    table = $('#modaldetails').DataTable({
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
            "ordering":false,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        columnDefs: [
            {
                targets: [0],
                visible: false
            }
        ]
    });
    
    table.on( 'order.dt search.dt', function () {
        table.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
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
            if(colIndex == 1){
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

function saveLoss(){
    var modalDetails={
        'description':$('#description').val(),
        'assignedto':$('#assignedto').val(),
        'discoveryDate':$('#discoveryDate').val(),
        'estimatedLoss':$('#estimatedLoss').val(),
        'estimatedImpact':$('#estimatedImpact').val(),
        'scenario':$('#scenario').val()
    }

    $.ajax({
        type: "POST",
        url: "/freshgrc/php/lossReporting/manageLoss.php",
        data: modalDetails,
        success:redirect
        
    }); 
}
function redirect(){
    window.location="/freshgrc/view/lossReporting/lossListAdmin.php";
}
function updateImpact(){
    document.getElementById("impact").innerHTML=$('#estimatedImpact').val();
}
function showLossDetails(){
    var selectedData = table.rows('.selected').data();
    window.location="/freshgrc/view/lossReporting/lossOwnerAdmin.php?id="+selectedData[0][0];
}
function saveLossMitgation(){
    var modalDetails={
        'id':$('#lossId').val(),
        'eventCat':$('#eventCat').val(),
        'scenarioMitigation':$('#scenarioMitigation').val(),
        'eventDetails':$('#eventDetails').val(),
        'associatedIssues':$('#associatedIssues').val()
    }
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/lossReporting/manageLossMitigation.php",
        data: modalDetails,
        success:redirect
        
    });

}