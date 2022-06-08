<?php

session_start();
$userid = $_SESSION['user'];

$db->set_charset("utf8");

$id=mysqli_real_escape_string($db, $_GET["id"]);

$infoSelectIdGet = "SELECT * FROM propertyInfo WHERE propertyid = '$id' AND userid = '$userid'";

$resourcesSelectIdGet = "SELECT * FROM propertyResources WHERE propertyid = '$id' AND userid = '$userid'";

$surroundingsSelectIdGet = "SELECT * FROM propertySurroundings WHERE propertyid = '$id' AND userid = '$userid'";

$pricingSelectIdGet = "SELECT * FROM propertyPricing WHERE propertyid = '$id' AND userid = '$userid'";

$picturesSelectIdGet = "SELECT * FROM propertyPictures WHERE propertyid = '$id' AND userid = '$userid'";


?>