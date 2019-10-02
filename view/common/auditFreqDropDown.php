<?php
    require_once __DIR__.'/../../php/common/appConfig.php';
    $allAuditFreqs = AppConfig::getAllConfigValues('audit_freq');
?>


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
      <div class="col-md-10">
     <label>Repeat(Optional), For adhoc audits click plan directly</label>
   </div>
 </div>
 <fieldset id="frequency">
 <div class="row">

  <div class="col-md-2">
   <label class="radio-inline form-control" style="background:#DF4974;" >
      <input type="radio" name="frequency" value="weekly" class="deselectRadioButton">Weekly
    </label>
  </div>
  <div class="col-md-2">
    <label class="radio-inline form-control" style="background: #6F96EA;" >
      <input type="radio" name="frequency" value="monthly" class="deselectRadioButton" >Monthly
    </label>
  </div>
  <div class="col-md-2">
    <label class="radio-inline form-control" style="background: #75D8CF;">
      <input type="radio" name="frequency" value="quarterly" class="deselectRadioButton">Quarterly
    </label>
  </div>
  <div class="col-md-2">
    <label class="radio-inline form-control" style="background: #78BF6D;" >
      <input type="radio" name="frequency" value="yearly" class="deselectRadioButton">Yearly
    </label>
  </div>
  <div class="col-md-2">
    <label class="radio-inline form-control" style="background: #f47673;" >
      <input type="radio" name="frequency" value="once" class="deselectRadioButton">Once
    </label>
  </div>
  <input type="hidden" id="auditFreq" value="once" >
  <h4></h4>
</div>
</fieldset>
</div>