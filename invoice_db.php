<?php
//call the FPDF library
require('fpdf/fpdf.php');
include_once'connectdb.php';
$id=$_GET['id'];
$select=$pdo->prepare("select * from tbl_invoice where invoice_id=$id");
$select->execute();
$row=$select->fetch(PDO::FETCH_OBJ);



//create pdf object
$pdf = new FPDF('P','mm','A4');


//add new page
$pdf->AddPage();
//$pdf->SetFillColor(123,255,234);

//set font to arial, bold, 16pt
$pdf->SetFont('Arial','B',16);

//Cell(width , height , text , border , end line , [align] )
$pdf->Image('Adlink -l.png',10,6,35);
//$pdf->Cell(80,10,'Smith IT',0,0,'');

$pdf->SetFont('Arial','B',13);
$pdf->Cell(187,5,'INVOICE',0,1,'R');

//$pdf->SetFont('Arial','B',13);
//$pdf->Cell(112,10,'INVOICE',0,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,'1/A, Manipuri Rajbari, Mirza Jangal Rd, Sylhet 3100.',0,0,'');


$pdf->SetFont('Arial','',10);
$pdf->Cell(190,5,'Invoice Id: '.$row->invoice_id,0,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,'Mobile Number: +88 01772-929484',0,0,'');


$pdf->SetFont('Arial','',10);
$pdf->Cell(190,5,'Date : '.$row->order_date,0,1,'C');


$pdf->SetFont('Arial','',8);
//$pdf->Cell(80,5,'E-mail Address : info@smithitbd.com',0,1,'');
$pdf->Cell(80,5,'Website : adlinkplc.com',0,1,'');

//Line(x1,y1,x2,y2);

$pdf->Line(5,30,205,30);
$pdf->Line(5,31,205,31);

$pdf->Ln(5); // line break



$pdf->SetFont('Arial','B',12);
$pdf->Cell(18,2,'Bill To :',0,0,'');




$pdf->SetFont('Arial','',11);
$pdf->Cell(50,2,$row->customer_name,0,1,'');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(27,10,'Phone Number:',0,0,'');
$pdf->SetFont('Arial','',8);
$pdf->Cell(50,10,$row->mobile,0,1,'');


$pdf->Cell(50,0,'',0,1,'');



$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(208,208,208);
$pdf->Cell(50,8,'PRODUCT',1,0,'C',true);   //190
$pdf->Cell(50,8,'DESCRIPTION',1,0,'C',true);
$pdf->Cell(20,8,'FEET',1,0,'C',true);
$pdf->Cell(30,8,'PRICE',1,0,'C',true);
$pdf->Cell(40,8,'TOTAL',1,1,'C',true);


$select=$pdo->prepare("select * from tbl_invoice_details where invoice_id=$id");
$select->execute();

while($item=$select->fetch(PDO::FETCH_OBJ)){
  $pdf->SetFont('Arial','B',12);
$pdf->Cell(50,8,$item->product_name,1,0,'L'); 
$pdf->Cell(50,8,$item->description,1,0,'C');
$pdf->Cell(20,8,$item->qty,1,0,'C');
$pdf->Cell(30,8,$item->price,1,0,'C');
$pdf->Cell(40,8,$item->price*$item->qty,1,1,'C'); 
    
    
}







$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'SubTotal',1,0,'C',true);
$pdf->Cell(40,8,$row->subtotal,1,1,'C');


$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Service-charge',1,0,'C',true);
$pdf->Cell(40,8,$row->service,1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Discount',1,0,'C',true);
$pdf->Cell(40,8,$row->discount,1,1,'C');

$pdf->SetFont('Arial','B',14);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'GrandTotal',1,0,'C',true);
$pdf->Cell(40,8,'BDT : '.$row->total,1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Paid',1,0,'C',true);
$pdf->Cell(40,8,$row->paid,1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Due',1,0,'C',true);
$pdf->Cell(40,8,$row->due,1,1,'C');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Payment Type',1,0,'C',true);
$pdf->Cell(40,8,$row->payment_type,1,1,'C');



//$pdf->SetFont('Arial','B',13);
//$pdf->Cell(190,15,'INVOICE RECEPTION',0,1,'R');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,0,'Signature of authority',0,1,'R');


$pdf->Cell(50,15,'',0,1,'');


//
//$pdf->SetFont('Arial','B',10);
//$pdf->Cell(32,10,'Important Notice :',0,0,'',true);
//

//$pdf->SetFont('Arial','',8);
//$pdf->Cell(148,10,'No item will be replaced or refunded if you dont have the invoice with you. You can refund within 2 days of purchase.',0,0,'');

        //Customer invoice pdf file

//set font to arial, bold, 16pt
$pdf->SetFont('Arial','B',16);

//Cell(width , height , text , border , end line , [align] )
$pdf->Image('Adlink -l.png',5,140,35);
//$pdf->Cell(80,10,'Smith IT',0,0,'');

$pdf->SetFont('Arial','B',13);
$pdf->Cell(190,15,'INVOICE RECEPTION',0,1,'R');

//$pdf->SetFont('Arial','B',13);
//$pdf->Cell(112,10,'INVOICE',0,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(80,0,'1/A, Manipuri Rajbari, Mirza Jangal Rd, Sylhet 3100.',0,0,'');


$pdf->SetFont('Arial','',10);
$pdf->Cell(190,4,'Invoice Id: '.$row->invoice_id,0,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(80,1,'Mobile Number: +88 01772-929484',0,0,'');


$pdf->SetFont('Arial','',10);
$pdf->Cell(190,3,'Date : '.$row->order_date,0,1,'C');


$pdf->SetFont('Arial','',8);
//$pdf->Cell(80,5,'E-mail Address : info@smithitbd.com',0,1,'');
$pdf->Cell(80,2,'Website : adlinkplc.com',0,1,'');

//Line(x1,y1,x2,y2);

$pdf->Line(5,168,205,168);
$pdf->Line(5,169,205,169);

$pdf->Ln(7); // line break



$pdf->SetFont('Arial','B',12);
$pdf->Cell(18,2,'Bill To :',0,0,'');




$pdf->SetFont('Arial','',11);
$pdf->Cell(50,2,$row->customer_name,0,1,'');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(27,10,'Phone Number:',0,0,'');
$pdf->SetFont('Arial','',8);
$pdf->Cell(50,10,$row->mobile,0,1,'');


$pdf->Cell(50,0,'',0,1,'');



$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(208,208,208);
$pdf->Cell(50,8,'PRODUCT',1,0,'C',true);   //190
$pdf->Cell(50,8,'DESCRIPTION',1,0,'C',true);
$pdf->Cell(20,8,'FEET',1,0,'C',true);
$pdf->Cell(30,8,'PRICE',1,0,'C',true);
$pdf->Cell(40,8,'TOTAL',1,1,'C',true);


$select=$pdo->prepare("select * from tbl_invoice_details where invoice_id=$id");
$select->execute();

while($item=$select->fetch(PDO::FETCH_OBJ)){
  $pdf->SetFont('Arial','B',12);
$pdf->Cell(50,8,$item->product_name,1,0,'L'); 
$pdf->Cell(50,8,$item->description,1,0,'C');
$pdf->Cell(20,8,$item->qty,1,0,'C');
$pdf->Cell(30,8,$item->price,1,0,'C');
$pdf->Cell(40,8,$item->price*$item->qty,1,1,'C'); 
    
    
}







$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'SubTotal',1,0,'C',true);
$pdf->Cell(40,8,$row->subtotal,1,1,'C');


$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Service-charge',1,0,'C',true);
$pdf->Cell(40,8,$row->service,1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Discount',1,0,'C',true);
$pdf->Cell(40,8,$row->discount,1,1,'C');

$pdf->SetFont('Arial','B',14);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'GrandTotal',1,0,'C',true);
$pdf->Cell(40,8,'BDT : '.$row->total,1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Paid',1,0,'C',true);
$pdf->Cell(40,8,$row->paid,1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Due',1,0,'C',true);
$pdf->Cell(40,8,$row->due,1,1,'C');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,8,'',0,0,'L');   //190
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Payment Type',1,0,'C',true);
$pdf->Cell(40,8,$row->payment_type,1,1,'C');


$pdf->Cell(50,10,'',0,1,'');











//output the result
$pdf->Output();






?>