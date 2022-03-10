/*
function apiGET() {
    $.ajax({
        type: "GET",
        url: `http://localhost/GameAdvice/WebSite/api/games.php`,
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
*/document.addEventListener('DOMContentLoaded', function() {
    var div = document.createElement('div');
    div.id = 'container';
    div.innerHTML = 'Hi there!';
    div.className = 'border pad';
 
    document.body.appendChild(div);
}, false);

/*
<div class="col-lg-4 col-md-6 col-sm-6">
<div class="product__item">
    <div class="product__item__pic set-bg" data-setbg="img/trending/trend-1.jpg">
        <div class="ep">18 / 18</div>
        <div class="comment"><i class="fa fa-comments"></i> 11</div>
        <div class="view"><i class="fa fa-eye"></i> 9141</div>
    </div>
    <div class="product__item__text">
        <ul>
            <li>Active</li>
            <li>Movie</li>
        </ul>
        <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
    </div>
</div>
</div>*/