/**
 * Auteur: Georges
 * Description: Script permettant recuperation api et stocker dans les cookie pour le login
 */

function setCookie(name, content, expireDays) { //Fonction empruntée à w3schools https://www.w3schools.com/js/js_cookies.asp
    const d = new Date();
    d.setTime(d.getTime() + (expireDays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + content + ";" + expires + ";path=/";
}

function deconnection() {
    //  alert(document.cookie);
    document.cookie = "userIsConnected=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/"; //modifier les données des cookie se qui casse la session
}

//Recuperation de données de l'api pour les utilisateurs
function apiGET() {
    //recuperation des valeur dans le input
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    $.ajax({
        //type GET qui permet la recuperation des données
        type: "GET",
        url: `http://localhost/GameAdvice/WebSite/api/users.php`, //url api
        cache: false,
        success: function(data) {
            //bouble qui effectuer une action en fonction des nombre de données dans l'api
            for (let index = 0; index < data.length; index++) {
                if (data[index].email == email && data[index].mdp == password) {
                    //inserer dans la varible les donnée de l'api
                    let userInfos = [data[index].nom, data[index].prenom, data[index].email, data[index].mdp, data[index].photoProfil];
                    //insere les données du user dans le cokkie
                    setCookie("userIsConnected", userInfos, 7);
                } else {
                    //erreur s'affiche dans le log
                    console.log("erreur");
                }

            }
            //redirection
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