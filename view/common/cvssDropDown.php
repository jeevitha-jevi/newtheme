<?php
    require_once __DIR__.'/../../php/risk/riskManager.php';

    $riskManager = new RiskManager();
    
    $allAttackVector = $riskManager->getAllCvssScore("AccessVector");
    $allAttackComplexity = $riskManager->getAllCvssScore("AccessComplexity");
    $allAuthentication = $riskManager->getAllCvssScore("Authentication");
    $allConfidentialityImpact = $riskManager->getAllCvssScore("ConfImpact");
    $allIntegrityImpact = $riskManager->getAllCvssScore("IntegImpact");
    $allAvailabilityImpact = $riskManager->getAllCvssScore("AvailImpact");
    $allExploitability = $riskManager->getAllCvssScore("Exploitability");
    $allRemediationLevel = $riskManager->getAllCvssScore("RemediationLevel");
    $allReportConfidence = $riskManager->getAllCvssScore("ReportConfidence");
    $allCollateralDamagePotential = $riskManager->getAllCvssScore("CollateralDamagePotential");
    $allTargetDistribution = $riskManager->getAllCvssScore("TargetDistribution");
    $allConfidentialityRequirement = $riskManager->getAllCvssScore("ConfidentialityRequirement");
    $allIntegrityRequirement = $riskManager->getAllCvssScore("IntegrityRequirement");
    $allAvailabilityRequirement = $riskManager->getAllCvssScore("AvailabilityRequirement");

?>

<div class="row">
    <div class="col-md-6">
        <h4><b>Exploitability Metrics</b></h4>
        <label for="attackvector">Attack Vector</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="attackvector" name="attackvectorDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allAttackVector as $attackvector){ ?>
                <option value="<?php echo $attackvector['value']; ?>"><?php echo $attackvector['metric_value']; ?></option>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                     <span class="glyphicon glyphicon-search"></span>
                </button>
            </span> 
        </div>
        <label for="attackcomplexity">Attack Complexity</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="attackcomplexity" name="attackcomplexityDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allAttackComplexity as $attackcomplexity){ ?>
                <option value="<?php echo $attackcomplexity['value']; ?>"><?php echo $attackcomplexity['metric_value']; ?></option>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
            </span> 
        </div>
        <label for="authentication">Authentication</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="authentication" name="authenticationDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allAuthentication as $authentication){ ?>
                <option value="<?php echo $authentication['value']; ?>"><?php echo $authentication['metric_value']; ?></option>
                <?php } ?>
            </select><br>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                     <span class="glyphicon glyphicon-search"></span>
                </button>
            </span> 
        </div>
    </div>
    <div class="col-md-6">
        <h4><b>Impact Metrics</b></h4>
        <label for="confidentialityimpact">Confidentiality Impact</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="confidentialityimpact" name="confidentialityimpactDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allConfidentialityImpact as $confidentialityimpact){ ?>
                <option value="<?php echo $confidentialityimpact['value']; ?>"><?php echo $confidentialityimpact['metric_value']; ?></option>
                    <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span> 
        </div>
        <label for="integrityimpact">Integrity Impact</label>
            <div class="input-group select2-bootstrap-prepend">
                <select id="integrityimpact" name="integrityimpactDropDown" class="form-control select2">
                    <option></option>
                    <?php foreach($allIntegrityImpact as $integrityimpact){ ?>
                    <option value="<?php echo $integrityimpact['value']; ?>"><?php echo $integrityimpact['metric_value']; ?></option>
                    <?php } ?>
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span> 
            </div>
        <label for="availabilityimpact">Availability Impact</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="availabilityimpact" name="availabilityimpactDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allAvailabilityImpact as $availabilityimpact){ ?>
                <option value="<?php echo $availabilityimpact['value']; ?>"><?php echo $availabilityimpact['metric_value']; ?></option>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
    <div class="col-md-6">
        <h4><b>Temporal Score Metrics</b></h4>
        <label for="exploitability">Exploitability</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="exploitability" name="exploitabilityDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allExploitability as $exploitability){ ?>
                <option value="<?php echo $exploitability['value']; ?>"><?php echo $exploitability['metric_value']; ?></option>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <label for="remediationlevel">Remediation Level</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="remediationlevel" name="remediationlevelDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allRemediationLevel as $remediationlevel){ ?>
                <option value="<?php echo $remediationlevel['value']; ?>"><?php echo $remediationlevel['metric_value']; ?></option>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <label for="reportconfidence">Report Confidence </label>
        <div class="input-group select2-bootstrap-prepend">
        <select id="reportconfidence" name="reportconfidenceDropDown" class="form-control select2">
            <option></option>
            <?php foreach($allReportConfidence as $reportconfidence){ ?>
            <option value="<?php echo $reportconfidence['value']; ?>"><?php echo $reportconfidence['metric_value']; ?></option>
            <?php } ?>
        </select>
        <span class="input-group-btn">
            <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
        </div><br>
    </div>
    <div class="col-md-6">
        <h4><b>Impact Subscore Modifiers</b></h4>
        <label for="confidentialityrequirement">Confidentiality Requirement</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="confidentialityrequirement" name="confidentialityrequirementDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allConfidentialityRequirement    as $confidentialityrequirement){ ?>
                <option value="<?php echo $confidentialityrequirement['value']; ?>"><?php echo $confidentialityrequirement['metric_value']; ?></option>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <label for="integrityrequirement">Integrity Requirement</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="integrityrequirement" name="integrityrequirementDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allIntegrityRequirement as $integrityrequirement){ ?>
                <option value="<?php echo $integrityrequirement['value']; ?>"><?php echo $integrityrequirement['metric_value']; ?></option>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <label for="availabilityrequirement">Availability Requirement</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="availabilityrequirement" name="availabilityrequirementDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allAvailabilityRequirement as $availabilityrequirement){ ?>
                <option value="<?php echo $availabilityrequirement['value']; ?>"><?php echo $availabilityrequirement['metric_value']; ?></option>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">   
        <h4><b>Environmental Score Metrics</b></h4>
        <label for="collateraldamagepotential">Collateral Damage Potential</label>
        <div class="input-group select2-bootstrap-prepend">
            <select id="collateraldamagepotential" name="collateraldamagepotentialDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allCollateralDamagePotential as $collateraldamagepotential){ ?>
                <option value="<?php echo $collateraldamagepotential['value']; ?>"><?php echo $collateraldamagepotential['metric_value']; ?></option>
                <?php } ?>
            </select>
             <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <label for="targetdistribution">Target Distribution</label>
         <div class="input-group select2-bootstrap-prepend">
            <select id="targetdistribution" name="targetdistributionDropDown" class="form-control select2">
                <option></option>
                <?php foreach($allTargetDistribution as $targetdistribution){ ?>
                <option value="<?php echo $targetdistribution['value']; ?>"><?php echo $targetdistribution['metric_value']; ?></option>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
 </div>       
    