<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FAQ - eVoting</title>
    <link href="./style.css" rel="stylesheet">

       <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body  style="height: auto; background-image: url(./images/background.jpeg); background-size: cover; background-position: center;" class="position-relative w-100">
    <div align="center">
        <header>
            <?php include 'header.php'; ?>
        </header>
        <div class="container overflow-hidden">
            <h1>Frequently Asked Questions about eVoting</h1>
            <div class="faq-container">
                <div class="faq-item">
                    <h3 class="faq-question">What is eVoting? <span class="collapse-icon">&#9660;</span></h3>
                    <p class="faq-answer">eVoting, or electronic voting, refers to the process of casting votes using electronic means, typically through digital platforms or voting systems.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">Is eVoting secure? <span class="collapse-icon">&#9660;</span></h3>
                    <p class="faq-answer">eVoting systems are designed with security measures to ensure the integrity and confidentiality of votes. Robust encryption and authentication methods are used to secure the voting process.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">How can I trust the accuracy of eVoting? <span class="collapse-icon">&#9660;</span></h3>
                    <p class="faq-answer">eVoting systems undergo rigorous testing and audits to ensure accuracy. Transparency and auditing mechanisms are employed to verify the accuracy of results.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">Can eVoting be tampered with? <span class="collapse-icon">&#9660;</span></h3>
                    <p class="faq-answer">Properly implemented eVoting systems employ cryptographic techniques and secure protocols to prevent tampering or manipulation of votes.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">Is eVoting accessible to everyone? <span class="collapse-icon">&#9660;</span></h3>
                    <p class="faq-answer">eVoting systems aim to be accessible to all eligible voters, providing accommodations for individuals with disabilities and ensuring usability for a diverse range of users.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">How is voter privacy maintained in eVoting? <span class="collapse-icon">&#9660;</span></h3>
                    <p class="faq-answer">eVoting systems are designed to uphold voter privacy by employing encryption methods and anonymizing voter identities while recording votes.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and other scripts -->
    <!-- ... -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.faq-question').click(function () {
                $(this).next('.faq-answer').slideToggle(200);
                $(this).find('.collapse-icon').toggleClass('rotate');
            });
        });
    </script>
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
</body>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const text = "Welcome to E-Voting, Our platform offers a secure and convenient way to cast votes electronically. It ensures voter privacy, accuracy, and accessibility for all eligible voters. In order to support you, please see FAQs and corresponding responses ";
            const speech = new SpeechSynthesisUtterance();
            speech.lang = "en-US";
            speech.text = text;
            window.speechSynthesis.speak(speech);
        });
    </script>

</html>
