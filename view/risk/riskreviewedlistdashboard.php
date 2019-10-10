<?php require_once __DIR__.'/../header.php';?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Report</title>
    <base href="/freshgrc/">

    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>      
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    <script src="js/risk/reviewedriskManagementdashboard.js"></script>


    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <!-- metronic link for multiselect -->
    <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <!-- end -->
<!-- script link  multi select-->
        <!-- <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
        <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
         <script src="metronic/theme/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
         <!-- end -->



    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">

    <style>
        #viewdata {
            margin-left: 290px;
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
       label{
        font-weight: 600;
        }
        body{
          font-size: 14px !important;
        }
        body, h1, h2, h3, h4, h5, h6 {
          font-family: "Open Sans",sans-serif;
        }
        .hover{
          color:none;
        }
        .panel{
          background-color: #fff;
          border: 1px solid #32c5d2;
          margin-bottom: 20px;
          box-shadow: none!important;
          border-radius: 0!important;
          color: rgba(0,0,0,0.87);
          padding: 20px;
          width: 1150px;
        }
        .btn{
          border-radius: 0px !important;
          border: none !important;
        }
        .form-control{
              border-radius: 0px;
        }
        .label{
          font-size: bold;
        }
        .panel-heading{
          background-color: #32c5d2; color:#fff;
          font-size: 18px;left: -100px !important; 
          width: 1150px;margin-left: -20px;margin-top: -21px;font-weight: 600
        }
        .modal-content{
          border-radius: 0px;
          border: none;
          width: 600px;
        }
        .modal-header{
          background-color: #3bc5d2;height: 60px;
                    color: #fff;
        }
        .split{
          width: 300px;padding-right: 15px
        }
        .split1{
          width: 290px;padding-left: 15px;padding-right: 15px
        }
        .split2{
          margin-left: 295px;margin-top: -69px;width: 290px;
        }
        .dataTables_wrapper .dt-buttons {
    float: right;
    margin-top: -44px;
    margin-left: 7px;
}
 .btn.btn-outline.dark {
    border-color: #2f353b;
    color:#6c7a86 !important;
    background: 0 0;
    border: 1px solid #2f353b !important;
    margin-left: 7px !important;
   
}
.btn.btn-outline.dark.hover{
    background-color: #fff !important;

}
.btn.btn-outline.red {
    border-color: #e7505a;
    color: #6c7a86 !important;
    background: 0 0;
    border: 1px solid #e7505a !important;
     margin-left: 7px !important;
}
.btn.btn-outline.green {
    border-color: #32c5d2;
    color: #6c7a86 !important;
    background: 0 0;
     border: 1px solid #32c5d2 !important;
      margin-left: 7px !important;
}
.btn.btn-outline.purple {
    border-color: #8E44AD;
    color: #6c7a86 !important;
    background: 0 0;
    border: 1px solid #8E44AD !important;
     margin-left: 10px !important;
}
.page-sidebar{
         margin-top: 3%;
      }
      .page-container {
    margin: 0;
    padding: 20px 20px 0;
    position: relative;
    margin-top: 36px !important;
}
.page-sidebar.navbar-collapse {
    max-height: none!important;
    position: fixed;
}
 div.dataTables_wrapper div.dataTables_length label {
        font-weight: normal;
        text-align: left;
        white-space: nowrap;
        display: none !important;
        }
        div.dataTables_wrapper div.dataTables_filter label {
            font-weight: normal;
            white-space: nowrap;
            text-align: left;
            
       }
 </style>
 
</head>
<body class="with-side-menu-compact" style="margin-top: -100px;">
    <?php 
        include '../siteHeader.php';
        $currentMenu = 'riskAdmin';
        // include '../common/leftMenu.php';
        // $userRole = $_SESSION['user_role'];
    ?>   
<div style="margin-top: 70px !important;">
        <?php include '../common/leftMenu.php'; ?>
      </div> 
    <body class="dataTables">
        <div id="viewdata" class="panel" style="border: 1px solid #32c5d2;">
         <div class="panel-heading" style=" background-color: #32c5d2;">My Risks
       </div>
            <br/>
            <div class="row">            
            <?php if($_SESSION['user_role'] == 'risk_reviewer') {?>               
                <div class="col-xs-2" id="reportButton">
                    <button class="btn purple-intense" onclick="viewReport()"><i class="fa fa-file"></i> Report</button>
                </div>
            <?php }?>                
            </div>
            <br/>
            <br/>
            <div class="container" style="width: 100%;">
            <table id="modaldetails" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Sr.No</th> 
                        <th>RiskId</th>
                        <th>Subject</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Closed date</th>  
                        <!-- <th>Calculated Risk</th> -->
                    </tr>
                </thead>
            </table>
            </div>
        </div>
        </div> 
        <script>
        </script>
    </body>
</body>
</html>
