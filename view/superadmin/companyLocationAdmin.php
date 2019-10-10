<?php 
require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/company/companyManager.php';
$manager=new CompanyManager();
$id=$manager->getCompanyIdForUser($_SESSION['user_id']);

$companyId=$id[0]['id'];
$loggedInUser=$_SESSION['user_id'];


?>
<!DOCTYPE html>
<html>
<head lang="en">
    
    <script src="js/superAdmin/companyLocationManagement.js"></script>
    
</head>
		<body class="with-side-menu-compact">

		          

		    <body class="dataTables">
		        <div id="viewdata" class="container">
			        	 <h4><u>Manage Company Location</u></h4>
	            <br/>
	          
	            <div class="row">
	                <div class="col-xs-3">
	                    <button class="btn btn-warning btn-block" onclick="showCompanyLocationModal(false)"><i class="fa fa-user"></i> Add Company Location</button>
	                </div>
	                <div class="col-xs-2">
	                    <button class="btn btn-success btn-block" onclick="showCompanyLocationModal(true)"><i class="fa fa-file"></i>  Edit</button>
	                </div>
	                <div class="col-xs-2">
	                    <button class="btn btn-info btn-block" onclick="showDeleteDialog()"><i class="fa fa-trash"></i>  Delete</button>
	                </div>
                    <div class="col-xs-2">
                        <button class="btn btn-error btn-block" onclick="addDepartmentToLocation()"><i class="fa fa-map-marker"></i>  Add Departments</button>
                    </div>
	                 <div class="col-xs-3">
	                    <button class="btn btn-error btn-block" onclick="redirect()"><i class="fa fa-map-marker"></i>  Back to company page</button>
	                </div>


	            </div>
	            <br/>
	            <br/>
	              <table id="locationDetails" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Area</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>postal code</th>
                        <th>address line1</th>
                        <th>address line2</th>
                    </tr>
                </thead>
            </table>
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
                                <label for="companyName">Area</label>
                                <input type="text" class="form-control" id="areaName">
                                  <input type="hidden" class="form-control" id="companyId" value="<?php echo $companyId  ?>">
                                  <input type="hidden" class="form-control" id="locationId" >
                                    <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $loggedInUser  ?>">
                                    <input type="hidden" class="form-control" id="action" >
                            </div>
                            <div class="form-group">
                                <label for="companyName">City</label> 
                                <input type="text" class="form-control" id="cityName">
                            </div>
                            <div class="form-group">
                                <label for="companyName">State</label> 
                                <input type="text" class="form-control" id="stateName">
                            </div>
                            <div class="form-group">
                                <label for="companyName">Country</label> 
                                <input type="text" class="form-control" id="countryName">
                            </div>
                            <div class="form-group">
                                <label for="companyName">Postal Code</label> 
                                <input type="text" class="form-control" id="postalCode">
                            </div>
                            <div class="form-group">
                                <label for="companyName">Address Line 1</label> 
                                <input type="text" class="form-control" id="addressName1">
                            </div>
                            <div class="form-group">
                                <label for="companyName">Address Line 2</label> 
                                <input type="text" class="form-control" id="addressName2">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="managerCompanyButton" onclick="manageCompanyLocation()" data-dismiss="modal" class="btn btn-primary">Create</button>
                    </div>

                </div>
            </div>
        </div>
		        </body>
		    </body>