<?php

include_once '../src/db/dbc.php';

session_start();
$userid = $_SESSION['user'];

$db->set_charset("utf8");
$property=json_decode(file_get_contents("php://input"));

if(count($property)>0){
    $propertyid=mysqli_real_escape_string($db,$property->propertyid);
    $tentprice=mysqli_real_escape_string($db,$property->tentprice);
    $rvprice=mysqli_real_escape_string($db,$property->rvprice);
    $person=mysqli_real_escape_string($db,$property->person);
    $personprice=mysqli_real_escape_string($db,$property->personprice);
    $otherfees=mysqli_real_escape_string($db,$property->otherfees);
    $otherfeesname=mysqli_real_escape_string($db,$property->otherfeesname);
    $otherfeesprice=mysqli_real_escape_string($db,$property->otherfeesprice);

    $priceUpdate="UPDATE propertyPricing SET tentprice = '$tentprice', rvprice = '$rvprice', person = '$person', personprice = '$personprice', otherfees = '$otherfees', otherfeesname = '$otherfeesname',otherfeesprice = '$otherfeesprice' WHERE propertyid = '$propertyid' AND userid = '$userid'";

    $priceInsert="INSERT into propertyPricing(userid, propertyid, tentprice, rvprice, person, personprice, otherfees, otherfeesname, otherfeesprice) VALUES ('$userid', '$propertyid', '$tentprice', '$rvprice', '$person', '$personprice', '$otherfees', '$otherfeesname','$otherfeesprice')";

	$priceSelect = "SELECT * FROM propertyPricing WHERE propertyid = '$propertyid' AND userid = '$userid'";

    
}