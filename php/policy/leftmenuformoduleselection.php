<?php  
require_once __DIR__.'/policymanagers.php';
$getmoduledata=new policymanagers();
$company_name='we';
$moduleData=$getmoduledata->getmodule($company_name);
$root=$moduleData[0]['name'];
$m=explode(',',  $root);
session_start();
$_SESSION['user_role']='super_admin';?>
 <div class="page-container">
 <div class="page-sidebar-wrapper">
 <div class="page-sidebar navbar-collapse collapse" style="margin-left: 6px;width: 174px;">
<?php for($i=0;$i<count($m);$i++)
{?>
	<?php switch ($m[$i]) {
		case 'compliance':?>
		       <?php if($_SESSION['user_role']=='compliance_author' || $_SESSION['user_role']=='super_admin'){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">

                        <li class="nav-item active " id="compliancedash"  >
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <!-- <img src="assets/images/compliance.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                <span class="title">Compliance</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='compliance_author' || $_SESSION['user_role']=='super_admin' ){ ?>
                                 <li class="nav-item  ">
                                    <a href="view/common/complianceTemplate.php" class="nav-link ">
                                        <span class="title">Template</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/compliance/complianceCreateAdmin.php" class="nav-link ">
                                        <span class="title">Plan</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a href="view/compliance/complianceReviewAdmin.php" class="nav-link ">
                                        <span class="title">Review</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item  ">
                                    <a href="view/compliance/complianceAnalyzeAdmin.php" class="nav-link ">
                                        <span class="title">Analyze</span>

                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/compliance/complianceReportAdmin.php" class="nav-link ">
                                        <span class="title">Report</span>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="view/compliance/complianceDashboardList.php" class="nav-link ">
                                        <span class="title">Dashboard</span>

                                    </a>
                                    
                                </li>
                               
                                <?php } }?>
                                                                                            
                            </ul>
                        </li>
                        
                    </ul>
		    <?php break; ?>
<?php	case 'audit': ?>
		      <?php if($_SESSION['user_role']=='auditor' || $_SESSION['user_role']=='auditee' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin'  ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                    <li  id="auditclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                            <a href="javascript:;" class="nav-link nav-toggle">
                                  <!-- <img src="assets/images/audits.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                <span class="title">Audit</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='auditor' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
                                <li class="nav-item  ">
                                    <a href="view/audit/auditPlanCreate.php" class="nav-link ">
                                        <span class="title">Plan</span>
                                    </a>
                                </li>
                                
                                 <li class="nav-item  ">
                                    <a href="view/audit/auditCreateAdmin.php" class="nav-link ">
                                        <span class="title">KickOff</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/audit/auditPerformAdmin.php" class="nav-link ">
                                        <span class="title">Review</span>

                                    </a>
                                </li>
                               
                                 <li class="nav-item  ">
                                    <a href="view/audit/auditPublished.php" class="nav-link ">
                                        <span class="title">Reports</span>

                                    </a>
                                </li>
                                <?php }?>
                                <?php if($_SESSION['user_role']=='auditee' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
                                
                               
                                <li class="nav-item  ">
                                    <a href="view/audit/auditPrepareAdmin.php" class="nav-link ">
                                        <span class="title">Respond</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/audit/auditReturnAdmin.php" class="nav-link ">
                                        <span class="title">FollowUp</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a href="view/audit/auditPublished.php" class="nav-link ">
                                        <span class="title">Reports</span>

                                    </a>
                                </li>
                                <?php } }?>                                                         
                            </ul>
                        </li>
                        
                    </ul>
		<?php	break; ?>

	<?php	case 'risk': ?>
		           <?php if($_SESSION['user_role']=='risk_owner' || $_SESSION['user_role']=='risk_mitigator' || $_SESSION['user_role']=='risk_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                        <li id="riskclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >
                            <a href="javascript:;" class="nav-link nav-toggle">
                              <!-- <img src="assets/images/risk.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                <span class="title">Risk</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='risk_owner' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>

                                <li class="nav-item  ">
                                    <a href="view/risk/riskPlan.php" class="nav-link ">
                                        <span class="title">Plan</span>
                                    </a>
                                </li> 
                                <li class="nav-item  ">
                                    <a href="view/risk/riskAdmin.php" class="nav-link ">
                                        <span class="title">List</span>
                                    </a>
                                </li>  
                             
                                <li class="nav-item  ">
                                    <a href="view/risk/incidentList.php" class="nav-link ">
                                        <span class="title">Incident as Risk</span>
                                    </a>
                                </li> 
                                                                             
                                <?php }?>
                                <?php if($_SESSION['user_role']=='risk_mitigator' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
                                <li class="nav-item  ">
                                   <a href="view/risk/riskcreatedlist.php" class="nav-link ">
                                        <span class="title">Mitigate</span>
                                    </a>
                                </li> 

                                 <li class="nav-item">
                                    <a href="view/risk/registerRisk.php" class="nav-link">
                                       <span class="title">Risk Register</span> 
                                    </a> </li>
                                                       
                                <?php }?>
                                <?php if($_SESSION['user_role']=='risk_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                
                                <li class="nav-item  ">
                                    <a href="view/risk/riskmitigatedlist.php" class="nav-link ">
                                        <span class="title">Review</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="view/risk/riskreviewedlist.php" class="nav-link ">
                                        <span class="title">Report</span>
                                    </a>
                                </li>
                                                        
                                <?php } }?>                                                 
                            </ul>
                        </li>
                        
                    </ul>
		<?php	break; ?>

		<?php case 'policy': ?>
		           <?php if($_SESSION['user_role']=='policy_owner' || $_SESSION['user_role']=='policy_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' || $_SESSION['user_role']=='policy_approver' ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                        <li id="policyclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                            <a href="javascript:;" class="nav-link nav-toggle">
                               <!--  <img src="assets/images/policy.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                <span class="title">Policy</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">

                                <?php if($_SESSION['user_role']=='policy_owner' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                          
                                 <li class="nav-item  ">
                                    <a href="view/policy/policyPlan.php" class="nav-link ">
                                        <span class="title">Plan</span>
                                    </a>
                                </li> 
                                <li class="nav-item  ">
                                    <a href="view/policy/policyAdmin.php" class="nav-link ">
                                        <span class="title">List</span>
                                    </a>
                                </li>                                
                                <li class="nav-item  ">
                                    <?php require_once __DIR__.'/../../php/policy/policyManager.php';
                                        $policyManager = new PolicyManager();
                                        $expiredCount = $policyManager->getExpiredPolicyNumber();
                                        ?>
                                    <a href="view/policy/policyExpired.php" class="nav-link ">
                                        <span class="title">Expired Policies <span class="badge"><?php echo $expiredCount[0]["count"];?></span></span>
                                    </a>
                                </li>
                    
                                <?php }?>
                                <?php if($_SESSION['user_role']=='policy_reviewer'){ ?>
                                
                                <li class="nav-item  ">
                                    <a href="view/policy/policyAdmin.php" class="nav-link ">
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
		<?php	break; ?>

	<?php case 'asset': ?>
		         <?php if($_SESSION['user_role']=='asset_owner' || $_SESSION['user_role']=='asset_custodian' || $_SESSION['user_role']=='asset_reviewer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                        <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">
                            <li class="nav-item active open" >                           
                            <li id="assetclkdashboard" class="nav-item  <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                                <a href="javascript:;" class="nav-link nav-toggle">
                                   <!-- <img src="assets/images/asset.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                    <span class="title">Asset</span>
                                    <span class="arrow"></span>
                                </a>
                                <nav class="navigation">
                                <ul class="mainmenu">

                                    <?php if($_SESSION['user_role']=='asset_owner'){ ?>

                                    <li class="nav-item ">
                                        <a href="view/asset/assetPlanCreate.php" class="nav-link ">
                                            <span class="title">Create</span>
                                        </a>
                                    </li> 
                                    <li class="nav-item  ">

                                        <a href="view/asset/assetAdmin.php?str=all" class="nav-link ">
                                            <span class="title">List</span>

                                        </a>                                                                    
                                             </li>                     
                                    <?php }?>
                                     <?php if($_SESSION['user_role']=='asset_custodian'){ ?> 

 <li class="nav-item" style="list-style-type: none;">
                                        <a href="view/asset/assetAdmin.php" class="nav-link ">
                                            <span class="title">List</span>
                                        </a>
                                    </li> 

                                     <li class="nav-item" style="list-style-type: none;">
                                        <a href="view/asset/assetAssessmentReturned.php" class="nav-link ">
                                            <span class="title">Assesment Returned</span>
                                        </a>
                                    </li>       
                                   <li class="nav-item" style="list-style-type: none;">
                                        <a href="view/asset/assetReviewReturned.php" class="nav-link ">
                                            <span class="title">Review Returned</span>
                                        </a>
                                    </li>      
                                                                            
                                    <?php }?>
                                   
                                    <?php if($_SESSION['user_role']=='asset_reviewer'){ ?>

                                    <li class = "nav-item">
                                    <a href = "view/asset/assetReviewAdmin.php" class ="nav-link">
                                    <span class="title">Review</span>
                                    </a>
                                    </li>  
                                    <li class="nav-item  ">
                                        <a href="view/asset/assetReportAdmin.php" class="nav-link ">
                                            <span class="title">Report</span>
                                        </a>
                                    </li> 
                                                                 
                                    <?php } }?>                              
                            </ul>
                        </li> 
                          
                    </ul>
</nav>
		<?php	break; ?>

	<?php	case 'disaster': ?>
		        <?php if($_SESSION['user_role']=='disaster_owner' || $_SESSION['user_role']=='disaster_tester' || $_SESSION['user_role']=='disaster_trainer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin'  ){ ?>
                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">


                        
                        <li id="drclkdashboard" class="nav-item<?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                            <a href="view/disaster/disasterDashboard.php" class="nav-link ">
                                <!--  <img src="assets/images/dr.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->

                                <span class="title">Disaster</span>

                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if($_SESSION['user_role']=='disaster_owner'){?>
                                <li class="nav-item  ">

                                    <a href="view/disaster/disasterPlan.php" class="nav-link ">
                                        <span class="title">Plan</span>
                                    </a>
                                </li>
                                <?php } ?>
                                
                                <?php if($_SESSION['user_role']=='disaster_tester'){?>
                                <li class="nav-item  ">
                                    <a href="view/disaster/disasterTestList.php" class="nav-link ">
                                        <span class="title">Strategy</span>
                                    </a>
                                </li>
                                <?php } ?>

                                <?php if($_SESSION['user_role']=='disaster_trainer'){?>
                                 <li class="nav-item  ">
                                    <a href="view/disaster/disasterTrainingList.php" class="nav-link ">
                                        <span class="title">Training</span>

                                    </a>
                                </li>
                                <?php } ?>
                                <li class="nav-item  ">
                                    <a href="view/disaster/disasterReportlist.php" class="nav-link ">
                                        <span class="title">Report</span>
                                    </a>
                                </li>
                                  <?php if($_SESSION['user_role']=='disaster_owner'){ ?>
                                 <li class="nav-item  ">
                                    <a href="view/disaster/disasterlist.php" class="nav-link ">
                                        <span class="title">List</span>
                                    </a>
                                </li>
                                <?php } }?>
                                
                                
                            </ul>
                        </li>
                        
                    </ul>
		<?php	break; ?>

	<?php case 'bcpm': ?>
		         <?php if($_SESSION['user_role']=='bcpm_planner' || $_SESSION['user_role']=='bcpm_maintainer' || $_SESSION['user_role']=='bcpm_tester'|| $_SESSION['user_role']=='bcpm_implementer' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                        <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="false" data-slide-speed="200">

                            <li id="bcpmclkdashboard" class="nav-item <?php if($_SESSION['user_role']!='super_admin') echo ' '.'active open' ?>" >

                                <a href="javascript:;" class="nav-link nav-toggle">
                                 <!--   <img src="assets/images/bcpm.png" style="height: 20px;margin-top: -3px; margin-left: -3px;"> -->
                                    <span class="title">BCPM</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">

                                    <?php if($_SESSION['user_role']=='bcpm_planner' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>

                                    <li class="nav-item  ">
                                        <a href="view/bcpm/prePlan.php" class="nav-link ">
                                            <span class="title">Pre Plan</span>
                                        </a>
                                    </li> 
                                    <li class="nav-item  ">
                                        <a href="view/bcpm/bcpmCreateAdmin.php" class="nav-link ">
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
                                            <span class="title">Maintenance</span>
                                        </a>
                                    </li>                                
                                    <?php }?>
                                    <?php if($_SESSION['user_role']=='bcpm_tester' || $_SESSION['user_role']=='companyadmin' || $_SESSION['user_role']=='super_admin' ){ ?>
                                    
                                    <li class="nav-item  ">
                                        <a href="view/bcpm/bcpmExerciseAdmin.php" class="nav-link ">
                                            <span class="title">Exercise</span>
                                        </a>
                                    </li>                                
                                    <?php } }?>                              
                            </ul>
                        </li>    
                    </ul>
		<?php	break;	?><?php	
	}
	
 }?>
 </div>
 </div><?php        
?>

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

