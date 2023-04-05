<?php
 
include_once 'connectdb.php';

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


// include_once 'header.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customer List
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
             <input type="text" id="myInput" style="width:200px;border:2px solid #009933;color:black;border-radius:30px" placeholder="Search CustomerList item" class="form-control">
                </div>

                <div style="overflow-x:auto;">

                <table id="producttable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer name</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                              
                              $index=1; //default 1 count
                              
              $select=$pdo->prepare("select * from  tbl_customer  order by cid desc");
                              
                              $select->execute();
                              
                              while($row=$select->fetch(PDO::FETCH_OBJ)){
                                  
                                echo '
                                
                                  <tr>
                                <td>'.$index.'</td>
                                  
    <td>'.$row->c_name.'</td> 
     <td>'.$row->c_mobile.'</td>
    <td>'.$row->c_address.'</td>
    <td>
<a href="editcustomer.php?id='.$row->cid.'" class="btn btn-info" role="button"><span class="glyphicon glyphicon-edit" style="color:#ffffff" data-toggle="tooltip" title="Edit Product"></span></a>   
    
    </td>
    
    <td>
<button id='.$row->cid.' class="btn btn-danger btndelete" ><span class="glyphicon glyphicon-trash" style="color:#ffffff" data-toggle="tooltip"  title="Delete Product"></span></button>  
    
    
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
                            url: 'customerdelete.php',
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
