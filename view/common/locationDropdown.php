
<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    // 4 is auditor role
    $allLocation = $riskManager->getAllLocation();
?>


      <div class="form-group">
        <label for="multi-append" class="control-label" style="font-size: 13px;">Location</label>        
       <div class="input-group select2-bootstrap-append">
            

            <select  id="location" name="locationDropDown" class="form-control select2" multiple>
              <option></option>    

    <?php foreach($allLocation as $location){ ?>
    <option value="<?php echo $location['id'] ?>"><?php echo $location['name']; ?></option>
    <?php } ?>
</select>
          <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="multi-append">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
        </div>
        </div>
      


