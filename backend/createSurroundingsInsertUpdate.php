<?php

	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once '../sql/sqlSurroundings.php';

	$result = mysqli_query($db,$surroundingsSelect);
	if(mysqli_num_rows($result)==1){
	
		mysqli_query($db,$surroundingsUpdate);
	} elseif(mysqli_num_rows($result)==0){
		
		mysqli_query($db,$surroundingsInsert);
	}
	$finalresult = mysqli_query($db,$surroundingsSelect);
	while($rs = mysqli_fetch_array($finalresult)){
		if($outp != "") {$outp .= ",";}
		$outp .= '{"propertyid":"' . $rs["propertyid"] . '",';
		$outp .= '"error": false }';
	}
	echo($outp);

?>