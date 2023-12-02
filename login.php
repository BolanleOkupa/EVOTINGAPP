<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./styles.css"> <!-- Link to my custom CSS file -->
    <script type="text/javascript" src="static/js/login.js"></script>
    <title>Voting App - Login</title>
</head>

<body  style="height: auto; background-image: url(./images/background.jpeg); background-size: cover; background-position: center;" class="position-relative w-100">

    <div class="container">
        <header>
            <?php include 'header.php'; ?>
        </header>
        <div class="login-container">
            <section id="contact-form">
                <div class="contact-box">
                    <div class="container-contact">
                        <form id="loginUser" action="" method="post">
                            <h3>Login</h3>
                            <div class="form-group">
                                <input name="email" placeholder="Email" id="email" type="email" tabindex="2" required
                                    value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                            </div>
                            <div class="form-group">
                                <input name="password" placeholder="Password" id="password" type="password" tabindex="3"
                                    required>
                            </div>
                            <div class="form-group">
                                <button name="submit" type="submit" id="login-submit" data-submit="...Sending">Login</button>
                            </div>
                            <div class="additional-links">
                                <a href="forgotpassword.php">Forgot Password?</a>
                            </div>
                            <div class="additional-links">
                                Yet to Register? <a href="signup.php">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php //include 'footer.php'; ?>
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
