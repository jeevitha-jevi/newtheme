<?php

session_start();

if (!isUserCredentialsPresent()){
    header('Location:../../index.php');
}

function isUserCredentialsPresent(){
    return isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_role']);
}
