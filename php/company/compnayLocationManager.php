<?php

require_once __DIR__.'/../common/constants.php';
require_once  __DIR__.'/../common/dbOperations.php';
class CompnayLocationManager {

      public function getAllCompaniesLocation($companyId){
        $sql = 'SELECT `id`, `name`, `city`, `state`,`country`, `postal_code`,`address_line1`, `address_line2`  FROM `bu_location`';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function createLocation($locationDetails){
       
         $sql = 'INSERT INTO `bu_location`( `name`, `bu_id`, `address_line1`, `address_line2`, `city`, `state`, `country`, `postal_code`, `created_by`) VALUES (?,?,?,?,?,?,?,?,?)';
         $paramarray=array($locationDetails->areaName,$locationDetails->companyId,$locationDetails->addressLine1,$locationDetails->addressLine2,$locationDetails->cityName,$locationDetails->stateName,$locationDetails->countryName,$locationDetails->postalCode,$locationDetails->loggedInuser);
         $dbOps=new DBOperations();
          error_log("location inside maanager data". print_r($locationDetails->loggedInuser,true));
            return $dbOps->cudData($sql,'sissssssi',$paramarray);  
         /*return $dbOps->cuData($sql,'sissssssi',$paramarray);*/

    }
    public function updateLocation($locationDetails)
    {
        error_log("location inside maanager data". print_r($locationDetails,true));
        $sql='UPDATE `bu_location` SET `name`=?,`bu_id`=?,`address_line1`=?,`address_line2`=?,`city`=?,`state`=?,`country`=?,`postal_code`=?,`updated_by`=?,`updated_date`=? WHERE id=?';
         $paramarray=array($locationDetails->areaName,$locationDetails->companyId,$locationDetails->addressLine1,$locationDetails->addressLine2,$locationDetails->cityName,$locationDetails->stateName,$locationDetails->countryName,$locationDetails->postalCode,$locationDetails->loggedInuser,date("Y-m-d h:i:s"),$locationDetails->id);
         $dbOps=new DBOperations();
          return $dbOps->cudData($sql,'sissssssisi',$paramarray);

    }
    public function deleteLocation($locationData){
        $sql = 'DELETE FROM `bu_location` WHERE `id`=?';
        $paramArray = array(
        $locationData->complianceId_delete,
        );
        error_log("paramArray".print_r($paramArray,true));
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'i', $paramArray);         
    }

  
}

?>