

<head><script src="js/superAdmin/userManagement.js"></script>
<style type="text/css">
    #viewdata{
    margin-left: -23px;
    margin-top: -84px;
    margin-right: 0px;
    margin-bottom: 0px;
    }
     
</style>
</head>
<body>
    <div class="container">                                  
        <div class="portlet light tasks-widget bordered">            
            <div class="portlet-body util-btn-margin-bottom-5">
                <div class="clearfix">                             
                    <button type="button" class="btn btn-success" onclick="showUserModal(false)"><i class="fa fa-user"></i>New</button>                                              
                    <button type="button" class="btn btn-warning" onclick="showUserModal(true)"><i class="fa fa-file"></i>Edit</button>
                    <button type="button" class="btn btn-danger" onclick="showDeleteDialog()"><i class="fa fa-trash"></i>Delete</button>                                                  
                </div>                                             
            </div>
        </div>            
        <table id="userdetails" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width: 1160px;">
            <thead>
                <tr>
                    <th>User Id</th>
                    <th>First Name</th> 
                    <th>Last Name</th>                       
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Role Id</th>                        
                </tr>
            </thead>
        </table>
    </div>

    <!-- Update Overlay -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Manage User Details</h4>
                </div>
                <div class="modal-body">
                    <form id="form1">
                         <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="hidden" class="form-control" id="userId">
                            <input type="hidden" class="form-control" id="action">
                            <input type="hidden" class="form-control" id="companyId" value="<?php echo $companyId ?>">
                            <input type="hidden" class="form-control" id="company" value="<?php echo $companyId ?>">
                            <input type="text" class="form-control" id="lastName">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                        
                        <div class="form-group">
                            <?php include '../common/roleMultiSelect.php';?>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="managerUserButton" onclick="manageUser()" data-dismiss="modal" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete User Details</h4>
                </div>
                <div class="modal-body">
                    <h4> Do you want to delete this record</h4>
                    <input type="hidden" class="form-control" id="userId_delete">
                    <input type="hidden" class="form-control" id="email_delete">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" id="save" onclick="deleteUser()" data-dismiss="modal" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>