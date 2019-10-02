<?php

require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/compliance/clauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';

$complianceId = $_GET['complianceId'];
$userRole = $_SESSION['user_role'];
$complianceManager = new ComplianceManager();
$complianceData = $complianceManager->getComplianceData($complianceId, $userRole);
$complianceName = $complianceData['complianceName'];
$version = $complianceData['version'];
$clauseManager = new ClauseManager();
$allClauses = $clauseManager->getAllClauses($complianceData);
$accordionId = $complianceId;
$isViewOnly = $complianceData['isViewOnly'];
$isActive = $complianceData['isActive'];
$complStatus = $complianceData['status'];
$GLOBALS['workingStatus'] = $complianceData['workingStatus'];
error_log("all clauses".print_r($GLOBALS['workingStatus'],true));
function tabledata($clause){ 
     error_log("clause: ".print_r($clause,true));
     ?>     


    
    
       <?php  
        if($clause['subClauses']!=null){
            ?>
             <tr>
            <td hidden></td>
           <td ><?php echo $clause['clauseName'] ?></td>
           
           <td></td>
           <td></td>
           <td></td>
                
                
            </tr>
                               
           
            
           
            
            
        
        <?php 
            foreach($clause['subClauses'] as $subClause)
            {
        tabledata($subClause);            
        } }

        else{
            /*array_push($GLOBALS['allClausesArray'],$clause['clauseId']);*/
            foreach($clause['checklists'] as $checklist){
            ?>
                <tr>
            <td hidden></td>
            <td></td>
            <td><?php echo $checklist['checklistDesc'] ?></td>
            <td><?php echo $checklist['checklistScore'] ?></td> 
            <td>
            <div class="col-xs-2" style="width: 180px" >
                        <button class="btn btn-error btn-block" onclick="analyzeClause(<?php echo $checklist['checklistId'] ?>)"><i class="fa fa-list"></i>Analyze</button>
                    </div>
            </td>
                  
                   
            </tr>
            <!-- /////////////////////////////////////// -->
            

  <!-- Modal -->
  
  

           
            

          
          
               
        
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
    <title>Fresh GRC Admin</title>
    <base href="/freshgrc/">    

    
     <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <!-- <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script> -->
    <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>  
    <script type="text/javascript" src="assets/DataTables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/dataTables.buttons.min.js"></script> 
           <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.flash.min.js"></script> 
        <script type="text/javascript" src="assets/DataTables/pdfmake.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/pdfmake-0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="assets/DataTables/Buttons-1.2.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>    
     <script src="js/compliance/checklistAnalyzeManagement.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.jqueryui.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.foundation.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.semanticui.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.4/css/fixedColumns.dataTables.min.css">



     <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css"/> 
       <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
       <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script>
       <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
       <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.foundation.min.js"></script>
       <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.jqueryui.min.js"></script>
       <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.semanticui.min.js"></script>
       <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script>
       <!-- <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script> -->
                <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
             <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.jqueryui.min.css">

        <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
         <script src="metronic/theme/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

    

    <style>
        #viewdata {

            margin-left: 308px;
            margin-right: 75px;
            margin-bottom: 55px;
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

        .panel-heading h3 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: normal;
            width: 75%;
            padding-top: 8px;
        }
        
        .ui-datepicker { position: relative; z-index: 10000 !important; }        
 .dataTables_wrapper .dt-buttons {
    float: right;
    margin-top: -2px;
    margin-right: 15px;
}
.dataTables_filter {
    float: right;
    margin-top: 31px;
    margin-right: -292px;
        display: none;
}
div.dataTables_wrapper div.dataTables_paginate {
    margin: 0;
    white-space: nowrap;
    text-align: right;
    display: none;
}
div.dataTables_wrapper div.dataTables_info {
    padding-top: 8px;
    white-space: nowrap;
    display: none;
}
div.dt-buttons {
        clear: both;
    }
    .slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 25%;
    height: 15px;
    border-radius: 5px;
    background: #337ab7;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #adb7be;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
} 
    </style>

</head>




<body    >

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
        include '../common/leftMenu.php';
    ?>
</body>
<body>
     <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                  
                    <div class="row">
                        <div class="col-md-12">
                         <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption"><?php echo $complianceName?> </div>
                                   <!--  <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                        <a href="javascript:;" class="remove"> </a>
                                    </div> -->
                                </div>
    
      <!--   <div id="viewdata" class="panel" style="margin-left: 10%;" >
        <div class="panel-heading text-center" style=" background-color: #5bc0de;     ">My Audits
 
       </div> -->
          <div class="portlet-body ">
            <?php if($_SESSION['user_role'] == 'auditor') {?>
               <!--  <div class="col-xs-2" id="create1">
                    <button class="btn btn-warning btn-block" style="background-color: #aa66ce" 
                    onclick="window.location.href='/freshgrc/view/audit/auditPlanCreate.php'"><i class="fa fa-user"></i> Create Audit</button>
                </div>
                <div class="col-xs-2" id="publishAudit">
                    <button class="btn btn-warning btn-block " style="background-color: #aa66ce" 
                    onclick="publishAuditList()"><i class="fa fa-user"></i>Published Audits</button>
                </div> -->
            <?php }?>
            
               
           
            

            
                <div class="row">
                <div class="col-md-11" >
                 </div>
                <!-- <div class="co1-md-2"></div> -->

                <div class="col-md-1" style="padding-left:0px"> <button class="btn yellow mt-ladda-btn ladda-button btn-outline " style="float:right; margin-bottom: 19px;" onclick="saveComplStatus(false)" <?php if($workingStatus!="prepare pending") echo "style='display:none'" ?>><i class="fa fa-file"></i> Complete</button> </div>
            </div>
             
         


  
    

   <table id="report" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >

            
                
                <?php
                error_log("all clause".print_r($allClauses,true)); 
                
                foreach($allClauses as $clauses)
                {
                    ?>
                    <thead>
                       
                    
                    <tr>
                        <th hidden>Control Id</th>
                        <th>Control Set </th>
                        <th>Control</th>
                        <th>Control Weightage</th>
                        <th>Analyze</th>                       
                     

                       
                       </tr>
                      </thead> 

                <tbody>    
                    
                <?php
                    
               
                 tabledata($clauses);
                }
            

            ?>

            
                </tbody>
            </table>
        </div>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-gift"></i>Compliance Package item info</h4>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">
              <form id="form1" style="margin: 3%;margin-top: -1%;">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                    <input type="hidden" class="form-control" id="auditId">
                    <input type="hidden" class="form-control" id="action" value="create">
                    <input type="hidden" class="form-control" id="currentWorkingStatus" value="published">
                    <input type="hidden" class="form-control" id="complianceId" value="<?php echo $complianceId ?>">
                    <input type="hidden" class="form-control" id="complianceId" value="<?php echo $complianceId ?>">
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" value="<?php echo $companyId?>" id="company">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" >
                    <div class="form-group " >
                      <label for="auditTitle" >Treatment Strategy</label>
                      

                        <div class="btn-group" id="treatmentStrategy">
                          <button type="button" id="Compliant"   class="btn btn-success" onclick="treat('Compliant')" value="Compliant">Compliant</button>
                          <button type="button" id="Non Compliant" class="btn btn-danger" onclick="treat('Non Compliant')" value="Non Compliant">Non Compliant</button>
                          <button type="button" id="Not Applicable" class="btn btn-info" onclick="treat('Not Applicable')" value="Not Applicable">Not Applicable</button>
                        </div>
                        
                      
                    </div>          
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" >
                    <div class="form-group " >
                      <label for="auditTitle" ><br>Compliance Efficacy:<br><br></label>
                      <!-- <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </span> -->
                        <?php $score=50; ?>

                   <div class="slidecontainer">
                      <input type="range" style="display: block;width: 41%;margin-top: -6px;margin-left: 98px;"  min="1" max="100"  value="50" class="slider" id="complianceEfficacy" name="auditorScoreDropDown" class="form-control"  onchange="<?php echo 'updateScore()'?>">
                    <p id="scoreAnalyze"  style="margin-top: -7px;margin-left: 108px;"><?php echo $score ?></p>
                   </div> 
                    </div>             
                  </div>
              </div>
              <div class="row">
              <div class="col-md-12">
                  <div class="col-md-6" >
                    <div class="form-group " >
                      <!-- <label for="auditTitle" >Standards:</label> -->
                        <?php include '../compliance/mitigationControlComplianceDropDown.php';?>
                    </div>          
                  </div>
               
                  <div class="col-md-6">
                    
                 <div class="form-group" >
                      <!-- <label for="auditDesc">Compliance Exceptions</label> -->
                      <?php include '../common/projectDropDown.php' ?>
                    </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <!-- <div class="col-md-6" >
                    <div class="form-group " >
                      <label for="auditTitle" >Mitigation Control:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="text" id="mitigationControl" class="form-control">
                      </div>
                    </div>          
                  </div> -->
                  <div class="form-group" >
                      <!-- <label for="auditDesc">Mitigation Control:</label> -->
                      <div id="controlsDrop">
                      <?php include '../common/controlsDropDown.php' ?>
                    </div>
                </div>
               
                  <!-- <div class="col-md-6"> -->
                   
                  <!-- </div> -->
              </div>
          </div>
                
                </div>
                
               
              <div class="modal-footer" style="border-top: 1px solid #eef1f5;">
                <button type="button" class="btn purple mt-ladda-btn ladda-button btn-outline" data-style="slide-down" data-spinner-color="#333" onclick="analyze()">
                  <span class="ladda-label">
                      <i class="fa fa-save"></i> Save  </span>
                  <span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
                </button>
                 
              </div>  
          <input type="hidden" id="checklistId" value="<?php echo $checklistId ?>">  
          </div>
        </div>
          
       </div>
       
      </div>
      
    </div>
  </div>
</body>
</html>
<script>
        var allClauses=<?php echo json_encode($GLOBALS['allClausesArray'])?>;
        

    </script> 
     <script type="text/javascript">
        /*$(document).ready(function() {
    $('#report').DataTable({
       

            buttons: [
                { extend: 'print', className: 'btn dark btn-outline' },
                { extend: 'copy', className: 'btn red btn-outline' },
                { extend: 'pdf', className: 'btn green btn-outline' },
                { extend: 'excel', className: 'btn yellow btn-outline ' },
                { extend: 'csv', className: 'btn purple btn-outline ' },
                { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
            ],
            "pageLength": 10000,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
              "ordering": false
        
    });
   

} );*/
    </script>
<?php

?>