<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$ganttchartdataasset=new dashboard();
$ganttchartasset=$ganttchartdataasset->getganttchartdataasset();
echo json_encode($ganttchartasset);
?>