<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $disasterManager = new dashboard();
    $total_plan = $disasterManager->disaster_plan_count();
    $dashboard['plan_count'] = $total_plan;

    $disasterManager = new dashboard();
    $total_test = $disasterManager->disaster_test_count();
    $dashboard['test_count'] = $total_test;

	$disasterManager = new dashboard();
    $total_train = $disasterManager->disaster_train_count();
    $dashboard['train_count'] = $total_train;

    $disasterManager = new dashboard();
    $business = $disasterManager->disaster_business();
    $dashboard['business_impact'] = $business;

    $disasterManager = new dashboard();
    $category = $disasterManager->disaster_category();
    $dashboard['system_category'] = $category;

    $disasterManager = new dashboard();
    $resource = $disasterManager->disaster_resource();
    $dashboard['disaster_resource'] = $resource;

    $disasterManager = new dashboard();
    $location = $disasterManager->disaster_location();
    $dashboard['disaster_location'] = $location;

    echo json_encode($dashboard);
?>