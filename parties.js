(() => {
    document.addEventListener("DOMContentLoaded", () => {
        reloadTable();

        var fileList;
         // Listen for the change event so I can capture the file
        document.getElementById('party_logo').addEventListener('change', (e) => {
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
            var form = document.getElementById('parties-form')

            var obj ={};
            obj['partyid'] = document.getElementById('partyid').value;;
            obj['party_name'] = document.getElementById('party_name').value;;
            obj['party_logo'] = fileList[0];
            obj['party_code'] = document.getElementById('party_code').value;

            var reqBody = JSON.stringify(obj);
            fetch('partiesserver.php?action=POST', {
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
                                location.href ='parties.php';
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
            fetch('partiesserver.php?action=GET', {
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
            var table = document.getElementById('allRegdParties')
            var rows = "<thead><tr> <th scope=\"col\">SN</th><th scope=\"col\">Party Name</th><th scope=\"col\">Party Code</th><th scope=\"col\">Party Logo</th><th scope=\"col\">Action</th></tr></thead>";
            let sn = 1;
            data.forEach(element => {
                let logo = `<img src=\"data:image/png;base64, ${element.logo}\" width="235" height="265" alt=\"image\"/>`;
                rows += `<tr><th scope=\"row\">${sn}</th><td>${element.partyname}</td><td>${element.partycode}</td><td>${logo}</td><td><a class=\"edit btn btn-success my-2 my-sm-0\" href=\"parties.php?param=${element.id}\">Edit</a></td></tr>`;
                sn++;
            });
            table.innerHTML = rows;
        }

        function populateFieldsInEdit() {
            var urlParams = new URLSearchParams(location.search);
            if (urlParams.has('param')) {
                document.getElementById('partyid').value = urlParams.get('param');
                fetch('partiesserver.php?action=PREPAREFOREDIT&param=' + urlParams.get('param'), {
                    method: 'GET',
                })
                    .then(function (response) {
                        response.json()
                            .then(function (data) {
                                if (response.status === 200) {
                                    document.getElementById('party_name').value = data.obj.partyname;
                                    document.getElementById('party_code').value = data.obj.partycode;
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