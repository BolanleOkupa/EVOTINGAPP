<?php
session_start();
require_once('dbaccess.php')
?>
<?php
    $connection = mysqli_connect("localhost", "root", "", "votingapp");
    if(!isset($_SESSION['userRole'])){
        // Invalid user session
        error_log('<<<<<<<<<<<<<<Invalid user session in create/view user>>>>>>>>>>>>>>>>.');
        http_response_code(403);
        return;
    }
    $action =  $_GET["action"];
    if($action == 'GET'){
        error_log('In get users request ');
        $usersExist = "SELECT id, firstname, lastname,dob, iddoc, gender, email, status, role FROM users";
        $result = mysqli_query($connection, $usersExist);
        $userCount = mysqli_num_rows($result);

        if($userCount > 0){
            $resultArray = [];
            while($obj = $result->fetch_object()){
                $resultArray[] = $obj;
            }
            $resp = [ 'message' => 'Records found.' , 'results' => $resultArray ];
            echo json_encode($resp);
            error_log('<<<<<<<<<< Data found: '.json_encode($resp));
            http_response_code(200);
        }
        else {
            $resp = [ 'message' => 'No records found.' ];
            echo json_encode($resp);
            error_log('No records found.');
            http_response_code(403);
        }
    }else if($action == 'DEACTIVATE'){
        $selectedUser =  $_GET["param"];
        error_log('In Deactivate user request '.$selectedUser);
        // deactivate user
        $query = "UPDATE users set status = 'INACTIVE' where id = $selectedUser";
        $userResult = mysqli_query($connection, $query);

        $resp = [ 'message' => 'User was deactivated successfully' ];
        echo json_encode($resp);
        error_log('User was deactivated successfully.');
        http_response_code(200);
        return;
    }else if($action == 'ACTIVATE' || $action == 'APPROVE'){
        $selectedUser =  $_GET["param"];
        error_log('In '.$action.' user request '.$selectedUser);
        // activate user
        $query = "UPDATE users set status = 'ACTIVE' where id = $selectedUser";
        error_log('Query in approval: '.$query);
        $userResult = mysqli_query($connection, $query);

        $resp = [ 'message' => 'User was activated successfully' ];
        echo json_encode($resp);
        error_log('User was activated successfully.');
        http_response_code(200);

        if($action == 'APPROVE'){
            $emailId =  $_GET["emailId"];
            include_once 'mailer.php';

            //      receiver email address and name
            $mail->addAddress($emailId, 'voter');
            $mail->isHTML(true);
            $mail->Subject = 'Voting App Registration Approved';
            $mail->Body    = "<b>Hello,<br/>Your registration to vote has been approved.</b>";
            if (!$mail->send()) {
                error_log('Email not sent an error was encountered: ' . $mail->ErrorInfo);
            } else {
                error_log('Message has been sent.');
            }
            $mail->smtpClose();
        }
        return;
     }else if($action == 'REJECT'){
              $selectedUser =  $_GET["param"];
              error_log('In '.$action.' user request '.$selectedUser);
              // delete user
              $query = "delete from users where id = $selectedUser";
              error_log('Query in rejection: '.$query);
              $userResult = mysqli_query($connection, $query);

              $resp = [ 'message' => 'User was rejected successfully' ];
              echo json_encode($resp);
              error_log('User was rejected successfully.');
              http_response_code(200);


              $emailId =  $_GET["emailId"];
              include_once 'mailer.php';

              //receiver email address and name
              $mail->addAddress($emailId, 'voter');
              $mail->isHTML(true);
              $mail->Subject = 'Voting App Registration Rejected';
              $mail->Body    = "<b>Hello,<br/>Your registration to vote has been rejected.<br/>Kindly register with a valid identification document</b>";
              if (!$mail->send()) {
                  error_log('Email not sent an error was encountered: ' . $mail->ErrorInfo);
              } else {
                  error_log('Message has been sent.');
              }
              $mail->smtpClose();

              return;
       }else if($action == 'POST'){
         $json = file_get_contents('php://input');
         error_log('Post user Request: '.$json);
         if(is_null($json)){
             return;
         }
        $data = json_decode($json);
        $firstname = $data->firstname;
        $lastname = $data->lastname;
        $gender = $data->gender;
        $email = $data->email;
        $password = $data->password;
        $repeatPassword = $data->repeatPassword;
        $role = $data->role;
        $status = $data->status;
        
        if(empty($firstname) || empty($lastname) || empty($gender) || empty($email) || empty($password) || empty($repeatPassword) || empty($role) || empty($status)){
            $resp = [ 'message' => 'Invalid parameters supplied' ];
            echo json_encode($resp);
            error_log('Invalid parameters supplied.');
            http_response_code(403);
            return;
        }
        else if($password != $repeatPassword){
            $resp = [ 'message' => 'Passwords do not match.' ];
            echo json_encode($resp);
            http_response_code(500);
            return;
        }

        // Check if email has already been registered by another user
        $emailExists = "SELECT * FROM users WHERE email = '$email'";
        $num = mysqli_query($connection, $emailExists);
        $emailCount = mysqli_num_rows($num);

        // Register user if the email has not been used
        if($emailCount > 0){
            $resp = [ 'message' => 'This email is already in use.' ];
            echo json_encode($resp);
            error_log('This email is already in use.');
            http_response_code(403);
            return;
        }
        else {
            $sql = "INSERT INTO users(firstname, lastname, gender, email, password, role, status) VALUES (?,?,?,?,?,?,?)";
            $stmtInsert = $db->prepare($sql);
            $result = $stmtInsert->execute([$firstname, $lastname, $gender, $email, $password, $role, $status]);
            if($result) {
                $resp = [ 'message' => 'User creation was successful.' ];
                echo json_encode($resp);
                http_response_code(201);
            } else {
                $resp = [ 'message' => 'Unable to create user.' ];
                echo json_encode($resp);
                http_response_code(500);
            }
        }

    }
?>