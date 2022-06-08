<?php

	session_start();
	$userid = $_SESSION['user'];

	include_once '../src/db/dbc.php';
	include_once '../sql/sqlPictures.php';
	
	if (in_array($fileActualExt0, $allowed) && in_array($fileActualExt1, $allowed) && in_array($fileActualExt2, $allowed) && in_array($fileActualExt3, $allowed) && in_array($fileActualExt4, $allowed) ){
		if (in_array($fileActualExt0, $allowed) && in_array($fileActualExt1, $allowed) && in_array($fileActualExt2, $allowed) && in_array($fileActualExt3, $allowed) && in_array($fileActualExt4, $allowed) ) {
			if ($fileError0 === 0 && $fileError1 === 0 && $fileError2 === 0 && $fileError3 === 0 && $fileError4 === 0){
				if ($fileSize0 < $sizeLimit && $fileSize1 < $sizeLimit && $fileSize2 < $sizeLimit && $fileSize3 < $sizeLimit && $fileSize4 < $sizeLimit ) {
	
					$result = mysqli_query($db,$picturesSelect);
			
					if(mysqli_num_rows($result)==1){
					
						if(mysqli_query($db, $picturesUpdate)){
							echo "0";
						} else {
							echo "not inserted";
						}
			
					} else
					if(mysqli_num_rows($result)==0){
					
						if(mysqli_query($db, $picturesInsert)){
							echo "0";
						} else {
							echo "not inserted";
						}
					}				
				} else {
					echo "2";
				}
			} else {
				echo "3";
			}
		} else {
			echo "Problem with the extension of the file";
		}
	} else {
		echo "1";
	}
?>