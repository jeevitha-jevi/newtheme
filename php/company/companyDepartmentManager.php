<?php

require_once __DIR__.'/../common/constants.php';
require_once  __DIR__.'/../common/dbOperations.php';
class CompnayDepartmentManager {

	  public function getAllCompaniesDepartment(){      
	  	  $sql = 'SELECT bd.id,bd.location_id, bd.name,bd.description FROM bu_deparment bd ORDER BY bd.id DESC';
        $paramarray=array($locationId);
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramarray);
    }
  
    public function createDepartment($departmentDetails){
       
         $sql = 'INSERT INTO `bu_deparment`( `name`,`location_id`, `description` ) VALUES (?,?,?)';
         $paramarray=array($departmentDetails->name,$departmentDetails->locationId,$departmentDetails->description);
         $dbOps=new DBOperations();
          error_log("location inside maanager data". print_r($departmentDetails->loggedInuser,true));
            return $dbOps->cudData($sql,'sis',$paramarray);  
        
    }
    public function updateDepartment($departmentDetails){
      $sql='UPDATE `bu_deparment` SET `location_id`=?,`name`=?,`description`=? WHERE id=? ';
      $paramarray=array($departmentDetails->locationId,$departmentDetails->name,$departmentDetails->description,$departmentDetails->id);
      $dbOps=new DBOperations();
      return $dbOps->cudData($sql,'issi',$paramarray);
    }
    public function deleteDepartment($departmentDetails){
      $sql='DELETE FROM `bu_deparment` WHERE id=?';
      $paramarray=array($departmentDetails->id);
      $dbOps=new DBOperations();
      return $dbOps->cudData($sql,'i',$paramarray);
    }

    

	}

?>