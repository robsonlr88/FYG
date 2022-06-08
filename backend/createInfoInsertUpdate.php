<?php

	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once '../sql/sqlInfo.php';

	$result = mysqli_query($db,$infoSelectId);
	if(mysqli_num_rows($result)==1){

		mysqli_query($db,$infoUpdate);

	} elseif(mysqli_num_rows($result)==0){

		mysqli_query($db,$infoInsert);

		$propertyidsqlresult = mysqli_query($db,$infoSelect);
		
		while($row = mysqli_fetch_array($propertyidsqlresult)){
			$propertyid = $row['propertyid'];
		}
	
		mysqli_query($db,$statusInsert);
	}
	$finalresult = mysqli_query($db,$infoSelect);
	while($rs = mysqli_fetch_array($finalresult)){
		if($outp != "") {$outp .= ",";}
		$outp .= '{"propertyid":"' . $rs["propertyid"] . '",';
		$outp .= '"error": false }';
	}
	echo($outp);

?>