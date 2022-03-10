function setCookie(name, content, expireDays) { //Fonction empruntée à w3schools https://www.w3schools.com/js/js_cookies.asp
    const d = new Date();
    d.setTime(d.getTime() + (expireDays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + content + ";" + expires + ";path=/";
}

function deconnection() {
    alert(document.cookie);
    document.cookie = "userIsConnected=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    alert(document.cookie);
}



function apiGET() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    $.ajax({
        type: "GET",
        url: `http://localhost/GameAdvice/WebSite/api/users.php?email=${email}&mdp=${password}`,
        cache: false,
        success: function(data) {

            let userInfos = [data[0].nom, data[0].prenom, data[0].email, data[0].mdp, data[0].photoProfil];            

            setCookie("userIsConnected", userInfos, 7);

            alert(document.cookie);
            //location.replace("profil.html");

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