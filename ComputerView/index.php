<!-- Import des fonctions -->
<?php require 'utils.inc.php'; ?>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="script.js"></script>

<!-- Contenu de la page -->
<?php
    start_page('Croustagram - Accueil');
    if(isset($_SESSION['suid']))
    {
        echo '<label>Connecté en tant que :' . $_SESSION['username'] . '</label>';
    }
    echo '<script>fermerPopup();</script>';
?>;

<!-- Ajout du popup -->
<div id="popup">
    <button id="fermerPopup" onclick="fermerPopup()">X</button>
    <form action="index.php" method="post">
        <input type="text" name="titre" placeholder="Titre du post" required><br>
        <textarea name="contenu" placeholder="Contenu du post" rows="6" cols="50" required></textarea><br><br>
        <input type="submit" value="Créer">
    </form>
</div>

<!-- Ajout du post dans la BdD -->
<?php
if(isset($_POST['contenu']) and strlen($_POST['contenu']) > 0){

    $date = date("d/m/y H:i");

    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    //Code d'insertion dans la BD
    $today = date('Y/m/d');
    $query = 'INSERT INTO croustapost (croustagrameur_id, titre, message, date, categories) VALUES ("' . $_SESSION['username'] . '", "' . htmlspecialchars($_POST["titre"]) . '", "' . htmlspecialchars($_POST["contenu"]) . '", "' . $today . '", "aucune")';

    // Gestion d'erreur BD
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requête<br>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
        echo 'Requête : ' . $query . '<br>';
        exit();
    }
    echo '<script>fermerPopup();</script>';

}
?>


<?php // Lecture + Affichage des posts de la BD (SELECT * FROM `croustapost`)

    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    // Requête
    $result = mysqli_query($dbLink, 'SELECT * FROM croustapost ORDER BY ptsCrous DESC');

    // Si la requête a marché on affiche les posts
    if ($result) {
        ?>
        <div style="display: inline-list-item; padding-left: 150px; padding-top: 80px;">
            <section id="posts">
                <article class="post">
                    <h2>aucun post</h2>
                </article>
            </section>
            <section id="pointCpt">
                <h2>Mes points crous : 0</h2>
            </section>

            <section id="ad">
                <h3>your ad here</h3>
            </section>
        <?php
            // afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous):
            while ($row = mysqli_fetch_assoc($result)) {
                afficher_post($row['croustagrameur_id'], $row['titre'], $row['message'], $row['date'], $row['categories'], $row['ptsCrous'], $row['id']);
            }
            // Libère la variable
            mysqli_free_result($result);
        ?>
        </div>

<?php
    }
    else
    {
        echo 'Erreur dans la requête : ' . mysqli_error($dbLink);
    }
    echo '<script>fermerPopup();</script>';
    end_page();
?>