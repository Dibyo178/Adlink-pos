<?php

 require_once('vendor/autoload.php');

 $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
echo $generator->getBarcode('Tech Area', $generator::TYPE_CODE_128);



?>