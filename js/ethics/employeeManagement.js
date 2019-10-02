$(document).ready(function () {     

    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    }   

    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/policy/policylist.php",
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



function createEmployeeDetails()
{ 
    debugger
    var modalDetails=
    {
        "name":$("#name").val(),
        "employeeID":$("#employeeID").val(),
        "department":$("#department").val(),
        "PolicyId":$("#PolicyId").val(),
        "location":$("#location").val(),
        "date":$("#date").val(),
        "Reason":$("#Reason").val(),
        "import":$("#import").val(),
        "main_heading":$("#main_heading").val(),
        "subheading":$("#subheading").val(),
        "userFileName":$("#userFileName").val(),
        "action":"Create",
    }
    return modalDetails;
}
function createEmployee() {
    
    
    var modalDetails = createEmployeeDetails();
    if(modalDetails.name==""||modalDetails.employeeID=="--Select Employeeid--"||modalDetails.department==""||modalDetails.PolicyId==""||modalDetails.location==""||modalDetails.date==""||modalDetails.Reason=="--Select Reason--"||modalDetails.main_heading==""||modalDetails.subheading==""){

        swal({ 
           title:  'Please all the form fields',
           type: 'warning',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
        });
    }
   else
{   
 $.ajax({
            // dataType: "json",
            type: "POST",
            url: "/freshgrc/php/ethics/createEmployee.php",
            data: modalDetails
        }).done(function (data) {
           swal({
              title: "Plan Created",
              text: "Your Plan Has Been Created",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
                window.location="/freshgrc/view/ethics/employeeReportlist.php";
              }, 2000);
            });

 
    });
  
}
}
function acceptByreviewer()
{ 
    
    var modalDetails=
    {
       "id":$("#id").val(),
         "Comments":$("#Comments").val(),
         "Reason":$("#Reason").val(),
      "action":'Accept'
    }

 $.ajax({
            // dataType: "json",
            type: "POST",
            url: "/freshgrc/php/ethics/reviewEmployee.php",
            data: modalDetails
            }).done(function (data) {
           swal({
              title: "Plan Accepted",
              text: "Your Plan Has Been Accepted",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
                window.location="/freshgrc/view/ethics/reviewlist.php";
              }, 2000);
            });
        }); 
}

function RejectByReviewer()
{ 
    var modalDetails=
    {
        "id":$("#id").val(),
         "Comments":$("#Comments").val(),
        "Reason":$("#Reason").val(),

      "action":'Rejected'
    }

 $.ajax({
            // dataType: "json",
            type: "POST",
            url: "/freshgrc/php/ethics/reviewEmployee.php",
            data: modalDetails
            }).done(function (data) {
           swal({
              title: "Plan Rejected",
              text: "Your Plan Has Been Rejected",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
                window.location="/freshgrc/view/ethics/reviewlist.php";
              }, 2000);
            });
        }); 
}

function needClarification()
{ 
    var modalDetails=
    {
        
        "id":$("#id").val(),
         "Comments":$("#Comments").val(),
         "Reason":$("#Reason").val(),

            "action":'Clarify'
    }

 $.ajax({
            // dataType: "json",
            type: "POST",
            url: "/freshgrc/php/ethics/reviewEmployee.php",
            data: modalDetails
            }).done(function (data) {
           swal({
              title: "Plan Clarified",
              text: "Your Plan Has Been Clarified",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
                window.location="/freshgrc/view/ethics/reviewlist.php";
              }, 2000);
            });
        }); 
}


function acceptByApprover()
{  
    var modaldetails=
    {
        
        "id":$("#id").val(),
        "action":'Approved'
    }

 $.ajax({
            // dataType: "json",
            type: "POST",
            url: "/freshgrc/php/ethics/approverFinal.php",
            data: modaldetails
            }).done(function (data) {
           swal({
              title: "Plan Accepted",
              text: "Your Plan Has Been Accepted",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
                window.location="/freshgrc/view/ethics/approverList.php";
              }, 2000);
            });

 
    }); 
}


function RejectByApprover()
{ 
    var modaldetails=
    {
        
        "id":$("#id").val(),
        "action":'Rejected'
    }

 $.ajax({
            // dataType: "json",
            type: "POST",
            url: "/freshgrc/php/ethics/approverFinal.php",
            data: modaldetails
             }).done(function (data) {
           swal({
              title: "Plan Rejected",
              text: "Your Plan Has Been Rejected",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
                window.location="/freshgrc/view/ethics/approverList.php";
              }, 2000);
            });
        }); 
}



function fileUpload(){

    var myFormData = new FormData();
    var userFileId = document.getElementById('import');
    myFormData.append('import', userFileId.files[0]);

    var fileName = userFileId.files[0].name;
    $('#userFileName').val(fileName);

    $.ajax({
      url: "/freshgrc/php/ethics/fileupload.php",
      type: "POST",
      processData: false, // important
      contentType: false, // important
      data: myFormData,
      success: function (data) {
         swal({
              title: "File has been uploaded",
              text: "Your Plan Has Been Created",
              type: "success",
              closeOnConfirm: true,
              showLoaderOnConfirm: true
            });

          alert('Successfully uploaded');
      }
    });
}

 function goToPreviousPage(){
    window.history.back();
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
 
 function updateThereviewdata()
 {
debugger
    var modalDetails=
    {
        "id":$("#id").val(),
        "clarification_reason":$("#clarification_reason").val(),
      "userFileName":$("#userFileName").val(),

        "action":"Update",

    }

 $.ajax({
            // dataType: "json",
            type: "POST",
            url: "/freshgrc/php/ethics/createEmployee.php",
            data: modalDetails
        }).done(function (data) {
           swal({
              title: "Plan Updated",
              text: "Your Plan Has Been Updated",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
            window.location = "/freshgrc/view/ethics/employeeReportlist.php"
              }, 2000);
            });
        }); 
 }


function validatePopup(){
  viewPolicymodelDetails();
    }
    


    function viewPolicymodelDetails(){




   $("#myBtn").click(function(){
       $("#myModal").modal();
   });
   
 }
