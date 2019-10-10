<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    $allScenario = $riskManager->getAllScenario();
?>
      
        <div class="input-group select2-bootstrap-prepend">
            
            <select  id="scenario" name="scenarioDropDown" class="form-control" required>
             <option></option>    
    <?php foreach($allScenario as $scenario){ ?>
    <option value="<?php echo $scenario['id'] ?>"><?php echo $scenario['name'] ?></option>
    <?php } ?>
</select>

