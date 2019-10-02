<?php
    require_once __DIR__.'/../../php/common/metaData.php';
    require_once __DIR__.'/../../php/audit/auditManager.php';
    $riskManager = new AuditManager();
    
    $allCompliances = $riskManager->getAllCompliances($_SESSION['company']);
?>
   
   

        
<div class="form-group" >
  <label style="margin-left: 4%">Compliance</label>
  <div class ="col-md-12">
    <div class="input-group select2-bootstrap-append">
      <select id="compliance" class="form-control select2"    required onchange="getControls()" >
        <option></option>
        <?php foreach($allCompliances as $compliance){ ?>
         <option value="<?php echo $compliance['id'] ?>"><?php echo $compliance['name'] ?></option>
        <?php } ?>                                     
      </select>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" data-select2-open="multi-append">
          <span class="glyphicon glyphicon-search"></span>
        </button>
      </span>
     </div>
    </div>
</div>
 <script src="metronic/theme/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
       