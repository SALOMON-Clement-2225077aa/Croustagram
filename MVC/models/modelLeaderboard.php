<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();

/**
 * Récupère l'id, les ptsCrous ,et l'img de tout les croustagrammeurs du site (avec requete sql)
 */
function getLeaderboardData(){
    global $connexion;

    // Requête
    $requete = 'SELECT id, ptsCrous ,img FROM croustagrameur ORDER BY ptsCrous DESC';
    $result = $connexion->query($requete);

    // Si la requête a marché on affiche les users
    if ($result) {
        return $result;
    }
    return null;
}

/**
 * utilise getUserCount() et getLeaderboardPosition() pour afficher le classement
 * de l'utilisateur connecté sous la forme (Position'e'/totalUser)
 */
function myPosition() {
    $nbUser = getUserCount();
    $currentUserPos = getLeaderboardPosition($_SESSION['username']);
    return $currentUserPos . 'e/' . $nbUser;
}

/**
 * Récupère et renvoie le nombre d'utilisateur sur Croustagram
 * @return int
 */
function getUserCount(): int
{
    global $connexion;

    // Requête
    $requete = 'SELECT COUNT(DISTINCT id) FROM croustagrameur;';
    $result = $connexion->query($requete);

    if ($result) {
        $count = $result->fetchColumn();
        return (int)$count;
    }
    return 0;
}

/**
 * Récupère et renvoie la position dans le classement la personne connecté à la session actulle
 * @param $user = id de l'utilisateur
 * @return int
 */
function getLeaderboardPosition($user): int
{
    global $connexion;

    // Requête
    $requete = 'SELECT id, ptsCrous FROM croustagrameur ORDER BY ptsCrous DESC';
    $result = $connexion->query($requete);

    // Si la requête a marché on calcul la position
    if ($result) {
        $cpt = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $cpt += 1;
            if($row['id'] == $user) {
                return $cpt;
            }
        }
    }
    // Ca affichais ( 'e/27' ) au lieu de ( '27e/27e ) pour le dernier donc :
    return getUserCount();
}