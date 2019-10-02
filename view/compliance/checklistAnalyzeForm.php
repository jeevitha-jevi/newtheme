
     <?php

require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/compliance/clauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';

$checklistId = $_GET['checklistId'];
$userRole = $_SESSION['user_role'];
$complianceManager = new ComplianceManager();
$complianceId=1;
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
error_log("all clauses".print_r($allClauses,true));
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
         	<td><?php echo $clause['checklistScore'] ?></td> 
         	<td>
         	<div class="col-xs-2" style="width: 180px" >
                        <button class="btn btn-error btn-block" onclick="analyzeClause(<?php echo $checklist['checklistId'] ?>)"><i class="fa fa-list"></i>Analyze</button>
                    </div>
         	</td>
         	      
                   
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
	<div class="page-content-wrapper"  >

      <!-- BEGIN CONTENT BODY -->
      <div class="page-content" >
        <div class="panel" style="margin-top:60px">
          <div class="caption" style="color: #32c5d2; font-size: 16px; margin: 2%;"> <i class="fa fa-gift"></i>Compliance Package item info</div>
          <div class="row">
            <div class="col-md-12">
              <form id="form1" style="margin: 3%;margin-top: -1%;">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                    <input type="hidden" class="form-control" id="auditId">
                    <input type="hidden" class="form-control" id="action" value="create">
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" value="<?php echo $companyId?>" id="company">

                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3" >
                    <div class="form-group " >
                      <label for="auditTitle" >Treatment Strategy</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </span>
                         <select id="treatmentStrategy" class="form-control">
                      <option></option>
                      <option value="compliant">Compliant</option>
                      <option value="noncompliant">Non Compliant</option>
                      <option value="notapplicable">Not Applicable</option>
                      </select>
                      </div>
                    </div>          
                  </div>
                  <div class="col-md-3" >
                    <div class="form-group " >
                      <label for="auditTitle" >Compliance Efficacy:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="text" id="complianceEfficacy" class="form-control">
                      </div>
                    </div>          
                  </div>
                  <div class="col-md-3" >
                    <div class="form-group " >
                      <label for="auditTitle" >Mitigation Control:</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="text" id="mitigationControl" class="form-control">
                      </div>
                    </div>          
                  </div>
               
                  <div class="col-md-3">
                    <div class="form-group" >
                      <label for="auditDesc">Compliance Exceptions</label>
                      <input type="text" class="form-control"  id="complianceException" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <?php include __DIR__."/../common/controlsDropDown.php" ?>
                    
                  </div>
                
                </div>
                
               
              <div class="modal-footer" style="border-top: 1px solid #eef1f5;">
                <button type="button" class="btn purple mt-ladda-btn ladda-button btn-outline" data-style="slide-down" data-spinner-color="#333" onclick="analyze()">
                  <span class="ladda-label">
                      <i class="icon-present"></i> Save  </span>
                  <span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
                </button>
                 <button type="button" class="btn green mt-ladda-btn ladda-button btn-outline" data-style="slide-down" data-spinner-color="#333">
                  <span class="ladda-label">
                      <i class="icon-present"></i> Cancel  </span>
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