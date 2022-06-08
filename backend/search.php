<?php

	include_once '../src/db/dbc.php';

	$data=json_decode(file_get_contents("php://input"));

	if (in_array("potablewater", $data->resources)) {
		$potablewater = 'AND potablewater = "1"';
	} else {
		$potablewater = '';
	}
	if (in_array("toilet", $data->resources)) {
		$toilet = 'AND toilet = "1"';
	} else {
		$toilet = '';
	}
	if (in_array("shower", $data->resources)) {
		$shower = 'AND shower = "1"';
	} else {
		$shower = '';
	}
	if (in_array("hotshower", $data->resources)) {
		$hotshower = 'AND hotshower = "1"';
	} else {
		$hotshower = '';
	}
	if (in_array("kitchen", $data->resources)) {
		$kitchen = 'AND kitchen = "1"';
	} else {
		$kitchen = '';
	}
	if (in_array("fridge", $data->resources)) {
		$fridge = 'AND fridge = "1"';
	} else {
		$fridge = '';
	}
	if (in_array("cooking", $data->resources)) {
		$cooking = 'AND cooking = "1"';
	} else {
		$cooking = '';
	}
	if (in_array("eating", $data->resources)) {
		$eating = 'AND eating = "1"';
	} else {
		$eating = '';
	}
	if (in_array("coffeemachine", $data->resources)) {
		$coffeemachine = 'AND coffeemachine = "1"';
	} else {
		$coffeemachine = '';
	}
	if (in_array("power", $data->resources)) {
		$power = 'AND power = "1"';
	} else {
		$power = '';
	}
	if (in_array("campfire", $data->resources)) {
		$campfire = 'AND campfire = "1"';
	} else {
		$campfire = '';
	}
	if (in_array("firewood", $data->resources)) {
		$firewood = 'AND firewood = "1"';
	} else {
		$firewood = '';
	}
	if (in_array("kids", $data->resources)) {
		$kids = 'AND kids = "1"';
	} else {
		$kids = '';
	}
	if (in_array("pets", $data->resources)) {
		$pets = 'AND pets = "1"';
	} else {
		$pets = '';
	}


	if (in_array("grocery", $data->surroundings)) {
		$grocery = 'AND grocery = "1"';
	} else {
		$grocery = '';
	}
	if (in_array("ocean", $data->surroundings)) {
		$ocean = 'AND ocean = "1"';
	} else {
		$ocean = '';
	}
	if (in_array("river", $data->surroundings)) {
		$river = 'AND river = "1"';
	} else {
		$river = '';
	}
	if (in_array("lake", $data->surroundings)) {
		$lake = 'AND lake = "1"';
	} else {
		$lake = '';
	}
	if (in_array("nationalpark", $data->surroundings)) {
		$nationalpark = 'AND nationalpark = "1"';
	} else {
		$nationalpark = '';
	}

	$pricing=mysqli_real_escape_string($db,$data->pricing);

	$outp="";

	$sqlStatus = "SELECT * FROM propertyStatus WHERE posted = 'Published'";
	$resultStatus = mysqli_query($db,$sqlStatus);
	if (mysqli_num_rows($resultStatus) > 0){
		while($rStatus = mysqli_fetch_array($resultStatus)){
			$propertyid = $rStatus['propertyid'];
			$sqlInfo = "SELECT * FROM propertyInfo WHERE propertyid = '$propertyid'";
			$infoResult=mysqli_query($db,$sqlInfo);
			while ($rInfo = mysqli_fetch_array($infoResult)){
				$sqlResources = "SELECT * FROM propertyResources WHERE propertyid = '$propertyid' $potablewater $toilet $shower $hotshower $kitchen $fridge $cooking $eating $coffeemachine $power $fireallowed $firewood $kids $pets";
				$finalresultResources = mysqli_query($db,$sqlResources);
				while($rResources = mysqli_fetch_array($finalresultResources)){
					$sqlSurroundings = "SELECT * FROM propertySurroundings WHERE propertyid = '$propertyid' $grocery $ocean $lake $river $nationalpark";
					//echo $sqlSurroundings;

					$finalresultSurroundings = mysqli_query($db,$sqlSurroundings);
					while($rSurroundings = mysqli_fetch_array($finalresultSurroundings)){
						$sqlPricing = "SELECT * FROM propertyPricing WHERE propertyid = '$propertyid' AND personprice < $pricing";
						//echo $sqlPricing;
						$finalresultPricing = mysqli_query($db,$sqlPricing);
						while($rPricing = mysqli_fetch_array($finalresultPricing)){
							$sqlPictures = "SELECT * FROM propertyPictures WHERE propertyid = '$propertyid'";
							$finalresult = mysqli_query($db,$sqlPictures);
							while($rPictures = mysqli_fetch_array($finalresult)){
								if($outp != "") {$outp .= ",";}
								$outp .= '{"propertyid":"' . $rInfo["propertyid"] . '",';
								$outp .= '"propertyname":"' . $rInfo["propertyname"] . '",';
								$outp .= '"address":"' . $rInfo["propertyaddress"] . '",';
								$outp .= '"city":"' . $rInfo["propertycity"] . '",';
								$outp .= '"country":"' . $rInfo["propertycountry"] . '",';
								$outp .= '"coverphoto":"' . $rPictures["coverphoto"] . '"}';
							}
						}
					}
				}
			}
		}
		$outp = '{"records":['.$outp.']}';
		echo($outp);
	} else {
		echo "There are no results for this search. $sqlPictures";
	}

?>