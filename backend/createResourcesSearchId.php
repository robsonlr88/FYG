<?php

	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once '../sql/sqlGetId.php';
	
	$db->set_charset("utf8");

	$query = $db->query($resourcesSelectIdGet);
	$outp="";  
	$queryResult = mysqli_num_rows($query);

	if($query->num_rows>0){

		while($rs = $query->fetch_array(MYSQLI_ASSOC)){
			if($outp != "") {$outp .= ",";}
			$outp .= '{"propertyid":"' . $rs["propertyid"] . '",';
			$outp .= '"userid":"' . $rs["userid"] . '",';
			$outp .= '"potablewater":"' . $rs["potablewater"] . '",';
			$outp .= '"toilet":"' . $rs["toilet"] . '",';
			$outp .= '"shower":"' . $rs["shower"] . '",';
			$outp .= '"hotshower":"' . $rs["hotshower"] . '",';
			$outp .= '"kitchen":"' . $rs["kitchen"] . '",';
			$outp .= '"fridge":"' . $rs["fridge"] . '",';
			$outp .= '"cooking":"' . $rs["cooking"] . '",';
			$outp .= '"eating":"' . $rs["eating"] . '",';
			$outp .= '"coffeemachine":"' . $rs["coffeemachine"] . '",';
			$outp .= '"power":"' . $rs["power"] . '",';
			$outp .= '"campfire":"' . $rs["campfire"] . '",';
			$outp .= '"firewood":"' . $rs["firewood"] . '",';
			$outp .= '"kids":"' . $rs["kids"] . '",';
			$outp .= '"pets":"' . $rs["pets"] . '",';
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