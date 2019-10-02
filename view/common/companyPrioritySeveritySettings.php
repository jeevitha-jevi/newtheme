<?php require_once __DIR__.'/../header.php';
require_once '../../php/common/dashboard.php';
require_once '../../php/compliance/complianceManager.php';
$manager = new dashboard();
$com_manager = new ComplianceManager();
$data = $com_manager->checkMail($prioData); 
$userSocialMedias = $manager->getUserSocialMedias(1);
$userImage = $manager->getUserImage(1);
?>
<!DOCTYPE html>
<html lang="en">
  <head lang="en">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Fresh GRC Admin</title>
  <base href="/freshgrc/">  
  <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
   <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>  
  <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> 
  <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" /> 
  <link href="metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
  <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" /> 
  <link href="metronic/theme/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />  
  <link href="metronic/theme/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
  <link href="metronic/theme/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" /> 
  <link rel="shortcut icon" href="favicon.ico" />
  <script src="js/common/userProfile.js"></script> 
  </head> 
  <body >
    <?php
      include '../siteHeader.php'; 
      include '../../php/policy/left.php';
      $currentMenu = 'auditorAdmin';      
      $userRole = $_SESSION['user_role'];
    ?>
    <?php if($_SESSION['user_role'] == 'auditor') {?>      
    <?php }?>  
  </body>
  <body>
    <div class="page-content-wrapper">      
      <div class="page-content">                                 
        <div class="row">
          <div class="col-md-12">
            <div class="profile-content">
              <div class="row">
                <div class="col-md-12">                     
                  <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                      <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Priority and severity</span>
                      </div>
                      <ul class="nav nav-tabs">
                        <li class="active">
                          <a href="#tab_1_1" data-toggle="tab">Priority Severity Settings</a>
                        </li>
                                                                                                
                      </ul>
                    </div>
                    <div class="portlet-body">
                      <div class="tab-content">                         
                        <div class="tab-pane active" id="tab_1_1">
                          <form role="form" action="" method="post">
                            <div class="form-group">
                              <input type="hidden" class="form-control" id="loggedInUser" name="loggedInUser" value="<?php echo $_SESSION['user_role']; ?>"> 
                              <input type="hidden" class="form-control" name="action" id="action"> 
                            </div>
                            <div class="form-group">
                              <label for="priority">No Of Mails For Priority Per Week Low</label>
                              <input class="form-control" name="priority" id="priority" value="<?php echo $data[0]['mailperweekpriority'];?>" onkeyup="value=isNaN(parseFloat(value))||value<1||value>20?20:value"/> </div><br>

                            <div class="form-group">
                              <label for="severity">No Of Mails For Severity Per Week Low</label>
                              <input class="form-control" name="severity" id="severity"  value="<?php echo $data[0]['mailperweekseverity'];?>" onkeyup="value=isNaN(parseFloat(value))||value<1||value>20?20:value"/>

                              <input type="hidden" id="company" value="<?php echo $_SESSION['company']; ?>">
                            </div> <br>
                             <div class="form-group">
                              <label for="priority">No Of Mails For Priority Per Week Medium</label>
                              <input class="form-control" name="priorityMed" id="priorityMed" value="<?php echo $data[0]['mailperweekprioritymed'];?>" onkeyup="value=isNaN(parseFloat(value))||value<1||value>20?20:value"/> </div><br>

                               <div class="form-group">
                              <label for="priority">No Of Mails For Severity Per Week Medium</label>
                              <input class="form-control" name="severityMed" id="severityMed" value="<?php echo $data[0]['mailperweekseveritymedium'];?>" onkeyup="value=isNaN(parseFloat(value))||value<1||value>20?20:value"/> </div> <br>

                             <div class="form-group">
                              <label for="priority">No Of Mails For Priority Per Week High</label>
                              <input class="form-control" name="priorityHigh" id="priorityHigh" value="<?php echo $data[0]['mailperweekpriorityhigh'];?>" onkeyup="value=isNaN(parseFloat(value))||value<1||value>20?20:value"/> </div><br>

                               <div class="form-group">
                              <label for="priority">No Of Mails For Severity Per Week High</label>
                              <input class="form-control" name="severityHigh" id="severityHigh" value="<?php echo $data[0]['mailperweekseverityhigh'];?>" onkeyup="value=isNaN(parseFloat(value))||value<1||value>20?20:value"/> </div><br>

                            <div class="margiv-top-10">
                              <button class="btn green" onclick="setPriorityAndSeverity()"> Save Changes </button>
                              <button class="btn default"> Cancel </button>
                            </div>
                          </form>
                        </div>                            
                                                                
                      </div>
                    </div>
                  </div>                     
                </div>                
              </div>                              
            </div>
          </div>           
        </div>
      </div>
    </div>
    <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>  
    <script src="metronic/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script> 
    <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>  
    <script src="metronic/theme/assets/pages/scripts/profile.min.js" type="text/javascript"></script>
  </body> 
</html>
