<?php
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';

class SignupManager{
	public function saveCompany($signupData){
        $sql = 'INSERT INTO company(name,plan_id) VALUES (?,?)';        
        $paramArray = array($signupData->company,$signupData->plan);          
        $dbOps = new DBOperations();
        error_log("paramArray".print_r($paramArray,true));        
        return $dbOps->cudData($sql, 'si', $paramArray);
    }
    public function saveUser($signupData){
        $sql = 'INSERT INTO user(last_name, password, email, company_id) VALUES (?,?,?,?)';        
        $paramArray = array($signupData->name, $signupData->password, $signupData->email, $signupData->company);          
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'sssi', $paramArray);
    }
    public function saveasSuperAdmin($signupData){
        $sql = 'INSERT INTO user_role(user_id, role_id) VALUES (?,?)';        
        $paramArray = array($signupData->user,1);          
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'ii', $paramArray);
    }
    public function checkCompanyandUser($signupData){
        $sql = 'SELECT c.name, u.email FROM user u,company c WHERE c.name=? or u.email=?';        
        $paramArray = array($signupData->company, $signupData->email);          
        $dbOps = new DBOperations();        
        return $dbOps->fetchData($sql, 'ss', $paramArray);  
    }
    public function updateCompanyPlan($subDetails){
        $sql= 'UPDATE company SET plan_id=? WHERE id=?';
        $paramArray=array($subDetails->plan,$subDetails->company);
        $dbOps=new DBOperations();
        error_log("subdata".print_r($paramArray,true));
        return $dbOps->cudData($sql,'ii',$paramArray);

    }

}
