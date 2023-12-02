<?php
session_start();
require_once('dbaccess.php')
?>
<?php
    $connection = mysqli_connect("localhost", "root", "", "votingapp");
    $action =  $_GET["action"];
    if($action == 'GET_ONGOING_ELECTIONS'){
        $electionTypeQuery = "SELECT id, electionname FROM electiontype";
        $electionTypeResult = mysqli_query($connection, $electionTypeQuery);
        $electionTypeCount = mysqli_num_rows($electionTypeResult);

        $electionTypesArray = [];
        if($electionTypeCount > 0){
        //add elections type to the list
            while($obj = $electionTypeResult->fetch_object()){
                $electionTypeObj = $obj;
                //fetch elections for the current election type
                $electionQuery = "SELECT id, description, electionstatus from elections where electionstatus in ('ONGOING', 'END') and  typeid = $electionTypeObj->id";

                $electionResult = mysqli_query($connection, $electionQuery);
                $electionsCount = mysqli_num_rows($electionResult);

                if($electionsCount > 0){
                    $electionsArray = [];
                    while($electionObj = $electionResult->fetch_object()){
                        //add the elections to its election type
                        $electionsArray[] = $electionObj;
                    }
                    $electionTypeObj->elections = $electionsArray;
                }
                $electionTypesArray[] = $electionTypeObj;
            }
            $resp = [ 'message' => 'Records found.' , 'results' => $electionTypesArray ];
            echo json_encode($resp);
            http_response_code(200);
        }
        else {
            $resp = [ 'message' => 'No records found.' ];
            echo json_encode($resp);
            http_response_code(200);
        }
    }
?>