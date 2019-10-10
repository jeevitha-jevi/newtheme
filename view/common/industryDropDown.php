<?php
    require_once __DIR__.'/../../php/common/metaData.php';

    $metaData = new MetaData();
    $allIndustries = $metaData->getAllIndustries();
?>
    <label for="indstry">Industry</label>
    <select id="indstry" name="industryDropDown" class="form-control">
    <option>--Select Industry--</option>    
    <?php foreach($allIndustries as $industry){ ?>
    <option value="<?php echo $industry['id'] ?>"><?php echo $industry['name'] ?></option>
    <?php } ?>
</select>
