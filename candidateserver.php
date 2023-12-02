<?php
session_start();
require_once('dbaccess.php')
?>
<?php

$connection = mysqli_connect("localhost", "root", "", "votingapp");

     if(!isset($_SESSION['userRole'])){
        // Invalid user session
        error_log('<<<<<<<<<<<<<<Invalid user session in create candidate>>>>>>>>>>>>>>>>.');
        http_response_code(403);
        return;
     }
     $action =  $_GET["action"];
     if($action == 'GET'){
         error_log('In get candidates request');
         $candidateExist = "SELECT u.id 'user_id', u.firstname, u.lastname,
         p.id 'party_id', p.partycode, p.partyname,
         e.id 'election_id', e.description 'election_desc',
         c.id 'candidate_id', c.bio, c.image
         FROM candidates c
         INNER JOIN users u ON c.userid = u.id
         INNER JOIN parties p ON c.party_id = p.id
         INNER JOIN elections e ON c.election_id = e.id;";
         $result = mysqli_query($connection, $candidateExist);
         $candidateCount = mysqli_num_rows($result);

         if($candidateCount > 0){
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
         $selectedCandidate =  $_GET["param"];
         error_log('In PREPAREFOREDIT request '.$selectedCandidate);

         $candidateExist = "SELECT * FROM candidates WHERE id = $selectedCandidate";
         $result = mysqli_query($connection, $candidateExist);
         $candidateCount = mysqli_num_rows($result);

         if($candidateCount > 0){
             $resultArray = [];
             while($res = $result->fetch_object()){
                 $obj = $res;
             }
             $resp = [ 'obj'=>$obj ];
             echo json_encode($resp);
             error_log('<<<<<<<<<< Data found in prepare for edit candidate: '.json_encode($resp));
             http_response_code(200);
         }
         return;
     }
     else if($action == 'POST'){

        $json = file_get_contents('php://input');
        error_log('<<<<<<<<<<<<<<Add candidate request: '.$json);
        $data = json_decode($json);
        $candidate = $data->candidate;
        $party = $data->party;
        $image = $data->image;
        $election = $data->election;
        $bio = $data->bio;

        //updating
        $candidateId = $data->candidateId;

        if(empty($candidate) || empty($election) || empty($bio) || empty($party)){
            error_log('Invalid parameters supplied.');
            http_response_code(400);
            $resp = [ 'message' => 'Invalid parameters supplied' ];
            echo json_encode($resp);
            return;
        }
        if(empty($candidateId)){
            error_log('Inserting>>>>>>>>>');
            $sql = "INSERT INTO candidates(userid, image, bio, election_id, party_id) VALUES (?,?,?,?,?)";
            $stmtInsert = $db->prepare($sql);
            $result = $stmtInsert->execute([$candidate, $image, $bio, $election, $party]);
        }else{
            error_log('Updating>>>>>>>>>');
            $sql = "UPDATE candidates set userid = '$candidate', image = '$image', bio = '$bio', election_id = '$election', party_id = '$party' where id = '$candidateId'";
            $stmtUpdate = $db->prepare($sql);
            $result = $stmtUpdate->execute();
        }

        if($result) {
            $resp = [ 'message' => 'Candidate saved successfully.' ];
            echo json_encode($resp);
            http_response_code(201);
        } else {
            $resp = [ 'message' => 'Unable to create candidate.' ];
            echo json_encode($resp);
            http_response_code(500);
        }

    }
    else {
        echo 'Empty Inputs';
    }
?>