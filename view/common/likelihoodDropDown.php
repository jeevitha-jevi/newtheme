<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';

    $riskManager = new RiskManager();
    
    $allLikelihood = $riskManager->getAllLikelihood();
?>
<label for="likelihood">Likelihood</label>
<div class="input-group select2-bootstrap-prepend">
    <select id="likelihood" name="likelihoodDropDown" class="form-control select2">
	      <option></option>
	    <?php foreach($allLikelihood as $likelihood){ ?>
	    <option value="<?php echo $likelihood['id'] ?>"><?php echo $likelihood['name'] ?></option>
	    <?php } ?>
    </select>
	<span class="input-group-btn">
        <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
            <span class="glyphicon glyphicon-search"></span>
        </button>
    </span>
</div>


