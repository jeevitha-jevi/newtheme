<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';

class CompanyManager {
    
    public function getAllCompanies(){
        $sql = 'SELECT c.id as companyId, c.name as companyName, i.name as industryName, c.industry_id as industryId FROM company c, industry i where c.plan_id = i.id';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    
    public function createCompanyData($companyData){
        $sql = 'INSERT INTO company(name, industry_id,updated_by,plan_id) VALUES (?,?,?,?)';
        $paramArray = array($companyData->companyName, $companyData->industry, $companyData->updated_by,
         $companyData->plan_id);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'siii', $paramArray); 
        error_log("location data". print_r($paramArray,true));
    }
    
    public function updateCompanyData($companyData){
        $sql = 'UPDATE company SET name=?, industry_id=?, updated_by=?, updated_date=? WHERE id=?';
        $paramArray = array($companyData->companyName, $companyData->industry, $companyData->loggedInUser, time(), $companyData->companyId);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'siiii', $paramArray);         
    }
    
    public function deleteCompanyData($companyData){
        $sql = 'DELETE FROM company WHERE id=?';
        $paramArray = array($companyData->companyId);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'i', $paramArray);       
    }
    public function getCompanyIdForUser($userId){
        $sql='SELECT c.id,c.name FROM company c,user u WHERE u.company_id=c.id and u.id=?';
        $paramArray= array($userId);
        $dbOps= new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }

     
}
