<?php

	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once '../sql/sqlGetId.php';

	$db->set_charset("utf8");

	$result=mysqli_query($db,$picturesSelectIdGet);
	$outp="";
	$queryResult = mysqli_num_rows($result);

	if(mysqli_num_rows($result)>0){
		while($rs = $result->fetch_array(MYSQLI_ASSOC)){
			if($outp != "") {$outp .= ",";}
			$outp .= '{"propertyid":"' . $rs["propertyid"] . '",';
			$outp .= '"coverphoto":"' . $rs["coverphoto"] . '",';
			$outp .= '"image1":"' . $rs["image1"] . '",';
			$outp .= '"image2":"' . $rs["image2"] . '",';
			$outp .= '"image3":"' . $rs["image3"] . '",';
			$outp .= '"image4":"' . $rs["image4"] . '",';
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