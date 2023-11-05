<?php
require_once '../config/connectDatabase.php';
require_once '../models/modelCategorie.php';

/**
 * Fonction qui convertie les clés primaires (nombres) des catégories d'un post
 * Pour les transformer en string 'Catégorie : nom $cat1 ; nom $cat2 ; ...'
 * @param $cat1 = la catégorie 1
 * @param $cat2 = la catégorie 2
 * @param $cat3 = la catégorie 3
 * @return string les différentres catégories
 */
function convert_cat($cat1, $cat2, $cat3) : string
{
    // Connexion à la base de donnée
    $connexion = connexion();

    $nom_cat1 = null;
    $nom_cat2 = null;
    $nom_cat3 = null;

    // Requête
    $result = $connexion->query('SELECT * FROM croustegorie ORDER BY id ASC ');

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($row['id'] != 0) {
            if ($row['id'] == $cat1) {
                $nom_cat1 = $row['libelle'];
            }
            else if ($row['id'] == $cat2) {
                $nom_cat2 = $row['libelle'];
            }
            else if ($row['id'] == $cat3) {
                $nom_cat3 = $row['libelle'];
            }
        }
    }
    // Libère la variable
    $result->closeCursor();

    # Gestion de l'affichage ;

    // Aucune catégories :
    if($nom_cat1 == null and $nom_cat2 == null and $nom_cat3 == null) {return 'Aucune catégorie';}

    // 1 seule catégorie :
    if($nom_cat1 != null and $nom_cat2 == null and $nom_cat3 == null) {return 'Catégorie : ' . $nom_cat1;}
    if($nom_cat1 == null and $nom_cat2 != null and $nom_cat3 == null) {return 'Catégorie : ' . $nom_cat2;}
    if($nom_cat1 == null and $nom_cat2 == null and $nom_cat3 != null) {return 'Catégorie : ' . $nom_cat3;}

    // 2 catégories :
    if($nom_cat1 != null and $nom_cat2 != null and $nom_cat3 == null) {$result = $nom_cat1 . ', ' . $nom_cat2;}
    if($nom_cat1 == null and $nom_cat2 != null and $nom_cat3 != null) {$result = $nom_cat2 . ', ' . $nom_cat3;}
    if($nom_cat1 != null and $nom_cat2 == null and $nom_cat3 != null) {$result = $nom_cat1 . ', ' . $nom_cat3;}

    // 3 catégories :
    if($nom_cat1 != null and $nom_cat2 != null and $nom_cat3 != null) {$result = $nom_cat1 . ', ' . $nom_cat2 . ', ' . $nom_cat3;}

    return 'Catégories : ' . $result;
}



function showOneCategorie($idCat,$libelle,$description) {
    echo '<div id="oneCategorie">';
        echo '<p id="ligneCat"> Catégorie n°' . $idCat . ' : ' . $libelle . '<br>' . $description . '</p>';
        echo '<button> test </button>';
    echo '</div>';
}

function showAdminCategorieMenu() {

    echo '<section id="adminCategorieMenu">';

        $categorieData = getCategories();
        while($row = $categorieData->fetch(PDO::FETCH_ASSOC)) {
            $idCat = $row['id'];
            $libelle = $row['libelle'];
            $description = $row['description'];
            showOneCategorie($idCat,$libelle,$description);
        }

    echo '</section>';

}