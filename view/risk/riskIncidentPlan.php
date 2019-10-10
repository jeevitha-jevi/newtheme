<?php require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/company/companyManager.php';
require_once __DIR__.'/../../php/risk/riskManager.php';
$manager=new CompanyManager();
$id=$manager->getCompanyIdForUser($_SESSION['user_id']);
$companyId=$id[0]['id'];
$incidentId=$_GET['incidentId'];
$riskManager=new RiskManager();
$incidentData=$riskManager->getIncidentData($incidentId);
?>
<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fresh GRC Risk</title>
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
        <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
         <script src="metronic/theme/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css"> 
  </head>
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
.panel-primary {
    border-color: #32c5d2;
  margin-top: 20px;
    width: 98%;
    margin:auto;
    background-color: #32c5d2;
    margin-top: 20px;
}
.panel-success
{
background-color: #32c5d2; 
color:white; 
}
.button
{
  margin-left: 46%;
  color:white;
  background-color:#32c5d2;
  border:none; 
  margin-top: 8px;
  border-radius: 24px;
  height:35px;
  width: 95px;
}
label
{
  font-family: "Open Sans",sans-serif;
  font-size: 14px !important;
  font-weight: 500px;
}
.form-group {
    margin-bottom: 18px;
}
/*#Single_Loss_Expectancy_Before_Safeguard,#Anualized_Loss_Expection_Before_Safeguard,#Single_Loss_Expectancy_After_Safeguard,#Anualized_Loss_Expection_After_Safeguard 
*/{
  border:none;
  /*cursor:text;*/
}
.modal-footer
{
  margin-top: 20px;
}
</style>
<body class="with-side-menu-compact" onload="getAction()">

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'riskAdmin';
        include '../common/leftMenu.php';
        $userRole = $_SESSION['user_role'];
    ?>   

  <body class="dataTables">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary" style="border-color:#32c5d2;width: 125%;">
            <div class="panel-heading"  style="background-color: #32c5d2;font-size: 18px !important;">Plan Risk</div>
              <div class="panel-body">              
                <form id="form1">
                <div class="row">
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                    <input type="hidden" class="form-control" id="riskId">
                    <input type="hidden" class="form-control" id="action">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="subject">Subject</label>
                      <input type="text" class="form-control" id="riskSubject" disabled value="<?php echo $incidentData[0]['Title'] ?>">
                      <input type="hidden" value="<?php echo $companyId?>" id="company">
                      <input type="hidden" value="<?php echo $incidentId?>" id="incident">
                    </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <?php include '../risk/riskScenarioDropDown.php';?>
                </div>
                </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                  <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                    <div class="panel panel-default">
                      <!-- <div class="panel-heading"><b>General</b></div> -->
                      <div class="panel-body">
                        <div class="col-md-3">
                          <div class="form-group">
                            <?php include '../common/categoryDropDown.php';?>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group" id="subCategoryDrop">
                            <?php include '../risk/riskSubCategory.php';?>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="affectedAssets">Affected Assets</label>
                            <input type="text" class="form-control" id="affectedAssets">
                          </div>                   
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <?php include '../common/riskSourceDropDown.php';?>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div> 
                </div> 
                <div class="row">
                  <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                    <div class="panel panel-default">
                     <!--  <div class="panel-heading"><b>General</b></div> -->
                      <div class="panel-body">
                        <div class="col-md-4">
                          <div class="form-group">
                            <?php include '../common/locationDropDown.php';?>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <?php include '../common/teamDropDown.php';?>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <?php include '../common/technologyDropDown.php';?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                    <div class="panel panel-default">
                    <!--   <div class="panel-heading"><b>General</b></div> -->
                      <div class="panel-body">
                        <div class="col-md-6" style="margin-top: 10px;">
                          <div class="form-group" >
                            <?php include '../common/regulationDropDown.php';?>
                           </div>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                          <div class="form-group" id="controlDrop">
                              <?php include '../common/controlsDropDown.php';?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                    <div class="panel panel-default">
                     <!--  <div class="panel-heading"><b>User</b></div> -->
                      <div class="panel-body">
                        <div class="form-group"  style="margin-top: -18px;">
                          <?php include '../common/riskRoleDropDown.php';?>
                        </div>
                        <div class="col-md-4" style="margin-left: 360px !important;">
                          <div class="form-group">
                            <?php include '../common/additionalStakeHoldersDropDown.php';?>
                          </div>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>
                <!-- <div class="row"> 
                  <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                    <div class="panel panel-default">
                      <div class="panel-heading"><b>User</b></div>
                       <div class="panel-body"> 
                        <div class="col-md-6" style="margin-top: 10px;">    

                          <div class="form-group" >
                              <label >Risk Assesment Method</label>       
                              <div class="input-group select2-bootstrap-prepend">          
                                <select  id="model" name="riskOwnerDropDown" class="form-control select2" onchange="quanti()">
                                  <option></option>    
                                    <option value="1">Qualitative</option>
                                    <option value="2">Quantitative</option>
                                  
                                </select>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                    <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span> 
                              </div>

                              </div>


                        </div>
                      </div> -->
                    <!-- </div>
                  </div>                                                
                </div>   -->             
                <!-- <div class="row">
                 <div class="col-md-12">
                   <div class="form-group" >
                        <label for="riskAssessment"></label>
                        <textarea class="form-control" placeholder="Risk Assessment" maxlength="5000" rows="2" id="riskAssessment"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="additionalNotes"></label>
                        <textarea class="form-control" placeholder="Additional Notes" maxlength="5000" rows="2" id="additionalNotes"></textarea>
                    </div>
                  </div> 
                </div> -->
                 <div class="row" style="margin-top: -15px !important;"> 
                  <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                  <div class="col-md-4">
                  <div class="form-group">
                    <label >Risk Assesment Method</label>       
                    <div class="input-group select2-bootstrap-prepend">          
                      <select  id="model" name="riskOwnerDropDown" class="form-control select2" onchange="quanti()">
                        <option></option>    
                          <option value="1">Qualitative</option>
                          <option value="2">Quantitative</option>
                        
                      </select>
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                          <span class="glyphicon glyphicon-search"></span>
                        </button>
                      </span> 
                    </div>
                    </div>
                   </div>
               <!--  </div> -->
                                                
                            
                <!-- <div class="row"> -->
                 <!-- <div class="col-md-12"> -->
                 <div class="col-md-4">
                   <div class="form-group" >
                        <label for="riskAssessment"></label>
                        <textarea class="form-control" placeholder="Risk Assessment" maxlength="5000" rows="1" id="riskAssessment"></textarea>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="additionalNotes"></label>
                        <textarea class="form-control" placeholder="Additional Notes" maxlength="5000" rows="1" id="additionalNotes"></textarea>
                    </div>
                    </div>

                  </div> 
                  </div>  
              </form>

<div id="Quantitative_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <input type="number" class="form-control" id="Exposure_Asset_Before_Safeguard" onblur="SingleLossExpectancyBeforeSafeguard()" >
                          </div>       
                      </div>
                      <div class="col-md-4" >
                        <div class="form-group">
                                 <label style="margin-top: 20px;">Asset Value (AV)</label>
                                 <input type="number"  class="form-control" id="Asset_Value_Before_Safeguard" onblur="SingleLossExpectancyBeforeSafeguard()" >
                              </div>         
                      </div>                    
                      <div class="col-md-4" >
                        <div class="form-group">
                               <label for="sale">Single Loss Expectancy (SLE)</label>
                               <input type="number" class="form-control" id="Single_Loss_Expectancy_Before_Safeguard" value="" readonly>
                              </div>         
                      </div> 
                        <div class="col-md-6" >
                      <div class="form-group">
                               <label for="">Anualized Rate Of Ocurance (ARO)</label>
                               <input type="number" class="form-control" id="Anulaized_Rate_Of_Ocurance_Before_Safeguard" onblur="AnulaizedlossExpectionPrior()">
                              </div>        
                      </div>  
                       <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sale">Anualized Loss Expection (Prior)</label><input type="text" class="form-control"  id="Anualized_Loss_Expection_Before_Safeguard" value = ""   readonly >
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
                          <p style="margin-left: 20px;"><b>* Note:values in percentage </b></p>
                      
                      </form>
                    </div>
                    <div class="modal-footer">
                     <button type="button" class="btn" data-dismiss="modal" style="background: #32c5d2; color: #fff"">Submit</button>
                  </div>
                  </div>
                </div>
             
            </div>






<div id="Qualitative_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                <div class="modal-dialog">
                <div class="modal-content" style="border: 1px solid #32c5d2;">
                <h4 class="panel-heading text-center" style=" background-color: #32c5d2;margin-top: 0px; color: #fff;" id="myModalLabel">Qualitative Analysis</h4>
                <div class="modal-body">
                    
                    <form id="form1">
         
              <div class="form-group">
                                  <label>Frequency of Occurence Without Control</label>
                                  <select class="form-control" id="Frequency_of_Occurence_Without_Control">
                                    <option></option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                  </select>
                                </div> 
                             
                              
                                <div class="form-group">
                                  <label>Months</label>
                                  <select class="form-control" id="Months">
                                    <option></option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                  </select>
                                </div> 
                              
                                
                                  <div class="form-group">
                                    <label for="usr">Worst Case Description</label>
                                    <input type="text" class="form-control" id="Worst_Case_Description">
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Worst Case Likelihood</label>
                                    <input type="text" class="form-control" id="Worst_Case_Likelihood">
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Worst Case Financial Exposure</label>
                                    <input type="text" class="form-control" id="Worst_Case_Financial_Exposure" >
                                  </div>
                                  <div class="form-group">
                                   <?php include '../common/riskCatgories.php';?>
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Other Risk</label>
                                    <input type="text" class="form-control" id="other_risk"> 
                                  </div>                      
                                
                                
                                  <div class="form-group">
                                    <label for="usr">Typical Case Description</label>
                                    <input type="text" class="form-control" id="Typical_Case_Description" >
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Frequency of Occurence Without Control</label>
                                    <input type="text" class="form-control" id="Frequency_of_Occurence_Without_Control_two" >
                                  </div>
                                
                                
                                  <div class="form-group">
                                    <label for="usr">Frequency of Occurence With Control</label>
                                    <input type="text" class="form-control" id="Frequency_of_Occurence_With_Control" >
                                  </div>                        
                                  <div class="form-group">
                                    <label for="usr">Typical Case Likelihood</label>
                                    <input type="text" class="form-control" id="Typical_Case_Likelihood" >
                                  </div>
                                
                             
                                  <div class="form-group">
                                    <label for="usr">Typical Case Financial Exposure</label>
                                    <input type="text" class="form-control" id="Typical_Case_Financial_Exposure"> 
                                  </div>
                             
                             <div>
                             <?php include '../common/riskScoringDropDown.php'; ?>
                             </div>
                          
                        
                     </form>                        
                </div>    
                 
                
                <div class="modal-footer">
                     <button type="button" class="btn" data-dismiss="modal" style="background: #32c5d2; color: #fff"">Submit</button>
                  </div>
              </div>
              </div>
            </div>






                <div class="modal-footer" style="border-top: 2px solid #eef1f5;">
                    
                    <button type="button" id="manageButton" onclick="saveRiskPlan()" data-dismiss="modal" class="btn btn-primary">Plan</button>
                </div>
              </div>
            </div>
            <div class="modal fade" id="classicScoring" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content" style="border: 1px solid #32c5d2;">
                  <h4 class="panel-heading text-center" style=" background-color: #32c5d2;margin-top: 0px; color: #fff;" id="myModalLabel">Classic Scoring</h4>
                    <div class="modal-body">
                      <form id="form1">                             
                        <div class="form-group">
                          <?php include '../common/likelihoodDropDown.php';?>
                        </div>
                        <div class="form-group">
                          <?php include '../common/impactDropDown.php';?>
                        </div>                           
                     </form>
                    </div> 
                    <div class="modal-footer">
                       <button type="button" class="btn" data-dismiss="modal" style="background: #32c5d2; color: #fff"">Submit</button>
                    </div>                   
                  </div>
                </div>
              </div>
            <div class="modal fade" id="cvssScoring" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content" style="border: 1px solid #32c5d2;">      
                    <h4 class="panel-heading text-center" style=" background-color: #32c5d2;margin-top: 0px;color: #fff;" id="myModalLabel">Cvss Scoring</h4>
                  <div class="modal-body">
                    <form id="form1">                             
                      <div class="form-group">
                        <?php include '../common/cvssDropDown.php';?>
                      </div>                                                 
                    </form>
                    <div class="modal-footer">
                     <button type="button" class="btn" data-dismiss="modal" style="background: #32c5d2; color: #fff"">Submit</button>
                  </div>
                  </div>                    
                </div>
              </div>
            </div>
            <div class="modal fade" id="dreadScoring" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content" style="border: 1px solid #32c5d2;">      
                  <h4 class="panel-heading text-center" style=" background-color: #32c5d2;margin-top: 0px;color: #fff;" id="myModalLabel">DREAD Scoring</h4>
                  <div class="modal-body">
                    <form id="form1">                             
                      <div class="form-group">
                        <label for="damagepotential">Damage Potential</label>
                        <div class="input-group select2-bootstrap-prepend">
                          <select id="damagepotential" name="damagepotentialDropDown" class="form-control select2">
                            <option value=""></option>
                            <option value="1">1</option>                          
                            <option value="2">2</option>
                            <option value="3">3</option>                          
                            <option value="4">4</option>
                            <option value="5">5</option>                          
                            <option value="6">6</option>
                            <option value="7">7</option>                          
                            <option value="8">8</option>
                            <option value="9">9</option>                          
                            <option value="10">10</option>        
                          </select>
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                              <span class="glyphicon glyphicon-search"></span>
                            </button>
                          </span>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label for="reproducibility">Reproducibility</label>
                          <div class="input-group select2-bootstrap-prepend">
                            <select id="reproducibility" name="reproducibilityDropDown" class="form-control select2">
                              <option value=""></option>
                              <option value="1">1</option>                          
                              <option value="2">2</option>
                              <option value="3">3</option>                          
                              <option value="4">4</option>
                              <option value="5">5</option>                          
                              <option value="6">6</option>
                              <option value="7">7</option>                          
                              <option value="8">8</option>
                              <option value="9">9</option>                          
                              <option value="10">10</option>        
                            </select>
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                <span class="glyphicon glyphicon-search"></span>
                              </button>
                            </span>
                          </div>
                        </div>  
                        <div class="form-group">
                          <label for="exploitability">Exploitability</label>
                            <div class="input-group select2-bootstrap-prepend">
                            <select id="dredexploitability" name="exploitabilityDropDown" class="form-control select2">
                              <option value=""></option>
                              <option value="1">1</option>                          
                              <option value="2">2</option>
                              <option value="3">3</option>                          
                              <option value="4">4</option>
                              <option value="5">5</option>                          
                              <option value="6">6</option>
                              <option value="7">7</option>                          
                              <option value="8">8</option>
                              <option value="9">9</option>                          
                              <option value="10">10</option>        
                            </select>
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                <span class="glyphicon glyphicon-search"></span>
                              </button>
                              </span>
                            </div>
                        </div>  
                        <div class="form-group">
                          <label for="affectedusers  ">Affected Users</label>
                            <div class="input-group select2-bootstrap-prepend">
                            <select id="affectedusers" name="affectedusersDropDown" class="form-control select2">
                              <option value=""></option>
                              <option value="1">1</option>                          
                              <option value="2">2</option>
                              <option value="3">3</option>                          
                              <option value="4">4</option>
                              <option value="5">5</option>                          
                              <option value="6">6</option>
                              <option value="7">7</option>                          
                              <option value="8">8</option>
                              <option value="9">9</option>                          
                              <option value="10">10</option>        
                            </select>
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                <span class="glyphicon glyphicon-search"></span>
                              </button>
                            </span>
                          </div>
                        </div>  
                        <div class="form-group">
                          <label for="discoverability">Discoverability</label>
                            <div class="input-group select2-bootstrap-prepend">
                            <select id="discoverability" name="discoverabilityDropDown" class="form-control select2">
                              <option value=""></option>
                              <option value="1">1</option>                          
                              <option value="2">2</option>
                              <option value="3">3</option>                          
                              <option value="4">4</option>
                              <option value="5">5</option>                          
                              <option value="6">6</option>
                              <option value="7">7</option>                          
                              <option value="8">8</option>
                              <option value="9">9</option>                          
                              <option value="10">10</option>        
                            </select>
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                <span class="glyphicon glyphicon-search"></span>
                              </button>
                            </span>
                          </div>
                        </div>                                                  
                      </form>
                      <div class="modal-footer">
                       <button type="button" class="btn" data-dismiss="modal" style="background: #32c5d2;color: #fff"">Submit</button>
                      </div> 
                    </div>                    
                  </div>
                </div>
              </div>
              <div class="modal fade" id="owaspScoring" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content" style="border: 1px solid #32c5d2;">      
                    <h4 class="panel-heading text-center" style=" background-color: #32c5d2;margin-top: 0px;color: #fff;" id="myModalLabel">OWASP Scoring</h4>
                    <div class="modal-body">
                      <form id="form1"> 
                        <h4><b>Threat Agent Factors</b></h4>
                        <div class="row">
                          <div class="col-md-6">                            
                            <div class="form-group">
                              <label for="skilllevel">Skill Level</label>
                                <div class="input-group select2-bootstrap-prepend">
                                <select id="skilllevel" name="skilllevelDropDown" class="form-control select2">
                                  <option value=""></option>
                                  <option value="1">1</option>                          
                                  <option value="2">2</option>
                                  <option value="3">3</option>                          
                                  <option value="4">4</option>
                                  <option value="5">5</option>                          
                                  <option value="6">6</option>
                                  <option value="7">7</option>                          
                                  <option value="8">8</option>
                                  <option value="9">9</option>                          
                                  <option value="10">10</option>        
                                </select>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                    <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span>
                              </div>
                            </div> 
                            <div class="form-group">
                              <label for="motive">Motive</label>
                                <div class="input-group select2-bootstrap-prepend">
                                <select id="motive" name="motiveDropDown" class="form-control select2">
                                  <option value=""></option>
                                  <option value="1">1</option>                          
                                  <option value="2">2</option>
                                  <option value="3">3</option>                          
                                  <option value="4">4</option>
                                  <option value="5">5</option>                          
                                  <option value="6">6</option>
                                  <option value="7">7</option>                          
                                  <option value="8">8</option>
                                  <option value="9">9</option>                          
                                  <option value="10">10</option>        
                                </select>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                    <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">       
                            <div class="form-group">
                              <label for="opportunity">Opportunity</label>
                              <div class="input-group select2-bootstrap-prepend">
                                <select id="opportunity" name="opportunityDropDown" class="form-control select2">
                                  <option value=""></option>
                                  <option value="1">1</option>                          
                                  <option value="2">2</option>
                                  <option value="3">3</option>                          
                                  <option value="4">4</option>
                                  <option value="5">5</option>                          
                                  <option value="6">6</option>
                                  <option value="7">7</option>                          
                                  <option value="8">8</option>
                                  <option value="9">9</option>                          
                                  <option value="10">10</option>        
                                </select>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                    <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span>
                              </div>
                            </div>  
                            <div class="form-group">
                              <label for="size">Size</label>
                              <div class="input-group select2-bootstrap-prepend">
                                <select id="size" name="sizeDropDown" class="form-control select2">
                                  <option value=""></option>
                                  <option value="1">1</option>                          
                                  <option value="2">2</option>
                                  <option value="3">3</option>                          
                                  <option value="4">4</option>
                                  <option value="5">5</option>                          
                                  <option value="6">6</option>
                                  <option value="7">7</option>                          
                                  <option value="8">8</option>
                                  <option value="9">9</option>                          
                                  <option value="10">10</option>        
                                </select>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                    <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div> 
                        <h4><b>Vulnerability Factors</b></h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="easeofdiscovery">Ease of Discovery</label>
                              <div class="input-group select2-bootstrap-prepend">
                                <select id="easeofdiscovery" name="easeofdiscoveryDropDown" class="form-control select2">
                                  <option value=""></option>
                                  <option value="1">1</option>                          
                                  <option value="2">2</option>
                                  <option value="3">3</option>                          
                                  <option value="4">4</option>
                                  <option value="5">5</option>                          
                                  <option value="6">6</option>
                                  <option value="7">7</option>                          
                                  <option value="8">8</option>
                                  <option value="9">9</option>                          
                                  <option value="10">10</option>        
                                </select>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                    <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="easeofexploit">Ease of Exploit</label>
                              <div class="input-group select2-bootstrap-prepend">
                              <select id="easeofexploit" name="easeofexploitDropDown" class="form-control select2">
                                <option value=""></option>
                                <option value="1">1</option>                          
                                <option value="2">2</option>
                                <option value="3">3</option>                          
                                <option value="4">4</option>
                                <option value="5">5</option>                          
                                <option value="6">6</option>
                                <option value="7">7</option>                          
                                <option value="8">8</option>
                                <option value="9">9</option>                          
                                <option value="10">10</option>        
                              </select>
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                  <span class="glyphicon glyphicon-search"></span>
                                </button>
                              </span>
                            </div>
                            </div> 
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="awareness">Awareness</label>
                              <div class="input-group select2-bootstrap-prepend">
                                <select id="awareness" name="awarenessDropDown" class="form-control select2">
                                  <option value=""></option>
                                  <option value="1">1</option>                          
                                  <option value="2">2</option>
                                  <option value="3">3</option>                          
                                  <option value="4">4</option>
                                  <option value="5">5</option>                          
                                  <option value="6">6</option>
                                  <option value="7">7</option>                          
                                  <option value="8">8</option>
                                  <option value="9">9</option>                          
                                  <option value="10">10</option>        
                                </select>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                    <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span>
                              </div>
                            </div> 
                            <div class="form-group">
                              <label for="intrusiondetection">Intrusion Detection</label>
                              <div class="input-group select2-bootstrap-prepend">
                                <select id="intrusiondetection" name="intrusiondetectionDropDown" class="form-control select2">
                                  <option value=""></option>
                                  <option value="1">1</option>                          
                                  <option value="2">2</option>
                                  <option value="3">3</option>                          
                                  <option value="4">4</option>
                                  <option value="5">5</option>                          
                                  <option value="6">6</option>
                                  <option value="7">7</option>                          
                                  <option value="8">8</option>
                                  <option value="9">9</option>                          
                                  <option value="10">10</option>        
                                </select>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                    <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>   
                        </div>
                        <h4><b>Technical Impact</b></h4>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="lossofconfidentiality">Loss of Confidentiality</label>
                                <div class="input-group select2-bootstrap-prepend">
                                  <select id="lossofconfidentiality" name="lossofconfidentialityDropDown" class="form-control select2">
                                    <option value=""></option>
                                    <option value="1">1</option>                          
                                    <option value="2">2</option>
                                    <option value="3">3</option>                          
                                    <option value="4">4</option>
                                    <option value="5">5</option>                          
                                    <option value="6">6</option>
                                    <option value="7">7</option>                          
                                    <option value="8">8</option>
                                    <option value="9">9</option>                          
                                    <option value="10">10</option>        
                                  </select>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                      <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span>
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="lossofintegrity">Loss of Integrity</label>
                                <div class="input-group select2-bootstrap-prepend">
                                  <select id="lossofintegrity" name="lossofintegrityDropDown" class="form-control select2">
                                    <option value=""></option>
                                    <option value="1">1</option>                          
                                    <option value="2">2</option>
                                    <option value="3">3</option>                          
                                    <option value="4">4</option>
                                    <option value="5">5</option>                          
                                    <option value="6">6</option>
                                    <option value="7">7</option>                          
                                    <option value="8">8</option>
                                    <option value="9">9</option>                          
                                    <option value="10">10</option>        
                                  </select>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                      <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6"> 
                              <div class="form-group">
                                <label for="lossofavailability">Loss of Availability</label>
                                <div class="input-group select2-bootstrap-prepend">
                                  <select id="lossofavailability" name="lossofavailabilityDropDown" class="form-control select2">
                                    <option value=""></option>
                                    <option value="1">1</option>                          
                                    <option value="2">2</option>
                                    <option value="3">3</option>                          
                                    <option value="4">4</option>
                                    <option value="5">5</option>                          
                                    <option value="6">6</option>
                                    <option value="7">7</option>                          
                                    <option value="8">8</option>
                                    <option value="9">9</option>                          
                                    <option value="10">10</option>        
                                  </select>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                      <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span>
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="lossofaccountability">Loss of Accountability</label>
                                <div class="input-group select2-bootstrap-prepend">
                                  <select id="lossofaccountability" name="lossofaccountabilityDropDown" class="form-control select2">
                                    <option value=""></option>
                                    <option value="1">1</option>                          
                                    <option value="2">2</option>
                                    <option value="3">3</option>                          
                                    <option value="4">4</option>
                                    <option value="5">5</option>                          
                                    <option value="6">6</option>
                                    <option value="7">7</option>                          
                                    <option value="8">8</option>
                                    <option value="9">9</option>                          
                                    <option value="10">10</option>        
                                  </select>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                      <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div> 
                          <h4><b>Business Impact</b></h4>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="financialdamage">Financial Damage</label>
                                  <div class="input-group select2-bootstrap-prepend">
                                    <select id="financialdamage" name="financialdamageDropDown" class="form-control select2">
                                      <option value=""></option>
                                      <option value="1">1</option>                          
                                      <option value="2">2</option>
                                      <option value="3">3</option>                          
                                      <option value="4">4</option>
                                      <option value="5">5</option>                          
                                      <option value="6">6</option>
                                      <option value="7">7</option>                          
                                      <option value="8">8</option>
                                      <option value="9">9</option>                          
                                      <option value="10">10</option>        
                                    </select>
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                        <span class="glyphicon glyphicon-search"></span>
                                      </button>
                                    </span>
                                  </div>
                                </div> 
                                <div class="form-group">
                                  <label for="reputationdamage">Reputation Damage</label>
                                  <div class="input-group select2-bootstrap-prepend">
                                    <select id="reputationdamage" name="reputationdamageDropDown" class="form-control select2">
                                      <option value=""></option>
                                      <option value="1">1</option>                          
                                      <option value="2">2</option>
                                      <option value="3">3</option>                          
                                      <option value="4">4</option>
                                      <option value="5">5</option>                          
                                      <option value="6">6</option>
                                      <option value="7">7</option>                          
                                      <option value="8">8</option>
                                      <option value="9">9</option>                          
                                      <option value="10">10</option>        
                                    </select>
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                        <span class="glyphicon glyphicon-search"></span>
                                      </button>
                                    </span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6"> 
                                <div class="form-group">
                                  <label for="noncompliance">Non-Compliance</label>
                                  <div class="input-group select2-bootstrap-prepend">
                                    <select id="noncompliance" name="noncomplianceDropDown" class="form-control select2">
                                      <option value=""></option>
                                      <option value="1">1</option>                          
                                      <option value="2">2</option>
                                      <option value="3">3</option>                          
                                      <option value="4">4</option>
                                      <option value="5">5</option>                          
                                      <option value="6">6</option>
                                      <option value="7">7</option>                          
                                      <option value="8">8</option>
                                      <option value="9">9</option>                          
                                      <option value="10">10</option>        
                                    </select>
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                        <span class="glyphicon glyphicon-search"></span>
                                      </button>
                                    </span>
                                  </div> 
                                  <div class="form-group">
                                    <label for="privacyviolation">Privacy Violation</label>
                                    <div class="input-group select2-bootstrap-prepend">
                                      <select id="privacyviolation" name="privacyviolationDropDown" class="form-control select2">
                                        <option value=""></option>
                                        <option value="1">1</option>                          
                                        <option value="2">2</option>
                                        <option value="3">3</option>                          
                                        <option value="4">4</option>
                                        <option value="5">5</option>                          
                                        <option value="6">6</option>
                                        <option value="7">7</option>                          
                                        <option value="8">8</option>
                                        <option value="9">9</option>                          
                                        <option value="10">10</option>        
                                      </select>
                                      <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                          <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>                                                   
                          </form>
                          <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal" style="background: #32c5d2;color: #fff"">Submit</button>
                          </div>
                        </div>                    
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="customScoring" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content" style="border: 1px solid #32c5d2;">      
                        <h4 class="panel-heading text-center" style=" background-color: #32c5d2;margin-top: 0px;color: #fff;" id="myModalLabel">Custom Scoring</h4>
                        <div class="modal-body">
                          <form id="form1">                             
                            <div class="form-group">
                              <label for="customvalue">Custom Value</label>
                              <div class="input-group select2-bootstrap-prepend">
                                <select id="customvalue" name="customvalueDropDown" class="form-control select2">
                                  <option value=""></option>
                                  <option value="1">1</option>                          
                                  <option value="2">2</option>
                                  <option value="3">3</option>                          
                                  <option value="4">4</option>
                                  <option value="5">5</option>                          
                                  <option value="6">6</option>
                                  <option value="7">7</option>                          
                                  <option value="8">8</option>
                                  <option value="9">9</option>                          
                                  <option value="10">10</option>        
                                </select>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                                   <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span>
                              </div> 
                            </div>                                              
                          </form>
                          <div class="modal-footer">
                           <button type="button" class="btn" data-dismiss="modal" style="background: #32c5d2; color: #fff">Submit</button>
                          </div> 
                        </div>                    
                      </div>
                    </div>
                  </div> 
                </div>
              </div>    
              <script></script>
            </body>
          </body>
        </html>
    <style type="text/css">
      .row{
        margin-right: 0px;
        margin-left: 0px;
      }
      .container {
      padding-right: 10%;
      padding-left: 10%;
      margin-right: auto;
      margin-left: auto;
      margin-top: 75px;
    }