<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <script type="text/javascript" src="static/js/users.js"></script>
    <title>Voting App- Users</title>
    <link rel="stylesheet" href="./styles.css"> <!-- Link to my custom CSS file -->

</head>

<body>
<div align="center">
    <header>
        <?php include 'header.php';?>
    </header>
    <div class="container overflow-hidden">
        <h1>Users</h1>
        <div style="width:50%; align-content: center">
        <?php
            if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'ADMIN') {
        ?>
                <form class="px-4 py-3" id="addUser">
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
                        <label for="gender" class="col-sm-4 col-form-label">Gender</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <select id="gender" class="text-dark form-control select2">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>  
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
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

                    <div class="form-group row">
                        <label for="roleId" class="col-sm-4 col-form-label">Role</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <select id="role" class="text-dark form-control select2">
                                    <option value="">Select role</option>
                                    <option value="ADMIN">Admin</option>
                                    <option value="CANDIDATE">Candidate</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="userStatus" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <select id="status" class="text-dark form-control select2">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <button type="submit" id="submit-form">Submit</button>
        <?php
        }
        ?>

        </div>
        <br/>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped" id="allUsers">
                    
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
            const text = "Welcome Admin. Please activate the voter if and only if they meet the requirements to participate in the election otherwise reject.";
            const speech = new SpeechSynthesisUtterance();
            speech.lang = "en-US";
            speech.text = text;
            window.speechSynthesis.speak(speech);
        });
    </script>