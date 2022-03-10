<?php
/*
  Date       : Février 2022
  Auteur     : Adrian Baumgartner
  Sujet      : Librairie de fonctions php
 */

require "constantesDB.inc.php";

/**
 * Connecteur de la base de données du .
 * Le script meurt (die) si la connexion n'est pas possible.
 * @staticvar PDO $dbc
 * @return \PDOO
 */
function dbGameAdvice()
{
    static $dbGameAdviceConn = null;

    if ($dbGameAdviceConn == null) {
        try {
            $dbGameAdviceConn = new PDO('mysql: ' . DBNAME . ';hostname= ' . HOSTNAME, DBUSER, PASSWORD, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_PERSISTENT => true
            ));
        } catch (PDOException $Exception) {
            // PHP Fatal Error. Second Argument Has To Be An Integer, But PDOException::getCode Returns A
            // String.
            error_log($Exception->getMessage());
            error_log($Exception->getCode());
            die('Could not connect to MySQL');
        }
    }
    return $dbGameAdviceConn;
}

/*
 * Retourne les données d'un pokémon en fonction de son idGame
 * @param mixed $idGame
 * @return false|array 
 */
function readGame($idGame)
{
    static $ps = null;
    $sql = 'SELECT nom, description, dateDeSortie, prix, image';
    $sql .= ' FROM dbGameAdvice.Games';
    $sql .= ' WHERE idGame = :IDGAME';

    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':IDGAME', $idGame, PDO::PARAM_INT);

        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

/*
 * Retourne les données d'un pokémon en fonction de son idGame
 * @param mixed $idGame
 * @return false|array 
 */
function readUserByEmail($email)
{
    static $ps = null;
    $sql = 'SELECT u.nom, u.prenom, u.email, u.mdp, u.photoProfil ';
    $sql .= ' FROM dbGameAdvice.Users as u ';
    $sql .= ' WHERE email = :EMAIL';

    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':EMAIL', $email, PDO::PARAM_INT);

        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function readGames()
{
    static $ps = null;
    $sql = 'SELECT g.nom, g.description, g.dateDeSortie, g.prix, g.image';
    $sql .= ' FROM dbGameAdvice.Games as g';

    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function readUser($idUser)
{
    static $ps = null;
    $sql = 'SELECT u.nom, u.prenom, u.email, u.mdp, u.photoProfil';
    $sql .= ' FROM dbGameAdvice.Users as u';
    $sql .= ' WHERE idUser = :IDUSER';

    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':IDUSER', $idUser, PDO::PARAM_INT);
        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function readUsers()
{
    static $ps = null;
    $sql = 'SELECT u.nom, u.prenom, u.email, u.mdp, u.photoProfil';
    $sql .= ' FROM dbGameAdvice.Users as u';

    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

/*
 * Ajoute un nouveau utilisateur avec ses paramètres
 * @param mixed $typeMedia Le type du média
 * @param mixed $nomMedia Le nom du média
 * @param mixed $creationDate  La date de création du média
 * @return bool true si réussi
 */
function createUser($nom, $prenom, $email, $mdp, $photoProfil)
{
    static $ps = null;
    $sql = "INSERT INTO `dbGameAdvice`.`Users` (`nom`, `prenom`, `email`, `mdp`, `photoProfil`) ";
    $sql .= "VALUES (:NOM, :PRENOM, :EMAIL, :MDP, :PHOTOPROFIL)";
    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':NOM', $nom, PDO::PARAM_STR);
        $ps->bindParam(':PRENOM', $prenom, PDO::PARAM_STR);
        $ps->bindParam(':EMAIL', $email, PDO::PARAM_STR);
        $ps->bindParam(':MDP', $mdp, PDO::PARAM_STR);
        $ps->bindParam(':PHOTOPROFIL', $photoProfil, PDO::PARAM_STR);
        $answer = $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * Met à jour une média existante 
 * @param mixed $idPost
 * @param mixed $commentaire
 * @param mixed $modificationDate 
 * @return bool 
 */
function updateUser($idUser, $nom, $prenom, $email, $mdp, $photoProfil)
{
    static $ps = null;

    $sql = "UPDATE `dbGameAdvice`.`Users` SET ";
    $sql .= "`nom` = :NOM, ";
    $sql .= "`prenom` = :PRENOM, ";
    $sql .= "`email` = :EMAIL, ";
    $sql .= "`mdp` = :MDP, ";
    $sql .= "`photoProfil` = :PHOTOPROFIL ";
    $sql .= "WHERE (`idUser` = :IDUSER)";
    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':IDUSER', $idUser, PDO::PARAM_INT);
        $ps->bindParam(':NOM', $nom, PDO::PARAM_STR);
        $ps->bindParam(':PRENOM', $prenom, PDO::PARAM_STR);
        $ps->bindParam(':EMAIL', $email, PDO::PARAM_STR);
        $ps->bindParam(':MDP', $mdp, PDO::PARAM_STR);
        $ps->bindParam(':PHOTOPROFIL', $photoProfil, PDO::PARAM_STR);
        $ps->execute();
        $answer = ($ps->rowCount() > 0);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

/*
 * Ajoute un nouveau utilisateur avec ses paramètres
 * @param mixed $typeMedia Le type du média
 * @param mixed $nomMedia Le nom du média
 * @param mixed $creationDate  La date de création du média
 * @return bool true si réussi
 */
function createGame($nom, $dateDeSortie, $description, $prix, $image)
{
    static $ps = null;
    $sql = "INSERT INTO `dbGameAdvice`.`Games` (`nom`, `dateDeSortie`, `description`, `prix`, `image`) ";
    $sql .= "VALUES (:NOM, :DATEDESORTIE, :DESCRIPTION, :PRIX, :IMAGE)";
    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':NOM', $nom, PDO::PARAM_STR);
        $ps->bindParam(':DATEDESORTIE', $dateDeSortie, PDO::PARAM_STR);
        $ps->bindParam(':DESCRIPTION', $description, PDO::PARAM_STR);
        $ps->bindParam(':PRIX', $prix, PDO::PARAM_INT);
        $ps->bindParam(':IMAGE', $image, PDO::PARAM_STR);
        $answer = $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * Met à jour une média existante 
 * @param mixed $idPost
 * @param mixed $commentaire
 * @param mixed $modificationDate 
 * @return bool 
 */
function updateGame($idGame, $nom, $dateDeSortie, $description, $prix, $image)
{
    static $ps = null;

    $sql = "UPDATE `dbGameAdvice`.`Games` SET ";
    $sql .= "`nom` = :NOM, ";
    $sql .= "`dateDeSortie` = :DATEDESORTIE, ";
    $sql .= "`description` = :DESCRIPTION, ";
    $sql .= "`prix` = :PRIX, ";
    $sql .= "`image` = :IMAGE ";
    $sql .= "WHERE (`idGame` = :IDGAME)";
    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':IDGAME', $idGame, PDO::PARAM_INT);
        $ps->bindParam(':NOM', $nom, PDO::PARAM_STR);
        $ps->bindParam(':DATEDESORTIE', $dateDeSortie, PDO::PARAM_STR);
        $ps->bindParam(':DESCRIPTION', $description, PDO::PARAM_STR);
        $ps->bindParam(':PRIX', $prix, PDO::PARAM_INT);
        $ps->bindParam(':IMAGE', $image, PDO::PARAM_STR);
        $ps->execute();
        $answer = ($ps->rowCount() > 0);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * Supprime la note avec l'id $idMedia.
 * @param mixed $idMedia
 * @return bool 
 */
function deleteGame($idGame)
{
    static $ps = null;
    $sql = "DELETE FROM `dbGameAdvice`.`Games` WHERE (`idGame` = :IDGAME);";
    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':IDGAME', $idGame, PDO::PARAM_INT);
        $ps->execute();
        $answer = ($ps->rowCount() > 0);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * Supprime la note avec l'id $idMedia.
 * @param mixed $idMedia
 * @return bool 
 */
function deleteUser($idUser)
{
    static $ps = null;
    $sql = "DELETE FROM `dbGameAdvice`.`Users` WHERE (`idUser` = :IDUSER);";
    if ($ps == null) {
        $ps = dbGameAdvice()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':IDUSER', $idUser, PDO::PARAM_INT);
        $ps->execute();
        $answer = ($ps->rowCount() > 0);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

?>