<?php

session_start();
$userid = $_SESSION['user'];

$db->set_charset("utf8");
$property=json_decode(file_get_contents("php://input"));

if(count($property)>0){
    $propertyid=mysqli_real_escape_string($db,$property->propertyid);
    $propertyname=mysqli_real_escape_string($db,$property->propertyname);
    $propertyaddress=mysqli_real_escape_string($db,$property->propertyaddress);
    $propertyzipcode=mysqli_real_escape_string($db,$property->propertyzipcode);
    $propertycity=mysqli_real_escape_string($db,$property->propertycity);
    $propertyprovince=mysqli_real_escape_string($db,$property->propertyprovince);
    $propertyphone=mysqli_real_escape_string($db,$property->propertyphone);
    $propertywebsite=mysqli_real_escape_string($db,$property->propertywebsite);
    $propertyemail=mysqli_real_escape_string($db,$property->propertyemail);

    $infoUpdate="UPDATE propertyInfo SET propertyname = '$propertyname', userid = '$userid', propertyaddress = '$propertyaddress', propertyzipcode = '$propertyzipcode', propertycity = '$propertycity', propertyprovince = '$propertyprovince', propertycountry = 'Canada', propertyphone = '$propertyphone', propertywebsite = '$propertywebsite', propertyemail = '$propertyemail' WHERE propertyid = '$propertyid' AND userid = '$userid'";
    
    $infoInsert="INSERT INTO propertyInfo(propertyname, userid, propertyaddress, propertyzipcode, propertycity, propertyprovince, propertycountry, propertyphone, propertywebsite, propertyemail) VALUES ('$propertyname', '$userid', '$propertyaddress', '$propertyzipcode', '$propertycity', '$propertyprovince', 'Canada', '$propertyphone', '$propertywebsite', '$propertyemail')";

    $infoSelect = "SELECT * FROM propertyInfo WHERE propertyname = '$propertyname' AND propertyaddress = '$propertyaddress' AND propertyzipcode = '$propertyzipcode' AND propertycity = '$propertycity' AND propertyprovince = '$propertyprovince' AND propertycountry = 'Canada' AND propertyphone = '$propertyphone' AND propertywebsite = '$propertywebsite' AND propertyemail = '$propertyemail'";

	$infoSelectId = "SELECT * FROM propertyInfo WHERE propertyid = '$propertyid' AND userid = '$userid'";


}