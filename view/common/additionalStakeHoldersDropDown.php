<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    
    $allStakeHolder = $riskManager->getAllStakeHolder();
?>
   <!--  <label for="additionalStakeHolder">Additional Stakeholders</label>
    <select id="additionalStakeHolder" name="additionalStakeHolderDropDown" class="form-control" multiple="multiple">   
    <?php foreach($allStakeHolder as $stakeholder){ ?>
    <option value="<?php echo $stakeholder['userId']; ?>"><?php echo $stakeholder['lastName']; ?></option>
    <?php } ?>
</select>
 -->


        <label for="multi-append" class="control-label">Additional Stakeholders (optional)
           </label>
            <!-- <div class="input-group select2-bootstrap-append"> -->
              <!-- <select id="additionalStakeHolder" name="additionalStakeHolderDropDown"  class="form-control select2"  multiple>
               <option></option>
                <?php foreach($allStakeHolder as $stakeholder){ ?>
                  <option value="<?php echo $stakeholder['userId']; ?>"><?php echo $stakeholder['lastName']; ?></option>
                           <?php } ?>
                       </select> -->
                    <input type="text" class="form-control" id="additionalStakeHolder">

              <!-- <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="multi-append">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
              </span> -->
            <!-- </div> -->
     