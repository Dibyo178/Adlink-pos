<?php
 
//header.php file include
include_once 'connectdb.php';

 session_start();
 
  if($_SESSION['username']==""){
      
      header("location:index.php");
  }

if($_SESSION['role']=="Admin"){
     include_once 'header.php';
}
else{
    include_once 'headeruser.php';
}



//when click on upadte password button we get out value from user into variables


if(isset($_POST['btnupdate'])){
    
    $oldpassword_txt=$_POST['txtoldpass'];
    $newpassword_txt=$_POST['txtnewpass'];
    $confirmpassword_txt=$_POST['txtconfirmpass'];

 




//using of select query we get out database record according to useremeil/username
    
    
    $name=$_SESSION['username'];
    
    $select=$pdo->prepare("select * from tbl_user where username='$name'");
    
    $select->execute();
    $row=$select->fetch(PDO::FETCH_ASSOC);
    
    $username_db= $row['username'];
    $password_db= $row['password'];
    
//we compare userinput and database values

    if($oldpassword_txt==$password_db){
        
        if($newpassword_txt==$confirmpassword_txt){
            
            
            //if values matched then we run update query
            
           $update=$pdo->prepare("update tbl_user set password=:pass where username=:name");
            
            $update->bindParam(':pass', $confirmpassword_txt);
            
            $update->bindParam(':name', $name);
            
            if($update->execute()){
                 
                  echo '<script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Congratulations!",
              text: "Your Password Updated Successfull",
              icon: "success",
             button: "Ok",
         })
             
             });
         </script>';
            }
            else{
                   
                 echo '<script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Error!",
              text: "Password Not Updated",
              icon: "warning",
             button: "Back",
         })
             
             });
         </script>';
            }
        }
        else{
            
             echo '<script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Opps!",
              text: "New and Confirm password are not matching",
              icon: "error",
             button: "Ok",
         })
             
             });
         </script>';
//               echo 'New and Confirm password are not matching';
        }
    }
    
    else{
        
          echo '<script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Old Password does not Macth!",
              text: "Try again",
              icon: "warning",
             button: "Back",
         })
             
             });
         </script>';
    }
    
    

 
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Change Password
    
      </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
         <!-- form of password change -->
         
          <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
              
                <div class="form-group">
                  <label for="exampleInputPassword1">Old Password</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" name='txtoldpass' required>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">New Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name='txtnewpass' required>
                </div>
                
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name='txtconfirmpass' required>
                </div>
              
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"name='btnupdate'>Update</button>
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
