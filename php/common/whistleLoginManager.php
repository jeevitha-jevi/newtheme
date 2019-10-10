<?php
require_once __DIR__.'/config.php';
session_id("whistle");
session_start();
if(isset($_POST['company_search'])) 
{
  $company_search=$_POST['company_search'];
  $result = mysqli_query($link,"SELECT * FROM company WHERE name = '". $company_search ."'");

  if($row = mysqli_fetch_array($result))
  {

    $_SESSION['company_id'] = $row['id'];
    $_SESSION['company_name'] = $row['name'];
    echo json_encode($_SESSION['company_name']);
    //error_log("session variable".print_r($_SESSION['company_id'],true));
    error_log("session variables".print_r(session_id(),true));


  }
}
?>