<?php
    require_once __DIR__.'/../../php/common/metaData.php';
    require_once __DIR__.'/../../php/audit/auditManager.php';
    $riskManager = new AuditManager();
    
    $allCompliances = $riskManager->getAllCompliances($_SESSION['company']);
?>
   
   

        

<div class="form-group" style="margin-left:-14px;">
    <div class="col-md-12">
      
        <div class="">
            
            <select  id="compliance" class="form-control select2-selection arrow" name="complianceDropDown">
                   <option>...select....</option>
                 <?php foreach($allCompliances as $compliance){ ?>
                                  <option value="<?php echo $compliance['id'] ?>"><?php echo $compliance['name'] ?></option>
                  <?php } ?>  
                </select>

 

            
        </div>
    </div>
</div>
