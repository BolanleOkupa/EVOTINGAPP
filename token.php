<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script type="text/javascript" src="static/js/token.js"></script>
    <title>Voting App- OTP</title>
</head>

<body>
    <div align="center">
        <div class="container overflow-hidden">
            <div style="width:50%; align-content: center">
                <section id="contact-form">
                    <div id="container-token" class="container-token">
                        <form id="tokenForm" action="" method="post">
                            <h3>Token</h3>
                            <fieldset>
                                <input name="otp" placeholder="OTP" id="otp" type="password" tabindex="1" required>
                            </fieldset>
                            <fieldset>
                                <button name="button" id="token-submit"
                                    data-submit="...Sending">Submit</button>
                            </fieldset>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const text = "Welcome to E-Voting, Our platform offers a secure and convenient way to cast votes electronically. It ensures voter privacy, accuracy, and accessibility for all eligible voters. Enter your One time password to proceed";
            const speech = new SpeechSynthesisUtterance();
            speech.lang = "en-US";
            speech.text = text;
            window.speechSynthesis.speak(speech);
        });
    </script>