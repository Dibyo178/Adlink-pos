<?php
 
include_once 'connectdb.php';

session_start();

 if($_SESSION['username']=="" OR $_SESSION['role']=="User"){
      
      header("location:index.php");
  }

 include_once 'header.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Receive Production List
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

            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
                 <div class="form-group">
             <input type="text" id="myInput" style="width:200px;border:2px solid #009933;color:black;border-radius:30px" placeholder="Search ProductList item" class="form-control">
                </div>

                <div style="overflow-x:auto;">

                <table id="producttable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Token</th>
                                <th>Name</th>
                                <th>Mobile</th>
<!--                                <th>Purchaseprice</th>-->
                                <th>Address</th>
<!--                                <th>Stock</th>-->
                                <th>Date</th>
<!--                                <th>Image</th>-->
                                <th>Status</th>
                               
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                              
                              $index=1; //default 1 count
                              
              $select=$pdo->prepare("select * from  tbl_recepintiontoken  order by rid  desc");
                              
                              $select->execute();
                              
                              while($row=$select->fetch(PDO::FETCH_OBJ)){
                                  
                                echo '
                                
                                  <tr>
                                <td>'.$index.'</td>
                                  
                                  
    <td>'.$row->r_name.'</td>
    <td>'.$row->r_mobile.'</td>
 
    <td>'.$row->r_address.'</td>
    
    <td>'.$row->date.'</td>
    
    <td>'.$row->status.'</td>
  
    
    
    
    
  
    
    <td>
<button id='.$row->rid .' class="btn btn-danger btndelete" ><span class="glyphicon glyphicon-trash" style="color:#ffffff" data-toggle="tooltip"  title="Delete Product"></span></button>  
    
    
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
    $(document).ready(function() {
        $('#producttable').DataTable(
                    {
                    
                    "order":[[0,"asc"]]
                }

        );
    });

</script>
-->

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltrip"]').tooltrip();
    });

</script>

<script>
    $(document).ready(function() {
        $('.btndelete').click(function() {
            var tdh = $(this);
            var id = $(this).attr("id");
            swal({
                    title: "Do you want to delete product?",
                    text: "Once Product is deleted, you can not recover it!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: 'receptionDelete.php',
                            type: 'post',
                            data: {
                                pidd: id
                            },
                            success: function(data) {
                                tdh.parents('tr').hide();
                            }


                        });



                        swal("Your Product has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your Product is safe!");
                    }
                });



        });
    });

</script>

 <script>

$(document).ready(function() {
    
    $("#myInput").on("keyup",function(){
                     
     var value= $(this).val().toLowerCase();
     $("#producttable tr").filter(function(){
         $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1)
     });
                     
    });
});
                  

</script>


<!-- add footer-->


<?php 
 
  include_once 'footer.php';
  
?>
