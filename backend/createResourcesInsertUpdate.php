<?php

	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once '../sql/sqlResources.php';

	$result = mysqli_query($db,$resourcesSelect);
	if(mysqli_num_rows($result)==1){

		mysqli_query($db,$resourcesUpdate);
	} elseif(mysqli_num_rows($result)==0){
	
		mysqli_query($db,$resourcesInsert);
	}
	$finalresult = mysqli_query($db,$resourcesSelect);
	while($rs = mysqli_fetch_array($finalresult)){
		if($outp != "") {$outp .= ",";}
		$outp .= '{"propertyid":"' . $rs["propertyid"] . '",';
		$outp .= '"error": false }';
	}
	echo($outp);

?>