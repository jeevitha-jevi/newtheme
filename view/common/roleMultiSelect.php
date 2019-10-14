<?php
    require_once __DIR__.'/../../php/common/metaData.php';

    $metaData = new MetaData();
    $allRoles = $metaData->getAllRoles();
?>
    <select id="role" name="rolesMultiSelect" class="form-control">
    <option>--Select Role--</option>    
    <?php foreach($allRoles as $role){ ?>
    <option value="<?php echo $role['id'] ?>"><?php echo $role['name'] ?></option>
    <?php } ?>
</select>
