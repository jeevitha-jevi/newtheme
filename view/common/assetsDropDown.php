<?php
    require_once __DIR__.'/../../php/asset/assetManager.php';
$user = new AssetManager();
 $asset=$_POST['asset'];
$asset_group = $user->getAssets($asset);
   

?>
<div class="col-sm-6 cols">
                            <label> Assets</label>
                            <br/>
<div class="input-group select2-bootstrap-prepend">

  <select name="asset_group" class="form-control select2"  id="asset_groups" onchange="getAssetValuefromAsset()" required>
                             <option></option>
                             <?php
                            foreach ($asset_group as  $asset_groups) {
                              $name = $asset_groups['name'];
                              ?>

                             <option value="<?php echo $asset_groups['id'] ?>"><?php echo $name;?></option> 
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




