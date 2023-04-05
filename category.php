<?php
 
include_once 'connectdb.php';

session_start();

 if($_SESSION['username']==""){
      
      header("location:index.php");
  }

// include_once 'header.php';

  
 if(isset($_POST['btnsave'])){
     
     $category=$_POST['txtcategory'];
     
     if(empty($category)){
         
         $error =' <script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Field is empty",
              text: "Please Fill Field",
              icon: "error",
             button: "ok",
         })
             
             });
         </script>';
         
         echo $error;
     }
     
     
     if(!isset($error)){
         
         $insert=$pdo->prepare("insert into tbl_category(category) values(:category)");
         
         $insert->bindParam(':category',$category);
         
         if($insert->execute()){
             
             echo ' <script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Well Done",
              text: "Category is Added",
              icon: "success",
             button: "ok",
         })
             
             });
         </script>';
         }
         else{
             
             echo ' <script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Opps!!",
              text: "Category is not Added",
              icon: "warning",
             button: "ok",
         })
             
             });
         </script>';
             
         }
     }
 }

//btnUpdate code start

if(isset($_POST['btnupdate'])){
    
    $category= $_POST['txtcategory'];
    
    $id=$_POST['txtid'];
    
    if(empty($category)){
        
        $errorupdate= ' <script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Error",
              text: "Field is empty please fill in category",
              icon: "error",
             button: "ok",
         })
             
             });
         </script>';
        
        echo $errorupdate;
    }
    
    
    
    if(!isset($errorupdate)){
        
        $update=$pdo->prepare("update tbl_category set category='$category'
        
        where catid=".$id);
        
//        whenn i use bindPAaram method blow code are usess
        
//           $update=$pdo->prepare("update tbl_category set category=:category
//        
//        where catid=".$id);
        
//      $update->bindParam(':category',$category);
        
//        $update->execute();
            
        
        if($update->execute()){
            
              echo ' <script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Good Job",
              text: "Your category is updated",
              icon: "success",
             button: "ok",
         })
             
             });
         </script>';
            
        }
        else{
             
              echo ' <script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Sorry",
              text: "Your Category is not Updated",
              icon: "Error",
             button: "ok",
         })
             s
             });
         </script>';
        }
    }
    
}

//btnupdate code end


//delete button code start

if(isset($_POST['btndelete'])){
    
    $delete=$pdo->prepare("delete from tbl_category where catid=".$_POST['btndelete']);
    
    if($delete->execute()){
         
         echo ' <script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Deleted",
              text: "Your Category is  Delted",
              icon: "success",
             button: "ok",
         })
             
             });
         </script>';
        
    }
    else{
        
         echo ' <script type="text/javascript">
             jQuery(function validation(){
               
        swal({
              title: "Sorry",
              text: "Your Category is not Deleted",
              icon: "Error",
             button: "ok",
         })
             s
             });
         </script>';
    }
}
 
  if($_SESSION['role']=="Admin"){
      
      include_once 'header.php';
  }
else if($_SESSION['role']=="User"){
    
     include_once 'headeruser.php';
}
else{
   
    include_once 'index.php';
}
   



?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Category Dashboard

      </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        
        
        <div class="box box-danger">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
              
              <form role="form" action="" method="post">
              
              <?php 
                  
                  if(isset($_POST['btnedit'])){
                      
                      
                      $select=$pdo->prepare("select * from tbl_category  where catid=".$_POST['btnedit']);
                      

                      $select->execute();
                      
                      if($select){
                          
                  $row=$select->fetch(PDO::FETCH_OBJ);
                          
                          echo ' 
                          
                    <div class="col-md-4">
                  <div class="form-group">
                  <label >Category</label>
                  
            <input type="hidden" name="txtid" class="form-control"
             
              value="'.$row->catid.'" placeholder="Enter a Category">
                  
                  <input type="text" name="txtcategory" class="form-control" value="'.$row->category.'" placeholder="Enter a Category">
                </div>
                           
                                   
       <button type="submit" name="btnupdate" class="btn btn-info">Update</button>

              </div>';
                      }
                      
                      
                  }
                  else{
                      
                      echo '     
              <div class="col-md-4">
                  <div class="form-group">
                  <label >Category</label>
                  <input type="Name" name="txtcategory" class="form-control" id="exampleInputName" placeholder="Enter a Category">
                </div>
                           <!-- save button-->
                                   
       <button type="submit" name="btnsave" class="btn btn-warning">Save</button>

              </div> ';
                  }
                  
                 ?>
          
              <div class="col-md-8">
                
                    <table id="tablecategory" class="table table-striped">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Category</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                          </thead>
                          
                          <tbody>
                                     <?php
                                
                                     $index=1; //default 1 count
                              
                                 $select=$pdo->prepare("select * from tbl_category  order by catid desc");
                              
                                 $select->execute();
                              
                              while($row=$select->fetch(PDO::FETCH_OBJ)){
                              
                                    echo '
                                       <tr>
                                  <td>'.$index.'</td>
                                  
                                  
                                   
                                    <td>'.$row->category.'</td>
                                    
                                     <td>
                                     <button type="submit" name="btnedit"
                                      value="'.$row->catid.'"
                                     class="btn btn-success">Edit</button></td>
                                     
                                      <td>
                                       <button type="submit" name="btndelete"
                                      value="'.$row->catid.'"
                                     class="btn btn-danger">Delete</button>
                                      </td>
                                      </tr>
                                    
                                    ';
                                  $index++;
                              }
                                      
                                       
                              
                                      ?>
                                  
                          </tbody>
                    </table>
                  
                </div>
                 </form>
                 
              </div>
               
             
               
               <div>
                   
               </div>


              </div>
              <!-- /.box-body -->
<!--

              <div class="box-footer">
              </div>
-->
           
          </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!--Call this single function -->

<script>

 $(document).ready( function () {
    $('#tablecategory').DataTable();
} );
</script>
  
<!-- add footer-->


<?php 
 
  include_once 'footer.php';
  
?>