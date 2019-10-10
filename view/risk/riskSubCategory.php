<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    $id=$_POST['id'];
    // 4 is auditor role
    $allCategory = $riskManager->getAllSubCategory($id);
?>
     
<label for="exampleSelect1">Sub Category</label>
        <div class="input-group select2-bootstrap-prepend">
            
            <select  id="subCategory" name="categoryDropDown" class="form-control">
             <option></option>    
    <?php foreach($allCategory as $category){ ?>
    <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
    <?php } ?>
</select>

 
            
        </div>
