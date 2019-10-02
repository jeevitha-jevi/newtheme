<?php
    require_once __DIR__.'/../../php/common/metaData.php';
    require_once __DIR__.'/../../php/audit/auditManager.php';
    $riskManager = new AuditManager();
    
    $allCompliances = $riskManager->getAllCompliances($_SESSION['company']);
?>
<div class="form-group" style="margin-left: -100px;">
  <label class="control-label">Add Standard</label>
  <select id="comp_id" class="form-control select2" multiple>
    <?php foreach($allCompliances as $compliance) { ?>
      <option value="<?php echo $compliance['id'] ?>"><?php echo $compliance['name'] ?></option>
    <?php } ?>
  </select>
</div>
<script type="text/javascript">
         $(document).ready(function() {
  $('#comp_id').multiselect();
});
</script>
 <script src="metronic/theme/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
