(() => {
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById('email-submit').addEventListener("click", () => {
           fetch('forgotpasswordserver.php?email='+document.getElementById('email').value , {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            }).then(function (response) {

            if (response.status === 500) {
                alert('Invalid email provided');
            }
            else if (response.status === 200) {
                alert('password reset email has been sent')
                location.href ='index.php';
            }
//              response.json()
//                  .then(function (data) {
//                      if (response.status === 200) {
//                        location.href ='index.php';
//                      }else{
//                          alert(data.message);
//                          location.href ='login.php';
//                      }
//                  }).catch(function (error) {
//                  alert(error.message);
//              });
          })
          .catch(function (error) {
          alert('password reset email has been sent')
          location.href ='index.php';
          });
        })
    });
})();