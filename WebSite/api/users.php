<?php

require "../config/boiteaoutils.inc.php";

$request_method = $_SERVER["REQUEST_METHOD"];

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
            returnResponse(readUser($id));
        } else {
            returnResponse(readUsers());
        }
        break;

    case 'POST':
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];
        $photoProfil = $_POST["photoProfil"];

        if (createUser($nom, $prenom, $email, $mdp, $photoProfil)) {
            $response = array(
                "status_message" => "User Added Successfully."
            );
        } else {
            $response = array(
                "status_message" => "User Addition Failed."
            );
        }
        ReturnResponse($response);
        break;
    case 'PUT':
        // CODE ICI
        break;
    case 'DELETE':
        $id = intval($_GET["id"]);
        if (deleteUser($id)) {
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
