(() => {
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById('token-submit').addEventListener("click", () => {
           fetch('tokenserver.php?otp='+document.getElementById('otp').value , {
                method: 'GET',
            })
            .then(function (response) {
              response.json()
                  .then(function (data) {
                      if (response.status === 200) {
                        location.href ='index.php';
                      }else{
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
        })
    });
})();