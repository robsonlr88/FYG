<?php
	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once '../sql/sqlInfo.php';
	include_once '../sql/sqlResources.php';
	include_once '../sql/sqlSurroundings.php';
	include_once '../sql/sqlPricing.php';
	include_once '../sql/sqlStatus.php';

	$db->set_charset("utf8");
	$out = array('error' => false);

	//info
	$infoResult = mysqli_query($db,$infoSelect);
	if(mysqli_num_rows($infoResult)==1){
	
		mysqli_query($db,$infoUpdate);
		$out['info'] = 'Info updated successfuly';

	} elseif(mysqli_num_rows($infoResult)==0){
	
		mysqli_query($db,$infoUpdate);
		$out['info'] = 'Info inserted successfuly';

	} else {
		$out['error'] = true;
		$out['info'] = 'There is an error';
    }

	//resources
	$resourcesResult = mysqli_query($db,$resourcesSelect);
	if(mysqli_num_rows($resourcesResult)==1){
	
		mysqli_query($db,$resourcesUpdate);
		$out['resources'] = 'Resources updated successfuly';

	} elseif(mysqli_num_rows($resourcesResult)==0){
	
		mysqli_query($db,$resourcesInsert);
		$out['resources'] = 'Resources inserted successfuly';

	} else {
		$out['error'] = true;
		$out['resources'] = 'There is an error';
    }

	//surroundings
	$surroundingsResult = mysqli_query($db,$surroundingsSelect);
	if(mysqli_num_rows($surroundingsResult)==1){
	
		mysqli_query($db,$surroundingsUpdate);
		$out['surroundings'] = 'Surroundings updated successfuly';

	} elseif(mysqli_num_rows($surroundingsResult)==0){
	
		mysqli_query($db,$surroundingsInsert);
		$out['surroundings'] = 'Surroundings inserted successfuly';

	} else {
		$out['error'] = true;
		$out['surroundings'] = 'There is an error';
    }


	//pricing
	$priceResult = mysqli_query($db,$priceSelect);
	if(mysqli_num_rows($priceResult)==1){
	
		mysqli_query($db,$priceUpdate);
		$out['pricing'] = 'Pricing updated successfuly';

	} elseif(mysqli_num_rows($priceResult)==0){
	
		mysqli_query($db,$priceInsert);
		$out['pricing'] = 'Pricing inserted successfuly';

	} else {
		$out['error'] = true;
		$out['pricing'] = 'There is an error';
    }

    if(mysqli_query($db, $statusCompleted)){
		$out['error'] = false;
		$out['message'] = 'Status updated successfuly';
		//echo $infoUpdate;
    } else {
		$out['error'] = true;
		$out['message'] = 'There is an error';
    }
	
	echo json_encode($out);
?>