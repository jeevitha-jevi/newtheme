<?php
    require_once __DIR__.'/../../php/common/metaData.php';
    require_once __DIR__.'/../../php/audit/auditManager.php';
    $riskManager = new AuditManager();
    
    $allCompliances = $riskManager->getAllCompliances($companyId);
?>

      <div class="form-group">
        <label class="control-label">Control Regulation</label>
            
              <select id="regulation"  class="form-control select2" onchange="getControls()" multiple  required>
                  
                <?php foreach($allCompliances as $compliance){ ?>
                  <option value="<?php echo $compliance['id'] ?>"><?php echo $compliance['name'] ?></option>
                  <?php } ?>
               </select>  
    </div>
<script type="text/javascript">

    $(document).ready(function() {
  $('#regulation').multiselect();
});
</script>

