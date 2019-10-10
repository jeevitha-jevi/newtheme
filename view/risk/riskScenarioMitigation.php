<?php 
$id=$riskScenarioDetails[0]['id'];
 $riskManager = new RiskManager();
$allScenario = $riskManager->getAllScenarioMitigation($id); 
?>


    <div class="form-group">
    
    <label ><strong>Risk Scenario Mitigation</strong></label>        
        <div class="input-group select2-bootstrap-prepend">
            
            <select  id="scenarioMitigation" name="scenarioDropDown" class="form-control select2">
             <option>--Select Risk Scenario Mitigation--</option>    
    <?php foreach($allScenario as $scenario){ ?>
    <option value="<?php echo $scenario['id'] ?>"><?php echo $scenario['name'] ?></option>
    <?php } ?>
</select>

 
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
            </span> 
        </div>
    
</div>


