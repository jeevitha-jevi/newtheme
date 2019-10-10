<?php require_once __DIR__.'/../header.php';?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Incident as Risk</title>
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
      
    <script src="js/risk/incidentListManagement.js"></script>

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
        .portlet.box .dataTables_wrapper .dt-buttons {
            margin-top: -35px !important;
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
       .portlet.box .dataTables_wrapper .dt-buttons {
        margin-top: 6px !important;
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
        <script type="text/javascript">/* Chameleon - better user onboarding */!function(t,n,o){var a="chmln",e="adminPreview",c="setup identify alias track clear set show on off custom help _data".split(" ");if(n[a]||(n[a]={}),n[a][e]&&(n[a][e]=!1),!n[a].root){n[a].accountToken=o,n[a].location=n.location.href.toString(),n[a].now=new Date;for(var s=0;s<c.length;s++)!function(){var t=n[a][c[s]+"_a"]=[];n[a][c[s]]=function(){t.push(arguments)}}();var i=t.createElement("script");i.src="https://fast.trychameleon.com/messo/"+o+"/messo.min.js",i.async=!0,t.head.appendChild(i)}}(document,window,"SC9FMjUqvypdfxnQ63ksqfeIjZhXfpHYiS22b88rrKPUoT-1EzS1d-AmxY4PgzmagquxIG");
  // **This is an example script, don't forget to change the PLACEHOLDERS.**
  // Please confirm the user properties to be sent with your project owner.

  // Required:
  chmln.identify(USER.ID_IN_DB, {     // Unique ID of each user in your database (e.g. 23443 or "590b80e5f433ea81b96c9bf6")
    email: USER.EMAIL,                // Put quotes around text strings (e.g. "jim@example.com")

    // Optional - additional user properties:
    created: USER.SIGN_UP_DATE,       // Send dates in ISO or unix timestamp format (e.g. "2017-07-01T03:21:10Z" or 1431432000)
    name: USER.NAME,                  // We will parse this to extra first and surnames (e.g. "James Doe")
    role: USER.ROLE,                  // Send properties useful for targeting types of users (e.g. "Admin")
    logins: USER.LOGIN_COUNT,         // Send any data about user engagement (e.g. 39)
    project: USER.PROJECT_ID,         // Send any unique data for a user that might appear in any page URLs (e.g. 09876 or "12a34b56")

    // Optional - company properties:
    company: {                        // For B2B products, send company / account information here
      uid: COMPANY.ID_IN_DB,          // Unique ID of the company / account in your database (e.g. 9832 or "590b80e5f433ea81b96c9bf7")
      created: COMPANY.SIGN_UP_DATE,  // To enable targeting all users based on this company property
      name: COMPANY.NAME,             // Send any data that appears within URLs, such as subdomains (e.g. "airbnb")
      trial_ends: COMPANY.TRIAL_ENDS, // Send data about key milestones (e.g. "2017-08-01T03:21:10Z")
      version: COMPANY.VERSION,       // If your software varies by version then this will help show the correct guidance (e.g. "1.56")
      plan: COMPANY.PLAN,             // Send null when no value exists (e.g. "Gold", "Advanced")
      spend: COMPANY.CLV              // Send other properties that will help in targeting users (e.g. sales rep, source, stage)
    }
  });
</script>
</head>


<body>

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
        include '../common/leftMenu.php';
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
                                    <div class="caption">Incident List</div>
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
          <div class="portlet-body">
              <div class="clearfix" id="kickOffbtn">
                  <button class="btn btn-primary" onclick="createRisk()"  style="margin-left: 20px;margin-top: -8px;"><i class="fa fa-file"></i>Create Risk</button>
              </div>
              
         

<div class="container" style="width: 100%;">
            <table id="modaldetails" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead >
                    <tr>
                        <th>Incident Id</th>
                        <th style="width: 7%;">Sr.No</th>
                        <th>Title</th>
                        <th style="width: 10%;">Type</th>
                        <th style="width: 15%;">Source</th>
                         <th>Date & Time</th>
                        <th style="width: 15%;">Status</th>
                        
                    </tr>
                                        </thead>
                                        <tbody>
                                                                             
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                       
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>  
                </div>             
</body>



</html>
