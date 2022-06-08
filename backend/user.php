<?php
	session_start();
 
	//include_once '../src/db/conn.php';
 
	include_once '../src/db/dbc_auth.php';

	$output = array();
	$sql = "SELECT * FROM login WHERE id = '".$_SESSION['user']."'";
	$query=$db->query($sql);
	while($rs=$query->fetch_array()){
		if($outp != "") {$outp .= ",";}
		$outp .= '{"id":"' . $rs["id"] . '",';
		$outp .= '"email":"' . $rs["email"] . '",';
		$outp .= '"name":"' . $rs["name"] . '"}';
	}
	$outp = '{"user":['.$outp.']}';
	echo($outp);
 
//	echo json_encode($output);
?>