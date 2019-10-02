<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$ganttchartdatarisk=new dashboard();
$ganttchartrisk=$ganttchartdatarisk->getganttchartdatarisk();
echo json_encode($ganttchartrisk);
?>