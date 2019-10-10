<?php require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/risk/riskManager.php';
require_once __DIR__.'/../../php/risk/riskMitigationManager.php';
$GLOBALS['RiskId'] = $_GET['RiskId'];
$RiskId = $_GET['RiskId'];
$riskMitigationManager = new RiskMitigationManager();  
$allPlaningStrategy = $riskMitigationManager->getAllPlaningStrategy();
$allMitigationEffort = $riskMitigationManager->getAllMitigationEffort();
$allMitigationCost = $riskMitigationManager->getAllMitigationCost();
$riskScenarioDetails = $riskMitigationManager->getRiskScenario($RiskId);
$riskScoringDetails = $riskMitigationManager->getRiskScoring($RiskId);
$risksafguardDetails = $riskMitigationManager->getsafeguard($RiskId);
$riskManager = new RiskManager();    
$allTeam = $riskManager->getAllTeam();
$allUsers = $riskMitigationManager->getAllUser();
?>
<!DOCTYPE html>
<html>

 
<head lang="en">
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Risk Mitigation</title>
  <base href="/freshgrc/">


    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>  
   
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css"/>
            <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

        <script src="assets/multiselectDropdown/bootstrap-multiselect.js" type="text/javascript"></script>  
    <link rel="stylesheet" type="text/css" href="assets/multiselectDropdown/bootstrap-multiselect.css">

    <link href="metronic/theme/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
   <!--  <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
     
    <link href="metronic/theme/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    
<!--     <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
 -->   
    <link href="assets/toggleButton/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="assets/toggleButton/bootstrap-toggle.min.js"></script>
       
    <script src="js/risk/riskManagement.js"></script>
    <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap core CSS -->
    <!-- <link href="assets/DataTables/Bootstrap-3.3.6/css/bootstrap.css" rel="stylesheet"> -->
    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
     <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">

     <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="metronic/theme/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="metronic/theme/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />

        <!-- script link  multi select-->
     <!-- <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script> -->
    
         <style type="text/css">
           .ui-datepicker-month{
            color:"black";
           }
           .ui-datepicker-year{
            color:"black";
           }

         </style>
         <!-- end -->


</head>
    <body class="with-side-menu-compact" onload="getAction()">

      <?php 
        include '../siteHeader.php';
        $currentMenu = 'riskAdmin';
        include '../common/leftMenu.php';
        $userRole = $_SESSION['user_role'];
      ?>  
      <style type="text/css">
    .page-sidebar{
         margin-top: 3%;
      }
      .page-container {
    margin: 0;
    padding: 20px 20px 0;
    position: relative;
}
.page-sidebar.navbar-collapse {
    max-height: none!important;
    position: fixed;
}
.risk-session.overview {
    padding: 15px;
    height: auto;

}
.risk-session {
    background: #F0F0F0;
    color: #3f3f3f;
    font-size: 16px;    
    line-height: 1.6;
}
.score--wrapper {
    width: 260px;
    float: left;   
}
.risk-session.overview .score {
    margin-bottom: 20px;
    margin-right: 10px;
}
.risk-session.overview .score {
    width: 120px;
    height: 120px;
    text-align: center;
    float: left;
    padding: 10px 0;
}
.details--wrapper {
    float: left;
    padding-right: 260px;
    width: 100%;
    margin-right: -260px;
}
.risk-session.overview label {
    font-size: 16px;
    font-weight: 400;
    color: #3f3f3f;
    padding: 0;
}
.risk-session.overview label span {
    font-size: 16px;
    line-height: 30px;
}
.risk-session.overview .border-top {
    border-top: 1px solid #d1d3d4;
    padding-top: 15px;
    margin-top: 15px;
}
.risk-session.overview .risk-test a {
    font-weight: bold;
    font-size: 16px;
    color: #3f3f3f;
}
table {
    font-size: 14px;
}
.score--table td {
    font-size: 16px;
    padding: 2px 0;
}
html {
    font-size: 10px;
    -webkit-tap-highlight-color: transparent;
    overflow-x: hidden;
}
.page-container {
   
    margin-top: 30px!important;
}
.form-group {
    margin-top: 15px;
}
.large-text
{
  font-size: 16px;
}
form .form-control::-webkit-input-placeholder { 
  color: #555555;
}
 
  </style>
  <body>
    <div class="page-content-wrapper">                
      <div class="page-content">                  
        <div class="row">
          <div class="col-md-12" style="margin-top:30px; ">
            <div class="portlet box green">
              <div class="portlet-title">
                <div class="caption">Risk Mitigation</div>   

              </div>  
              <div class="portlet-body ">
                <?php if($riskScoringDetails[0]['scoring_methods'] == 1 || $riskScoringDetails[0]['scoring_methods'] == 5 || $riskScoringDetails[0]['scoring_methods'] == 3){?>
                <div class="risk-session overview clearfix">
                  <div class="row-fluid">
                    <div class="score--wrapper">
                      <?php if($riskScoringDetails[0]['calculated_risk_status'] == "0"){ ?>
                      <div class="score " style="background-color: rgb(132, 183, 97);">Inherent Risk<br>
                      <?php } else if ($riskScoringDetails[0]['calculated_risk_status'] == "1") {  ?>
                    <div class="score " style="background-color:#7bea4e;">Inherent Risk<br>
                      <?php } else if ($riskScoringDetails[0]['calculated_risk_status'] == "2") {?>
                      <div class="score " style="background-color:#ee5151;">Inherent Risk<br>
                        <?php } else if ($riskScoringDetails[0]['calculated_risk_status'] == "3") {?>
                          
                                          
                            </div>
                            <div class="details--wrapper">
                              <div class="row-fluid">
                                                    
                             <!--  </div>
                              <div class="row-fluid border-top"> -->
                                <div class="span12">
                                  <div id="static-subject" class="static-subject">
                                    <div class="col-xs-4">
                                    <label><strong>Subject:</strong>
                                      <span class="large-text"><?php echo $riskScoringDetails[0]['subject'];?></span>                            
                                    </label> </div>                         
                                <!--   </div>                        
                                </div>  -->
                             <!--    <div class="span5"> -->
                               <div class="col-xs-4">
                                  <label><strong>Status:</strong>
                                    <span class="large-text status-text">Created</span>
                                  </label></div>                       
                           <!--      </div>  -->                      
                              <!-- </div>  -->
                             <!--  <div class="row-fluid border-top"> --><!-- 
                                <div class="span12">
                                  <div id="static-subject" class="static-subject"> -->
                                     <div class="col-xs-4">
                                    <label><strong>Scenario:</strong>
                                      <span class="large-text"><?php echo $riskScenarioDetails[0]['name'];?></span>                            
                                    </label>  </div>                        
                                  </div>                        
                                </div>                      
                              </div> <br><br>
                           <!--  <div class="row-fluid"> -->
                             <div class="span12" style="margin-top: 10px;">
                               <div id="static-subject" class="static-subject">
                                 <div class="col-xs-4">
                                  <label><strong>Likelihood:</strong>
                                    <span class="large-text">    <?php echo $riskScoringDetails[0]['likelihood']; ?><!-- (<?php echo $riskScoringDetails[0]['likelihood_id'];?>) -->  </span>  
                                  </label></div>
                               <!--  </div>  -->
                             <!--   </div>    -->                   
                             <!--  </div>  --> 

                              <!-- <div class="row-fluid border-top"> -->
                            <!--  <div class="span12"> -->
                              <!--  <div id="static-subject" class="static-subject"> -->
                                 <div class="col-xs-4">
                                  <label><strong>Impact:</strong>
                                    <span class="large-text">    <?php echo $riskScoringDetails[0]['impact']; ?><!-- (<?php echo $riskScoringDetails[0]['impact_id'];?>)  --> </span>  
                                  </label>
                                  </div> </div>
                                </div>  </div>  

                             <div class="score " style="background-color:red;">Inherent Risk<br>
                            <?php } ?>
                            <br>
                            <?php if($riskScoringDetails[0]['calculated_risk_status'] == "0"){
                            echo "Low";
                            }
                            else if ($riskScoringDetails[0]['calculated_risk_status'] == "1") {
                            echo "Medium";
                            }
                            else if ($riskScoringDetails[0]['calculated_risk_status'] == "2") {
                            echo "High";
                            }
                            else if ($riskScoringDetails[0]['calculated_risk_status'] == "3") {
                            echo "Extreme";
                            }?>                                          
                        </div>

                            <!--   </div>  -->
                            </div>                  
                        
                          
                          <div class="row-fluid">
                            
                            <div class="row-fluid score-container">
                              <div id="scoredetails" class="scoredetails" style="display: none;">
                                <?php                       
                                 $Likelihood = array("","Remote", "Unlikely", "Credible","Likely","Almost Certain");
                                $Impact = array("","Insignificant","Minor","Moderate","Major","Extreme/Catastrophic");
                                if($riskScoringDetails[0]['scoring_methods'] == 1)
                                {                        
                                ?>
                                <div class="well">                        
                                  <table class="score--table" cellpadding="0" cellpadding="0" style="border:none;width:100%;">
                                    <tbody>
                                      <tr>
                                        <td colspan="3">
                                          <h4 style="font-size: 17.5px;line-height: 20px;margin: 10px 0;">Classic Risk Scoring</h4>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="180">Likelihood:</td>
                                        <td width="30"><?php echo "[" .$riskScoringDetails[0]['CLASSIC_likelihood'] ."]"; ?></td>
                                        <td><?php echo $Likelihood[$riskScoringDetails[0]['CLASSIC_likelihood']];?></td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td width="180">Impact:</td>
                                        <td width="30"><?php echo "[" .$riskScoringDetails[0]['CLASSIC_impact'] ."]"; ?></td>
                                        <td><?php echo $Impact[$riskScoringDetails[0]['CLASSIC_impact']];?></td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td colspan="4">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td colspan="4"><b>RISK = ( Likelihood x Impact ) x ( 10 / 25 ) = <?php echo $riskScoringDetails[0]['calculated_risk'];?></b></td>
                                      </tr>
                                    </tbody>                          
                                  </table> 
                                </div>
                                <?php }?>

                                <?php                
                                  
                                  if($riskScoringDetails[0]['scoring_methods'] == 5)
                                  {                        
                                  ?>
                                <div class="well">                        
                                  <table class="score--table" cellpadding="0" cellpadding="0" style="border:none;width:100%;">
                                    <tbody>
                                      <tr>
                                        <td colspan="3">
                                          <h4 style="font-size: 17.5px;line-height: 20px;margin: 10px 0;">Custom Risk Scoring</h4>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="180">Manually Entered Value:</td>                              
                                        <td><?php echo $riskScoringDetails[0]['calculated_risk'];?></td>
                                        <td>&nbsp;</td>
                                      </tr>                   
                                    </tbody>                          
                                  </table> 
                                </div>
                                <?php }?> 
                                 <?php                
                                  if($riskScoringDetails[0]['scoring_methods'] == 3)
                                  {                        
                                  ?>
                                <div class="well">                        
                                  <table class="score--table" cellpadding="0" cellpadding="0" style="border:none;width:100%;">
                                    <tbody>
                                      <tr>
                                        <td colspan="3">
                                          <h4 style="font-size: 17.5px;line-height: 20px;margin: 10px 0;">DREAD Risk Scoring</h4>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="180">Damage Potential:</td>                              
                                        <td><?php echo $riskScoringDetails[0]['DREAD_DamagePotential'];?></td>
                                        <td>&nbsp;</td>
                                      </tr>  
                                      <tr>
                                        <td width="180">Reproducibility:</td>                              
                                        <td><?php echo $riskScoringDetails[0]['DREAD_Reproducibility'];?></td>
                                        <td>&nbsp;</td>
                                      </tr> 
                                      <tr>
                                        <td width="180">Exploitability:</td>                              
                                        <td><?php echo $riskScoringDetails[0]['DREAD_Exploitability'];?></td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td width="180">Affected Users:</td>                              
                                        <td><?php echo $riskScoringDetails[0]['DREAD_AffectedUsers'];?></td>
                                        <td>&nbsp;</td>
                                      </tr> 
                                      <tr>
                                        <td width="180">Discoverability:</td>                              
                                        <td><?php echo $riskScoringDetails[0]['DREAD_Discoverability'];?></td>
                                        <td>&nbsp;</td>
                                      </tr> 
                                       <tr>
                                        <td colspan="4"><b>RISK = ( <?php echo $riskScoringDetails[0]['DREAD_DamagePotential'];?> + <?php echo $riskScoringDetails[0]['DREAD_Reproducibility'];?> + <?php echo $riskScoringDetails[0]['DREAD_Exploitability'];?> + <?php echo $riskScoringDetails[0]['DREAD_AffectedUsers'];?> + <?php echo $riskScoringDetails[0]['DREAD_Discoverability'];?>  ) / 5 = <?php echo $riskScoringDetails[0]['calculated_risk'];?></b></td>
                                      </tr>                  
                                    </tbody>                          
                                  </table> 
                                </div>
                                <?php }?>                   
                              </div>                    
                            </div>
                            <div class="row-fluid score-overtime-container" style="display: none;">
                                <div class="well">
                                    <div id="socre-overtime-chart" class="socre-overtime-chart"></div>
                                </div>
                            </div>                  
                          </div>               
                        </div>
                        <?php }?>
                        <form id="form1">
                          <div class="row">
                            <div class="form-group">
                              <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                              <input type="hidden" class="form-control" id="riskId">
                              <input type="hidden" class="form-control" id="action">
                            </div>
                            <div class="col-md-4" style="margin-top: 13px;">
                               <div class="form-group" style="/*margin-left: -160px;*/margin-top: 5px;margin-left: -5px;">
                                <label for="PlanningStrategy"><strong>Planned Mitigation Date</strong></label> 
                        <div class="input-group input-large date-picker input-daterange" style=" margin-left: 6px;">
                        <input type="text" id="PlannedMitigationDate" class="form-control datepickerClass  notranslate" autocomplete="off" placeholder="yyyy/mm/dd">
                        </div>
                      </div>
                              <div class="form-group">
                                <label for="PlanningStrategy" style="margin-top: 15px;"><strong>Planning Strategy</strong></label>       
                                <div class="input-group select2-bootstrap-prepend">
                                  
                                  <select  id="PlanningStrategy" name="PlanningStrategyDropDown" class="form-control select2" >
                                    <!-- onchange="planing_mitigate()" -->

                                    
                                    <option>--Select Planning Strategy--</option>    
                                      <?php foreach($allPlaningStrategy as $strategy){ ?>
                                    <option value="<?php echo $strategy['id'] ?>"><?php echo $strategy['name'] ?></option>
                                      <?php } ?>
                                  </select>
                                  <script>

                                  </script>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                      <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span> 
                                </div>
                              </div><br>
                              <div class="form-group">
                                <label for="MitigationEffort"><strong>Mitigation Effort</strong></label>       
                                <div class="input-group select2-bootstrap-prepend">
                                  <select   id="MitigationEffort" name="MitigationEffortDropDown" class="form-control select2">
                                    <option>--Select Mitigation Effort--</option>
                                    <?php foreach($allMitigationEffort as $mitigationeffort){ ?>
                                    <option value="<?php echo $mitigationeffort['id'] ?>"><?php echo $mitigationeffort['name'] ?></option>
                                      <?php } ?>

                                  </select>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                      <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span>
                                </div>
                              </div><br>
                             
                              <!-- <div class="form-group">
                                <label for="MitigationTeam"><strong>Mitigation Team</strong></label>
                                <div class="input-group select2-bootstrap-prepend">
                                  <select id="MitigationTeam" name="MitigationTeamDropDown" class="form-control select2">
                                    <option>--Select Mitigation Team--</option>    
                                    <?php foreach($allTeam as $team){ ?>
                                    <option value="<?php echo $team['id'] ?>"><?php echo $team['name'] ?></option>
                                    <?php } ?>
                                  </select>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                      <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span>
                                </div>
                              </div> -->
                              
                            </div>
                            <div class=col-md-4>
                              <div class="form-group">
                                <label for="MitigationCost"><strong>Mitigation Cost</strong></label>       
                                <div class="input-group select2-bootstrap-prepend">
                                  <select  id="MitigationCost" name="MitigationCostDropDown" class="form-control select2">
                                    <option>--Select Mitigation Cost--</option>    
                                    <?php foreach($allMitigationCost as $mitigationcost){ ?>
                                    <option value="<?php echo $mitigationcost['id'] ?>"><?php echo $mitigationcost['pricing'] ?></option>
                                    <?php } ?>
                                  </select>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                      <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span> 
                                </div>
                              </div><br>
                              <div class="form-group">
                                <label for="MitigationOwner"><strong>Mitigation Owner</strong></label>       
                                <div class="input-group select2-bootstrap-prepend">
                                  <select id="MitigationOwner" name="MitigationOwnerDropDown" class="form-control select2">
                                    <option>--Select Mitigation Owner--</option>    
                                    <?php foreach($allUsers as $user){ ?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['last_name'] ?></option>
                                    <?php } ?>
                                  </select>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                      <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span> 
                                </div><br>
                                <div class="form-group">
                                  <label for="SecurityRecommendations"><strong>Security Recommendations</strong></label><br>
                                  <textarea maxlength="5000" rows="1" class="form-control" id="SecurityRecommendations" placeholder="--Type Recommendation--"></textarea>
                                </div>
                                <!--  <div class="form-group">
                                <label for="SupportingDocumentation"><strong>Supporting Documentation</strong></label><br>
                                <input type="file" name="SupportingDocumentation" id="SupportingDocumentation" >
                              </div> -->
                              
                              <!-- <div class="form-group">
                                <label for="SupportingDocumentation"><strong>Residual Risk Score</strong></label><br>
                                <input type="number"  class="form-control" id="mitigation_revi" readonly style="background-color: white;">
                              </div> -->
                                
                              
                              </div>

                            </div>
                            <div class="col-md-4"> 
                              <div class="form-group">
                                <label for="MitigationPercent"><strong>Mitigation Percent</strong></label>
                                <input type="number" class="form-control" id="MitigationPercent" min="1" max="100" onblur="mitigation_reviwer()" placeholder="--Type Percentage% --">
                                <input type="hidden" id="impact" value="<?php echo $riskScoringDetails[0]['impact_id'];?>" >
                                <input type="hidden" id="likelihood" value="<?php echo $riskScoringDetails[0]['likelihood_id']?>">
                             </div> <br>             
                              <div class="form-group">
                                <?php include "riskScenarioMitigation.php"; ?>
                                <input maxlength="5000" rows="3" class="form-control" id="CurrentSolution" type="hidden" style="visibility: none"/>
                              </div> <br>                           
                              <div class="form-group">
                                <label for="SecurityRequirements"><strong>Security Requirements</strong></label><br>
                                <textarea maxlength="5000" rows="1" class="form-control" id="SecurityRequirements" placeholder="--Type Security Requirements --"></textarea>
                              </div><br>
                              
                            </div>
                      <div class="row">
                         <div class="col-md-12">
                            <div class="form-group">
                              <div class="col-md-6">
                                <label for="MitigationTeam"><strong>Mitigation Team</strong></label>
                                <div class="input-group select2-bootstrap-prepend" style="width:65%;">
                                  <select id="MitigationTeam" name="MitigationTeamDropDown" class="form-control select2">
                                    <option>--Select Mitigation Team--</option>    
                                    <?php foreach($allTeam as $team){ ?>
                                    <option value="<?php echo $team['id'] ?>"><?php echo $team['name'] ?></option>
                                    <?php } ?>
                                  </select>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                      <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span>
                                </div>
                            </div>
                            </div>

                            <!-- <div class="form-group" style="margin-left: 180px;">
                                <div class="col-md-4">
                                <label for="SupportingDocumentation"><strong>Supporting Documentation</strong></label><br>
                                <input type="file" name="SupportingDocumentation" id="SupportingDocumentation" >
                              </div>
                            </div> -->
                            <div class="form-group" style="margin-left: 0px;">
                                <div class="col-md-6" style="margin-left: 420px; margin-top: -55px;">
                                <label for="SupportingDocumentation"><strong>Supporting Documentation</strong></label><br>
                                <input type="file" name="SupportingDocumentation" id="SupportingDocumentation">
                              </div>
                            </div>
                        </div>
                    </div>
                          </div>                                  
                        </form>
                        <div class="modal-footer" style="border-top: 2px solid #eef1f5; margin-top: 10px">
                          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="rejectRisk(<?php echo $RiskId ?>,'reject')">Reject Risk</button>
                          <button type="button" id="manageButton" data-dismiss="modal" class="btn btn-primary" onclick="saveRiskMitigation(<?php echo $RiskId ?>)">Accept</button>
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
    <!-- </div>
  </div>
  </div>  -->  


  <div id="Aftersafecard" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
                <div class="modal-content" style="border: 1px solid #32c5d2;">
                   <h4 class="panel-heading text-center" style=" background-color: #32c5d2;margin-top: 0px; color: #fff;" id="myModalLabel">Quantitative Analysis</h4>
                    <div class="modal-body">
                     <form id="form1">
                <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                  <div class="panel panel-default">
                    <div class="panel-heading"><b>Before Safeguard</b></div>
                    <div class="panel-body">
                      <div class="col-md-4" >
                         <div class="form-group">
                            <label>Exposure Factor (EF) <b>*</b></label>
                            <input type="number" class="form-control" id="Exposure_Asset_Before_Safeguard" value="<?php echo $risksafguardDetails[0][Exposure_Asset_Before_Safeguard]?>" onblur="SingleLossExpectancyBeforeSafeguard()" readonly >
                          </div>       
                      </div>
                      <div class="col-md-4" >
                        <div class="form-group">
                                 <label>Asset Value (AV)</label>
                                 <input type="number" value="<?php echo $risksafguardDetails[0][Asset_Value_Before_Safeguard]?>" va class="form-control" id="Asset_Value_Before_Safeguard" onblur="SingleLossExpectancyBeforeSafeguard()"  readonly>
                              </div>         
                      </div>                    
                      <div class="col-md-4" >
                        <div class="form-group">
                               <label for="sale">Single Loss Expectancy (SLE)</label>
                               <input type="number" value="<?php echo $risksafguardDetails[0][Single_Loss_Expectancy_Before_Safeguard]?>" class="form-control" id="Single_Loss_Expectancy_Before_Safeguard" value="" readonly>
                              </div>         
                      </div> 
                        <div class="col-md-6" >
                      <div class="form-group">
                               <label for="">Anualized Rate Of Ocurance (ARO)</label>
                               <input type="number" value="<?php echo $risksafguardDetails[0][Anulaized_Rate_Of_Ocurance_Before_Safeguard]?>" class="form-control" id="Anulaized_Rate_Of_Ocurance_Before_Safeguard" onblur="AnulaizedlossExpectionPrior()" readonly>
                              </div>        
                      </div>  
                       <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sale">Anualized Loss Expection (Prior)</label><input type="text" class="form-control"  id="Anualized_Loss_Expection_Before_Safeguard" value="<?php echo $risksafguardDetails[0][Anualized_Loss_Expection_Before_Safeguard]?>"  readonly >
                              </div>
                            </div>
                          </div>                     
                    </div>         
                  </div>
                </div>
              </div>  
              
            
         

               <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                  <div class="panel panel-default">
                    <div class="panel-heading"><b>After Safeguard</b></div>
                    <div class="panel-body">
                     <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Exposure Factor (EF) <b>*</b></label>
                                <input type="number" class="form-control"  id="Exposure_Asset_After_Safeguard"  onblur="SingleLossExpectancy()">
                              </div>
                            </div>
                            <div class="col-md-4">
                               <div class="form-group">
                                  <label for="">Anualized Rate Of Ocurance (ARO)</label>
                                  <input type="number" class="form-control" id="Anulaized_Rate_Of_Ocurance_After_Safeguard" onblur="AnualizedLossExpectionpost()">
                               </div>
                            </div>
                             <div class="col-md-4">
                              <div class="form-group">
                                 <label for="sale">Single Loss Expectancy (SLE)</label><input type="text" class="form-control" id="Single_Loss_Expectancy_After_Safeguard" value = ""  onblur="AnualizedLossExpectionpost()" readonly >
                              </div>
                            </div>
                          </div>                   
                     
                       <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sale">Anualized Loss Expection (Post)</label><input type="text" class="form-control"  id="Anualized_Loss_Expection_After_Safeguard" value = ""   readonly >
                              </div>
                            </div>
                       <div class="col-md-6">
                              <div class="form-group">
                               <label for="">Safeguard Value (SV)</label>
                               <input type="number" class="form-control" id="Safeguard" onblur ="NetRiskReductionBenifit()" >
                              </div>
                            </div>   
                           </div>  
                  
                    </div>         
                  </div>
                </div>
              </div> 
                          <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Net Risk Reduction Benefit (NRRB)<b></b></label>
                                <input type="number" class="form-control"  id="Net_Risk_Reduction_Benifit"  readonly>
                              </div>
                            </div>
                          <p><b>* Note:values in percentage </b></p>
                      
                      </form>
                    </div>
                    <div class="modal-footer">
                     <button type="button" class="btn" data-dismiss="modal" style="background: #32c5d2; color: #fff">Submit</button>
                  </div>
                  </div>
                </div>
             
            </div>    
  
  </body>
  </body>
  </html>
    
<script type="text/javascript">
     $(function() {
        $(".datepickerClass").datepicker();
        $('.ui-datepicker').addClass('notranslate');
    });
  </script>
