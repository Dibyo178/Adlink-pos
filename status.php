<?php


include_once("tokenconnect.php");

$Pid=$_GET['tid '];

$status=$_GET['status'];

$update_q="UPDATE tbl_token SET status=$status WHERE tid=$Pid";
 
mysqli_query($con,$update_q);

//header('location:tokenList.php');


?>