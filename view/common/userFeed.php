<?php require_once __DIR__.'/../header.php';
require_once '../../php/common/dashboard.php';
require_once '../../php/common/feedManager.php';
$manager = new dashboard();
$allUsers = $manager->getAllUsersForTicket();
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
<html>
<script type="text/javascript">
  
</script>

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
    <!-- <script src="js/common/userProfile.js"></script> -->
    <!-- <script type="text/javascript" src="js/common/feedManagement.js"></script> -->


    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">



    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css">



      <meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  
       
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 



    <style>
        #viewdata {
          margin-left: 320px;
          margin-top: -60px;
          margin-right: 135px;
          margin-bottom: 40px;
        }
        #viewdata1 {
          margin-left: 320px;
          margin-top: -60px;
          margin-right: 135px;
          margin-bottom: 40px;
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
        label{
        font-weight: 600;
        }
        body{
          font-size: 14px;
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
        .label{
          font-size: bold;
        }
        .panel-heading{
          background-color: #32c5d2; color:#fff;
          width: 1150px;margin-left: -20px;margin-top: -21px;font-weight: 600
        }
        
        .split{
          width: 300px;padding-right: 15px
        }
        .split1{
          width: 290px;padding-left: 15px;padding-right: 15px
        }
        .split2{
          margin-left: 295px;margin-top: -69px;width: 290px;
        }


          .nav-tabs>li {
    float: left;
    margin-bottom: -1px;
    border:none;
}

element.style {
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #555;
    cursor: default;
    background-color: #fff;
    /* border: 1px solid #ddd; */
    /* border-bottom-color: transparent; */
}
        
    </style>
</head>


<body class="with-side-menu-compact" >

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
        include '../common/leftMenu.php';

        
        $userRole = $_SESSION['user_role'];
    ?>
    <?php if($_SESSION['user_role'] == 'auditor') {?>
    
    <?php }?>

</body>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br>

  
<body class="dataTables">
       
                   
</body>

</html>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://keenthemes.com/preview/metronic/theme/assets/global/css/components-md.min.css"> -->
<script src="js/common/userProfile.js"></script>
<style type="text/css">
    body {
  background: #F1F3FA;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
}

/* Profile container */
.profile {
  margin: 20px 0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
  width: 250px;
  height: 360px;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 50%;
  height: 50%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;

}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: 460px;
}
.container {
    width: 1500px;
    margin-left: 285px;
}
img{

    vertical-align: middle;
}
</style>
<body>

<div class="container" style="    width: 100%;
    margin-left: 18%;
    margin-top: -16%;">
    <div class="row profile col-md-12" style="margin-top: 7%;">
        <div >
          <div class="profile-sidebar" style="padding: 20px 0 10px 0;
          background: #fff;
          width: 280px;
          height: 426px;
          margin-left: -10px;">
          <!-- SIDEBAR USERPIC -->
            <!-- <div class="profile-userpic" style="    height: 115px;"> -->
                        <!--  <img alt="your image" style="    width: 125px;
            height: 125px;
            border-radius: 50% !important;
            margin-left: 80px;" src="https://media.licdn.com/mpr/mpr/shrinknp_200_200/AAMAAQDGAAwAAQAAAAAAAAnzAAAAJGJkMjU4YzQ5LWE3MDAtNGRjYS05M2RjLTA1YWEyM2Y3NDAyZA.jpg"> -->

            <!-- </div> -->
          <!-- END SIDEBAR USERPIC -->
          <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
              <div class="profile-usertitle-name">
                <?php echo $_SESSION['user_name'] ?>
              </div>
             <!--  <div class="profile-usertitle-job">
                Chief Executive Officer
              </div> -->
            </div>
          <!-- END SIDEBAR USER TITLE -->
          <!-- SIDEBAR BUTTONS -->
            <!-- <div class="profile-userbuttons" style="text-align: center; -->
            <!-- margin-top: 10px;"> -->
             <!--  <button type="button" class="btn btn-success btn-sm" style="border-radius: 15px !important;color: #FFF;
              background-color: #32c5d2;
              border-color: #32c5d2;">Follow</button>
              <button type="button" class="btn btn-danger btn-sm" style="border-radius: 15px !important;background-color: #e75059;
              border-color: #e7505a;">Message</button> -->
            <!-- </div> -->
          <!-- END SIDEBAR BUTTONS -->
          <!-- SIDEBAR MENU -->
            <div class="profile-usermenu" style="    margin-top: 10px;
            padding-left: 20px;
            padding-right: 20px;">
            <div class="profile-userpic">
                    <img id="userprofilepicture" class="img-responsive" alt="Profile Pic"> </div>
              <ul class="nav">
                <?php if($_SESSION['user_role']=="super_admin"){ ?>
                <li>
                  <a href="view/common/userProfile.php">
                  <i class="glyphicon glyphicon-home"></i>
                  Overview </a>
                </li>
                <?php }?>
                <li >
                  <a href="view/common/profilesetting.php" >
                  <i class="glyphicon glyphicon-user"></i>
                  Account Settings </a>
                </li>
                <li>    <div id="google_translate_element"></div></li>
                <li class="active">
                  <a href="view/common/userFeed.php">
                  <i class="glyphicon glyphicon-flag"></i>
                  Feeds </a>
                </li>
                <li>
                  <a data-toggle="modal" data-target="#help-modal">
                  <i class="glyphicon glyphicon-flag"></i>
                  Help </a>
                </li>

              </ul>
            </div>
          <!-- END MENU -->
          </div>
        </div>
<!-- <div class="col-md-6" style="width: 38%;"> -->
<!-- BEGIN PORTLET -->

<!-- END PORTLET -->
<!-- </div> -->
<div class="" style="width: 81%;
    margin-left: 22%;
    margin-top: -427px;
    height: 426px;">
<!-- BEGIN PORTLET -->
<div class="portlet light bordered" style="margin-left: 7%;
    width: 100%;
    height: 426px;">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase">Feeds
            </span>
        </div>
        <ul class="nav nav-tabs">
           <!--  <li class="active">
                <a href="#tab_1_1" data-toggle="tab"> System </a>
            </li> -->
            <!-- <li>
                <a href="#tab_1_2" data-toggle="tab"> Activities </a>
            </li> -->
        </ul>

    <div class="row profile" style="margin-top:70px;">
    
    <div class="portlet-body">
        <!--BEGIN TABS-->
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 320px;"><div class="scroller" style="height: 320px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-initialized="1">
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
                                      
                                        <div class="desc" id="feed<?php echo $auditId ?>"> New Audit is assigned for <?php echo $feed['last_name'] ?>     <?php echo $feed['title'] ?> 
                                            <span class="label label-sm label-info">
                                                <a  <?php if($feed['status']=="create") {?> href="view/audit/auditDoPage.php?auditId=<?php echo $feed['id'] ?>" <?php }?>  <?php if($feed['status']=="prepared") {?> href="view/audit/auditeeDoPage?auditId=<?php echo $feed['id'] ?>" <?php }?> <?php if($feed['status']=="performed") {?> href="view/audit/auditCheckPage.php?auditId=<?php echo $feed['id'] ?>" <?php }?> <?php if($feed['status']=="returned") {?> href="view/audit/auditActPage.php?auditId=<?php echo $feed['id'] ?>" <?php }?>> Take action</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col2">
                                <div class="date"> Just now </div>
                            </div>
                        </li>

                        <?php } ?>
                        
                        
                        
                        
                    </ul>
                </div><div class="slimScrollBar" style="background: rgb(215, 220, 226); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 120.329px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
            </div>
            <div class="tab-pane" id="tab_1_2">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 337px;"><div class="scroller" style="height: 337px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-initialized="1">
                    <ul class="feeds">
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> New user registered </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> Just now </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> New order received </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> 10 mins </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-danger">
                                            <i class="fa fa-bolt"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> Order #24DOP4 has been rejected.
                                            <span class="label label-sm label-danger "> Take action
                                                <i class="fa fa-share"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 24 mins </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> New user registered </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> Just now </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> New user registered </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> Just now </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> New user registered </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> Just now </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> New user registered </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> Just now </div>
                                </div>
                            </a>
                        </li>
                        
                        
                        
                    </ul>
                </div><div class="slimScrollBar" style="background: rgb(215, 220, 226); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
            </div>
        </div>
        <!--END TABS-->
    </div>
</div>
<!-- END PORTLET -->
</div>
</div>

  <!-- <div class="row col-md-12"> -->
   
  </div>


<!-- ///////////////////////////////////// -->

<div class="col-md-12" style="margin-top: 43%;
    margin-left: -2%;
    width: 112%;">

  </div>
</div>
</div>
<div id="help-modal" class="modal" data-dismiss="modal" style="width: 900px; height: 800px; margin-left: 350px; margin-top: 80px;">
<div class="row col-md-12" style=" background-color: white; padding-left: 100px;" >
  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: 20px; position: fixed; margin-left: 756px;"><span aria-hidden="true">&times;</span></button>
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
<P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><B>User
Admin</B></FONT></P>
<P STYLE="margin-bottom: 0.11in"><A NAME="_GoBack"></A><FONT SIZE=5 STYLE="font-size: 20pt"><B>Users
can be created by clicking New button.</B></FONT></P>
<P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_6692baf2.png" NAME="Picture 12" ALIGN=BOTTOM WIDTH=602 HEIGHT=285 BORDER=0></P>
<P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><B>Appropriate
roles can be assigned while user creation.</B></SPAN></FONT></P>
<P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_6c6f2206.png" NAME="Picture 16" ALIGN=BOTTOM WIDTH=601 HEIGHT=285 BORDER=0>
                                                              
</P>

<P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><B>After
creation it will show up in the user list.</B></SPAN></FONT></P>
<P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_cf8cf1d5.png" NAME="Picture 14" ALIGN=BOTTOM WIDTH=602 HEIGHT=338 BORDER=0></P>
<P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><B>By
selecting the user, the admin can edit, delete user.</B></SPAN></FONT></P>
<P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_e4dd3be5.png" NAME="Picture 17" ALIGN=BOTTOM WIDTH=601 HEIGHT=284 BORDER=0></P>

<P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><B>After
creation it will show up in the user list.</B></SPAN></FONT></P>
<P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_dae40814.png" NAME="Picture 18" ALIGN=BOTTOM WIDTH=601 HEIGHT=286 BORDER=0></P>

<P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_a9e7b144.png" NAME="Picture 3" ALIGN=BOTTOM WIDTH=602 HEIGHT=302 BORDER=0></P>

</BODY>
</HTML>
</div>
</div>












</body>
</html>