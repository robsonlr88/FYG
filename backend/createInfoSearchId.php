<?php

	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once '../sql/sqlGetId.php';
	
	$db->set_charset("utf8");

	$query = $db->query($infoSelectIdGet);
	$outp="";  
	$queryResult = mysqli_num_rows($query);

	if($query->num_rows>0){

		while($rs = $query->fetch_array(MYSQLI_ASSOC)){
			if($outp != "") {$outp .= ",";}
			$outp .= '{"propertyid":"' . $rs["propertyid"] . '",';
			$outp .= '"propertyname":"' . $rs["propertyname"] . '",';
			$outp .= '"propertyaddress":"' . $rs["propertyaddress"] . '",';
			$outp .= '"propertyzipcode":"' . $rs["propertyzipcode"] . '",';
			$outp .= '"propertycity":"' . $rs["propertycity"] . '",';
			$outp .= '"propertyprovince":"' . $rs["propertyprovince"] . '",';
			$outp .= '"propertycountry":"' . $rs["propertycountry"] . '",';
			$outp .= '"propertyphone":"' . $rs["propertyphone"] . '",';
			$outp .= '"propertywebsite":"' . $rs["propertywebsite"] . '",';
			$outp .= '"propertyemail":"' . $rs["propertyemail"] . '",';
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