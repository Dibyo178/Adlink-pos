<?php 

//include('tokenconnect.php');

$con=mysqli_connect("localhost","root","","adlink_pos");


$id=$_GET['tpid'];

$status=$_GET['pro_status'];


$q="update tbl_tokenproduct set pro_status=$status where tpid=$id";

mysqli_query($con,$q);

header('location:productiontoken.php');



?>