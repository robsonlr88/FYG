<?php

session_start();
$userid = $_SESSION['user'];

$db->set_charset("utf8");

$id=mysqli_real_escape_string($db, $_GET["id"]);

$sqlInfo = "SELECT * FROM propertyInfo WHERE propertyid = '$id'";
$outp="";  
$resultInfo=mysqli_query($db,$sqlInfo);
$queryResultInfo = mysqli_num_rows($resultInfo);
if(mysqli_num_rows($resultInfo)>0){
    while($rInfo = $resultInfo->fetch_array(MYSQLI_ASSOC)){

        if($outp != "") {$outp .= ",";}
        $outp .= '{"propertyid":"' . $rInfo["propertyid"] . '",';
        $outp .= '"propertyname":"' . $rInfo["propertyname"] . '",';
        $outp .= '"propertyaddress":"' . $rInfo["propertyaddress"] . '",';
        $outp .= '"propertyzipcode":"' . $rInfo["propertyzipcode"] . '",';
        $outp .= '"propertycity":"' . $rInfo["propertycity"] . '",';
        $outp .= '"propertyprovince":"' . $rInfo["propertyprovince"] . '",';
        $outp .= '"propertycountry":"' . $rInfo["propertycountry"] . '",';
        $outp .= '"propertyphone":"' . $rInfo["propertyphone"] . '",';
        $outp .= '"propertywebsite":"' . $rInfo["propertywebsite"] . '",';
        $outp .= '"propertyemail":"' . $rInfo["propertyemail"] . '"';
    }
}


$sqlResources = "SELECT * FROM propertyResources WHERE propertyid = '$id'";	
$finalresultResources = mysqli_query($db,$sqlResources);
if(mysqli_num_rows($finalresultResources)>0){
	while($rResources = mysqli_fetch_array($finalresultResources)){
        if ($rResources["resourcessubmitted"]){
            $outp .= ',"resourcessubmitted":"' . $rResources["resourcessubmitted"] . '"';
        }
        if ($rResources["potablewater"]){
            $outp .= ',"potablewater":"' . $rResources["potablewater"] . '"';
        }
        if ($rResources["toilet"]){
            $outp .= ',"toilet":"' . $rResources["toilet"] . '"';
        }
        if ($rResources["shower"]){
            $outp .= ',"shower":"' . $rResources["shower"] . '"';
        }
        if ($rResources["hotshower"]){
            $outp .= ',"hotshower":"' . $rResources["hotshower"] . '"';
        }
        if ($rResources["kitchen"]){
            $outp .= ',"kitchen":"' . $rResources["kitchen"] . '"';
        }
        if ($rResources["fridge"]){
            $outp .= ',"fridge":"' . $rResources["fridge"] . '"';
        }
        if ($rResources["cooking"]){
            $outp .= ',"cooking":"' . $rResources["cooking"] . '"';
        }
        if ($rResources["eating"]){
            $outp .= ',"eating":"' . $rResources["eating"] . '"';
        }						
        if ($rResources["coffeemachine"]){
            $outp .= ',"coffeemachine":"' . $rResources["coffeemachine"] . '"';
        }
        if ($rResources["power"]){
            $outp .= ',"power":"' . $rResources["power"] . '"';
        }
        if ($rResources["campfire"]){
            $outp .= ',"campfire":"' . $rResources["campfire"] . '"';
        }						
        if ($rResources["firewood"]){
            $outp .= ',"firewood":"' . $rResources["firewood"] . '"';
        }
        if ($rResources["kids"]){
            $outp .= ',"kids":"' . $rResources["kids"] . '"';
        }						
        if ($rResources["pets"]){
            $outp .= ',"pets":"' . $rResources["pets"] . '"';
        }
    }
}


$sqlSurroundings = "SELECT * FROM propertySurroundings WHERE propertyid = '$id'";	
$finalresultSurroundings = mysqli_query($db,$sqlSurroundings);
while($rSurroundings = mysqli_fetch_array($finalresultSurroundings)){
	if ($rSurroundings["surroundingssubmitted"]){
		if ($rSurroundings["grocery"]){
			$outp .= ',"grocery":"' . $rSurroundings["grocery"] . '"';
			$outp .= ',"grocerydistance":"' . $rSurroundings["grocerydistance"] . '"';
		}
		if ($rSurroundings["wateraccess"]){
			$outp .= ',"wateraccess":"' . $rSurroundings["wateraccess"] . '"';
			if ($rSurroundings["ocean"]){
				$outp .= ',"ocean":"' . $rSurroundings["ocean"] . '"';
				$outp .= ',"oceandistance":"' . $rSurroundings["oceandistance"] . '"';
			}
			if ($rSurroundings["lake"]){
				$outp .= ',"lake":"' . $rSurroundings["lake"] . '"';
				$outp .= ',"lakedistance":"' . $rSurroundings["lakedistance"] . '"';
			}
			if ($rSurroundings["river"]){
				$outp .= ',"river":"' . $rSurroundings["river"] . '"';
				$outp .= ',"riverdistance":"' . $rSurroundings["riverdistance"] . '"';
			}
		}
		if ($rSurroundings["nationalpark"]){
			$outp .= ',"nationalpark":"' . $rSurroundings["nationalpark"] . '"';
			$outp .= ',"nationalparkdistance":"' . $rSurroundings["nationalparkdistance"] . '"';
		}
	} else {
		$outp .= '}';
	}
}


$sqlPricing = "SELECT * FROM propertyPricing WHERE propertyid = '$id'";	
$finalresultPricing = mysqli_query($db,$sqlPricing);

if(mysqli_num_rows($finalresultPricing)>0){
    while($rPricing = mysqli_fetch_array($finalresultPricing)){

        if ($rPricing["tentprice"] && $rPricing["rvprice"]){
            $outp .= ',"tentprice":"' . $rPricing["tentprice"] . '"';
            $outp .= ',"rvprice":"' . $rPricing["rvprice"] . '"';
            if ($rPricing["person"]){
                $outp .= ',"person":"' . $rPricing["person"] . '"';
                $outp .= ',"personprice":"' . $rPricing["personprice"] . '"';
            }
            if ($rPricing["otherfees"]){
                $outp .= ',"otherfees":"' . $rPricing["otherfees"] . '"';
                $outp .= ',"otherfeesname":"' . $rPricing["otherfeesname"] . '"';
                $outp .= ',"otherfeesprice":"' . $rPricing["otherfeesprice"] . '"';
            }
        }
        else {
            $outp .= '}';
        }
    }
}

$sqlPictures = "SELECT * FROM propertyPictures WHERE propertyid = '$id'";
$finalresultPictures = mysqli_query($db,$sqlPictures);
if(mysqli_num_rows($finalresultPictures)>0){
	while($rPictures = mysqli_fetch_array($finalresultPictures)){
			if ($rPictures["picturessubmitted"]){
				$outp .= ',"coverphoto":"' . $rPictures["coverphoto"] . '"';
				$outp .= ',"image1":"' . $rPictures["image1"] . '"';
				$outp .= ',"image2":"' . $rPictures["image2"] . '"';
				$outp .= ',"image3":"' . $rPictures["image3"] . '"';
				$outp .= ',"image4":"' . $rPictures["image4"] . '"}';
			} else {
				$outp .= '}';
			}
	}
} else {
    $outp .= '}';
}
	

if(mysqli_num_rows($finalresultResources && $finalresultSurroundings && $finalresultPricing && $finalresultPictures >0)){
  
   $outp .= '}';

}

?>