function setCookie(name, content, expireDays) { //Fonction empruntée à w3schools https://www.w3schools.com/js/js_cookies.asp
    const d = new Date();
    d.setTime(d.getTime() + (expireDays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + content + ";" + expires + ";path=/";
}

function deconnection() {
    //  alert(document.cookie);
    document.cookie = "userIsConnected=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    alert(document.cookie);
}

function apiGET() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    $.ajax({
        type: "GET",
        url: `http://localhost/GameAdvice/WebSite/api/users.php`,
        cache: false,
        success: function(data) {

            for (let index = 0; index < data.length; index++) {
                if (data[index].email == email && data[index].mdp == password) {
                    let userInfos = [data[index].nom, data[index].prenom, data[index].email, data[index].mdp, data[index].photoProfil];
                    setCookie("userIsConnected", userInfos, 7);
                } else {
                    console.log("erreur");
                }

            }
            // alert(document.cookie);
            location.replace("index.html");

        },
        error: function(jqXHR, textStatus, errorThrown) {

            if (errorThrown == "Unauthorized") {
                document.getElementById("errorMessageConnection").innerHTML = "Le mot de passe et/ou l'email ne correspondent pas";
            } else {
                document.getElementById("errorMessageConnection").innerHTML = "Une erreur est survenue";
            }
            console.log(errorThrown);

        }
    });
}