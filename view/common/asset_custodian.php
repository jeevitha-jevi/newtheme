
<?php
    require_once __DIR__.'/../../php/asset/assetManager.php';
    $assetManager = new assetManager();
    // 4 is auditor role
    $allCustodian = $assetManager->Custodian();
?>


      <div class="form-group">
        <label for="multi-append" class="control-label" style="font-size: 13px;">Custodian:</label>        
       <div class="input-group select2-bootstrap-append">
            

            <select  id="asset_custodian" name="asset_custodian" class="form-control select2" required>
              <option></option>    

    <?php foreach($allCustodian as $custodian){ ?>
    <option value="<?php echo $custodian['id'] ?>"><?php echo $custodian['last_name']; ?></option>
    
    <?php } ?>
</select>
          <!-- <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="multi-append">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
              </span> -->
        </div>
        </div>