<?php
session_start();
require_once('dbaccess.php')
?>
<?php
    $connection = mysqli_connect("localhost", "root", "", "votingapp");
    if(!isset($_SESSION['userRole'])){
        // Invalid user session
        error_log('<<<<<<<<<<<<<<Invalid user session in create/view parties>>>>>>>>>>>>>>>>.');
        http_response_code(403);
        return;
    }
    $action =  $_GET["action"];
    if($action == 'GET'){
        error_log('In get parties request ');
        $partyExists = "SELECT id, partyname, partycode, logo FROM parties";
        $result = mysqli_query($connection, $partyExists);
        $partyCount = mysqli_num_rows($result);

        if($partyCount > 0){
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
    }else if($action == 'PREPAREFOREDIT'){
        $selectedParty =  $_GET["param"];
        error_log('In PREPAREFOREDIT request '.$selectedParty);

        $partyExists = "SELECT id, partyname, partycode, logo FROM parties WHERE id = $selectedParty";
        $result = mysqli_query($connection, $partyExists);
        $partyCount = mysqli_num_rows($result);

        if($partyCount > 0){
            $resultArray = [];
            while($res = $result->fetch_object()){
                $obj = $res;
            }
            $resp = [ 'obj'=>$obj ];
            echo json_encode($resp);
            error_log('<<<<<<<<<< Data found: '.json_encode($resp));
            http_response_code(200);
        }
        return;
    }
    else if($action == 'POST'){
         $json = file_get_contents('php://input');
         error_log('Post user Request: '.$json);
         if(is_null($json)){
             return;
         }
        $data = json_decode($json);
        $id = $data->partyid;
        $partyName = $data->party_name;
        $partyCode = $data->party_code;
        $partyLogo = $data->party_logo;
        
        
        if(empty($partyName) || empty($partyCode) || empty($partyLogo)){
            $resp = [ 'message' => 'Invalid parameters supplied' ];
            echo json_encode($resp);
            error_log('Invalid parameters supplied.');
            http_response_code(403);
            return;
        }

        
        if(empty($id)){
            $sql = "INSERT INTO parties (partyname, partycode, logo) VALUES (?,?,?)";
            $stmtInsert = $db->prepare($sql);
            $result = $stmtInsert->execute([$partyName, $partyCode, $partyLogo]);
            if($result) {
                $resp = [ 'message' => 'Party created successfully.' ];
                echo json_encode($resp);
                http_response_code(201);
            } else {
                $resp = [ 'message' => 'Unable to create Party.' ];
                echo json_encode($resp);
                http_response_code(500);
            }
        }
        else {
            $query = "UPDATE parties set partyname = '$partyName',  partycode = '$partyCode',  
            logo = '$partyLogo' WHERE id = $id";

            error_log($query);
            $userResult = mysqli_query($connection, $query);
            
            $resp = [ 'message' => 'Party updated successfully.' ];
            echo json_encode($resp);
            error_log('Party updated successfully..');
            http_response_code(200);
            return;
        }

    }
?>