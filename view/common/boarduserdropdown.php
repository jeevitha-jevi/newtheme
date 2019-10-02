<?php
require_once '../../php/common/dashboard.php';


$manager = new dashboard();
$allUsers = $manager->getAllUsers();


?>
      <div class="form-group">       
       <div class="input-group select2-bootstrap-append col-md-12">
            

            <select id="location" name="user[]" class="form-control select2" multiple>
              <option  value="None Selected">None Selected</option>

    <?php foreach($allUsers as $user){ ?>
    <option  value="<?php echo $user['id'] ?>"><?php echo $user['last_name']; ?> <?php echo $user['first_name']; ?></option>
    <?php } ?>
</select>
         
        </div>
        </div>