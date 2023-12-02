<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script type="text/javascript" src="static/js/resetpassword.js"></script>
    <title>Voting App- Reset password</title>
</head>

<body>
    <div align="center">
        <div class="container overflow-hidden">
            <div style="width:50%; align-content: center">
                <section id="contact-form">
                    <div id="container-password">
                        <form class="px-4 py-3" id="reset-password-form">
                            <input id="emailHidden" type="hidden">
                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">Enter new password</label>
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
                </section>
            </div>
        </div>
    </div>
</body>