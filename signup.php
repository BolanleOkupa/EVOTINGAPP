<?php
//session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script type="text/javascript" src="static/js/signup.js"></script>
    <title>Voter - Registration</title>

    <!-- Link to your previously defined CSS file -->
    <link href="./styles.css" rel="stylesheet">
</head>

<body style="height: auto; background-image: url(./images/background.jpeg); background-size: cover; background-position: center;" class="position-relative w-100">
    <div align="center">
        <header>
            <?php include 'header.php'; ?>
        </header>
        <div class="container overflow-hidden">
            <h1>Create an Account</h1>
            <div class="login-container">
                <form class="px-4 py-3" id="signup-form">
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-form-label">Firstname</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="firstname" placeholder="Enter firstname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label">Lastname</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="lastname" placeholder="Enter lastname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateofbirth" class="col-sm-4 col-form-label">Date of birth</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="dateofbirth" aria-describedby="dateHelp" placeholder="Date of birth">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iddoc" class="col-sm-4 col-form-label">Upload ID Document</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="file" name="iddoc" id="iddoc"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-4 col-form-label">Gender</label>
                        <div class="col-sm-8">
                            <select name="gender" class="form-control" id="gender" class="input" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="repeatPassword" class="col-sm-4 col-form-label">Repeat Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="repeatPassword" aria-describedby="passwordHelp" placeholder="Re-enter password">
                        </div>
                    </div>
                </form>
                <button type="submit" id="submit-form">Submit</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>
