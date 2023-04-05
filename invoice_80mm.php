<?php
//call the FPDF library
require('fpdf/fpdf.php');

include_once'connectdb.php';


class PDF_Code39 extends FPDF
{
function Code39($xpos, $ypos, $code, $baseline=0.5, $height=5){

    $wide = $baseline;
    $narrow = $baseline / 3 ; 
    $gap = $narrow;

    $barChar['0'] = 'nnnwwnwnn';
    $barChar['1'] = 'wnnwnnnnw';
    $barChar['2'] = 'nnwwnnnnw';
    $barChar['3'] = 'wnwwnnnnn';
    $barChar['4'] = 'nnnwwnnnw';
    $barChar['5'] = 'wnnwwnnnn';
    $barChar['6'] = 'nnwwwnnnn';
    $barChar['7'] = 'nnnwnnwnw';
    $barChar['8'] = 'wnnwnnwnn';
    $barChar['9'] = 'nnwwnnwnn';
    $barChar['A'] = 'wnnnnwnnw';
    $barChar['B'] = 'nnwnnwnnw';
    $barChar['C'] = 'wnwnnwnnn';
    $barChar['D'] = 'nnnnwwnnw';
    $barChar['E'] = 'wnnnwwnnn';
    $barChar['F'] = 'nnwnwwnnn';
    $barChar['G'] = 'nnnnnwwnw';
    $barChar['H'] = 'wnnnnwwnn';
    $barChar['I'] = 'nnwnnwwnn';
    $barChar['J'] = 'nnnnwwwnn';
    $barChar['K'] = 'wnnnnnnww';
    $barChar['L'] = 'nnwnnnnww';
    $barChar['M'] = 'wnwnnnnwn';
    $barChar['N'] = 'nnnnwnnww';
    $barChar['O'] = 'wnnnwnnwn'; 
    $barChar['P'] = 'nnwnwnnwn';
    $barChar['Q'] = 'nnnnnnwww';
    $barChar['R'] = 'wnnnnnwwn';
    $barChar['S'] = 'nnwnnnwwn';
    $barChar['T'] = 'nnnnwnwwn';
    $barChar['U'] = 'wwnnnnnnw';
    $barChar['V'] = 'nwwnnnnnw';
    $barChar['W'] = 'wwwnnnnnn';
    $barChar['X'] = 'nwnnwnnnw';
    $barChar['Y'] = 'wwnnwnnnn';
    $barChar['Z'] = 'nwwnwnnnn';
    $barChar['-'] = 'nwnnnnwnw';
    $barChar['.'] = 'wwnnnnwnn';
    $barChar[' '] = 'nwwnnnwnn';
    $barChar['*'] = 'nwnnwnwnn';
    $barChar['$'] = 'nwnwnwnnn';
    $barChar['/'] = 'nwnwnnnwn';
    $barChar['+'] = 'nwnnnwnwn';
    $barChar['%'] = 'nnnwnwnwn';

    $this->SetFont('Arial','',10);
    $this->Text($xpos, $ypos + $height + 4, $code);
    $this->SetFillColor(0);

    $code = '*'.strtoupper($code).'*';
    for($i=0; $i<strlen($code); $i++){
        $char = $code[$i];
        if(!isset($barChar[$char])){
            $this->Error('Invalid character in barcode: '.$char);
        }
        $seq = $barChar[$char];
        for($bar=0; $bar<9; $bar++){
            if($seq[$bar] == 'n'){
                $lineWidth = $narrow;
            }else{
                $lineWidth = $wide;
            }
            if($bar % 2 == 0){
                $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
            }
            $xpos += $lineWidth;
        }
        $xpos += $gap;
    }
}
}




$id= $_GET['id']; 
$select=$pdo->prepare("select * from tbl_invoice where invoice_id=$id");
$select->execute();     //where invoice_no=$id                
//$row = $select->fetch(PDO::FETCH_ASSOC) ;
$row = $select->fetch(PDO::FETCH_OBJ);
$pdf = new PDF_Code39('P','mm',array(80,200));
//$pdf=new ();
$pdf->AddPage();



$pdf->Image('agro.png',32,0,18);

$pdf->Ln(3);

//set font to arial, bold, 14pt
//$pdf->SetFont('Arial','B',12);
//$pdf->Cell(60 ,8,'Invoice.',1,1,"C");
//Cell(width , height , text , border , end line , [align] )


$pdf->SetFont('Arial','B',7);
$pdf->Cell(60,8,'New Cantonment Road (Daspara 6 no Road) Surma Gate, ',0,1,"C");

$pdf->Cell(60,0,'Hazrat Shah Paran 3104.',0,1,"C");

$pdf->Cell(60,9,'Mobile Number: +88 01764-561996',0,1,"C");

$pdf->Cell(60,0,'WEBSITE : www.smithitbd.com',0,1,"C");
$pdf->Line(7,35,72,35);
$pdf->Ln(5);//Line break
$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,4,'Bill To :',0,0,"");
$pdf->SetFont('Courier','',8);
$pdf->Cell(40,4, $row->customer_name,0,1,"");
$pdf->SetFont('Arial','B',8);
//$pdf->Cell(190,5,'Invoice Id: SITB-'.$row->invoice_id,0,1,'C');
$pdf->Cell(20,4,'Invoice Id:',0,0,"");
$pdf->SetFont('Courier','',8);
$pdf->Cell(40,4, $row->invoice_id,0,1,"");
$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,4,'Date :',0,0,"");
$pdf->SetFont('Courier','',8);
$pdf->Cell(40,4, $row->order_date,0,1,"");
$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,4,'Address :',0,0,"");
$pdf->SetFont('Courier','',8);
$pdf->Cell(40,4, $row->address,0,1,"");
$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,4,'Phone :',0,0,"");
$pdf->SetFont('Courier','',8);
$pdf->Cell(40,4, $row->mobile,0,1,"");

//$pdf->Line(5,53,70,53);
//$pdf->Ln(5);//Line break

$y_axis_initial = 63;
    $pdf->SetY($y_axis_initial);
    $pdf->SetX(7);
    $row_height = 5;
    $y_axis = $y_axis_initial + $row_height;

//$pdf->Ln(10); // line break

    //initialize counter
    $i = 0;





$select=$pdo->prepare("select * from tbl_invoice_details where invoice_id=$id ");
//select * from invoice_details inner join invoice using(invoice_no) where invoice_no=$id       
      $select->execute();                    
                          
       
           $pdf->SetFont('Courier','B',8);
//$pdf->SetFillColor(208,208,208);
$pdf->Cell(34,5,'PRODUCT',1,0,"L");
$pdf->Cell(11,5,'PRICE',1,0,"C");
$pdf->Cell(8,5,'QTY',1,0,"C");
$pdf->Cell(12,5,'TOTAL',1,1,"C");
           
           
           
$select=$pdo->prepare("select * from tbl_invoice_details where invoice_id=$id");
$select->execute();

while($item=$select->fetch(PDO::FETCH_OBJ)){
    $pdf->SetX(7);
  $pdf->SetFont('Helvetica','B',8);
$pdf->Cell(34,5,$item->product_name,1,0,'L');   
$pdf->Cell(11,5,$item->qty,1,0,'C');
$pdf->Cell(8, 5,$item->price,1,0,'C');
$pdf->Cell(12,5,$item->price*$item->qty,1,1,'C');  
    
}

 
//       $pdf->SetX(7);
//$pdf->SetFont('Courier','B',8);
//$pdf->Cell(20,5,'',0,0,"");
////$pdf->Cell(11,5,'',0,0,"");
//$pdf->Cell(25,5,'SUBTOTAL',1,0,"L");
//$pdf->Cell(20,5,$row->subtotal,1,1,"C");

$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'DISCOUNT',1,0,"L");
$pdf->Cell(20,5,$row->discount,1,1,"C");


$pdf->SetX(7);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'SUB TOTAL',1,0,"L");
$pdf->Cell(20,5,''.$row->total,1,1,"C");


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'PAID',1,0,"L");
$pdf->Cell(20,5,$row->discount,1,1,"C");


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'PAID',1,0,"L");
$pdf->Cell(20,5,$row->paid,1,1,"C");


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'DUE',1,0,"L");
$pdf->Cell(20,5,$row->due,1,1,"C");


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'PAYMENT TYPE',1,0,"L");
$pdf->Cell(20,5,$row->payment_type,1,1,"C");

$pdf->Ln(40);





$pdf->SetX(7);
$pdf->Cell(20,5,'',0,1,"");

$pdf->SetX(5);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(25,5,'Important Notice :',0,1,"");
$pdf->SetX(5);
$pdf->SetFont('Arial','',6);
$pdf->Cell(75,5,'No item will be replaced or refunded if you dont have the invoice with you. 
',0,2,"");
$pdf->SetX(5);
$pdf->Cell(75,5,'You can refund within 2 days of purchase.',0,1,"");
//$pdf->Ln(50);       
$pdf->Code39(5,180,$row->barcode,1,10,"C");

$pdf->Output();


?>



/////////////


 
    






