<?php
function connexion(){
    define('PHP_INI_PATH', 'php.ini');
    define('DB_NAME', 'croustagramadd_bdd');

    $conf = parse_ini_file(PHP_INI_PATH); //récupération du fichier de config

    if (!is_array($conf)) //test erreur dans la config
    {
    throw new DatabaseException('Erreur de chargement de configuration');
    }

    $dsn = $conf['driver'] . ':dbname=' . DB_NAME . ';host=' . $conf['host']; // création du dsn pour la connexion
    $connection = new PDO($dsn, $conf['username'], $conf['password']); //connexion à la base

    return $connection;
}