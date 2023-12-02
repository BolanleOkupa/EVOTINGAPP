<?php
session_start();
require_once('dbaccess.php')
?>
<?php

  $connection = mysqli_connect("localhost", "root", "", "votingapp");

    //$action =  $_GET["action"];
  if(isset($_GET["action"]) && $_GET["action"] == 'VOTE'){

    if($_SESSION['userRole'] == 'VOTER'){
        $candidateId =  $_GET["candidateId"];
        $electionId =  $_GET["electionId"];
        $voterId =  $_SESSION['userId'];

        $voteQuery = "SELECT id FROM polls WHERE electionid = $electionId and voterid = $voterId";

        $result = mysqli_query($connection, $voteQuery);
        $voteCount = mysqli_num_rows($result);

        if($voteCount > 0){
            $resp = [ 'message' => 'Multiple voting in the same election is not allowed.' ];
            echo json_encode($resp);
            http_response_code(500);
            return;
        }
        $sql = "INSERT INTO polls(candidateid, voterid, electionid) VALUES (?,?,?)";
        $stmtInsert = $db->prepare($sql);
        $result = $stmtInsert->execute([$candidateId, $voterId, $electionId]);
        if($result) {
            $resp = [ 'message' => 'Vote cast successfully.' ];
            echo json_encode($resp);
            http_response_code(201);
        } else {
            $resp = [ 'message' => 'Unable to save vote.' ];
            echo json_encode($resp);
            http_response_code(500);
        }
    }else{
            $resp = [ 'message' => 'This functionality is only available to registered voters.' ];
            echo json_encode($resp);
            http_response_code(500);
    }
  }

  else if(isset($_GET)){
    $selectedElection =  htmlspecialchars($_GET["param"]);

    // fetch active stories
    $candidatesExists = "SELECT u.id 'user_id', u.firstname, u.lastname,
                        p.id 'party_id', p.partycode, p.partyname,
                        e.id 'election_id', e.description 'election_desc',
                        c.id 'candidate_id', c.bio, c.image
                        FROM candidates c
                        INNER JOIN users u ON c.userid = u.id
                        INNER JOIN parties p ON c.party_id = p.id
                        INNER JOIN elections e ON c.election_id = e.id
                        where e.id = $selectedElection";

    $candidatesResult = mysqli_query($connection, $candidatesExists);
    $electionsCount = mysqli_num_rows($candidatesResult);
    $candidatesArray = [];

    if($electionsCount > 0){
        while($obj = $candidatesResult->fetch_object()){
            $candidatesArray[] = $obj;
            $election = $obj->election_desc;
        }
        http_response_code(200);
    }
    else {
        $resp = [ 'message' => 'No records found.' ];
        echo json_encode($resp);
        error_log('No records found.');
        http_response_code(403);
      }
  }
?>