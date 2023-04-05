<?php
 
include_once'connectdb.php';


 // does not showw error message 

 error_reporting(E_ERROR | E_PARSE);

session_start();

 if($_SESSION['username']=="" OR $_SESSION['role']==""){
      
      header("location:index.php");
  }


if($_SESSION['role']=="Admin"){
      
     include_once 'header.php';
  }
 else{
     
     include_once 'headeruser.php';
 }



// include_once 'header.php';

$id=$_GET['id'];

$select=$pdo->prepare("select * from tbl_customer where cid=$id");
$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db=$row['cid'];


$address_db=$row['c_address'];

$customer_db=$row['c_name'];

$mobile_db=$row['c_mobile'];


//update product list


if(isset($_POST['btnupdate'])){
    
    $paid_db=$row['paid'];

$due_db=$row['due'];


    
    
    $address_txt=$_POST['txtaddress']; 
    
    $customer_txt=$_POST['txtcustomer']; 
    
    $mobile_txt=$_POST['txtnumber']; 
    

        
 $update=$pdo->prepare("update tbl_customer set c_name=:cname,  	c_mobile=:mobile , c_address=:address where cid = $id");
        
      
     $update->bindParam(':address',$address_txt);  
     $update->bindParam(':cname',$customer_txt);    
        
     
   
     $update->bindParam(':mobile',$mobile_txt); 
 
    
    $update->execute();
        
        

}

$select=$pdo->prepare("select * from  tbl_customer where cid=$id");
$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db=$row['cid'];
$address_db=$row['c_address'];
$customer_db=$row['c_name'];
$mobile_db=$row['c_mobile'];



?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edit Customer
<!--        <small>Optional description</small>-->
      </h1>
<!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
-->
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
                <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Customer Update Form</h3>
            </div>
            
             <form action="" method="post"  name="formproduct" enctype="multipart/form-data" >

            
           <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Customer name</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>


                                <input type="text" value="<?php echo $customer_db;?>" class="form-control" name="txtcustomer" placeholder="Enter Customer Name" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label> Customer Mobile</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>


                                <input type="text"  value="<?php echo $mobile_db;?>" class="form-control" name="txtnumber" placeholder="Enter Customer Mobile" 
                                
                                  required>
                            </div>
                        </div>
                        
                        
                       
                        
                    </div>
                    <div class="col-md-6">

                       
                        <div class="form-group">
                            <label> Customer Address</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker"></i>
                                </div>


                                <input type="text" value="<?php echo $address_db;?>" class="form-control" name="txtaddress" placeholder="Enter Customer Mobile" 
                                
                                  required>
                            </div>
                        </div>
                        
                                             
                         
                    </div>
                </div>

            <div class="box-footer" align="center">
             
             
                  
                    
        <button type="submit" class="btn btn-warning" name="btnupdate">Edit Customer</button>            
                   
         </div>
             
        </form>
        
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
<!-- add footer-->


<?php 
 
  include_once 'footer.php';
  
?>