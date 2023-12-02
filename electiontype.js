(() => {
    document.addEventListener("DOMContentLoaded", () => {
        reloadTable();

        document.getElementById('submit-form').addEventListener("click", () => {
            var form = document.getElementById('electiontype-form')

            var reqBody = JSON.stringify(getFormContentAsObject('electiontype-form'));
            fetch('electiontypeserver.php?action=POST', {
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
                                location.href ='electiontype.php';
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
                                updateTable(data.results)
                            } else {
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
            var table = document.getElementById('allelectiontypes')
            var rows = "<thead><tr> <th scope=\"col\">SN</th><th scope=\"col\">Election Name</th><th scope=\"col\">Description</th><th scope=\"col\">Action</th></tr></thead>";
            let sn = 1;
            data.forEach(element => {
                rows += `<tr><th scope=\"row\">${sn}</th><td>${element.electionname}</td><td>${element.description}</td><td><a class=\"edit btn btn-success my-2 my-sm-0\" href=\"electiontype.php?param=${element.id}\">Edit</a></td></tr>`;
                sn++;
            });
            table.innerHTML = rows;
        }

        function populateFieldsInEdit() {
            var urlParams = new URLSearchParams(location.search);
            if (urlParams.has('param')) {
                document.getElementById('electiontypeid').value = urlParams.get('param');
                fetch('electiontypeserver.php?action=PREPAREFOREDIT&param=' + urlParams.get('param'), {
                    method: 'GET',
                })
                    .then(function (response) {
                        response.json()
                            .then(function (data) {
                                if (response.status === 200) {
                                    document.getElementById('electionName').value = data.obj.electionname;
                                    document.getElementById('description').value = data.obj.description;
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