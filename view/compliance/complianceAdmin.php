

<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fresh GRC Admin</title>
    <base href="/freshgrc/">

   

     <link href="metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="metronic/theme/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
       
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
       
       <!-- <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" /> -->
        <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
        <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>   
        <script type="text/javascript" src="assets/DataTables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/dataTables.buttons.min.js"></script> 
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.flash.min.js"></script> 
        <script type="text/javascript" src="assets/DataTables/pdfmake.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/pdfmake-0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.print.min.js"></script>
    <!-- <script src="js/compliance/complianceManagement.js"></script>
 -->

    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">



    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css"> -->



    <style>
        #viewdata {

            margin-left: 285px;
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


<body class="with-side-menu-compact">

    <?php 
      /*  include '../siteHeader.php';
        $currentMenu = 'complainceAdmin';
        include '../common/leftMenu.php';*/
    ?>
    
    <body class="dataTables">
        <div  class="container">
            <h4 ><u>Manage Compliances</u></h4>
            <br/>
            <?php if($_SESSION['user_role'] == 'compliance_author' || $_SESSION['user_role'] == 'super_admin') {?>
                <div class="row">
                    <div class="col-xs-2" id="newCompl">
                        <button class="btn btn-warning btn-block" onclick="showModal(false)"><i class="fa fa-plus-circle"></i> New</button>
                    </div>
                    <div class="col-xs-2" id="editCompl">
                        <button class="btn btn-success btn-block" onclick="showModal(true)"><i class="fa fa-pencil-square"></i>  Edit</button>
                    </div>
                    <div class="col-xs-2" id="deleteCompl">
                        <button class="btn btn-info btn-block" onclick="showDeleteDialog()"><i class="fa fa-trash"></i>  Delete</button>
                    </div>
                    <div class="col-xs-2" id="manageCompl">
                        <button class="btn btn-error btn-block" onclick="showComplClause()"><i class="fa fa-list"></i>  Manage Clauses</button>
                    </div>
                    <div class="col-xs-2" id="importCompl">                      
                        <label for="complianceCsv" aria-hidden="true">
                            <i class="btn btn-danger btn-block fa fa-file-excel-o">  Import Library</i>
                            <input type="file" style="display:none" onchange= "importCsv()" id="complianceCsv"/>
                        </label>                       
                    </div> 
                    <div class="col-xs-2">                      
                        <label for="complianceCsv" aria-hidden="true">
                           <a href="assets/template.xlsx" download> <i class="btn btn-danger btn-block fa fa-file-excel-o">Template</i>
                            </a>
                        </label>                       
                    </div>               
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
            <br/>
            <br/>
            
            <table id="modaldetails1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
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
            </table>

        </div>
        
</body>


