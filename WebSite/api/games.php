<?php

require "../config/boiteaoutils.inc.php";

$request_method = $_SERVER["REQUEST_METHOD"];

/*
$resultCheckRequestMethod = checkRequestMethod($_SERVER["REQUEST_METHOD"], "GET", "POST");
if ($resultCheckRequestMethod != null) {
    returnResponse($resultCheckRequestMethod);
    return;
}
function checkRequestMethod($requestMethod, ...$allowedRequestMethods)
{
    if (strcmp("OPTIONS", $requestMethod) == 0) {
        header("Access-Control-Allow-Methods: OPTIONS, " .
            implode(", ", $allowedRequestMethods));
        header("Access-Control-Allow-Headers: *");
        return array("KEY_STATUS" => "OK");
    }
    foreach ($allowedRequestMethods as $allowedRequestMethod) {
        if (strcmp($requestMethod, $allowedRequestMethod) == 0) {
            return null;
        }
    }
    // requestMethod is not allowed for that endpoint
    http_response_code(405);
    return array(
        "KEY_STATUS" => "KO",
        "KEY_MESSAGE" => $requestMethod . " is not allowed for that endpoint,
please use " . implode(" or ", $allowedRequestMethods)
    );
}
*/
function returnResponse($response)
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($response);
}

//var_dump($resultCheckRequestMethod);
switch ($request_method) {
    case 'GET':
        // Retrive Products
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            returnResponse(readGame($id));
        } else {
            returnResponse(readGames());
        }
        break;

    case 'POST':
        /*
        $nom = $data->nom;
        $dateDeSortie = $data->dateDeSortie;
        $description = $data->description;
        $prix = $data->prix;
        $image = $data->image;
*/
        /*
        $nom = $data["nom"];
        $dateDeSortie = $data["dateDeSortie"];
        $description = $data["description"];
        $prix = $data["prix"];
        $image = $data["image"];
*/

        $nom = $_POST["nom"];
        $dateDeSortie = $_POST["dateDeSortie"];
        $description = $_POST["description"];
        $prix = $_POST["prix"];
        $image = $_POST["image"];

        if (createGame($nom, $dateDeSortie, $description, $prix, $image)) {
            $response = array(
                "status_message" => "Game Added Successfully."
            );
        } else {
            $response = array(
                "status_message" => "Game Addition Failed."
            );
        }
        ReturnResponse($response);
        break;
    case 'PUT':
        $id = intval($_GET["id"]);
        $data = json_decode(file_get_contents("php://input"), true);

        $nom = $data->nom;
        $dateDeSortie = $data->dateDeSortie;
        $description = $data->description;
        $prix = $data->prix;
        $image = $data->image;

        /*
        $nom = $data["nom"];
        $dateDeSortie = $data["dateDeSortie"];
        $description = $data["description"];
        $prix = $data["prix"];
        $image = $data["image"];
*/
/*
        $nom = $_POST["nom"];
        $dateDeSortie = $_POST["dateDeSortie"];
        $description = $_POST["description"];
        $prix = $_POST["prix"];
        $image = $_POST["image"];
*/
        if (updateGame($id, $nom, $dateDeSortie, $description, $prix, $image)) {
            $response = array(
                "status_message" => "Game updated Successfully."
            );
        } else {
            $response = array(
                "status_message" => "Game update Failed."
            );
        }

        var_dump($id);
        var_dump($nom);
        var_dump($dateDeSortie);
        var_dump($description);
        var_dump($prix);
        var_dump($image);
        ReturnResponse($response);
        break;
    case 'DELETE':
        $id = intval($_GET["id"]);
        if (deleteGame($id)) {
            $response = array(
                "status_message" => "Game Deleted Successfully."
            );
        } else {
            $response = array(
                "status_message" => "Game Deletion Failed."
            );
        }
        ReturnResponse($response);
        break;
}
