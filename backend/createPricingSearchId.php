<?php

	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once '../sql/sqlGetId.php';
	
	$db->set_charset("utf8");

	$query = $db->query($pricingSelectIdGet);
	$outp="";  
	$queryResult = mysqli_num_rows($query);

	if($query->num_rows>0){

		while($rs = $query->fetch_array(MYSQLI_ASSOC)){
			if($outp != "") {$outp .= ",";}
			$outp .= '{"propertyid":"' . $rs["propertyid"] . '",';
			$outp .= '"userid":"' . $rs["userid"] . '",';
			$outp .= '"tentprice":"' . $rs["tentprice"] . '",';
			$outp .= '"rvprice":"' . $rs["rvprice"] . '",';
			$outp .= '"person":"' . $rs["person"] . '",';
			$outp .= '"personprice":"' . $rs["personprice"] . '",';
			$outp .= '"otherfees":"' . $rs["otherfees"] . '",';
			$outp .= '"otherfeesprice":"' . $rs["otherfeesprice"] . '",';
			$outp .= '"error": false }';
		}
	} 
	else if ($query->num_rows<=0){
		if($outp != "") {$outp .= ",";}
		$outp .= '{"propertyid":"' . $id . '",';
		$outp .= '"error": true }';
	}
	echo($outp);
?>