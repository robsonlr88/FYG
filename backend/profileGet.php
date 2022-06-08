<?php
	session_start();
 
	//include_once '../src/db/conn.php';

	include_once '../src/db/dbc_auth.php';
 
	$output = array();
	$sql = "SELECT * FROM login WHERE id = '".$_SESSION['user']."'";
	$query=$db->query($sql);
	while($row=$query->fetch_array()){
		$output[] = $row;
	}
 
	echo json_encode($output);
?>