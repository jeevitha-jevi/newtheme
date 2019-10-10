<?php 
require_once __DIR__.'/../header.php';
$locationId=$_GET['locationId'];
$loggedInUser=$_SESSION['user_id'];


?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fresh GRC Admin</title>
    <base href="/freshgrc/">

    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="js/superAdmin/companyDepartmentManagement.js"></script>
    <style>
        #viewdata {

            margin-left: 320px;
            margin-top: 50px;
            margin-right: -20px;
            margin-bottom: 55px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        td {
            height: 50px;
            vertical-align: middle;
        }

        i.fa-vibe {
            content: "";
            background-image: url('complaints.png');

            width: 50px;
            height: 50px;
            display: inline-block;
            background-position: center;
            background-size: cover;
        }

    </style>
</head>
		<body class="with-side-menu-compact">

		    <?php 
		        include '../siteHeader.php';
		        $currentMenu = 'companyAdmin';
                echo "<br><br><br><br><br>";
                include '../../php/policy/left.php';

		        // include '../common/leftMenu.php';
		    ?>
<div class="page-content-wrapper" style="margin-top: -60px;margin-left: -60px;width:105%;">                
        <div class="page-content">                  
          <div class="row">
            <div class="col-md-12">
              <div class="portlet box green">
                <div class="portlet-title">
                  <div class="caption">Manage Department</div>                              
                </div>  
                <div class="portlet-body ">
                   
                <body class="dataTables">
                <div id="viewdata" class="container" style="margin-left:13px;">                                     
                <div class="row">
                    <div class="col-xs-3">
                        <button class="btn btn-warning btn-block" onclick="showCompanyDepartmentModal(false)"><i class="fa fa-user"></i> Add Departments</button>
                    </div>
                    <div class="col-xs-2">
                        <button class="btn btn-success btn-block" onclick="showCompanyDepartmentModal(true)"><i class="fa fa-file"></i>  Edit</button>
                    </div>
                    <div class="col-xs-2">
                        <button class="btn btn-info btn-block" onclick="showDeleteDialog()"><i class="fa fa-trash"></i>  Delete</button>
                    </div>
                     <div class="col-xs-2">
                        <button class="btn btn-error btn-block" onclick="addDepartmentToLocation()"><i class="fa fa-map-marker"></i>  Add Teams</button>
                    </div>
                     <div class="col-xs-3">
                        <button class="btn btn-error btn-block" onclick="redirect()"><i class="fa fa-map-marker"></i>  Back to location page</button>
                    </div>


                    

                </div>
                <br/>
                <br/>
                  <div class="table-responsive">
                  <table id="departmentDetails" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Description</th>
                      </tr>
                </thead>
            </table>
        </div>
        </div>
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Manage Company Details</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form1">
                            <div class="form-group">
                                <label for="companyName">Name</label> 
                                <input type="text" class="form-control" id="name">
                                 <input type="hidden" class="form-control" id="locationId" value="<?php echo $locationId  ?>">
                                  <input type="hidden" class="form-control" id="departmentId" >
                                    <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $loggedInUser  ?>">
                                    <input type="hidden" class="form-control" id="action" >
                            </div>
                            <div class="form-group">
                                <label for="companyName">Description</label> 
                                <input type="text" class="form-control" id="description">
                            </div>
                          
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="managerCompanyButton" onclick="manageCompanyDepartment()" data-dismiss="modal" class="btn btn-primary">Create</button>
                    </div>

                </div>
            </div>
        </div>
         <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete Company Details</h4>
                    </div>
                    <div class="modal-body">
                        <h4> Do you want to delete this record</h4>
                        <input type="hidden" class="form-control" id="companyId_delete">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" id="save" onclick="deleteDepartment()" data-dismiss="modal" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
                              
                </div>
              </div>         
            </div>             
          </div>
    </div>       
</div> 
		    
</body>
</html>