<!-- Ajout du post dans la BdD -->
<?php
if(isset($_POST['contenu']) and strlen($_POST['contenu']) > 0){
    session_start();

    $date = date("d/m/y H:i");

    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    //Code d'insertion dans la BD
    $today = date('Y/m/d');
    $query = 'INSERT INTO croustapost (croustagrameur_id, titre, message, date, categorie1, categorie2, categorie3) VALUES ("' . $_SESSION['username'] . '", "' . htmlspecialchars($_POST["titre"]) . '", "' . htmlspecialchars($_POST["contenu"]) . '", "' . $today . '", "aucune", "aucune", "aucune")';

    // Gestion d'erreur BD
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requête<br>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
        echo 'Requête : ' . $query . '<br>';
        exit();
    }
    header('Location: ../index.php');
    exit();
}
?>