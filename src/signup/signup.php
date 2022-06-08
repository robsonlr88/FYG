<?php
     
session_start();
  
//include_once '../src/db/conn.php';

include_once '../db/dbc_auth.php';

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
 
$out = array('error' => false);
  
$user = json_decode(file_get_contents('php://input'));    

$email = $user->email;
$password = $user->password;
$cpassword = $user->cpassword;
$name = $user->name;

if($password != $cpassword) {
    $out['error'] = true;
	$out['message'] = "Password and Confirm Password don't match.";
    
} elseif ($password == $cpassword){

    $result = mysqli_query($db,"SELECT * FROM login WHERE email='$email'");

    $row= mysqli_num_rows($result); 

    if($row < 1){

        $token = md5($email).rand(10,9999);

//    $query = "INSERT INTO login(name, email, email_verification_link, password) VALUES('$name', '$email', '$token', '" . md5($password). "')";

    mysqli_query($db, "INSERT INTO login(name, email, email_verification_link, password) VALUES('$name', '$email', '$token', '" . md5($password). "')");
    

        $link = "<a href='localhost/fyg/#/verify-email/key=".$email."&token=".$token."'>Click here and verify your email address</a>";
        
		$message = "Hello $name! <br>"
		. "Please click the link below to confirm your email and complete the registration process.<br>"
		. "You will be automatically redirected to a welcome page where you can then sign in.<br><br>"            
		. "Please click below to activate your account:<br>"
		. "$link <br><br>"
		. "<b>Find Your Ground team</b>";
        
        require '/var/www/html/phpmailer/src/Exception.php';
        require '/var/www/html/phpmailer/src/PHPMailer.php';
        require '/var/www/html/phpmailer/src/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.titan.email";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "email-confirmation@findyourground.online";
        $mail->Password = "Dellayoga123$";
        $mail->SetFrom("email-confirmation@findyourground.online");
        $mail->Subject = "Welcome to Find you Ground";
        $mail->Body    = $message;
        $mail->addAddress($email);              
        $mail->addReplyTo('email-confirmation@findyourground.online');
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $out['message'] = 'Email sent.';
        }
        
        $out['user'] = uniqid('ang_');
        $out['error'] = false;
        $_SESSION['user'] = $row['id'];
        $_SESSION['name'] = $row['name'];

    } else {
		$out['error'] = true;
		$out['message'] = "You have already registered with us. Check Your email box and confirm your email.";
	}
}

echo json_encode($out);
 
?>