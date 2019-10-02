
    $(document).ready(function() {
        debugger
    
    
    $('#modaldetails').on('click', 'tr', function(){
        if ($(this).hasClass('selected')){
             var selectedData = table.rows('.selected').data();
             
           if(selectedData[0][3]=="create"){
                     $('#diagnosis').show();
                     $('#resolution').hide();
                     $('#closure').hide();
                     $('#review').hide();                    

                     
             }
              if(selectedData[0][3]=="managed"){
                     $('#diagnosis').hide();
                     $('#resolution').show();
                     $('#closure').hide();
                     $('#review').hide();                    

                    
             } 
             if(selectedData[0][3]=="resolved"){
                     $('#diagnosis').hide();
                     $('#resolution').hide();
                     $('#closure').show();
                     $('#review').hide();                    

             }
             if(selectedData[0][3]=="closure"){
                     $('#diagnosis').hide();
                     $('#resolution').hide();
                     $('#closure').hide();
                     $('#review').show();                    

             }
                 
        }
    });
    //setTimeout(tableInit, 2000);
    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    }
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/incident/incidentlist.php",
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
        columnDefs: [
            {
                // targets: [0,5],
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
    debugger
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
     debugger
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

function performIncidentActions() {
    debugger
    var selectedData = table.rows('.selected').data();
    if(selectedData[0][3]=="create"){
    window.location = "/freshgrc/view/incident/diagnosis.php?id=" + selectedData[0][0];

}
 if(selectedData[0][3]=="managed"){
    window.location = "/freshgrc/view/incident/resolution.php?id=" + selectedData[0][0];

}
 if(selectedData[0][3]=="resolved"){
    window.location = "/freshgrc/view/incident/closure.php?id=" + selectedData[0][0];
}
if(selectedData[0][3]=="closure"){
    window.location = "/freshgrc/view/incident/review.php?id=" + selectedData[0][0];
}




}
