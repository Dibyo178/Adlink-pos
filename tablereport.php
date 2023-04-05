<?php
include_once'connectdb.php';
error_reporting(0);
session_start();

if($_SESSION['username']=="" OR $_SESSION['role']=="User"){
      
      header("location:index.php");
  }


include_once'header.php';

?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="main.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="body">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Table Report
            <small></small>
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
            <form action="" method="post" name="">

<!--
                <div class="box-header with-border" >
                    <h3 class="box-title">From : <?php echo $_POST['date_1']?>        To :   
                    <?php echo        $_POST['date_2']?></h3>
                </div>
-->
                <!-- /.box-header -->
                <!-- form start -->




                <div class="box-body">

                    <div class="row">

                        <div class="col-md-5">

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" placeholder="Enter Form Date"  class="form-control pull-right" id="datepicker1" name="date_1" data-date-format="yyyy-mm-dd">
                            </div>

                        </div>

                        <div class="col-md-5">

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" placeholder="Enter To Date" class="form-control 
                                  pull-right" id="datepicker2" name="date_2" data-date-format="yyyy-mm-dd">
                            </div>

                        </div>

                        <div class="col-md-2">
                            <div align="left">

                                <input  type="submit" name="btndatefilter" value="Filter By Date" class="btn btn-success">

                            </div>


                        </div>



                    </div>

                    <br>
                    <br>



                    <?php
                  
                
    $select=$pdo->prepare("select sum(total) as total , sum(subtotal) as stotal,count(invoice_id) as invoice from tbl_invoice  where order_date between :fromdate AND :todate");
      $select->bindParam(':fromdate',$_POST['date_1']);  
             $select->bindParam(':todate',$_POST['date_2']);  
            
    $select->execute();
            
$row=$select->fetch(PDO::FETCH_OBJ);
    
$net_total=$row->total;
                    
$stotal=$row->stotal;
                    
$invoice=$row->invoice;                    
                  
                  
                  
                  
                  ?>



                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Invoice</span>
                                    <span class="info-box-number">
                                        <h2><?php echo number_format($invoice); ?></h2>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->


                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <!--           <i class="fa-solid fa-bangladeshi-taka-sign"></i>-->
                                <span class="info-box-icon bg-green"><i class="fa fa-bangladeshi-taka-sign"><span>&#2547;</span></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Sub Total</span>
                                    <span class="info-box-number">
                                        <h2><?php echo number_format($stotal,2); ?></h2>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-bangladeshi-taka-sign"></i><span>&#2547;</span></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Net Total</span>
                                    <span class="info-box-number">
                                        <h2><?php echo number_format($net_total,2); ?></h2>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->


                    <br>
                    
                   
                <div align="right" >
             <input type="text" id="myInput" style="width:200px;border:2px solid #009933;color:black;border-radius:30px" placeholder="Search Tablereport item" class="form-control">
                </div>
                        
            
                    <div  id="data">
                        
                    <div style="width:350px;" id="filter_date">
                    <h3 class="box-title"><span style="color:#07A74B">From : <?php echo $_POST['date_1']?> </span> <span style="color:#098AAD"> To: 
                    
                    <?php echo  $_POST['date_2']?> </span>
                       </h3> 
                        </div>
                        
                    <table  class="table table-striped" id="salesreporttable">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>CustomerName</th>
                                <th>Subtotal</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>OrderDate</th>
                                <th>Payment Type</th>

                            </tr>
                            

                        </thead>

                         
                        <tbody>
                            
                          
                            

                            <?php
            
            $index=1; 
            
    $select=$pdo->prepare("select * from tbl_invoice  where order_date between :fromdate AND :todate");
      $select->bindParam(':fromdate',$_POST['date_1']);  
             $select->bindParam(':todate',$_POST['date_2']);  
            
    $select->execute();
            
while($row=$select->fetch(PDO::FETCH_OBJ)  ){
    
    echo'
    <tr>
     <td>'.$index.'</td>
    <td>'.$row->customer_name.'</td>
   <td>'.$row->subtotal.'</td>

     <td>'.$row->discount.'</td>
    <td><span class="label label-danger">'."$".$row->total.'</span></td>
     <td>'.$row->paid.'</td>
      <td>'.$row->due.'</td>
     <td>'.$row->order_date.'</td>
    
     ';
    
     $index++;
    
    if($row->payment_type=="Cash"){
        
      echo'<td><span class="label label-primary">'.$row->payment_type.'</span></td>';  
    }elseif($row->payment_type=="Card"){
        echo'<td><span class="label label-warning">'.$row->payment_type.'</span></td>';  
    }else{
         echo'<td><span class="label label-info">'.$row->payment_type.'</span></td>';
    }
        
}          
?>


                        </tbody>
                        
                      
                    </table>
                    
                     </div>
                    
                    
                      </div>
                    
                    <div class="text-center">
                          <button onclick="printPage()" class="btn btn-info" >print</button>
                    </div>
                    
                    
                   
  
               
            </form>
        </div>




    </section>
    <!-- /.content -->
    

</div>
<!-- /.content-wrapper -->


<div id="footer">
        <?php

include_once'footer.php';

?>
</div>

   
   <script>
       
       function filterDate(){
           
           document.getElementById('filter_date').style.background="green";
           
       }
       
  
    </script>
    
 

    
    <script type="text/javascript">
    
  function printPage() {
      
  
      
      
      document.getElementById('footer').style.display="none";
      
      
          var body = document.getElementById('body').innerHTML;
    
    var data = document.getElementById('data').innerHTML;
    
      document.getElementById('body').innerHTML = data;
    
     window.print();
      
        document.getElementById('body').innerHTML = body;
      
      
  }
   
    </script>

<script>
    //Date picker
    $('#datepicker1').datepicker({
        autoclose: true
    });



    //Date picker
    $('#datepicker2').datepicker({
        autoclose: true
    });


//
//    $('#salesreporttable').DataTable({
//
//        "order": [
//            [0, "asc"]
//        ]
//
//
//
//    });

</script>

<script>

$(document).ready(function() {
    
    $("#myInput").on("keyup",function(){
                     
     var value= $(this).val().toLowerCase();
     $("#salesreporttable tr").filter(function(){
         $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1)
     });
                     
    });
});
                  

</script>


