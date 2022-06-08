<?php

	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once '../sql/sqlGetId.php';
	
	$db->set_charset("utf8");

	$query = $db->query($surroundingsSelectIdGet);
	$outp="";  
	$queryResult = mysqli_num_rows($query);

	if($query->num_rows>0){

		while($rs = $query->fetch_array(MYSQLI_ASSOC)){
			if($outp != "") {$outp .= ",";}
			$outp .= '{"propertyid":"' . $rs["propertyid"] . '",';
			$outp .= '"userid":"' . $rs["userid"] . '",';
			$outp .= '"grocery":"' . $rs["grocery"] . '",';
			$outp .= '"grocerydistance":"' . $rs["grocerydistance"] . '",';
			$outp .= '"wateraccess":"' . $rs["wateraccess"] . '",';
			$outp .= '"ocean":"' . $rs["ocean"] . '",';
			$outp .= '"oceandistance":"' . $rs["oceandistance"] . '",';
			$outp .= '"lake":"' . $rs["lake"] . '",';
			$outp .= '"lakedistance":"' . $rs["lakedistance"] . '",';
			$outp .= '"river":"' . $rs["river"] . '",';
			$outp .= '"riverdistance":"' . $rs["riverdistance"] . '",';
			$outp .= '"nationalpark":"' . $rs["nationalpark"] . '",';
			$outp .= '"nationalparkdistance":"' . $rs["nationalparkdistance"] . '",';
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