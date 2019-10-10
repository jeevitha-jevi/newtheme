<?php
require_once __DIR__.'/../header.php'; 
require_once __DIR__.'/../../php/compliance/clauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';

$userRole=$_SESSION['user_role'];
$complianceId=$_GET['complianceId'];
$complianceManager = new ComplianceManager();
$complianceData = $complianceManager->getComplianceData($complianceId, $userRole);
$complianceName = $complianceData['complianceName'];
$clauseManager = new ClauseManager();
$GLOBALS['clauseAnalysis'] = $clauseManager->getChecklistAnalyzeDetail($complianceId);
$allClauses = $clauseManager->getAllClauses($complianceData);
error_log("clause data".print_r($allClauses,true));
//echo json_encode($allClauses);

function sum($clause){
    if($clause['subClauses']!=null){
        foreach($clause['subClauses'] as $subClause)
        {
        sum($subClause);
    }
}
else{
    foreach($clause['checklists'] as $checklist)
    {
    	error_log("efficacy".print_r($GLOBALS['efficacy'],true));
    	 foreach($GLOBALS['clauseAnalysis'] as $clauseAnalysed){
    	 	if($clauseAnalysed['checklist_id']==$checklist['checklistId'])
    	 	{
    	 	$GLOBALS['efficacy']=$GLOBALS['efficacy']+$clauseAnalysed['compliance_efficacy'];
    	 	$GLOBALS['totalEfficacy']=100+$GLOBALS['totalEfficacy'];

    	 	break;
    	 }
    	 else{

    	 }
    	}
}
}
}


function tabledata($clause){ 
     
     ?>     
            <tr>
                <td><?php echo $clause['orderNumber'] ?></td>
                <td><?php echo $clause['clauseName'] ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

    
    
       <?php  
        if($clause['subClauses']!=null){
            
            ?>
            
            
        
        <?php 
            foreach($clause['subClauses'] as $subClause)
            {
        tabledata($subClause);            
        } }

        else{
            

          
            foreach($clause['checklists'] as $checklist){
              
                 error_log("Score: ".print_r($GLOBALS['checklistWeight'],true));
                                ?>
               
                <tr>
                <td></td>
                <td></td>
                <td><?php echo $checklist['checklistDesc'] ?></td>
                <td>
                <?php 

                foreach($GLOBALS['clauseAnalysis'] as $clauseAnalysed){
                	error_log("clause: ".print_r($clauseAnalysed,true));
                		if($clauseAnalysed['checklist_id']==$checklist['checklistId']){
          	      			//$GLOBALS['efficacy']=$GLOBALS['efficacy']+$clauseAnalysed['compliance_efficacy'];
          	      			?>

                			   <?php echo $clauseAnalysed['compliance_efficacy']?>

                <?php		
                			break;
            }
                		else{
                			?>
                			
                		<?php
                		}
                }
                ?>
                </td>
             
                <td><?php echo $checklist['checklistScore'] ?></td>
                <td></td>
                
                <td></td>
                
            </tr>
        
 <?php   }
    }

    }

 
?>


<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Report</title>
    <base href="/freshgrc/">
    
        <link href="metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="metronic/theme/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="metronic/theme/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
             <script src="metronic/theme/assets/pages/scripts/table-datatables-responsive.js" type="text/javascript"></script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="metronic/theme/assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="metronic/theme/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>

        <link href="metronic/theme/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="metronic/theme/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
       <!-- <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" /> -->
        <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
        <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>   
        <script type="text/javascript" src="assets/DataTables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/dataTables.buttons.min.js"></script> 
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.flash.min.js"></script> 
        <script type="text/javascript" src="assets/DataTables/pdfmake.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/pdfmake-0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.min.js"></script>
        <script src="js/compliance/clauseReportManagement.js"></script>
     
</head>



<body>
  <?php 
 foreach($allClauses as $clause){
    sum($clause);
 }
   ?>		
<div id="content">
<!-- 
  <button class="btn" id="cmd" style="margin-left:89%;margin-top: 1%;color: #fff;
    margin-bottom: -1%;background-color: rebeccapurple;" onclick="getPdf()">PDF</button> -->
    <!-- <div class="row" style="margin-left: 1%;margin-top: 1%;"> -->
        <!-- <div class="row">
              <div class="col-md-6 col-sm-6"> -->
    <button class="btn" style="margin-left:1%;margin-top: -1%;color: #fff;
    margin-bottom: -1%;background-color: rebeccapurple;float:left;" onclick="goBack()"  >Go Back</button>
    <img src="pdfimage.png" class="responsive" id="cmd" style="width: 70px;height: 36px;margin-left:95%;margin-top: -1%;float:right;" onclick="getPdf()">
  <script>

      function goBack()
       {
        window.history.back();
        }
      </script>
<!--     </div> -->
  <!-- </div>/ -->
  <div id="element-to-print">

      <div class="container-fluid" style="margin-top: 30px;">
        <div class="row">
              <div class="col-md-4 col-sm-6">
                  <div class="dash-notification">
                      <div class="notification-body" style="background-color: #3598dc;width: 470px;height: 96px;">
                         <i class="fa fa-tasks" aria-hidden="true"></i>
                          <div class="header-align">
                              <p>Total Score:<?php echo  $GLOBALS['efficacy']?></p>
                              <a ui-sref="home.list"><h4 id="reg_users" style="color:#fff"><?php echo $GLOBALS['efficacy']?></h4></a>
                          </div>
                      </div>
                    </div>
              </div>
              <div class="col-md-4 col-sm-6">
                  <div class="dash-notification">
                      <div class="notification-body" style="background-color: #f2784b;width: 470px;height: 96px;">
                          <i class="fa fa-balance-scale" aria-hidden="true"></i>
                          <div class="header-align">
                              <p>Total Checklist Weight:<?php echo $GLOBALS['totalEfficacy']?></p>
                              <a ui-sref="home.list"><h4 id="due" style="color: #fff"><?php echo $GLOBALS['totalEfficacy']?></h4></a>
                          </div>
                      </div>
                      
                  </div>
              </div>
              <div class="col-md-4 col-sm-6">
                  <div class="dash-notification">
                      <div class="notification-body" style="background-color: #cb5a5e;width:470px;height: 96px;">
                          <i class="fa fa-tasks" aria-hidden="true"></i>
                          <div class="header-align">
                              <p> Overall Efficacy Percent:<?php echo $GLOBALS['efficacy'] ."/".$GLOBALS['totalEfficacy']?></p>
                            <a ui-sref="home.list"><h4 id="delay" style="color: #fff"><?php echo round($GLOBALS['efficacy']/$GLOBALS['totalEfficacy']*100,2)?></h4></a>
                          </div>
                      </div>
                     
                  </div>
              </div>
          </div>
      </div><br>
          <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                <!--     <i class="fa fa-globe"></i> --><?php echo $complianceName?></div>
                                    
                                </div>
                                <div class="portlet-body">
                                  <style>
                                  #report_wrapper
                                  {
                                    margin-top: 40px;
                                  }
                                </style>
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"  cellspacing="0" width="100%" id="report">

                                        <thead>
                                            <tr>
                                            <th>Domain Number</th>
                                            <th>Domain</th>
                                            <th>Controls</th>
                                            <th>Control Efficacy</th>
                                            <th>Control Weightage</th>
                                            <th>Mapped Control</th>
                                            <th>Mitigation Control</th>
                                           

                                            </tr>
                                        </thead>
                                        <tbody>
                        				 <?php 
                                      foreach ($allClauses as $clause) {
                                       tabledata($clause);
                                      }
                                          
                                      ?>		
                        		
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>

                </div>
</div>
  <!--   <div class="clearfix"> </div>
      -->
                    <!-- <div class="row"> -->
                     

  </body></html>

