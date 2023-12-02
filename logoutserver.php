<?php
session_start();
?>
<?php
  if(isset($_GET)){
      $resp = [ 'message' => 'Logout Successful.' ];
      echo json_encode($resp);
      error_log('<<<<<<<<<<<<<<In logout >>>>>>>>>>>>>>>>.');
      // Finally, destroy the session.
      session_destroy();
      http_response_code(200);

  }
?>