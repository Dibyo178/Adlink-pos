<?php
 
include_once'connectdb.php';

session_start();

 if($_SESSION['username']=="" OR $_SESSION['role']=="User"){
      
      header("location:index.php");
  }


 include_once 'header.php';

$id=$_GET['id'];

$select=$pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db=$row['pid'];

$productname_db=$row['pname'];

$category_db=$row['pcategory'];

$purchaseprice_db=$row['purchaseprice'];

$saleprice_db=$row['saleprice'];

$stock_db=$row['pstock'];

$description_db=$row['pdescription'];

//$productimage_db=$row['pimage'];


//update product list


if(isset($_POST['btnupdate'])){
    
    $productname_txt=$_POST['txtpname'];
    
    $category_txt= $_POST['txtselect_option'];
    
    $purchaseprice_txt= $_POST['txtpprice'];
    
    $saleprice_txt= $_POST['txtsaleprice'];
    
    $stock_txt= $_POST['txtstock'];
    
    $description_txt= $_POST['txtdescription'];

    
    
    
$update=$pdo->prepare("update tbl_product set pname=:pname , pcategory=:pcategory , purchaseprice=:purchaseprice , saleprice=:saleprice , pstock=:pstock , pdescription=:pdescription  where pid = $id");
        
     $update->bindParam(':pname',$productname_txt);
     $update->bindParam(':pcategory',$category_txt);
     $update->bindParam(':purchaseprice',$purchaseprice_txt);
     $update->bindParam(':saleprice',$saleprice_txt);
     $update->bindParam(':pstock',$stock_txt);
     $update->bindParam(':pdescription',$description_txt);
                
    
        
     
     $update->execute();
    
    
    
}



$select=$pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db=$row['pid'];

$productname_db=$row['pname'];

$category_db=$row['pcategory'];

$purchaseprice_db=$row['purchaseprice'];

$saleprice_db=$row['saleprice'];

$stock_db=$row['pstock'];

$description_db=$row['pdescription'];






?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edit Product
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
                <h3 class="box-title">Product Update Form</h3>
            </div>
            
             <form action="" method="post"  name="formproduct" enctype="multipart/form-data" >

            
            <div class="box-body">
            
           
                
            <div class="col-md-6">
                
              <div class="form-group">
                  <label >Product Name</label>
                  <input type="text" class="form-control" name="txtpname" 
                value="<?php echo $productname_db ?>"   placeholder="Enter Name" required>
                </div>
                                
                                
                <div class="form-group">
                  <label>Category</label>
                  <select class="form-control" name="txtselect_option" required>
                    <option value="" disabled selected>Select Category</option>
                <?php
            $select = $pdo->prepare("select * from tbl_category order by catid desc");          
              $select->execute();
    while($row=$select->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    ?>    
         <option <?php if($row['category']==$category_db) {?>
        
         selected="selected"
          <?php } ?> >  <?php echo $row['category'];?></option>
        
           <?php   
        
    } ;                 
                      
                 
                      ?>    
                    
                    
                
                     
                    
                  </select>
                </div>                
                                
                                 
                                 
                 <div class="form-group">
                  <label >Purchase price</label>
                  <input type="number" min="1" step="1" class="form-control" 
                value="<?php echo $purchaseprice_db ?>"   name="txtpprice" placeholder="Enter..." required>
                </div>
                
                   <div class="form-group">
                  <label >Sale price</label>
                  <input type="number" min="1" step="1" class="form-control" value="<?php echo $saleprice_db; ?>" name="txtsaleprice" placeholder="Enter..." required>
                </div>  
                
                
                
            </div> 
                
                 
                   
                 <div class="col-md-6">
                     
                     
                      <div class="form-group">
                  <label >Stock</label>
                  <input type="number" min="1" step="1" class="form-control" value="<?php echo $stock_db; ?>" name="txtstock" placeholder="Enter..." required>
                </div> 
                    
                    
              <div class="form-group">
                  <label >Description</label>
                  <textarea class="form-control" name="txtdescription" placeholder="Enter..."  rows="4"><?php echo $description_db; ?></textarea>
                </div>
                  
                   
                 

                     
                 </div>      
                
           
            
            
        
             </div>
                
            <div class="box-footer">
             
             
                  
                    
        <button type="submit" class="btn btn-warning" name="btnupdate">Edit product</button>            
                   
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