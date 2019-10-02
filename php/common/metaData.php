<?php

require_once __DIR__.'/dbOperations.php';
require_once __DIR__.'/appConfig.php';

class MetaData{
    
    public function getAllCompanies(){
        $sql = 'SELECT * from company';
        return $this->fetchDataFromDB($sql);
    }
    
    public function getAllRoles(){
        $sql = 'SELECT * from role';
        return $this->fetchDataFromDB($sql);
    }    
    
    public function getAllIndustries(){
        $sql = 'SELECT * from industry';
        return $this->fetchDataFromDB($sql);
    }
    public function getAllFormFields(){
        $sql = 'SELECT * from form_field_type';
        return $this->fetchDataFromDB($sql);
    }
    
    public function getFormFieldTypeIdByType($formFieldType){
        $sql = 'SELECT id from form_field_type where type=?';
        $paramArray = array($formFieldType);
        $dbOps = new DBOperations();
        $result = $dbOps->fetchData($sql, 's', $paramArray);
        return $result[0]['id'];
    }
    
    private function fetchDataFromDB($sql){
        $dbOps = new DBOperations();
        $dataFromDB = $dbOps->fetchData($sql);
        return $dataFromDB;         
    }
    
    public static function isMultiChoice($formFieldType){
        $multChoiceFormFields = array(2,3);
        return in_array($formFieldType, $multChoiceFormFields);
    }
    
    public static function getMlChoiceControl($formFieldType){
        $mlChoiceControl = '';
        switch ($formFieldType) {
            case 2:// multi_choice_checkboxes
                $mlChoiceControl = "checkbox";
                break;
            case 3:// multi_choice_radio
                $mlChoiceControl = "radio"; 
                break;
            default:
                break;
        }
        return $mlChoiceControl;
    }   
    
    // Checks whether $currentStatus > $statusComparedWith
    public static function isAuditStatusGreaterThan($currentStatus, $statusComparedWith){
        /* Audit Status Order
        1. create
        2. prepare pending
        3. prepared
        4. perform pending
        5. performed
        6. approval pending
        7. returned
        8. capa pending
        9. approved
        10. publish pending
        11. published */
        $currentStatusOrder = AppConfig::getConfigValue($currentStatus, 'audit_status_order');
        $comparedStatusOrder = AppConfig::getConfigValue($statusComparedWith, 'audit_status_order');
        return $currentStatusOrder > $comparedStatusOrder;
    } 
    
    public function getAllConfigTypes(){
        $configTypes = array('Role', 'Form Field Types');
        $configTypeArray = AppConfig::getAllConfigTypes();
        foreach ($configTypeArray as $configType){
            $configTypes[] = $configType['config_type'];
        }
        return $configTypes;
    }
    
    public function getAllConfig($configType){
        $allConfigValues = array();
        switch ($configType) {
            case 'Role' :
                $allConfigValues = $this->getRoleConfigValues();
                break;
            case 'Form Field Types' : 
                $allConfigValues = $this->getFormFieldTypeConf();
                break;    
            default :
                $allConfigValues = $this->getAllAppConfig($configType);
                break;                 
        }
        return $allConfigValues;
    }
    
    private function getRoleConfigValues(){
        $roles = $this->getAllRoles();
        $configValuesArray = array();
        foreach ($roles as $role){
            $config = array();
            $config['configId'] =  $role['id'];
            $config['confKey'] = $role['name'];
            $config['confValue'] = $role['description'];
            $configValuesArray[] = $config;
        }
        return $configValuesArray;
    }
    
    private function getFormFieldTypeConf(){
        $formFields = $this->getAllFormFields();
        $configValuesArray = array();
        foreach ($formFields as $formField){
            $config = array();
            $config['configId'] =  $formField['id'];
            $config['confKey'] = $formField['type'];
            $config['confValue'] = $formField['description'];
            $configValuesArray[] = $config;
        }
        return $configValuesArray;        
    }   
    
    private function getAllAppConfig($configType){
        $allAppConfigs = AppConfig::getAllConfigValues($configType);
        $configValuesArray = array();
        foreach ($allAppConfigs as $appConfig){
            $config = array();
            $config['configId'] =  $appConfig['id'];
            $config['confKey'] = $appConfig['confKey'];
            $config['confValue'] = $appConfig['confVal'];
            $configValuesArray[] = $config;
        }
        return $configValuesArray;        
    }     
}
