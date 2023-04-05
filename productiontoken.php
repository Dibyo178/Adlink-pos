<?php

include_once'tokenconnect.php';

//include_once 'tokenheader.php';


if(isset($_GET['tid'])){
    
    $tid=mysqli_real_escape_string($con,$_GET['tid']);
    $type=mysqli_real_escape_string($con,$_GET['type']);
    
    if($type=='active'){
        
        $status=1;
    }
    else{
        $status=0;
    }
    
    mysql_query($con,"update tbl_tokenproduct set pro_status='$status' where tid='$tpid '");
}

$res=mysqli_query($con,"select * from tbl_tokenproduct");
 
include_once'connectdb.php';

session_start();

if($_SESSION['username']=="" OR $_SESSION['role']==""){
      
      header("location:index.php");
  }


 if($_SESSION['role']=="Admin"){
      
     include_once 'header.php';
  }
 else{
     
     include_once 'productionHeader.php';
 }


 

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Production Room Token List
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
                    <input type="text" id="myInput" style="width:200px;border:2px solid #009933;color:black;border-radius:30px" placeholder="Search Tokenlist item" class="form-control">
                </div>

                <div style="overflow-x:auto;">

                    <table id="orderlisttable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Token
                                </th>
                                <th>Name
                                </th>

                                <th>Mobile
                                </th>
                                <th>Address
                                </th>
                                <th>Date
                                </th>
                                <th>Description

                                </th>

                                <!--
                                <th>ServiceName
                                </th>
                                <th>Price
                                </th>
                                <th>Quantity
                                </th>
                                
                                <th>Total
                                </th>
-->

                                <!--
                                <th style="text-align:center">
                                   
                                    Barcode
                                </th>
-->


                                <th>Status
                                </th>
                                <th>Delete
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                            
                            $index=1;
                            
                            $view= mysqli_query($con,"select * from   tbl_tokenproduct");
                            
                            while($data=mysqli_fetch_assoc($view)){
                              
                             $name=$data['pro_name'];
                                
                             $mobile=$data['pro_mobile'];
                                
                             $address=$data['pro_address'];
                                
                             $date=$data['pro_date'];
                                
                             $description=$data['pro_des'];
                                
//                             $status=$data['status'];    
                                
                                 
                             
                              ?>

                            <tr>
                                <td><?php echo $index; ?></td>

                                <td><?php echo $name; ?></td>

                                <td><?php echo $mobile; ?></td>

                                <td><?php echo $address; ?></td>

                                <td><?php echo $date; ?></td>

                                <td><?php echo $description; ?></td>

                                <td>

                                    <?php 
                                     
                      if($data['pro_status']==1){
            echo '<p><a href="tokenUpdate.php?tpid='.$data['tpid'].'&pro_status=0" class="btn btn-success">Done</a></p>';
                                      }
                                     else{ 
                                         
             echo '<p><a href="tokenUpdate.php?tpid='.$data['tpid'].'&pro_status=1" class="btn btn-warning">none</a></p>';
                                     }
                                       
                                     ?>

                                </td>

                                <td>
                                    <button id='<?php echo $data['tpid'] ; ?>' class="btn btn-danger btndelete"><span class="glyphicon glyphicon-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete Order"></span></button>


                                </td>
                            </tr>

                            <?php 
                                
                                $index++;
                            
                            } ?>
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



</script>

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
                    title: "Do you want to delete Token?",
                    text: "Once Token is deleted, you can not recover it!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (
                        willDelete) {

                        $.ajax({
                            url: 'productiontokenDelete.php',
                            type: 'post',
                            data: {
                                pidd: id
                            },
                            success: function(data) {
                                tdh.parents('tr')
                                    .hide();
                            }


                        });



                        swal("Your Token has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal(
                            "Your Token is safe!");
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
