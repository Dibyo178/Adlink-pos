<?php
 
include_once'connectdb.php';

session_start();

if($_SESSION['username']=="" OR $_SESSION['role']==""){
      
      header("location:index.php");
  }

function fill_product($pdo){
    
$output='';
    
$select=$pdo->prepare("select * from tbl_product order by pname asc"); 
$select->execute();
    
$result=$select->fetchAll();
    
foreach($result as $row){
    
$output.='<option value="'.$row["pid"].'">'.$row["pname"].'</option>';    
    
}    
    
 return $output;   
    
}


//update customer name

function fill_ucustomer1($pdo){
    
$output_customer='';
    
$select=$pdo->prepare("select * from  tbl_print order by customer_name asc"); 
$select->execute();
    
$result1_customer=$select->fetchAll();
    
foreach($result1_customer as $row){
    
$output_customer.='<option value="'.$row["invoice_id"].'">'.$row["customer_name"].'</option>';   
    
    $payment_type=$row['payment'];
    
}    
    
 return $output_customer;   
    
}




//customer details function

function fill_customer1($pdo){
    
$output_customer='';
    
$select=$pdo->prepare("select * from  tbl_ucustomer order by cname asc"); 
$select->execute();
    
$result1_customer=$select->fetchAll();
    
foreach($result1_customer as $row){
    
$output_customer.='<option value="'.$row["cid"].'">'.$row["cname"].'</option>';   
    
    $payment_type=$row['payment_type'];
    
}    
    
 return $output_customer;   
    
}



function fill_customer($pdo){
    
$output_customer='';
    
$select=$pdo->prepare("select * from  tbl_customer order by c_name asc"); 
$select->execute();
    
$result1_customer=$select->fetchAll();
    
foreach($result1_customer as $row){
    
$output_customer.='<option value="'.$row["cid"].'">'.$row["c_name"].'</option>';   
    
//    $payment_type=$row['payment_type'];
    
}    
    
 return $output_customer;   
    
}

//end 





if(isset($_POST['btnsaveorder'])){
    
       $customer_name=$_POST['txtlocalcustomername'];

    $c_address=$_POST["txtlocalcaddress"];
   
    $mobile=$_POST['txtlocalcmobile'];
    
//    $service=$_POST['productname'];
//    
//    $price=$_POST['price'];
//    
//    $qty=$_POST['qty'];
//    
//    $total=$_POST['total'];
    
    $date=$_POST['orderdate'];
    
    $description=$_POST['txtdescription'];
    
    
 

    
    $insert=$pdo->prepare("insert into tbl_token(t_name,t_mobile,t_address,date,description) values(:t_name,:t_mobile,:t_address,:t_date,:t_description)");
    
   
     $insert->bindParam(':t_name',$customer_name);
    
     
     $insert->bindParam(':t_address',$c_address);
    
     
     $insert->bindParam(':t_mobile',$mobile);
    
    $insert->bindParam(':t_date',$date);
    
    $insert->bindParam(':t_description',$description);
     
    
      
    
    $insert->execute();
    
    
 
      header('location:createToken.php'); 
   
   
    
    
    
    
}        
        
   //  echo"success fully created order";  
        
        
        
     
     if(isset($_POST['customerorder'])){
    
    $customer_name=$_POST['txtcustomername'];
    $order_date=date('Y-m-d',strtotime($_POST['customerDate']));
//    $subtotal=$_POST["customerSubtotal"];
    $c_address=$_POST["txtcaddress"];
    $discount=$_POST['customerDiscount'];
    $total=$_POST['customerTotal'];
    $paid=$_POST['txtpaid'];
    $due=$_POST['txtdue'];
    $payment_type=$_POST['rb'];
    $subscription=$_POST['txtsubscription'];
    $mobile=$_POST['txtcmobile'];
    $p_id=$_POST['txtcustomerid'];
    ////////////////////////////////
    
//         $arr_productid=$_POST['productid'];
//         $productname=$_POST['txtcustomerproduct'];
//         
//         $qty=$_POST['customerQuantity'];
//         $price=$_POST['customerprice'];
//         $arr_total=$_POST['total'];
    
    
    
    
    
    $insert=$pdo->prepare("insert into tbl_print(invoice_id,customer_name,date,mobile,address,description) values(:invid,:cust,:orderdate,:mobile,:address,:description)");
    
     $insert->bindParam(':invid',$p_id);         
     $insert->bindParam(':cust',$customer_name);
     $insert->bindParam(':orderdate',$order_date);
     $insert->bindParam(':address',$c_address);
     
     $insert->bindParam(':mobile',$mobile);
     $insert->bindParam('::description',$mobile);
    
      
    
    $insert->execute();
    
    
    
      header('location:invoicePrint.php'); 
   
    
    
    
    
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
            Create Token Grapics
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
            <form action="" method="post" name="formproduct" enctype="multipart/form-data">
                <div class="box-header with-border">
                  
                </div>



                <!--   Sales Form For Permanent Customer     -->





                <!--this is for customer and date-->
                
                


                <!--this for table-->
                <div class="box-body">
                    <div class="box-body">

                    </div>

                    <!--tax dis. etc-->
                    <div class="box-body">
                        <div class="col-md-6">

                            <!--                            <div class="form-group">-->
                        
                            <!--                            </div>-->


                            <div class="form-group ">
                                <label> Customer Name </label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>



                                    <input type="text" class="form-control " name="txtlocalcustomername" id="txtlocalcustomername" value="" required>
                                    
                                 

 
                                </div>
                            </div>

<!--
                     <div class="form-group ">
                                <label> Customer Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>



                                    <input type="email" class="form-control " name="txtlocalcmobile" id="txtlocalcmobile" placeholder="Enter Customer Email" required>


                                </div>
                            </div>
-->
                       




                            <div class="form-group ">
                                <label> Customer Mobile</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>



                                    <input type="text" class="form-control " name="txtlocalcmobile" id="txtlocalcmobile" placeholder="Enter Customer Mobile" required>


                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label> Customer Address</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>


                                    <input type="text" class="form-control" name="txtlocalcaddress" id="txtlocalcaddress" placeholder="Enter Customer Mobile" required>
                                </div>
                            </div>

                          
                              <div class="form-group">
                            <label>Date:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
        <input type="text" class="form-control pull-right" id="datepicker" name="orderdate" value="<?php echo date("Y-m-d");?>" data-date-format="yyyy-mm-dd" >
                            </div>
                            <!-- /.input group -->
                        </div>
                           
                           
                           
                           
                                 <div class="form-group">
                  <label >Description</label>
                   <textarea name="txtdescription" class="form-control" rows="4"></textarea>
                </div>
                            
                           



                        </div>



                        <div class="col-md-6">
                          
                           <label style="font-size:20px;color:green">Select  Existing Customer name</label>
                            <div class="input-group">
<!--
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
-->



                                <select class="form-control localcustomerid" style="width: 415px; ">
                                    <option name="txtlocalcustomername" id="txtlocalcustomername"  value="">Select Customer Name</option><?php echo fill_customer($pdo); ?>
                                </select>
                            </div>
                           
                           
                              
                               

                         
                            
<!--
                            
                                <div class="form-group ">
                                <label>Service Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-shopping-bag"></i>
                                    </div>



                                    <input type="text" class="form-control " name="txtlocalcmobile" id="txtlocalcmobile" placeholder="Enter Service Name" required>


                                </div>
                            </div>
-->
                            

                        </div>






                    </div>
                </div>
                
<!--
                     <div class="box-body">
                   
                    <div class="col-md-12">
                 <div style="overflow-x:auto;" > 
  <table class="table table-bordered" id="producttable"  >
                      
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Search Product</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Enter Quantity</th>
                                    <th>Total</th>
                                    <th>
                       <center> <button type="button" name="add" class="btn btn-success btn-sm btnadd"><span class="glyphicon glyphicon-plus"></span></button></center>

                                    </th>

                                </tr>

                            </thead>


                        </table></div>



                    </div>



                </div>
-->

                <hr>

                <div align="center">

                    <input type="submit" name="btnsaveorder" value="Create Token" class="btn btn-primary">

                </div>

                <hr>

            </form>
        </div>



        <!--   Sales Form For Permanent Customer     -->





    </section>
    <!-- /.content -->
</div>


<!-- /.content-wrapper -->


<!-- add footer-->

<!--local customer-->



<script>
   
    
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });


    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    })
    
    
    
    $(document).ready(function(){
        
    $(document).on('click','.btnadd',function(){
    
        var html='';
html+='<tr>';
        
html+='<td><input type="hidden" class="form-control pname" name="productname[]" readonly></td>';
        
html+='<td><select class="form-control productid" name="productid[]" style="width: 250px";><option value="">Select Option</option><?php echo fill_product($pdo); ?> </select></td>';
        

html+='<td><input type="text" class="form-control price" name="price[]" readonly></td>';
html+='<td><input type="number" min="1" class="form-control qty" name="qty[]" ></td>';
html+='<td><input type="text" class="form-control total" name="total[]" readonly></td>';
html+='<td><center><button type="button" name="remove" class="btn btn-danger btn-sm btnremove"><span class="glyphicon glyphicon-remove"></span></button><center></td></center>'; 
        
        $('#producttable').append(html);
        
     
      //Initialize Select2 Elements
    $('.productid').select2()
        
     $(".productid").on('change' , function(e){
         
    var productid = this.value;
     var tr=$(this).parent().parent();  
       $.ajax({
           
        url:"getproduct.php",
        method:"get",
        data:{id:productid},
        success:function(data){
            
         //console.log(data); 
   tr.find(".pname").val(data["pname"]);
    tr.find(".stock").val(data["pstock"]);
    tr.find(".price").val(data["saleprice"]); 
    tr.find(".qty").val(1);
    tr.find(".total").val( tr.find(".qty").val() *  tr.find(".price").val()); 
        calculate(0,0); 
            
    
            
            
        }   
 })   
 })    
        
        
        
       
    }) // btnadd end here    
       
        
     $(document).on('click','.btnremove',function(){
         
        $(this).closest('tr').remove(); 
         calculate(0,0);
         
       
         $("#txtpaid").val(0);
         
     }) // btnremove end here  
        
    
    $("#producttable").delegate(".qty","keyup change" ,function(){
       
      var quantity = $(this);
       var tr = $(this).parent().parent(); 
        
    if((quantity.val()-0)>(tr.find(".stock").val()-0) ){
       
       swal("WARNING!","SORRY! This much of quantity is not available","warning");
        
        quantity.val(1);
        
         tr.find(".total").val(quantity.val() *  tr.find(".price").val());
        calculate(0,0);
        
       
       }else{
           
           tr.find(".total").val(quantity.val() *  tr.find(".price").val());
           calculate(0,0);
           
          
       }    
        
        
        
    })  
        
        
        
     
        
      
        
  function calculate(dis,paid){
         
    var subtotal=0;
//    var tax=0;
        
    var discount = dis;
         
//    var service = sch;
  
    var net_total=0;
//    var net_total2=0;         
  
    
    var paid_amt=paid;
    var due=0;
    
         
         
    $(".total").each(function(){
        
    subtotal = subtotal+($(this).val()*1);    
        
    })
         
//tax=0.05*subtotal;
net_total=subtotal; 
      //50+1000 =1050
         
//     net_total=net_total+service;
     net_total=net_total-discount;

     
     

due=net_total-paid_amt;   
            
         
         
    
$("#txtsubtotal").val(subtotal.toFixed(2)); 
//$("#txttax").val(tax.toFixed(2));  



      $("#txttotal").val(net_total.toFixed(2));
 
  
  
$("#txtdiscount").val(discount);   
         
//$("#txtservice").val(service); 

$("#txtdue").val(due.toFixed(2));
  
         
         
     }
        // function calculate end here 
        
   

        
        
$("#txtdiscount").keyup(function(){
    var discount = $(this).val();
    calculate(discount,0);
    
    
}) 
        

//        var totalValue= $("#txttotal").val();
//        
//        var otherValue= $("#txtservice").val();
//        
//        var sum = totalValue+otherValue;
        
        
       
        

//$("#txtservice").keyup(function(){
//    
//   parseInt( $("#txtservice").val(sum));
////    var service =  parseInt($(this).val())||0;
////    calculate(0,service,0);
//    
//    
//}) 
                
    
        
        
$("#txtpaid").keyup(function(){
var paid = $(this).val();  
var discount = $("#txtdiscount").val();
//var service = $("#txtservice").val();

    calculate(discount,paid);
    
})  
        
        
   
        
        
    });
    
    
</script>



<script>
    //Initialize Select2 Elements
    $('.localcustomerid').select2();



    $(document).ready(function() {
        $(".localcustomerid").on('change', function(e) {

            var customerid = this.value;
            let citem = $(this).parent().parent();
            $.ajax({

                url: "getlocalcustomer.php",
                method: "get",
                data: {
                    id: customerid
                },
                success: function(result) {


                    console.log(result);

                    


                    $("#txtlocalcustomername").val(result.c_name);





                    $("#txtlocalcmobile").val(result.c_mobile);


                    
                    $("#txtlocalcaddress").val(result.c_address);

                   
                    //                    document.getElementById('payment_type').innerText=result.payment_type;




                }
            })
        })

    })

</script>








<!--
<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });

    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    });


  
         
        //        custom name id




        function calculate() {

            var subtotal = 0;
            //            var tax = 0;
            var discount = dis;
            var net_total = 0;
            var paid_amt = paid;
            var due = 0;


//            $(".total").each(function() {
//
//                subtotal = subtotal + ($(this).val() * 1);
//
//            })

            //            tax = 0.05 * subtotal;
            net_total = subtotal; //50+1000 =1050
            net_total = net_total - discount;
            due = net_total - paid_amt;


            $("#txtsubtotal").val(subtotal.toFixed(2));
            //            $("#txttax").val(tax.toFixed(2));
            $("#txttotal").val(net_total.toFixed(2));
            $("#txtdiscount").val(discount);
            $("#txtdue").val(due.toFixed(2));



        } // function calculate end here 

        $("#txtdiscount").keyup(function() {
            var discount = $(this).val();
            calculate(discount, 0);


        })

        $("#txtpaid").keyup(function() {
            var paid = $(this).val();
            var discount = $("#txtdiscount").val();
            calculate(discount, paid);

        })

    });

</script>
-->

<!--<script src="script.js"></script>-->



<?php 
 
  include_once 'footer.php';
  
?>
