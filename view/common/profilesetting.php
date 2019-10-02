<?php require_once __DIR__.'/../header.php';?>
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
    <script src="js/common/userProfile.js"></script>


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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 

<style>
    #viewdata {
      margin-left: 235px;
      margin-top: 100px;
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
    .modal-content{
      border-radius: 0px;
      border: none;
      width: 600px;
    }
    .modal-header{
      background-color: #3bc5d2;height: 60px;
                color: #fff;
    }
    .split{
      width: 300px;padding-right: 15px
    }
    .split1{
      width: 290px;padding-left: 15px;padding-right: 15px
    }
    .split2{
      /*margin-left: 295px;margin-top: -69px;width: 290px;*/
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
  <body class="dataTables" >
  </body>
</html>



<!DOCTYPE html>
<html>
  <head>
      <title></title>
  </head>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://keenthemes.com/preview/metronic/theme/assets/global/css/components-md.min.css"> -->
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
    <div class="container" style="width: 1500px; margin-left: 285px; margin-top: -245px;">
      <div class="row" style="margin-top: 80px;">
        <div class="col-md-3 " style="">
          <div class="profile-sidebar" style="padding: 20px 0 10px 0;background: #fff;width: 280px;
          height: 426px;margin-left: -10px;">     
            <div class="profile-usermenu" style="margin-top: 30px;padding-left: 20px;padding-right: 20px;">
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
                <li class="active">
                  <a href="view/common/profilesetting.php" >
                  <i class="glyphicon glyphicon-user"></i>
                  Account Settings </a>
                </li>
                <li >
                  <a href="view/common/userFeed.php">
                  <i class="glyphicon glyphicon-flag"></i>
                  Feeds </a>

                </li> 
                 <li>
                  <a data-toggle="modal" data-target="#help-modal">
                  <i class="glyphicon glyphicon-flag"></i>
                  Help </a>
                </li>             
                <!-- <li>
                  <a data-toggle="modal" data-target="#help-modal">
                  <i class="glyphicon glyphicon-flag"></i>
                  Help </a>
                </li> -->
              </ul>
            </div>
            <!-- END MENU -->

          </div>
        </div>
        <div  style="width: 910px;margin-left: 300px;margin-bottom: 30px;background-color: #fff;padding: 5px; max-width: 1550px;height: 425px;" >  
          <ul class="nav nav-tabs" style="margin-bottom: 10px;margin-top: 15px;margin-left: 15px;margin-right: 15px;">  
            <li  style="border:none;" class="active"><a data-toggle="tab" href="#home">Profile Setting</a></li>  
            <li><a data-toggle="tab" href="#menu1">Change Photo</a></li>
          </ul> 
          <div class="tab-content" style="margin-top: -365px;">  
            <div id="home" class="tab-pane fade in active">  
              <!-- <p>  -->
              <div class="col-md-12" style="margin: none;">
                <form id="form1">
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">                                        
                  </div>
                  <div class="form-group col-md-4">
                    <label for="firstname">First name</label>
                    <input type="text" class="form-control" id="firstname">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="lastname">Last name</label>
                    <input type="text" class="form-control" id="lastname">
                  </div>              
                  <div class="form-group col-md-4">
                    <label for="mobileno">Mobile Number</label>
                    <input type="text" class="form-control" id="mobileno">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="websiteurl">Site</label>
                    <input type="text" class="form-control" id="site">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="occupation">Industry</label>
                    <input type="text" class="form-control" id="industry">
                  </div> 
                  <div class="form-group col-md-6">
                    <label for="interest">Facebook</label>
                    <input type="text" class="form-control" id="facebook">
                  </div>            
                  <div class="form-group col-md-6">
                    <label for="about">Twitter</label>
                    <input type="text" class="form-control" id="twitter">
                  </div>                                                                             
                </form>         
              </div>
              <div class="modal-footer">                      
                <button type="button" id="manageButton" onclick="saveUserProfileChanges()" data-dismiss="modal" class="btn btn-primary" style="background-color:#4285f4">Save Changes</button>
              </div>
            </div>
            <div id="menu1" class="tab-pane fade ">  
              <!-- <p>  -->
              <div class="col-md-12" style="margin: none;">
                <div class="wrap" style="margin-top: -50px;">
                  <h1>Change your avatar</h1>
                  <div class="profile">
                    <div class="profile__options">
                      <label for="upload" onkeydown="handleAriaUpload(event, this)" id="upload_label" title="Upload New File" tabindex="2" class="aria-upload">upload new
                      </label>               
                    </div>
                    <div class="avatar" id="avatar" style="border-radius: 50% !important;" >
                      <div id="preview">
                      <img src="assets/img/avatar-sign.png" alt="avatar" id="userprofilepicture" style="width: 150px;height: 150px; border-radius: 50% !important;"  />
                      </div>
                      <div class="avatar_upload" >
                        <label class="upload_label">Upload
                          <input type="file" id="upload" name="file" accept="image/*">                 
                        </label>
                        <input type="hidden" id="userFileName">
                      </div>
                    </div>
                    <div class="nickname">
                      <span id="name" tabindex="4" data-key="1" contenteditable="true" onkeyup="changeAvatarName(event, this.dataset.key, this.textContent)" onblur="changeAvatarName('blur', this.dataset.key, this.textContent)">
                      </span>
                    </div>
                  </div>
                  <div class="">                      
                    <button type="button" id="manageButton"   data-dismiss="modal" class="btn btn-primary" style="background-color:#4285f4" onclick="saveUserProfilePicture()">Save Changes</button>
                  </div>
                </div>     
              </div>
            </div>
            <div id="menu2" class="tab-pane fade ">  
              <div class="col-md-12" style="margin: none;">            
                <form action="#">
                  <div class="form-group">
                    <label class="control-label">Current Password</label>
                    <input type="password" class="form-control" /> </div>
                  <div class="form-group">
                    <label class="control-label">New Password</label>
                    <input type="password" class="form-control" /> </div>
                  <div class="form-group">
                    <label class="control-label">Re-type New Password</label>
                    <input type="password" class="form-control" /> </div>
                  <div class="margin-top-10">
                    <a href="javascript:;" class="btn green"> Change Password </a>
                    <a href="javascript:;" class="btn default"> Cancel </a>
                  </div>
                </form>          
              </div>
            </div>  
          </div> 
        </div>  
      </div>
    </div>
    <div id="help-modal" class="modal" data-dismiss="modal" style="width: 900px; height: 800px; margin-left: 350px; margin-top: 80px;">
      <div class="row col-md-12" style=" background-color: white; padding-left: 100px;" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: 20px; position: fixed; margin-left: 756px;"><span aria-hidden="true">&times; </span></button>
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
            <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_6692baf2.png" NAME="Picture 12" ALIGN=BOTTOM WIDTH=602 HEIGHT=285 BORDER=0/></P>
            <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><B>Appropriate
            roles can be assigned while user creation.</B></SPAN></FONT></P>
            <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_6c6f2206.png" NAME="Picture 16" ALIGN=BOTTOM WIDTH=601 HEIGHT=285 BORDER=0/>
                                                                          
            </P>

            <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><B>After
            creation it will show up in the user list.</B></SPAN></FONT></P>
            <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_cf8cf1d5.png" NAME="Picture 14" ALIGN=BOTTOM WIDTH=602 HEIGHT=338 BORDER=0></P>
            <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><B>By
            selecting the user, the admin can edit, delete user.</B></SPAN></FONT></P>
            <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_e4dd3be5.png" NAME="Picture 17" ALIGN=BOTTOM WIDTH=601 HEIGHT=284 BORDER=0/></P>

            <P STYLE="margin-bottom: 0.11in"><FONT SIZE=5 STYLE="font-size: 20pt"><SPAN LANG="en-US"><B>After
            creation it will show up in the user list.</B></SPAN></FONT></P>
            <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_dae40814.png" NAME="Picture 18" ALIGN=BOTTOM WIDTH=601 HEIGHT=286 BORDER=0/></P>

            <P STYLE="margin-bottom: 0.11in"><IMG SRC="view/common/user_admin/user_admin_html_a9e7b144.png" NAME="Picture 3" ALIGN=BOTTOM WIDTH=602 HEIGHT=302 BORDER=0/></P>

          </BODY>
        </HTML>
      </div>
    </div>
  </body>
</html>
<style type="text/css">
.wrap{
  width: 100%;
  text-align: center;
}
.wrap h1{
  color: #fff;
}
.profile{
    margin-bottom: 30px;
    margin-left: 32%;
    width: 95%;
    max-width: 350px;
  background: #ecf0f2;
  border-radius: 10px;
  padding: 15px 10px 30px 10px;
  position: relative;
/*   border: 1px solid #ccc; */
  box-shadow: 0px 1px 7px rgba(2,2,2,0.2);
}
.profile__options{
  display: flex;
  flex-wrap: nowrap;
  width: 90%;
  margin: auto;
  justify-content: space-between;
  padding-bottom: 10px;
  color: #666;
}
.upload-btn{
  font-size:13px;
  text-transform: uppercase;
  color: #888;
}
#upload_label{
  cursor: pointer;
  position: absolute;
  left: 15px;
  top: 12px;
  font-size: 14px;
}
#upload_label:hover, #upload_label:focus{
  color: #222;
}
.last-btn, .next-btn{
  top: 110px;
  position: relative;
  font-size: 22px;
}
.btn{
  cursor: pointer;
}
.btn:focus,.btn:hover{
  color:rgba(44,105, 1  51, 1);
}
.avatar{
  width: 150px;
  height: 150px;
  border-radius: 100%;
  border: 2px solid #fff;
  margin: 10px auto;
  position: relative;
  overflow: hidden;
  z-index: 2;
  transform: translateZ(0);
  transition: border-color 200ms;
}
.avatar--upload-error{
  border-color: #F73C3C;
  animation: shakeNo 300ms 1 forwards;
}
@keyframes shakeNo{
  20%, 60%{
    transform: translateX(6px);
  }
  40%, 80%{
    transform: translate(-6px);
  }
}
.avatar:hover .avatar_upload, .avatar--hover .avatar_upload{
  opacity: 1;
}
.avatar:hover .upload_label, .avatar--hover .upload_label{
  display: block;
}
#preview::after{
  /*content: 'Loading...';*/
  /*display: block;*/
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  text-align: center;
  z-index: -1;
  line-height: 150px;
  color: #999;
}
.avatar_img--loading{
  opacity: 0;
}
.avatar_img{
  width: 100%;
  height: auto;
  animation: inPop 250ms 150ms 1 forwards cubic-bezier(0.175, 0.885, 0.32, 1.175);
  transform: scale(0);
  opacity: 0;
}
@keyframes inPop {
  100%{
    transform: scale(1);
    opacity: 1;
  }
}
.avatar_img--rotate90{
  transform: rotate(90deg);
}
.avatar_upload{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  text-align: center;
  height: 100%;
  background: #25cfe3;
  background: rgba(44,205, 251, 0.6);
  display: flex;
  align-items: center;
  opacity: 0;
  transition: opacity 500ms;
}
.upload_label{
  color: #111;
  text-transform: uppercase;
  font-size: 14px;
  cursor: pointer;
  white-space: nowrap;
  padding: 4px;
  border-radius: 3px;
  min-width: 60px;
  width: 100%;
  max-width: 80px;
  margin: auto;
  font-weight: 400;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  background: #fff;
  animation: popDown 300ms 1 forwards;
  transform: translateY(-10px);
  opacity: 0;
  display: none;
  transition: background 200ms, color 200ms;
}
@keyframes popDown{
  100%{
    transform: translateY(0);
    opacity: 1;
  }
}
.upload_label:hover{
  color: #fff;
  background: #222;
}
#upload{
  width: 100%;
  opacity: 0;
  height: 0;
  overflow: hidden;
  display: block;
  padding: 0;
  text-align: center;
}
.nickname{
  text-align: center;
  font-weight: 400;
  font-size: 20px;
  color: #666;
  position: relative;
}
#name:hover{
  outline: lightblue auto 5px;
  outline: -webkit-focus-ring-color auto 5px;
  
}
  </style>
