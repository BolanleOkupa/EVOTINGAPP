<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script type="text/javascript" src="static/js/candidates.js"></script>
    <title>E-Voting</title>
</head>
<body>
<div align="center" style="height: auto; background-image: url(./images/background.jpeg); background-size: cover; background-position: center;" class="position-relative w-100"> 
    <header>
        <?php include 'header.php';?>
    </header>
    <div class="container overflow-hidden">
        <h1>Add Election Candidates</h1>
        <div style="width:50%; align-content: center">
            <form class="px-4 py-3" id="candidate-form">
            <input id="candidateId" type="hidden">
                <div class="form-group row">
                    <label for="candidate" class="col-sm-4 col-form-label">Candidate</label>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select id="candidate" class="text-dark form-control select2">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="party" class="col-sm-4 col-form-label">Party</label>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select id="party" class="text-dark form-control select2">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="election" class="col-sm-4 col-form-label">Election</label>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select id="election" class="text-dark form-control select2">

                            </select>
                        </div>
                    </div>
                </div>
				<div class="form-group row">
                    <label for="image" class="col-sm-4 col-form-label">Pictures</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" name="image" id="image"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bio" class="col-sm-4 col-form-label">Details</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="4" placeholder="Details" id="bio" required></textarea>
                    </div>
                </div>
            </form>
            <button type="submit" id="submit-form">Submit</button>
        </div>
        <div class="row">
            <h1>View Candidates</h1>
            <div class="col-sm-12">
                <table class="table table-striped" id="allCandidates">

                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script> -->

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const text = "Welcome admin, Please add the accredited candidates and select the election type they are contesting for. See below to confirm that their details are correctly entered.";
            const speech = new SpeechSynthesisUtterance();
            speech.lang = "en-US";
            speech.text = text;
            window.speechSynthesis.speak(speech);
        });
    </script>