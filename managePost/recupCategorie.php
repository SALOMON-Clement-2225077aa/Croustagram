<?php
    function convert_cat($cat1, $cat2, $cat3) : string
    {
        // Connexion à la base de donnée
        $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , "croustagramadd_bdd")
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        $nom_cat1 = null;
        $nom_cat2 = null;
        $nom_cat3 = null;

        // Requête
        $result = mysqli_query($dbLink, 'SELECT * FROM croustegorie ORDER BY id ASC ');

        while ($row = mysqli_fetch_assoc($result)) {
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
        mysqli_free_result($result);

        # Gestion de l'affichage ;

        // Aucune catégories :
        $result = 'Aucune catégories';

        // 1 seule catégorie :
        if($nom_cat1 != null and $nom_cat2 == null and $nom_cat3 == null) {$result = $nom_cat1;}
        if($nom_cat1 == null and $nom_cat2 != null and $nom_cat3 == null) {$result = $nom_cat2;}
        if($nom_cat1 == null and $nom_cat2 == null and $nom_cat3 != null) {$result = $nom_cat3;}

        // 2 catégories :
        if($nom_cat1 != null and $nom_cat2 != null and $nom_cat3 == null) {$result = $nom_cat1 . ', ' . $nom_cat2;}
        if($nom_cat1 == null and $nom_cat2 != null and $nom_cat3 != null) {$result = $nom_cat2 . ', ' . $nom_cat3;}
        if($nom_cat1 != null and $nom_cat2 == null and $nom_cat3 != null) {$result = $nom_cat1 . ', ' . $nom_cat3;}

        // 3 catégories :
        if($nom_cat1 != null and $nom_cat2 != null and $nom_cat3 != null) {$result = $nom_cat1 . ', ' . $nom_cat2 . ', ' . $nom_cat3;}

        return $result;
    }

    convert_cat(1,2,1);
