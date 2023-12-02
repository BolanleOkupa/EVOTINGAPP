<?php
session_start();
?>
<?php
include_once 'mailer.php';

$connection = mysqli_connect("localhost", "root", "", "votingapp");

 if(isset($_GET)){
    $email =  $_GET["email"];

    error_log('Email Supplied: '.$email);

    // Check if email exists
    $emailExists = "SELECT id, firstname, lastname FROM users WHERE status = 'ACTIVE' and email = '$email'";
    $result = mysqli_query($connection, $emailExists);
    $userCount = mysqli_num_rows($result);

     if($userCount > 0){
         $token = bin2hex(random_bytes(16));
         $token_hash = hash("sha256", $token);
         $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        $fullname = '';
        while($obj = $result->fetch_object()){
            $id = $obj->id;
            $firstname = $obj->firstname;
            $lastname = $obj->lastname;

            $fullname = $obj->firstname .' '.$obj->lastname;

            $query = "UPDATE users set reset_token_hash = '$token_hash', reset_token_expires_at = '$expiry' where id = $id";
            $updateResult = mysqli_query($connection, $query);
        }
        //receiver email address and name
        $mail->addAddress($email, $fullname);
        $mail->isHTML(true);
        $mail->Subject = 'Reset your voting app password';
        $mail->Body    = "<b>Hello,<br/> Click <a href=\"http://localhost/votingapp/resetpassword.php?sender=$email&token=$token_hash\">here</a> to reset your password.</b>";

        if (!$mail->send()) {
            error_log('Email not sent an error was encountered: ' . $mail->ErrorInfo);
        } else {
            error_log('Message has been sent.');
        }
        $mail->smtpClose();

        $resp = [ 'message' => 'reset password link has been sent.' ];
        echo json_encode($resp);
        http_response_code(200);
        error_log('Returning 200.');
        return;
    }else{
        $resp = [ 'message' => 'Email provided does not exist.' ];
        echo json_encode($resp);
        http_response_code(500);
        return;
    }

}
else {
    $resp = [ 'message' => 'password reset failed.' ];
    echo json_encode($resp);
    http_response_code(500);
}
?>