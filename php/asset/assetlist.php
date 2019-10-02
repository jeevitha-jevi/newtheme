<?php
require_once __DIR__.'/assetManager.php';

function fetchAll(){
    $manager = new AssetManager();
    $userId = $_POST['userId'];
    $userRole = $_POST['userRole'];
    $string=$_POST['string'];
    error_log(print_r($string,true));

if(strpos($string, 'all') !== false){
        error_log(print_r( $string,true));
    $allAssets = $manager->getAllAssets($userId, $userRole);
	}
	else{

         if(strpos($string,'Non Digital Assets') !== false)
       { $string="Non Digital Assets";} 

       else{

       if(strpos($string, 'Desktops') !== false)
       { $string="Desktops";}  

    if(strpos($string, 'Media') !== false)
       { $string="Media";}  

    if(strpos($string, 'Network Devices') !== false)
       { $string="Network Devices";} 

    if(strpos($string, 'Servers') !== false)
       { $string="Servers";}  

    if(strpos($string, 'Support Utilities') !== false)
       { $string="Support Utilities";}  
    
    if(strpos($string, 'Software') !== false)
       { $string="Software";}

    if(strpos($string, 'Laptops') !== false)
       { $string="Laptops";}

    if(strpos($string, 'Desktops') !== false)
       { $string="Desktops";} 

     if(strpos($string, 'Network Devices') !== false)
       { $string="Network Devices";}

       if(strpos($string,'Source Code') !== false)
       { $string="Source Code";}
   
       if(strpos($string,'Digital Assets') !== false)
       { $string="Digital Assets";}  
  }




	 $allAssets = $manager->getAllAssetsBasedOnGroup($userId, $userRole,$string);
     
	}

    echo json_encode($allAssets);
}

fetchAll();
?>