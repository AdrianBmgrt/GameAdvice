<?php

require "../config/boiteaoutils.inc.php";

$request_method = $_SERVER["REQUEST_METHOD"];

function returnResponse($response)
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($response);
}

switch ($request_method) {
    case 'GET':
        if (isset($_GET["description"])) {
            var_dump($_GET["description"]);
        }

        // Retrive Products
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            returnResponse(readGame($id));
        } else {
            returnResponse(readGames());
        }
        break;

    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $nom = $data->nom;
        $dateDeSortie = $data->dateDeSortie;
        $description = $data->description;
        $prix = $data->prix;
        $image = $data->image;

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
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $nom = $data->nom;
        $dateDeSortie = $data->dateDeSortie;
        $description = $data->description;
        $prix = $data->prix;
        $image = $data->image;

        if (updateGame($id, $nom, $dateDeSortie, $description, $prix, $image)) {
            $response = array(
                "status_message" => "Game updated Successfully."
            );
        } else {
            $response = array(
                "status_message" => "Game update Failed."
            );
        }
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
