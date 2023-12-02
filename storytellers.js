(() => {
    document.addEventListener("DOMContentLoaded", () => {
               fetch('storytellerserver.php', {
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
                      alert('3: '+error.message);
                  });
              })
              .catch(function (error) {
              alert(error.message);
              });

    function updateTable(data) {
        var table = document.getElementById('allStoryTellers')
        var rows = "<thead><tr> <th scope=\"col\">SN</th><th scope=\"col\">Firstname</th><th scope=\"col\">Lastname</th><th scope=\"col\">Email</th><th scope=\"col\">Status</th><th scope=\"col\">No of stories published</th></tr></thead>";
        let sn = 1;
        data.forEach(element => {
            rows += `<tr><th scope=\"row\">${sn}</th><td>${element.firstname}</td><td>${element.lastname}</td><td>${element.email}</td><td>${element.active_status}</td><td>${element.no_of_stories}</td></tr>`;
            sn++;
        });
        table.innerHTML = rows;
    }
    });
})();