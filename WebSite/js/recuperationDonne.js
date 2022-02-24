var xhr = new XMLHttpRequest();
xhr.open('GET', 'http://localhost/GameAdvice/WebSite/api/user/read.php');
xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
        var reponse = JSON.parse(xhr.responseText);
        console.log(reponse.email);
    }
};
xhr.send();