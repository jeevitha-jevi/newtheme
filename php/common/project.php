<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    function manage(){
      $metaData = new dashboard(); 

      switch ($_POST['action']){
        case 'create':
          $projectData = getDataFromRequest();            
          $metaData->createProject($projectData);
          break;
        case 'update':
          $taskData = getDataFromRequest();            
          $metaData->updateProject($projectData);
          break;        
        default :
          break;     	
      }            
      
    }

    function getDataFromRequest(){
      $projectData = new stdClass();
      $projectData->id = $_POST['id'];      
      $projectData->projectname = $_POST['projectname'];
      $projectData->projectDescription = $_POST['projectDescription']; 
      $projectData->assignedto = implode(',',$_POST['assignedto']);      
      return $projectData;
    } 

    manage();
    
?>

