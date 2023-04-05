<?php
 
include_once'connectdb.php';

session_start();

if($_SESSION['username']=="" OR $_SESSION['role']==""){
      
      header("location:index.php");
  }



if(isset($_POST['btnsaveorder'])){
    
    $customer_address=$_POST['txtaddress'];
    $customer_name=$_POST['txtcustomer'];

    $mobile=$_POST['txtnumber'];

    $insert=$pdo->prepare("insert into tbl_customer(c_name,c_mobile,c_address) values(:cust,:mobile,:address)");
    
    
      
   
    
     $insert->bindParam(':address',$customer_address);
     $insert->bindParam(':cust',$customer_name);
     $insert->bindParam(':mobile',$mobile);
    
    $insert->execute();
    
}


if($_SESSION['role']=="Admin"){
      
     include_once 'header.php';
  }
 else{
     
     include_once 'headeruser.php';
 }


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Customer
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

        <div class="box box-danger">
            <form action="" method="post" name="formproduct" enctype="multipart/form-data">
                <div class="box-header with-border">
                    <h3 class="box-title">Customer Form</h3>
                </div>



                <!--this is for customer and date-->
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Customer name</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>


                                <input type="text" class="form-control" name="txtcustomer" placeholder="Enter Customer Name" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label> Customer Mobile</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>


                                <input type="text" class="form-control" name="txtnumber" placeholder="Enter Customer Mobile" 
                                
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


                                <input type="text" class="form-control" name="txtaddress" placeholder="Enter Customer Mobile" 
                                
                                  required>
                            </div>
                        </div>
                        
                                             
                         
                    </div>
                </div>

                <!--this for table-->
                
                  <div class="box-footer" align="center">
                    
                    
                     <button  type="submit" name='btnsaveorder' class="btn btn-info">Add Customer</button>

              </div>
               
            </form>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- add footer-->

<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });

    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    });


   
</script>




<?php 
 
  include_once 'footer.php';
  
?>
