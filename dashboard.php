<?php
 
//header.php file include

  include_once 'connectdb.php';
  
  session_start();

// if may which is not provide cridential page redirect index.php file show

  if($_SESSION['username']==""){
      
      header("location:index.php");
  }

 
 $select= $pdo->prepare("select sum(total) as t, count(invoice_id) as invoice from  tbl_invoice");
 
 $select->execute();

 $row=$select->fetch(PDO::FETCH_OBJ);


$total_order=$row->invoice;

$net_total=$row->t;




           
    $select=$pdo->prepare("select order_date, total from tbl_invoice  group by order_date LIMIT 30");
    
            
    $select->execute();
                  
     $ttl=[];
     $date=[];              
            
while($row=$select->fetch(PDO::FETCH_ASSOC)  ){
    
    extract($row);
    
    $ttl[]=$total;
    $date[]=$order_date;
    
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
   


// include_once 'header.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <!--      Dashboard-->
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

        <div class="box-body">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner" style="padding:30px">
                            <h3><?php echo $total_order ?></h3>

                            <p>Total Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                      
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner" style="padding:30px">
                            <h3><span>&#2547;</span><?php echo " ". number_format($net_total,2) ?><sup style="font-size: 20px"></sup></h3>

                            <p>Total Revenue</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    
                    </div>
                </div>
                <!-- ./col -->

                <?php   
          
          $select= $pdo->prepare("select count(pname) as p from tbl_product");
 
 $select->execute();

 $row=$select->fetch(PDO::FETCH_OBJ);


$total_product=$row->p;

 
          
          
     ?>



                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner" style="padding:30px">
                            <h3><?php echo $total_product ?></h3>

                            <p> Total Services </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                      
                    </div>
                </div>
                
                  <?php   
          
          $select= $pdo->prepare("select count(category) as cat from tbl_category");
 
 $select->execute();

 $row=$select->fetch(PDO::FETCH_OBJ);


$total_category=$row->cat;

 
          
          
     ?>



                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner" style="padding:30px">
                            <h3><?php echo $total_category  ?></h3>

                            <p>Total Category</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                      
                    </div>
                </div>
                <!-- ./col -->
            </div>
            
            
            
            <div class="box box-danger">
            

                <div class="box-header with-border">
                    <h3 class="box-title">Earning By Date</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->




                <div class="box-body">
                <div class="chart">

                        <canvas id="earningbydate" style="height:250px"></canvas>

                    </div>
                
                </div>
                
                </div>
                
                
          <!-- below dashboard graph-->
               
            <div class="row">
                <div class="col-md-6">
                    
                    
                    <div class="box box-danger">
            

                <div class="box-header with-border">
                    <h3 class="box-title">Best Selling Product</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->




                <div class="box-body">
                
                <table id="bestsellingproductlist" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                
                                
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                              
                              $index=1; //default 1 count
                              
              $select=$pdo->prepare("select product_id,product_name,	price,sum(qty) as q, sum(qty*price) as total from tbl_invoice_details group by product_id order by sum(qty) DESC LIMIT 15");
                              
                              $select->execute();
                              
                              while($row=$select->fetch(PDO::FETCH_OBJ)){
                                  
                                echo '
                                
                                  <tr>
                                
                                  
                                  
      <td>'.$index.'</td>
    <td>'.$row->product_name.'</td>
    <td><span class="label label-info">'.$row->q.'</span></td>
     <td><span class="label label-success"><span>&#2547;  </span>'.$row->price.'</span></td>
    <td><span class="label label-danger"><span>&#2547;  </span>'.$row->total.'</span></td>
    
                             
                                     </tr>
                                    
                                ';
                                  
                                  $index++;
                              }
                              
                              
                              
                              ?>
                        </tbody>
                    </table>
                
                </div>
                
                </div>
                
                    
                </div>
                <div class="col-md-6">
                    
                     <div class="box box-danger">
            

                <div class="box-header with-border">
                    <h3 class="box-title">Recent Orders</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->




                <div class="box-body">
                
                 <table id="recentorderlist" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Due/Paid</th>
                                <th>Pay</th>
                                
                                
                                
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                              
                              $index=1; //default 1 count
                              
              $select=$pdo->prepare("select * from tbl_invoice  order by invoice_id desc LIMIT 20");
                              
                              $select->execute();
                              
                              while($row=$select->fetch(PDO::FETCH_OBJ)){
                                  
                                echo '
                                
                                  <tr>
                                <td><a href="editorder.php?id='.$row->invoice_id.'">'.$index.'</a></td>
                                  
                                  
      <td>'.$row->customer_name.'</td>
    <td>'.$row->order_date.'</td>
    <td><span class="label label-danger"><span>&#2547;  </span>'.$row->total.'</td>
    
    
    <td>'.$row->subscription.'</td>';
                                  
                                  
                                  
                    if($row->payment_type=="Cash"){
                        
                        echo '<td><span class="label label-success">'.$row->payment_type.'</span></td>';
                    }
                else if($row->payment_type=="Card"){
                        
                        echo '<td><span class="label label-warning">'.$row->payment_type.'</span></td>';
                    }         
                  else {
                      echo '<td><span class="label label-primary">'.$row->payment_type.'</span></td>';
                  }                
                                  
                                  $index++;
                              }
                              
                              
                              
                              ?>
                        </tbody>
                    </table>
                
                </div>
                
                </div>
                    
                </div>
            </div> 
               
       
                
        </div>

    </section>
    <!-- /.content -->
    
    
</div>  
                
                
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- add footer-->



<script>
    var ctx = document.getElementById('earningbydate').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: <?php  echo json_encode($date); ?>,
            datasets: [{
                label: 'Total Earning',
                backgroundColor: 'rgb(255, 99, 255)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?php  echo json_encode($ttl); ?>
            }]
        },

        // Configuration options go here
        options: {}
    });

</script>


<!--
  <script>
  $(document).ready( function () {
    $('#bestsellingproductlist').DataTable({
//        "order":[[0,"asc"]]    
     });
} );  
    
    
</script>

  <script>
  $(document).ready( function () {
    $('#recentorderlist').DataTable({
//        "order":[[0,"asc"]]    
     });
} );  
    
    
</script>
-->


<?php 
 
  include_once 'footer.php';
  
?>
