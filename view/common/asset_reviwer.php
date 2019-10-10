
<?php
    require_once __DIR__.'/../../php/asset/assetManager.php';
    $assetManager = new assetManager();
    // 4 is auditor role
    $allReviewer = $assetManager->reviewer();
?>


      <div class="form-group">
        <label for="multi-append" class="control-label" style="font-size: 13px;">Reviewer:</label>        
       <div class="input-group select2-bootstrap-append">
            

            <select  id="asset_reviewer" name="asset_reviewer" class="form-control select2" required>
              <option active></option>    

    <?php foreach($allReviewer as $reviewer){ ?>
    <option value="<?php echo $reviewer['id'] ?>"><?php echo $reviewer['last_name']; ?></option>
    
    <?php } ?>
</select>
          <!-- <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="multi-append">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
              </span> -->
        </div>
        </div>