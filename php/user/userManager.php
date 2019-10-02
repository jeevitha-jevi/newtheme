<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/dbOperations.php';


class UserManager {
    public function getUserRole($userId){
        $sql = 'SELECT r.id as roleId, r.name as roleName FROM role r, user_role ur where r.id=ur.role_id and ur.user_id = ?';
        $paramArray = array($userId);
        $dbOps = new DBOperations();
        $resultArray = $dbOps->fetchData($sql, 'i', $paramArray);
        $role = null;
        if (!empty($resultArray)){
            $role = $resultArray[0];    
            $roleHomeRouteKey = $role['roleName'].'_home';
            $roleHomeRoute = AppConfig::getConfigValue($roleHomeRouteKey, CONF_KEY_ROUTING);
            $role['route'] = $roleHomeRoute;
        }        
        return $role;
    }
    
    public function getAllUsersByRole($roleId){
        $sql = 'SELECT u.id as userId, u.last_name as lastName, u.first_name as firstName, u.middle_name as middleName, u.email as userEmail from user u, user_role ur where u.id = ur.user_id and ur.role_id=?';
        $dbOps = new DBOperations();
        $paramArray = array($roleId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }

    public function getAllUsersByRoleAndCompany($roleId,$companyId){
        $sql = 'SELECT u.id as userId, u.last_name as lastName, u.first_name as firstName, u.email as userEmail from user u, user_role ur where u.id = ur.user_id and ur.role_id=? and u.company_id=?';
        $dbOps = new DBOperations();
        $paramArray = array($roleId,$companyId);
        return $dbOps->fetchData($sql, 'ii', $paramArray);        
    }

    
    public function getAllUsers($companyId){
        $sql = 'SELECT u.id, u.first_name as firstName, u.last_name as lastName, u.email, r.name as role,r.id as roleId from user u, role r, user_role ur, company c where ur.user_id = u.id and ur.role_id = r.id and u.company_id = c.id and c.id=?';
        $paramArray=array();
        $paramArray[]=$companyId;
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    
    public function createUserData($userData){
        $this->createUser($userData);
        $createdUser = $this->getUserByEmail($userData->email);
        $this->createUserRole($userData, $createdUser);
        return $createdUser;
    }
    
    private function createUser($userData){
        $sql = 'INSERT INTO user(last_name, first_name, middle_name, password, email, company_id,string) VALUES (?,?,?,?,?,?,?)';
        $paramArray = array($userData->lastName, $userData->firstName, $userData->middleName, 'freshgrc', $userData->email, $userData->company,$userData->string);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'sssssis', $paramArray);        
    }
    
    private function getUserByEmail($email){
        $sql = 'SELECT * from user where email = ?';
        $paramArray = array($email);
        $dbOps = new DBOperations(); 
        $resultArray = $dbOps->fetchData($sql, 's', $paramArray);
        $user = null;
        if (!empty($resultArray)){
            $user = $resultArray[0];
        }
        return $user;
    }
    
    private function createUserRole($userData, $createdUser){
        $sql = 'INSERT INTO user_role(user_id, role_id) VALUES (?, ?)';
        $paramArray = array($createdUser['id'], $userData->role);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'ii', $paramArray);         
    }
    
    public function updateUserData($userData){
        $this->updateUser($userData);
        $this->updateUserRole($userData);
    }
    
    private function updateUser($userData){
        $sql = 'UPDATE user SET last_name=?,first_name=?,middle_name=?,company_id=? WHERE email=?';
        $paramArray = array($userData->lastName, $userData->firstName, $userData->middleName, $userData->company, $userData->email);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'sssis', $paramArray);         
    }
    
    private function updateUserRole($userData){
        $sql = 'UPDATE user_role SET role_id=? WHERE user_id=?';
        $paramArray = array($userData->role, $userData->userId);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'ii', $paramArray);         
    }
    
    public function deleteUserData($userData){
        $this->deleteUserRole($userData);
        $this->deleteUser($userData);        
    }
    
    private function deleteUser($userData){
        $sql = 'DELETE FROM user WHERE id=?';
        $paramArray = array($userData->userId);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'i', $paramArray);         
    }
    
    private function deleteUserRole($userData){
        $sql = 'DELETE FROM user_role WHERE user_id=?';
        $paramArray = array($userData->userId);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'i', $paramArray);         
    } 
    
    public function updateUserActivity($userId, $isLoggedIn){
        if ($isLoggedIn){
            $sql = 'INSERT INTO user_activity_log(user_id) VALUES (?)';            
        } else {
            $sql = "UPDATE user_activity_log SET logged_out_time=current_timestamp WHERE user_id = ? and logged_out_time is null";
        }
        $paramArray = array($userId);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'i', $paramArray);         
    }

     public function getAllUserDetailsForProfile($userId, $userRole){
        $sql = 'SELECT u.first_name as firstName, u.last_name as lastName, up.user_id as UserId, up.mobile_number as MobileNumber,up.facebook as Facebook,up.industry as Industry,up.twitter as Twitter,up.site as Site,up.image_name as file FROM user u, user_profile up WHERE u.id=up.user_id and u.id=?';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }

    public function updateUserProfileData($userData){
        $sql = 'UPDATE user u, user_profile up SET u.first_name=?, u.last_name=?, up.mobile_number=?, up.facebook=?, up.industry=?, up.twitter=?,up.site=?  WHERE u.id=up.user_id and u.id=?';
        $paramArray = array($userData->firstname, $userData->lastname, $userData->mobileno,$userData->facebook,$userData->industry,$userData->twitter,$userData->site,$userData->loggedInUser);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'ssissssi', $paramArray);         
    }
     public function updateUserProfilePicture($userData){
        $sql = 'UPDATE user u, user_profile up SET  up.image_name=?  WHERE u.id=up.user_id and u.id=?';
        $paramArray = array($userData->imagename, $userData->loggedInUser);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'si', $paramArray);         
    }
     public function createUserProfileData($userData){
        $sql = 'INSERT INTO `user_profile`(`user_id`) VALUES (?)';
        $paramArray = array($userData);
        error_log("inside Manager".print_r($userData,true));
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'i', $paramArray);         
    }
       public function getUserPassword($string){
        $sql = 'SELECT id,email FROM user  WHERE string = ?';
        $paramArray = array($string); 
        $dbOps = new DBOperations();        
        return $dbOps->fetchData($sql, 's', $paramArray); 
    }
     public function resetPassword($resetData){
        $sql = 'UPDATE user SET password=?,string=? WHERE id = ?';
        $paramArray = array($resetData->password,"nothing",$resetData->id); 
        $dbOps = new DBOperations();        
        error_log("paramArray".print_r($paramArray,true));
        return $dbOps->cudData($sql, 'ssi', $paramArray); 
    }
    public function getUserNameById($id){
        $sql='SELECT id as userId,last_name as lastName,email FROM user WHERE id=?';
        $paramArray=array($id);
        $dbOps= new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function getAuditorById(){
        $sql='SELECT id as userId,last_name as lastName,email FROM user WHERE id=7';
        $dbOps= new DBOperations();
        return $dbOps->fetchData($sql);
    }

        public function getfooter(){
        $sql = 'SELECT * FROM bcpm_footer';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

    

     public function getPlan($planId){
        $sql='SELECT name,amount,id,stripe_plan_id FROM plan WHERE id=?';
        $paramArray=array($planId);
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
     }
     
    public function getCompanyDetails($email){
        $sql='SELECT c.id,c.name FROM company c,user u WHERE u.company_id=c.id and u.email=?';
        $paramArray=array($email);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'s',$paramArray);
    }
    public function getstripData($email)
    {
         $sql="SELECT s.current_period_end as end_day,s.id as id FROM subscription as s,user as u WHERE s.company_id=u.company_id and u.email=?";
        $paramArray=array($email);
        $dbOps=new DBOperations();
                error_log("Address".print_r($paramArray,true));

        return $dbOps->fetchData($sql,'s',$paramArray);
    }

}