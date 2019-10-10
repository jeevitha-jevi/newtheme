<?php require_once __DIR__.'/../header.php';?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Risk List</title>
    <base href="/freshgrc/">
     
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <!-- <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>   -->
    <!-- <script type="text/javascript" src="assets/DataTables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script> -->
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/dataTables.buttons.min.js"></script> 
           <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.flash.min.js"></script> 
        <script type="text/javascript" src="assets/DataTables/pdfmake.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/pdfmake-0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>    
   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
    <script src="js/risk/riskManagement.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
 
</head>
<style>
        #viewdata {
          margin-left: 280px;
          margin-top: -198px;
          margin-right: 135px;
          margin-bottom: 40px;
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
            margin-top: -46px;
        }
        .portlet.box .dataTables_wrapper .dt-buttons {
           margin-top: -42px !important;
        }
         .btn.btn-outline.dark {
            border-color: #2f353b;
            color: #2f353b;
            background: 0 0;
            border: 1px solid #2f353b !important;
            margin-left: 7px !important;
           
        }
        .btn.btn-outline.red {
            border-color: #e7505a;
            color: #e7505a;
            background: 0 0;
            border: 1px solid #e7505a !important;
             margin-left: 7px !important;
        }
        .btn.btn-outline.green {
            border-color: #32c5d2;
            color: #32c5d2;
            background: 0 0;
             border: 1px solid #32c5d2 !important;
              margin-left: 7px !important;
        }
        .btn.btn-outline.purple {
            border-color: #8E44AD;
            color: #8E44AD;
            background: 0 0;
            border: 1px solid #8E44AD !important;
             margin-left: 7px !important;
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
            /*margin-right: 23px;*/
            margin-top: 10px;
            /*display: none !important;*/

       }
       .page-container {
    margin: 0;
    padding: 20px 20px 0;
    position: relative;
    margin-top: 70px !important;
}
.portlet.box .dataTables_wrapper .dt-buttons {
      margin-top: 5px !important;
}

         </style>

<body class="with-side-menu-compact">
    <?php 
        include '../siteHeader.php';
        $currentMenu = 'riskAdmin';
        include '../common/leftMenu.php';
        $userRole = $_SESSION['user_role'];
    ?>   
    <body>
        <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box green">
                                <div class="portlet-title" style="">
                                    <div class="caption">My Risks</div>
                                </div>
    <div class="portlet-body ">
        <?php if($_SESSION['user_role'] == 'risk_owner') {?>
                <div class="col-xs-2" id="edit">
                    <button class="btn btn-primary" style="margin-left: 20px;" onclick="editRiskPlan(true)"><i class="fa fa-file"></i>Edit Risk</button>
                </div>                
                <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="width: auto;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Manage User Details</h4>
                </div>
                <div class="modal-body">
                    <form id="form1">
                         <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject">
                            <input type="hidden" class="form-control" id="id">
                            <input type="hidden" class="form-control" id="action">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="updaterisk" onclick="manageRisk()" data-dismiss="modal" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
            <?php }?>
            <?php if($_SESSION['user_role'] == 'risk_mitigator') {?>
                <div class="clearfix" id="mitigator1">
                    <button class="btn btn-primary" style="margin-left: 20px;" onclick="showRiskMitigation()"><i class="fa fa-user"></i>Mitigation</button>
                </div>
            <?php }?>
            <?php if($_SESSION['user_role'] == 'risk_reviewer') {?>
                <div class="col-xs-2" id="reviewer1">
                    <button class="btn btn-primary" style="margin-left: 20px;" onclick="showRiskReview()"><i class="fa fa-user"></i>Reviewer</button>
                </div>
                <div class="col-xs-2" id="reportButton">
                    <button class="btn purple-intense" style="margin-left: -51px;" onclick="viewReport()"><i class="fa fa-file"></i> Report</button>
                </div>
            <?php }?>                

            
            <div class="container" style="width: 100%;">
            <table id="modaldetails" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 7% !important;">Sr.No</th> 
                        <th>Risk Id</th>
                        <th>Subject</th>
                        <th>Status</th>                        
                        <th >Risk Creator</th>
                        <th>Company Id</th>                        
                    </tr>
                   
                </thead>
            </table>
            </div>
        </div>
        </div> 
        </div>
        </div>
        </div>
        </div>

           <button style="float: right;border-radius:40%;" onclick="topFunction()" id="myBtn" title="Go to top"  class="btn btn-info btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span>Top</button> 
  <script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>     
    </body>
</body>
</html>
