//afficher de l'accueil a l'aide des valeur de l'api
$(document).ready(function() {
    $.ajax({
        //type GET recuperation des valeur
        type: 'GET',
        //url api
        url: `http://localhost/GameAdvice/WebSite/api/games.php`,
        cache: false,
        dataType: 'json',
        success: function(data) {
            let html = "";
            //pour la longueur des valeur de l'api
            for (let index = 0; index <= data.length; index++) {
                //affichage hmtl
                html += "<div class=\"col-lg-4 col-md-6 col-sm-6\">";
                html += "<div class=\"product__item\">";
                html += "<div class=\"product__item__pic set-bg\" data-setbg=\"img/jeuImg/" + data[index].image + "\" style='background-image: url(\"img/jeuImg/" + data[index].image + "\");'>";
                html += "<div class=\"ep\">20 / 20</div>";
                html += "<div class=\"comment\"><i class=\"fa fa-comments\"></i> 11</div>";
                html += "<div class=\"view\"><i class=\"fa fa-money\"></i> " + data[index].prix + " CHF </div>";
                html += "</div>";
                html += "<div class=\"product__item__text\">";
                html += "<ul";
                html += "</ul>";
                html += "<h5><a href=\"anime-details.html\">" + data[index].nom + "</a></h5>";
                html += "</div>";
                html += "</div>";
                html += "</div>";
                //l'affichage sera fait dans l'element contenant l'id "content"
                document.getElementById("content").innerHTML = html;
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log(xhr);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
});