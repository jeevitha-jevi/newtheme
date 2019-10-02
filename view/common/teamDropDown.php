<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    // 4 is auditor role
    $allTeam = $riskManager->getAllTeam();
?>


     <label >Affected Team</label>        
        <div class="input-group select2-bootstrap-prepend">
            
            <select id="team" name="teamDropDown" class="form-control select2" required>
            <option></option>    
    <?php foreach($allTeam as $team){ ?>
    <option value="<?php echo $team['id'] ?>"><?php echo $team['name'] ?></option>
    <?php } ?>
</select>
 
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
            </span> 
        </div>
