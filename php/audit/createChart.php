<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $chartData=new stdClass();
    $chartData->chartData=$_POST['chartData'];
    $chartData->chartType=$_POST['chartType'];
    $chartData->user=$_POST['user'];
    $chartData->company=$_POST['company'];
    $metaData->createChart($chartData);
    $chartdet=$metaData->detailsaboutChart(7);
echo json_encode($chartdet);
    error_log("chartData".print_r($chartData,true));
    
    
    
?>