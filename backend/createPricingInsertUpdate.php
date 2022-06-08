<?php

	session_start();
	$userid = $_SESSION['user'];
	
	include_once '../src/db/dbc.php';
	include_once '../sql/sqlPricing.php';

	$result = mysqli_query($db,$priceSelect);
	if(mysqli_num_rows($result)==1){
	
		mysqli_query($db,$priceUpdate);
	} elseif(mysqli_num_rows($result)==0){
	
		mysqli_query($db,$priceInsert);
	}
	$finalresult = mysqli_query($db,$priceSelect);
	while($rs = mysqli_fetch_array($finalresult)){
		if($outp != "") {$outp .= ",";}
		$outp .= '{"propertyid":"' . $rs["propertyid"] . '",';
		$outp .= '"error": false }';
	}
	echo($outp);

?>