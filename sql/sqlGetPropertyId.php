<?php

session_start();
$userid = $_SESSION['user'];

include_once '../src/db/dbc.php';

$db->set_charset("utf8");

$id=mysqli_real_escape_string($db, $_GET["id"]);

$sqlInfo = "SELECT * FROM propertyInfo WHERE propertyid = '$id'";
$outp="";  
$resultInfo=mysqli_query($db,$sqlInfo);
$queryResultInfo = mysqli_num_rows($resultInfo);
if(mysqli_num_rows($resultInfo)>0){
    while($rInfo = $resultInfo->fetch_array(MYSQLI_ASSOC)){

        if($outp != "") {$outp .= ",";}
        $outp .= '{"propertyid":"' . $rInfo["propertyid"] . '"}';

    }
}
echo json_encode($out);

?>