<?php 

require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/compliance/clauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';

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


    <body class="dataTables">
        <div id="viewdata" class="container">
            <div class="panel panel-primary" style="background: ">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left"> Compliance Clauses for
                        <?php echo $complianceName?> -
                        <?php echo $version?> - <?php echo $complStatus?></h3>
                    <div class="pull-right">
                        <?php if($isActive || (($_SESSION['user_role']=='super_admin') && $GLOBALS['workingStatus']=='in_draft')) {?>
                            <button class="btn btn-danger" onclick="showModal(false, '', true)"><i class="fa fa-file"></i>Domain</button>
                        <?php }
                        if(!$isViewOnly) {
                            if ($GLOBALS['workingStatus'] == 'in_publish'){
                                // In this case there is two possibilities. Hence two buttons. Also no need to determine the status as the status is passed.
                                ?>
                                
                        <?php
                            }   ?>
                                <button class="btn btn-primary" onclick="saveComplStatus(true)"><i class="fa fa-file"></i>    Return</button>                        
                                <button class="btn btn-success" onclick="saveComplStatus(false)"><i class="fa fa-file"></i>    Publish</button>
                        <?php 
                                        
                        }?>
                    </div>
                    <div class="clearfix"></div>                    
                </div>
            </div>    
            <div>
                <input type="hidden" class="form-control" id="<?php echo 'currentComplianceId' ?>" value="<?php echo $complianceId ?>">
                <input type="hidden" class="form-control" id="<?php echo 'currentComplianceStatus' ?>" value="<?php echo $complStatus ?>">
                <input type="hidden" class="form-control" id="<?php echo 'currentLoggedInUser' ?>" value="<?php echo $_SESSION['user_id'] ?>"> 
                <input type="hidden" class="form-control" id="<?php echo 'currentWorkingStatus' ?>" value="in_publish">                 
            </div>
            <?php include 'clauseDisplayReview.php' ?>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <?php include 'complianceClauseModalReview.php'?>
                    <?php include 'clauseChecklistModalReview.php'?>
                </div>
            </div>
        </div>
    </body>

    <script src="assets/DataTables/Bootstrap-3.3.6/js/bootstrap.js"></script>
</body>

</html>