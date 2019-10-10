<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $policyTypes=$manager->policyTypes();
echo json_encode($policyTypes);
?>