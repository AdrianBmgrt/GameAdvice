

    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: `http://localhost/GameAdvice/WebSite/api/games.php`,
            cache: false,
            dataType: 'json',
            success: function (data) {
                let html = "";  
                for (let index = 0; index <= data.length; index++) {
                  //  console.log(data[index]);
                        // let gameInfos = [data[index].nom, data[index].image];
                        html += "<div class=\"col-lg-4 col-md-6 col-sm-6\">";
                        html += "<div class=\"product__item\">";
                        html += "<div class=\"product__item__pic set-bg\" data-setbg=\"img/jeuImg/" + data[index].image + "\" style='background-image: url(\"img/jeuImg/" + data[index].image + "\");'>";
                        html += "<div class=\"ep\">18 / 18</div>";
                        html += "<div class=\"comment\"><i class=\"fa fa-comments\"></i> 11</div>";
                        html += "<div class=\"view\"><i class=\"fa fa-money\"></i> " + data[index].prix + " CHF </div>";
                        html += "</div>";
                        html += "<div class=\"product__item__text\">";
                        html += "<ul";
                        html += "</ul>";
                        html += "<h5><a href=\"#\">" + data[index].nom + "</a></h5>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        document.getElementById("content").innerHTML = html;
                        
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    });
