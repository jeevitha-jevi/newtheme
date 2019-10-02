<?php
require_once '../../php/common/dashboard.php';


$manager = new dashboard();
$allUsers = $manager->getalladmin();


?>
      <div class="form-group">
        <label for="multi-append" class="control-label" style="font-size: 13px;">Chair</label>        
       <div class="input-group select2-bootstrap-append col-md-12">

            <select id="location" name="admin" class="form-control select2" multiple>
              <option  value="None Selected">None Selected</option>

    <?php foreach($allUsers as $user){ ?>
    <option   value="<?php echo $user['id'] ?>"><?php echo $user['last_name']; ?></option>
    <?php } ?>
</select>
         
        </div>
        </div>
  