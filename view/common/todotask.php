<?php require_once __DIR__.'/../header.php';
require_once '../../php/common/dashboard.php';
$manager = new dashboard();
$allUsers = $manager->getAllUsersForTicket();
$totalusers = count($allUsers);
$projectId = $_SESSION['user_id'];
$allProjectList = $manager->getAllProject($projectId); 
$allTaskList = $manager->getAllTask($projectId);
// echo $allUsers;
?>
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
<html>

  <head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fresh GRC Admin</title>
    <base href="/freshgrc/">
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css"/>
    <script src="js/common/taskManagement.js"></script> 
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />   
    <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" /> 
    <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />  
    <link href="metronic/theme/assets/apps/css/todo.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />    
    <link rel="shortcut icon" href="favicon.ico" />
  </head>  
  <body>
    <?php 
      include '../siteHeader.php';
      $currentMenu = 'auditDashboard';
      include '../../php/policy/left.php';
      $userRole = $_SESSION['user_role'];
    ?>     
  </body>
  <body onload="getAction()">
    <!-- <div class="page-container"> -->
      <div class="page-content-wrapper">               
        <div class="page-content" > 
          <div class="todo-container">
            <div class="row">
              <div class="col-md-12">
                <ul class="todo-projects-container" style="height:200px;width:100%; overflow-x:scroll;">
                  <li class="todo-padding-b-0">
                    <div class="todo-head">
                      <button class="btn btn-square btn-sm green todo-bold" data-toggle="modal" data-target="#todo-project-modal" onclick="showProjectModal()">Add Project</button>
                      <h3>Projects</h3>                      
                    </div>
                  </li>
                  <?php
                   for ($i=0; $i <count($allProjectList) ; $i++) { 
                    if($i == 1){
                  ?>
                  <li class="todo-projects-item todo-active" onclick="gettasklist(<?php echo $allProjectList[$i]["id"];?>)" value="<?php echo $allProjectList[$i]["id"];?>" id="projectId<?php echo $allProjectList[$i]["id"];?>">
                    <h3><?php echo $allProjectList[$i]["project_name"];?></h3>
                    <p><?php echo $allProjectList[$i]["project_description"];?></p>
                    <div class="todo-project-item-foot"></div>
                  </li>
                  <?php
                   }
                  else{
                   ?>
                    <li class="todo-projects-item" onclick="gettasklist(<?php echo $allProjectList[$i]["id"];?>)" value="<?php echo $allProjectList[$i]["id"];?>" id="projectId<?php echo $allProjectList[$i]["id"];?>">
                      <h3><?php echo $allProjectList[$i]["project_name"];?></h3>
                      <p><?php echo $allProjectList[$i]["project_description"];?></p>
                      <div class="todo-project-item-foot"></div>
                    </li>
                    <?php
                     }
                     }
                  ?>
                </ul>
              </div>
              <div id="departmentDrop">
                <div class="col-md-12">
                  <div class="todo-tasks-container" style="height:200px;width:100%;overflow-x:scroll;">
                    <div class="todo-head">
                      <button class="btn btn-square btn-sm red todo-bold" data-toggle="modal" data-target="#todo-task-modal" onclick="newTaskModal()">New Task</button>
                      <h3>
                        <span class="todo-grey">Task:</span></h3>
                      
                    </div>
                    <ul class="todo-tasks-content">
                       <?php
                       for ($i=0; $i <count($allTaskList) ; $i++) {           
                      ?>
                      <li class="todo-tasks-item">
                        <h4 class="todo-inline">
                          <a data-toggle="modal" href="#todo-task-modal" onclick="updateTask(<?php  echo $allTaskList[$i]["taskId"] ?>)"><?php echo $allTaskList[$i]["taskName"];?></a>
                        </h4>
                        <p class="todo-inline todo-float-r"><?php echo $allTaskList[$i]["userName"];?>,
                          <span class="todo-red"><?php echo $allTaskList[$i]["dueDate"];?></span>
                        </p>
                      </li> 
                      <?php           
                       }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="todo-task-modal" class="modal" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
            <div class="modal-dialog">
              <div class="todo-tasklist-devider" ></div>
              <div class="col-md-7 col-sm-8" style="background-color: white; width: 400px;margin-top: 41px;height: 200px !important;"> 
                <form action="#" class="form-horizontal">        
                  <div class="form">
                   <!--  <div class="form-group">
                      <div class="col-md-8 col-sm-8">
                        <div class="todo-taskbody-user">                  
                          <button type="button" class="todo-username-btn btn btn-circle btn-default btn-sm">&nbsp;edit&nbsp;</button>
                        </div>
                      </div>              
                    </div> -->
                    <?php echo "&nbsp";?>
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                      <input type="hidden" class="form-control" id="action">
                       <input type="hidden" class="form-control" id="taskId">
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <?php include '../common/projectDropdown.php';?>
                      </div>
                    </div>           
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="projectname">Task Name</label>
                        <input type="text" class="form-control todo-taskbody-tasktitle" id="taskname"> </div>
                    </div>          
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="projectname">Description</label>
                        <textarea class="form-control todo-taskbody-taskdesc" rows="8" id="description" style="height: 81px;"></textarea>
                      </div>
                    </div>          
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="projectname">Due Date</label>
                        <div class="input-icon">
                          
                          <i class="fa fa-calendar"></i>
                          <input type="date" class="form-control todo-taskbody-due" placeholder="Due Date..." id="duedate"> </div>
                      </div>
                    </div> 
                   <div class="form-group">
                      <div class="col-md-12">
                        <?php include '../common/usersDropdown.php';?>
                      </div>
                    </div>         
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="projectname">Status</label>
                        <select class="form-control" id="status">
                          <option value="Pending">Pending</option>
                          <option value="Completed">Completed</option>
                          <option value="Testing">Testing</option>
                          <option value="Approved">Approved</option>
                          <option value="Rejected">Rejected</option>
                        </select>
                      </div>
                    </div>
                     <div class="form-group">
                      <div class="col-md-12">
                        <!-- <input type="hidden" class="form-control todo-taskbody-tasktitle" id="action"> --></div>
                    </div> 
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="projectname">Attachment</label>
                        <input type="file" class="form-control todo-taskbody-tasktitle" id="file"> </div>
                    </div>                      
                    <div class="form-actions right todo-form-actions">
                      <button class="btn btn-circle btn-sm green" onclick="saveTask()" data-dismiss="modal">Save</button>
                      <button class="btn btn-circle btn-sm btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>       
                </form>
              </div> 
            </div>
          </div>
          <div id="todo-project-modal" class="modal" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true" align="center">
            <div class="modal-dialog">
              <div class="todo-tasklist-devider" ></div>
              <div class="col-md-7 col-sm-8" style="background-color: white; width: 297px;height: 410px;"> 
                <form action="#" class="form-horizontal">        
                  <div class="form">
                    <!-- <div class="form-group">
                      <div class="col-md-8 col-sm-8">
                        <div class="todo-taskbody-user">                  
                          <button type="button" class="todo-username-btn btn btn-circle btn-default btn-sm">&nbsp;edit&nbsp;</button>
                        </div>
                      </div>              
                    </div> -->         
                    <?php echo "&nbsp";?>          
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="projectname" style="float: left;">Project Name</label>
                        <input type="text" class="form-control todo-taskbody-tasktitle" id="project_name"> </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="projectname" style="float: left;">Project Description</label>
                        <textarea class="form-control todo-taskbody-taskdesc" rows="8" id="projectDescription" style="height: 84px;"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                       <label for="assignedto" style="float: left;">Assigned To</label>
                        <select id="assignedto1" name="assignedtoDropDown" class="form-control" multiple>
                          <option>--Select User--</option>    
                          <?php foreach($allUsers as $users){ ?>
                          <option value="<?php echo $users['id'] ?>"><?php echo htmlspecialchars($users['last_name']) ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>                                 
                    <div class="form-actions right todo-form-actions">
                      <button class="btn btn-circle btn-sm green" onclick="saveProject()" data-dismiss="modal">Save</button>
                      <button class="btn btn-circle btn-sm btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>       
                </form>
              </div> 
            </div>
          </div>
          <div id="todo-members-modal" class="modal" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">Select a Member</h4>
                </div>
                <div class="modal-body">
                  <form action="#" class="form-horizontal" role="form">
                    <div class="form-group">
                      <label class="control-label col-md-4">Selected Members</label>
                      <div class="col-md-8">
                        <select id="assignedto2" name="assignedtoDropDown" class="form-control" multiple>
                          <option>--Select User--</option>    
                          <?php foreach($allUsers as $users){ ?>
                          <option value="<?php echo $users['id'] ?>"><?php echo htmlspecialchars($users['last_name']) ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                    <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn green" data-dismiss="modal">Submit</button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="col-md-12">                                       
                  <!-- <div class="portlet light bordered" data-step="4" data-intro="This is the list of Feeds for Compliance library." style="height: 200px;width: 102%;overflow:auto;margin-left: -10px;">
                    <div class="portlet-title tabbable-line">
                      <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Feeds</span>
                      </div>                      
                    </div>
                    <div class="portlet-body" style=" height:200px;">                                               
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1">
                          <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
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
                  </div>  -->
                   <div class="col-md-12">                      
                  <div class="portlet light bordered" data-step="5" data-intro="Logs of user logins" style="height: 200px;width: 105%;overflow-y:scroll;margin-left: -25px;">
                    <div class="portlet-title">
                      <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">User Logs</span>
                        
                      </div>                      
                    </div>
                    <div class="portlet-body">
                      <div class="scroller"  data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
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
                </div>
              </div>
        </div>
      </div>
       
<script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
  </body> 
</html>

