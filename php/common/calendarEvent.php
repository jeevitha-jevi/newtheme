<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    $userid=$_POST['userId'];
    $metaData = new dashboard();
    $events = $metaData->calendarEvents();
    echo json_encode($events);

    function manage(){
      $metaData = new dashboard(); 

      switch ($_POST['action']){
        case 'create':
          $eventData = getDataFromRequest();            
          $metaData->createEvent($eventData);
          break;
        case 'update':
          $eventData = getDataFromRequest();            
          $metaData->eventUpdate($eventData);
          break;
        default :
          break;     	
      }            
      
    }

    function getDataFromRequest(){
      $eventData = new stdClass();
      $eventData->id = $_POST['id'];
      $eventData->event = $_POST['event']; 
      $eventData->event_date = $_POST['event_date'];
          $eventData->action = $_POST['action'];     
      return $eventData;
    } 

    manage();
    
?>

