<?php
    require_once __DIR__.'/../../php/user/userManager.php';

    $userManager = new UserManager();
    // 4 is auditor role
    $allAuditors = $userManager->getfooter();
    // print_r($allAuditors);
    
?>




  <!-- <label style="margin-left:3%">auditor</label> -->
            <label>Footer:</label>
            <div class="input-group select2-bootstrap-prepend">
            <select id="bcpm_footer1" class="form-control select2">
              <option></option>                                                                              
              <?php foreach($allAuditors as $auditor){ ?>
               <option value="<?php echo $auditor['id'] ?>"><?php echo $auditor['name'] ?></option>
               <?php } ?>                                    
            </select> 
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
            </span> 
           </div>                             