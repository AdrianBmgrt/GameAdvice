
function saveTheCookie(value) {
    var today = new Date(); // Actual date
    var expire = new Date(); // Expiration of the cookie

    var cookie_name = "username_form"; // Name for the cookie to be recognized
    var number_of_days = 10; // Number of days for the cookie to be valid (10 in this case)

    expire.setTime(today.getTime() + 60 * 60 * 1000 * 24 * number_of_days); // Current time + (60 sec * 60 min * 1000 milisecs * 24 hours * number_of_days)

    document.cookie = cookie_name + "=" + escape(value) + "; expires=" + expire.toGMTString();
}

function getTheCookie() {
    var cookie_name = "username_form";
    var return_value = null;

    var pos_start = document.cookie.indexOf(" " + cookie_name + "=");
    if (pos_start == -1) document.cookie.indexOf(cookie_name + "=");

    if (pos_start != -1) { // Cookie already set, read it
        pos_start++; // Start reading 1 character after
        var pos_end = document.cookie.indexOf(";", pos_start); // Find ";" after the start position

        if (pos_end == -1) pos_end = document.cookie.length;
        return_value = unescape(document.cookie.substring(pos_start, pos_end));
    }

    return return_value; // null if cookie doesn't exist, string otherwise
}



function apiGET() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    $.ajax({
        type: "GET",
        url: "http://localhost/GameAdvice/WebSite/api/users.php",
        cache: false,
        success: function (data) {
            if (email == data[0]["email"] && password == data[0]["mdp"]) {
                alert("Login successfully");
                //window.location = "success.html"; // Redirecting to other page.
                return false;
            }
            else {
                attempt--;// Decrementing by one.
                alert("You have left " + attempt + " attempt;");
                // Disabling fields after 3 attempts.
                if (attempt == 0) {
                    document.getElementById("email").disabled = true;
                    document.getElementById("password").disabled = true;
                    document.getElementById("submit").disabled = true;
                    return false;
                }
            } 

        }
    });
}