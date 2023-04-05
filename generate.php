<?php
	if(ISSET($_POST['btnsaveorder'])){
		$code=$_POST['txtbarcode'];
		echo "<img alt='testing' src='barcode.php?codetype=Code39&size=50&text=".$code."&print=true'/>";
	}
?>