
<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $inherentRisk=$manager->inherentheatRisk();
echo json_encode($inherentRisk);
?>
