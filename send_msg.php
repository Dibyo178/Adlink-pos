<?php


//include_once 'connectdb.php';

include_once 'tokenconnect.php';

 session_start();

$msg="";

if(!isset($_SESSION['userid'])){
    
    ?>
    <script>
        
        window.location.href='index.php';
          
  </script>
  
  <?php
}



 
  if($_SESSION['username']=="" OR $_SESSION['role']=="User"){
      
      header("location:index.php");
  }

 include_once 'header.php';

 error_reporting(0);


  $uid=$_SESSION['userid'];

if(isset($_POST['btnsave'])){

$to_id=mysqli_real_escape_string($con,$_POST['txtselect_option']);
    
$description=mysqli_real_escape_string($con,$_POST['txtdescription']);


   mysqli_query($con,"insert into tbl_notify(form_id,to_id,message) values('$uid','$to_id','$description')");
    
    
    
    $msg="Message Send";

    
    
}


$res_msg=mysqli_query($con,"select form_id,message from  tbl_notify where status=0 and to_id='$uid' ");


$unread_count=mysqli_num_rows($res_msg);

$sql= "select userid,username from tbl_user ";

$res_user=mysqli_query($con,$sql);



?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Message Sent
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
            <div class="box-header with-border">
<!--              <h3 class="box-title">Quick Example</h3>-->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method='post'>
              <div class="box-body">
              
              <div class="col-md-6">
              
                 <div class="form-group">
                  <label>User</label>
                  <select class="form-control" name="txtselect_option" required>
                   <option value="" disabled selected>Select User</option>
                    <?php 
            
                      
                      while($row=mysqli_fetch_assoc($res_user)){
                         
                            
                      ?>
                      
                      <option value="<?php echo $row['userid']; ?>"><?php echo $row['username']; ?></option>
                      
                      <?php
                      }
                      
                      ?>
                       
                  </select>
                </div>
                         
                         
                     <div class="form-group">
                  <label >Description</label>
                   <textarea name="txtdescription" class="form-control" rows="4"></textarea>
                </div>         
                          
                           <!-- save button-->
                                   
       <button type="submit" name='btnsave' class="btn btn-info">Sent</button>
              
        <span style="color:red"><?php echo $msg;?></span>      

              </div>
             
              </div>
               
             
               
               <div>
                   
               </div>


              </div>
              <!-- /.box-body -->

<!--
              <div class="box-footer">
              </div>
-->
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