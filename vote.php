<!DOCTYPE html>

<?php include 'voteserver.php';?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Voting App- Vote</title>
</head>

<body style="height: auto; background-image: url(./images/background.jpeg); background-size: cover; background-position: center;" class="position-relative w-100">
<div align="center">
    <header>
        <?php include 'header.php';?>
    </header>
    <div class="container overflow-hidden">
    <form class="px-4 py-3" id="vote-form">
        <h1>Candidates for - <?php echo($election) ?></h1>
                <?php
                if (isset($candidatesArray)) {
                ?>
                <div class="row">

                    <input id="electionid" type="hidden" value="<?php echo($selectedElection)?>">

                <?php
                    foreach($candidatesArray as $candidate) {
                    ?>
                        <div class="col-sm-6">
                            <div class="card">
                                <img class="card-img-top" src="data:image/png;base64, <?php echo($candidate->image)?> " width="195" height="300" alt="image"/>
                            </div>
                            <h5 class="card-title"><?php echo($candidate->partyname)?> (<?php echo($candidate->partycode)?>)  </h5>
                            <h3 class="card-title">Name - <?php echo($candidate->firstname) ?> <?php echo($candidate->lastname) ?></h3>
                            <h3 class="card-title">Bio - <?php echo($candidate->bio) ?> </h3>
                            <?php
                                if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'VOTER') {
                            ?>
                            <a class="btn btn-primary my-2 my-sm-0 vote" candidateId="<?php echo($candidate->candidate_id) ?>">Vote</a>
                           <?php
                              }
                           ?>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</div>
</body>