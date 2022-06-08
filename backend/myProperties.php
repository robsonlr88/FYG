<?php
	include_once '../src/db/dbc.php';
	
	$data=json_decode(file_get_contents("php://input"));
	$userid=mysqli_real_escape_string($db, $_GET["id"]);
	$sqlInfo = "SELECT * FROM propertyInfo WHERE userid = '$userid'";

	$out = array('error' => false);
	$outp="";
	$outq="";  
  
	$resultInfo=mysqli_query($db,$sqlInfo);
	if (mysqli_num_rows($resultInfo) > 0){
		while ($row = mysqli_fetch_array($resultInfo)){
			$propertyid = $row['propertyid'];
			$sqlStatus = "SELECT * FROM propertyStatus WHERE propertyid = '$propertyid'";
			$resultStatus = mysqli_query($db,$sqlStatus);
			while($rStatus = mysqli_fetch_array($resultStatus)){


				if ($rStatus["finished"] == "Completed" && $rStatus["posted"] == "Published"){
					if($outp != "") {$outp .= ",";}
					$outp .= '{"propertyid":"' . $row["propertyid"] . '",';
					$outp .= '"propertyname":"' . $row["propertyname"] . '",';
					$outp .= '"city":"' . $row["propertycity"] . '",';
					$outp .= '"country":"' . $row["propertycountry"] . '",';
					$outp .= '"finished":"' . $rStatus["finished"] . '",';
					$outp .= '"posted":"' . $rStatus["posted"] . '"}';
				}

				if ($rStatus["finished"] == "Uncompleted" or $rStatus["posted"] == "Unpublished"){
					if($outq != "") {$outq .= ",";}
					$outq .= '{"propertyid":"' . $row["propertyid"] . '",';
					$outq .= '"propertyname":"' . $row["propertyname"] . '",';
					$outq .= '"city":"' . $row["propertycity"] . '",';
					$outq .= '"country":"' . $row["propertycountry"] . '",';
					$outq .= '"finished":"' . $rStatus["finished"] . '",';
					$outq .= '"posted":"' . $rStatus["posted"] . '"}';
				}

			}
		}
		$outp = '{"properties":['.$outp.'], "otherStatus":['.$outq.']}';
		echo($outp);
	}
	else if (mysqli_num_rows($resultInfo) == 0){

		$out['error'] = true;
        $out['message'] = "You still didn't submit any property.";
		echo json_encode($out);
	}

?>