<?php
session_start();
require_once('dbaccess.php')
?>
<?php
    $connection = mysqli_connect("localhost", "root", "", "votingapp");
    if(!isset($_SESSION['userRole'])){
        // Invalid user session
        error_log('<<<<<<<<<<<<<<Invalid user session in create/view election outcome>>>>>>>>>>>>>>>>.');
        http_response_code(403);
        return;
    }
    $action =  $_GET["action"];
    if($action == 'GET'){
        error_log('In get election request ');
        $electionExist = "SELECT e.id, e.typeid, et.description 'election_type_desc',  e.electiondate, e.description 'election_desc', e.electionstatus 'election_status'
        FROM elections e INNER JOIN electiontype et ON e.typeid = et.id; ";
        $result = mysqli_query($connection, $electionExist);
        $electionCount = mysqli_num_rows($result);

        if($electionCount > 0){
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
        $selectedElectionRes =  $_GET["param"];
        error_log('In PREPAREFOREDIT request '.$selectedElectionRes);

        $electionExist = "SELECT id, typeid, electiondate, description, electionstatus FROM elections WHERE id = $selectedElectionRes";
        $result = mysqli_query($connection, $electionExist);
        $electionCount = mysqli_num_rows($result);

        if($electionCount > 0){
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
         error_log('Post elections Request: '.$json);
         if(is_null($json)){
             return;
         }
        $data = json_decode($json);
        $id = $data->electionid;
        $typeid = $data->election_type;
        $electionDate = $data->electiondate;
        $electionDesc = $data->electiondesc;

        
        if(empty($typeid) || empty($electionDate) || empty($electionDesc) ){
            $resp = [ 'message' => 'Invalid parameters supplied' ];
            echo json_encode($resp);
            error_log('Invalid parameters supplied.');
            http_response_code(403);
            return;
        }

        if(empty($id)){
            $sql = "INSERT INTO elections(typeid, electiondate, description, electionstatus) VALUES (?,?,?,?)";
            $stmtInsert = $db->prepare($sql);
            $result = $stmtInsert->execute([$typeid, $electionDate, $electionDesc, 'SCHEDULED']);
            if($result) {
                $resp = [ 'message' => 'Election saved successfully.' ];
                echo json_encode($resp);
                http_response_code(201);
            } else {
                $resp = [ 'message' => 'Unable to save Election.' ];
                echo json_encode($resp);
                http_response_code(500);
            }
        }
        else {
            $query = "UPDATE elections set typeid = '$typeid', electiondate = '$electionDate',  description = '$electionDesc' WHERE id = $id";

            error_log($query);
            $userResult = mysqli_query($connection, $query);
            
            $resp = [ 'message' => 'Election saved successfully' ];
            echo json_encode($resp);
            error_log('Election saved successfully.');
            http_response_code(200);
            return;
        }

    }
    else if($action == 'START' || $action == 'END'){
        $selectedElection =  $_GET["param"];
        $electionStatus = $action == 'START' ? 'ONGOING' : 'END';
        error_log('In Start/ End request '.$selectedElection);
        //check if there are candidates for this election
        $candidatesQuery = "SELECT id FROM candidates WHERE election_id = $selectedElection";
        $result = mysqli_query($connection, $candidatesQuery);
        $candidatesCount = mysqli_num_rows($result);
        if($candidatesCount > 0){
            // start/end election
            $query = "UPDATE elections set electionstatus = '$electionStatus' where id = $selectedElection";
            $userResult = mysqli_query($connection, $query);

            $resp = [ 'message' => 'Election was started successfully' ];
            echo json_encode($resp);
            error_log('User was started successfully.');
            http_response_code(200);
            return;
        }else{
            $resp = [ 'message' => 'There are no candidates mapped to this election.' ];
            echo json_encode($resp);
            http_response_code(500);
            return;
        }
    }
?>