<?php

	include_once '../src/db/dbc.php';

	$data=json_decode(file_get_contents("php://input"));
	$sqlInfo = "SELECT * FROM propertyInfo";
	$outp="";  
	$resultInfo=mysqli_query($db,$sqlInfo);
	if (mysqli_num_rows($resultInfo) > 0){
		while ($row = mysqli_fetch_array($resultInfo)){
			$propertyid = $row['propertyid'];
			$sqlStatus = "SELECT * FROM propertyStatus WHERE posted = 'Published' and propertyid = '$propertyid'";
			$resultStatus = mysqli_query($db,$sqlStatus);
			while($rStatus = mysqli_fetch_array($resultStatus)){
				$sql = "SELECT * FROM propertyPictures WHERE propertyid = '$propertyid'";
				$finalresult = mysqli_query($db,$sql);
				while($rs = mysqli_fetch_array($finalresult)){
					if($outp != "") {$outp .= ",";}
					$outp .= '{"propertyid":"' . $row["propertyid"] . '",';
					$outp .= '"propertyname":"' . $row["propertyname"] . '",';
					$outp .= '"address":"' . $row["propertyaddress"] . '",';
					$outp .= '"city":"' . $row["propertycity"] . '",';
					$outp .= '"country":"' . $row["propertycountry"] . '",';
					$outp .= '"coverphoto":"' . $rs["coverphoto"] . '"}';
				}
			}
		}
		$outp = '{"records":['.$outp.']}';
		echo($outp);
	} else {
		echo "There are no results for this search. $sqlInfo ";
	}

?>