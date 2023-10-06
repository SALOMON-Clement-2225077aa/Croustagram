<!-- Ajout du post dans la BdD -->
<?php require_once '../MVC/config/connectDatabase.php';
if(isset($_POST['contenu']) and strlen($_POST['contenu']) > 0){
    session_start();

    $date = date("d/m/y H:i");

    // Connexion à la base de donnée

    $connexion = connexion();

    //Code d'insertion dans la BD
    $today = date('Y/m/d');
    $query = 'INSERT INTO croustapost (croustagrameur_id, titre, message, date, categorie1, categorie2, categorie3) VALUES ("' . $_SESSION['username'] . '", "' . htmlspecialchars($_POST["titre"]) . '", "' . htmlspecialchars($_POST["contenu"]) . '", "' . $today . '", "aucune", "aucune", "aucune")';

    // Gestion d'erreur BD
    if(!($dbResult = $connexion->exec($query)))
    {
        echo 'Erreur de requête<br>';
        echo 'Erreur : ' . $connexion->errorInfo() . '<br>';
        echo 'Requête : ' . $query . '<br>';
        exit();
    }
    header('Location: ../index.php');
    exit();
}
?>