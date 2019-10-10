$(document).ready(function () {
$('#sortbypriority').change(function() {
  
   var selection = $(this).val();
   if(selection != "All")
   {
    var dataset = $('tbody').find('tr');
   dataset.show();

   dataset.filter(function(index, item) {
     return $(item).find('td:last-child').text().indexOf(selection) === -1;
   }).hide();
}
else {
   location.reload();
}

 });

    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    } 


    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/risk/getAllRiskList.php",
        data: userCredentials,
        success: success
    });   
    

    
});

var table;
function loadRiskByDate(){
    table
    .column( '2:visible' )
    .order( 'desc' )
    .draw();
}


function tableInit() {

    table = $('#modaldetails').DataTable({
        select: {
            style: 'single'
        },
        buttons: [
            { extend: 'print', className: 'btn dark btn-outline', titleAttr:'Print', text: '<span class="glyphicon glyphicon-print" data-toggle="tooltip" ></span>' },
            { extend: 'copy', className: 'btn red btn-outline' , titleAttr:'Copy', text: '<span class="glyphicon glyphicon-copy" data-toggle="tooltip"></span>'},
            { extend: 'pdf', className: 'btn green btn-outline' , titleAttr:'PDF', text: '<span class="glyphicon glyphicon-file" data-toggle="tooltip"></span>'},
            { extend: 'csv', className: 'btn purple btn-outline ' , titleAttr:'CSV', text: '<img src="/freshgrc/assets/images/csv.png" alt=csv width="20" height="20" data-toggle="tooltip"/>'},
            { extend: 'colvis', className: 'btn dark btn-outline', titleAttr:'Columns', text: '<span class="glyphicon glyphicon-th-list" data-toggle="tooltip"></span>'}
        ],
            "pageLength": 20,
            "ordering":true,
            "aaSorting": [],
            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        columnDefs: [
            {
                targets: [0],
                visible: false
            },{
                searchable: true,
                orderable: false,
                targets : [0,1,2,3,4,5,6]
            }
        ]
    });
    
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            table.cell(cell).invalidate('dom');
        } );
    } ).draw();


}
function success(data) {    
    debugger
    
    buildHtmlTable(data);
    tableInit();
}

function buildHtmlTable(data) {
    var columns = addAllColumnHeaders(data);
    for (var i = 0; i < data.length; i++) {
        var row$ = $('<tr/>');
        for (var colIndex = 0; colIndex < columns.length; colIndex++) {
            if(colIndex==5){
                if(data[i][columns[colIndex]]==0){
                    cellValue="Low";
                    row$.append($('<td class="btn"  style="width:114px; height:50% ; background-color:#5cb85c; color:#fff; text-align:center;margin: 10px;"/>').html(cellValue));   
                    
                }
                if(data[i][columns[colIndex]]==1){
                    cellValue="Medium";
                    row$.append($('<td class="btn"  style="width:114px; height:50% ; background-color:#7bea4e; color:#fff; text-align:center;margin: 10px;"/>').html(cellValue));   
                    
                }
                if(data[i][columns[colIndex]]==2){
                    cellValue="High";
                    row$.append($('<td class="btn"  style="width:114px; height:50% ; background-color:#ee5151; color:#fff; text-align:center;margin: 10px;"/>').html(cellValue));   
                }
                if(data[i][columns[colIndex]]==3){
                    cellValue="Extreme";
                    row$.append($('<td class="btn" style="width:114px; height:50% ; background-color:red; color:#fff; margin: 10px;"/>"').html(cellValue));   
                }
                
                if(data[i][columns[colIndex]]==null){
                    cellValue="None";
                    row$.append($('<td/>').html(cellValue));
                }
                
            }
            
            else{
            if(colIndex == 0){
                row$.append($('<td/>').html(""));
            }
            var cellValue = data[i][columns[colIndex]];
            if(cellValue=="create"){
                cellValue="Created";
            }
            row$.append($('<td/>').html(cellValue));
            }
            if (cellValue == null) {
                cellValue = "";
            }

            
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
function displayReport() {
    var selectedData = table.rows('.selected').data();
    var length = selectedData.length;
    if (length>0) {
        window.open("/freshgrc/view/risk/mitigateReport.php?riskId=" + selectedData[0][1]);
    }    
}
