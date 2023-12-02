(() => {
    document.addEventListener("DOMContentLoaded", () => {
        reloadTable();
        getElectionTypes();

        document.getElementById('submit-form').addEventListener("click", () => {
            var form = document.getElementById('election-form')

            var reqBody = JSON.stringify(getFormContentAsObject('election-form'));
            fetch('electionserver.php?action=POST', {
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
                                location.href ='elections.php';
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
            fetch('electionserver.php?action=GET', {
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

        function getElectionTypes() {
            fetch('electiontypeserver.php?action=GET', {
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
                                var select = document.getElementById('election_type');
                                var options = '<option value=\" \">Select Election Type</option>';
                                data.results.forEach(element => {
                                    options += `<option value=\"${element.id}\"> ${element.electionname}</option>`;
                                    
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
            var table = document.getElementById('allElections')
            var rows = "<thead><tr> <th scope=\"col\">SN</th><th scope=\"col\">Election Type</th><th scope=\"col\">Election Date</th><th scope=\"col\">Election Description</th><th scope=\"col\">Election Status</th><th scope=\"col\">Action</th></tr></thead>";
            let sn = 1;
            data.forEach(element => {
                if(element.election_status == 'SCHEDULED'){
                    rows += `<tr><th scope=\"row\">${sn}</th><td>${element.election_type_desc}</td><td>${element.electiondate}</td><td>${element.election_desc}</td><td>${element.election_status}</td> <td><a class=\"edit btn btn-info my-2 my-sm-0\" href=\"elections.php?param=${element.id}\">Edit</a> <a electionId=\"${element.id}\" class=\"inactive btn btn-warning my-2 my-sm-0\" href=\"#\">Start</a></td></tr>`;
                }
                else if(element.election_status == 'ONGOING'){
                     rows += `<tr><th scope=\"row\">${sn}</th><td>${element.election_type_desc}</td><td>${element.electiondate}</td><td>${element.election_desc}</td><td>${element.election_status}</td> <td><a electionId=\"${element.id}\" class=\"active btn btn-danger my-2 my-sm-0\" href=\"#\">End</a></td></tr>`;
                }else{
                    rows += `<tr><th scope=\"row\">${sn}</th><td>${element.election_type_desc}</td><td>${element.electiondate}</td><td>${element.election_desc}</td><td>${element.election_status}</td><td>N/A</td></tr>`;
                }
                sn++;
            });
            table.innerHTML = rows;

            const inActiveItems = document.querySelectorAll('.inactive');
            inActiveItems.forEach(item => {
              item.addEventListener('click', function handleClick(event) {
                var electionId = this.getAttribute('electionId');
                updateElection(electionId, 'START');
              });
            });

            const activeItems = document.querySelectorAll('.active');
            activeItems.forEach(item => {
              item.addEventListener('click', function handleClick(event) {
                var electionId = this.getAttribute('electionId');
                updateElection(electionId, 'END');
              });
            });
        }

        function updateElection(electionId, status){
            if(confirm('Are you sure you want to '+status+' this election? This decision cannot be undone')){
                fetch('electionserver.php?action='+status+'&param='+electionId, {
                    method: 'GET',
                })
                .then(function (response) {
                    response.json()
                        .then(function (data) {
                            if (response.status === 200) {
                                alert(data.message);
                                location.href ='elections.php';
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

        function populateFieldsInEdit() {
            var urlParams = new URLSearchParams(location.search);
            if (urlParams.has('param')) {
                document.getElementById('electionid').value = urlParams.get('param');
                fetch('electionserver.php?action=PREPAREFOREDIT&param=' + urlParams.get('param'), {
                    method: 'GET',
                })
                    .then(function (response) {
                        response.json()
                            .then(function (data) {
                                if (response.status === 200) {
                                    document.getElementById('election_type').value = data.obj.typeid;
                                    document.getElementById('electiondate').value = data.obj.electiondate;
                                    document.getElementById('electiondesc').value = data.obj.description;
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