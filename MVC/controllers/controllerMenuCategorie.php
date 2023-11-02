<?php
require_once '../config/connectDatabase.php';

/**
 * Récupération des catégorie pour le menu déroulant de selection
 * @return void
 */
function selectCategorie():void {

    // Connexion à la base de donnée
    $connexion = connexion();

    // Requête
    $requete = 'SELECT libelle FROM croustegorie ORDER BY id ASC';
    $result = $connexion->query($requete);

    // Ici on compte le nombre de catégories
    $numCat = 0;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        if ($row['libelle'] != 'None') {
            $numCat += 1;
            echo '<option value="' . $numCat .'">' . $row['libelle'] . '</option>';
        }
    }
}
?>