<?php
include ('dbaccess.php');
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Election Types</title>
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
    <link href="./css/style.css" rel="stylesheet">

    <?php
    if (isset($_SESSION['userId'])) {
    ?>
        <script type="text/javascript" src="static/js/logout.js"></script>
    <?php
    }
    ?>
</head>

<body style="height: auto; background-image: url(./images/background.jpeg); background-size: cover; background-position: center;" class="position-relative w-100">
    <header>
        <?php include 'header.php'; ?>
    </header>
    <div class="jumbotron jumbotron-fluid bg-success">
        <div class="container text-center">
            <h1 class="display-3 text-white font-weight-bold">Election Categories</h1>
        </div>
    </div>
    <main>
        <div class="bg-gray cities">
            <div class="container">
                <div class="row">
                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "votingapp");
                    $query = "SELECT * from elections order by id desc";
                    $result = mysqli_query($connection, $query);
                    
                    // Check if the query was successful
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    
                        <a href="vote.php?param=<?= $row['id'];?>">
                            <div class="card">
                                <img src="./images/vote.avif" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['description'];?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                        }
                    }
                    ?>
                   


         

                </div>
            </div>
        </div>
    </main>
    <br/><br/>

    <?php include 'footer.php';?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>


</html>