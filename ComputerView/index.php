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
    <form action="../managePost/addPost.php" method="post">
        <input type="text" name="titre" placeholder="Titre du post" required><br>
        <textarea name="contenu" placeholder="Contenu du post" rows="6" cols="50" required></textarea><br><br>
        <input type="submit" value="Créer">
    </form>
</div>

<?php // Lecture + Affichage des posts de la BD (SELECT * FROM `croustapost`)

    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    // Requête
    $recherche = 'SELECT * FROM croustapost ORDER BY ptsCrous DESC';
    $result = mysqli_query($dbLink, $recherche);

    // Si la requête a marché on affiche les posts
    if ($result) {
        ?>
        <section id="posts">
            <article class="post">
                <?php
                // afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous):
                while ($row = mysqli_fetch_assoc($result)) {
    
                    // Requête COMMENTAIRES
                    $req = 'SELECT COUNT(*) FROM croustacomm WHERE croustapost_id = ' . $row['id'];
                    $nb_comm_result = mysqli_fetch_assoc(mysqli_query($dbLink, $req));
                    $nb_comm = (int)$nb_comm_result['COUNT(*)']; // Convert to integer
    
                    afficher_post($row['croustagrameur_id'], $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id'], $nb_comm);
                }
                // Libère la variable
                mysqli_free_result($result);
                ?>
            </article>
            <div>
                <section id="pointCpt">
                    <h2 style="font-size: 40px;">Mes points crous<br>0</h2>
                </section>

                <section id="ad">
                    <h3>your ad here</h3>
                </section>
            </div>
        </section>

<?php
    }
    else
    {
        echo 'Erreur dans la requête : ' . mysqli_error($dbLink);
    }
    echo '<script>fermerPopup();</script>';
    end_page();
?>
