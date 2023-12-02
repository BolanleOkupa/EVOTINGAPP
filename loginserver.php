<?php
session_start();
require_once('dbaccess.php')
?>
<?php

include_once 'mailer.php';

$connection = mysqli_connect("localhost", "root", "", "votingapp");

if(isset($_POST)){
    // Get the JSON contents
    $json = file_get_contents('php://input');
    error_log('<<<<<<<<<<<<<<Request>>>>>>>>>>>>>>>>.'.$json);

    // decode the json data
    $data = json_decode($json);

    $email = $data->email;
    $password = $data->password;

    // Validate username and password is correct and status is active
    $emailExists = "SELECT id, firstname, lastname, email, status, role FROM users WHERE status = 'ACTIVE' and email = '$email' and password = '$password'";
    $result = mysqli_query($connection, $emailExists);
    $userCount = mysqli_num_rows($result);
//    var_dump(mysqli_num_rows($result));

    // start session for user (based on role) & Login user if '$emailExists' condition returns 'True' & '$userCount > 0'
    if($userCount > 0){
        while($obj = $result->fetch_object()){
            $_SESSION['userId_temp'] = $obj->id;
            $_SESSION['firstname_temp'] = $obj->firstname;
            $_SESSION['lastname_temp'] = $obj->lastname;
            $_SESSION['userRole_temp'] = $obj->role;
        }
       
        //start here
        $_SESSION['otp'] = rand(100000 , 999999);
        //sender information
        $fullname = $_SESSION['firstname_temp'] .' '.$_SESSION['lastname_temp'];
        error_log('<<<<<<<<<< otp: '.$_SESSION['otp']);
//      receiver email address and name
        $mail->addAddress($email, $fullname);
       // $mail->addAddress('okupaigho@gmail.com', $fullname);

        $mail->isHTML(true);

        $mail->Subject = 'Voting App OTP';
        $mail->Body    = "<h4> Voting App </h4>
        <b>Use code below to complete your authentication</b>
        <p>" . $_SESSION['otp'] ." </p>";

        // Send mail
        if (!$mail->send()) {
            error_log('Email not sent an error was encountered: ' . $mail->ErrorInfo);
        } else {
            error_log('Message has been sent.');
        }

        $mail->smtpClose();
        // end here
         $resp = [ 'message' => 'Login Successful.' ];
        echo json_encode($resp);
        error_log(' Response ' .json_encode($resp));
      http_response_code(200);
        return;
    }else {
        $resp = [ 'message' => 'Invalid login credentials.' ];
        echo json_encode($resp);
        error_log('Invalid login credentials.');
        http_response_code(403);
    }
}
else {
    $resp = [ 'message' => 'Login failed.' ];
    echo json_encode($resp);
    http_response_code(500);
}
?>