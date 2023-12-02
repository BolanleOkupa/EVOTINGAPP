(() => {
    document.addEventListener("DOMContentLoaded", () => {
    const voteCandidates = document.querySelectorAll('.vote');
    voteCandidates.forEach(item => {
      item.addEventListener('click', function handleClick(event) {
        var candidateId = this.getAttribute('candidateId');
        var electionId = document.getElementById('electionid').value;

            if(confirm('Are you sure you want to vote for this candidate?')){
                fetch('voteserver.php?action=VOTE&candidateId='+candidateId + '&electionId=' + electionId, {
                    method: 'GET',
                })
                .then(function (response) {
                    response.json()
                        .then(function (data) {
                            if (response.status === 200) {
                                alert(data.message);
                                location.href ='vote?param='+electionId;
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
      });
    });

    });
})();