<?php
    require_once __DIR__.'/../../php/asset/assetManager.php';

$user = new AssetManager();
$asset_group = $user->getAssetGroup();


?>
<div class="col-sm-6 cols">
                            <label > Asset Group</label>
                            <br/>
<div class="input-group select2-bootstrap-prepend">
            <select  id="assetDrop" name="asset_groups" class="form-control select2" onchange="getAssetvalue()" required>
                             <option></option>
                             <?php
                            foreach ($asset_group as $assets) {
                             
                              ?>

                             <option value="<?php echo $assets['id'] ?>"><?php echo $assets['name'];?></option> 
                             <?php
                            }
                            ?>
                              
                            </select>
                            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
</div>
</div>

        
        

                                        
