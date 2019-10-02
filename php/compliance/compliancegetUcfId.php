<?php
require_once __DIR__.'/complianceManager.php';

function manage(){
    $manager = new ComplianceManager();

    
            $LibraryId=$manager->getUcfId();
            echo json_encode($LibraryId);
        
    }




manage();
