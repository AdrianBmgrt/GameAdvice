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

                    $errors = 'You need to enter a username and password';
                }
                //location.replace("index.html");

        },
        error: function(jqXHR, textStatus, errorThrown) {

            document.getElementById("message").innerHTML = "Le mot de passe et/ou l'email ne correspondent pas";
            alert(errorThrown);

        }
    });
}


function login() {
    // var username = $("#txt_uname").val().trim();
    //var password = $("#txt_pwd").val().trim();
    var email = document.getElementById("email").val().trim();
    var password = document.getElementById(" password").val().trim();


    if (email != "" && password != "") {
        $.ajax({
            url: `http://localhost/GameAdvice/WebSite/login.html`,
            type: 'GET',
            data: { email: email, password: password },
            success: function(response) {
                //var msg = "";
                if (response == 1) {
                    document.getElementById("message").innerHTML = "bravo";
                    // window.location = "home.php";
                } else {
                    document.getElementById("message").innerHTML = "Le mot de passe et/ou l'email ne correspondent pas";
                }
                //$("#message").html(msg);
            }
        });
    }
}