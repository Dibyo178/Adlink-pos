<?php
 

include_once 'connectdb.php';

session_start();

 if($_SESSION['username']=="" ){
      
      header("location:index.php");
  }

// include_once 'header.php';

if(isset($_POST['btnaddproduct'])){
    
    $productname=$_POST['txtpname'];
    
    $category= $_POST['txtselect_option'];
    
//    $purchaseprice= $_POST['txtpurchase'];
    
    $saleprice= $_POST['txtsale'];
    
//    $stock= $_POST['txtstock'];
    
    $description= $_POST['txtdescription'];
    
//    upload images
    
    
//    $f_name= $_FILES['myfile']['name'];
//    
//    
//    
//$f_tmp = $_FILES['myfile']['tmp_name'];
//
//    
// $f_size =  $_FILES['myfile']['size'];
//    
//$f_extension = explode('.',$f_name);
// $f_extension= strtolower(end($f_extension));
//    
//  $f_newfile =  uniqid().'.'. $f_extension;   
//  
//    $store = "productimages/".$f_newfile;
//    
    
//if($f_extension=='jpg' || $f_extension=='jpeg' ||  $f_extension=='png' || $f_extension=='gif'){
// 
//    if($f_size>=1000000 ){
//        
//       
//        
//        $error= '<script type="text/javascript">
//jQuery(function validation(){
//
//
//swal({
//  title: "Error!",
//  text: "Max file should be 1MB!",
//  icon: "warning",
//  button: "Ok",
//});
//
//
//});
//
//</script>';
//       
//  echo $error;      
//        
//        
//        
//    }else{
//      
//       if(move_uploaded_file($f_tmp,$store)){
//           
//           $productimage=$f_newfile;
//            if(!isset($error)){
//     
//$insert=$pdo->prepare("insert into tbl_product(pname,pcategory,purchaseprice,saleprice,pstock,pdescription,pimage) values(:pname,:pcategory,:purchaseprice,:saleprice,:pstock,:pdescription,:pimage)"); 
//     
//$insert->bindParam(':pname',$productname); 
//     $insert->bindParam(':pcategory',$category);
//     $insert->bindParam(':purchaseprice',$purchaseprice);
//     $insert->bindParam(':saleprice',$saleprice);
//     $insert->bindParam(':pstock',$stock);
//     $insert->bindParam(':pdescription',$description);
////     $insert->bindParam(':pimage',$productimage);
//                
//                
//     
//     
//if($insert->execute()){
//    
//    echo'<script type="text/javascript">
//jQuery(function validation(){
//
//
//swal({
//  title: "Add product Successfull!",
//  text: "Product Added",
//  icon: "success",
//  button: "Ok",
//});
//
//
//});
//
//</script>';
//    
//    
//}else{
//    
//   echo'<script type="text/javascript">
//jQuery(function validation(){
//
//
//swal({
//  title: "ERROR!",
//  text: "Add product Fail",
//  icon: "error",
//  button: "Ok",
//});
//
//
//});
//
//</script>';  
//    
//}     
//     
//     
//     
//     
//     
// } 
//           
//           
//           
//           
//           
//       } 
//        
//        
//        
//    }   
//    
//    
//    
//}else
//{
//    
//  
//    
//      $error= '<script type="text/javascript">
//jQuery(function validation(){
//
//
//swal({
//  title: "Warning!",
//  text: "only jpg ,jpeg, png and gif can be upload!",
//  icon: "error",
//  button: "Ok",
//});
//
//
//});
//
//</script>';
//       
//  echo $error;      
//        
//    
//    
//    
//    
//    
//}    
    
    
    
  $insert=$pdo->prepare("insert into tbl_product(pname,pcategory,saleprice,pdescription) values(:pname,:pcategory,:saleprice,:pdescription)"); 
     
$insert->bindParam(':pname',$productname); 
     $insert->bindParam(':pcategory',$category);
//     $insert->bindParam(':purchaseprice',$purchaseprice);
     $insert->bindParam(':saleprice',$saleprice);
//     $insert->bindParam(':pstock',$stock);
     $insert->bindParam(':pdescription',$description);
//     $insert->bindParam(':pimage',$productimage);
                
                $insert->execute();
    
    
    
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
       Service Add
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
            <div class="box-title">
                <a href="productlist.php" class="btn btn-primary"  role="button">Back To Service List</a>
            </div>

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
     <form role="formproduct" action="" method="post" enctype="multipart/form-data">

            
              <div class="box-body">
              
                 
                 <div class="col-md-6">
                      <div class="form-group">
                  <label > Service name</label>
                  <input type="Name" name="txtpname" class="form-control" id="exampleInputName" placeholder="Enter a name" required>
                </div>
                 
                 <div class="form-group">
                  <label>Category</label>
                  <select class="form-control" name="txtselect_option" required>
                <option value="" disabled selected>Select Category</option>
                 
                  <?php 
                      
                $select= $pdo->prepare("select * from tbl_category order by catid desc");
                      
                      $select->execute();
                      
                      while($row=$select->fetch(PDO::FETCH_ASSOC)){
                          extract($row)
                            
                      ?>
                      
                      <option ><?php echo $row['category']; ?></option>
                      
                      <?php
                      }
                      
                      ?>
                       
                    
                    
                     
                  </select>
                </div>
                  
<!--
                     <div class="form-group">
                  <label >Purchase Price</label>
                  <input type="number" min="1" step="1"  name='txtpurchase' class="form-control"  placeholder="Enter Purchase Price" required>
                </div>
-->
                
                    <div class="form-group">
                  <label >Sale Price</label>
                  <input type="number" min="1" step="1" name='txtsale' class="form-control" placeholder="Enter Sale Price" required>
                </div>
                 </div>
                 <div class="col-md-6">
<!--
                         <div class="form-group">
                  <label >Stock Price</label>
                  <input type="number" min="1" step="1" name="txtstock" class="form-control"  placeholder="Enter Stock Price" required>
                </div>
-->
                
                       <div class="form-group">
                  <label >Description</label>
                   <textarea name="txtdescription" class="form-control" rows="4"></textarea>
                </div>
                
<!--
                  <div class="form-group">
                  <label > Product Image</label>
                  <input type="file" name="myfile" class="input-group"  required>
                  <p>upload Image</p>
                </div>
-->
                
                 </div>
               
            </div>
            
                  <div class="box-footer">
                    
                    
                     <button type="submit" name='btnaddproduct' class="btn btn-info">Add Service</button>

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