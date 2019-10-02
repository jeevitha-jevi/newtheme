<?php
    require_once __DIR__.'/../../php/common/appConfig.php';
    $allAuditFreqs = AppConfig::getAllConfigValues('audit_freq');
?>

   
<!-- 
<div class="form-group" >
  <label style="margin-left: 3%">Frequency</label>
    <div class="col-md-12">
        <div class="input-group select2-bootstrap-prepend">
            
            <select id="auditFreq"   name="auditFreqDropDown"  class="form-control select2">
              <option></option>                                                                              
              <?php foreach($allAuditFreqs as $auditFreq){ ?>
    <option value="<?php echo $auditFreq['confKey'] ?>"><?php echo $auditFreq['confKey'] ?></option>
    <?php } ?>
</select> 
<span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="single-prepend-text">
                 <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>  
        </div>
    </div>
</div> -->

<style>
button#Monthly:focus
{
    background:olive;
}
button#Quarterly:focus
{
    background:olive;
}
button#yearly:focus
{
    background:olive;
}
button#weekly:focus
{
    background:olive;
}
</style>
<div class="form-group" >
    <div class="row">
      <div class="col-md-12">
     <label >Frequency</label>
   </div>
 </div>
 <fieldset id="frequency">
 <div class="row">
 <div class="col-md-2">
    <label class="radio-inline form-control" style="background: #f47673" >
      <input type="radio" name="frequency" value="once" class="deselectRadioButton" checked>Once
    </label>
  </div>
  <div class="col-md-2">
   <label class="radio-inline form-control" style="background: #75b1e5" >
      <input type="radio" name="frequency" value="weekly" class="deselectRadioButton">Weekly
    </label>
  </div>
  <div class="col-md-2">
    <label class="radio-inline form-control" style="background: #85e185" >
      <input type="radio" name="frequency" value="monthly" class="deselectRadioButton">Monthly
    </label>
  </div>
  <div class="col-md-2">
    <label class="radio-inline form-control" style="background: #5bc0de" >
      <input type="radio" name="frequency" value="quarterly" class="deselectRadioButton">Quarterly
    </label>
  </div>
  <div class="col-md-2">
    <label class="radio-inline form-control" style="background: #ec971f" >
      <input type="radio" name="frequency" value="yearly" class="deselectRadioButton">Yearly
    </label>
  </div>
  
  <input type="hidden" id="auditFreq" value="once" >
  <h4></h4>
</div>
</fieldset>
</div>
