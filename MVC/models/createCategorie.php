<?php
require_once '../config/connectDatabase.php';
session_start();

// Récup des inputs de la créarion de la catégorie (formulaire)
$label = htmlspecialchars($_POST['Label']);
$description = htmlspecialchars($_POST['Description']);

// Calcul de l'ID
$id = 8;

// Connexion à la BdD
$connexion = connexion();

// Requête ajout de la catégorie à la BdD :
$query = "INSERT INTO croustegorie (id, libelle, description) VALUES ('".$id."', '".$label."', '".$description."')";

// Envoie la requête et affiche les potentielles erreures
if (!($dbResult = $connexion->exec($query))) {
    echo '<strong>Erreur dans requête</strong><br>';
    // Affiche le type d'erreur.
    echo '<strong>Erreur : ' . $connexion->errorInfo() . '</strong><br>';
    // Affiche la requête envoyée.
    echo '<strong>Requête : ' . $query . '</strong><br>';
    exit();
}

header("Location: ../views/viewCreerCategorie.php");
exit();