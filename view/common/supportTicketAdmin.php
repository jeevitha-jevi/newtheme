<?php require_once __DIR__.'/../header.php';?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fresh GRC Admin</title>
    <base href="/freshgrc/">
    <!-- <script src="js/superAdmin/companyManagement.js"></script> -->
      <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <!-- <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>  -->
      
    <!-- <script type="text/javascript" src="assets/DataTables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script> -->
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/dataTables.buttons.min.js"></script> 
           <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.flash.min.js"></script> 
        <script type="text/javascript" src="assets/DataTables/pdfmake.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/pdfmake-0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script> 
    <script src="js/common/supportManagement.js"></script>


    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">



    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css">
 -->
    <style>
        #viewdata {

            margin-left: 150px;
            margin-top: 100px;
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

<body >

    

        <div>
             <?php if($_SESSION['user_role'] == 'companyadmin' || $_SESSION['user_role'] == 'super_admin') {?>
                <div class="row">
                    <div class="col-xs-2" id="newCompl">
                        <button class="btn btn-warning btn-block" style="width: 70px;" onclick="showSupportModal(false)"><i class="fa fa-plus-circle"></i> New</button>
                    </div>
                    <div class="col-xs-2" id="editCompl">
                        <button class="btn btn-success btn-block" style="width: 70px;
    margin-left: -135px;" onclick="showSupportModal(true)"><i class="fa fa-pencil-square"></i>  Edit</button>
                    </div>
                    <div class="col-xs-2" id="deleteCompl">
                        <button class="btn btn-info btn-block" style="width: 117px;
    margin-left: -267px;" onclick="showDeleteDialogSupport()"><i class="fa fa-trash"></i>  Delete</button>
                    </div>
                                 
                </div>
            <?php } ?>
            
            <table id="support" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width: 760px !important;">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="modal fade" id="supportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="margin-top: 90px;">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #00C4D0;color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Manage Support Tickets</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form1">
                            <div class="form-group">
                                <label for="complianceName">Title</label>
                                <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                                <input type="hidden" class="form-control" id="supportId">
                                <input type="hidden" class="form-control" id="actionSupport">
                                <input type="hidden" class="form-control" id="company" value=<?php echo $companyId ?>>
                                <input type="text" class="form-control" id="title">
                            </div>
                            <div class="form-group">
                                <label for="complianceDesc">Customer Name</label>
                                <textarea class="form-control" maxlength="5000" rows="5" id="customerName"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="version">Customer Email</label>
                                <input type="text" class="form-control" id="customerEmail">
                            </div>
                            <div id="assignedToDropDown">
                                <?php include '/userDropdown.php'; ?>
                            </div>
                            <div id="statusModal">
                                <label for="status">Status</label>

                                <select id="status" class="form-control">

                                    <option value="inprogress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer" id="supportCreate">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="manageButton" onclick="saveSupport()" data-dismiss="modal" class="btn btn-primary">Create</button>
                    </div>
                    <div class="modal-footer" id="supportUpdate">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="manageButton" onclick="updateSupport()" data-dismiss="modal" class="btn btn-primary">Update</button>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="supportModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="margin-top: 90px;">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #00C4D0;color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" >Delete User Details</h4>
                    </div>
                    <div class="modal-body">
                        <h4> Do you want to delete this record</h4>
                        <input type="hidden" class="form-control" id="complianceId_delete">
                        Title<input type="show" class="form-control" id="title_name" readonly>
                          
                            <div class="form-group">
                                <label for="complianceDesc">Customer Name</label>
                                <input type="show" class="form-control" id="customer_Name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="version">Customer Email</label>
                                <input type="show" class="form-control" id="customerEmail_delete" readonly>
                            </div>
                            <div id="assignedToDropDown">
                                <?php include '/userDropdown.php'; ?>
                            </div>
                              </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" id="save" onclick="deleteModalSupport()" data-dismiss="modal" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>
                                </div>
                            </div>
                       
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>        
</body>
        <!-- Update Overlay -->
        
