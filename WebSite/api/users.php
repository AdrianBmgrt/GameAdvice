<?php
/*
* Nom: Adrian Baumgartner 
* Description : Page oû j'ai créer mon API concernant les utilisateur  
*/

require "../config/boiteaoutils.inc.php";

// Permet de récupérer la méthode HTTP
$request_method = $_SERVER["REQUEST_METHOD"];

function returnResponse($response)
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($response);
}

// API REST concernant les utilisateurs
switch ($request_method) {
    case 'GET':
        
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

        if (updateUser($id, $nom, $prenom, $email, $mdp, $photoProfil)) {
            $response = array(
                "status_message" => "User updated Successfully."
            );
        } else {
            $response = array(
                "status_message" => "User update Failed."
            );
        }
        ReturnResponse($response);
        break;
    case 'DELETE':
        $id = intval($_GET["id"]);
        if (deleteUser($id)) {
            $response = array(
                "status_message" => "User Deleted Successfully."
            );
        } else {
            $response = array(
                "status_message" => "User Deletion Failed."
            );
        }
        ReturnResponse($response);
        break;
}
