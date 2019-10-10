     

<?php

/*require_once __DIR__.'/../header.php';*/
require_once __DIR__.'/../../php/compliance/clauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';
session_start();

$complianceIds =2;
$userRole = $_SESSION['user_role'];
/*$_SESSION['user_role']="super_admin";*/
$complianceManagerControls = new ComplianceManager();
$complianceDataControls = $complianceManagerControls->getComplianceData($complianceIds, $userRole);
$complianceNameControls = $complianceDataControls['complianceName'];
$versionControls = $complianceDataControls['version'];
$clauseManagerControls = new ClauseManager();
$allClausesControls = $clauseManagerControls->getAllClauses($complianceDataControls);
$accordionIdControls = $complianceIds;
$isViewOnlyControls = $complianceDataControls['isViewOnly'];
$isActiveControls = $complianceDataControls['isActive'];
$complStatusControls = $complianceDataControls['status'];
$GLOBALS['workingStatus'] = $complianceDataControls['workingStatus'];
function optionData($clause){ 
     error_log("clause: ".print_r($clause,true));
     ?>     
       <?php  
        if($clause['subClauses']!=null){
            ?>
        <?php 
            foreach($clause['subClauses'] as $subClause)
            {
        optionData($subClause);            
        } }

        else{
            /*array_push($GLOBALS['allClausesArray'],$clause['clauseId']);*/
          foreach($clause['checklists'] as $checklist){
            ?>
             
            <option id="<?php echo $checklist['checklistId'] ?>"><?php echo $checklist['checklistDesc']?></option>           
        
 <?php   }
    }
}
     
?>

   
          <div class="form-group" >

            <select id="labelling" class="form-control" >
              <option></option>
                
                <?php
                error_log("all clause".print_r($allClausesControls,true)); 
                foreach($allClausesControls as $clauses)
                {
                    ?>
                   
                    
                <?php
                    
               
                 optionData($clauses);

                }
            

            ?>
            </select>
          </div>