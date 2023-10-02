<?php
define('PHP_INI_PATH', 'init/php.ini');
define('DB_NAME', 'croustagramadd_bdd');

$conf = parse_ini_file(PHP_INI_PATH); //récupération du fichier de config

if (!is_array($conf)) //test erreur dans la config
{
    throw new DatabaseException('Erreur de chargement de configuration');
}

$dsn = $conf['driver'] . ':dbname=' . DB_NAME . ';host=' . $conf['host']; // création du dsn pour la connexion
$connection = new PDO($dsn, $conf['username'], $conf['password']); //connexion à la base

$statement = $connection->query('SELECT * FROM croustagrameur ORDER BY ptsCrous DESC');

if ($statement) {
    // afficher_user($pseudo, $img, $date_creation, $date_connexion, $ptsCrous):
    while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
        afficher_user($row['pseudo'], $row['img'], $row['creation_compte'], $row['derniere_connexion'], $row['ptsCrous']);
    }
    // Libère la variable
    $statement->closeCursor();
}
else {
    echo 'Erreur dans la requête';
}


// Lecture + Affichage des posts de la BD (SELECT * FROM `croustapost`)

$statement = $connection->query( 'SELECT * FROM croustapost ORDER BY ptsCrous DESC');

// Si la requête a marché on affiche les posts
if ($statement) {
    // afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous):
    while ($row = mysqli_fetch_assoc($statement)) {
        afficher_post($row['croustagrameur_id'], $row['titre'], $row['message'], $row['date'], $row['categories'], $row['ptsCrous']);
    }
    // Libère la variable
    $statement->closeCursor();
}
else {
    echo 'Erreur dans la requête';
}
?>