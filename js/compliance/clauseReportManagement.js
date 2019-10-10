$(document).ready(function() {
    //debugger;
    $('#report').DataTable( {
        dom: 'Bfrtip',
        "ordering": false,
           buttons: [
                { extend: 'print', className: 'btn dark btn-outline',text: '<span class="glyphicon glyphicon-print" data-toggle="tooltip" title="Print"></span>' },
            
                
                { extend: 'pdf', className: 'btn green btn-outline' ,text: '<span class="glyphicon glyphicon-file" data-toggle="tooltip" title="PDF"></span>'},
                { extend: 'csv', className: 'btn purple btn-outline ' ,text: '<img src="/freshgrc/assets/images/csv.png" alt=csv width="20" height="20" data-toggle="tooltip" title="CSV"/>'},
            
                
            ],
    } )
    /* $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/audit/auditReport.php",
        data: userCredentials,
        success: success
    });*/
} );
function getPdf(){
var element = document.getElementById('element-to-print');
html2pdf(element, {
  margin:       0,
  filename:     'AuditReport.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { dpi: 192, letterRendering: true },
  jsPDF:        { unit: 'in', format: 'a3', orientation: 'portrait' }
});
}