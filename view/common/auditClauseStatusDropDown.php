<?php
    require_once __DIR__.'/../../php/common/appConfig.php';

    $allAuditClauseStatus = AppConfig::getAllConfigValues('audit_clause_status');
?>
    <label for="auditorStatus">Status</label>
    <select id="auditorStatus" name="auditorStatusDropDown" class="form-control">
    <option>--Select Status--</option>    
    <?php foreach($allAuditClauseStatus as $auditorStatus){ ?>
    <option value="<?php echo $auditorStatus['confKey'] ?>"><?php echo $auditorStatus['confKey'] ?></option>
    <?php } ?>
</select>