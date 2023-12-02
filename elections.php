<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Voting App- Elections Page</title>
     <script type="text/javascript" src="static/js/elections.js"></script>
</head>
<body  style="height: auto; background-image: url(./images/background.jpeg); background-size: cover; background-position: center;" class="position-relative w-100">
<div align="center">
    <header>
        <?php include 'header.php';?>
    </header>
    <div class="container overflow-hidden">
        <h1>Schedule Elections</h1>
        <div style="width:50%; align-content: center">
            <form class="px-4 py-3" id="election-form">
            <input id="electionid" type="hidden">

                <div class="form-group row">
                    <label for="election_type" class="col-sm-4 col-form-label">Election Type</label>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select id="election_type" class="text-dark form-control select2">
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="electiondate" class="col-sm-4 col-form-label">Election Date</label>
                    <div class="col-sm-8">
                        <input type="datetime-local" class="form-control" id="electiondate" aria-describedby="dateHelp" placeholder="Pick Election Date">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="electiondesc" class="col-sm-4 col-form-label">Election Description</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="electiondesc" placeholder="Description">
                    </div>
                </div>
            </form>
            <button type="submit" id="submit-form">Submit</button>
        </div>

        <div class="row">
            <h1>View Elections</h1>
            <div class="col-sm-12">
                <table class="table table-striped" id="allElections">

                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</div>
</body>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const text = "Welcome admin. Please proceed to schedule an election by entering the type, date and description. Select start to commence the election and select end when the process has been completed.";
            const speech = new SpeechSynthesisUtterance();
            speech.lang = "en-US";
            speech.text = text;
            window.speechSynthesis.speak(speech);
        });
    </script>