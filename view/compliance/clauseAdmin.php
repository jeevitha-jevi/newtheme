<?php 

require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/compliance/clauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';
 // require_once __DIR__.'/../../php/audit/auditManager.php';
 // $riskManager = new AuditManager();
// $allcomp = $riskManager->getAllCompliances(7);
$complianceId = $_GET['complianceId'];
$userRole = $_SESSION['user_role'];
$complianceManager = new ComplianceManager();
$complianceData = $complianceManager->getComplianceData($complianceId, $userRole);
$complianceName = $complianceData['complianceName'];
$version = $complianceData['version'];
$clauseManager = new ClauseManager();
$allClauses = $clauseManager->getAllClauses($complianceData);
$accordionId = $complianceId;
$isViewOnly = $complianceData['isViewOnly'];
$isActive = $complianceData['isActive'];
$complStatus = $complianceData['status'];
$GLOBALS['workingStatus'] = $complianceData['workingStatus'];

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
    <script src="js/compliance/clauseManagement.js"></script>
     
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

            margin-left: 240px;
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

        .panel-heading h3 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: normal;
            width: 75%;
            padding-top: 8px;
        }

    </style>
</head>

<body >

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'complainceAdmin';
        //include '../common/leftMenu.php';
    ?>
</div>

    
        <div id="viewdata" class="container">
            <div class="panel panel-primary" style="background:#337ab7 ">
                <div class=" panel panel-primary panel-heading" style="background:#337ab7">
                    <h3 class="panel-title pull-left" style="background:#337ab7"> Compliance Clauses for
                        <?php echo $complianceName?> -
                        <?php echo $version?></h3>
                        <button class="btn" title="Delete" onclick="deletecompliancename()" style="background-color: #ED2C2B; margin-left: 46px;"><i class="fa fa-trash fa-2x" style="color:white;"></i></button>&nbsp;
                        <!--  <button type="submit" class="btn btn-danger" onclick="deletecompliancename();" style="margin-left:-50px;">Delete</button> -->
                    <div class="pull-right" style="background:#337ab7;">
                        <?php if($isActive || ($_SESSION['user_role']=='super_admin')) {?>
                            <button class="btn" title="AddDomain" onclick="showModal(false, '', true)" style="background-color: #08a32c;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 24px;px;"></i></button>&nbsp;&nbsp;
                        <?php }
                        if(!$isViewOnly) {
                            if ($GLOBALS['workingStatus'] == 'in_publish'){
                                // In this case there is two possibilities. Hence two buttons. Also no need to determine the status as the status is passed.
                                ?>
                                <button class="btn btn-primary" onclick="saveComplStatus(true)"><i class="fa fa-file"></i>    Return</button>                        
                                <button class="btn btn-success" onclick="saveComplStatus(false)"><i class="fa fa-file"></i>    Publish</button>
                        <?php
                            } else {
                                if($GLOBALS['workingStatus']!="published"){
                                ?>
                                <button class="btn" title="Review" onclick="saveComplStatus(false)" style="background-color: #f57e42; margin-left: -5px;"><i class="fa fa-share-square" aria-hidden="true" style="font-size: 24px;"></i></button>
                                <button class="btn btn-success" onclick="saveComplStatus(true)"><i class="fa fa-floppy-o"></i>Complete</button> 
                        <?php 
                            }         }            
                        }?>
                    </div>
                    <div class="clearfix"></div>                    
                </div>
            </div>    
            <div>
                <input type="hidden" class="form-control" id="id" value="<?php echo $complianceId ?>">
                <input type="hidden" class="form-control" id="<?php echo 'currentComplianceId' ?>" value="<?php echo $complianceId ?>">
                <input type="hidden" class="form-control" id="<?php echo 'currentComplianceStatus' ?>" value="<?php echo $complStatus ?>">
                <input type="hidden" class="form-control" id="<?php echo 'currentLoggedInUser' ?>" value="<?php echo $_SESSION['user_id'] ?>"> 
                <input type="hidden" class="form-control" id="<?php echo 'currentWorkingStatus' ?>" value="<?php echo $GLOBALS['workingStatus'] ?>">                 
            </div>
            <?php include 'clausesDisplay.php' ?>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <?php include 'complianceClauseModal.php'?>
                    <?php include 'clauseChecklistModal.php'?>
                </div>
            </div>
        </div>
    </body>

    <script src="assets/DataTables/Bootstrap-3.3.6/js/bootstrap.js"></script>
</body>

</html>