<?php

// start session
session_start();

require_once("db/createDB.php");

// create instance of createDB class 
$database = new CreateDB("votingapp", "users", "parties", "electiontype", "elections", "candidates", "polls");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Voting App</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon-->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="./css/style.css" rel="stylesheet"> -->
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <main>
        <div style="height: 100vh; background-image: url(./images/banner.jpeg); background-size: cover; background-position: center;"
            class="position-relative w-100">
            <div class="position-absolute text-white d-flex flex-column align-items-center justify-content-center"
                style="top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0,0,0,.6);">
                <h1 class="mb-4 mt-2 font-weight-bold text-center">Your Voice Matters: Vote Online Now!</h1>
                <span>Safe, Convenient, and Accessible Voting for All</span>
                <br/>

                <div class="text-center">
                <a href="signup.php" id="filled" class="btn btn-primary px-4 py-2 mt-3 mt-sm-0 mx-1"
    style="border-radius: 20px; background-color: red; color: white; text-decoration: none; display: inline-block;">
    Get Started
</a>

                </div>
            </div>
        </div>

       
    </main>
    <?php // include 'footer.php'; ?>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script> -->

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const text = "Welcome to E-Voting, Our platform offers a secure and convenient way to cast votes electronically. It ensures voter privacy, accuracy, and accessibility for all eligible voters.";
            const speech = new SpeechSynthesisUtterance();
            speech.lang = "en-US";
            speech.text = text;
            window.speechSynthesis.speak(speech);
        });
    </script>


</html>