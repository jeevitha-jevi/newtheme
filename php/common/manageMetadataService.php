<?php
require_once __DIR__.'/metadata.php';

function manageMetadata(){
    $metadata = new MetaData();
    $result = array();
    $action = $_POST['action'];
    switch ($_POST['action']){
        case 'configTypeList' :
            $result = $metadata->getAllConfigTypes();
            break;
        case 'fetchConfig' :
            $result = $metadata->getAllConfig($_POST['configType']);
            break;            
        default : 
            break;
    }
    echo json_encode($result);
}

manageMetadata();