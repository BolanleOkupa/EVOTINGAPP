<?php
//session_start();
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script type="text/javascript" src="static/js/parties.js"></script>
    <title>Parties</title>
</head>

<body  style="height: auto; background-image: url(./images/background.jpeg); background-size: cover; background-position: center;" class="position-relative w-100">
<div align="center">
    <header>
        <?php include 'header.php';?>
    </header>
    <div class="container overflow-hidden">
        <h1>Create Parties</h1>
        <div style="width:50%; align-content: center">
            <form class="px-4 py-3" id="parties-form">
                <input id="partyid" type="hidden">
                <div class="form-group row">
                    <label for="party_name" class="col-sm-4 col-form-label">Party Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="party_name" placeholder="Enter Party Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="party_code" class="col-sm-4 col-form-label">Party Code</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="party_code" placeholder="Enter Party Code">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="party_logo" class="col-sm-4 col-form-label">Party Logo</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" id="party_logo">
                    </div>
                </div>
            </form>
            <button type="submit" id="submit-form" value="submit">Submit</button>
        </div>

        <div class="row">
            <h1>View Registered Parties</h1>
            <div class="col-sm-12">
                <table class="table table-striped" id="allRegdParties">
                    
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

            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
            <script src="https://cdnjs.com/libraries/popper.js"></script> -->
        </div>

</body>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const text = "Welcome admin. Create the accredited parties and see below to confirm that the parties have been successfully created";
            const speech = new SpeechSynthesisUtterance();
            speech.lang = "en-US";
            speech.text = text;
            window.speechSynthesis.speak(speech);
        });
    </script>