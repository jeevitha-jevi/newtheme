<script type="text/javascript" src="js/risk/riskManagement.js"></script>


<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    // 4 is auditor role
    $allRiskScore = $riskManager->getAllRiskScore();
?>
   



       <label >Risk Scoring Method</label>        
        <div class="input-group select2-bootstrap-prepend">
            
            <select  id="riskScore" name="riskScoreDropDown" class="form-control select2" onchange="getScoringMethods()">
             <option></option>    
    <?php foreach($allRiskScore as $riskscore){ ?>
    <option value="<?php echo $riskscore['id'] ?>"><?php echo $riskscore['name'] ?></option>
    <?php } ?>
</select>

 
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
            </span> 
        </div>
    