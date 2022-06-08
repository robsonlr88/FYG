<?php

include_once '../src/db/dbc.php';

session_start();
$userid = $_SESSION['user'];

$db->set_charset("utf8");
$property=json_decode(file_get_contents("php://input"));

if(count($property)>0){
    $propertyid=mysqli_real_escape_string($db,$property->propertyid);
    $potablewater=mysqli_real_escape_string($db,$property->potablewater);
    $toilet=mysqli_real_escape_string($db,$property->toilet);
    $shower=mysqli_real_escape_string($db,$property->shower);
    $hotshower=mysqli_real_escape_string($db,$property->hotshower);
    $kitchen=mysqli_real_escape_string($db,$property->kitchen);
    $fridge=mysqli_real_escape_string($db,$property->fridge);
    $cooking=mysqli_real_escape_string($db,$property->cooking);
    $eating=mysqli_real_escape_string($db,$property->eating);
    $coffeemachine=mysqli_real_escape_string($db,$property->coffeemachine);
    $power=mysqli_real_escape_string($db,$property->power);
    $campfire=mysqli_real_escape_string($db,$property->campfire);
    $firewood=mysqli_real_escape_string($db,$property->firewood);
    $kids=mysqli_real_escape_string($db,$property->kids);
    $pets=mysqli_real_escape_string($db,$property->pets);

    $resourcesUpdate="UPDATE propertyResources SET userid = '$userid', potablewater = '$potablewater', toilet = '$toilet', shower = '$shower', hotshower = '$hotshower', kitchen = '$kitchen', fridge = '$fridge', cooking = '$cooking', eating = '$eating', coffeemachine = '$coffeemachine', power = '$power', campfire = '$campfire', firewood = '$firewood', kids = '$kids', pets = '$pets' WHERE propertyid = $propertyid";

    $resourcesInsert="INSERT into propertyResources(userid, propertyid, resourcessubmitted, potablewater, toilet, shower, hotshower,kitchen, fridge, cooking, eating, coffeemachine, power, campfire, firewood, kids, pets) VALUES ('$userid', '$propertyid', '1', '$potablewater', '$toilet', '$shower', '$hotshower', '$kitchen', '$fridge', '$cooking', '$eating', '$coffeemachine', '$power', '$campfire', '$firewood', '$kids', '$pets')";

	$resourcesSelect = "SELECT * FROM propertyResources WHERE propertyid = '$propertyid' AND userid = '$userid'";

}