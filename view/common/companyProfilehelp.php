<?php require_once __DIR__.'/../header.php';
require_once '../../php/common/dashboard.php';
$manager = new dashboard();
// $userSocialMedias = $manager->getUserSocialMedias($_SESSION['user_id']);
$userSocialMedias = $manager->getUserSocialMedias(1);
// $userImage = $manager->getUserImage($_SESSION['user_id']);
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
                    <li class="active">
                      <a href="view/common/companyProfilehelp.php">
                      <i class="icon-info"></i> Help </a>
                    </li>
                    <li>
                      <a href="view/common/companyPrioritySeveritySettings.php">
                      <i class="icon-info"></i>Priority and Severity Settings </a>
                    </li>
                  </ul>
                </div>
              </div>                                 -->
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
              </div>  -->                             
            </div>                           
            <div class="profile-content">
              <div class="row">
                <div class="col-md-12">                     
                  <div class="portlet light bordered">
                    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
                    <HTML>
                      <HEAD>
                        <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
                        <TITLE></TITLE>
                        <META NAME="GENERATOR" CONTENT="LibreOffice 4.1.6.2 (Linux)">
                        <META NAME="AUTHOR" CONTENT="prasanna venkatesh">
                        <META NAME="CREATED" CONTENT="20180114;60600000000000">
                        <META NAME="CHANGEDBY" CONTENT="Shanmugavel Sankaran">
                        <META NAME="CHANGED" CONTENT="20180114;60600000000000">
                        <META NAME="AppVersion" CONTENT="16.0000">
                        <META NAME="DocSecurity" CONTENT="0">
                        <META NAME="HyperlinksChanged" CONTENT="false">
                        <META NAME="LinksUpToDate" CONTENT="false">
                        <META NAME="ScaleCrop" CONTENT="false">
                        <META NAME="ShareDoc" CONTENT="false">
                        <STYLE TYPE="text/css">
                        <!--
                          @page { margin: 1in }
                          P { margin-bottom: 0.08in; direction: ltr; widows: 2; orphans: 2 }
                        -->
                        </STYLE>
                      </HEAD>
                      <BODY LANG="en-IN" DIR="LTR">
                        <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt">User
                        Admin</FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><A NAME="_GoBack"></A><FONT SIZE=5 STYLE="font-size: 20pt">Users
                        can be created by clicking New button.</FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_6692baf2.png" NAME="Picture 12" ALIGN=BOTTOM WIDTH=602 HEIGHT=285 BORDER=0/></P>
                        <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US">Appropriate
                        roles can be assigned while user creation.</SPAN></FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_6c6f2206.png" NAME="Picture 16" ALIGN=BOTTOM WIDTH=601 HEIGHT=285 BORDER=0/>
                                                                                      
                        </P>

                        <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US">After
                        creation it will show up in the user list.</SPAN></FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_cf8cf1d5.png" NAME="Picture 14" ALIGN=BOTTOM WIDTH=602 HEIGHT=338 BORDER=0></P>
                        <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US">By
                        selecting the user, the admin can edit, delete user.</SPAN></FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_e4dd3be5.png" NAME="Picture 17" ALIGN=BOTTOM WIDTH=601 HEIGHT=284 BORDER=0/></P>

                        <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US">After
                        creation it will show up in the user list.</SPAN></FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_dae40814.png" NAME="Picture 18" ALIGN=BOTTOM WIDTH=601 HEIGHT=286 BORDER=0/></P>

                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_a9e7b144.png" NAME="Picture 3" ALIGN=BOTTOM WIDTH=602 HEIGHT=302 BORDER=0/></P>

                      </BODY>
                    </HTML>
                  </div>                     
                </div>                
              </div>                              
            </div>
          </div>           
        </div>
      </div>
    </div>
  </body> 
</html>
