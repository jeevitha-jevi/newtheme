<?php 
require_once __DIR__.'/../header.php';
?>
<!DOCTYPE html>
<html>
<head lang="en">
    
<script src="js/superAdmin/companyLocationManagement.js"></script>
    
</head>
<body>            
    <div class="portlet light tasks-widget bordered">            
        <div class="portlet-body util-btn-margin-bottom-5">
            <div class="clearfix">                             
                <button type="button" class="btn btn-success" onclick="showCompanyLocationModal(false)"><i class="fa fa-user"></i>Add Company Location</button>                                              
                <button type="button" class="btn btn-warning" onclick="showCompanyLocationModal(true)"><i class="fa fa-pencil-square"></i>Edit</button>                                                  
                <button type="button" class="btn btn-danger" onclick="showDeleteDialogLocation()"><i class="fa fa-trash"></i>Delete</button>
                <button type="button" class="btn green" onclick="addDepartmentToLocation()"><i class="fa fa-map-marker"></i>Add Departments</button>              
                <button type="button" class="btn blue" onclick="redirect()"><i class="fa fa-map-marker"></i>Back to company page</button>                                                   
            </div>                                             
        </div>
    </div>              
    <table id="locationDetails" class="table table-striped table-bordered" cellspacing="0" >
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #00C4D0;color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Manage Company Details</h4>
                </div>
                <div class="modal-body">
                    <form id="form1">
                        <div class="form-group">
                            <label for="companyName">Area</label>
                            <input type="text" class="form-control" id="areaName">
                            <input type="hidden" class="form-control" id="companyId" value=<?php echo $companyId  ?>>
                            <input type="hidden" class="form-control" id="locationId" >
                            <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $loggedInUser?>">
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
      <div class="modal fade" id="LocationDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="margin-top: 90px;">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #00C4D0;color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" >Delete User Details</h4>
                    </div>
                    <div class="modal-body">
                        <h4> Do you want to delete this record</h4>
                        <input type="hidden" class="form-control" id="complianceId_delete">
                              </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" id="save" onclick="deleteModalLocation()" data-dismiss="modal" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
</body>
       