<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/dbOperations.php';

class SuperadminManager {   
    public function checkUserMailAuthendication($userMail){
        $sql = 'SELECT u.email, u.company_id, c.id, c.name FROM user u, company c WHERE email=? AND u.company_id=c.id
';
        $paramArray = array();
        $paramArray[] = $userMail;
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 's', $paramArray);         
    } 
}
