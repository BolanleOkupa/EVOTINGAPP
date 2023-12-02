(() => {
    document.addEventListener("DOMContentLoaded", () => {
        fetch('headerserver.php?action=GET_ONGOING_ELECTIONS', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(function (response) {
            response.json()
                .then(function (data) {
                    if (response.status === 200) {
                        updatePollsList(data.results)
                    }
                }).catch(function (error) {
                    //alert('3: '+error.message);
                });
        })
      .catch(function (error) {
      alert(error.message);
      });

      function updatePollsList(data) {

          var pollsList = document.getElementById('polls-list')
          var electionFound = false;
          if(data === undefined || data.length == 0){
            pollsList.innerHTML = "<a class=\"dropdown-item\" href=\"#\">No Ongoing Polls</a>";
            return;
          }

          var items = "";
          data.forEach(element => {
              var elections = element.elections;
              if(elections){
                items += `<span class=\"dropdown-item\"><b>${element.electionname}</b></span>`;
                elections.forEach(election => {
                    var path = "vote.php?param="+election.id;
                    if(election.electionstatus = 'ONGOING'){
                        items += `<span class=\"dropdown-item\"><a title=\"click to vote\" href=\"${path}\">${election.description}</a> | <a title=\"click to view polls\" href=\"poll.php?param=${election.id}\"><b>see results</b></a></span>`;
                    }else{
                        items += `<span class=\"dropdown-item\"><a title=\"click to view polls\" href=\"poll.php?param=${election.id}\"><b>see results</b></a></span>`;
                    }
                    electionFound = true;
                  });
                items += `<div class=\"dropdown-divider\"></div>`;
              }
          });
          if(electionFound == true){
                pollsList.innerHTML = items;
          }else{
            pollsList.innerHTML = "<a class=\"dropdown-item\" href=\"#\">No Ongoing Polls</a>";
          }
      }
    });
})();