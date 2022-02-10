<?php

require "../Website/config/boiteaoutils.inc.php";

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// set response code - 200 OK
http_response_code(200);

echo json_encode(readGames());

?>