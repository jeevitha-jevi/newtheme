$(document).ready(function () {     

    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    }   

    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/ethics/getlistforapprover.php",
        data: userCredentials,
        success: success
    }); 

     $('[data-toggle=datepicker]').each(function() {
    var target = $(this).data('target-name');
    var t = $('input[name=' + target + ']');
    t.datepicker({
     dateFormat: "yy-mm-dd",
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099" 
    });
    $(this).on("click", function() {
      t.datepicker("show");
    });
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

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    });

    $('#modaldetails tbody').on('dblclick', 'tr', function () {
        var data = table.row( this ).data();
        var policyData = {
            'action' : 'view',
            'policyId' : data[0]
        }
        $.ajax({
            dataType: "json",
            type: "POST",
            url: "/freshgrc/php/policy/managePolicy.php",
            data: policyData,
            success: viewPolicyData
        }); 
    } );
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





 function getEmployeedata() {
    var selectedData = table.rows('.selected').data();
    var length = selectedData.length;
    if (length>0) {
         window.location = "/freshgrc/view/ethics/employeeReport.php?PolicyId=" + selectedData[0][0];
    }    
}


function reviewerEmployelist()
{
 var selectedData = table.rows('.selected').data();
    var length = selectedData.length;
    if (length>0) {
         window.location = "/freshgrc/view/ethics/Employeereviewer.php?emplyeeId=" + selectedData[0][0];
    }      
}

    function selectforApprover()
    {
 var selectedData = table.rows('.selected').data();
    var length = selectedData.length;
    if (length>0) {
         window.location = "/freshgrc/view/ethics/approverEthics.php?emplyeeId=" + selectedData[0][0];
    }  
}

    function getalldataapprover()
    {
 var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    }   
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/ethics/getalldataforethics.php",
        data: userCredentials,
        success: success
    }); 
}