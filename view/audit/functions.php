<?php
function auditplan(){
if(isset($_POST['submit']))
{
GLOBAL $con;
$title=$_POST['title'];
$description=$_POST['description'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
$compliance=$_POST['compliance'];
$location=$_POST['location'];
$department=$_POST['department'];
$auditor=$_POST['auditor'];
$auditee=$_POST['auditee'];
$status=$_POST['status'];
$radio=$_POST['radio'];
$sql = "INSERT INTO `audit`(`title`,`description`,`start_date`,`end_date`,`compliance`,`location`,`department`,`auditor`,`auditee`,`frequency`,`status`) VALUES ('$title', '$description', '$start_date', '$end_date', '$compliance','$location', '$department', '$auditor', '$auditee', '$radio','$status')";
$result=mysqli_query($con,$sql);
if($result)
{
	header("Location:kickoff.php");
}
else
{
	echo "Error:".$sql."<br>" . mysqli_error($con);
}
}
}
?>
