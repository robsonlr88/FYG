<?php
     
    session_start();
    $userid = $_SESSION['user'];

	//include_once '../src/db/conn.php';

	include_once '../src/db/dbc_auth.php';

    $db->set_charset("utf8");
    $data = json_decode(file_get_contents('php://input'));
    if(count($data)>0){
        $email=mysqli_real_escape_string($db,$data->email);
        $password=mysqli_real_escape_string($db,$data->password);
        $name=mysqli_real_escape_string($db,$data->name);
        $lastname=mysqli_real_escape_string($db,$data->lastname);
        $dayofbirth=mysqli_real_escape_string($db,$data->dayofbirth);
        $monthofbirth=mysqli_real_escape_string($db,$data->monthofbirth);
        $yearofbirth=mysqli_real_escape_string($db,$data->yearofbirth);
        $zipcode=mysqli_real_escape_string($db,$data->zipcode);
        $city=mysqli_real_escape_string($db,$data->city);
        $country=mysqli_real_escape_string($db,$data->country);
        
        $query="UPDATE login SET id = '$userid', email = '$email', password = '$password', name = '$name', lastname = '$lastname', dayofbirth = '$dayofbirth', monthofbirth = '$monthofbirth', yearofbirth = '$yearofbirth', zipcode = '$zipcode', city = '$city', country = '$country' where id = '$userid'";
        
        if(mysqli_query($db,$query)){
            $out['user'] = uniqid('ang_');
            $out['message'] = 'Login Successful';
        }else{
            $out['error'] = true;
            $out['message'] = 'Invalid Login';        
        }
        echo json_encode($out);

	}

      






//     echo $query;
//    $query = $db->query($sql);
      

//    $result = mysqli_query($db,$query);
//
//     if($result){
//         $nid = $db->insert_id;
//         $out['user'] = uniqid('ang_');
//         $_SESSION['user'] = $nid;
//     }
//     else{
//         $out['error'] = true;
//         $out['message'] = 'Signup Failed';
//     }
//    
//     echo json_encode($out);
      
     ?>