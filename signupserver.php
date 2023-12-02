<?php
require_once('dbaccess.php')
?>
<?php

$connection = mysqli_connect("localhost", "root", "", "votingapp");

  if(isset($_POST)){
    // Get the JSON contents
      $json = file_get_contents('php://input');
      error_log('<<<<<<<<<<<<<<Request>>>>>>>>>>>>>>>>.'.$json);

    // decode the json data
      $data = json_decode($json);

      $firstname = $data->firstname;
      error_log('<<<<<<<<<< Firstname: '.$firstname);
      $lastname = $data->lastname;
      $dateofbirth = $data->dateofbirth;
      $idDoc = $data->iddoc;
      $gender = $data->gender;
      $email = $data->username;
      $password = $data->password;
      $repeatPassword = $data->repeatPassword;
      if(empty($firstname) || empty($lastname) || empty($gender) || empty($dateofbirth) || empty($idDoc) || empty($email) || empty($password) || empty($repeatPassword)){
      $resp = [ 'message' => 'Invalid parameters supplied' ];
              echo json_encode($resp);
              error_log('Invalid parameters supplied.');
              http_response_code(403);
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
      }
      else if($password != $repeatPassword){
       $resp = [ 'message' => 'Passwords do not match.' ];
           echo json_encode($resp);
           http_response_code(500);
       }
      else {
              $sql = "INSERT INTO users(firstname, lastname, dob, iddoc, gender, email, password, status, role) VALUES (?,?,?,?,?,?,?,?,?)";
              $stmtInsert = $db->prepare($sql);
              $result = $stmtInsert->execute([$firstname, $lastname, $dateofbirth, $idDoc, $gender, $email, $password, 'PENDING', 'VOTER']);
              if($result) {
                $resp = [ 'message' => 'Voter registration is pending verification.' ];
                echo json_encode($resp);
                http_response_code(201);
              } else {
                $resp = [ 'message' => 'Unable to Register voter.' ];
                echo json_encode($resp);
                http_response_code(500);
              }
      }
  }
  else {
      echo 'Empty Inputs';
  }
?>