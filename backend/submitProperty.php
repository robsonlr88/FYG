<?php
	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once 'sqlCreate.php';

	$db->set_charset("utf8");
	$out = array('error' => false);

    if(mysqli_query($db, $infoUpdate) AND mysqli_query($db, $resourcesUpdate) AND mysqli_query($db, $surroundingsUpdate) AND mysqli_query($db, $pricingUpdate)){
		$out['error'] = false;
		$out['message'] = 'Information updated successfuly';
		//echo $infoUpdate;
    } else {
		$out['error'] = true;
		$out['message'] = 'There is an error';
    }
	
	echo json_encode($out);

?>