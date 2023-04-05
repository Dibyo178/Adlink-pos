<?php


include_once 'connectdb.php';

 session_start();


 
  if($_SESSION['username']=="" OR $_SESSION['role']=="User"){
      
      header("location:index.php");
  }

 include_once 'header.php';

 error_reporting(0);

if(isset($_POST['btnsave'])){


$username=$_POST['txtname'];
$useremail=$_POST['txtemail'];
$password=$_POST['txtpassword'];
$userrole=$_POST['txtselect_option'];

    
//    echo $username."-".$useremail."-".$password."-".$role;
    
    if(isset($_POST['txtemail'])){
        
        $select=$pdo->prepare("select useremail from tbl_user where useremail='$useremail'");
        
        $select->execute();
        
        
        if($select->rowCount()>0){
            
                echo '<script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Warning!!",
              text: "Email already exist!! Try again another email.",
              icon: "warning",
             button: "ok",
         })
             
             });
         </script>';
            
        }
        else{
            
            $insert=$pdo->prepare("insert into tbl_user(username,useremail,password,role)
              values(:name,:email,:pass,:role)");
    
    $insert->bindParam(':name',$username);
    
    $insert->bindParam(':email',$useremail);
    
    $insert->bindParam(':pass',$password);
    
    $insert->bindParam(':role',$userrole);
    
    
    if($insert->execute()){
        
                
                 echo '<script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Good Job",
              text: "Your Registration is successfull",
              icon: "success",
             button: "ok",
         })
             
             });
         </script>';
    }
    else{
        
        echo '<script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Error!",
              text: "Registration is fail!
              icon: "error",
             button: "ok",
         })
             
             });
         </script>';
    }
     
             
        }
    }
    
    
    
}

//delete btn


if(isset($_GET['id'])){
    
    $delete=$pdo->prepare("delete from tbl_user where userid=".$_GET['id']);
    
   
    
 if( $delete->execute()){
     
     
    echo '<script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Account !!",
              text: "Delete",
              icon: "warning",
             button: "ok",
         })
             
             });
         </script>';
 }
}
else{
    
    
}


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Registration
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
              
              <div class="col-md-4">
                  <div class="form-group">
                  <label >Name</label>
                  <input type="Name" name="txtname" class="form-control" id="exampleInputName" placeholder="Enter a name" required>
                </div>
                  
                     <div class="form-group">
                  <label >Email address</label>
                  <input type="email" name='txtemail' class="form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name='txtpassword' class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                </div>
                
                 <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" name="txtselect_option" required>
                   <option value="" disabled selected>Select Role</option>
                    <option>Admin</option>
                    <option>User</option>
                    <option>grapic</option>
                    <option>production</option>
                    <option>warehouse</option>
                    
                    
                     
                  </select>
                </div>
                          
                           <!-- save button-->
                                   
       <button type="submit" name='btnsave' class="btn btn-info">Save</button>

              </div>
              <div class="col-md-8">
                
                    <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Password</th>
                                  <th>Role</th>
                                  <th>Delete</th>
                              </tr>
                          </thead>
                          
                          <tbody>
                              
                              <?php 
                              
                              $index=1; //default 1 count
                              
                              $select=$pdo->prepare("select * from tbl_user  order by userid asc");
                              
                              $select->execute();
                              
                              while($row=$select->fetch(PDO::FETCH_OBJ)){
                                  
                                echo '
                                
                                  <tr>
                                  <td>'.$index.'</td>
                                  
                                   <td>'.$row->username.'</td>
                                   
                                    <td>'.$row->useremail.'</td>
                                    
                                     <td>'.$row->password.'</td>
                                     
                                      <td>'.$row->role.'</td>
                                      
                                       <td>
                                    
                                     
                         <a href="registration.php?id='.$row->userid.'" class="btn btn-danger" name="btndelete" role="button"><span class="glyphicon glyphicon-trash" title="delete"></span></a>
                                    
                                      </td>
                                       </tr>
                                    
                                ';
                                  
                                  $index++;
                              }
                              
                              
                              
                              ?>
                          </tbody>
                    </table>
                  
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