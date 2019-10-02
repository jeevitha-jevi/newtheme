<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';

    $riskManager = new RiskManager();

    $allimpact = $riskManager->getAllImpact();
?>
    <label for="impact">Impact</label>
    <div class="input-group select2-bootstrap-prepend">
	    <select id="impact" name="impactDropDown" class="form-control select2">
		    <option></option>
		    <?php foreach($allimpact as $impact){ ?>
		    <option value="<?php echo $impact['id'] ?>"><?php echo $impact['name'] ?></option>
		    <?php } ?>
	   </select>
	   <span class="input-group-btn">
		    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
		        <span class="glyphicon glyphicon-search"></span>
		    </button>
		</span>
	</div>


