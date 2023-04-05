<?php 

//include('tokenconnect.php');

$con=mysqli_connect("localhost","root","","adlink_pos");


$id=$_GET['tid'];

$status=$_GET['status'];


$q="update tbl_token set status=$status where tid =$id";

mysqli_query($con,$q);

header('location:tokenList.php');



?>