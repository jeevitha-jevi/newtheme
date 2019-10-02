<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    // 11 is riskOwner role
    $allRiskOwner = $riskManager->getRiskRole(11);
    
    // 12 is riskMitigator role
    $allRiskMitigator = $riskManager->getRiskRole(12);
    // 13 is riskReviewer role
    $allRiskReviewer = $riskManager->getRiskRole(13);
?>
   




<div class="col-md-3">
  <div class="form-group">
    <label >Owner</label>       
    <div class="input-group select2-bootstrap-prepend">          
      <select  id="riskOwner" name="riskOwnerDropDown" class="form-control select2" required>
        <option></option>    

        <?php foreach($allRiskOwner as $riskowner){ ?>
          <option value="<?php echo $riskowner['userId'] ?>"><?php echo $riskowner['lastName'] ?></option>
        <?php } ?>
      </select>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
          <span class="glyphicon glyphicon-search"></span>
        </button>
      </span> 
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label >Mitigator</label>       
    <div class="input-group select2-bootstrap-prepend">  
      <select  id="riskMitigator" name="riskMitigatorDropDown" class="form-control select2" required>
        <option></option>    

        <?php foreach($allRiskMitigator as $riskmitigator){ ?>
          <option value="<?php echo $riskmitigator['userId'] ?>"><?php echo $riskmitigator['lastName'] ?></option>
        <?php } ?>
      </select> 
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
          <span class="glyphicon glyphicon-search"></span>
        </button>
      </span> 
    </div>
  </div>
</div>
<div class="form-group">
  <div class="col-md-3" > 
    <label >Reviewer</label>       
    <div class="input-group select2-bootstrap-prepend">
          
      <select  id="riskReviewer" name="riskReviewerDropDown" class="form-control select2" required>
       <option></option>    
      <?php foreach($allRiskReviewer as $riskreviewer){ ?>
      <option value="<?php echo $riskreviewer['userId'] ?>"><?php echo $riskreviewer['lastName'] ?></option>
      <?php } ?>
  </select>

          <span class="input-group-btn">
              <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
               <span class="glyphicon glyphicon-search"></span>
              </button>
          </span> 
      </div>
  </div>

</div>
