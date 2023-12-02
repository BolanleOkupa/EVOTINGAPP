<!DOCTYPE html>

<?php include 'pollserver.php';?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Voting App- Poll Monitoring</title>
    <link rel="stylesheet" href="./styles.css"> <!-- Link to your custom CSS file -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body style="height: auto; background-image: url(./images/background.jpeg); background-size: cover; background-position: center;" class="position-relative w-100">
<div align="center">
    <header>
        <?php include 'header.php';?>
    </header>
    <button onclick="readAllText()">Listen To Election Result</button>
    <div class="container overflow-hidden">
    <form class="px-4 py-3" id="vote-form">
        <h1>Candidates for - <?php echo($election) ?></h1>

        <div class="chart-container" style="position: relative; height:300px; width:80vw;">
            <canvas id="electionResultsChart"></canvas>
        </div>

        <hr/><hr/>


                <?php
                if (isset($candidatesArray)) {
                ?>
                <div class="row">

                    <input id="electionid" type="hidden" value="<?php echo($selectedElection)?>">

                <?php
                    foreach($candidatesArray as $candidate) {
                    ?>
                        <div class="col-sm-4">
                            <div class="card">
                                <img class="card-img-top" src="data:image/png;base64, <?php echo($candidate->image)?> " alt="image"/>
                            </div>
                            <h5 class="card-title"><?php echo($candidate->partyname)?> (<?php echo($candidate->partycode)?>)  </h5>
                            <h3 class="card-title">Name - <?php echo($candidate->firstname) ?> <?php echo($candidate->lastname) ?></h3>
                            <h3 class="card-title">Total votes - <?php echo($candidate->votes) ?> </h3>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                <?php
                }
                ?>
    </form>
    </div>
    <script type="text/javascript" src="static/js/vote.js"></script>

    <script>
        // JavaScript to create the Chart
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('electionResultsChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_column($candidatesArray, 'firstname')); ?>,
                    datasets: [{
                        label: 'Total Votes',
                        data: <?php echo json_encode(array_column($candidatesArray, 'votes')); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)', 
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

            <script>
        function readAllText() {
            // Get all text content from the page
            const allText = document.body.innerText;

            // Create a SpeechSynthesisUtterance object
            const speech = new SpeechSynthesisUtterance();
            speech.lang = "en-US"; // Set language (you can change it based on your audience)

            // Set the text that will be spoken
            speech.text = allText;

            // Use the SpeechSynthesis API to speak the text
            window.speechSynthesis.speak(speech);
        }
    </script>

</div>
</body>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const text = "Welcome to E-Voting, Our platform offers a secure and convenient way to cast votes electronically. It ensures voter privacy, accuracy, and accessibility for all eligible voters.";
            const speech = new SpeechSynthesisUtterance();
            speech.lang = "en-US";
            speech.text = text;
            window.speechSynthesis.speak(speech);
        });
    </script>