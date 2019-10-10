$(document).ready(function() {
    debugger;
    $('#report').DataTable( {
        dom: 'Bfrtip',
        "ordering": false,
        buttons: [
             'csv', 'pdf', 'print'
        ]
    } )
    /* $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/audit/auditReport.php",
        data: userCredentials,
        success: success
    });*/
} );
function getZip(){
    var modalDetails={'id':$('#auditId').val()
                    }
       $.ajax({
        
        type: "POST",
        url: "/freshgrc/php/audit/manageAuditZip.php",
        data: modalDetails,
        //success: success
    });

}