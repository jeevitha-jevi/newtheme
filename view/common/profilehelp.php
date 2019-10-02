<?php require_once __DIR__.'/../header.php';
require_once '../../php/common/dashboard.php';
$manager = new dashboard();
// $userSocialMedias = $manager->getUserSocialMedias($_SESSION['user_id']);
$userSocialMedias = $manager->getUserSocialMedias(1);
// $userImage = $manager->getUserImage($_SESSION['user_id']);
$userImage = $manager->getUserImage(1);
$usermail = $manager->mail($_SESSION['user_id']);

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
              <div class="portlet light profile-sidebar-portlet bordered" style="height: 350px;">                                    
                <div class="profile-userpic">
                  <a href="view/common/overview.php"><img src="<?php echo "uploadedFiles/auditeeFiles/" .$userImage[0]['image_name']; ?>" class="img-responsive" alt=""></a> 
                </div>                                   
                <div class="profile-usertitle">
                  <div class="profile-usertitle-name" style="color: #2871A3"> 
                    <?php $userRole = $_SESSION['user_role'];
                      echo $userRole;
                     ?>
                  </div>                  
                </div>                                    
                <div class="profile-userbuttons">
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
                 </div>                                
              <div class="portlet light bordered">             
                <div class="row list-separated profile-stat">
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <!-- <div class="uppercase profile-stat-title" id="totalprojects"></div> -->
                     <div class="uppercase profile-stat-title" id="totaladminprojects" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><span class="font-red"> Projects</span> </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <!-- <div class="uppercase profile-stat-title" id="totaltasks"></div> -->
                     <div class="uppercase profile-stat-title" id="totaladmintasks" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><span class="font-red"> Tasks</span></div>
                  </div>
                 <!--  <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totaluploads"></div>
                    <div class="uppercase profile-stat-text"> Uploads </div>
                  </div> -->
                </div>          
                <div>                  
                  <div class="margin-top-20 profile-desc-link">
                    <i class="fa fa-globe" style="color: #ffffff; background-color: #009195;border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;"></i>
                    <a><?php echo $userSocialMedias[0]['site'];?></a>
                  </div>
                  <div class="margin-top-20 profile-desc-link">
                    <i class="fa fa-twitter" style="color: #ffffff; background-color: #00A1ED;border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;"></i>
                    <a><?php echo $userSocialMedias[0]['twitter'];?></a>
                  </div>
                  <div class="margin-top-20 profile-desc-link">
                    <i class="fa fa-facebook" style="color: #ffffff; background-color: #335B94;border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;"></i>
                    <a><?php echo $userSocialMedias[0]['facebook'];?></a>
                  </div>
                </div>
              </div>                              
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
                        <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"></FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><A NAME="_GoBack"></A><FONT SIZE=5 STYLE="font-size: 20pt"><b style="font-family: Verdana;font-size: 20px !important;">Super Admin:</b><br>
                          <ul>
<li style="font-family: Verdana;font-size: 17px !important;">The Super Admin module is helpful for the User Management.</li>
<li style="font-family: Verdana;font-size: 17px !important;">The top portion shows the TimeLine feature, User feeds and the overall tasks assigned for the users as well the user logs.</li>
</ul>
</FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/superadmin1.png" NAME="Picture 12" ALIGN=BOTTOM WIDTH=602 HEIGHT=285 BORDER=0/></P>
                        <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><b style="font-family: Verdana;font-size: 20px !important;">Account Settings</b>
                          <ul>
<li style="font-family: Verdana;font-size: 17px !important;">The account setting tab is used to set the profile for the super admin/Company</li>
<li style="font-family: Verdana;font-size: 17px !important;">There are two tabs personal info and change image.</li>
<li style="font-family: Verdana;font-size: 17px !important;">Change image tab is used to change the avatars.</li></ul></SPAN></FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/account11.png" NAME="Picture 16" ALIGN=BOTTOM WIDTH=601 HEIGHT=285 BORDER=0/>
                                                                                      
                        </P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/account22.png" NAME="Picture 16" ALIGN=BOTTOM WIDTH=601 HEIGHT=285 BORDER=0/>
                                                                                      
                        </P>

                        <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><b style="font-family: Verdana;font-size: 20px !important;">Help:</b><br>
<ul>
  <li style="font-family: Verdana;font-size: 17px !important;">Help gives the user basic idea of the FreshGRC app.</li>
</ul></SPAN></FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/help1.png" NAME="Picture 14" ALIGN=BOTTOM WIDTH=602 HEIGHT=338 BORDER=0></P>
                        <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><b style="font-family: Verdana;font-size: 20px !important;">User Management:</b><br>
<ul>
  <li style="font-family: Verdana;font-size: 17px !important;">Click Add Users in LeftMenu, you can view the User Management table.</li>
<li style="font-family: Verdana;font-size: 17px !important;">New</li>
<li style="font-family: Verdana;font-size: 17px !important;">Edit and</li> 
<li style="font-family: Verdana;font-size: 17px !important;">Delete</li></ul></SPAN></FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/usermanage.png" NAME="Picture 17" ALIGN=BOTTOM WIDTH=601 HEIGHT=284 BORDER=0/></P>

                        <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><b style="font-family: Verdana;font-size: 20px !important;">New:</b><br>

<ul>
  <li style="font-family: Verdana;font-size: 17px !important;">The New tab is used to create a new user.</li>
<li style="font-family: Verdana;font-size: 17px !important;"style="font-family: Verdana;font-size: 17px !important;">The following details needs to be given to create a new user.</li>
<li style="font-family: Verdana;font-size: 17px !important;">First name and last name of the user</li>
<li style="font-family: Verdana;font-size: 17px !important;">Email Address</li>
<li style="font-family: Verdana;font-size: 17px !important;" style="font-family: Verdana;font-size: 17px !important;">Role of the particular user like Auditor/Auditee etc.,</li>
<li style="font-family: Verdana;font-size: 17px !important;">Similarly Edit and delete tabs used to edit and delete the users which are created.</li></ul></SPAN></FONT></P>
                        <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/new.png" NAME="Picture 18" ALIGN=BOTTOM WIDTH=601 HEIGHT=286 BORDER=0/></P>

                       <!--  <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_a9e7b144.png" NAME="Picture 3" ALIGN=BOTTOM WIDTH=602 HEIGHT=302 BORDER=0/></P> -->

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