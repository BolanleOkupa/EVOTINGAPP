(() => {
    document.addEventListener("DOMContentLoaded", () => {
        var urlParams = new URLSearchParams(location.search);
        if (urlParams.has('token') && urlParams.has('sender')) {
        fetch('resetpasswordserver.php?action=verifytoken&token=' + urlParams.get('token')+'&email='+ urlParams.get('sender'), {
            method: 'GET',
        })
            .then(function (response) {
                response.json()
                    .then(function (data) {
                        if (response.status === 200) {
                            //alert('email and token match');
                            document.getElementById('emailHidden').value = urlParams.get('sender');
                        } else {
                            alert(data.message);
                            location.href ='login.php';
                        }
                    }).catch(function (error) {
                        alert(error.message);
                    });
            })
            .catch(function (error) {
                alert(error.message);
            });
    }

    document.getElementById('submit-form').addEventListener("click", () => {
        var form = document.getElementById('reset-password-form')
        var obj ={};
        obj['action'] = 'resetpassword';
        obj['email'] = document.getElementById('emailHidden').value;
        obj['password'] = document.getElementById('password').value;
        obj['repeatPassword'] = document.getElementById('repeatPassword').value;

        var reqBody = JSON.stringify(obj);
        fetch('resetpasswordserver.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: reqBody,
        })
        .then(function (response) {
            response.json()
                .then(function (data) {
                    if (response.status === 200) {
                        alert(data.message);
                        location.href ='login.php';
                    }else{
                        alert(data.message);
                    }
                }).catch(function (error) {
                alert(error.message);
            });
        })
        .catch(function (error) {
        alert(error.message);
        });
        })
    });
})();