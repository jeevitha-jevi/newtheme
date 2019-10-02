<?php
    require_once __DIR__.'/../../php/policy/policyManager.php';
    $policyManager = new PolicyManager();
    // 17 is policyOwner role
    $allPolicyOwner = $policyManager->getPolicyRole(26);    
    // 18 is policyreviewer role
    $allPolicyReviewer = $policyManager->getPolicyRole(27);
    // 19 is policyapprover role
    $allPolicyApprover = $policyManager->getPolicyRole(28);
?>

    
  <div class="col-md-4">
    <label >Owner</label>       
    <div class="input-group select2-bootstrap-prepend">            
      <select  id="policyowner" name="policyOwnerDropDown" class="form-control select2">
        <option></option>    
        <?php foreach($allPolicyOwner as $policyowner){ ?>
        <option value="<?php echo $policyowner['userId'] ?>"<?php if(isset($policyData)){
        if($policyData[0]["owner"] == $policyowner['lastName']){
            echo "selected";
        }
    }
    ?>><?php echo $policyowner['lastName'] ?></option>
        <?php } ?>
      </select> 
      <span class="input-group-btn">
     
        </button>
      </span> 
    </div>
  </div>    
  <div class="col-md-4"> 
    <label >Reviewer</label>       
    <div class="input-group select2-bootstrap-prepend">  
      <select  id="policyreviewer" name="policyreviewerDropDown" class="form-control select2">
        <option></option>    
        <?php foreach($allPolicyReviewer as $policyreviewer){ ?>
        <option value="<?php echo $policyreviewer['userId'] ?>"<?php if(isset($policyReview)){
        if($policyReview[0]["reviewer"] == $policyreviewer['lastName']){
            echo "selected";
        }
    }
    ?>><?php echo $policyreviewer['lastName'] ?></option>
        <?php } ?>
      </select>
      <span class="input-group-btn">
        
        </button>
      </span> 
    </div>
  </div>    
  <div class="col-md-4"> 
    <label >Approver</label>       
    <div class="input-group select2-bootstrap-prepend">          
      <select  id="policyapprover" name="policyapproverDropDown" class="form-control select2">
        <option></option>    
        <?php foreach($allPolicyApprover as $policyapprover){ ?>
        <option value="<?php echo $policyapprover['userId'] ?>"<?php if(isset($policyApprove)){
        if($policyApprove[0]["approver"] == $policyapprover['lastName']){
            echo "selected";
        }
    }
    ?>><?php echo $policyapprover['lastName'] ?></option>
        <?php } ?>
      </select>
      <span class="input-group-btn">
       
        </button>
      </span> 
    </div>
  </div>
