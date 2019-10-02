<?php
    require_once __DIR__.'/../../php/user/userManager.php';

    $userManager = new UserManager();
    // 4 is auditor role
    $allAuditors = $userManager->getAllUsersByRole(4,$_SESSION['company']);
    
?>

<div class="form-group">  
 <div class="input-group select2-bootstrap-prepend">
            
            <select id="auditor" class="form-control select2-selection arrow">
                 <option>...select...</option>                                                                          
              <?php foreach($allAuditors as $auditor){ ?>
               <option value="<?php echo $auditor['userId']; ?>"><?php echo htmlspecialchars($auditor['lastName']); ?></option>
               <?php } ?>                                    
            </select> 
           
        </div>
    </div>

