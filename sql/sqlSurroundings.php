<?php

include_once '../src/db/dbc.php';

session_start();
$userid = $_SESSION['user'];

$db->set_charset("utf8");
$property=json_decode(file_get_contents("php://input"));

if(count($property)>0){
    $propertyid=mysqli_real_escape_string($db,$property->propertyid);
    $grocery=mysqli_real_escape_string($db,$property->grocery);
    $grocerydistance=mysqli_real_escape_string($db,$property->grocerydistance);
    $wateraccess=mysqli_real_escape_string($db,$property->wateraccess);
    $ocean=mysqli_real_escape_string($db,$property->ocean);
    $oceandistance=mysqli_real_escape_string($db,$property->oceandistance);
    $lake=mysqli_real_escape_string($db,$property->lake);
    $lakedistance=mysqli_real_escape_string($db,$property->lakedistance);
    $river=mysqli_real_escape_string($db,$property->river);
    $riverdistance=mysqli_real_escape_string($db,$property->riverdistance);
    $nationalpark=mysqli_real_escape_string($db,$property->nationalpark);
    $nationalparkdistance=mysqli_real_escape_string($db,$property->nationalparkdistance);

    $surroundingsUpdate="UPDATE propertySurroundings SET userid = '$userid', propertyid = '$propertyid', grocery = '$grocery', grocerydistance = '$grocerydistance', wateraccess = '$wateraccess', ocean = '$ocean', oceandistance = '$oceandistance', lake = '$lake', lakedistance = '$lakedistance', river = '$river', riverdistance = '$riverdistance', nationalpark = '$nationalpark', nationalparkdistance = '$nationalparkdistance' WHERE propertyid = $propertyid";

    $surroundingsInsert="INSERT into propertySurroundings(userid, propertyid, surroundingssubmitted, grocery, grocerydistance, wateraccess, ocean, oceandistance, lake, lakedistance, river, riverdistance, nationalpark, nationalparkdistance) VALUES ('$userid', '$propertyid', '1', '$grocery', '$grocerydistance', '$wateraccess', '$ocean', '$oceandistance', '$lake', '$lakedistance', '$river', '$riverdistance', '$nationalpark', '$nationalparkdistance')";

	$surroundingsSelect = "SELECT * FROM propertySurroundings WHERE propertyid = '$propertyid' AND userid = '$userid'";

}