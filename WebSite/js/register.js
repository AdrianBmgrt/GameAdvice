function register() {
    //recuperre valeur input
    var email = document.getElementById('email').value;
    var nom = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;
    var password = document.getElementById('password').value;
    var passwordConfirm = document.getElementById('passwordConfirm').value;

    //verification valeur des input
    if (email != "" && nom != "" && prenom != "" && password != "" && passwordConfirm != "") {
        if (password == passwordConfirm) {
            var utilisateur = { nom: nom, prenom: prenom, email: email, mdp: password, photoProfil: "" };
            console.log(utilisateur);

            $.ajax({
                //url api
                url: 'http://localhost/GameAdvice/WebSite/api/users.php',
                //type POST ajout de valeur
                type: 'POST',
                //ajout des valeur pour envoyer a la l'api
                data: JSON.stringify(utilisateur),
                async: false, // enable or disable async (optional, but suggested as false if you need to populate data afterwards)
                success: function(data, textStatus, jqXHR) {
                    console.log(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
            console.log(data);
        }

    }

}


//TEST

/*
var formData = { name: "John", surname: "Doe", age: "31" }; //Array 
$.ajax({
    url: "https://example.com/rest/getData", // Url of backend (can be python, php, etc..)
    type: "POST", // data type (can be get, post, put, delete)
    data: formData, // data in json format
    async: false, // enable or disable async (optional, but suggested as false if you need to populate data afterwards)
    success: function(response, textStatus, jqXHR) {
        console.log(response);
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    }
});


// Insert new record with POST request
function insertNewEmployee() {

    var name = document.getElementById('txt_name').value;
    var salary = document.getElementById('txt_salary').value;
    var email = document.getElementById('txt_email').value;

    if (name != '' && salary != '' && email != '') {

        var data = { name: name, salary: salary, email: email };
        var xhttp = new XMLHttpRequest();
        // Set POST method and ajax file path
        xhttp.open("POST", "ajaxfile.php", true);

        // call on request changes state
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var response = this.responseText;
                if (response == 1) {
                    alert("Insert successfully.");

                    loadEmployees();
                }
            }
        };

        // Content-type
        xhttp.setRequestHeader("Content-Type", "application/json");

        // Send request with data
        xhttp.send(JSON.stringify(data));
    }

}*/