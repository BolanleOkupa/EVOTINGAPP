(() => {
    document.addEventListener("DOMContentLoaded", () => {
    reloadTable();

    document.getElementById('submit-form').addEventListener("click", () => {
        var form = document.getElementById('addUser')

        var reqBody = JSON.stringify(getFormContentAsObject('addUser'));
        fetch('userserver.php?action=POST', {
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
                        reloadTable();
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

    function reloadTable(){
        fetch('userserver.php?action=GET', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(function (response) {
              response.json()
                  .then(function (data) {
                      if (response.status === 200) {
                      updateTable(data.results)
                      }else{
                          alert(data.message);
                      }
                  }).catch(function (error) {
                  //alert('3: '+error.message);
              });
          })
          .catch(function (error) {
          alert(error.message);
          });
    }

    function updateTable(data) {
        var table = document.getElementById('allUsers')
        var rows = "<thead><tr> <th scope=\"col\">SN</th><th scope=\"col\">Firstname</th><th scope=\"col\">Lastname</th><th scope=\"col\">DOB</th><th scope=\"col\">ID Doc</th><th scope=\"col\">Gender</th><th scope=\"col\">Email</th><th scope=\"col\">Status</th><th scope=\"col\">Role</th><th scope=\"col\">Action</th></tr></thead>";
        let sn = 1;
        data.forEach(element => {
            if(element.role == 'ADMIN'){
                rows += `<tr><th scope=\"row\">${sn}</th><td>${element.firstname}</td><td>${element.lastname}</td><td>N/A</td><td>N/A</td><td>${element.gender}</td><td>${element.email}</td><td>${element.status}</td><td>${element.role}</td><td>N/A</td></tr>`;
            }
            else if(element.status == 'PENDING' && element.role == 'VOTER'){
                let idDoc = `<img src=\"data:image/png;base64, ${element.iddoc}\" width="135" height="165" alt=\"id doc\"/>`;
                rows += `<tr><th scope=\"row\">${sn}</th><td>${element.firstname}</td><td>${element.lastname}</td><td>${element.dob}</td><td>${idDoc}</td><td>${element.gender}</td><td>${element.email}</td><td>${element.status}</td><td>${element.role}</td> <td><a email=\"${element.email}\" userId=\"${element.id}\" action=\"APPROVE\" class=\"pending btn btn-success my-2 my-sm-0\" href=\"#\">Approve</a><a email=\"${element.email}\" userId=\"${element.id}\" action=\"REJECT\" class=\"pending btn btn-danger my-2 my-sm-0\" href=\"#\">Reject</a></td></tr>`;
            }else if(element.status == 'INACTIVE' && element.role == 'VOTER'){
                let idDoc = `<img src=\"data:image/png;base64, ${element.iddoc}\" width="135" height="165" alt=\"id doc\"/>`;
                rows += `<tr><th scope=\"row\">${sn}</th><td>${element.firstname}</td><td>${element.lastname}</td><td>${element.dob}</td><td>${idDoc}</td><td>${element.gender}</td><td>${element.email}</td><td>${element.status}</td><td>${element.role}</td> <td><a userId=\"${element.id}\" class=\"inactive btn btn-success my-2 my-sm-0\" href=\"#\">Activate</a></td></tr>`;
            }else if(element.status == 'INACTIVE'){
                 rows += `<tr><th scope=\"row\">${sn}</th><td>${element.firstname}</td><td>${element.lastname}</td><td>N/A</td><td>N/A</td><td>${element.gender}</td><td>${element.email}</td><td>${element.status}</td><td>${element.role}</td> <td><a userId=\"${element.id}\" class=\"inactive btn btn-success my-2 my-sm-0\" href=\"#\">Activate</a></td></tr>`;
            }else{
                rows += `<tr><th scope=\"row\">${sn}</th><td>${element.firstname}</td><td>${element.lastname}</td><td>N/A</td><td>N/A</td><td>${element.gender}</td><td>${element.email}</td><td>${element.status}</td><td>${element.role}</td><td><a userId=\"${element.id}\" class=\"active btn btn-danger my-2 my-sm-0\" href=\"#\">Deactivate</a></td></tr>`;
            }
            sn++;
        });
        table.innerHTML = rows;

        const inActiveItems = document.querySelectorAll('.inactive');
        inActiveItems.forEach(item => {
          item.addEventListener('click', function handleClick(event) {
            var userId = this.getAttribute('userId');
            updateUser(userId, 'ACTIVATE', '');
          });
        });

        const activeItems = document.querySelectorAll('.active');
        activeItems.forEach(item => {
          item.addEventListener('click', function handleClick(event) {
            var userId = this.getAttribute('userId');
            updateUser(userId, 'DEACTIVATE', '');
          });
        });

        const pendingItems = document.querySelectorAll('.pending');
        pendingItems.forEach(item => {
          item.addEventListener('click', function handleClick(event) {
            var userId = this.getAttribute('userId');
            var emailId = this.getAttribute('email');
            var action = this.getAttribute('action');
            updateUser(userId, action, emailId);
          });
        });
    }

    function updateUser(userId, status, emailId){
        if(confirm('Are you sure you want to '+status+' this user?')){
            fetch('userserver.php?action='+status+'&param='+userId+'&emailId='+emailId, {
                method: 'GET',
            })
            .then(function (response) {
                response.json()
                    .then(function (data) {
                        if (response.status === 200) {
                            alert(data.message);
                            reloadTable();
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
        }
    }

    });
})();