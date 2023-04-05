<?php include('tokenconnect.php');


$id=$_GET['id'];

$status=$_GET['status'];


$q="update tbl_warehouse set status=$status where id=$id";

mysqli_query($con,$q);

header('location:warehousetokenlist.php');



?>