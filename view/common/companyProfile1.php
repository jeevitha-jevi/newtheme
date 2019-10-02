<?php require_once __DIR__.'/../header.php';
require_once '../../php/common/dashboard.php';
require_once '../../php/common/feedManager.php';
$manager = new dashboard();
$allUsers = $manager->getAllUsersForTicket();
$userSocialMedias = $manager->getUserSocialMedias($_SESSION['user_id']);
$userImage = $manager->getUserImage($_SESSION['user_id']);
$feedManager=new FeedManager();
$loggedInUser=$_SESSION['user_id'];
// $feeds=$feedManager->getFeeds($loggedInUser,$_SESSION['user_role']);
$feeds=$feedManager->getFeeds(1,$_SESSION['user_role']);
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
  <!-- <script src="js/compliance/complianceManagement.js"></script> --> 
  </head>
  <style type="text/css">
    div.dataTables_wrapper div.dataTables_length label {
      font-weight: normal;
      text-align: left;
      white-space: nowrap;
      display: none;
  }
    div.dataTables_wrapper div.dataTables_filter label {
      font-weight: normal;
      white-space: nowrap;
      text-align: left;
      display: none;
  }
  .portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -11px !important;
}

.page-header-fixed .page-container {
    margin-top: 75px;
    background: #e9edf3;
}
.navbar-collapse.collapse {
    display: block!important;
    height: auto!important;
    padding-bottom: 0;
    overflow: visible!important;
    width: 232px;
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
      <div class="page-content">                                 
        <div class="row">
          <div class="col-md-12">                           
            <div class="profile-sidebar">                                
<!--               <div class="portlet light profile-sidebar-portlet bordered">                         
                <div class="profile-userpic">
                  <img src="<?php echo "uploadedFiles/auditeeFiles/" .$userImage[0]['image_name']; ?>" class="img-responsive" alt="">
                </div>                                   
                <div class="profile-usertitle">
                  <div class="profile-usertitle-name"> 
                    <?php $userRole = $_SESSION['user_role'];
                      echo $userRole;
                    ?>
                  </div>                  
                </div>                                    
                <div class="profile-userbuttons">
                  <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                  <button type="button" class="btn btn-circle red btn-sm">Message</button>
                </div>                                   
                <div class="profile-usermenu">
                  <ul class="nav">                    
                    <li>
                      <a href="view/common/companyAccountSettings.php">
                      <i class="icon-settings"></i> Account Settings </a>
                    </li>
                    <li>
                      <a href="view/common/companyLocationProfile1.php">
                      <i class="glyphicon glyphicon-home"></i> Add Location to company </a>
                    </li>
                    <li>
                      <a href="view/common/companyProfilehelp.php">
                      <i class="icon-info"></i> Help </a>
                    </li>
                    <li>
                      <a href="view/common/companyPrioritySeveritySettings.php">
                      <i class="icon-info"></i>Priority and Severity Settings </a>
                    </li>
                  </ul>
                </div>
              </div> -->
              <!-- <div class="portlet light bordered">             
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
              </div> -->                              
            </div>                           
            <div class="profile-content">
              <div class="row">                
                <div class="col-md-12">                                       
                  <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                      <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Feeds</span>
                      </div>                      
                    </div>
                    <div class="portlet-body">                                               
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1">
                          <div class="scroller" style="height: 320px;overflow: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                            <ul class="feeds">
                              <?php foreach($feeds as $feed){ ?>
                                <li>
                                  <div class="col1">                                    
                                    <div class="cont">
                                      <div class="cont-col1">
                                        <div class="label label-sm label-success">
                                          <i class="fa fa-bell-o"></i>
                                        </div>
                                      </div>
                                      <div class="cont-col2">                                        
                                        <?php if($userRole == 'policy_owner'){ ?>
                                          <div class="desc" id="feed<?php echo $auditId; ?>"> New <?php echo $feed['procedure'];?> - <?php echo $feed['title'];?> is created  by <?php echo $feed['last_name']; ?>     <?php echo $feed['name']; ?>  </div>
                                        <?php } else if($userRole == 'policy_reviewer' || $userRole == 'policy_approver') { ?>
                                          <div class="desc" id="feed<?php echo $auditId; ?>"> <?php echo $feed['title'];?> is <?php echo $feed['status'];?></div>                                          
                                        <?php } else { ?>
                                          <div class="desc" id="feed<?php echo $auditId; ?>"> New Compliance Library is created  by <?php echo $feed['last_name']; ?>     <?php echo $feed['name']; ?>  </div>
                                        <?php } ?>
                                      </div>
                                    </div>                                      
                                  </div>
                                  <div class="col2">
                                          <?php if($userRole == 'policy_owner' || $userRole == 'policy_reviewer' || $userRole == 'policy_approver') { ?>
                                            <div class="date"> <?php echo $feed['date']; ?> </div>
                                          <?php } else { ?>
                                            <div class="date"> Just now</div>
                                          <?php } ?>
                                    </div>
                                </li>
                                <?php 
                              } ?>                      
                            </ul>
                          </div>
                        </div>                        
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>                                            
            </div> 
                 
            <div class="row">
              <div class="col-md-12">
                <div class="portlet box green">
                  <div class="portlet-title"><div class="caption">Support Tickets</div></div>      
                  <div class="portlet-body">                        
                    <div class="table-scrollable table-scrollable-borderless">
                      <div class="container" style="width: 100%; margin-left: -1%;
                        margin-top: 0px;">
                        <div class="row profile col-md-12" style="margin-top: 0px;">
                          <div class="" style="width: 105%; margin-left: 0%; 
                          margin-top: 0px;"> 
                            <div class="portlet light bordered" style="width: 92%;">
                              <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                  <i class="icon-globe theme-font hide"></i>
                                </div>
                                <div class="col-md-12" style="margin-left: -2%; width: 112%;">
                                  <?php if($_SESSION['user_role']=="super_admin" || $_SESSION['user_role']=="compliance_author" || $_SESSION['user_role']=="company_admin" || $_SESSION['user_role']=="compliance_reviewer" || $_SESSION['user_role']=="grcadmin" )
                                    { 
                                    include 'supportTicketAdmin.php';
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
        </div>
      </div>           
    </div>       
    <!-- <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script> -->
    <!-- <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
    <script src="metronic/theme/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>    
    <script src="metronic/theme/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>    
    <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>      
    <script src="metronic/theme/assets/pages/scripts/profile.min.js" type="text/javascript"></script> 
    <!-- gmaps -->
    <!-- <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script src="metronic/theme/assets/pages/scripts/timeline.min.js" type="text/javascript"></script> 
    <script src="metronic/theme/assets/global/plugins/gmaps/gmaps.min.js" type="text/javascript"></script>  -->
  </body>  
</html>
