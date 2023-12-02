<?php
session_start();
?>
<?php

$connection = mysqli_connect("localhost", "root", "", "votingapp");

 if(isset($_GET) && isset($_GET['action']) && $_GET["action"] == 'verifytoken'){
    $action =  $_GET["action"];
    $token =  $_GET["token"];
    $email =  $_GET["email"];

    error_log('Email Supplied: '.$email);

    // Check if email exists
    $emailExists = "SELECT id FROM users WHERE status = 'ACTIVE' and email = '$email' and reset_token_hash = '$token'";
    $result = mysqli_query($connection, $emailExists);
    $userCount = mysqli_num_rows($result);

    if($userCount > 0){
        $resp = [ 'message' => 'token valid.' ];
        echo json_encode($resp);
        http_response_code(200);
        return;
    }else{
        $resp = [ 'message' => 'Invalid email or token provided.' ];
        echo json_encode($resp);
        http_response_code(500);
    }

}else if(isset($_POST)){
    $json = file_get_contents('php://input');
    error_log('Post change password request: '.$json);
    if(is_null($json)){
        return;
    }
    $data = json_decode($json);

    $action = $data->action;
    $email = $data->email;
    $password = $data->password;
    $repeatPassword = $data->repeatPassword;
    if($action == 'resetpassword'){
        if($password != $repeatPassword){
            $resp = [ 'message' => 'Passwords do not match.' ];
            echo json_encode($resp);
            http_response_code(500);
            return;
        }
        $query = "UPDATE users set reset_token_hash = null, reset_token_expires_at = null, password = '$password' where email = '$email'";
        $updateResult = mysqli_query($connection, $query);
        $resp = [ 'message' => 'Password was changed successfully' ];
        echo json_encode($resp);
        error_log('Password was changed successfully.');
        http_response_code(200);
        return;
    }
}
else {
    $resp = [ 'message' => 'password reset failed.' ];
    echo json_encode($resp);
    http_response_code(500);
}
?>