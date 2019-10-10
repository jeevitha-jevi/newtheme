<?php require_once __DIR__.'/../header.php';?>
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
    <script src="js/common/manageMetadata.js"></script>
    <script src="js/compliance/complianceManagement.js"></script>
    <script src="js/risk/riskManagement.js"></script>
    <script src="js/audit/auditManagement.js"></script>


    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>      
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" /> 


    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">



    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <style>
        #viewdata {

            margin-left: 150px;
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

        .settings_pic {
            padding: 5px;
            height: 65px;
            border-bottom: 2px solid #E8E8E8;
            white-space: nowrap;
            overflow-x: visible;
            overflow-y: hidden;
            width: 1170px;
            float: left;
        }

        .settings_flowpic {
            width: 200px;
            text-align: center;
            display: inline-block;
            /*height: 105px;*/
            cursor: pointer;
            margin: 5px;
            border: 1px solid #fff;
            background-color: #5AC8FA;
        }

        .flowword {
            margin-bottom: 0px;
            text-align: center;
            font-size: 12px;
            /*height: 16px;*/
            white-space: nowrap;
            overflow: hidden !important;
            /*margin: 6px 2px 4px 2px;
            width: 100px;*/
            line-height: 35px;
        }
        
        .openend {
            border-bottom: 3px solid #5495DF;
            border-left: 4px solid #5495df;
            width: 200px;
            /*height: 65px;
            position: absolute;*/
            border-radius: 20px;
            margin-top: 101px;
            margin-left: 0px; 
            float: left;
        }
              label{
          color: #333;
          font-family: "Open Sans",sans-serif;
          font-size: 15px;
          font-weight: 400 !important;
        }
        input{
          border-radius: 0px !important;
              margin-left: 200px;
          width: 370px;
          margin-top: -20px;
        }
        textarea{
          border-radius: 0px !important;
          margin-left: 200px;
          width: 370px;
          margin-top: -20px;
        }        
        select{
          border-radius: 0px !important;
              margin-left: 200px;
          width: 370px;
          margin-top: -20px;
             }
             .form-control{
                  width: 64%;
             } 
             .btn{
                  width: 73px;
                  height: 34px;
                  border-radius: 0px;
             }
    </style>
  
</head>

<body class="with-side-menu-compact">

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'settings';
       
    ?>
    <?php 

        $currentMenu = 'complainceAdmin';
    ?>
    <?php 

        $currentMenu = 'riskAdmin';
        $userRole = $_SESSION['user_role'];
    ?>  
    <?php 

        $currentMenu = 'auditorAdmin';
        $userRole = $_SESSION['user_role'];
    ?>

    <body class="dataTables" >
        <div  id="viewdata" class="container">
            <div class="center-div">
                <div class="">
                    <div id="configTypes"></div>
                </div>             
            </div>           
            
            <!-- <div class="center-div">
                <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:-80px;padding:0px;width:1200px;">
                    <div id="tab-4" style="height:550px;margin-top: 5px;">
                        <div class="col-md-12 col-xs-12 col-sm-12 chevshow1">
                            <div class="col-md-10 col-sm-10 col-xs-10" style="margin-bottom: 30px;white-space: nowrap;height: 116px;padding:0px;width:1170px;">
                                <div class="settings_pic">
                                    <div id="configTypes"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top: 10px;padding: 0px;display: inline-flex;height: 480px;margin-bottom:30px;width:1200px;">
                            <div class="col-md-1 col-xs-1 col-sm-1 drag1show"></div>
                            <div class="fullpage draggable">
                                <div class="col-md-4 col-xs-4 col-sm-4 dragshow10">
                                    <div class="dragviewcol">
                                        <div class="dragview">
                                            <div class="col-md-1 dragset">
                                            </div>
                                            <div class="col-md-3 dragset1">
                                                <div class="dragdrop" onclick="open_workflowadd()">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dragheight">
                                            <div id="open_workflow_add"></div>
                                            <div id="workflow_list"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->



<!-- //////////////////////////for compliance -->
            <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> -->
                <div class="col-md-12" style="background-color: #fff;margin-left: 130px;width: 1215px;margin-top: 115px;"  >
                    <div class="modal-header" style="border-bottom: 1px solid #eef1f5;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-sliders" aria-hidden="true" style="color: #5C9BD1;"></i>
                        <h4 class="modal-title" id="myModalLabel" style="color: #5C9BD1;margin-left: 25px;
                         margin-top: -25px;">Manage Compliance Details
                        </h4>
                    </div>
                    <div class="modal-body">
                      <form id="form1">
                        <div class="form-group" style="margin-left: 152px;">
                          <label for="complianceName">Compliance Name</label>
                          <input style="width: 500px;margin-top: -20px;" type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                          <input style="width: 500px;margin-top: -20px;" type="hidden" class="form-control" id="complianceId">
                          <input style="width: 500px;margin-top: -20px;" type="hidden" class="form-control" id="action" value="create">
                          <input style="width: 500px;margin-top: -20px;" type="text" class="form-control" id="complianceName">
                        </div>
                        <div class="form-group"  style="margin-left: 152px;">
                          <label for="complianceDesc">Decription</label>
                          <textarea style="width: 500px;margin-top: -20px; height: 60px;" class="form-control" maxlength="5000" rows="5" id="complianceDesc"></textarea>
                        </div>
                        <div class="form-group" style="margin-left: 152px;">
                            <label for="version">Version</label>
                            <input style="width: 500px;margin-top: -20px;" type="text" class="form-control" id="version">
                        </div>
                        <div class="form-group" style="width: 500px; margin-left: 152px;">
                          <label >Company</label>
                            <?php include '../common/companyDropDown.php';?>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer" style="border-bottom: 1px solid #eef1f5;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="manageButton" onclick="saveCompliance()" data-dismiss="modal" class="btn btn-primary">Create</button>
                    </div>
                  </div>
            <!-- </div> -->


        <div class="col-md-6">
          <div class="" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="margin-left: 115px;width: 600px;">
              <div class="modal-content" style="border-radius: 0px !important;border: none;height: 1088px;">
                <div class="modal-header" style="border-bottom: 1px solid #eef1f5;background-color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-gift" aria-hidden="true" style="color: #4fccd4;"></i>
                    <h4 class="modal-title" id="myModalLabel" style="color: #4fccd4;font-size: 16px;font-weight: 600px;margin-left: 25px;margin-top: -25px;">CREATE AN AUDIT</h4>
                </div>
                <div class="modal-body" style="margin-right:15px;margin-left: 15px;" >
                  <form id="form1">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                        <input type="hidden" class="form-control" id="auditId">
                        <input type="hidden" class="form-control" id="action" value="create">
                    </div>
                    <div class="form-group" style="margin-left: -15px;">
                        <label for="auditTitle" >Title</label>
                        <input  type="text" class="form-control" id="auditTitle">
                    </div>
                    <div class="row "  >
                    <div class="form-group "  >
                      <label  for="company">Company</label>
                        <?php  include '../common/companyDropDown.php';?>
                    </div>
                    <div class="form-group " >
                        <?php include '../compliance/complianceDropDown.php';?>
                    </div>
                    </div>
                    <div class="row " >
                    <div class="form-group " >
                        <?php include '../common/auditTypeDropdown.php';?>
                    </div>
                    <div class="form-group split2" >
                        <?php include '../common/auditFreqDropDown.php';?>
                    </div>
                    </div>
                    <div class="form-group" style="width: 567px;margin-left: -13px;">
                        <label for="scope" >Scope/Objective</label>
                        <input  type="text" class="form-control" id="scope">
                    </div>
                    <div class="form-group" style="width: 567px;margin-left: -13px;">
                        <label for="auditDesc" >Description</label>
                        <textarea style="height: 60px;" class="form-control" maxlength="5000" rows="5" id="auditDesc"></textarea>
                    </div>
                    <div class="form-group" style="width: 567px;margin-left: -13px;">
                        <label for="auditProcedure" >Audit Procedure</label>
                        <textarea style="height: 60px;" class="form-control" maxlength="5000" rows="5" id="auditProcedure"></textarea>
                    </div>
                    <div class="row " >
                    <div class="form-group " >
                        <label for="start_date" >Start Date</label>
                        <input type="text" class="form-control datepickerClass" id="start_date">
                    </div>
                    <div class="form-group " >
                        <label for="end_date">End Date</label>
                        <input type="text" class="form-control datepickerClass" id="end_date">
                    </div>
                    </div>
                    <div class="row " >
                    <div class="form-group " >
                        <?php include '../common/auditorDropDown.php';?>
                    </div>
                    <div class="form-group " >
                        <?php include '../common/auditeeDropdown.php';?>
                    </div>
                    </div>
                    <div class="row " >
                    <div class="form-group " id="locationDrop">
                       <?php include '../common/locationDropdown.php';?> 
                    </div>
                    <div class="form-group " id="departmentDrop">
                        <?php include '../common/departmentDropDown.php';?>
                    </div>
                    </div>
                  </form>
                </div>
                    <div class="modal-footer" style="border-top: 1px solid #eef1f5;">
                      <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                      <button type="button" id="manageButton" onclick="manageModal()" data-dismiss="modal" class="btn btn-primary" style="background-color: #42a8ff">Create</button>
                    </div>
                </div>
            </div>
          </div>
        </div>

<!-- /////////////////////for risk -->
        
        </div>
      </body>
    </body>
<style type="text/css">
  
</style>
</html>