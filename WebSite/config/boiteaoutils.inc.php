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
 * @return \PDO
 */
function m152DB()
{
    static $pokedexConnector = null;

    if ($pokedexConnector == null) {

        try {
            $pokedexConnector = new PDO('mysql: ' . DBNAME . ';hostname= ' . HOSTNAME, DBUSER, PASSWORD, array(
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
    return $pokedexConnector;
}


/**
 * Retourne les données d'un pokémon en fonction de son idGame
 * @param mixed $idGame
 * @return false|array 
 */
function readGame($idGame)
{
    static $ps = null;
    $sql = 'SELECT nom, description, dateDeSortie, prix, image';
    $sql .= ' FROM dbgameadvice.games';
    $sql .= ' WHERE idGame = :IDGAME';

    if ($ps == null) {
        $ps = m152DB()->prepare($sql);
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

function readGames($from = 0, $offset = 50)
{
    static $ps = null;
    $sql = 'SELECT nom, description, dateDeSortie, prix, image';
    $sql .= ' FROM dbgameadvice.games';
    $sql .= ' ORDER BY nom ASC LIMIT :FROM,:OFFSET;';

    if ($ps == null) {
        $ps = m152DB()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(':FROM', $from, PDO::PARAM_INT);
        $ps->bindParam(':OFFSET', $offset, PDO::PARAM_INT);

        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

?>