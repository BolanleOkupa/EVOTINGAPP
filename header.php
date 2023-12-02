<?php
if (session_status() == PHP_SESSION_NONE) {
      session_start();
   }
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script type="text/javascript" src="static/js/header.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/style.css"/> -->
    <?php
    if (isset($_SESSION['userId'])) {
    ?>
        <script type="text/javascript" src="static/js/logout.js"></script>
    <?php
    }
    ?>

</head>

<body>
<div align="center">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">E-Voting App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item mr-2">
                        <a class="nav-link" href="explore.php">Categories</a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link" href="faq.php">Faqs</a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php
                        if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'ADMIN') {
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administrative functions
                        </a>
                        <div class="dropdown-divider"></div>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="users.php">Create Voter(s)</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="electiontype.php">Create Election Categories</a>
                                <a class="dropdown-item" href="parties.php">Create Parties</a>
                                <a class="dropdown-item" href="candidates.php">Create Candidate(s)</a>
                                <a class="dropdown-item" href="elections.php">Manage Election(s)</a>
                            </div>
                           <?php
                              }
                           ?>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Polls
                        </a>
                        <div id="polls-list" class="dropdown-menu" aria-labelledby="navbarDropdown">

                        </div>
                    </li>
                    <?php
                    if (isset($_SESSION['adminRole'])) {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminNavbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="users.php">Users</a>
                        </div>
                    </li>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['userId'])) {
                    ?>
                    <li class="nav-item mr-2">
                        <a class="nav-link">
                            <?php  echo('Welcome '. $_SESSION['firstname'])  ?>
                        </a>
                        <?php
                            if (isset($_SESSION['storyTellerRole'])) {
                        ?>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="#"><?php  echo('Logged in as '. $_SESSION['storyTellerRole'])  ?></a>
                                <a class="nav-link" href="stories.php?category=own-stories">View own stories</a>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                            if (isset($_SESSION['adminRole'])) {
                        ?>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="nav-link" href="#"><?php  echo('Logged in as '. $_SESSION['adminRole'])  ?></a>
                                </div>
                        <?php
                        }
                        ?>
                    </li>
                    <?php
                    }
                    ?>

                </ul>

                <?php
                if (isset($_SESSION['userId'])) {
                ?>
                <a class="btn btn-primary" id="logout">Logout</a>
                <?php
                }else{
                ?>
                <a class="btn btn-outline-danger my-2 my-sm-0 mr-3" href="signup.php">Register to Vote</a>
                <a class="btn btn-danger my-2 my-sm-0" href="login.php">Login</a>
                <?php
                }
                ?>
            </div>
        </nav>
    </header>
</div>
</body>