<?php
require_once __DIR__.'/policymanagers.php';
$companyId=$_SESSION['company'];
// echo $companyId;
$getmoduledata=new policymanagers();
$moduleData=$getmoduledata->getmodule(7);
// print_r($moduleData);
$root=$moduleData[0]['name'];
$m=explode(',',  $root);
$getRequlaterynotification=$getmoduledata->getRequlaterynotification(7);
$getseennotification=$getmoduledata->getseennotification(7);

// $getupdatenotification=$getmoduledata->updatealert($companyId);
// print_r($m);
?>
<?php
    require_once '../../php/common/dashboard.php';

    $manager=new dashboard();
    $auditor=$manager->getAuditNotifyinkickoff();
     $respond=$manager->getAuditNotifyinrespond();
    $review=$manager->getAuditNotifyinperformed();
    $followup=$manager->getAuditNotifyinfollowup();
    $reports=$manager->getAuditNotifyinreports();
    // $auditriview=$manager->getAuditNotifyinReview();

?> 
<style>
    .dropdown-btn {
  padding: 6px 8px 6px 16px;
  /*font-size: 20px;*/
  background-color: #3B3F51;
  color: white;
  /*display: white;*/
  border: none;
  background: none;
  text-align: left;
  cursor: pointer;
  outline: none;
}
.dropdown-container {
  display: none;
  /*color: #111;*/
  padding-left: 8px;
}
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 14px;
  color: black;
  /*display: #111;*/
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: ;
  color: black;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: #3B3F51;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 150px;}
  .sidenav a {font-size: 2px;}
}

</style>

<div class="page-container">
<div class="page-sidebar-wrapper">

<div class="page-sidebar navbar-collapse collapse" style="margin-top: -10px; margin-left: -20px;width: 240px;background-color:;">

<?php for($i=0;$i<count($m);$i++)
{?>
    <?php switch ($m[$i]) {
        case 'compliance':?>
               <?php if($_SESSION['user_role']=='compliance_author' || $_SESSION['user_role']=='compliance_reviewer' || $_SESSION['user_role']=='super_admin'){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                          <?php
            if ($_SESSION['user_role']=='super_admin') {
            ?>
                                <ul class="nav-item" style="margin-left: -25px;"><i style="color: #e5e5e5; background-color: #44B6AD; border-radius: 50%;padding: 0.6em;height: 2.2em; width: 2.2em;" class="glyphicon glyphicon-list-alt"></i>
                                    <a href="view/policy/Regulatoryengine.php" class="btn ">
                                      <span class="title" style="color:block;">Regulatory Engine</span>
                                <span class="arrow"></span>

                                    </a>
                                </ul>
                                <?php              
            }
            ?>
            <br>
            <?php if($_SESSION['user_role']=='super_admin') { ?>
<div class="sidenav" style="margin-top: 0px; height: 42%;">
  
    <button class="dropdown-btn"><a href="view/compliance/complianceDashboardAdmin.php">
    <i style="margin-left: -17px; color: #e5e5e5; background-color: #F2774B; border-radius: 50%;padding: 0.6em;height: 2.2em; width: 2.2em;" class=" fa fa-gavel"></i></a> <span style=" color: block;"> Compliance</span>


    <span class="fa fa-caret-down" style="color: black; margin-top: 10px;"></span>

  </button>
<!-- </a> -->
  <div class="dropdown-container" style="font-size: 30px;background-color: white;">

    <!-- <a href="view/common/riskDashboard.php" class="nav-link ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title" style="color: white;">Dashboard</span>

                                    </a><br> -->
    
     <a href="view/compliance/complianceDashboardList.php" class="nav-link ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title" >Dashboard</span>

                                    </a><br>
      <a href="view/compliance/complianceReportAdmin.php" class="nav-link ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title">Report</span>

                                    </a><?php } ?> <br>
      
   <?php if($_SESSION['user_role']=='compliance_author' || $_SESSION['user_role']=='compliance_reviewer'){ ?>
<li class="nav-item active " id="compliancedash" style="margin-top: -50px;" >
                            <a href="javascript:;" class="nav-link nav-toggle">
                               
                               <i style="color: #e5e5e5; background-color: #F2774B; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class=" fa fa-gavel"></i>
                                <span class="title">Compliance</span>

                                <span class="arrow"></span>
                            </a><?php } ?> 
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='compliance_author' || $_SESSION['user_role']=='super_admin' ){ ?>
                                 <li class="nav-item  ">
                                    <a href="view/common/complianceTemplate.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #009900; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class="fa fa-sticky-note-o"></i>
                                        <span class="title">Template</span>
                                    </a>
                                </li>
                                <?php } ?> 
                                <?php if($_SESSION['user_role']=='compliance_author' || $_SESSION['user_role']=='super_admin') { ?>
                                <li class="nav-item">
                                    <a href="view/compliance/complianceCreateAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>
                                        <span class="title">Plan</span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='super_admin' || $_SESSION['user_role']=='compliance_reviewer') { ?>
                                 <li class="nav-item  ">
                                    <a href="view/compliance/complianceReviewAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #3B00FF; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class="   fa fa-circle-o-notch"></i>
                                        <span class="title">Review</span>
                                    </a> 
                                </li>
                             <?php } ?>
                                <?php if($_SESSION['user_role']=='super_admin' || $_SESSION['user_role']=='compliance_reviewer') { ?>
                                <li class="nav-item  ">
                                    <a href="view/compliance/complianceAnalyzeAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #7F0600; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class=" fa fa-line-chart"></i>
                                        <span class="title">Analyze</span>

                                    </a>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='super_admin' || $_SESSION['user_role']=='compliance_reviewer') { ?>
                                <li class="nav-item  ">
                                    <a href="view/compliance/complianceReportAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #B30286; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-bolt"></i>
                                        <span class="title">Report</span>

                                    </a>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='compliance_reviewer' || $_SESSION['user_role']=='super_admin') { ?>
                                <li class="nav-item">
                                    <a href="view/compliance/complianceDashboardList.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #656533; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class="fa fa-pencil"></i>
                                        <span class="title">Dashboard</span>
                                    </a>
                                </li>
                                <?php } ?>
                               <!--  <?php if($_SESSION['user_role']=='compliance_reviewer') { ?>
                                <li class="nav-item">
                                    <a href="view/common/companyAccountSettings.php" class="nav-link ">
                                        <span class="title"> Account Settings</span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='compliance_reviewer') { ?>
                                <li style="color: black;">
                                    <a href="view/common/companyLocationProfile1.php" id="drop" class="dropdown-btn nav-link" style="text-decoration:none; color: black !important;">Add Location to Company 
                                        <i class="fa fa-caret-down" style="color: black !important;"></i>
                                    </a>
                                    <ul class="dropdown-container list-unstyled">
                                        <li><a href="view/common/companyProfile1.php" style="color: black !important;">Chennai</a></li>
                                        <li><a href="view/common/companyProfile1.php" style="color: black !important;">Mumbai</a></li>
                                        <li><a href="view/common/companyProfile1.php" style="color: black !important;">Banglore</a></li>
                                        <li><a href="view/common/companyProfile1.php" style="color: black !important;">Delhi</a></li>
                                    </ul>
                                </li>
                                <script>
                                    $('#drop').on('click', function(event){
                                        event.preventDefault();
                                        event.stopPropagation();
                                    });
                                </script>
<script>
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;
for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='compliance_reviewer') { ?>
                                <li class="nav-item">
                                    <a href="view/common/companyPrioritySeveritySettings.php" class="nav-link ">
                                        <span class="title">Priority & Severity Settings</span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='compliance_reviewer') { ?>
                                <li class="nav-item">
                                    <a href="view/common/complianceNotification.php" class="nav-link ">
                                        <span class="title">Admin Notification</span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='compliance_reviewer') { ?>
                                <li class="nav-item">
                                    <a href="view/common/companyProfile1.php" class="nav-link ">

                                        <span class="title">Audit</span>
                                    </a>
                                </li>
                                <?php } ?> -->
                                 <?php if($_SESSION['user_role']=='compliance_author' || $_SESSION['user_role']=='compliance_reviewer') { ?>
                                <li class="nav-item">
                                    <a href="view/compliance/Regulatoryalert.php" class="nav-link ">
                                      <i style="color: #e5e5e5; background-color: #3B00FF; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class=" fa fa-anchor"></i>
                                        <span class="title" >Regulatory alert</span><span class="dots"></span>

                                        <span class="badge" style="background-color: red;color: white;width:25px;height:20px;font-weight:bold;"><?php echo count($getRequlaterynotification);?></span>
                                    </a>
                                </li>
                                <?php } }?>
                               <!--  <?php if($_SESSION['user_role']=='compliance_reviewer') { ?>
                                <li class="nav-item">
                                    <a href="view/common/companyProfilehelp.php" class="nav-link ">
                                        <span class="title">Help</span>
                                    </a>
                                </li>
                                <?php } ?> -->
                                                                                            
                            </ul>
                        </li>
                         
                    </ul>
            <?php break; ?>
<?php   case 'audit': ?>
              <?php if($_SESSION['user_role']=='auditor' || $_SESSION['user_role']=='auditee' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin'  ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                    <li  id="auditclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                            <a href="javascript:;" class="nav-link nav-toggle">
                                  <i style="color: #e5e5e5; background-color: #575759; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;

                                <span class="title" style="color:block;">Audit</span>

                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='auditor'){ ?>
                                
                                <li class="nav-item  ">
                                    <a href="view/audit/auditPlanCreate.php" class="nav-link ">
                                       <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>
                                        <span class="title">Plan</span>
                                    </a>
                                </li>
                                
                                 <li class="nav-item  ">
                                    <a href="view/audit/auditCreateAdmin.php" class="nav-link ">
                                       <i style="color: #e5e5e5; background-color: #4D00B2; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; margin-top: -50px;" class="  fa fa-anchor"></i>
                                        <span class="title">Kick-Off<span class="badge" style="background-color:red;size:10px;margin-left:2px;color: white;font-weight:bold;"><?php echo count($auditor);?></span></span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/audit/auditPerformAdmin.php" class="nav-link ">
                                      <i style="color: #e5e5e5; background-color: #4D0200; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-child"></i>
                                        <span class="title">Review <span class="badge" style="background-color: red;margin-left:2px;color: white;font-weight:bold;"><?php echo count($review);?></span></span>

                                    </a>
                                </li>
                               
                                 <li class="nav-item  ">
                                    <a href="view/audit/auditPublished.php" class="nav-link ">
                                       <i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-bolt"></i>
                                        <span class="title">Reports <span class="badge" style="background-color:red ;margin-left:2px;color: white;font-weight:bold;"><?php echo count($reports);?></span></span>

                                    </a>
                                </li>
                                <?php }?>
                                <?php if($_SESSION['user_role']=='auditee'){ ?>
                                
                                
                               
                                <li class="nav-item  ">
                                    <a href="view/audit/auditPrepareAdmin.php" class="nav-link ">
                                         <i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-history"></i>
                                        <span class="title">Respond <span class="badge" style="background-color: red;margin-left:2px;color: white;font-weight:bold;"><?php echo count($respond);?></span></span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/audit/auditReturnAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #4D0200; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-check-circle-o"></i>
                                        <span class="title">Follow-Up<span class="badge" style="background-color: red;margin-left:2px;color: white;font-weight:bold;"><?php echo count($followup);?></span></span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a href="view/audit/auditPublished.php" class="nav-link ">
                                         <i style="color: #e5e5e5; background-color: #4D00B2; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; margin-top: -50px;" class="  fa fa-adjust"></i>
                                        <span class="title">Reports<span class="badge" style="background-color: red;margin-left:2px;color: white;font-weight:bold;"><?php echo count($reports);?></span></span>

                                    </a>
                                </li>
                                <?php } }?>                                                         
                            </ul>
                        </li>
                        
                    </ul>
        <?php   break; ?>
</div>
 
</div>
    <?php   case 'risk': ?>
                   <?php if($_SESSION['user_role']=='risk_owner' || $_SESSION['user_role']=='risk_mitigator' || $_SESSION['user_role']=='risk_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                        <li id="riskclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >
                            <a href="javascript:;" class="nav-link nav-toggle">
                             <!--  <img src="assets/images/risk.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                             <i style="color: #e5e5e5; background-color: #CB5A5E; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;

                                <span class="title" style="color: block;">Risk</span>

                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='risk_owner'){ ?>

                                <li class="nav-item  ">
                                    <a href="view/risk/riskPlan.php" class="nav-link ">
                                      <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>
                                        <span class="title">Plan</span>
                                    </a>
                                </li> 
                                <li class="nav-item  ">
                                    <a href="view/risk/riskAdmin.php" class="nav-link ">
                                       <i style="color: #e5e5e5; background-color: #44B6AD; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  glyphicon glyphicon-compressed"></i>
                                        <span class="title">List</span>
                                    </a>
                                </li>  
                             
                                <li class="nav-item  ">
                                    <a href="view/risk/incidentList.php" class="nav-link ">
                                      <i style="color: #e5e5e5; background-color: #66CCFF; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  glyphicon glyphicon-bullhorn"></i>
                                        <span class="title">Incident as Risk</span>
                                    </a>
                                </li> 
                                                                             
                                <?php }?>
                                <?php if($_SESSION['user_role']=='risk_mitigator'){ ?>
                                
                                <li class="nav-item  ">
                                   <a href="view/risk/riskcreatedlist.php" class="nav-link ">
                                     <i style="color: #e5e5e5; background-color: #4D0200; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-child"></i>
                                        <span class="title">Mitigate</span>
                                    </a>
                                </li> 

                                 <li class="nav-item">
                                    <a href="view/risk/registerRisk.php" class="nav-link">
                                        <i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-bolt"></i>
                                       <span class="title">Risk Register</span> 
                                    </a> </li>
                                                       
                                <?php }?>
                                <?php if($_SESSION['user_role']=='risk_reviewer'){ ?>
                                
                                <li class="nav-item  ">
                                    <a href="view/risk/riskmitigatedlist.php" class="nav-link ">
                                         <i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-cloud-download"></i>
                                        <span class="title">Review</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/risk/riskreviewedlist.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #3898DC; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-pencil-square-o"></i>
                                        <span class="title">Report</span>
                                    </a>
                                </li>
                                                        
                                <?php } }?>                                                 
                            </ul>
                        </li>
                        
                    </ul>
        <?php   break; ?>

        <?php case 'policy': ?>
                   <?php if($_SESSION['user_role']=='policy_owner' || $_SESSION['user_role']=='policy_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' || $_SESSION['user_role']=='policy_approver' ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                        <li id="policyclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                            <a href="javascript:;" class="nav-link nav-toggle">
                                <!-- <img src="assets/images/policy.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                <i style="color: #e5e5e5; background-color: #4D0200; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-child"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="title" style="color: block;">Policy</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='policy_owner' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                          
                                 <li class="nav-item  ">
                                    <a href="view/policy/policyPlan.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>
                                        <span class="title">Plan</span>
                                    </a>
                                </li> 
                                <li class="nav-item  ">
                                    <a href="view/policy/policyAdmin.php" class="nav-link ">
                                         <i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class=" fa fa-clone
                                         "></i>
                                        <span class="title">List</span>
                                    </a>
                                </li>                                
                                <li class="nav-item  ">
                                    <?php require_once __DIR__.'/../../php/policy/policyManager.php';
                                        $policyManager = new PolicyManager();
                                        $expiredCount = $policyManager->getExpiredPolicyNumber();
                                        ?>
                                    <a href="view/policy/policyExpired.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #F89834; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-calendar-check-o
                                         "></i>
                                        <span class="title">Expired Policies <span class="badge"><?php echo $expiredCount[0]["count"];?></span></span>
                                    </a>
                                </li>
                    
                                <?php }?>
                                <?php if($_SESSION['user_role']=='policy_reviewer'){ ?>
                                
                                <li class="nav-item  ">
                                    <a href="view/policy/policyAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class=" fa fa-clone
                                         "></i>
                                        <span class="title">List</span>
                                    </a>
                                </li>                                  
                                <?php }?>                             
                               
                                <?php if($_SESSION['user_role']=='policy_approver'){ ?>
                                
                                <li class="nav-item  ">
                                    <a href="view/policy/policyAdmin.php" class="nav-link ">
                                        <span class="title">List</span>
                                    </a>
                                </li>                                  
                                <?php } }?>                                                             
                            </ul>
                        </li>
                        
                    </ul> 
        <?php   break; ?>
         <?php   case 'disaster': ?>
                <?php if($_SESSION['user_role']=='disaster_owner' || $_SESSION['user_role']=='disaster_tester' || $_SESSION['user_role']=='disaster_trainer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin'  ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">


                        
                        <li id="drclkdashboard" class="nav-item<?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                            <a href="view/disaster/disasterDashboard.php" class="nav-link ">
                                 <!-- <img src="assets/images/dr.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                 <i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-bolt"></i>&nbsp;&nbsp;&nbsp;&nbsp;

                                <span class="title" style="color: block;">Disaster</span>

                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if($_SESSION['user_role']=='disaster_owner'){?>
                                <li class="nav-item  ">

                                    <a href="view/disaster/disasterPlan.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title">Plan</span>
                                    </a>
                                </li>
                                <?php } ?>
                                
                                <?php if($_SESSION['user_role']=='disaster_tester'){?>
                                <li class="nav-item  ">
                                    <a href="view/disaster/disasterTestList.php" class="nav-link ">
                                       <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title">Strategy</span>
                                    </a>
                                </li>
                                <?php } ?>

                                <?php if($_SESSION['user_role']=='disaster_trainer'){?>
                                 <li class="nav-item  ">
                                    <a href="view/disaster/disasterTrainingList.php" class="nav-link ">
                                       <i style="color: #e5e5e5; background-color: #36E699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-map-pin"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title">Training</span>

                                    </a>
                                </li>
                                <?php } ?>
                                <li class="nav-item  ">
                                    <a href="view/disaster/disasterReportlist.php" class="nav-link ">
                                      <i style="color: #e5e5e5; background-color: #3A8AE6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-eyedropper"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title">Report</span>
                                    </a>
                                </li>
                                  <?php if($_SESSION['user_role']=='disaster_owner'){ ?>
                                 <li class="nav-item  ">
                                    <a href="view/disaster/disasterlist.php" class="nav-link ">
                                      <i style="color: #e5e5e5; background-color: #333300; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-newspaper-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title">List</span>
                                    </a>
                                </li>
                                <?php } }?>
                                
                                
                            </ul>
                        </li>
                        
                    </ul>
        <?php   break; ?>

   
       
<?php case 'asset': ?>
                 <?php if($_SESSION['user_role']=='asset_owner' || $_SESSION['user_role']=='asset_custodian' || $_SESSION['user_role']=='asset_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                        <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                            <li class="nav-item active open" >                           
                            <li id="assetclkdashboard" class="nav-item  <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                                <a href="javascript:;" class="nav-link nav-toggle">
                                   <!-- <img src="assets/images/asset.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                   <i style="color: #e5e5e5; background-color: #3A8AE6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-industry"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="title" style="color:block;">Asset</span>
                                    <span class="arrow"></span>
                                </a>
                                <nav class="navigation">
                                <ul class="mainmenu">

                                    <?php if($_SESSION['user_role']=='asset_owner'){ ?>

                                    <li class="nav-item ">
                                        <a href="view/asset/assetPlanCreate.php" class="nav-link ">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: #e5e5e5; background-color: #CC0399; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-asterisk"></i>
                                            <span class="title">Create</span>
                                        </a>
                                    </li> 
                                    <li class="nav-item  ">

                                        <a href="view/asset/assetAdmin.php?str=all" class="nav-link ">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: #e5e5e5; background-color: #333300; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-newspaper-o"></i>
                                            <span class="title">List</span>

                                        </a>                                                                    
                                             </li>                     
                                    <?php }?>
                                     <?php if($_SESSION['user_role']=='asset_custodian'){ ?> 

 <li class="nav-item" style="list-style-type: none;">
                                        <a href="view/asset/assetAdmin.php" class="nav-link ">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: #e5e5e5; background-color: #333300; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-newspaper-o"></i>
                                            <span class="title">List</span>
                                        </a>
                                    </li> 

                                     <li class="nav-item" style="list-style-type: none;">
                                        <a href="view/asset/assetAssessmentReturned.php" class="nav-link ">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: #e5e5e5; background-color: #AC3939; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="    fa fa-reply"></i>
                                            <span class="title">Assesment Returned</span>
                                        </a>
                                    </li>       
                                   <li class="nav-item" style="list-style-type: none;">
                                        <a href="view/asset/assetReviewReturned.php" class="nav-link ">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: #e5e5e5; background-color: #154465; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="    fa fa-sign-in"></i>
                                            <span class="title">Review Returned</span>
                                        </a>
                                    </li>      
                                                                            
                                    <?php }?>
                                   
                                    <?php if($_SESSION['user_role']=='asset_reviewer'){ ?>

                                    <li class = "nav-item">
                                    <a href = "view/asset/assetReviewAdmin.php" class ="nav-link">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-cloud-download"></i>
                                    <span class="title">Review</span>
                                    </a>
                                    </li>  
                                    <li class="nav-item  ">
                                        <a href="view/asset/assetReportAdmin.php" class="nav-link ">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: #e5e5e5; background-color: #3898DC; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-pencil-square-o"></i>
                                            <span class="title">Report</span>
                                        </a>
                                    </li> 
                                                                 
                                    <?php } }?>                              
                            </ul>
                        </li> 
                          
                    </ul>
</nav>
        <?php   break; ?>

    <?php case 'incident': ?>        
                 <?php if($_SESSION['user_role']=='incident_analyst' || $_SESSION['user_role']=='incident_manager' || $_SESSION['user_role']=='incident_resolver' || $_SESSION['user_role']=='incident_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin'  ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">

                       <!--  <li class="heading">
                            <h3 class="uppercase"></h3>
                        </li> -->
                        <li id="incidentdemo" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <!-- <img src="assets/images/incidents.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                <i style="color: #e5e5e5; background-color: #4D00B2; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="title" style="color:block;">Incident</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='incident_analyst'){ ?>
                                <li class="nav-item  ">
                                    <a href="view/incident/plan.php" class="nav-link ">
                                      <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>
                                        <span class="title">Plan</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                      <i style="color: #e5e5e5; background-color: #F74F51; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="    fa fa-compass"></i>
                                        <span class="title">Diagnosis</span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='incident_manager' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
                                 <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                       <i style="color: #e5e5e5; background-color: #F74F51; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="    fa fa-compass"></i>
                                        <span class="title">Diagnosis</span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='incident_resolver' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>         
                                 
                                <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #3A8AE6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-eyedropper"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title">Resolution</span>

                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #4D0200; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-copyright
                                         "></i>
                                        <span class="title">Closure</span>

                                    </a>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='incident_reviewer'){ ?>
                                <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                       <i style="color: #e5e5e5; background-color: #3898DC; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-registered"></i>
                                        <span class="title">Report</span>

                                    </a>
                                </li>
                                <?php } ?>
                                <?php } ?>
                  

                        </ul>
                    </li>
                </ul>
     


        <?php   break;  ?>

 <?php case 'bcpm': ?>
                 <?php if($_SESSION['user_role']=='bcpm_planner' || $_SESSION['user_role']=='bcpm_maintainer' || $_SESSION['user_role']=='bcpm_tester'|| $_SESSION['user_role']=='bcpm_implementer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                        <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">

                            <li id="bcpmclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                                <a href="javascript:;" class="nav-link nav-toggle">
                                  <!--  <img src="assets/images/bcpm.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                  <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="title" style="color: block;">BCPM</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">

                                    <?php if($_SESSION['user_role']=='bcpm_planner' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>

                                    <li class="nav-item  ">
                                        <a href="view/bcpm/prePlan.php" class="nav-link ">
                                            <i style="color: #e5e5e5; background-color: #99064D; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-street-view"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="title">Pre Plan</span>
                                        </a>
                                    </li> 
                                    <li class="nav-item  ">
                                        <a href="view/bcpm/bcpmCreateAdmin.php" class="nav-link ">
                                            <i style="color: #e5e5e5; background-color: #333300; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-newspaper-o"></i>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="title">List</span>
                                        </a>
                                    </li>                                  
                                    <?php }?>
                                     <?php if($_SESSION['user_role']=='bcpm_implementer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>

                                   
                                    <li class="nav-item  ">
                                        <a href="view/bcpm/bcpmImplementAdmin.php" class="nav-link ">
                                            <span class="title">List</span>
                                        </a>
                                    </li>                                  
                                    <?php }?>
                                    <?php if($_SESSION['user_role']=='bcpm_maintainer'){ ?>
                                    
                                    <li class="nav-item  ">
                                        <a href="view/bcpm/bcpmMaintainenceAdmin.php" class="nav-link ">
                                            <i style="color: #e5e5e5; background-color: #0B004D; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="    fa fa-object-ungroup"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="title">Maintenance</span>
                                        </a>
                                    </li>                                
                                    <?php }?>
                                    <?php if($_SESSION['user_role']=='bcpm_tester' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                    
                                    <li class="nav-item  ">
                                        <a href="view/bcpm/bcpmExerciseAdmin.php" class="nav-link ">
                                            <i style="color: #e5e5e5; background-color: #804000; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="    fa fa-sort-amount-desc"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="title">Exercise</span>
                                        </a>
                                    </li>                                
                                    <?php } }?>                              
                            </ul>
                        </li>    
                    </ul>
        <?php   break;  ?>

   
        
                               
        <?php   

    }
    
 }?>
        <?php
            if ($_SESSION['user_role']=='super_admin') {
        ?>
                             <ul class="nav-item" style="margin-left: -25px;"><!-- <span class="glyphicon glyphicon-briefcase"></span> -->
                                <i style="color: #e5e5e5; background-color: #2D7876; border-radius: 50%;padding: 0.6em;height: 2.2em; width: 2.2em;" class="glyphicon glyphicon-briefcase"></i>
                                    <a href="view/board/board_dashboard.php" class="btn ">
                                      <span class="title" style="color: block;">Board</span>
                                <span class="arrow"></span>

                                    </a>
                                </ul>
        <?php
            }
        ?>
         <?php
            if ($_SESSION['user_role']=='super_admin') {
        ?>
                             <ul class="nav-item" style="margin-left: -25px;"><!-- <span class="glyphicon glyphicon-briefcase"></span> -->

                                <i style="color: #e5e5e5; background-color: #b08f37; border-radius: 50%;padding: 0.6em;height: 2.2em; width: 2.2em;" class="  glyphicon glyphicon-compressed"></i>

                                    <a href="view/Datalake/table.php" class="btn ">
                                      <span class="title" style="color: block;">NixViolate</span>
                                <span class="arrow"></span>

                                    </a>
                                </ul>
        <?php
            }
        ?>
         <?php
            if ($_SESSION['user_role']=='super_admin') {
        ?>
                             <ul class="nav-item" style="margin-left: -25px;"><!-- <span class="glyphicon glyphicon-briefcase"></span> -->

                                <i style="color: #e5e5e5; background-color: #f59e42; border-radius: 50%;padding: 0.6em;height: 2.2em; width: 2.2em;" class="  glyphicon glyphicon-bullhorn"></i>

                                    <a href="view/common/whistleDashboard.php" class="btn ">
                                      <span class="title" style="color: block;">NixWhistle</span>
                                <span class="arrow"></span>

                                    </a>
                                </ul>
       <?php
            }
        ?>
        <script>
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
 dropdown[i].addEventListener("click", function() {
 this.classList.toggle("active");
 var dropdownContent = this.nextElementSibling;
 if (dropdownContent.style.display === "block") {
 dropdownContent.style.display = "none";
 } else {
 dropdownContent.style.display = "block";
 }
 });
}
</script>
     <!--       <?php
            if ($_SESSION['user_role']=='super_admin') {
        ?>
                             <ul class="nav-item" style="margin-left: -25px;"><span class="glyphicon glyphicon-briefcase"></span>
                                    <a href="view/Datalake/table.php" class="btn ">
                                      <span class="title">Nix-violate</span>
                                <span class="arrow"></span>

                                    </a>
                                </ul>
        <?php
            }
        ?>   -->
 

                              
 </div>
 </div>

<script type="text/javascript">
        document.getElementById("auditclkdashboard").onclick = function() {myFunction()};
        function myFunction() {
           location.href = "/freshgrc/view/audit/auditDashboard.php";
        }
        </script>

       <script type="text/javascript">
        document.getElementById("riskclkdashboard").onclick = function() {myFunction1()};
        function myFunction1() {
           location.href = "/freshgrc/view/common/riskDashboard.php";
        }
        </script>
       
          <script type="text/javascript">
        document.getElementById("bcpmclkdashboard").onclick = function() {myFunction3()};
        function myFunction3() {
           location.href = "/freshgrc/view/bcpm/bcpmDashboard.php";
        }
        </script>
         <script type="text/javascript">
        document.getElementById("drclkdashboard").onclick = function() {myFunction4()};
        function myFunction4() {
           location.href = "/freshgrc/view/disaster/disasterDashboard.php";
        }
        </script>
        <script type="text/javascript">
        document.getElementById("assetclkdashboard").onclick = function() {myFunction5()};
        function myFunction5() {
           location.href = "/freshgrc/view/asset/assetDashboard.php";
        }
         </script>
          <script type="text/javascript">
        document.getElementById("incidentdemo").onclick = function() {myFunction2()};
        function myFunction2() {
           location.href = "/freshgrc/view/incident/incidentDashboard.php";
        }
        </script>
        <script type="text/javascript">
        document.getElementById("wishleclkdashboard").onclick = function() {myFunction6()};
        function myFunction6() {
           location.href = "/freshgrc/view/common/whistleDashboard.php";
        }
        </script>
        <script type="text/javascript">
        document.getElementById("compliancedash").onclick = function() {showComplianceDash()};
        function showComplianceDash() {
           location.href = "/freshgrc/view/compliance/complianceDashboardAdmin.php";
        }
    </script>
    <script type="text/javascript">
         document.getElementById("policyclkdashboard").onclick = function() {myFunction7()};
        function myFunction7() {
           location.href = "/freshgrc/view/policy/policyDashboard.php";
        }
    </script>
    <script type="text/javascript">
        document.getElementById("ethics_dashboard").onclick = function() {myFunction8()};
        function myFunction8() {
           location.href = "/freshgrc/view/ethics/ethics_dashboard.php";
        }
        
         </script>
        <style type="text/css">
            .title{
              color: black;
           }
            .title :hover span{
               color:#5b9bd1;
            }
        </style>