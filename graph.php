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
   


 include_once 'graphHeader.php';

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

        
            
            <div class="box box-danger">
            

                <div class="box-header with-border">
                    <h1  style="text-align:center;background:yellow">Grapics Dashboard</h1>
                </div>
                <!-- /.box-header -->
                <!-- form start -->




                
                
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
