
<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';
    $riskManager = new RiskManager();
    // 4 is auditor role
    $allLocation = $riskManager->getAllLocation();
?><!-- 
    <label for="location" style="margin-left: 2%">Location</label>
    <div class ="col-md-12" style="margin-left: -2%">
    <select id="location" name="locationDropDown" class="form-control">
    <option>--Select Location--</option>    
    <?php foreach($allLocation as $location){ ?>
    <option value="<?php echo $location['id'] ?>"><?php echo $location['name']; ?></option>
    <?php } ?>
</select>
</div> -->


    <div class="form-group">
    <div class="col-md-12">
    <label >Location</label>        
        <div>
            

            <select  id="location" name="locationDropDown"   multiple>

                            
                        <?php foreach($allLocation as $location){ ?>
                        <option value="<?php echo $location['id'] ?>"><?php echo $location['name']; ?></option>
                        <?php } ?>
</select>

 
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function() {
  $('#location').multiselect();
});
</script>

 