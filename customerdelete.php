<?php

include_once'connectdb.php';

if($_SESSION['useremail']=="" OR $_SESSION['role']=="User"){
    
    
    header('location:index.php');
}


$id=$_POST['pidd'];


$sql="delete from tbl_customer where cid=$id";

$delete=$pdo->prepare($sql);


if($delete->execute()){
    
    
}else{
    
  echo'Error in Deleting';  
}






?>