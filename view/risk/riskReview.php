<?php require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/risk/riskReviewManager.php';
$GLOBALS['RiskId'] = $_GET['RiskId'];
$RiskId = $_GET['RiskId'];
$manager = new RiskReviewManager();
$allRiskReview = $manager->getAllRiskReview();
$allRiskNextStep = $manager->getAllRiskNextStep();
$riskScoringDetails = $manager->getRiskScoring($RiskId);
$riskPlanningStrategy= $manager->getRiskPlanningStrategy($RiskId);

?>
<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>RiskReview</title>
    <base href="/freshgrc/">

    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>      
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    <script src="js/risk/riskManagement.js"></script>


    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <!-- metronic link for multiselect -->
    <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <!-- end -->
<!-- script link  multi select-->
     <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
         <script src="metronic/theme/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
         <!-- end -->
         <!-- script for highcharts -->
         <script src="https://code.highcharts.com/highcharts.js"></script>
         <script src="https://code.highcharts.com/modules/series-label.js"></script>
         <script src="https://code.highcharts.com/modules/exporting.js"></script>
         <!-- end -->



    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
    <!-- end -->

  </head>
  <style type="text/css">
    .page-sidebar{
         margin-top: 3%;
      }
.page-sidebar.navbar-collapse {
    max-height: none!important;
    position: fixed;
}
.risk-session.overview {
    padding: 15px;
    height: auto;
    margin: 30px;
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
    margin-left: 730px;
    margin-top: -3px !important;   
}
.score{
  width: 120px !important;
  height: 100px !important;
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
    font-size: 14px !important;
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
  </style>
  <body class="with-side-menu-compact" onload="getAction()">

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'riskReviwer';
        include '../common/leftMenu.php';
        $userRole = $_SESSION['user_role'];
    ?>   

   <body>
      <div class="page-content-wrapper">                
        <div class="page-content">                  
          <div class="row" >
            <div class="col-md-12" style="margin-top:40px; ">
              <div class="portlet box green">
                <div class="portlet-title">
                  <div class="caption">Review</div>                              
                </div>  
                <div class="portlet-body ">
            <?php if($riskScoringDetails[0]['scoring_methods'] == 1 || $riskScoringDetails[0]['scoring_methods'] == 5 || $riskScoringDetails[0]['scoring_methods'] == 3){?>
              <div class="risk-session overview clearfix" >
                <div class="row-fluid">
                  <div class="score--wrapper" style="height: 100px;" >
                    <?php if($riskScoringDetails[0]['calculated_risk_status'] == "0"){ ?>
                    <div class="score " style="background-color: rgb(132, 183, 97);">Inherent Risk<br>
                    <?php } else if ($riskScoringDetails[0]['calculated_risk_status'] == "1") { 
                      ?>
                     <div class="score " style="background-color: rgb(255, 183, 77);">Inherent Risk<br>
                    <?php } else if ($riskScoringDetails[0]['calculated_risk_status'] == "2") {
                    ?>
                      <div class="score " style="background-color: rgb(239, 108, 0);">Inherent Risk<br>
                    <?php } else if ($riskScoringDetails[0]['calculated_risk_status'] == "3") {
                    ?>
                      <div class="score " style="background-color: rgb(239, 108, 0);">Inherent Risk<br>
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
                      }

                      ?>                                          
                    </div>
                    <?php if($riskScoringDetails[0]['calculated_risk_status'] == "0"){ ?>
                    <div class="score " style="background-color: rgb(132, 183, 97);">Residual Risk<br>
                    <?php } else if ($riskScoringDetails[0]['calculated_risk_status'] == "1") { 
                      ?>
                     <div class="score " style="background-color: rgb(255, 183, 77);">Residual Risk<br>
                    <?php } else if ($riskScoringDetails[0]['calculated_risk_status'] == "2") {
                    ?>
                      <div class="score " style="background-color: rgb(239, 108, 0);">Residual Risk<br>
                    <?php } else if ($riskScoringDetails[0]['calculated_risk_status'] == "3") {
                    ?>
                      <div class="score " style="background-color: rgb(239, 108, 0);">Residual Risk<br>
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
                      }

                      ?>                         
                    </div>                    
                  </div>
                          <div class="details--wrapper">
                  <div class="row-fluid" >
                      <div class="span12">
                        <div id="static-subject" class="static-subject">
                          <label style="margin-left: 0px; margin-top: -8%; float: left;"><strong>Subject: </strong>
                            <span class="large-text"><?php echo $riskScoringDetails[0]['subject'];?></span>                            
                          </label>                          
                        </div>                        
                      </div>                      
                    </div>
                
                    <div class="row-fluid">
                      <div class="span5">
                        <labe style="margin-left: 200px; margin-top: -8%; float: left;"><strong>Status: </strong>
                          <span class="large-text status-text"><?php echo $riskScoringDetails[0]['status'];?></span>
                        </label>                       
                      </div>                      
                    </div>
                    <!-- <div class="row-fluid border-top">
                      <div class="span12">
                        <div id="static-subject" class="static-subject">
                          <label>Subject:
                            <span class="large-text"><?php echo $riskScoringDetails[0]['subject'];?></span>                            
                          </label>                          
                        </div>                        
                      </div>                      
                    </div>   -->
                    <div class="row-fluid">
                      <div class="span12">
                        <div id="static-subject" class="static-subject">
                          <labe style="margin-left: 400px;margin-top: -8%;float: left;"><strong>Planned Strategy: </strong>
                            <span class="large-text"><?php echo $riskPlanningStrategy[0]['name'];?></span>                            
                          </label>                          
                        </div>                        
                      </div>                      
                    </div>                   
                  </div>                  
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
              <div class="row" style="margin-left: 27px;margin-right: 27px;">
                <div class="form-group">
                  <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                  <input type="hidden" class="form-control" id="riskId">
                  <input type="hidden" class="form-control" id="action">
                </div>
                <div class="row">
                 <div class="form-group">
                  <div class="col-md-6">
                        <label><strong> Review Date: </strong><span id="reviewDate"></span></label>

                  </div>
                  </div>
                   <div class="form-group">
                  <div class="col-md-6">
                    <label><strong>Reviewer: </strong><?php echo $_SESSION['user_role']; ?></label>
                  </div></br>
                  <div class="col-md-6">
                    <div class="form-group">
                          <label for="Review"><strong>Review</strong></label>      
                        <div class="input-group select2-bootstrap-prepend">
                          <select id="review" name="reviewDropDown" class="form-control select2">
                          <option>--Select Review--</option>
                             <?php foreach($allRiskReview as $review){ ?>
                          <option value="<?php echo $review['id'] ?>"><?php echo $review['name'] ?></option>
                            <?php } ?>
                          </select>
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                              <span class="glyphicon glyphicon-search"></span>
                            </button>
                          </span>
                        </div>
                      </div></br>
                       <div class="form-group">
                    <p> <label><strong>
                      <!-- Based on your Risk Score, your next review date will be
                      <label id="reviewDate"></label>  -->
                     <!-- </br> -->
                      Would you like to use a different date instead?
                    </label> </strong></p>
                  </div>
                  <div class="form-group">
                  <div id="myRadioGroup" style="margin-top: -20px;">
                    <div class="col-md-6">
                      <input type="radio" name="date" value="nextreview" />
                      <label for="Yes">Yes</label>
                      <input type="radio" name="date" checked="checked" />
                      <label for="no">No</label>
                      <div class="span7">
                        <div id="nextreview" class="desc">
                          <label for="reviewdate"><strong>Next Review Date</strong></label>
                          <input type="date" name="next_review" class="form-control datepickerClass" id="next_review">
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                    </div>
                    <div class="col-md-6">
                  <div class="form-group">
                           <label for="NextStep"><strong>Next Step</strong></label>
                        <div class="input-group select2-bootstrap-prepend">
                         <select id="nextstep" name="nextstepDropDown"class="form-control select2">
                          <option>--Select Next Step--</option>
                          <?php foreach($allRiskNextStep as $nextstep){ ?>
                        <option value="<?php echo $nextstep['id'] ?>"><?php echo $nextstep['name'] ?></option>
                            <?php } ?>
                          </select>
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                              <span class="glyphicon glyphicon-search"></span>
                            </button>
                          </span>
                        </div>
                      </div></br>
                  <div class="form-group">
    
                      <label for="comments"><strong>Comments</strong></label>
                      <textarea class="form-control" maxlength="6000" rows="1" id="comments"></textarea>
                  </div>
                  </div>
                </div>
              </div>
            </div></br>                                     
          </form>
          <div class="modal-footer">
   
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="reviewButton" onclick="saveRiskReview(<?php echo $RiskId ?>)" data-dismiss="modal" class="btn btn-primary">Submit</button>
            </div>
         <!--  </div> -->
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
        </div>
        </div>

      <!-- Risk scoring code starts here -->
      <script></script>
    </body>
  </body>
<html>