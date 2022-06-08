<?php
     
     session_start();
      
     //include_once '../src/db/conn.php';

     include_once '../src/db/dbc_auth.php';

      
     if ($db->connect_error) {
         die("Connection failed: " . $db->connect_error);
     }
      
     $out = array('error' => false);
      
     $user = json_decode(file_get_contents('php://input'));    
     $username = $user->username;
     $password = $user->password;
      
     $sql = "SELECT * FROM login WHERE email='$username' AND password='" . md5($password). "'";

     $query = $db->query($sql);
    
     if($query->num_rows>0){
        $row = $query->fetch_array();

        if (!isset($row['email_verified_at'])){

            $out['error'] = true;
            $out['message'] = 'Please check your email box and confirm your account.';

        } elseif (isset($row['email_verified_at'])) {
            $out['message'] = 'Login Successful';
            $out['user'] = uniqid('ang_');
            $_SESSION['user'] = $row['id'];
            $_SESSION['name'] = $row['name'];
        }
     }
     else{
         $out['error'] = true;
         $out['message'] = 'Invalid Login';
     }
    
     echo json_encode($out);
      
     ?>