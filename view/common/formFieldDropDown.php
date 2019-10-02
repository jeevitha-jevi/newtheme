<?php
    require_once __DIR__.'/../../php/common/metaData.php';

    $metaData = new MetaData();
    $allFormFields = $metaData->getAllFormFields();
?>
    <label for="formField">Form Field Type</label>
    <select id="formField" name="formFieldDropDown" class="form-control">   
    <?php foreach($allFormFields as $formField){ ?>
    <option value="<?php echo $formField['id'] ?>"><?php echo $formField['type'] ?></option>
    <?php } ?>
</select>
