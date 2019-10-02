<?php require_once __DIR__.'/../header.php';
require_once '../../php/common/dashboard.php';
require_once '../../php/common/feedManager.php';
$manager = new dashboard();
$allUsers = $manager->getAllUsersForTicket();
$userSocialMedias = $manager->getUserSocialMedias($_SESSION['user_id']);
$feedManager=new FeedManager();
$loggedInUser=$_SESSION['user_id'];
$feeds=$feedManager->getPendingAudits($loggedInUser);
error_log("feeds".print_r($feeds,true));
require_once __DIR__.'/../../php/company/companyManager.php';
$manager=new CompanyManager();
$id=$manager->getCompanyIdForUser($_SESSION['user_id']);
$companyId=$id[0]['id'];
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
  </head> 
  <body >
    <?php
      include '../siteHeader.php'; 
      include '../common/leftMenu.php';
      $currentMenu = 'auditorAdmin';      
      $userRole = $_SESSION['user_role'];
    ?>  
  </body>
  <body>
    <div class="page-content-wrapper">      
      <div class="page-content">                                 
        <div class="row">
          <div class="col-md-12">                           
            <div class="profile-sidebar">                                
              <div class="portlet light profile-sidebar-portlet bordered">                                    
                <div class="profile-userpic">
                  <a href="view/common/profile.php"><img src="assets/img/avatar-sign.png" class="img-responsive" alt=""></a> 
                </div>                                   
               <div class="profile-usertitle">
                  <div class="profile-usertitle-name"> 
                    <?php $userRole = $_SESSION['user_role'];
                      echo $userRole;
                     ?>
                  </div>                  
                </div>                                    
                <div class="profile-userbuttons">
                  <!-- <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                  <button type="button" class="btn btn-circle red btn-sm">Message</button> -->
                </div>                                   
                <div class="profile-usermenu">
                  <ul class="nav">
                    <li>
                      <a href="view/common/overview.php">
                      <i class="icon-home"></i> Overview </a>
                    </li>
                    <li>
                      <a href="view/common/accountSettings.php">
                      <i class="icon-settings"></i> Account Settings </a>
                    </li>
                    <li>
                      <a href="view/common/profilehelp.php">
                      <i class="icon-info"></i> Help </a>
                    </li>
                  </ul>
                </div>
              </div>                                
              <div class="portlet light bordered">             
                <div class="row list-separated profile-stat">
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totalprojects"></div>
                    <div class="uppercase profile-stat-text"> Projects </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totaltasks"></div>
                    <div class="uppercase profile-stat-text"> Tasks </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totaluploads"></div>
                    <div class="uppercase profile-stat-text"> Uploads </div>
                  </div>
                </div>          
                <div>                  
                  <div class="margin-top-20 profile-desc-link">
                    <i class="fa fa-globe"></i>
                    <a><?php echo $userSocialMedias[0]['site'];?></a>
                  </div>
                  <div class="margin-top-20 profile-desc-link">
                    <i class="fa fa-twitter"></i>
                    <a><?php echo $userSocialMedias[0]['twitter'];?></a>
                  </div>
                  <div class="margin-top-20 profile-desc-link">
                    <i class="fa fa-facebook"></i>
                    <a><?php echo $userSocialMedias[0]['facebook'];?></a>
                  </div>
                </div>
              </div>                               
            </div>
             <?php
            if ($_SESSION['user_role']=='super_admin') {
            ?>                           
            <div class="profile-content">
              <div class="row">
                <div class="col-md-12">
                  <div class="portlet box green">
                    <div class="portlet-title"><div class="caption">USER MANAGEMENT</div></div>      
                    <div class="portlet-body">                        
                      <div class="table-scrollable table-scrollable-borderless">
                        <div class="container" style="width: 150%; margin-left: -37%;
                          margin-top: -20%;">
                          <div class="row profile col-md-12" style="margin-top: 56px;">
                            <div class="" style="width: 105%; margin-left: 11%; 
                            margin-top: 56px; height: 426px;"> 
                              <div class="portlet light bordered" style="margin-left: 7%;
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
            </div>
            <?php              
            }
            ?>
          </div>           
        </div>
      </div>
    </div>    
  </body>  
</html>