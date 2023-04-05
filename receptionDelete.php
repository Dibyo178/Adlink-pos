<?php

include_once'connectdb.php';

if($_SESSION['useremail']=="" OR $_SESSION['role']=="User"){
    
    
    header('location:index.php');
}


$id=$_POST['pidd'];


$sql="delete from tbl_recepintiontoken where rid =$id";

$delete=$pdo->prepare($sql);


if($delete->execute()){
    
    
}else{
    
  echo'Error in Deleting';  
}






?>