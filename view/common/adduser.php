<?php require_once __DIR__.'/../header.php';
require_once __DIR__.'/../subscription.php';
require_once '../../php/common/dashboard.php';
require_once '../../php/common/feedManager.php';
require_once __DIR__.'/timelinemanager.php';
//timeline
$timeManager = new TimeManager();
$users = $timeManager->users(); //user choice
$chats = $timeManager->timeLine(); //chat retrive
$manager = new dashboard();
$completedTasksForUsers=$manager->getCompletedTaskForUser($_SESSION['user_id']);
$pendingTasksForUsers=$manager->getPendingTaskForUser($_SESSION['user_id']);
 // $allTasksForUsers=$manager->getAllTaskForUser(1);
$allUsers = $manager->getAllUsersForTicket();
// $userSocialMedias = $manager->getUserSocialMedias($_SESSION['user_id']);
 $userSocialMedias = $manager->getUserSocialMedias(1);
 $userImage = $manager->getUserImage(1);

$usermail = $manager->mail($_SESSION['user_id']);

$projectId = $_SESSION['user_id'];
$getAllSupportTickets=$manager->getAllSupportTickets($projectId);
// echo $_SESSION['user_id'];
$feedManager=new FeedManager();
$loggedInUser=$_SESSION['user_id'];
$feeds=$feedManager->getFeeds($loggedInUser,$_SESSION['user_role']);
// $feeds=$feedManager->getFeeds(1,$_SESSION['user_role']);
error_log("feeds".print_r($feeds,true));
error_log("feeds".print_r($getAllSupportTickets,true));
require_once __DIR__.'/../../php/company/companyManager.php';
$manager=new CompanyManager();
$id=$manager->getCompanyIdForUser($_SESSION['user_id']);
switch ($_SESSION['user_role']) {
  case 'super_admin':
    $feedMessage="New Compliance Library is created by";
    $isAuditor=0;
    break;
  case 'auditor':
    $feedMessage="New Audit is assigned for";
    $isAuditor=1;
    break;
  default:
    # code...
    break;
}
$companyId=$id[0]['id'];
?>
<!DOCTYPE html>
<html lang="en">
  <head lang="en">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Super Admin</title>
  <base href="/freshgrc/">  
  <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>  
  <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> 
  <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
  <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" /> 
  <link href="metronic/theme/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />  
  <link href="metronic/theme/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
  <link href="metronic/theme/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" /> 
  <link rel="shortcut icon" href="favicon.ico" />
  <script src="js/common/userProfile.js"></script> 
  <link rel="stylesheet" type="text/css" href="assets/css/intro.css">
<script type="text/javascript" src="js/intro.js"></script> 

<script>

$(document).ready(function(){
    $('[data-toggle="popover"]').popover({ html : true, container: 'body'});    
});
</script>
   
    <script src="js/audit/auditCreateManagement.js"></script>
    <script src="//fast.appcues.com/50250.js">


    window.Appcues.identify("<?php echo $user->id; ?>", { // Replace with unique identifier for current user
  name: "aravind",   // Current user's name
  email: "aravind@fixnix.co", // Current user's email
  created_at: "<?php echo $user->created_at; ?>",    // Unix timestamp of user signup date
  
});

</script>

  </head>
  <style type="text/css">

    div.dataTables_wrapper div.dataTables_length label {
    font-weight: normal;
    text-align: left;
    white-space: nowrap;
    display: none;
}
  .scroller{
    overflow-y:scroll; 
  }
div.dataTables_wrapper div.dataTables_filter label {
    font-weight: normal;
    white-space: nowrap;
    text-align: left;
    display: none;
}

/* reset our lists to remove bullet points and padding */
.mainmenu, .submenu {
  list-style: none;
  padding: 0;
  margin: 0;
}

/* make ALL links (main and submenu) have padding and background color */
.mainmenu a {
  display: block;
  
  text-decoration: none;
  padding: 10px;
  color: #000;
}

/* add hover behaviour */
.mainmenu a:hover {
    background-color: rgb(242,246,249);
    text-decoration: none;
}


/* when hovering over a .mainmenu item,
  display the submenu inside it.
  we're changing the submenu's max-height from 0 to 200px;
*/

.mainmenu li:hover .submenu {
  display: block;
  max-height: 300px;
}

/*
  we now overwrite the background-color for .submenu links only.
  CSS reads down the page, so code at the bottom will overwrite the code at the top.
*/



/* hover behaviour for links inside .submenu */
.submenu a:hover {
   background-color: rgb(242,246,249);

}

/* this is the initial state of all submenus.
  we set it to max-height: 0, and hide the overflowed content.
*/
.submenu {
  overflow: auto;
  max-height: 0;
  -webkit-transition: all 0.5s ease-out;
  background-color: rgb(240, 250, 256);
}
  </style>

  <body >
    <?php

      include '../siteHeader.php'; 
      include '../../php/policy/left.php';
      $currentMenu = 'auditorAdmin';      
      $userRole = $_SESSION['user_role'];
    ?>  
  </body>
   <body>
    
 <div class="row">   
                <div class="col-md-10" style="margin-left:285px;">                      
                  <div class="portlet light bordered" data-step="5" data-intro="Logs of user logins">
                    <div class="portlet-title">
                      <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">User Logs</span>
                        
                      </div>                      
                    </div>
                    <div class="portlet-body">
                      <div class="scroller" style="height: 315px; overflow-y: scroll;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                        <div class="general-item-list">
                          <?php foreach($getAllSupportTickets as $support) {?>
                          <div class="item">
                            <div class="item-head">
                              <div class="item-details">
                                
                                <a class="item-name primary-link"><?php echo htmlspecialchars($support['last_name']) ?></a>
                                <!-- <span class="item-label">3 hrs ago</span> -->
                              </div>
                              <span class="item-status">
                              <span >Logged in at</span> <?php echo htmlspecialchars($support['logged_in_time']) ?>
                              <br/>
                              <span >Logged out at</span> <?php echo htmlspecialchars($support['logged_out_time']) ?>
                            </span>
                            </div>
                            
                          </div>
                          <?php } ?>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                 <?php
            if ($_SESSION['user_role']=='super_admin') {
            ?>
               
              <div class="col-md-10" style="margin-left: 285px;">
                <div class="portlet box green" data-step="7" data-intro="creating Organization Structure">
                  <div class="portlet-title"><div class="caption">USER MANAGEMENT</div></div>      
                  <div class="portlet-body">                        
                    <div class="table-scrollable table-scrollable-borderless">
                      <div class="container" style="width:100%; margin-left:-2%;
                        margin-top: 0px;">
                        <div class="row profile col-md-12" style="margin-top: 0px;">
                          <div class="" style="width: 105%; margin-left: 0%; 
                          margin-top: 0px; height: 426px;"> 
                            <div class="portlet light bordered" style="margin-left: 0%;
                              width: 100%; height: 654px;">
                              <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                  <i class="icon-globe theme-font hide"></i>
                                </div>
                                <div class="col-md-12" style="margin-left: -2%; width: 112%;">
                                  <?php 
                                    if($_SESSION['user_role']=='super_admin')
                                    {
                                      include "../superadmin/userAdmin.php";
                                    }
                                  ?>
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

            <?php              
            }
            ?>
          </div>
           </body>
    </html>