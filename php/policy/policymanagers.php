<?php
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/dbOperations.php';

class policymanagers   
 { 

    function createmodule($getData)
    {
       $sql = "INSERT INTO `checkbox`(`name`, `company_id`) VALUES (?,?)";
             
        $paramArray = array();
        $paramArray[] = $getData->moduleselection;
        $paramArray[] = $getData->companyId;
        error_log("paramArray".print_r($paramArray,true));
        $dbOps = new DBOperations();                
        return $dbOps->cudData($sql,'si',$paramArray);  
    }
    public function getmodule($companyId){
    $sql="SELECT `name` FROM `checkbox` WHERE `company_id`=? ORDER BY `id` DESC";
        $dbOps = new DBOperations();
        $paramArray = array($companyId);
        return $dbOps->fetchData($sql, 's', $paramArray);   
    }
    // public function getdatafromsignup($id){
    //   $sql="SELECT `id`, `name`, `industry_id`, `plan_id`, `created_date`, `updated_by`, `updated_date` FROM `company` WHERE `id`=?";
    //   error_log("paramArray".print_r($paramArray,true));
    //    $dbOps = new DBOperations();
    //     $paramArray = array($id);
    //             // return $dbOps->fetchData($sql); 

    //     return $dbOps->fetchData($sql, 's', $paramArray); 
    // }



    public function getRequlaterynotification($companyId)
    {
 $sql="SELECT * FROM `regulatoryalert` WHERE  `company_id`=? and status='notify'";
        $dbOps = new DBOperations();
        $paramArray = array($companyId);
        return $dbOps->fetchData($sql, 'i', $paramArray);   
    }
      public function getseennotification($companyId)
    {
 $sql="SELECT * FROM `regulatoryalert` WHERE  `company_id`=? and status='seen'";
        $dbOps = new DBOperations();
        $paramArray = array($companyId);
        return $dbOps->fetchData($sql, 'i', $paramArray);   
    }
    

  public function updatealert($companyId)
    {
 $sql="UPDATE regulatoryalert SET status='seen' WHERE company_id=?";
        $dbOps = new DBOperations();
        $paramArray = array($companyId);
        return $dbOps->fetchData($sql, 'i', $paramArray);   
    }
    public function policynotification()
    {
    $sql="SELECT * FROM policy ORDER BY id DESC";
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyintoseen()
    {
        $sql = "UPDATE `policy` SET notification_status =0 WHERE notification_status =1";
        $dbOps = new dbOperations();
        return $dbOps->fetchData($sql);
    }
  
}