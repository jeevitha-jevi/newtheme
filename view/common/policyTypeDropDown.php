
<?php
    require_once __DIR__.'/../../php/policy/policyManager.php';
    $policyManager = new PolicyManager();
    $allPolicyTypes = $policyManager->getAllPolicyTypes();
?>

<div class="form-group">
    <div class="col-md-12">
    <label style="margin-left:5px;margin-top:5px;">Policy Type</label>        
        <div class="input-group select2-bootstrap-prepend" style="margin-left:5px;width:150px;">
            
            <select id="policytype" name="policytypeDropDown" class="form-control select2" onchange="getSubPolicy()">
             <option></option>    
    <?php foreach($allPolicyTypes as $policytype){ ?>
    <option value="<?php echo $policytype['id'] ?>"<?php if(isset($policyData)){
        if($policyData[0]["policyType"] == $policytype['name']){
            echo "selected";
        }
    }
    ?>><?php echo $policytype['name'] ?></option>
    <?php } ?>
</select> 
        </div>
    </div>
</div>