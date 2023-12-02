<?php
session_start();
require_once('dbaccess.php')
?>
<?php
    $connection = mysqli_connect("localhost", "root", "", "votingapp");
    if(!isset($_SESSION['userRole'])){
        // Invalid user session
        error_log('<<<<<<<<<<<<<<Invalid user session in create/view election type>>>>>>>>>>>>>>>>.');
        http_response_code(403);
        return;
    }
    $action =  $_GET["action"];
    if($action == 'GET'){
        error_log('In get election types request ');
        $electionTypeExist = "SELECT id, electionname, description FROM electiontype";
        $result = mysqli_query($connection, $electionTypeExist);
        $electionTypeCount = mysqli_num_rows($result);

        if($electionTypeCount > 0){
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
        $selectedElectionType =  $_GET["param"];
        error_log('In PREPAREFOREDIT request '.$selectedElectionType);

        $electionTypeExist = "SELECT id, electionname, description FROM electiontype
        WHERE id = $selectedElectionType";
        $result = mysqli_query($connection, $electionTypeExist);
        $electionTypeCount = mysqli_num_rows($result);

        if($electionTypeCount > 0){
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
        $id = $data->electiontypeid;
        $electionName = $data->electionName;
        $description = $data->description;

        
        if(empty($electionName) || empty($description) ){
            $resp = [ 'message' => 'Invalid parameters supplied' ];
            echo json_encode($resp);
            error_log('Invalid parameters supplied.');
            http_response_code(403);
            return;
        }

        
        if(empty($id)){
            $sql = "INSERT INTO electiontype(electionname, description) VALUES (?,?)";
            $stmtInsert = $db->prepare($sql);
            $result = $stmtInsert->execute([$electionName, $description]);
            if($result) {
                $resp = [ 'message' => 'Election type creation was successful.' ];
                echo json_encode($resp);
                http_response_code(201);
            } else {
                $resp = [ 'message' => 'Unable to create Election type.' ];
                echo json_encode($resp);
                http_response_code(500);
            }
        }
        else {
            $query = "UPDATE electiontype set electionname = '$electionName',  description = '$description'
             WHERE id = $id";

            error_log($query);
            $userResult = mysqli_query($connection, $query);
            
            $resp = [ 'message' => 'Election type updated successfully' ];
            echo json_encode($resp);
            error_log('Election type updated successfully.');
            http_response_code(200);
            return;
        }

    }
?>