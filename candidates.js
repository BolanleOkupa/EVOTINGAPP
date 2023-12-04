(() => {
    document.addEventListener("DOMContentLoaded", () => {
    getElections();
    getCandidates();
    getParties();
    reloadTable();

	var fileList;
     // Listen for the change event so I can capture the file
    document.getElementById('image').addEventListener('change', (e) => {
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
            var form = document.getElementById('candidate-form');
			var obj ={};
            obj['candidate'] = document.getElementById('candidate').value;
            obj['image'] = fileList[0];
            obj['party'] = document.getElementById('party').value;
            obj['election'] = document.getElementById('election').value;
            obj['bio'] = document.getElementById('bio').value;
            obj['candidateId'] = document.getElementById('candidateId').value;

            var reqBody = JSON.stringify(obj);
            fetch('candidateserver.php?action=POST', {
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
                            } else if(response.status === 200){
                                location.href ='candidates.php';
                            }
                            else {
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
            var obj = {};
            for (var i = 0; i < elements.length; i++) {
                var item = elements.item(i);
                obj[item.id] = item.value;
            }
            return obj;
        }

        function reloadTable() {
            fetch('candidateserver.php?action=GET', {
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
                            } else {
                                //alert(data.message);
                            }
                        }).catch(function (error) {
                            //alert('3: '+error.message);
                        });
                })
                .catch(function (error) {
                    alert(error.message);
                });
        }

        function getElections() {
            fetch('electionserver.php?action=GET', {
                method: 'GET',
            })
            .then(function (response) {
                response.json()
                    .then(function (data) {
                        if (response.status === 200) {
                            var select = document.getElementById('election');
                            var options = '<option value=\" \">Select Election</option>';
                            data.results.forEach(element => {
                                options += `<option value=\"${element.id}\"> ${element.election_type_desc} - ${element.election_desc}</option>`;
                            });
                            select.innerHTML = options;
                        }
                    }).catch(function (error) {
                        //alert('3: '+error.message);
                    });
            })
            .catch(function (error) {
                alert(error.message);
            });
        }

        function getCandidates() {
            fetch('userserver.php?action=GET', {
                method: 'GET',
            })
            .then(function (response) {
                response.json()
                    .then(function (data) {
                        if (response.status === 200) {
                            var select = document.getElementById('candidate');
                            var options = '<option value=\" \">Select Candidate</option>';
                            data.results.forEach(element => {
                                if(element.role == 'CANDIDATE'){
                                    options += `<option value=\"${element.id}\"> ${element.firstname} ${element.lastname}</option>`;
                                }
                            });
                            select.innerHTML = options;
                        }
                    }).catch(function (error) {
                        //alert('3: '+error.message);
                    });
            })
            .catch(function (error) {
                alert(error.message);
            });
        }

        function getParties() {
            fetch('partiesserver.php?action=GET', {
                method: 'GET',
            })
            .then(function (response) {
                response.json()
                    .then(function (data) {
                        if (response.status === 200) {
                            var select = document.getElementById('party');
                            var options = '<option value=\" \">Select Party</option>';
                            data.results.forEach(element => {
                                options += `<option value=\"${element.id}\"> ${element.partyname} (${element.partycode})</option>`;
                            });
                            select.innerHTML = options;
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
            var table = document.getElementById('allCandidates')
            var rows = "<thead><tr> <th scope=\"col\">SN</th><th scope=\"col\">Firstname</th><th scope=\"col\">Lastname</th><th scope=\"col\">Party</th><th scope=\"col\">Election</th><th scope=\"col\">Bio</th><th scope=\"col\">Image</th><th scope=\"col\">Action</th></tr></thead>";
            let sn = 1;
            data.forEach(element => {
                let logo = `<img src=\"data:image/png;base64, ${element.image}\" width="135" height="165" alt=\"image\"/>`;
                rows += `<tr><th scope=\"row\">${sn}</th><td>${element.firstname}</td><td>${element.lastname}</td><td>${element.partyname}(${element.partycode})</td><td>${element.election_desc}</td><td>${element.bio}</td><td>${logo}</td> <td><a class=\"edit btn btn-info my-2 my-sm-0\" href=\"candidates.php?param=${element.candidate_id}\">Edit</a></td></tr>`;
                sn++;
            });
            table.innerHTML = rows;
        }

        function populateFieldsInEdit() {
            var urlParams = new URLSearchParams(location.search);
            if (urlParams.has('param')) {
                document.getElementById('candidateId').value = urlParams.get('param');
                fetch('candidateserver.php?action=PREPAREFOREDIT&param=' + urlParams.get('param'), {
                    method: 'GET',
                })
                    .then(function (response) {
                        response.json()
                            .then(function (data) {
                                if (response.status === 200) {
                                    document.getElementById('candidate').value = data.obj.userid;
                                    document.getElementById('party').value = data.obj.party_id;
                                    document.getElementById('election').value = data.obj.election_id;
                                    document.getElementById('bio').value = data.obj.bio;
                                } else {
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
        populateFieldsInEdit();
    });
})();