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
<div class="kt-radio-list">
 <fieldset id="frequency">
 <div class="row">

  <div class="col-md-2">
  <label class="kt-radio kt-radio--solid kt-radio--primary">
<input type="radio" name="frequency" value="weekly">Weekly
      <span></span>
    </label>
  </div>
  <div class="col-md-2">
      <label class="kt-radio kt-radio--solid kt-radio--danger">
      <input type="radio" name="frequency" value="monthly">Monthly
      <span></span>
    </label>
  </div>
  <div class="col-md-2">
     <label class="kt-radio kt-radio--solid kt-radio--warning">
      <input type="radio" name="frequency" value="quarterly">Quarterly
      <span></span>
    </label>
  </div>
  <div class="col-md-2">
     <label class="kt-radio kt-radio--solid kt-radio--info">
      <input type="radio" name="frequency" value="yearly">Yearly
      <span></span>
    </label>
  </div>
  <div class="col-md-2">
     <label class="kt-radio kt-radio--solid kt-radio--success">
      <input type="radio" name="frequency" value="once">Once
      <span></span>
    </label>
  </div>
  <input type="hidden" id="auditFreq" value="once" >
  <h4></h4>
</div>
</fieldset>
</div>