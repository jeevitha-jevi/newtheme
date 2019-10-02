<?php require_once __DIR__.'/../header.php';
$companyId=$_SESSION['company'];
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ComplianceDashboard</title>
    <base href="/freshgrc/">

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
      
    <script src="js/compliance/complianceReportManagement.js"></script>


    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">



    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
   

    <style>
        #viewdata {
          /*margin-left: 242px;
          margin-top: -185px;
          margin-right: 135px;
          margin-bottom: 40px;*/
          margin-left: 22%;
          margin-top: -10%;
        }

        table,
        th,
        td {
            border: 1% solid black;
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
          font-size: 14px;
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
          .btn.btn-outline.dark {
            border-color: #2f353b;
            color: #2f353b;
            background: 0 0;
            border: 1px solid #2f353b !important;
            margin-top: 26px;
            margin-right: 5px;
           
        }
        .btn.btn-outline.red {
            border-color: #e7505a;
            color: #e7505a;
            background: 0 0;
            border: 1px solid #e7505a !important;
              margin-top: 26px;
              margin-right: 5px;
        }
        .btn.btn-outline.green {
            border-color: #32c5d2;
            color: #32c5d2;
            background: 0 0;
             border: 1px solid #32c5d2 !important;
               margin-top: 26px;
               margin-right: 5px;
        }
        .btn.btn-outline.purple {
            border-color: #8E44AD;
            color: #8E44AD;
            background: 0 0;
            border: 1px solid #8E44AD !important;
              margin-top: 26px;
              margin-right: 5px;
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
            display: none !important;

       }
        /*.label{
          font-size: bold;
        }*/
        /*.panel-heading{
          background-color: #32c5d2; color:#fff;
          width: 1150px;margin-left: -20px;margin-top: -21px;font-weight: 600
        }*/
        /*.modal-content{
          border-radius: 0px;
          border: none;
          width: 600px;
        }
        .modal-header{
          background-color: #3bc5d2;height: 60px;
                    color: #fff;
        }*/
        /*.split{
          width: 300%;padding-right: 15px
        }*/
       /* .split1{
          width: 290px;padding-left: 15px;padding-right: 15px
        }*/
       /* .split2{
          margin-left: 295px;margin-top: -69px;width: 290px;
        }*/
        
    </style>
</head>


<body>

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
        include '../../php/policy/left.php';

        // include '../common/leftMenu.php';
        $userRole = $_SESSION['user_role'];
    ?>
    <?php if($_SESSION['user_role'] == 'auditor') {?>
  
    <?php }?>
</body>


  
    <body >
       <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                  
                    <div class="row">
                        <div class="col-md-12">
                         <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">Report</div>
                                   <!--  <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                        <a href="javascript:;" class="remove"> </a>
                                    </div> -->
                                </div>
    
      <!--   <div id="viewdata" class="panel" style="margin-left: 10%;" >
        <div class="panel-heading text-center" style=" background-color: #5bc0de;     ">My Audits
 
       </div> -->
          <div class="portlet-body ">
            <?php if($_SESSION['user_role'] == 'compliance_author' || $_SESSION['user_role'] == 'super_admin') {?>
                <div class="row">
                  
                    <div class="col-xs-2" id="manageCompl">
                        <button class="btn btn-error btn-block" style="width:160px;background-color:#50C878;" onclick="showComplClauseDashboard()"><i class="fa fa-list"></i>Dashboard</button>
                    </div>
                    <!-- <div class="col-xs-2">                      
                        <label for="complianceCsv" aria-hidden="true">
                           <a href="assets/template.xlsx" download> <i class="btn btn-danger btn-block fa fa-file-excel-o">Template</i>
                            </a>
                        </label>                       
                    </div>  -->              
                </div>
            <?php } else if($_SESSION['user_role'] == 'grcadmin' || $_SESSION['user_role'] == 'compliance_reviewer') {?>
                    <div class="col-xs-2" id="editCompl">
                        <button class="btn btn-error btn-block" onclick="showComplClause()"><i class="fa fa-list"></i>  Manage Clauses</button>
                    </div>
            <?php } else {?>
                    <div class="col-xs-2" id="editCompl">
                        <button class="btn btn-error btn-block" onclick="showComplClause()"><i class="fa fa-list"></i>  View Clauses</button>
                    </div>
            <?php } ?>
         


            <table id="modaldetails" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead >
                   <tr>
                        <th>Compliance Id</th>
                        <th>Compliance Name</th>
                        <th>Compliance Description</th>
                        <th>Version</th>
                        <th>Company</th>
                        <th>Company Id</th>
                        <th>Compliance Status</th>
                    </tr>
                                        </thead>
                                        <tbody>
                                         <!--    <tr>
                                                <td> AAC </td>
                                                <td> AUSTRALIAN AGRICULTURAL COMPANY LIMITED. </td>
                                                <td class="numeric"> &nbsp; </td>
                                                <td class="numeric"> -0.01 </td>
                                                <td class="numeric"> -0.36% </td>
                                                <td class="numeric"> $1.39 </td>
                                                <td class="numeric"> $1.39 </td>
                                                <td class="numeric"> &nbsp; </td>
                                                <td class="numeric"> 9,395 </td>
                                            </tr> -->
                                      
                                        </tbody>
                                    </table>
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Manage Compliance Details</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form1">
                            <div class="form-group">
                                <label for="complianceName">Compliance Name</label>
                                <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                                <input type="hidden" class="form-control" id="complianceId">
                                <input type="hidden" class="form-control" id="action">
                                <input type="hidden" class="form-control" id="company" value=<?php echo $companyId ?>>
                                <input type="text" class="form-control" id="complianceName">
                            </div>
                            <div class="form-group">
                                <label for="complianceDesc">Decription</label>
                                <textarea class="form-control" maxlength="5000" rows="5" id="complianceDesc"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="version">Version</label>
                                <input type="text" class="form-control" id="version">
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="manageButton" onclick="saveCompliance()" data-dismiss="modal" class="btn btn-primary">Create</button>
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
                        <input type="hidden" class="form-control" id="complianceId_delete">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" id="save" onclick="deleteModal()" data-dismiss="modal" class="btn btn-primary">Yes</button>
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



</html>
