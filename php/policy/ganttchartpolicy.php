<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$ganttchartdatapolicy=new dashboard();
$ganttchartpolicy=$ganttchartdatapolicy->getganttchartdatapolicy();
echo json_encode($ganttchartpolicy);
?>