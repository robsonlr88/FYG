<?php

session_start();
$userid = $_SESSION['user'];

$db->set_charset("utf8");
$property=json_decode(file_get_contents("php://input"));

if(count($property)>0){
    $propertyid=mysqli_real_escape_string($db,$property->propertyid);

    $statusInsert="INSERT INTO propertyStatus(propertyid, userid, finished, posted) VALUES ('$propertyid', '$userid', 'Uncompleted', 'Unpublished')";

    $statusCompleted="UPDATE propertyStatus SET finished = 'Completed', posted = 'Unpublished' WHERE propertyid = '$propertyid' AND userid = '$userid'";

}