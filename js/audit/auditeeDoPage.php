
<?php 

require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/audit/auditClauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';
require_once __DIR__.'/../../php/audit/auditManager.php';

$GLOBALS['auditId'] = $_GET['auditId'];
$GLOBALS['loggedInUserRole'] = $_SESSION['user_role'];
$GLOBALS['loggedInUserId'] = $_SESSION['user_id'];
$GLOBALS['scoreAuditChecklist']=0;
$GLOBALS['checklistWeight']=0;
$GLOBALS['allClausesArray']=array();
$checklists=array();
$score=0;

$auditId = $_GET['auditId'];
$complianceId=array();
$auditManager = new AuditManager();
$workingDetailsOfAudit = $auditManager->getWorkingDetails($auditId, $loggedInUserRole);
$complianceId = explode(",",$workingDetailsOfAudit['complianceId']);

$auditStatus = $workingDetailsOfAudit['status'];
$auditTitle = $workingDetailsOfAudit['title'];
$complianceName = $workingDetailsOfAudit['complianceName'];
$version = $workingDetailsOfAudit['version'];
$GLOBALS['workingStatus'] = $workingDetailsOfAudit['workingStatus'];
$isViewOnly = $workingDetailsOfAudit['isViewOnly'];
$clauseManager = new AuditClauseManager();
for($i=0;$i<count($complianceId);$i++)
{
$allClauses[$i] = $clauseManager->getAll($complianceId[$i], $workingDetailsOfAudit);
}
error_log("complianceId".print_r($complianceId,true));
$accordionId = $complianceId;  
$GLOBALS['capa']="false";
function tabledata($clause){ 
     error_log("clause: ".print_r($clause,true));
     ?>     


    
    
       <?php  
        if($clause['subClauses']!=null){
            ?>
             <tr>
                <td><?php echo $clause['orderNumber'] ?></td>
                <td><?php echo htmlspecialchars($clause['clauseDesc']) ?></td>
                <td></td>
                <td></td>
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
            if($clause['auditClauseForThisClauseId']['priority']!=null && $clause['auditClauseForThisClauseId']['severity']!=null)
            {
            $cklIdsForClause=array();
            array_push($GLOBALS['allClausesArray'],$clause['clauseId']);
         
            ?>
                <tr>
                <td><?php echo $clause['orderNumber'] ?></td>
                <td><?php echo htmlspecialchars($clause['clauseDesc'])?>
                    <input type="hidden" id="loggedInUser" value="<?php echo $GLOBALS['loggedInUserId'] ?>">
                    <input type="hidden" id="auditStatus" value="checklistAssigned







                    ">
                    <input type="hidden" id="auditId" value="<?php echo $GLOBALS['auditId'] ?>">
                    <input type="hidden" id="action" value="saveClause">
                    <input type="hidden" id="auditor_comments<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="auditorStatus<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="isCklsUpdateReqd<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="auditCklIdsForClause<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="score<?php echo $clause['clauseId'] ?>" value="0">

                     
                </td>
                <td></td>
                <td>
                   <?php echo $clause['auditClauseForThisClauseId']['priority']?>
                    </td>
                <td> 
                    <?php echo $clause['auditClauseForThisClauseId']['severity']?>
                    </td>
                    <td>  <?php echo $clause['auditClauseForThisClauseId']['target_date']?>  </td>
                    <td></td>
                   
                    
                   
            </tr>
            <?php foreach($clause['checklists'] as $checklist){
                    $cklIdsForClause[]=$checklist['checklistId'];

                ?>
                <input type="hidden" id="score<?php echo $clause['clauseId'] ?>" value="0">


                   <tr>
                <td><input type="hidden" id="userFileName<?php echo $checklist['checklistId'] ?>" value="<?php echo $checklist['auditChecklistForThisCklId']['file_name'] ?>" ></td>
                <td></td>
                <td><?php echo $checklist['checklistDesc']?> </td>
                 <td></td>
                <td></td>
                <td></td>
                <td style="width:180px">
                    <?php
                    switch($checklist['formFieldType']){  
                        case 1:
                        ?>
                    <select class="form-control" id="<?php echo 'auditee_response'.$checklist['checklistId']?>" <?php if($GLOBALS['workingStatus']!="perform pending") echo 'disabled="disabled"'?>>
                    <option>--Respond--</option>
                    <?php $auditee_response=$checklist['auditChecklistForThisCklId']['auditee_response']?>
                    <option value="yes" <?php if($auditee_response == 'yes') echo 'selected = "selected"' ?> >Yes</option>
                    <option value="no" <?php if($auditee_response == 'no') echo 'selected = "selected"' ?> >No</option>
                </select>
                <?php
                break;
                        case 2:

                     foreach($checklist['cklOptions'] as $cklOpt){ ?>
                          <li>
                               
                                <input type="<?php echo MetaData::getMlChoiceControl($checklist['formFieldType']) ?>" name="cklOptionResp[]" value="<?php echo $cklOpt['cklOptId'] ?>" <?php if($GLOBALS['workingStatus']!="perform pending") echo 'disabled="disabled"'?>
                                <?php if(strpos($auditee_response, ''.$cklOpt['cklOptId']) !== false) echo 'checked' ?>>
                                <?php echo $cklOpt['cklOptData'] ?>
                                <input type="hidden" class="form-control" id="<?php echo 'cklOptId-'.$cklOpt['cklOptId']?>" value="<?php echo $cklOpt['cklOptId'] ?>">
                                <input type="hidden" class="form-control" id="<?php echo 'cklOptData'.$cklOpt['cklOptId'] ?>" value="<?php echo $cklOpt['cklOptData'] ?>">

               
            </li>
            <?php

           
        }
                     break;
                        case 3:
                          foreach($checklist['cklOptions'] as $cklOpt){ ?>
                          <li>
                               
                                <input type="<?php echo MetaData::getMlChoiceControl($checklist['formFieldType']) ?>" name="cklOptionResp[]" value="<?php echo $cklOpt['cklOptId'] ?>" <?php if($GLOBALS['workingStatus']!="perform pending") echo 'disabled="disabled"'?>
                                <?php if(strpos($auditee_response, ''.$cklOpt['cklOptId']) !== false) echo 'checked' ?>>
                                <?php echo $cklOpt['cklOptData'] ?>
                                <input type="hidden" class="form-control" id="<?php echo 'cklOptId-'.$cklOpt['cklOptId']?>" value="<?php echo $cklOpt['cklOptId'] ?>">
                                <input type="hidden" class="form-control" id="<?php echo 'cklOptData'.$cklOpt['cklOptId'] ?>" value="<?php echo $cklOpt['cklOptData'] ?>">
                                <?php }
                                break;
                    case 4: 
                    ?>
                            <textarea placeholder="Auditee Response For Descriptive Question" style="border:1px solid rgba(197, 214, 222, .7); border-radius:4px; height:34px" maxlength="5000" rows="1" id="<?php echo 'auditee_comments'.$checklist['checklistId']?>" <?php if($GLOBALS['workingStatus']!="perform pending") echo 'disabled="disabled"'?> ><?php echo htmlspecialchars($observation); ?></textarea>
        
        <?php    }
                ?>
                    
               <?php $observation=$checklist['auditChecklistForThisCklId']['auditee_comment'] ?>
            
                <input type="file" id="<?php echo 'userFile'.$checklist['checklistId'] ?>" onchange="fileUpload(<?php echo $checklist['checklistId'] ?>)">
                <input type="hidden" class="form-control" id="<?php echo 'clauseId'.$checklist['checklistId'] ?>" value="<?php echo $checklist['clauseId'] ?>">
                <input type="hidden" class="form-control" id="<?php echo 'checklistScore'.$checklist['checklistId'] ?>" value="<?php echo $checklist['checklistScore'] ?>">
                <input type="hidden" class="form-control" id="<?php echo 'auditorScoreCkl'.$checklist['checklistId'] ?>" value="0">
            
            </td>
               
            </tr>
           

<?php  
            }
        }
            
?>
           <input type="hidden" class="form-control" id="<?php echo 'cklIdsForClause'.$clause['clauseId'] ?>" value="<?php echo join(',', $cklIdsForClause) ?>">
          
  <?php             
        
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
     <script src="js/compliance/clauseManagement.js"></script>
    <script src="js/audit/auditClauseManagement.js"></script>
     <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <style>
        #viewdata {

            margin-left: 308px;
            margin-top: 100px;
            margin-right: -20px;
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

    </style>

</head>



<body>
<body class="with-side-menu-compact">

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
        include '../common/leftMenu.php';
    ?>
    <div id="viewdata" class="container-fluid">
        
    <div class="row col-md-12" style="background:#337ab7; border:1px solid; border-radius: 4px; margin-bottom:20px ">
        <h1 class="panel-title">
                        <?php echo $workingStatus ?> For audit :
                        <?php echo $auditTitle?> for Compliance
                        <?php echo $complianceName?>
                    </h1>
    <div >

    <div class="col-md-6"></div>
    <div class="col-md-3"></div>
    <div class="col-md-1"><button class="btn btn-info" onclick="saveAllChecklists(allClauses)" <?php if($workingStatus!="perform pending") echo 'hidden' ?>>Save as Draft</button> </div>
    <div class="col-md-2" > <button class="btn btn-default" style="margin-left: -25px;" onclick="saveAuditStatus(<?php echo $auditId ?>, '<?php echo $workingStatus ?>', false, <?php echo $GLOBALS['capa'] ?>)" <?php if($workingStatus!="perform pending") echo 'hidden' ?>><i class="fa fa-file"></i> Respond</button> </div>
    
    </div>
</div>


   

   <table id="report" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Control Number</th>
                        <th>Control Set</th>
                        <th>Controls</th>
                        <th>Priority</th>
                        <th>Severity</th>
                        <th>targetDate</th>
                        <th>Auditee Response</th>
                        

                       
                    </tr>
                </thead>
                <?php 
                foreach($allClauses as $clauses)
                {
                foreach ($clauses as $clause) {
                 tabledata($clause);
                }
            }
                    
                ?>
            </table>
        </div>
</body>

</body>
</html>
<script>
        var allClauses=<?php echo json_encode($GLOBALS['allClausesArray'])?>;
        

    </script> 
<?php

?>
