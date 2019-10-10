<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$ganttchartdata=new dashboard();
$ganttchart=$ganttchartdata->getganttchartdata();
echo json_encode($ganttchart);
?>