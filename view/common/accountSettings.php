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
  <title>Account Setting</title>
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
      // include '../common/leftMenu.php';
      include '../../php/policy/left.php';
      $currentMenu = 'auditorAdmin';      
      $userRole = $_SESSION['user_role'];
      $userid = $_SESSION['user_id'];
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
                <!-- <div class="profile-usermenu">
                 
                </div> -->
              </div>                                
              <div class="portlet light bordered" style="height: 315px;">             
                <div class="row list-separated profile-stat">
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <!-- <div class="uppercase profile-stat-title" id="totalprojects"></div> -->
                    <div class="uppercase profile-stat-title" id="totaladminprojects" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"><span class="font-red"> Projects</span> </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                    <!-- <div class="uppercase profile-stat-title" id="totaltasks"></div> -->
                    <div class="uppercase profile-stat-title" id="totaladmintasks" style="color: #44B6AD;"></div>
                    <div class="uppercase profile-stat-text"> <span class="font-red"> Tasks</span> </div>
                  </div>
                  <!-- <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="totaluploads"></div>
                    <div class="uppercase profile-stat-text"> Uploads </div>
                  </div> -->
                </div>          
                <div>                  
                  <div class="margin-top-20 profile-desc-link">
                    <i class="fa fa-globe" style="color: #ffffff; background-color: #009195;border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;"></i>
                    <a  href="https://www.google.com"><?php echo $userSocialMedias[0]['site'];?></a>
                  </div>
                  <div class="margin-top-20 profile-desc-link">
                    <i class="fa fa-twitter" style="color: #ffffff; background-color: #00A1ED;border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;"></i>
                    <a  href="https://twitter.com"><?php echo $userSocialMedias[0]['twitter'];?></a>
                  </div>
                  <div class="margin-top-20 profile-desc-link">
                    <i class="fa fa-facebook" style="color: #ffffff; background-color: #335B94;border-radius: 50%;padding: 0.3em;height: 1.5em; width: 1.5em;"></i>
                    <a href="https://www.facebook.com"><?php echo $userSocialMedias[0]['facebook'];?></a>
                  </div>
                </div>
              </div>                               
            </div> 
            <div style="margin-left:370px;width:100%;">                      
            <div class="profile-content">
              <div class="row">
                <div class="col-md-8">                     
                  <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                      <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject bold uppercase" style="color: #2871A3">Profile Account</span>
                      </div>
                      <ul class="nav nav-tabs">
                        <li class="active">
                          <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                        </li>
                        <li>
                          <a href="#tab_1_2" data-toggle="tab">Change Image</a>
                        </li>
                        <!-- <li>
                          <a href="#tab_1_3" data-toggle="tab">Edit Profile</a>
                        </li> -->
                        <!-- <li>
                          <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                        </li>  -->                                                   
                      </ul>
                    </div>
                    <div class="portlet-body" style="height:600px;">
                      <div class="tab-content">                         
                        <div class="tab-pane active" id="tab_1_1">
                          <form role="form" action="#">
                            <div class="form-group">
                              <input type="hidden" class="form-control" id="loggedInUser" value=<?php echo $userid;?>>                                        
                            </div>
                            <div style="width: 98%;">
                            <div class="form-group">
                              <label for="firstname">First Name</label>
                              <input type="text"  class="form-control" id="firstname"/> </div><br>
                            <div class="form-group">
                              <label for="lastname">Last Name</label>
                              <input type="text" class="form-control" id="lastname"/> </div><br>
                            <div class="form-group">
                              <label for="mobileno">Mobile Number</label>
                              <input type="text" class="form-control" id="mobileno"/> </div><br>
                            <div class="form-group">
                              <label for="websiteurl">Website</label>
                              <input type="text"  class="form-control" id="site"/> </div><br>
                            <div class="form-group">
                              <label for="occupation">Industry</label>
                              <input type="text" class="form-control" id="industry"/> </div><br>
                            <div class="form-group">
                              <label for="interest">Facebook</label>
                              <input type="text" class="form-control" id="facebook"></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                              <label for="about">Twitter</label>
                              <input type="text"  class="form-control" id="twitter"/> </div><br><br>
                            <div class="margiv-top-10">
                              <a href="javascript:;" style="border: 1px solid #48D1CC;" class="btn green" onclick="saveUserProfileChanges()"> Save Changes </a>
                             
                            </div>
                            </div>
                          </form>
                        </div>

                        <div id="savedDataModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Data Saved Sucessfully!</h4>
                              </div>
                              <div class="modal-body">
                                <b>First Name:</b><p></p>
                                <b>Last Name:</b><p></p>
                                <b>Mobile Number:</b><p></p>
                                <b>Website:</b><p></p>
                                <b>Industry:</b><p></p>
                                <b>Facebook:</b><p></p>
                                <b>Twitter:</b><p></p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="reloadPage()">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>

                        <div class="tab-pane" id="tab_1_2">                          
                          <form action="#" role="form">
                            <div class="form-group">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="assets/img/avatar-sign.png" alt="avatar" id="userprofilepicture" style="width: 150px;height: 150px; border-radius: 50% !important;" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div> 
                                <input type="file" id="upload" name="file" accept="image/*">                      
                                  <input type="hidden" id="userFileName" value="<?php echo $userImage[0]['image_name']; ?>">                                  
                                </div>
                              </div>
                              <div class="margin-top-10">                                
                                <button type="button" class="btn green" id="manageButton" onclick="saveUserProfilePicture()">Save Changes</button>    
                              </div>
                              <div class="clearfix margin-top-10">
                                <span class="label label-danger">NOTE! </span>
                                <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                              </div>
                            </div>                            
                          </form>
                        </div>                           
<!--                         <div class="tab-pane" id="tab_1_3">
                          <form action="#">
                            <table id="modaldetails" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:750px;">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th> 
                    <th>Mobile Number</th>                       
                    <th>Website</th>
                    <th>Industry</th>
                    <th>Action</th>                        
                </tr>
            </thead>
            <tbody>
              <?php
              require_once '../../php/user/userManager.php';
              $compliancereviewer = new UserManager;
 $compliancereviewerprofile = $compliancereviewer->getAllUserDetailsForProfile($_SESSION['user_id']);
?>
      <tr>
        <td><?php echo $compliancereviewerprofile['0']["firstName"];?></td>
        <td><?php echo $compliancereviewerprofile['0']["lastName"];?></td>
        <td><?php echo $compliancereviewerprofile['0']["MobileNumber"];?></td>
        <td><?php echo $compliancereviewerprofile['0']["Site"];?></td>
        <td><?php echo $compliancereviewerprofile['0']["Industry"];?></td>
        <td data-toggle="modal" data-target="#myeditprofile" class="edit_data"><i style="font-size:24px" class="fa">&#xf14b;</i></td>
      </tr>
    </tbody>
        </table>
                          </form>
                              <div class="modal fade" id="myeditprofile" role="dialog">
    <div class="modal-dialog">
    
      <! Modal content-->
      <!-- <div class="modal-content">
        <div class="modal-header" style="background-color:#00C4D0;color:white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Profile</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
                              <label for="firstname">First Name</label>
                              <input type="text"  class="form-control" id="fname" name="fname"> </div><br>
                              <input type="hidden" id="upid" name="upid" >
                            <div class="form-group">
                              <label for="lastname">Last Name</label>
                              <input type="text" class="form-control" id="lname" name="lname"> </div><br>
                            <div class="form-group"> 
                              <label for="mobileno">Mobile Number</label>
                              <input type="text" class="form-control" id="mno" name="mno"> </div><br>
                            <div class="form-group">
                              <label for="websiteurl">Website</label>
                              <input type="text"  class="form-control" id="website" name="website"> </div><br>
                            <div class="form-group">
                              <label for="occupation">Industry</label>
                              <input type="text" class="form-control" id="it" name="it"> </div><br>
                            <div class="form-group">
                              <label for="interest">Facebook</label>
                              <input type="text" class="form-control" id="fb" name="fb"><br>
                            </div>
                            <div class="form-group">
                              <label for="about">Twitter</label>
                              <input type="text"  class="form-control" id="twitt" name="twitt"> </div><br><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary update">Update</button>
        </div>
      </div>
      
    </div>
  </div> 
                        </div>  -->                        
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
