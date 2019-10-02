$(document).ready(function () {
    debugger;
    $(".datepickerClass").each(function() {
        $(this).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099"  
        });
    });
       $('#create1').show();
       $('#reportButton').hide();
       $('#kickOffbtn').hide();
       $('#CheckForAuditorbtn').hide();
       $('#auditeeDoPending').hide();
       $('#btnForApproved').hide();
       $('#btnForRespond').hide();
    $('#modaldetails').on('click', 'tr', function(){
        if ($(this).hasClass('selected')){
             var selectedData = table.rows('.selected').data();
             
             if(selectedData[0][6]=="Published"){

                     $('#reportButton').show();
                     $('#kickOffbtn').hide();
                     $('#CheckForAuditorbtn').hide();
                     $('#auditeeDoPending').hide();
                     $('#btnForApproved').hide();

             }
              if(selectedData[0][6]=="Checklist Assigned"){

                     $('#reportButton').hide();
                     $('#kickOffbtn').hide();
                     $('#CheckForAuditorbtn').hide();
                     $('#auditeeDoPending').show();
                     $('#btnForApproved').hide();
                    $('#btnForRespond').hide();
                    $('#auditeeResponse').hide();

             }
             if(selectedData[0][8]=="Created"){

                     $('#reportButton').hide();
                     $('#kickOffbtn').show();
                     $('#CheckForAuditorbtn').hide();
                     $('#auditeeDoPending').hide();
                     $('#btnForApproved').hide();

             }

             if(selectedData[0][6]=="returned"){

                     $('#reportButton').hide();
                     $('#kickOffbtn').hide();
                     $('#CheckForAuditorbtn').hide();
                     $('#auditeeDoPending').hide();
                     $('#btnForApproved').show();
                

             }
                if(selectedData[0][6]=="approved"  ){

                     $('#reportButton').hide();
                     $('#kickOffbtn').hide();
                     $('#CheckForAuditorbtn').hide();
                     $('#auditeeDoPending').hide();
                     $('#btnForApproved').show();

             }
              if(selectedData[0][8]=="performed"  ){

                     $('#reportButton').hide();
                     $('#kickOffbtn').hide();
                     $('#CheckForAuditorbtn').show();
                     $('#auditeeDoPending').hide();
                     $('#btnForApproved').hide();

             }
           
            /*$('#newCompl').hide();
            $('#importCompl').hide();
            $('#editCompl').show();
            $('#deleteCompl').show();
            $('#manageCompl').show();*/     
                 
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
        url: "/freshgrc/php/audit/auditduelist.php",
        data: userCredentials,
        success: success
    });
});

var table;

function tableInit() {
  table = $('#modaldetails').DataTable({
        select: {
            style: 'single',
            blurable: true
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
        columnDefs: [ {
            targets: [0,-1],
            visible: false
        } ],
        "ordering": false
    });
}

function success(data) {
    buildHtmlTable(data);
    tableInit();
}

function buildHtmlTable(data) {
    var columns = addAllColumnHeaders(data);
    for (var i = 0; i < data.length; i++) {
        debugger
        var row$ = $('<tr/>');
        for (var colIndex = 0; colIndex < columns.length; colIndex++) {
            debugger
             var cellValue = data[i][columns[colIndex]];
            var auditstatus = data[i].status;
            if (colIndex == 8 && "approved" == auditstatus){
                cellValue="Published";
              row$.append($('<td class="btn"  style="width:80px; height:50% ; background-color:#5cb85c; color:#fff; text-align:center;margin: 10px;"/>').html(cellValue));   
            }
            else if (colIndex == 8 && "performed" == auditstatus){
              row$.append($('<td class="btn" style="width:80px; height:50% ;  background-color:#32c5d2; color:#fff; margin: 10px;"/>').html(cellValue));   
            }
            else if (colIndex == 8 && "published" == auditstatus){
                cellValue="Published";
              row$.append($('<td class="btn" style="width:80px; height:50% ;background-color:#5cb85c; color:#fff; margin: 10px;"/>').html(cellValue));   
            }
            else if (colIndex == 8 && "prepared" == auditstatus){
                 cellValue="Checklist Assigned";
              row$.append($('<td class="btn"  style="width:120px; height:50% ; background-color: #00a8ff; color:#fff;margin: 10px;"/>').html(cellValue));   
            }
            else if (colIndex == 8 && "create" == auditstatus){
                cellValue="Created";
              row$.append($('<td class="btn" style="width:80px; height:50% ; background-color:#00FFFF; color:#fff; margin: 10px;"/>"').html(cellValue));   
            }
             else if (colIndex == 8 && "returned" == auditstatus){
              row$.append($('<td class="btn" style="width:120px; height:50% ; background-color:red; color:#fff; margin: 10px;"/>"').html(cellValue));   
            }
            else
           {

            if (cellValue == null) {
                cellValue = "";
            }

            row$.append($('<td/>').html(cellValue));
        }

        $("#modaldetails").append(row$);
    }
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

function showModal(isUpdate) {
    $('#myModal').modal('show');
    if (isUpdate) {
        prepareModalForUpdate();
    } else {
        $('#action').val('create');
    }
}

function prepareModalForUpdate() {
    var selectedData = table.rows('.selected').data();
    $('#manageButton').text('Update');
    $('#action').val('update');
}

function getModalDetailsFromModal() {
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'auditTitle': $('#auditTitle').val(),
        'action': $('#action').val(),
        'company': $('#company').val(),
        'compliance': $('#compliance').val(),
        'auditType': $('#auditType').val(),
        'auditFreq': $('#auditFreq').val(),
        'scope': $('#scope').val(),
        'auditDesc': $('#auditDesc').val(),
        'auditProcedure': $('#auditProcedure').val(),
        'start_date': $('#start_date').val(),
        'end_date': $('#end_date').val(),
        'auditor': $('#auditor').val(),
        'auditee': $('#auditee').val(),
        'location':$('#location').val(),
        'department':$('#department').val()
    }
    return modalDetails;
}

function manageModal() {
    debugger;
    var modalDetails = getModalDetailsFromModal();
    if(modalDetails.auditTitle==""||modalDetails.company=="--Select Company--"||modalDetails.compliance=="--Select Compliance--"||modalDetails.auditType=="--Select Audit Type--"||modalDetails.auditFreq=="--Select Audit Freq--"||modalDetails.scope==" "||modalDetails.auditDesc==" "||modalDetails.auditProcedure==" "||modalDetails.start_date==" "||modalDetails.end_date==" "||modalDetails.auditor=="--Select Auditor--"||modalDetails.auditee=="--Select Auditee--"){
        swal({ 
           title:  'Please Fill all the form fields',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
        });
    }
   else
{    
  $.ajax({
        type: "POST",
        url: "/freshgrc/php/audit/manageAudit.php",
        data: modalDetails
    }).done(function (data) {
         swal({ 
           title:  'Plan Created!',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok',
           timer: 1500
        });
  location.reload();
    });
}
}

function performAuditActions() {
    var selectedData = table.rows('.selected').data();
    if(selectedData[0][8]=="Created"){
    window.location = "/freshgrc/view/audit/auditDoPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][8]=="Checklist Assigned"){
    window.location = "/freshgrc/view/audit/auditeeDoPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][8]=="performed"){
    window.location = "/freshgrc/view/audit/auditCheckPage.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][8]=="approved"){
    window.location = "/freshgrc/view/audit/auditReprt.php?auditId=" + selectedData[0][0];
}
 if(selectedData[0][8]=="returned"){
    window.location = "/freshgrc/view/audit/auditActPage.php?auditId=" + selectedData[0][0];
}
}
function viewReport() {
    var selectedData = table.rows('.selected').data();
    window.open("/freshgrc/view/audit/auditReprt.php?auditId=" + selectedData[0][0]);
}
function getLocation(){
    debugger;
    var companyName=$('#company').val();
    var modalDetails={'id':companyName};
     $.ajax({
        type: "POST",
        url: "/freshgrc/view/common/locationDropdown.php",
        data: modalDetails,
        success:function(data){
            $('#locationDrop').html(data);
        }
    });

    
    

}
function getDepartment(){
    var location=$('#location').val();
    var modalDetails={'id':location};
      $.ajax({
        type: "POST",
        url: "/freshgrc/view/common/departmentDropDown.php",
        data: modalDetails,
        success:function(data){
            $('#departmentDrop').html(data);
        }
    });
}
 

function publishAuditList(){
    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    }

    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/audit/auditduelist.php",
        data: userCredentials,
        success: success
    });

}
function auditList(){
     window.location="/freshgrc/view/audit/auditorAdmin.php";
}
