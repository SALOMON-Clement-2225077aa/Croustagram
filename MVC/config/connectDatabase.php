<?php
function connexion(){

    $conf = parse_ini_file('php.ini'); //récupération du fichier de config

    if (!is_array($conf)) //test erreur dans la config
    {
    throw new DatabaseException('Erreur de chargement de configuration');
    }

    $dsn = $conf['driver'] . ':dbname=' . 'croustagramadd_bdd' . ';host=' . $conf['host']; // création du dsn pour la connexion
    $connection = new PDO($dsn, $conf['username'], $conf['password']); //connexion à la base

    return $connection;
}
