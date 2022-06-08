<?php
    if($_GET['key'] && $_GET['token'])
    {
        //include "../src/db/conn.php";
        
        include_once '../src/db/dbc_auth.php';


        $email = $_GET['key'];
        
        $token = $_GET['token'];
        
        $query = mysqli_query($db,
        
        "SELECT * FROM `login` WHERE `email_verification_link`='".$token."' and `email`='".$email."';"
        );
        
        $d = date('Y-m-d H:i:s');
        
        if (mysqli_num_rows($query) > 0) {
            $row= mysqli_fetch_array($query);
            if($row['email_verified_at'] == NULL){
                mysqli_query($db,"UPDATE login set email_verified_at ='" . $d . "' WHERE email='" . $email . "'");
                $out['error'] = false;
                $out['message'] = "Congratulations! Your email has been verified.";
            }else{
                $out['error'] = true;
                $out['message'] = "You have already verified your account with us. You may now login to your account.";
            }
        } else {
            $out['error'] = true;
            $out['message'] = "Sorry, this link is no longer available. Please use the most recent email sent by us to activate your account.";
        }
    }
    else
    {
        $out['error'] = true;
        $out['message'] = "Something went wrong.";
    }

    echo json_encode($out);
?>