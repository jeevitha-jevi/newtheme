<?php
    require_once '../../php/common/dashboard.php';

    $manager=new dashboard();
    $auditor=$manager->getAuditNotifyinkickoff();
     $respond=$manager->getAuditNotifyinrespond();
    $review=$manager->getAuditNotifyinperformed();
    $followup=$manager->getAuditNotifyinfollowup();
    $reports=$manager->getAuditNotifyinreports();
    

?> 
<div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
               <div class="page-sidebar navbar-collapse collapse" style="margin-top: -10px; margin-left: -20px;width: 240px;background-color:;">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                     <?php if($_SESSION['user_role']=='auditor' || $_SESSION['user_role']=='auditee' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin'  ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">

                       <!--  <li class="heading">
                            <h3 class="uppercase"></h3>
                        </li> -->

                        <li  id="auditclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                            <a href="javascript:;" class="nav-link nav-toggle">
                               <!--  <i class="fa fa-file-text"></i> -->
                                <i style="color: #e5e5e5; background-color: #575759; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="title">Audit</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='auditor' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                <!-- <li class="nav-item">
                                    <a href="view/audit/auditConfigurableDashboard.php" class="nav-link">
                                        <span class="title">Configurable Dashborad</span>
                                    </a>
                                </li> -->
                                <li class="nav-item  ">
                                    <a href="view/audit/auditPlanCreate.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>
                                        <span class="title">Plan</span>
                                    </a>
                                </li>
                                <!-- <li class="nav-item  ">
                                    <a href="view/audit/auditCsvImport.php" class="nav-link ">
                                        <span class="title">Import</span>
                                    </a>
                                </li> -->
                                 <li class="nav-item  ">
                                    <a href="view/audit/auditCreateAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #4D00B2; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; margin-top: -50px;" class="  fa fa-anchor"></i>
                                        <span class="title">KickOff <span class="badge" style="background-color: red;margin-left:2px;color: white;font-weight:bold;"><?php echo count($auditor);?></span></span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/audit/auditPerformAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #4D0200; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-child"></i>
                                        <span class="title">Review<span class="badge" style="background-color: red;margin-left:2px;color: white;font-weight:bold;"><?php echo count($review);?></span></span>

                                    </a>
                                </li>
                               
                                 <li class="nav-item  ">
                                    <a href="view/audit/auditPublished.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-bolt"></i>
                                        <span class="title">Reports<span class="badge" style="background-color: red;margin-left:2px;color: white;font-weight:bold;"><?php echo count($reports);?></span></span>

                                    </a>
                                </li>
                                <?php }?>
                                <?php if($_SESSION['user_role']=='auditee' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
                                
                               
                                <li class="nav-item  ">
                                    <a href="view/audit/auditPrepareAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>
                                        <span class="title">Respond <span class="badge" style="background-color: red;margin-left:2px;color: white;font-weight:bold;"><?php echo count($respond);?></span></span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/audit/auditReturnAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #4D00B2; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; margin-top: -50px;" class="  fa fa-anchor"></i>
                                        <span class="title">FollowUp<span class="badge" style="background-color: red;margin-left:2px;color: white;font-weight:bold;"><?php echo count($followup);?></span></span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a href="view/audit/auditPublished.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #4D0200; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-child"></i>
                                        <span class="title">Reports<span class="badge" style="background-color: red;margin-left:2px;color: white;size:20;font-weight:bold;"><?php echo count($reports);?></span></span>

                                    </a>
                                </li>
                                <?php } }?>
                               
                                <!-- <li class="nav-item  ">
                                    <a href="view/audit/auditDashboard.php" class="nav-link ">
                                        <span class="title">Audit Dashboard</span>
                                    </a>
                                </li> -->
                                
                            </ul>
                        </li>
                        
                    </ul>
                    <?php if($_SESSION['user_role']=='compliance_author' || $_SESSION['user_role']=='super_admin'){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">

                       <!--  <li class="heading">
                            <h3 class="uppercase"></h3>
                        </li> -->
                        <li class="nav-item active " id="compliancedash"  >
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i style="color: #e5e5e5; background-color: #F2774B; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class=" fa fa-gavel"></i>
                                <span class="title">Compliance</span>
                                <!-- <span class="arrow"></span> -->
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='compliance_author'){ ?>
                                 <li class="nav-item  ">
                                    <a href="view/common/complianceTemplate.php" class="nav-link ">
                                          <i style="color: #e5e5e5; background-color: #009900; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class="fa fa-sticky-note-o"></i>
                                        <span class="title">Template</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/compliance/complianceCreateAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>
                                        <span class="title">Plan</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="view/compliance/Regulatoryalert.php" class="nav-link ">
                                      <i style="color: #e5e5e5; background-color: #3B00FF; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class=" fa fa-anchor"></i>
                                        <span class="title" >Regulatory alert</span><span class="dots"></span>

                                        <span class="badge" style="background-color: red;color: white;width:25px;height:20px;font-weight:bold;"><?php echo count($getRequlaterynotification);?></span>
                                    </a>
                                </li>
                                
                                <!--  <li class="nav-item  ">
                                    <a href="view/compliance/complianceReviewAdmin.php" class="nav-link ">
                                         <i style="color: #e5e5e5; background-color: #3B00FF; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class="   fa fa-circle-o-notch"></i>
                                        <span class="title">Review</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item  ">
                                    <a href="view/compliance/complianceAnalyzeAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #7F0600; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em; " class=" fa fa-line-chart"></i>
                                        <span class="title">Analyze</span>

                                    </a>
                                </li> -->
                               <!--  <li class="nav-item  ">
                                    <a href="view/compliance/complianceReportAdmin.php" class="nav-link ">
                                        
                                        <span class="title">Report</span>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="view/compliance/complianceDashboardList.php" class="nav-link ">
                                        <span class="title">Dashboard</span>

                                    </a>
                                    
                                </li> -->
                               
                                <?php } }?>
                                
                               
                                <!-- <li class="nav-item  ">
                                    <a href="view/audit/auditDashboard.php" class="nav-link ">
                                        <span class="title">Audit Dashboard</span>
                                    </a>
                                </li> -->
                                
                            </ul>
                        </li>
                        
                    </ul>
                     <?php if($_SESSION['user_role']=='risk_owner' || $_SESSION['user_role']=='risk_mitigator' || $_SESSION['user_role']=='risk_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                        <li id="riskclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >
                            <a href="javascript:;" class="nav-link nav-toggle">
                              <i style="color: #e5e5e5; background-color: #CB5A5E; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;

                                <span class="title">Risk</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='risk_owner' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>

                                <li class="nav-item  ">
                                    <a href="view/risk/riskPlan.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>
                                        <span class="title">Plan</span>
                                    </a>
                                </li> 
                                <li class="nav-item  ">
                                    <a href="view/risk/riskAdmin.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #333300; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-newspaper-o"></i>
                                        <span class="title">List</span>
                                    </a>
                                </li>  
                                <!-- <li class="nav-item  ">
                                    <a href="view/risk/riskCsvImport.php" class="nav-link ">
                                        <span class="title">Import</span>
                                    </a>
                                </li>  -->
                                <!-- <li class="nav-item  ">
                                    <a href="view/lossReporting/lossReportingAdmin.php" class="nav-link ">
                                        <span class="title">Loss Reporting</span>
                                    </a>
                                </li>   -->
                                <li class="nav-item  ">
                                    <a href="view/risk/incidentList.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #66CCFF; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  glyphicon glyphicon-bullhorn"></i>
                                        <span class="title">Incident as Risk</span>
                                    </a>
                                </li> 
                                                  
                               <!--  <li class="nav-item  ">
                                    <a href="view/risk/riskReport.php" class="nav-link ">
                                        <span class="title">Reports</span>
                                    </a>
                                </li>       -->                                                            
                                <?php }?>
                                <?php if($_SESSION['user_role']=='risk_mitigator' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
                                <li class="nav-item  ">
                                   <a href="view/risk/riskcreatedlist.php" class="nav-link ">
                                    <i style="color: #e5e5e5; background-color: #66CCFF; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  glyphicon glyphicon-bullhorn"></i>
                                        <span class="title">Mitigate</span>
                                    </a>
                                </li> 

                                 <li class="nav-item">
                                    <a href="view/risk/registerRisk.php" class="nav-link">
                                        <i style="color: #e5e5e5; background-color: #4D0200; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-child"></i>
                                       <span class="title">Risk Register</span> 
                                    </a> </li>
                                <!-- <li class="nav-item  ">
                                   <a href="view/lossReporting/lossListAdmin.php" class="nav-link ">
                                        <span class="title">Open Losses</span>
                                    </a>
                                </li> -->
                               <!--  <li class="nav-item  ">
                                    <a href="view/risk/riskAdmin.php" class="nav-link ">
                                        <span class="title">List</span>
                                    </a>
                                </li> -->
                               <!--  <li class="nav-item  ">
                                    <a href="view/common/riskFutureDashboard.php" class="nav-link ">
                                        <span class="title">Future</span>
                                    </a>
                                </li> -->
                               <!--  <li class="nav-item  ">
                                    <a href="view/common/riskDashboard.php" class="nav-link ">
                                      <span class="title">Dashboard</span>
                                    </a>
                                 </li> -->
                                <!--  <li class="nav-item  ">
                                    <a href="view/risk/riskReport.php" class="nav-link ">
                                        <span class="title">Reports</span>
                                    </a>
                                </li>    -->                               
                                <?php }?>
                                <?php if($_SESSION['user_role']=='risk_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
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
                                <!-- <li class="nav-item  ">
                                    <a href="view/risk/riskAdmin.php" class="nav-link ">
                                        <span class="title">List</span>
                                    </a>
                                </li>
                               <li class="nav-item  ">
                                    <a href="view/common/riskFutureDashboard.php" class="nav-link ">
                                        <span class="title">Future</span>
                                    </a>
                                </li> -->
                                 <!-- <li class="nav-item  ">
                                   <a href="view/common/riskDashboard.php" class="nav-link ">
                                      <span class="title">Dashboard</span>
                                    </a>
                                 </li>  -->
                               <!--   <li class="nav-item  ">
                                    <a href="view/risk/riskReport.php" class="nav-link ">
                                        <span class="title">Reports</span>
                                    </a>
                                </li>    -->                               
                                <?php } }?>
                               

                                <!-- <li class="nav-item  ">
                                    <a href="view/audit/auditDashboard.php" class="nav-link ">
                                        <span class="title">Audit Dashboard</span>
                                    </a>
                                </li> -->
                                
                            </ul>
                        </li>
                        
                    </ul>
                     <?php if($_SESSION['user_role']=='bcpm_planner' || $_SESSION['user_role']=='bcpm_maintainer' || $_SESSION['user_role']=='bcpm_tester'|| $_SESSION['user_role']=='bcpm_implementer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                        <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">


                           <!--  <li class="heading">
                                <h3 class="uppercase">BCPM</h3>
                            </li> -->

                            <li id="bcpmclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                                <a href="javascript:;" class="nav-link nav-toggle">
                                   <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-umbrella"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="title">BCPM</span>
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
                                            <i style="color: #e5e5e5; background-color: #333300; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-newspaper-o"></i>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
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


                    <!-- /////////////sidebar for disaster management -->
                    <?php if($_SESSION['user_role']=='disaster_owner' || $_SESSION['user_role']=='disaster_tester' || $_SESSION['user_role']=='disaster_trainer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin'  ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">


                        
                        <li id="drclkdashboard" class="nav-item<?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                            <a href="view/disaster/disasterDashboard.php" class="nav-link ">
                                   <i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-bolt"></i>&nbsp;&nbsp;&nbsp;&nbsp;

                                <span class="title">Disaster</span>

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
                                        <i style="color: #e5e5e5; background-color: #AC01E6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="    fa fa-dot-circle-o  
"></i>&nbsp;&nbsp;&nbsp;&nbsp;
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

                          <?php if($_SESSION['user_role']=='asset_owner' || $_SESSION['user_role']=='asset_custodian' || $_SESSION['user_role']=='asset_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                        <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">



                         <!--    <li class="heading">
                                <h3 class="uppercase">ASSET</h3>
                            </li> -->

                            <li class="nav-item active open" >


                           
                            <li id="assetclkdashboard" class="nav-item  <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                                <a href="javascript:;" class="nav-link nav-toggle">
                                   <i style="color: #e5e5e5; background-color: #3A8AE6; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-industry"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="title">Asset</span>
                                    <span class="arrow"></span>
                                </a>
                                <nav class="navigation">
                                <ul class="mainmenu">

                                    <?php if($_SESSION['user_role']=='asset_owner'){ ?>

                                    <li class="nav-item ">
                                        <a href="view/asset/assetPlanCreate.php" class="nav-link ">
                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i style="color: #e5e5e5; background-color: #CC0399; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-asterisk"></i>
                                            <span class="title">Create</span>
                                        </a>
                                    </li> 
                                    <li class="nav-item  ">

                                        <a href="view/asset/assetAdmin.php?str=all" class="nav-link ">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: #e5e5e5; background-color: #333300; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-newspaper-o"></i>
                                            <span class="title">List</span>

                                        </a>
                                       
                               <!--  <ul class="submenu">
                                     <li><a href="view/asset/assetAdmin.php?str=Digital Asset">Digital Asset</a></li>
                                    <li><a  href='view/asset/assetAdmin.php?str=Business Databases'>Business Databases</a></li>
                                    <li><a  href='view/asset/assetAdmin.php?str=Source Code'>Source Code</a></li>
                                    <li><a  href='view/asset/assetAdmin.php?str=Software'>Software</a></li>
                                     <li><a  href='view/asset/assetAdmin.php?str=Non Digital Assets'>Non Digital Assets</a></li>
                                    <li><a  href='view/asset/assetAdmin.php?str=People Assets'>People Assets</a></li>
                                      <li><a href='view/asset/assetAdmin.php?str=Servers' >Servers</a></li>
                                      <li><a href='view/asset/assetAdmin.php?str=Network Devices' >Network Devices</a></li>
                                      <li><a  href='view/asset/assetAdmin.php?str=Desktops'>Desktops</a></li>
                                      <li><a  href='view/asset/assetAdmin.php?str=Laptops'>Laptops</a></li>
                                       <li><a href='view/asset/assetAdmin.php?str=Media'>Media</a></li>
                                        <li><a href='view/asset/assetAdmin.php/?str=Support Utilities' >Support Utilities</a> 

                                        </li>

                                </ul> -->
                                                                                                             
                                             </li>  

                                    <!-- <li class="nav-item  ">
                                        <a href="view/asset/assetDashboard.php" class="nav-link ">
                                            <span class="title">Dashboard</span>
                                        </a>
                                    </li>   -->                    
                                    <?php }?>
                                     <?php if($_SESSION['user_role']=='asset_custodian'){ ?> 
                                   <!--  <li class="nav-item  ">
                                        <a href="view/asset/assetDashboard.php" class="nav-link ">
                                            <span class="title">Dashboard</span>
                                        </a>
                                    </li>                                    
 -->





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
                                   
                                   

                                    <!-- <li class="nav-item  ">
                                        <a href="view/asset/assetLocation.php" class="nav-link ">
                                            <span class="title">Location</span>
                                        </a>
                                    </li>

                                    <li class="nav-item  ">
                                        <a href="view/asset/assetHistoryList.php" class="nav-link ">
                                            <span class="title">History</span>
                                        </a>
                                    </li>             -->                     
                                    <?php }?>
                                   
                                    <?php if($_SESSION['user_role']=='asset_reviewer'){ ?>


                                        <!-- <li class = "nav-item">
                                    <a href = "view/asset/assetDashboard.php" class ="nav-link">
                                    <span class="title">Dashboard</span>
                                    </a>
                                    </li> -->  
                                    <li class = "nav-item">
                                    <a href = "view/asset/assetReviewAdmin.php" class ="nav-link">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-cloud-download"></i>
                                    <span class="title">Review</span>
                                    </a>
                                    </li>  
                                    <li class="nav-item  ">
                                        <a href="view/asset/assetReportAdmin.php" class="nav-link ">
                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i style="color: #e5e5e5; background-color: #3898DC; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-pencil-square-o"></i>
                                            <span class="title">Report</span>
                                        </a>
                                    </li> 
                                                                 
                                    <?php } }?>                              
                            </ul>
                        </li> 
                          
                    </ul>
</nav>



                    <?php if($_SESSION['user_role']=='whistle_investigator' || $_SESSION['user_role']=='whistle_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">

                        <!-- <li class="heading">
                            <h3 class="uppercase">WHISTLEBLOWER</h3>
                        </li> -->

                        <li id="wishleclkdashboard"
                        class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                            <a href="view/common/whistleDashboard.php" class="nav-link ">
                                <i style="color: #e5e5e5; background-color: #f59e42; border-radius: 50%;padding: 0.4em;height: 1.7em; width:1.7em;" class="  glyphicon glyphicon-bullhorn"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="title">Whistleblower</span>

                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <?php if($_SESSION['user_role']=='whistle_investigator'){ ?>

                                    <li class="nav-item  ">

                                    <a href="view/whistleBlower/whistleBlowCreated.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #7F0600; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-ban"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title">Investigate</span>
                                    </a>
                                </li>
                               <?php } ?>
                               <?php if($_SESSION['user_role']=='whistle_reviewer'){ ?>

                                    <li class="nav-item  ">

                                    <a href="view/whistleBlower/whistleBlowReported.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #CC6699; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title">Review</span>
                                    </a>
                                </li>
                               <?php } ?>
                                <?php if($_SESSION['user_role']=='whistle_investigator' ||$_SESSION['user_role']=='whistle_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                             <!--   <li class="nav-item  ">
                                    <a href="view/whistleBlower/whistleBlowClosed.php" class="nav-link ">
                                        <span class="title">Review</span>
                                    </a>
                                </li> -->
                                 <li class="nav-item  ">
                                    <a href="view/whistleBlower/whistlePermanentlyClosed.php" class="nav-link ">
                                        <i style="color: #e5e5e5; background-color: #3898DC; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="  fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="title">Report</span>

                                    </a>
                                </li>
                                <?php } } ?>

                                
                            </ul>
                        </li>
                        
                    </ul>
                    <?php if($_SESSION['user_role']=='policy_owner' || $_SESSION['user_role']=='policy_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' || $_SESSION['user_role']=='policy_approver' ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                        <li id="policyclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                            <a href="javascript:;" class="nav-link nav-toggle">
                                 <i style="color: #e5e5e5; background-color: #4D0200; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-child"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="title">Policy</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='policy_owner' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                <!--  <li class="nav-item  ">
                                    <a href="view/policy/policyDashboard.php" class="nav-link ">
                                        <span class="title">Dashboard</span>
                                    </a>
                                </li> --> 

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

                               <!--  <li class="nav-item  ">
                                    <a href="view/policy/policyImport.php" class="nav-link ">
                                        <span class="title">Import Policy</span>
                                    </a>
                                </li> -->
                                
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

                                <!-- <li class="nav-item  ">
                                    <a href="view/audit/auditDashboard.php" class="nav-link ">
                                        <span class="title">Audit Dashboard</span>
                                    </a>
                                </li> -->
                                
                            </ul>
                        </li>
                        
                    </ul>

                    <!-- //////////////////for incident  -->
                    <?php if($_SESSION['user_role']=='incident_analyst' || $_SESSION['user_role']=='incident_manager' || $_SESSION['user_role']=='incident_resolver' || $_SESSION['user_role']=='incident_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin'  ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">

                       <!--  <li class="heading">
                            <h3 class="uppercase"></h3>
                        </li> -->
                        <li id="incidentdemo" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i style="color: #e5e5e5; background-color: #4D00B2; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="title">Incident</span>
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
                                        <i style="color: #e5e5e5; background-color: #F74F51; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-compass"></i>
                                        <span class="title">Diagnosis</span>
                                    </a>
                                </li>
                                <!-- <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Resolution</span>
                                    </a>
                                </li> -->
                               
                                <!--  <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Closure</span>
                                    </a>
                                </li> -->
                               <!--  <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Report</span>
                                    </a>
                                </li> -->
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='incident_manager' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
                                 <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                         <i style="color: #e5e5e5; background-color: #F74F51; border-radius: 50%;padding: 0.4em;height: 1.7em; width: 1.7em;" class="fa fa-compass"></i>
                                        <span class="title">Diagnosis</span>
                                    </a>
                                </li>
                                <!-- <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Resolution</span>
                                    </a>
                                </li> -->
                               
                                 <!-- <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Closure</span>
                                    </a>
                                </li> -->
                               <!--  <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Report</span>
                                    </a>
                                </li> -->
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='incident_resolver' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>         
                                 
                                <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Resolution</span>

                                    </a>
                                </li>
                               
                              <!--    <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Closure</span>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Report</span>
                                    </a>
                                </li> -->
                                <?php } ?>
                                <?php if($_SESSION['user_role']=='incident_reviewer'){ ?>                           
                                <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Closure</span>

                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/incident/incidentList.php" class="nav-link ">
                                        <span class="title">Report</span>

                                    </a>
                                </li>
                                <?php } ?>
                                <?php } ?>
                  

                        </ul>
                    </li>
                </ul>









          <?php if($_SESSION['user_role']=='employee' || $_SESSION['user_role']=='ethics_reviewer' || $_SESSION['user_role']=='ethics_approver' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                        <li id="ethics_dashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >
                            <a href="javascript:;" class="nav-link nav-toggle">
                              <img src="assets/images/risk.png" style="height: 20px;margin-top: -3px; margin-left: -3px;">
                                <span class="title">Ethics</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='employee' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>

                                <li class="nav-item  ">
                                    <a href="view/ethics/employeelist.php" class="nav-link ">
                                        <span class="title">Policy</span>
                                    </a>
                                </li> 
                                <li class="nav-item  ">
                                    <a href="view/ethics/employeeReportlist.php" class="nav-link ">
                                        <span class="title">Exception</span>
                                    </a>
                                </li>  
                                <!-- <li class="nav-item  ">
                                    <a href="view/risk/riskCsvImport.php" class="nav-link ">
                                        <span class="title">Import</span>
                                    </a>
                                </li>  -->
                                <!-- <li class="nav-item  ">
                                    <a href="view/lossReporting/lossReportingAdmin.php" class="nav-link ">
                                        <span class="title">Loss Reporting</span>
                                    </a>
                                </li>   -->
                               <!--  <li class="nav-item  ">
                                    <a href="view/risk/incidentList.php" class="nav-link ">
                                        <span class="title">Incident as Risk</span>
                                    </a>
                                </li>  -->
                                                  
                               <!--  <li class="nav-item  ">
                                    <a href="view/risk/riskReport.php" class="nav-link ">
                                        <span class="title">Reports</span>
                                    </a>
                                </li>       -->                                                            
                                <?php }?>
                                <?php if($_SESSION['user_role']=='ethics_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
                                <li class="nav-item  ">
                                   <a href="view/ethics/reviewlist.php" class="nav-link ">
                                        <span class="title">Exception</span>
                                    </a>
                                </li>
                              <!--   <li class="nav-item  ">
                                   <a href="/freshgrc/view/ethics/Employeereviewer.php?emplyeeId=" + selectedData[0][0]" class="nav-link ">
                                        <span class="title">Review</span>
                                    </a>
                                </li> --> 

                                 <!-- <li class="nav-item">
                                    <a href="view/risk/registerRisk.php" class="nav-link">
                                       <span class="title">Risk Register</span> 
                                    </a> </li> -->
                                <!-- <li class="nav-item  ">
                                   <a href="view/lossReporting/lossListAdmin.php" class="nav-link ">
                                        <span class="title">Open Losses</span>
                                    </a>
                                </li> -->
                               <!--  <li class="nav-item  ">
                                    <a href="view/risk/riskAdmin.php" class="nav-link ">
                                        <span class="title">List</span>
                                    </a>
                                </li> -->
                               <!--  <li class="nav-item  ">
                                    <a href="view/common/riskFutureDashboard.php" class="nav-link ">
                                        <span class="title">Future</span>
                                    </a>
                                </li> -->
                               <!--  <li class="nav-item  ">
                                    <a href="view/common/riskDashboard.php" class="nav-link ">
                                      <span class="title">Dashboard</span>
                                    </a>
                                 </li> -->
                                <!--  <li class="nav-item  ">
                                    <a href="view/risk/riskReport.php" class="nav-link ">
                                        <span class="title">Reports</span>
                                    </a>
                                </li>    -->                               
                                <?php }?>
                                <?php if($_SESSION['user_role']=='ethics_approver' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
                                <li class="nav-item  ">
                                    <a href="view/ethics/approverList.php" class="nav-link ">
                                        <span class="title">Exception</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a href="view/ethics/EthicsReport.php" class="nav-link ">
                                        <span class="title">Report</span>
                                    </a>
                                </li>
                             <!--    <li class="nav-item  ">
                                    <a href="view/risk/riskreviewedlist.php" class="nav-link ">
                                        <span class="title">Report</span>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item  ">
                                    <a href="view/risk/riskAdmin.php" class="nav-link ">
                                        <span class="title">List</span>
                                    </a>
                                </li>
                               <li class="nav-item  ">
                                    <a href="view/common/riskFutureDashboard.php" class="nav-link ">
                                        <span class="title">Future</span>
                                    </a>
                                </li> -->
                                 <!-- <li class="nav-item  ">
                                   <a href="view/common/riskDashboard.php" class="nav-link ">
                                      <span class="title">Dashboard</span>
                                    </a>
                                 </li>  -->
                               <!--   <li class="nav-item  ">
                                    <a href="view/risk/riskReport.php" class="nav-link ">
                                        <span class="title">Reports</span>
                                    </a>
                                </li>    -->                               
                                <?php } }?>
                               

                                <!-- <li class="nav-item  ">
                                    <a href="view/audit/auditDashboard.php" class="nav-link ">
                                        <span class="title">Audit Dashboard</span>
                                    </a>
                                </li> -->
                                
                            </ul>
                        </li>
                        
                    </ul>



                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
        
            


















       <script type="text/javascript">
        document.getElementById("riskclkdashboard").onclick = function() {myFunction()};
        function myFunction() {
           location.href = "/freshgrc/view/common/riskDashboard.php";
        }
        </script>
         <script type="text/javascript">
        document.getElementById("auditclkdashboard").onclick = function() {myFunction1()};
        function myFunction1() {
           location.href = "/freshgrc/view/audit/auditDashboard.php";
        }
        </script>
        <script type="text/javascript">
        document.getElementById("incidentdemo").onclick = function() {myFunction2()};
        function myFunction2() {
           location.href = "/freshgrc/view/incident/incidentDashboard.php";
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
