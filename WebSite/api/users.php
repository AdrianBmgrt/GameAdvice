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
            returnResponse(readUser($id));
        } else {
            returnResponse(readUsers());
        }
        break;
    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $nom = $data->nom;
        $prenom = $data->prenom;
        $email = $data->email;
        $mdp = $data->mdp;
        $photoProfil = $data->photoProfil;

        if (createUser($nom, $prenom, $email, $mdp, $photoProfil)) {
            $response = array(
                "status_message" => "User Added Successfully."
            );
        } else {
            $response = array(
                "status_message" => "User Addition Failed."
            );
        }
        var_dump($nom);
        var_dump($prenom);
        var_dump($email);
        var_dump($mdp);
        var_dump($photoProfil);
        ReturnResponse($response);
        break;
    case 'PUT':
        $id = intval($_GET["id"]);
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $nom = $data->nom;
        $prenom = $data->prenom;
        $email = $data->email;
        $mdp = $data->mdp;
        $photoProfil = $data->photoProfil;

        if (updateGame($id, $nom, $prenom, $email, $mdp, $photoProfil)) {
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
