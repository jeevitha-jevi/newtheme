<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    // 4 is auditor role
    $allRiskSource = $riskManager->getAllRiskSource();
?>



<label>Risk Source</label>
<div class="input-group select2-bootstrap-prepend"> 
  <select id="riskSource" name="riskSourceDropDown" class="form-control select2" required>
    <option></option>    


    <?php foreach($allRiskSource as $risksource){ ?>
    <option value="<?php echo $risksource['id'] ?>"><?php echo $risksource['name'] ?></option>
    <?php } ?>
  </select>
  <span class="input-group-btn">
      <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
       <span class="glyphicon glyphicon-search"></span>
      </button>
  </span> 
</div>
