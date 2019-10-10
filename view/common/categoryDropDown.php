<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    // 4 is auditor role
    $allCategory = $riskManager->getAllCategory();
?>

 <label >Category</label>        

        <div class="input-group select2-bootstrap-prepend">
            
            <select  id="category" name="categoryDropDown" class="form-control select2" onchange="getSubCategory()" required>
             <option></option>    
    <?php foreach($allCategory as $category){ ?>
    <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
    <?php } ?>
</select>

 
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
            </span> 
        </div>
