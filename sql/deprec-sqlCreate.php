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

    $tentprice=mysqli_real_escape_string($db,$property->tentprice);
    $rvprice=mysqli_real_escape_string($db,$property->rvprice);
    $person=mysqli_real_escape_string($db,$property->person);
    $personprice=mysqli_real_escape_string($db,$property->personprice);
    $otherfees=mysqli_real_escape_string($db,$property->otherfees);
    $otherfeesname=mysqli_real_escape_string($db,$property->otherfeesname);
    $otherfeesprice=mysqli_real_escape_string($db,$property->otherfeesprice);

    $infoUpdate="UPDATE propertyInfo SET propertyname = '$propertyname', userid = '$userid', propertyaddress = '$propertyaddress', propertyzipcode = '$propertyzipcode', propertycity = '$propertycity', propertyprovince = '$propertyprovince', propertycountry = 'Canada', propertyphone = '$propertyphone', propertywebsite = '$propertywebsite', propertyemail = '$propertyemail' WHERE propertyid = '$propertyid' AND userid = '$userid'";

    $resourcesUpdate="UPDATE propertyResources SET potablewater = '$potablewater', toilet = '$toilet', shower = '$shower', hotshower = '$hotshower', kitchen = '$kitchen', fridge = '$fridge', cooking = '$cooking', eating = '$eating', coffeemachine = '$coffeemachine', power = '$power', campfire = '$campfire', firewood = '$firewood', kids = '$kids', pets = '$pets' WHERE propertyid = '$propertyid' AND userid = '$userid'";

    $surroundingsUpdate="UPDATE propertySurroundings SET userid = '$userid', propertyid = '$propertyid', grocery = '$grocery', grocerydistance = '$grocerydistance', wateraccess = '$wateraccess', ocean = '$ocean', oceandistance = '$oceandistance', lake = '$lake', lakedistance = '$lakedistance', river = '$river', riverdistance = '$riverdistance', nationalpark = '$nationalpark', nationalparkdistance = '$nationalparkdistance' WHERE propertyid = '$propertyid' AND userid = '$userid'";

    $pricingUpdate="UPDATE propertyPricing SET tentprice = '$tentprice', rvprice = '$rvprice', person = '$person', personprice = '$personprice', otherfees = '$otherfees', otherfeesname = '$otherfeesname', otherfeesprice = '$otherfeesprice' WHERE propertyid = '$propertyid' AND userid = '$userid'";

}