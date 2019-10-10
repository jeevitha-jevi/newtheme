<?php 

    require_once __DIR__.'/../../php/user/userManager.php';

    /*$userManager = new UserManager();*/
    // 4 is auditee role
   
    $allauditees=explode(",",$GLOBALS['auditee']);
    //echo json_encode($allauditees);
    
    $allauditeess=array();
    
   foreach($allauditees as $auditees)
	{
	$userManager = new UserManager();
	array_push($allauditeess,$userManager->getUserNameById($auditees));
	}
	
?>

                                        


<div class="form-group">
    <div class="col-md-12">
    <label >Auditee</label>        
       
            <select id="auditee<?php echo $clause['clauseId'] ?>" name="auditeeDropDown" class="form-control select2" multiple>
          <option></option>
             <?php foreach($allauditeess as $auditees){
            foreach($auditees as $auditee)
            {
          ?>
           <option value="<?php echo $auditee['userId'] ?>"><?php echo $auditee['lastName'] ?></option>

           <?php } }?>
        </select>
 
           
        </div>
    </div>

<!-- <script src="metronic/theme/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script> -->


