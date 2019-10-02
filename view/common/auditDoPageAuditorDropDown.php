<?php 

    require_once __DIR__.'/../../php/user/userManager.php';

    /*$userManager = new UserManager();*/
    // 4 is auditor role

    $allAuditors=explode(",",$GLOBALS['auditor']);
    //echo json_encode($allAuditors);
    
    $allAuditorss=array();
    
   foreach($allAuditors as $auditors)
	{
	$userManager = new UserManager();
	array_push($allAuditorss,$userManager->getAuditorById($auditors));
	}
	
?>

<div class="form-group">
    <div class="col-md-12" style="margin-top: 0px;">
    <label >Auditor</label>        
        <div class="input-group select2-bootstrap-prepend">
            
            <select id="auditor<?php echo $clause['clauseId'] ?>" name="auditorDropDown" class="form-control">
          <option></option>
             <?php foreach($allAuditorss as $auditors){
            foreach($auditors as $auditor)
            {
          ?>
           <option value="<?php echo $auditor['userId'] ?>"><?php echo $auditor['lastName'] ?></option>

           <?php } }?>
        </select>
 
             
        </div>
    </div>
</div>
