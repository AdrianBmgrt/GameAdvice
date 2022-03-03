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


// FAUT FINIR CAR CE TRUC NE MACHE PAS çA ME SOULE BEAUCOUP !!!!!!
function login() {
    var email = document.getElementById("email");
    var password = document.getElementById(" password")
    $.ajax({
        type: "GET",
        url: `http://localhost/GameAdvice/WebSite/login.html?email=${email}&mdp=${password}`,
        success: function(data) {
            let userInfos = [data[0].nom, data[0].email, data[0].mdp];

            setCookie("userIsConnected", userInfos, 7);
            alert(userInfos);
            alert(document.cookie);
            console.log(document.cookie);

            //location.replace("index.html");

        },
        error: function(jqXHR, textStatus, errorThrown) {

            document.getElementById("message").innerHTML = "Le mot de passe et/ou l'email ne correspondent pas";
            alert(errorThrown);

        }
    });
}