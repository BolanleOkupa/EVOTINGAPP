<?php
session_start();
require_once('dbaccess.php');

$connection = mysqli_connect("localhost", "root", "", "votingapp");

if (isset($_GET['param'])) {
    $selectedElection =  htmlspecialchars($_GET["param"]);

    $candidatesExists = "SELECT u.id 'user_id', u.firstname, u.lastname,
        p.id 'party_id', p.partycode, p.partyname,
        e.id 'election_id', e.description 'election_desc',
        c.id 'candidate_id', c.bio, c.image,
        COUNT(po.id) AS votes_count
        FROM candidates c
        INNER JOIN users u ON c.userid = u.id
        INNER JOIN parties p ON c.party_id = p.id
        INNER JOIN elections e ON c.election_id = e.id
        LEFT JOIN polls po ON po.candidateid = c.id
        WHERE e.id = $selectedElection
        GROUP BY c.id"; // Grouping by candidate ID

    $candidatesResult = mysqli_query($connection, $candidatesExists);
    $electionsCount = mysqli_num_rows($candidatesResult);
    $candidatesArray = [];

    if ($electionsCount > 0) {
        while ($obj = $candidatesResult->fetch_object()) {
            $obj->votes = $obj->votes_count; // Assign votes count directly from the query
            unset($obj->votes_count); // Remove temporary votes count field
            $candidatesArray[] = $obj;
            $election = $obj->election_desc;
        }
        http_response_code(200);
    } else {
        $resp = ['message' => 'No records found.'];
        echo json_encode($resp);
        error_log('No records found.');
        http_response_code(403);
    }
}
?>
