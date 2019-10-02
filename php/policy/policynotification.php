<?php
require_once __DIR__.'/../../view/header.php';
require_once __DIR__.'/policymanagers.php';
$companyId=$_SESSION['company'];
$manager = new policymanagers();
$policynotify=$manager->policynotification();
$policyseennotify=$manager->setnotifyintoseen();
// print_r($setnotifyintoseen);
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
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>      
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    <!-- <script src="js/audit/auditManagement.js"></script>  -->
    <!-- <script src="js/audit/auditByCompliance.js"></script> -->
    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <link href="metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="metronic/theme/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="metronic/theme/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="metronic/theme/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css"> 

    
</head>
  <body style="font-family: sans-serif !important;">
   <body>
   	 <?php 
        include '../../view/siteHeader.php';
        $currentMenu = 'auditDashboard';
        include '../../php/policy/left.php';
        $userRole = $_SESSION['user_role'];
      ?>
 
   
               <div class="page-content-wrapper" style="width: 93%; margin-left: 50px;">                
              <div class="page-content"> 
              <div class="row">
            <div class="col-md-12">                 
         
              <div class="portlet box red">
                <div class="portlet-title">
                  <div class="caption">ALERT!</div>                              
                </div>  
                <div class="portlet-body ">               
                  <div class="row" style="overflow-y: scroll; position:relative; height: 500px;">
                    
                    <?php
                     foreach($policynotify as $policy){ ?>
                             <?php if($policy['notification_status']==1){ ?> 
                            <h5 style="padding: 25px; background-color: #B1EEDD;">New <?php echo $policy['title']; ?> is <?php echo $policy['status']; ?> on <?php echo $policy['created_date']; ?></h5>
                            <?php } else { ?>
                              New <?php echo $policy['title']; ?> is <?php echo $policy['status']; ?> on <?php echo $policy['created_date']; ?>
                            <?php } ?>


                             <input type="hidden" name="submit" id="company" value="<?php echo $policy['id']?>">
                              <input type="hidden" name="submit" id="company_id" value="<?php echo $policy['company_id']?>">
                               <hr>
                  <?php }  ?>
                  <?php
                  setnotifyintoseen();
                  ?>
                  
</div>
<div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

           

  </body>
  </html>
