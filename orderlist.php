<?php
 
include_once'connectdb.php';

session_start();

if($_SESSION['username']=="" OR $_SESSION['role']==""){
      
      header("location:index.php");
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
            Invoice List 
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
                <!--              <h3 class="box-title">Order List</h3>-->
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
                <div class="form-group">
                    <input type="text" id="myInput" style="width:200px;border:2px solid #009933;color:black;border-radius:30px" placeholder="Search Invoicelist item" class="form-control">
                </div>

                <div style="overflow-x:auto;">

                    <table id="orderlisttable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Invoice ID
                                </th>
                                <th>CustomerName
                                </th>
                                <th>OrderDate
                                </th>
                                <th>Total
                                </th>
                                <th>Paid
                                </th>
                                <th>Due
                                </th>
                                <th>Service Charge
                                </th>
                                <th>Payment Type
                                </th>
                                <th>Subscription
                                </th>
                                <th>Mobile
                                </th>
<!--
                                <th style="text-align:center">
                                   
                                    Barcode
                                </th>
-->
                                <th>Print
                                </th>
<!--

                                <th>Edit
                                </th>
-->
                                <th>Delete
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                              
                              $index=1; //default 1 count
                              
              $select=$pdo->prepare("select * from tbl_invoice  order by invoice_id desc");
                              
                              $select->execute();
                              
             while($row=$select->fetch(PDO::FETCH_OBJ)){
                                  
                                echo '
                                
                                  <tr>
                                <td>'.$index.'</td>
                                  
                                  
      <td>'.$row->customer_name.'</td>
    <td>'.$row->order_date.'</td>
    <td>'.$row->total.'</td>
    <td>'.$row->paid.'</td>
    <td>'.$row->due.'</td>
    <td style="text-align:center">'.$row->service.'</td>
    <td>'.$row->payment_type.'</td>
    <td>'.$row->subscription.'</td>
    <td>'.$row->mobile.'</td>
    
 
    
    
    
    <td>
<a href="invoice_db.php?id='.$row->invoice_id.'" class="btn btn-warning" role="button" target="_blank"><span class="glyphicon glyphicon-print"  style="color:#ffffff" data-toggle="tooltip"  title="Print Invoice"></span></a>   
    
    </td>
    
    

    
    <td>
<button id='.$row->invoice_id.' class="btn btn-danger btndelete" ><span class="glyphicon glyphicon-trash" style="color:#ffffff" data-toggle="tooltip"  title="Delete Order"></span></button>  
    
    
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
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--
   <script>
  $(document).ready( function () {
    $('#orderlisttable').DataTable({
//        "order":[[0,"desc"]]    
     });
} );  
    
    
</script>
-->

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });


    $(document).ready(function() {
        $('.btndelete').click(function() {
            var tdh = $(
                this);
            var id = $(this).attr(
                "id");
            swal({
                    title: "Do you want to delete Order?",
                    text: "Once Order is deleted, you can not recover it!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (
                        willDelete) {

                        $.ajax({
                            url: 'orderdelete.php',
                            type: 'post',
                            data: {
                                pidd: id
                            },
                            success: function(data) {
                                tdh.parents('tr')
                                    .hide();
                            }


                        });



                        swal("Your Order has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal(
                            "Your Order is safe!");
                    }
                });



        });
    });

</script>


<script>
    $(document).ready(function() {

        $("#myInput").on("keyup", function() {

            var value = $(this).val()
                .toLowerCase();
            $("#orderlisttable tr")
                .filter(function() {
                    $(this).toggle($(this).text().toLowerCase()
                        .indexOf(
                            value) >
                        -
                        1
                    )
                });

        });
    });

</script>





<!-- add footer-->


<?php 
 
  include_once 'footer.php';
  
?>
