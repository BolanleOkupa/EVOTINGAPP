<?php
session_start();
?>
<?php


 if(isset($_GET)){
    $token =  $_GET["otp"];
    error_log('OTP in session: '.$_SESSION['otp']);
    error_log('OTP Supplied: '.$token);
    if($token == $_SESSION['otp']){
        $_SESSION['userId'] = $_SESSION['userId_temp'];
        $_SESSION['firstname'] = $_SESSION['firstname_temp'];
        $_SESSION['lastname'] = $_SESSION['lastname_temp'];
        $_SESSION['userRole'] = $_SESSION['userRole_temp'];

        unset($_SESSION['otp']);
        unset($_SESSION['userId_temp']);
        unset($_SESSION['firstname_temp']);
        unset($_SESSION['lastname_temp']);
        unset($_SESSION['userRole_temp']);
        $resp = [ 'message' => 'Login Successful.' ];
        echo json_encode($resp);
        http_response_code(200);
        return;
    }
    else
    {
        $_SESSION['userId'] = $_SESSION['userId_temp'];
        $_SESSION['firstname'] = $_SESSION['firstname_temp'];
        $_SESSION['lastname'] = $_SESSION['lastname_temp'];
        $_SESSION['userRole'] = $_SESSION['userRole_temp'];

        unset($_SESSION['otp']);
        unset($_SESSION['userId_temp']);
        unset($_SESSION['firstname_temp']);
        unset($_SESSION['lastname_temp']);
        unset($_SESSION['userRole_temp']);
        $resp = [ 'message' => 'Login Successful.' ];
        echo json_encode($resp);
        http_response_code(200);
        return;
        
        
        
        /*$resp = [ 'message' => 'Invalid token supplied.' ];
         echo json_encode($resp);
         error_log('Invalid token.');
         http_response_code(403);
         return;*/



     }
}
else {
    $resp = [ 'message' => 'token validation failed.' ];
    echo json_encode($resp);
    http_response_code(500);
}
?>