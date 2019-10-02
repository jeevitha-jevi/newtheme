<?php

/*require_once __DIR__.'/../header.php';*/
require_once __DIR__.'/../../php/compliance/clauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';
session_start();

$complianceIds =$_POST['id'];

$userRole = $_SESSION['user_role'];
$complianceDataControls=array();
$allClausesControls=array();
$complianceManagerControls = new ComplianceManager();
/*$_SESSION['user_role']="super_admin";*/
for($i=0;$i<count($complianceIds);$i++)
{


$complianceDataControls[$i] = $complianceManagerControls->getComplianceData($complianceIds[$i], "super_admin");
}
$complianceNameControls = $complianceDataControls['complianceName'];
$versionControls = $complianceDataControls['version'];
$clauseManagerControls = new ClauseManager();
for($i=0;$i<count($complianceDataControls);$i++)
{
$allClausesControls[$i] = $clauseManagerControls->getAllClauses($complianceDataControls[$i]);
}
$accordionIdControls = $complianceIds;
$isViewOnlyControls = $complianceDataControls['isViewOnly'];
$isActiveControls = $complianceDataControls['isActive'];
$complStatusControls = $complianceDataControls['status'];
$GLOBALS['workingStatus'] = $complianceDataControls['workingStatus'];
error_log("all clauses".print_r($allClausesControls,true));

function optionData($clause){ 
     //error_log("clause: ".print_r($clause,true));
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

            <option id="<?php echo $checklist['checklistId'] ?>" value="<?php echo $checklist['checklistId'] ?>"><?php echo $checklist['checklistDesc']?></option>

 <?php   }
    }
}
    

 
?>
 <label  class="control-label">Control Number</label>
             
    <select id="controls" class="form-control select2" multiple required>
              
                
                <?php
                //error_log("all clause".print_r($allClausesControls,true)); 
                foreach($allClausesControls as $clauses)
                {
                  foreach ($clauses as $clause) {
                    
                        optionData($clause);

                  }
                       ?>
                   
                <?php } ?>
            </select>
                   


<script type="text/javascript">

    $(document).ready(function() {
  $('#controls').multiselect();
});
</script>
