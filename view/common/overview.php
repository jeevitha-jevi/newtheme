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
   
    <script src="js/audit/auditCreateManagement.js"></script>
    <script src="//fast.appcues.com/53228.js"></script>

  
<!--     // NOTE: These values should be specific to the current user. -->
<script>
  Appcues.identify(53228, { // Replace with unique identifier for current user
    name: "nagesh",   // Current user's name
    email: "nagesh@fixnix.co", // Current user's email
    created_at: 1553695871,    // Unix timestamp of user signup date
    // Additional user properties.
    // is_trial: false,
    // plan: "enterprise"
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
    <div class="page-content-wrapper">      
      <div class="page-content" style="margin-top: -10px;">   

      <!--

        hint button

       <div>
      <a class="btn btn-primary btn-sm" href="javascript:Appcues.show('-Lc-T_w0z3K5SW_tj-aK')">Show hints &#x27a4;</a>
    </div> -->
                             
        <div class="row">
          <div class="col-md-12">                           
            <div class="profile-sidebar">                                
              <div class="portlet light profile-sidebar-portlet bordered" style="height: 425px;">   

                <div class="profile-userpic">
                  <a href="view/common/overview.php"><img style="width:160px !important;height:106px !important;" src="<?php echo "uploadedFiles/auditeeFiles/" .$userImage[0]['image_name']; ?>" class="img-responsive" alt=""></a>  
                </div>       

                <div class="profile-usertitle">
                  <div class="profile-usertitle-name" style="color: #2471A3"> 
                    <?php $userRole = $_SESSION['user_role'];
                      echo $userRole;
                     ?>
                  </div>                  
                </div>                                    
                <div class="profile-userbuttons" style="margin-top: 60px;">
                  <!-- <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                  <button type="button" class="btn btn-circle red btn-sm">Message</button> -->
                </div>
                <div>
                  <div class="margin-top-20 profile-desc-link">&nbsp;&nbsp;&nbsp;&nbsp;
                    <!-- <i class="fa fa-globe"></i> -->
                   <i style="color: #e5e5e5; background-color: #44B6AD; border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;" class="fa fa-user" ></i>
                    <i style="font-size: 17px; color: #2C3E50; "><?php echo $_SESSION['user_role'];?></i>
                  </div>
                  <div class="margin-top-20 profile-desc-link">&nbsp;&nbsp;&nbsp;&nbsp;
                   <i style="color: #e5e5e5; background-color: #44B6AD; border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;" class="fa fa-phone"></i><!-- <i class="fa fa-twitter"></i> -->
                    <i style="font-size: 17px; color: #2C3E50;"><?php echo $usermail[0]['phone_no'];?></i>
                  </div>
                  <div class="margin-top-20 profile-desc-link">&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-envelope-o" style="color: #e5e5e5; background-color: #44B6AD; border-radius: 50%;padding: 0.3em;height: 1.6em; width: 1.6em;"></i><!-- <i class="fa fa-facebook"></i> -->
                    <i style="font-size: 17px; color: #2C3E50;"><?php echo $usermail[0]['email'];?></i>
                  </div>
                </div>                             
                <!-- <div class="profile-usermenu">
                  <ul class="nav">
                    <li class="active" data-step="2" data-intro="Overview of Your profile.">
                      <a href="view/common/overview.php">
                      <i class="icon-home"></i> Overview </a>
                    </li>
                    <li data-step="8" data-intro="Update Your Account Settings.">
                      <a href="view/common/accountSettings.php">
                      <i class="icon-settings"></i> Account Settings </a>
                    </li>
                    <li data-step="9" data-intro="Documentation for freshgrc.com">
                      <a href="view/common/profilehelp.php">
                      <i class="icon-info"></i> Help </a>
                    </li>
                  </ul>
                </div> -->
              </div>                                
                                           
            </div>                           
            <div class="profile-content">
              <div class="row">
               <div class="col-md-12">
                  <div class="portlet light portlet-fit bordered" data-step="6" data-intro="This is the list Timeline" style="height: 425px;">
                    <div class="portlet-title">
                      <div class="caption" >
                        <i style="text-align: center;" class="icon-microphone font-red"></i>
                        <span class="caption-subject bold font-red uppercase"> Timeline</span>
                        <span class="caption-helper" style="color: #44B6AD">user timeline</span>
                      </div><br><br><br>
                     <div> 
                      <form style="margin-left: 60px;" method="POST" onsubmit="return validate1();" action="view/common/chatProcess.php">
                        <select name="to_id" style="height:30px;width: auto; background-color: white;border: 1px solid #48D1CC;">
                           <?php foreach($users as $user){
                            if($_SESSION['user_id']!=$user['id']){ ?>
                          <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['last_name']); ?></option>
                           <?php } } ?> 
                        </select><br><br>
                        <div class="form-group">
                          <label for="comment"></label>
                          <textarea name="chatMessage" id="chatMessage" placeholder="Type Something Here...!" class="form-control" rows="4" style="border-color: #48d1cd"></textarea>
                        </div>
                        <!-- <textarea name="chatMessage" id="chatMessage" placeholder="Type Something Here...!" style="height: 80px;width: 350px; border: 1px solid #44BBC8;"></textarea> --><br>
                        <button type="submit" name="submit" style="width: 70px;margin-top: -20px;height: 25px;margin-left:5px; border: 1px solid #48D1CC;background-color: #48D1CC;">Post</button>
                      </form> </div>                     
                    </div>
                    <div class="portlet-body">
                      <div class="timeline" style="overflow:scroll; height:180px;">                               
                        <div class="timeline-item">                                                        
                          <div class="timeline-item">
                            <div class="timeline-badge">
                            <img class="timeline-badge-userpic" src="assets/img/shan.jpg"> </div>
                            <div class="timeline-body">
                              <div class="timeline-body-arrow"> </div>
                              <div class="timeline-body-head">
                                <div class="timeline-body-head-caption">
                                  <a href="javascript:;" class="timeline-body-title font-blue-madison" style="color: #5C5BFF;">Shanmugavel Sankaran</a>
                                  <span class="timeline-body-time font-grey-cascade">Added office location at 2:50 PM</span>
                                </div>
                                <div class="timeline-body-head-actions">
                                  <div class="btn-group">                                      
                                    <ul class="dropdown-menu pull-right" role="menu">
                                      <li>
                                        <a href="javascript:;">Action </a>
                                      </li>
                                      <li>
                                        <a href="javascript:;">Another action </a>
                                      </li>
                                      <li>
                                        <a href="javascript:;">Something else here </a>
                                      </li>
                                      <li class="divider"> </li>
                                      <li>
                                        <a href="javascript:;">Separated link </a>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>                                    
                            </div>
                          </div>  
                       <?php foreach($chats as $chat){ ?>  
                       <?php $from = $timeManager->userDetails($chat['from_id']); ?>                            
                          <div class="timeline-item">
                            <div class="timeline-badge">
                              <div class="timeline-icon">
                                <i class="icon-user-following font-green-haze"></i>
                              </div>
                            </div>
                            <div class="timeline-body">
                              <div class="timeline-body-arrow"> </div>
                              <div class="timeline-body-head" style="height: 20px;">
                                <div class="timeline-body-head-caption" >
                                  <span class="timeline-body-alerttitle font-red-intense"><?php echo $from[0]['last_name']; ?></span>
                                  <?php $to = $timeManager->userDetails($chat['to_id']); ?>
                                  <span class="timeline-body-time font-grey-cascade"><?php echo $chat['create_time']; ?></span>
                                </div>
                                <div class="timeline-body-head-actions">
                                  <div class="btn-group">                                        
                                      <ul class="dropdown-menu pull-right" >
                                        <li>
                                          <a href="javascript:;">Action </a>
                                        </li>
                                        <li>
                                          <a href="javascript:;">Another action </a>
                                        </li>
                                        <li>
                                          <a href="javascript:;">Something else here </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                          <a href="javascript:;">Separated link </a>
                                        </li>
                                      </ul>
                                  </div>
                                </div>
                              </div>
                              <div class="timeline-body-content">
                                <span class="font-grey-cascade"> @<?php echo $to[0]['last_name']; ?>  <?php echo $chat['message']; ?>
                                  
                                </span>
                              </div>
                            </div>
                          </div> 
                      <?php }?>
                      
                        </div>
                        
               
                      </div>
                    </div>
                  </div>
                </div>
                                         
                </div>
                
              </div>              
                                                    
            </div>
            <div class="col-md-6">                                       
                  <div class="portlet light bordered" data-step="4" data-intro="This is the list of Feeds for Compliance library." style="height: 255px;">
                    <div class="portlet-title tabbable-line">
                      <div class="caption caption-md">
                        <i class="icon-globe theme-font font-red"></i>
                        <span class="caption-subject font-red bold uppercase">Feeds</span>
                      </div>                      
                    </div>
                    <div class="portlet-body" style="overflow:auto; height:170px;">                                               
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1">
                          <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#FFA130">
                            <ul class="feeds">
                              <?php foreach($feeds as $feed){ ?>
                                <li>
                                  <div class="col1">                                
                                    <div class="cont">
                                      <div class="cont-col1">
                                        <!-- <div class="label label-sm label-success"> -->
                                          <i class="fa fa-bell-o fa-lg" style="border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em; background: #3DA1ED; color: #e5e5e5;"></i>
                                        <!-- </div> -->
                                      </div>
                                      <div class="cont-col2">
                                      <?php if($userRole == 'compliance_author'){ ?>
                                          <div class="desc" id="feed<?php echo $auditId ?>">New <?php echo $feed['procedure']?>  <?php echo $feed['name']?> is created by <?php echo $feed['last_name'] ?> <?php echo $feed['name'] ?>
                                      <?php } else if($userRole == 'compliance_reviewer') { ?>
                                          <div class="desc" id="feed<?php echo $auditId; ?>"> <?php echo $feed['name'];?> is <?php echo $feed['status'];?>                                          
                                      <?php }
                                      else if($userRole == 'incident_analyst' || $userRole == 'incident_manager') { ?>
                                          <div class="desc" id="feed<?php echo $auditId; ?>"> <?php echo $feed['Title'];?> is <?php echo $feed['status'];?> on <?php echo $feed['date_occured'];?> by                                         
                                      <?php }
                                      else if($userRole == 'incident_resolver') { ?>
                                          <div class="desc" id="feed<?php echo $auditId; ?>"> <?php echo $feed['Title'];?> is <?php echo $feed['status'];?> on <?php echo $feed['date_occured'];?> by                                         
                                      <?php }
                                      else if($userRole == 'incident_reviewer') { ?>
                                          <div class="desc" id="feed<?php echo $auditId; ?>"> <?php echo $feed['Title'];?> is <?php echo $feed['status'];?> on <?php echo $feed['date_occured'];?> by                                         
                                      <?php }
                                       else {?>
                                        <div class="desc" id="feed<?php echo $auditId ?>"><?php echo $feedMessage." " ?> <?php echo $feed['last_name'] ?><?php echo $feed['name'] ?> 
                                      <?php } ?>

                                      <?php if($userRole == 'policy_owner'){ ?>
                                          <div class="desc" id="feed<?php echo $auditId ?>">New <?php echo $feed['procedure']?> - <?php echo $feed['title']?> is created by <?php echo $feed['last_name'] ?> <?php echo $feed['name'] ?>
                                      <?php } else if($userRole == 'policy_reviewer' || $userRole == 'policy_approver') { ?>
                                          <div class="desc" id="feed<?php echo $auditId; ?>"> <?php echo $feed['title'];?> is <?php echo $feed['status'];?>                                          
                                      <?php } else {?>
                                        <div class="desc" id="feed<?php echo $auditId ?>"><?php echo $feedMessage." " ?> <?php echo $feed['last_name'] ?>     <?php echo $feed['title'] ?> 
                                      <?php } ?>
                                          <?php if($isAuditor==1){ ?>
                                            <span class="label label-sm label-info">
                                              
                                              <a  <?php if($feed['status']=="create") {?> href="view/audit/auditDoPage.php?auditId=<?php echo $feed['id'] ?>" <?php }?>  <?php if($feed['status']=="prepared") {?> href="view/audit/auditeeDoPage?auditId=<?php echo $feed['id'] ?>" <?php }?> <?php if($feed['status']=="performed") {?> href="view/audit/auditCheckPage.php?auditId=<?php echo $feed['id'] ?>" <?php }?> <?php if($feed['status']=="returned") {?> href="view/audit/auditActPage.php?auditId=<?php echo $feed['id'] ?>" <?php }?>> Take action</a>  <?php } ?>
                                            </span>
                                        </div>
                                      </div>
                                    </div>                                  
                                  </div>
                                  <div class="col2">
                                      <?php if($userRole == 'policy_owner' || $userRole == 'policy_reviewer' || $userRole == 'policy_approver' || $user_role == 'compliance_author' || $user_role == 'compliance_reviewer'){?>
                                        <div class="date"><?php echo $feed['date']?></div>
                                      <?php } else {  ?>
                                        <div class="date"> Just now </div>
                                      <?php } ?>
                                  </div>
                                </li>
                              <?php 
                            } ?>
                          </div>
                        </div>                        
                      </div>
                    </div>
                  </div>                  
                </div>
        <div class="col-md-6" style="margin-left:0px;">                      
                  <div class="portlet light bordered" data-step="5" data-intro="Logs of user logins" style="height: 255px;">
                    <div class="portlet-title">
                      <div class="caption caption-md" >
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">User Logs</span>
                        
                      </div>                      
                    </div>
                    <div class="portlet-body">
                      <div class="scroller" style="height: 160px; overflow-y: scroll;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
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




                        <div class="col-md-4">                      
                  <div class="portlet light bordered tasks-widget" data-step="3" data-intro="This is the list of Pending Tasks." style="height: 256px;">
                        <div class="row list-separated profile-stat">
                <?php if($_SESSION['user_role']=='super_admin'){ ?>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totaladminprojects" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><a href="view/common/todotask.php"><span class="font-red">Projects</span> </a></div>
                  </div>
                <?php } ?>
                <?php if($_SESSION['user_role']=='auditor' || $_SESSION['user_role']=='auditee'){ ?>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totalauditprojects" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><a href="view/common/todotask.php"><span class="font-red">Projects</span> </a></div>
                  </div>
                <?php } ?>
                <?php if($_SESSION['user_role']=='super_admin'){ ?>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totaladmintasks" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><a href="view/common/todotask.php"><span class="font-red"> Tasks</span></a></div>
                  </div>
                <?php } ?>
                <?php if($_SESSION['user_role']=='auditor' || $_SESSION['user_role']=='auditee'){ ?>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totalaudittasks" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><a href="view/common/todotask.php"><span class="font-red"> Tasks</span></a></div>
                  </div>
                <?php } ?>
                <?php if($_SESSION['user_role']=='risk_owner' || $_SESSION['user_role']=='risk_mitigator' || $_SESSION['user_role']=='risk_reviewer' ){ ?>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totalriskprojects" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><a href="view/common/todotask.php"><span class="font-red">Projects</span> </a></div>
                  </div>
                <?php } ?>
                <?php if($_SESSION['user_role']=='risk_owner' || $_SESSION['user_role']=='risk_mitigator' || $_SESSION['user_role']=='risk_reviewer' ){ ?>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totalrisktasks" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><a href="view/common/todotask.php"> <span class="font-red">Tasks</span></a></div>
                  </div>
                <?php } ?>
                <?php if($_SESSION['user_role']=='compliance_author' || $_SESSION['user_role']=='compliance_reviewer'){ ?>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totalcompprojects" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><a href="view/common/todotask.php"><span class="font-red">Projects</span> </a></div>
                  </div>
                <?php } ?>
                <?php if($_SESSION['user_role']=='compliance_author' || $_SESSION['user_role']=='compliance_reviewer'){ ?>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totalcomptasks" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><a href="view/common/todotask.php"><span class="font-red"> Tasks</span></a></div>
                  </div>
                <?php } ?>

                  <!-- <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totaluploads"></div>
                    <div class="uppercase profile-stat-text"> Uploads </div>
                  </div> -->
                </div>          
               <div>                  
                  <div class="margin-top-10 profile-desc-link" style="margin-left: 20px;">
                    <i style="color: #ffffff; background-color: #009195;border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;" class="fa fa-globe" ></i>
                    <a href="https://www.fixnix.co"><?php echo $userSocialMedias[0]['site'];?></a>
                  </div>
                  <div class="margin-top-10 profile-desc-link" style="margin-left: 20px;">
                    <i style="color: #ffffff; background-color: #00A1ED;border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;" class="fa fa-twitter"></i>
                    <a href="https://twitter.com"><?php echo $userSocialMedias[0]['twitter'];?></a>
                  </div>
                  <div class="margin-top-10 profile-desc-link" style="margin-left: 20px;">
                   <i style="color: #ffffff; background-color: #335B94;border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;" class="fa fa-facebook"></i>
                    <a href="https://www.facebook.com"><?php echo $userSocialMedias[0]['facebook'];?></a>
                  </div>
                </div>
                  </div>                      
                </div>
                <div class="col-md-4">                      
                  <div class="portlet light bordered tasks-widget" data-step="3" data-intro="This is the list of Pending Tasks." style="height: 256px;">
                    <div class="portlet-title">
                      <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font font-red"></i>
                        <span class="caption-subject font-red bold uppercase">Tasks</span>
                        <span class="caption-helper" style="color: #44B6AD"> Pending</span>
                      </div>                        
                    </div>
                    <div class="portlet-body" style="height:175px; overflow: auto;">
                        
                      <div class="task-content">
                        <div class="scroller"  data-always-visible="1" data-rail-visible1="0" data-handle-color="#FFA130"><?php foreach($pendingTasksForUsers as $allTasks){ ?>
                          <ul class="task-list">
                            <li style="cursor: pointer;">
                              <div class="task-checkbox">
                                <input type="hidden" value="1" name="test" />
                                <input type="checkbox" class="liChild" value="2" name="test" /> </div>
                              <div class="task-title" >
                                <span tabindex="0" class="task-title-sp" title="<?php echo $allTasks['taskName'] ?>" data-toggle="popover" data-trigger="focus"
                                  data-content="<?php echo'The task is assigned by '. $allTasks['userName'];
                                  echo'<br> The task is assigned to ' . $allTasks['userass'];
                                echo'<br> The due date is ' . $allTasks['dueDate']; ?>"  data-html="true" ><?php echo $allTasks['taskName'];?></span><span class="task-bell"><i class="fa fa-bell-o" style="color: #44B6AD"></i></span>
                              </div>                                
                            </li>
                          </ul>
                             <?php }?>                                                         
                        </div>
                      </div>
                   
                    </div>
                  </div>                      
                </div>
                                <div class="col-md-4">                      
                  <div class="portlet light bordered tasks-widget" data-step="3" data-intro="This is the list of Pending Tasks." style="height: 256px;">
                    <div class="portlet-title">
                      <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font font-red"></i>
                        <span class="caption-subject font-red bold uppercase">Tasks</span>
                        <span class="caption-helper" style="color: #44B6AD"> Completed</span>
                      </div>                        
                    </div>
                    <div class="portlet-body" style="height:175px; overflow: auto;">
                        
                      <div class="task-content">
                        <div class="scroller"  data-always-visible="1" data-rail-visible1="0" data-handle-color="#FFA130"><?php foreach($completedTasksForUsers as $allTasks){ ?>
                          <ul class="task-list">
                            <li style="cursor: pointer;">
                              <div class="task-checkbox">
                                <input type="hidden" value="1" name="test" />
                                <input type="checkbox" class="liChild" value="2" name="test" /> </div>
                              <div class="task-title" >
                                <span tabindex="0" class="task-title-sp" title="<?php echo $allTasks['taskName'] ?>" data-toggle="popover" data-trigger="focus"
                                  data-content="<?php echo'The task is assigned by '. $allTasks['userName'];
                                  echo'<br> The task is assigned to ' . $allTasks['userass'];
                                echo'<br> The due date is ' . $allTasks['dueDate']; ?>"  data-html="true" ><?php echo $allTasks['taskName'];?></span><span class="task-bell"><i class="fa fa-bell-o" style="color: #44B6AD;"></i></span>
                              </div>                                
                            </li>
                          </ul>
                             <?php }?>                                                         
                        </div>
                      </div>
                   
                    </div>
                  </div>                      
                </div>



     <?php
            if ($_SESSION['user_role']=='super_admin') {
            ?>
               
              <div class="col-md-12" style="margin-left: 0px;">
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
        </div>
      </div>   
      <button style="float: right;border-radius:40%;" onclick="topFunction()" id="myBtn" title="Go to top"  class="btn btn-info btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span></button>        
    </div>   

    
      <script type="text/javascript">
        function validate1(){
          var obj = document.getElementById('chatMessage');
            if (obj.value == '') 
              {
                alert("Please fill the field!")
                obj.focus();
                return false;
              }
              else
                return true;
        }
      </script>


    <!-- <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script> -->
    
   <!-- gmaps -->
    <!-- <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script src="metronic/theme/assets/pages/scripts/timeline.min.js" type="text/javascript"></script> 
    <script src="metronic/theme/assets/global/plugins/gmaps/gmaps.min.js" type="text/javascript"></script>  -->
  </body>  
</html>