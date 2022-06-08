<?php

include_once '../src/db/dbc.php';

session_start();
$userid = $_SESSION['user'];

$data=json_decode(file_get_contents("php://input"));
$propertyid=htmlspecialchars($_POST["propertyid"]);

$allowed = array('jpg', 'jpeg', 'png', 'pdf', 'JPG');
$sizeLimit = 4000000;

$fileName0 = $_FILES['image0']['name'];
$fileTmpName0 = $_FILES['image0']['tmp_name'];
$fileSize0 = $_FILES['image0']['size'];
$fileError0 = $_FILES['image0']['error'];
$fileExt0 = explode('.', $fileName0);
$fileActualExt0 = strtolower(end($fileExt0));

$fileName1 = $_FILES['image1']['name'];
$fileTmpName1 = $_FILES['image1']['tmp_name'];
$fileSize1 = $_FILES['image1']['size'];
$fileError1 = $_FILES['image1']['error'];
$fileExt1 = explode('.', $fileName1);
$fileActualExt1 = strtolower(end($fileExt1));

$fileName2 = $_FILES['image2']['name'];
$fileTmpName2 = $_FILES['image2']['tmp_name'];
$fileSize2 = $_FILES['image2']['size'];
$fileError2 = $_FILES['image2']['error'];
$fileExt2 = explode('.', $fileName2);
$fileActualExt2 = strtolower(end($fileExt2));

$fileName3 = $_FILES['image3']['name'];
$fileTmpName3 = $_FILES['image3']['tmp_name'];
$fileSize3 = $_FILES['image3']['size'];
$fileError3 = $_FILES['image3']['error'];
$fileExt3 = explode('.', $fileName3);
$fileActualExt3 = strtolower(end($fileExt3));

$fileName4 = $_FILES['image4']['name'];
$fileTmpName4 = $_FILES['image4']['tmp_name'];
$fileSize4 = $_FILES['image4']['size'];
$fileError4 = $_FILES['image4']['error'];
$fileExt4 = explode('.', $fileName4);
$fileActualExt4 = strtolower(end($fileExt4));


$fileNameNew0 = "id-".$propertyid."-coverphoto.".$fileActualExt0;
$fileNameNew1 = "id-".$propertyid."-photo1.".$fileActualExt1;
$fileNameNew2 = "id-".$propertyid."-photo2.".$fileActualExt2;
$fileNameNew3 = "id-".$propertyid."-photo3.".$fileActualExt3;
$fileNameNew4 = "id-".$propertyid."-photo4.".$fileActualExt4;
$fileDestination0 = '/var/www/html/uploads/'.$fileNameNew0;
$fileDestination1 = '/var/www/html/uploads/'.$fileNameNew1;
$fileDestination2 = '/var/www/html/uploads/'.$fileNameNew2;
$fileDestination3 = '/var/www/html/uploads/'.$fileNameNew3;
$fileDestination4 = '/var/www/html/uploads/'.$fileNameNew4;
move_uploaded_file($fileTmpName0, $fileDestination0);
move_uploaded_file($fileTmpName1, $fileDestination1);
move_uploaded_file($fileTmpName2, $fileDestination2);
move_uploaded_file($fileTmpName3, $fileDestination3);
move_uploaded_file($fileTmpName4, $fileDestination4);
$fileDb0 = '/uploads/'.$fileNameNew0;
$fileDb1 = '/uploads/'.$fileNameNew1;
$fileDb2 = '/uploads/'.$fileNameNew2;
$fileDb3 = '/uploads/'.$fileNameNew3;
$fileDb4 = '/uploads/'.$fileNameNew4;

$picturesUpdate="UPDATE propertyPictures SET userid = '$userid', coverphoto = '$fileDb0', image1 = '$fileDb1', image2 = '$fileDb2', image3 = '$fileDb3', image4 = '$fileDb4' WHERE propertyid = $propertyid";

$picturesInsert="INSERT into propertyPictures(userid, propertyid, picturessubmitted, coverphoto, image1, image2, image3, image4) VALUES ('$userid','$propertyid', '1', '$fileDb0','$fileDb1','$fileDb2','$fileDb3','$fileDb4')";

$picturesSelect = "SELECT * FROM propertyPictures WHERE propertyid = '$propertyid' AND userid = '$userid'";