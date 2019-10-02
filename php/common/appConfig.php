<?php

require_once __DIR__.'/dbOperations.php';

class AppConfig{
    static function getConfigValue($configKey, $cofigType){
        $resultArray = self::getAllConfigValuesForKey($configKey, $cofigType);
        $config = null;
        if (!empty($resultArray)){
            $config = $resultArray[0];    
            $confValue = $config['confVal'];
        }
        
        return $confValue;
    }
    
    static function getAllConfigValuesForKey($configKey, $cofigType){
        $sql = 'SELECT conf.config_key as confKey, conf.config_value as confVal from app_config conf, app_config_type type where conf.config_type_id = type.id and conf.config_key = ? and type.config_type = ?';
        $confValue = null;
        $paramArray = array($configKey, $cofigType);
        $dbOps = new DBOperations();
        $resultArray = $dbOps->fetchData($sql, 'ss', $paramArray);       
        return $resultArray;
    }    
    
    static function getAllConfigValues($cofigType){
        $sql = 'SELECT conf.id as id, conf.config_key as confKey, conf.config_value as confVal from app_config conf, app_config_type type where conf.config_type_id = type.id and type.config_type = ?';
        $confValue = null;
        $paramArray = array($cofigType);
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 's', $paramArray);
    }    
    
    static function getAllConfigTypes(){
        $sql = 'SELECT config_type from app_config_type';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
}
