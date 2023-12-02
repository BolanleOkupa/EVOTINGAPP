(() => {
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById('login-submit').addEventListener("click", () => {
            var form = document.getElementById('loginUser');

            var reqBody = JSON.stringify(getFormContentAsObject('loginUser'));
            fetch('loginserver.php', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: reqBody,
            })
            .then(function (response) {
                if (response.status === 200) {
                location.href ='token.php';
                }else if (response.status === 403) {
                    alert('Invalid login credentials');
                }
              })
            .catch(function (error) {
            alert(error.message);
            });
          })

        function getFormContentAsObject(formName) {
            var elements = document.getElementById(formName).elements;
            var obj ={};
            for(var i = 0 ; i < elements.length ; i++){
                var item = elements.item(i);
                obj[item.id] = item.value;
            }
            return obj;
        }

    });
})();