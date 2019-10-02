<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    function manage(){
      $metaData = new dashboard(); 
      switch ($_POST['action']){
        case 'create':
          $ticketData = getDataFromRequest();            
          $metaData->createSupportTicket($ticketData);
          break;  
        case 'update':
          $ticketData = getDataFromRequestForUpdate();            
          $metaData->updateSupportTicket($ticketData);
          break; 
        case 'delete':
          $ticketData = getDataDeleteSupport();  
          $metaData->deleteSupportTicket($ticketData);
           break;

      
        default :
          break;     	
      }            
}

    function getDataFromRequest(){
      $ticketData = new stdClass();
      $ticketData->title = $_POST['title'];
      $ticketData->customername = $_POST['customername']; 
      $ticketData->customeremail = $_POST['customeremail'];
      $ticketData->assignedto = '7'; 
      $ticketData->status = 'In Progress'; 
      // error_log("leela".print_r($ticketData,true));
      return $ticketData;  
        } 
    function getDataFromRequestForUpdate(){
      $ticketData=new stdClass();
      $ticketData->id=$_POST['id'];
      $ticketData->status=$_POST['status'];
      // error_log("leela".print_r($ticketData,true));
      return $ticketData;
    }
    function getDataDeleteSupport(){
      $ticketData=new stdClass();
      $ticketData->id=$_POST['complianceId_delete'];
        // $ticketData->customeremail=$_POST['customeremail'];
      error_log("paramArray".print_r($ticketData,true));
      return $ticketData;     
    }

    manage();
?>