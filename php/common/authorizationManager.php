<?php

require_once __DIR__.'/appConfig.php';

class AuthorizationManager{
    static function isMenuAuthorized($menu, $userRole){
        return self::isAuthorized('authorised_menu_for_role', $menu, $userRole);
    }
    
    static function isAuthorized($configType, $resource, $userRole){
        $isAuthorized = false;
        $authorizedResourcesForRole = AppConfig::getAllConfigValuesForKey($userRole, $configType);
        foreach($authorizedResourcesForRole as $authRes){
            if ($resource == $authRes['confVal']){
                $isAuthorized = true;
                break;
            }
        }
        return $isAuthorized;
    }
}