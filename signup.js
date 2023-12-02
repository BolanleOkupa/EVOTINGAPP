(() => {
    document.addEventListener("DOMContentLoaded", () => {
    let currentDate = new Date();

    var maxDate = moment(currentDate).add(-18, 'years').format('YYYY-MM-DD');
    $('#dateofbirth').attr('max', maxDate);

    var fileList;
     // Listen for the change event so we can capture the file
    document.getElementById('iddoc').addEventListener('change', (e) => {
    fileList = [];
        // Get a reference to the file
        for(var i = 0 ; i < e.target.files.length ; i++){
            //alert('here '+ i);
            const file = e.target.files[i];

            // Encode the file using the FileReader API
            const reader = new FileReader();
            reader.onloadend = () => {
                // Use a regex to remove data url part
                const base64String = reader.result
                    .replace('data:', '')
                    .replace(/^.+,/, '');

                console.log('file ' + base64String);
                fileList.push(base64String);
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('submit-form').addEventListener("click", () => {
        var form = document.getElementById('signup-form')
        var obj ={};
        obj['firstname'] = document.getElementById('firstname').value;
        obj['lastname'] = document.getElementById('lastname').value;
        obj['dateofbirth'] = document.getElementById('dateofbirth').value;
        obj['iddoc'] = fileList[0];
        obj['gender'] = document.getElementById('gender').value;
        obj['username'] = document.getElementById('username').value;
        obj['password'] = document.getElementById('password').value;
        obj['repeatPassword'] = document.getElementById('repeatPassword').value;

        var reqBody = JSON.stringify(obj);

        fetch('signupserver.php', {
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
                    if (response.status === 201) {
                        alert(data.message);
                        form.reset();
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