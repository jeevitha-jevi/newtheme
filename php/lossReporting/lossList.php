<?php
require_once __DIR__.'/lossManager.php';
function fetchAll(){
    $manager = new lossManager();   
    $allData = $manager->getAllLists();
    echo json_encode($allData);
}
fetchAll();