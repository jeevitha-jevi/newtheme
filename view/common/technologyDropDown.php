<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    // 4 is auditor role
    $allTechnology = $riskManager->getAllTechnology();
?>



    <label >Technology</label>        
        <div class="input-group select2-bootstrap-prepend">
            
            <select id="technology" name="technologyDropDown" class="form-control select2" multiple required>
             <option></option>    
    <?php foreach($allTechnology as $technology){ ?>
    <option value="<?php echo $technology['id'] ?>"><?php echo $technology['name'] ?></option>
    <?php } ?>
</select>
 
            <span class="input-group-btn ">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
            </span> 
        </div>
