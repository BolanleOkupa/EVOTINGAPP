(() => {
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById('logout').addEventListener("click", () => {
            fetch('logoutserver.php', {
                method: 'GET',
            })
            .then(function (response) {
                  response.json()
                      .then(function (data) {
                          if (response.status === 200) {
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